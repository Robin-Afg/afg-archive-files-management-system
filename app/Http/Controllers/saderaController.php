<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sadera;
use App\Models\SaderaComment;
use App\Models\SaderaUser;
use App\Models\Noti;
use Webpatser\Uuid\Uuid;
use Auth;
use Carbon\Carbon;
use Verta;
use Helper;
use DB;
use App\Models\SaderaDeleted;
use App\Models\SaderaNoti;
use App\Models\User;
use File;

class saderaController extends Controller
{
    
//to show sadera blade panel
public function index_sadera(Request $request){
  
    $sadera = Sadera::with('authorizedUsers')->take(100);
 
  
    if ($request->end_date && $request->start_date) {                
        $start_date =  Helper::hejri_to_gr($request->start_date);                 
        $end_date =  Helper::hejri_to_gr($request->end_date);

        $sadera = Sadera::where('date_of_archiving', '>=', $start_date );
        $sadera = $sadera->where('date_of_archiving', '<=',$end_date); 
    }

    if ($request->start_date && !$request->end_date) {                                      
        if($request->start_date == Helper::current_year_full()){
          $sadera = Sadera::whereYear('date_of_archiving', '=', date('Y'));
        }
    }
    
    $sadera = $sadera->get()->sortByDesc('id'); 

    return view('Sadera.panel_sadera', compact('sadera'));
}

  

  // //to show sadera blade panel
  // public function index_sadera_year($year){
  //   $sadera = Sadera::where('year',$year)->get();
  //   return view('Sadera.panel_sadera',compact('sadera'));
  // }

    
// to add a sadera page  
public function add(){
  $last_id = Sadera::orderBy('id', 'desc')->first();
      
  if($last_id == null){
      $last_id = 1;
    } else {
        $last_id =  Helper::extract_number($last_id->crida_number) + 1 ;
    }

return view('Sadera.add_sadera',compact('last_id'));

}
             


public function store(Request $request){

   
$this->validate($request,[
            
            'mursal' => 'required',
            'file' => 'required|mimes:pdf|max:2048000',
            'tarikh_maktoob' => 'required',
            'crida_number' => 'required|Numeric',
            'mursal_alia' =>  'required',
            'kholas_matlab' => 'required',
            'asal' => 'required',
            //'copy' => 'required',
            'zamema' => 'required',
            'num_of_dosia' => 'required',
            'almary' => 'required',
            'date_of_archiving' => 'required',
            'place' => 'required',
            //'action' => 'required',
            
            
        ],

        [
          'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
          'mursal.required' => 'مرسل باید موجود باشد   ',
          'tarikh_maktoob.required' => 'تاریخ باید موجود باشد   ',
          'mursal_alia.required' => 'مرسل الیه باید موجود باشد   ',
          'kholas_matlab.required' => 'خلص مطلب باید موجود باشد   ',

          'asal.required' => 'اصل باید موجود باشد   ',
         // 'copy.required' => 'کاپی باید موجود باشد   ',
          'zamema.required' => 'ضمیمه باید موجود باشد   ',
          'num_of_dosia.required' => 'نمبر دوسیه باید موجود باشد   ',
          'almary.required' => 'الماری باید موجود باشد   ',
          'date_of_archiving.required' => 'تاریخ آرشیف باید موجود باشد   ',
          'place.required' => 'مکان باید موجود باشد   ',
         // 'action.required' => 'اجرات باید موجود باشد   ',
          'file.required' => 'اسناد باید موجود باشد   ',


        ]);

    $request->crida_number = Helper::format_number($request->tarikh_maktoob,$request->crida_number); 
      
    if(Sadera::where('crida_number',  $request->crida_number)->first() || Sadera::where('crida_number',  $request->crida_number)->first() ){
      $request->session()->flash('alert-danger', '  مکتوبی با این نمبر موجود است   ');
      return redirect()->back()->withInput();
    }else{ 
    
        

        $sadera = new Sadera;
   
                  //handle file uploading ---
                    if($request->hasFile('file')){  
                          $file_name = $request->file('file')->getClientOriginalName();
                              //get just filename
                          $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
                              // get just name extention
                          $ext = $request->file('file')->getClientOriginalExtension();
                              // filename to store
                          $file_name_st = $only_name.'_'.time().'.'.$ext;
                        
                          $request->file->storeAs('files/Sadera',$file_name_st);
                  }else{
                            $file_name_st = 'nofile';
                  }

//real storing happens here 

      $sadera->crida_number =  $request->crida_number;         
      $sadera->dateofmaktoob =  Helper::hejri_to_gr($request->tarikh_maktoob);
      $sadera->mursal =  $request->mursal; 
      $sadera->mursal_alia =  $request->mursal_alia;
      $sadera->copyto =  $request->copyto;   
      $sadera->kholasmatlab =  $request->kholas_matlab; 
      $sadera->asal =   $request->asal; 
      $sadera->copy =   $request->copy; 
      $sadera->zamema =  $request->zamema;
      $sadera->num_of_dosia =   $request->num_of_dosia;      
      $sadera->almary =  $request->almary;
      $sadera->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
      $sadera->place = $request->place;  
      $sadera->action =  $request->action;
      $sadera->more =  $request->more; 
      //setting file name and generating uuid
      $sadera->file = $file_name_st;
      $sadera->uuid = (string)Uuid::generate();
      
        //accessing people

        // if ($request->user_id != "") {
        //   foreach ($request->user_id as $val) 
        //        {
        //           $c = new SaderaUser;
        //           $c->sadera_id     = $request->sadera_id;
        //           $c->user_id      = $val;
        //           DB::transaction(function() use ($c) {
        //               $c->save();
        //           });
        //           Helper::add_noti_access('Sadera',  $c->user_id,  $c->sadera_id); 
        //        }
        //   } 
        //   else 
        //   {
        //   return redirect()->back();
        //   }
  
          // accessing ended here
    DB::transaction(function() use ($sadera) {  
      $sadera->save();
      //safe saving a file using db transaction
    });
    
    //accessing people on documents from add page
    if ($request->user_id != "") {
      foreach ($request->user_id as $val) 
           {
              $c = new SaderaUser;
              $c->sadera_id     = $sadera->id;
              $c->user_id      = $val;
              DB::transaction(function() use ($c) {
                  $c->save();
              });
              Helper::add_noti_access('Sadera',  $c->user_id,  $c->sadera_id); 
           }
      } 
    //accessing people on documents finished from add page

    $request->session()->flash('alert-success', ' موفقانه اضافه گردید ! مکتوب شماره ' . $request->crida_number);

          if($request->has('save_and_new')){
            return redirect("add_sadera");
          } else {
            return redirect("panel_sadera");
          } 
            

        }
 }







// to show the  edit blade  ////////////////////////////////
public function show_edit($record_id){
  $files = Sadera::findOrFail($record_id);
  
  $crida_number = Helper::extract_number($files->crida_number); 
 
  return view('Sadera.edit_sadera',compact('files','crida_number'));
 }



// to actuallay update a file 

public function edit(Request $request, $record_id ){
    
  $this->validate($request,[
            
    'mursal' => 'required',
    'tarikh_maktoob' => 'required',
    'crida_number' => 'required|Numeric',
    'mursal_alia' =>  'required',
    'kholas_matlab' => 'required',
    'asal' => 'required',
   // 'copy' => 'required',
    'zamema' => 'required',
    'num_of_dosia' => 'required',
    'almary' => 'required',
    'date_of_archiving' => 'required',
    'place' => 'required',
    'action' => 'required',
    'file' => 'mimes:pdf|max:2048000',
    
    
],

[
  'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
  'mursal.required' => 'مرسل باید موجود باشد   ',
  'tarikh_maktoob.required' => 'تاریخ باید موجود باشد   ',
  'mursal_alia.required' => 'مرسل الیه باید موجود باشد   ',
  'kholas_matlab.required' => 'خلص مطلب باید موجود باشد   ',
  'asal.required' => 'اصل باید موجود باشد   ',
 // 'copy.required' => 'کاپی باید موجود باشد   ',
  'zamema.required' => 'ضمیمه باید موجود باشد   ',
  'num_of_dosia.required' => 'نمبر دوسیه باید موجود باشد   ',
  'almary.required' => 'الماری باید موجود باشد   ',
  'date_of_archiving.required' => 'تاریخ آرشیف باید موجود باشد   ',
  'place.required' => 'مکان باید موجود باشد   ',
  'action.required' => 'اجرات باید موجود باشد   ',
  'file.mimes' => 'فایل باید پی دی اف باشد   ',
  'file.max' => 'اندازه فایل شما نباید از 200 ام بی تجاوز کند     ',


]);

$request->crida_number = Helper::format_number($request->tarikh_maktoob,$request->crida_number); 
$sadera = Sadera::findOrFail($record_id);    

    if($request->crida_number != $sadera->crida_number ){  
        if (Sadera::where('crida_number',$request->crida_number)->first() == "") {
            $sadera->crida_number =  $request->crida_number;
        }else{
          $request->session()->flash('alert-danger', '  سندی با نمبر '. $request->crida_number . '  موجود است ');
          return redirect()->back()->withInput();
        }
    }

         //handle file upload ***********************************
     if($request->hasFile('file')){    
        $old = storage_path('app/files/Sadera/'. $sadera->file);
         if(file_exists($old)){  
          $old = storage_path('app/files/Sadera/'. $sadera->file);
          $new = storage_path('app/edited/Sadera/'. $sadera->file);
          $move = File::move($old, $new);
      }
         $file_name = $request->file('file')->getClientOriginalName();
                //get just filename
         $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
            // get just name extention
         $ext = $request->file('file')->getClientOriginalExtension();
          // filename to store
         $file_name_st = $only_name.'_'.time().'.'.$ext;
    
           $request->file->storeAs('files/Sadera',$file_name_st);
                  $sadera->file = $file_name_st;
        } else {
           $file_name_st = $sadera->file;
        }

      $sadera->dateofmaktoob =  Helper::hejri_to_gr($request->tarikh_maktoob);
      $sadera->mursal =  $request->mursal; 
      $sadera->mursal_alia =  $request->mursal_alia;   
      $sadera->copyto =  $request->copyto;   
      $sadera->kholasmatlab =  $request->kholas_matlab; 
      $sadera->asal =   $request->asal; 
      $sadera->copy =   $request->copy; 
      $sadera->zamema =  $request->zamema;
      $sadera->num_of_dosia =   $request->num_of_dosia;      
      $sadera->almary =  $request->almary;
      $sadera->date_of_archiving =  Helper::hejri_to_gr($request->date_of_archiving);
      $sadera->place = $request->place;  
      $sadera->action =  $request->action; 
      $sadera->more = $request->more;     
      
    
      DB::transaction(function() use ($sadera) {
        $sadera->save();
      });  
      $request->session()->flash('alert-info', ' موفقانه ویرایش گردید   ');
      return redirect()->route('panel_sadera');
       
 }


public function show($file) {
  $files = Sadera::with('comments')->with('authorizedUsers')->findOrFail($file);
  return view('Sadera.show_sadera',compact('files'));
}


  //handeling downloads
  public function download($uuid){
    $file = Sadera::where('uuid', $uuid)->firstOrFail();
    
    if(file_exists(storage_path('app/files/Sadera/'. $file->file))){
       $path = storage_path('app/files/Sadera/'. $file->file);
       return response()->download($path);
    }else {
      return response()->json(['result' => 'failed']);
    }
  
  }





// **********************************************************************

// add db transaction from here  to other files

// pluse decide on having status column on the database

// **********************************************************************










// access files and help you to see all the availble user files 
public function accessFile($id){       
    $file = Sadera::with('authorizedUsers')->findOrFail($id);
    return view('Sadera.access_sadera',compact('file'));

}


     
//granting access to specific users  handling post grant permision - -
public function grant(Request $request){

      if ($request->user_id != "") {
        foreach ($request->user_id as $val) 
             {
                $c = new SaderaUser;
                $c->sadera_id     = $request->sadera_id;
                $c->user_id      = $val;
                DB::transaction(function() use ($c) {
                    $c->save();
                });
                Helper::add_noti_access('Sadera',  $c->user_id,  $c->sadera_id); 
             }
        } 
        else 
        {
        return redirect()->back();
        }

           $request->session()->flash('alert-success', ' به کاربران موفقانه دسترسی داده شد ');

            return redirect()->back()->with('message');
    }

  



  //handels revoking permision from a user in the access blade file *** //
    public function deleteUserAccess( $record_id,$user_id, Request $request)
    {
      
      $record = SaderaUser::findOrFail($record_id);
      $del_noti_access = Noti::where('noti_for', 1)->where('notifiable_id', $user_id)->where('type', 'sadera')->where('file_id',$record->sadera_id);
      
      DB::transaction(function() use ($record, $del_noti_access) {
        
        $del_noti_access->delete();
        $record->delete();
      });
      
      $request->session()->flash('alert-warning', ' دسترسی کاربر حذف شد  ');
      return redirect()->back()->with('message');
    }



//handels deleting a file, its comments and attachments 
public function delete($record_id, Request $request){
  
  if(Sadera::findOrFail($record_id)->first() != " " ) {  
    $file = Sadera::findOrFail($record_id);
    
    $deleted = new SaderaDeleted;

         
      
      $deleted->crida_number = $file->crida_number;
      $deleted->database_id = $file->id;
      $deleted->dateofmaktoob =  $file->dateofmaktoob;
      $deleted->mursal =  $file->mursal; 
      $deleted->mursal_alia =  $file->mursal_alia;  
      $deleted->copyto =  $request->copyto;    
      $deleted->kholasmatlab =  $file->kholasmatlab; 
      $deleted->asal =   $file->asal; 
      $deleted->copy =   $file->copy; 
      $deleted->zamema =  $file->zamema;
      $deleted->num_of_dosia =   $file->num_of_dosia;      
      $deleted->almary =  $file->almary;
      $deleted->date_of_archiving =  $file->date_of_archiving;
      $deleted->place = $file->place;
      $deleted->more = $file->more;  
      $deleted->action =  $file->action; 
      $deleted->file =  $file->file; 
      $deleted->uuid =  $file->uuid; 
      
      $del_comment = SaderaComment::where('sadera_id', $record_id);
      $del_access = SaderaUser::where('sadera_id',$record_id);
      $del_notis = Noti::where('file_id', $record_id);
 
      DB::beginTransaction();
        try {
           //save file to another table
           $deleted->save();

            //to move a file in the (deleted) folder
          if(file_exists(storage_path('app/files/Sadera/'. $file->file))){  
            $old = storage_path('app/files/Sadera/'. $file->file);
            $new = storage_path('app/deleted/Sadera/'. $file->file);
            $move = File::move($old, $new);
           }

            //to delete its comments
            if($del_comment){
              $del_comment->delete();
            } 
            
            //to delete its user access
            if($del_access){
              $del_access->delete();
            }

            //to delete its notifications
            if($del_notis){
              $del_notis->delete();
            }
            //delete the actual file
            $file->delete();
            DB::commit();
            $result = "success";
        } catch (\Exception $e) {
            $result = "failed";
            DB::rollback();
        }

       return response()->json(['result' => $result]);
      }
    }





//to add comment for sadera  -- this is for both admins and users

Public function addComment(Request $request){
  // return $id;


    $this->validate($request,[   
    'comment' => 'required',   
    ],
    [
    'comment.required' => ' اجرات خود را بنویسید   ',
    ]);

      $user_id = Auth::user()->id;
      $comment = new SaderaComment;

      $comment->comment = $request->comment;
      $comment->sadera_id = $request->sadera_id;
      $comment->user_id = $user_id;



      DB::transaction(function() use ($comment) {

        $comment->save();
        
       
          /*
            * Safe saving a file if an error occure db transaction rollback everything
            */
      
      });

      
      Helper::add_noti('Sadera',  $comment->id,$comment->sadera_id);

     
    $request->session()->flash('alert-success', ' نظر شما افزوده شد ' );
    return redirect()->back();

}




//handels that the user who posted can update his or her comment used in the view blade comment section of show_sadera blade
  public function editcomment(Request $request){
     
    if($request->user_id == Auth::user()->id){
        $comment =  SaderaComment::findOrFail($request->comment_id);
        $comment->comment = $request->comment;
        DB::transaction(function() use ($comment) {
          $comment->save();
        /*
          * Safe saving a file if an error occure db transaction rollback everything
          */
        });
        
        $request->session()->flash('alert-success', ' اجرات شما ویرایش شد ' );
        return redirect()->back();
    } else {
      return "نظر ویرایش نشد";
    }

  }


//the user who posted the comment can delete their comment and the admin can delete their commnet
  public function deletecomment($record_id, Request $request){    
   if($request->user_id == Auth::user()->id || Auth::user()->id == 1){
   $comment =  SaderaComment::findOrFail($record_id);
   $notis = Noti::where('comment_id', $record_id);
   DB::transaction(function() use ($comment, $notis) {
    $comment->delete();
    $notis->delete();
    /*
    * Safe saving a file if an error occure db transaction rollback everything
    */
  });
  $request->session()->flash('alert-warning', ' نظر شما حذف گردید ' );
   return redirect()->back();
    } else {
      return "انجام نشد ";
    }


  }


    //show accessed data for user in the home_sadera blade
    public function index(Request $request){

        $user = Auth::user();
        $user = $user->saderas;

      return view('Sadera.home_sadera',compact('user'));
    }



}
