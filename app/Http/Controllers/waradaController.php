<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Warada;
use App\Models\WaradaComment;
use App\Models\WaradaUser;
use App\Models\Noti;
use Webpatser\Uuid\Uuid;
use Auth;
use Carbon\Carbon;
use Verta;
use Helper;
use DB;
use App\Models\WaradaDeleted;
use File;
class waradaController extends Controller
{
      
//to show warada blade panel
public function index_warada(Request $request){
  
  $warada = Warada::with('authorizedUsers')->take(100);
 
  
    if ($request->end_date && $request->start_date) {                
        $start_date =  Helper::hejri_to_gr($request->start_date);                 
        $end_date =  Helper::hejri_to_gr($request->end_date);

        $warada = Warada::where('date_of_archiving', '>=', $start_date );
        $warada = $warada->where('date_of_archiving', '<=',$end_date); 
    }

    if ($request->start_date && !$request->end_date) {                                      
        if($request->start_date == Helper::current_year_full()){
          $warada = Warada::whereYear('date_of_archiving', '=', date('Y'));
        }
    }
    
    $warada = $warada->get()->sortByDesc('id'); 

    return view('Warada.panel_warada', compact('warada'));



}



    
// to add a Warada page  
public function add(){
  $last_id = Warada::orderBy('id', 'desc')->first();
      
  if($last_id == null){
      $last_id = 1;
    } else {
        $last_id =  Helper::extract_number($last_id->crida_number) + 1 ;
    }

return view('Warada.add_warada',compact('last_id'));

}
             


public function store(Request $request){

    
$this->validate($request,[
            
            'crida_number' => 'required|Numeric',
            'number_of_warada' => 'required',
            'date_of_warada' => 'required',
            'mursal' => 'required',
            'reyasat' =>  'required',
            'moderyat' => 'required',
            'asal' => 'required',
            'copy' => 'required',
            'zamema' => 'required',
            'action' => 'required',
            'kholasmatlab' => 'required',
            'mursal_alia' => 'required',
            'num_of_dosia' => 'required',
            'almary' => 'required',
            'place' => 'required',
            'date_of_archiving' => 'required',
            'file' => 'required|mimes:pdf|max:2048000',
            
            
        ],

        [
          'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
          'number_of_warada.required' => 'نمبر وارده باید موجود باشد   ',
          'date_of_warada.required' => 'تاریخ وارده باید موجود باشد   ',
          'mursal.required' => 'مرسل باید موجود باشد   ',
          'reyasat.required' => 'ریاست باید موجود باشد   ',
          'moderyat.required' => 'مدیریت باید موجود باشد   ',
          'asal.required' => 'اصل باید موجود باشد   ',
          'copy.required' => 'کاپی باید موجود باشد   ',
          'zamema.required' => 'ضمیمه باید موجود باشد   ',
          'action.required' => 'اجرات باید موجود باشد   ',
          'kholasmatlab.required' => 'خلص مطلب باید موجود باشد   ',
          'mursal_alia.required' => 'مرسل الیه باید موجود باشد   ',
          'num_of_dosia.required' => 'نمبر دوسیه باید موجود باشد   ',
          'almary.required' => 'الماری باید موجود باشد   ',
          'place.required' => 'مکان باید موجود باشد   ',
          'date_of_archiving.required' => 'تاریخ آرشیف باید موجود باشد   ',
          'file.required' => 'اسناد باید موجود باشد   ',
          'file.mimes' => 'فایل باید پی دی اف باشد   ',
         
          ]);

    $request->crida_number = Helper::format_number($request->date_of_archiving, $request->crida_number); 
      
    if(Warada::where('crida_number',  $request->crida_number)->first() || Warada::where('crida_number',  $request->crida_number)->first() ){
      $request->session()->flash('alert-danger', '  مکتوبی با این نمبر موجود است   ');
      return redirect()->back()->withInput();
    }else{ 
    
        

        $warada = new Warada;
   
                  //handle file uploading ---
                    if($request->hasFile('file')){  
                          $file_name = $request->file('file')->getClientOriginalName();
                              //get just filename
                          $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
                              // get just name extention
                          $ext = $request->file('file')->getClientOriginalExtension();
                              // filename to store
                          $file_name_st = $only_name.'_'.time().'.'.$ext;
                        
                          $request->file->storeAs('files/Warada',$file_name_st);
                  }else{
                            $file_name_st = 'nofile';
                  }

//real storing happens here 

      $warada->crida_number =  $request->crida_number;  
      $warada->number_of_warada =  $request->number_of_warada;         
      $warada->date_of_warada =  Helper::hejri_to_gr($request->date_of_warada);
      $warada->mursal =  $request->mursal; 
      $warada->reyasat =  $request->reyasat;   
      $warada->moderyat =  $request->moderyat; 
      $warada->asal =   $request->asal; 
      $warada->copy =   $request->copy; 
      $warada->zamema =  $request->zamema;
      $warada->action =  $request->action;
      $warada->kholasmatlab =   $request->kholasmatlab;  
      $warada->mursal_alia =  $request->mursal_alia;
      $warada->num_of_dosia =  $request->num_of_dosia;
      $warada->almary =  $request->almary;
      $warada->place =  $request->place;
      $warada->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
      $warada->more =  $request->more; 
      //setting file name and generating uuid
      $warada->file = $file_name_st;
      $warada->uuid = (string)Uuid::generate();
  
    
  DB::transaction(function() use ($warada) {
      
    $warada->save();
      //safe saving a file using db transaction
    });

       

    $request->session()->flash('alert-success', ' موفقانه اضافه گردید ! مکتوب شماره ' . $request->crida_number);

    if($request->has('save_and_new')){
      return redirect("add_warada");
    } else {
      return redirect("panel_warada");
    } 
      





        }
 }






// to show the  edit blade  ////////////////////////////////
public function show_edit($record_id){
  $files = Warada::findOrFail($record_id);
  
  $crida_number = Helper::extract_number($files->crida_number); 
 
  return view('Warada.edit_warada',compact('files','crida_number'));
 }



// to actuallay update a file 

public function edit(Request $request, $record_id ){

   
  $this->validate($request,[
            
    'crida_number' => 'required|Numeric',
   // 'number_of_warada' => 'required',
    'date_of_warada' => 'required',
    'mursal' => 'required',
   // 'reyasat' =>  'required',
  //  'moderyat' => 'required',
    'asal' => 'required',
  //  'copy' => 'required',
  //  'zamema' => 'required',
  //  'action' => 'required',
    'kholasmatlab' => 'required',
    'mursal_alia' => 'required',
    'num_of_dosia' => 'required',
    'almary' => 'required',
    'place' => 'required',
    'date_of_archiving' => 'required',
    'file' => 'mimes:pdf|max:2048000',
    
    
],

[
  'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
  'number_of_warada.required' => 'نمبر وارده باید موجود باشد   ',
  'date_of_warada.required' => 'تاریخ وارده باید موجود باشد   ',
  'mursal.required' => 'مرسل باید موجود باشد   ',
  'reyasat.required' => 'ریاست باید موجود باشد   ',
  'moderyat.required' => 'مدیریت باید موجود باشد   ',
  'asal.required' => 'اصل باید موجود باشد   ',
  'copy.required' => 'کاپی باید موجود باشد   ',
  'zamema.required' => 'ضمیمه باید موجود باشد   ',
  'action.required' => 'اجرات باید موجود باشد   ',
  'kholas_matlab.required' => 'خلص مطلب باید موجود باشد   ',
  'mursal_alia.required' => 'مرسل الیه باید موجود باشد   ',
  'num_of_dosia.required' => 'نمبر دوسیه باید موجود باشد   ',
  'almary.required' => 'الماری باید موجود باشد   ',
  'place.required' => 'مکان باید موجود باشد   ',
  'date_of_archiving.required' => 'تاریخ آرشیف باید موجود باشد   ',
  'file.mimes' => 'فایل باید پی دی اف باشد   ',
 
 
  ]);

$request->crida_number = Helper::format_number($request->date_of_archiving,$request->crida_number); 

$warada = Warada::findOrFail($record_id);    

    if($request->crida_number != $warada ->crida_number ){
      
        if (Warada::where('crida_number',$request->crida_number)->first() == "") {
            $warada->crida_number =  $request->crida_number;
        }else{
          $request->session()->flash('alert-danger', '  سندی با نمبر '. $request->crida_number . '  موجود است ');
          return redirect()->back()->withInput();
        }
      }
        
      

          //handle file upload ***********************************
     if($request->hasFile('file')){
            
      $old = storage_path('app/files/Warada/'. $warada->file);

      

       if(file_exists($old)){  
        $old = storage_path('app/files/Warada/'. $warada->file);
        $new = storage_path('app/edited/Warada/'. $warada->file);
        $move = File::move($old, $new);
    }

       $file_name = $request->file('file')->getClientOriginalName();
              //get just filename
       $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
          // get just name extention
       $ext = $request->file('file')->getClientOriginalExtension();
        // filename to store
       $file_name_st = $only_name.'_'.time().'.'.$ext;
  
         $request->file->storeAs('files/Warada',$file_name_st);
                $warada->file = $file_name_st;
      } else {
         $file_name_st = $warada->file;
      }


              
            
        //real storing happens here 

        $warada->crida_number =  $request->crida_number;  
        $warada->number_of_warada =  $request->number_of_warada;         
        $warada->date_of_warada =  Helper::hejri_to_gr($request->date_of_warada);
        $warada->mursal =  $request->mursal; 
        $warada->reyasat =  $request->reyasat;   
        $warada->moderyat =  $request->moderyat; 
        $warada->asal =   $request->asal; 
        $warada->copy =   $request->copy; 
        $warada->zamema =  $request->zamema;
        $warada->action =  $request->action;
        $warada->kholasmatlab =   $request->kholasmatlab;  
        $warada->mursal_alia =  $request->mursal_alia;
        $warada->num_of_dosia =  $request->num_of_dosia;
        $warada->almary =  $request->almary;
        $warada->place =  $request->place;
        $warada->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
        $warada->more =  $request->more; 
        


        DB::transaction(function() use ($warada) {

          $warada->save();
    
            /*
              * Safe saving a file if an error occure db transaction rollback everything
              */
        
        });
     
      $request->session()->flash('alert-info', ' موفقانه ویرایش گردید   ');

     return redirect()->route('panel_warada');
       
 }







public function show_file($file) {
  $files = Warada::with('comments')->with('authorizedUsers')->findOrFail($file); 
  return view('Warada.show_warada',compact('files'));

}




  //handeling downloads
  public function download($uuid){
    $file = Warada::where('uuid', $uuid)->firstOrFail();
    
    if(file_exists(storage_path('app/files/warada/'. $file->file))){
       $path = storage_path('app/files/warada/'. $file->file);
       return response()->download($path);
    }else {
      return response()->json(['result' => 'failed']);
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
          $comment = new WaradaComment;

          $comment->comment = $request->comment;
          $comment->warada_id = $request->warada_id;
          $comment->user_id = $user_id;

          DB::transaction(function() use ($comment) {

            $comment->save();
      
              /*
                * Safe saving a file if an error occure db transaction rollback everything
                */
          
          });

          Helper::add_noti('Warada',  $comment->id, $comment->warada_id);

          $request->session()->flash('alert-success', ' اجرات شما افزوده شد ' );
          return redirect()->back();
   
   }



// access files and help you to see all the availble user files 
public function accessFile($id){       
    $file = Warada::with('authorizedUsers')->findOrFail($id);
    return view('Warada.access_warada',compact('file'));

}


     
//granting access to specific users  handling post grant permision - -
public function grant(Request $request){
      
      if ($request->user_id != "") {
        foreach ($request->user_id as $val) 
             {
                $c = new WaradaUser;
                $c->warada_id     = $request->warada_id;
                $c->user_id      = $val;
                DB::transaction(function() use ($c) {
                    $c->save();
                });
                Helper::add_noti_access('Warada',  $c->user_id,  $c->warada_id); 
             }
        } 
        else 
        {
          $request->session()->flash('alert-danger', ' انجام نشد ! ');  
        return redirect()->back();
        }

           $request->session()->flash('alert-success', ' به کاربران موفقانه دسترسی داده شد ');

            return redirect()->back()->with('message');
    }

  



  //handels revoking permision from a user in the access blade file *** //
    public function deleteUserAccess($record_id, $user_id,  Request $request)
    {
      $record = WaradaUser::findOrFail($record_id);
      $del_noti_access = Noti::where('noti_for', 1)->where('notifiable_id', $user_id)->where('type', 'warada')->where('file_id',$record->warada_id);
      DB::transaction(function() use ($record,$del_noti_access) {
        $record->delete();
        $del_noti_access->delete();
      });
      
        
      
      $request->session()->flash('alert-warning', ' دسترسی کاربر حذف شد  ');
      return redirect()->back()->with('message');
    }



//handels deleting a file, its comments and attachments 
public function delete($record_id, Request $request){
  if(Warada::findOrFail($record_id)->first() != " " ) {  
    $file = Warada::findOrFail($record_id);
    $deleted = new WaradaDeleted;


      
      /////////////////////////////////////////////
      $deleted->crida_number = $file->crida_number;
      $deleted->database_id = $file->id;
      $deleted->number_of_warada =  $file->number_of_warada;
      $deleted->date_of_warada =  $file->date_of_warada; 
      $deleted->mursal =  $file->mursal;   
      $deleted->reyasat =  $file->reyasat;
      $deleted->moderyat =  $file->moderyat; 
      $deleted->asal =   $file->asal; 
      $deleted->copy =   $file->copy; 
      $deleted->zamema =  $file->zamema;
      $deleted->action =  $file->action;
      $deleted->kholasmatlab =  $file->kholasmatlab;
      $deleted->mursal_alia =  $file->mursal_alia;
      $deleted->num_of_dosia =   $file->num_of_dosia;      
      $deleted->almary =  $file->almary;
      $deleted->place = $file->place;
      $deleted->date_of_archiving =  $file->date_of_archiving;     
      $deleted->more = $file->more;        
      $deleted->file =  $file->file; 
      $deleted->uuid =  $file->uuid;    

      $del_comment = WaradaComment::where('warada_id', $record_id);
      $del_access = WaradaUser::where('warada_id',$record_id);
      $del_notis = Noti::where('file_id', $record_id);
 
      DB::beginTransaction();
        try {
          $deleted->save();

            //to move a file in the (deleted) folder
            if(file_exists(storage_path('app/files/Warada/'. $file->file))){  
              $old = storage_path('app/files/Warada/'. $file->file);
              $new = storage_path('app/deleted/Warada/'. $file->file);
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



//handels that the user who posted can update his or her comment used in the view blade comment section of show_sadera blade
  public function editcomment(Request $request){
     
    if($request->user_id == Auth::user()->id){
        $comment =  WaradaComment::findOrFail($request->comment_id);
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
      return "انجام نشد ";
    }

  }


//the user who posted the comment can delete their comment and the admin can delete their commnet
  public function deletecomment($record_id, Request $request){    
   if($request->user_id == Auth::user()->id || Auth::user()->id == 1){
   $comment =  WaradaComment::findOrFail($record_id);
   $notis = Noti::where('comment_id', $record_id);
   DB::transaction(function() use ($comment, $notis) {
    $comment->delete();
    $notis->delete();
  /*
    * Safe saving a file if an error occure db transaction rollback everything
    */
  });

    $request->session()->flash('alert-success', ' نظر شما حذف گردید ' );
     return redirect()->back();
    } else {
      return "انجام نشد ";
    }


  }

    //show accessed data for user in the home_sadera blade
    public function index(Request $request){
      $user = Auth::user();
      $user = $user->waradas;
      return view('Warada.home_warada',compact('user'));
    }
    

}
