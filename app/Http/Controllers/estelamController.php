<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Estelam;
use App\Models\EstelamComment;
use App\Models\EstelamUser;
use App\Models\EstelamDeleted;
use App\Models\Noti;
use Webpatser\Uuid\Uuid;
use Auth;
use Carbon\Carbon;
use Verta;
use Helper;
use DB;
use File;


class estelamController extends Controller
{
  //to show Estelam blade panel
public function index_estelam(Request $request){

    $estelam = Estelam::with('authorizedUsers')->take(100);
    
        if ($request->end_date && $request->start_date) {                
            $start_date =  Helper::hejri_to_gr($request->start_date);                 
            $end_date =  Helper::hejri_to_gr($request->end_date);

            $estelam = Estelam::where('date_of_archiving', '>=', $start_date );
            $estelam = $estelam->where('date_of_archiving', '<=',$end_date); 
        }

        if ($request->start_date && !$request->end_date) {                                      
            if($request->start_date == Helper::current_year_full()){
              $estelam = Estelam::whereYear('date_of_archiving', '=', date('Y'));
            }
        }
        
        $estelam = $estelam->get()->sortByDesc('id'); 

        return view('Estelam.panel_estelam', compact('estelam'));
  }

  
    
// to add a sadera page  
public function add(){
  $last_id = Estelam::orderBy('id', 'desc')->first();
      
        if($last_id == null){
            $last_id = 1;
         } else {
            $last_id =  Helper::extract_number($last_id->crida_number) + 1 ;
        }

  return view('Estelam.add_estelam',compact('last_id'));

}
             


public function store(Request $request){

    
    $this->validate($request,[
                
                'crida_number' => 'required|Numeric',
                'date_of_archiving' => 'required',
                'date_of_estelam' => 'required',
                'date_of_sodor' => 'required',
                'add_of_sender' =>  'required',
                'marja' =>  'required',
                'reyasat' =>  'required',
                'wozarat' =>  'required',
                'kholasmatlab' => 'required',
                'asal' => 'required',
                'zamema' => 'required',
                'place' => 'required',
                'taslemi' => 'required',
                'file' => 'required|mimes:pdf|max:2048000',
            ],

            [
            'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
            'crida_number.Numeric' => 'نمبر مسلسل باید عدد باشد   ',
            'date_of_estelam.required' => 'تاریخ استعلام باید موجود باشد   ',
            'date_of_archiving.required' => 'تاریخ ثبت استعلام باید موجود باشد   ',
            'date_of_sodor.required' => 'تاریخ صدور  باید موجود باشد   ',
            'add_of_sender.required' => 'آدرس صادر کننده  باید موجود باشد   ',
            'marja.required' => ' مرجع باید موجود باشد   ',
            'reyasat.required' => 'ریاست باید موجود باشد   ',
            'wozarat.required' => 'وزارت باید موجود باشد   ',
            'kholasmatlab.required' => 'خلص موضوع باید موجود باشد   ',
            'asal.required' => 'اصل باید موجود باشد   ',
            'zamema.required' => 'ضمیمه باید موجود باشد   ',
            'place.required' => 'مکان باید موجود باشد   ',
            'taslemi.required' => 'تسلیمی باید موجود باشد   ',
            'file.required' => 'فایل باید موجود باشد   ',
            'file.mimes' => 'فایل باید پی دی اف باشد   ',
            ]);

    $request->crida_number = Helper::format_number($request->date_of_archiving, $request->crida_number); 
      
    if(Estelam::where('crida_number',  $request->crida_number)->first() || Estelam::where('crida_number',  $request->crida_number)->first() ){
      $request->session()->flash('alert-danger', '  فایلی با این نمبر موجود است   ');
      return redirect()->back()->withInput();
    }else{ 
    
        $estelam = new Estelam;
   
                  //handle file uploading ---
                    if($request->hasFile('file')){  
                          $file_name = $request->file('file')->getClientOriginalName();
                              //get just filename
                          $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
                              // get just name extention
                          $ext = $request->file('file')->getClientOriginalExtension();
                              // filename to store
                          $file_name_st = $only_name.'_'.time().'.'.$ext;
                        
                          $request->file->storeAs('files/Estelam',$file_name_st);
                  }else{
                            $file_name_st = 'nofile';
                  }

//real storing happens here 

      $estelam->crida_number =  $request->crida_number;      
      $estelam->date_of_estelam =  Helper::hejri_to_gr($request->date_of_estelam);
      $estelam->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
      $estelam->date_of_sodor =   Helper::hejri_to_gr($request->date_of_sodor);
      $estelam->add_of_sender =  $request->add_of_sender; 
      $estelam->marja =  $request->marja;  
      $estelam->reyasat =  $request->reyasat;  
      $estelam->wozarat =  $request->wozarat;  
      $estelam->kholasmatlab =   $request->kholasmatlab; 
      $estelam->asal =   $request->asal;            
      $estelam->zamema =  $request->zamema;
      $estelam->place =  $request->place;  
      $estelam->taslemi =  $request->taslemi; 
      $estelam->more =  $request->more; 
      //setting file name and generating uuid
      $estelam->file = $file_name_st;
      $estelam->uuid = (string)Uuid::generate();

        DB::transaction(function() use ($estelam) {
        
                $estelam->save();
                //safe saving a file using db transaction
        });

        $request->session()->flash('alert-success', ' موفقانه اضافه گردید ! مکتوب شماره ' . $request->crida_number);

        if($request->has('save_and_new')){
            return redirect("add_estelam");
        } else {
            return redirect("panel_estelam");
        } 
      


    }
 }



 public function show_file($file) {
  $file = Estelam::with('comments')->with('authorizedUsers')->findOrFail($file); 
  return view('Estelam.show_estelam',compact('file'));

  }



  //handeling downloads
  public function download($uuid){
    $file = Estelam::where('uuid', $uuid)->firstOrFail();
    if(file_exists(storage_path('app/files/Estelam/'. $file->file))){
       $path = storage_path('app/files/Estelam/'. $file->file);
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
        $comment = new EstelamComment;
        $comment->comment = $request->comment;
        $comment->estelam_id = $request->estelam_id;
        $comment->user_id = $user_id;
        DB::transaction(function() use ($comment) {
          $comment->save();
        });
        //to generate its notifications
        Helper::add_noti('Estelam',  $comment->id, $comment->estelam_id);
        $request->session()->flash('alert-success', ' اجرات شما افزوده شد ' );
        return redirect()->back();
 
 }




 
//handels that the user who posted can update his or her comment used in the view blade comment section of show_sadera blade
public function editcomment(Request $request){
   
  if($request->user_id == Auth::user()->id){
      $comment =  EstelamComment::findOrFail($request->comment_id);
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
        $comment =  EstelamComment::findOrFail($record_id);
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


///////////////////////////// continue from here 

// to show the  edit blade  ////////////////////////////////
public function show_edit($record_id){
  $file = Estelam::findOrFail($record_id);  
  $crida_number = Helper::extract_number($file->crida_number); 
  return view('Estelam.edit_estelam',compact('file','crida_number'));
 }



// to actuallay update a file 

public function edit(Request $request, $record_id ){

   
        $this->validate($request,[             
          'crida_number' => 'required|Numeric',
          'date_of_archiving' => 'required',
          'date_of_estelam' => 'required',
          'date_of_sodor' => 'required',
          'add_of_sender' =>  'required',
          // 'marja' =>  'required',
          // 'reyasat' =>  'required',
          'wozarat' =>  'required',
          'kholasmatlab' => 'required',
          'asal' => 'required',
          'zamema' => 'required',
          'place' => 'required',
          'taslemi' => 'required',
          'file' => 'mimes:pdf|max:2048000',
     
      ],

      [
      'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
      'crida_number.Numeric' => 'نمبر مسلسل باید عدد باشد   ',
      'date_of_estelam.required' => 'تاریخ استعلام باید موجود باشد   ',
      'date_of_archiving.required' => 'تاریخ ثبت استعلام باید موجود باشد   ',
      'date_of_sodor.required' => 'تاریخ صدور  باید موجود باشد   ',
      'add_of_sender.required' => 'آدرس صادر کننده  باید موجود باشد   ',
      'marja.required' => ' مرجع باید موجود باشد   ',
      'reyasat.required' => 'ریاست باید موجود باشد   ',
      'wozarat.required' => 'وزارت باید موجود باشد   ',
      'kholasmatlab.required' => 'خلص موضوع باید موجود باشد   ',
      'asal.required' => 'اصل باید موجود باشد   ',
      'zamema.required' => 'ضمیمه باید موجود باشد   ',
      'place.required' => 'مکان باید موجود باشد   ',
      'taslemi.required' => 'تسلیمی باید موجود باشد   ',
      'file.mimes' => 'فایل باید پی دی اف باشد   ',
      
      ]);

  $request->crida_number = Helper::format_number($request->date_of_archiving,$request->crida_number); 
  $estelam = Estelam::findOrFail($record_id);    

    if($request->crida_number != $estelam->crida_number ){
      
        if (Estelam::where('crida_number',$request->crida_number)->first() == "") {
            $estelam->crida_number =  $request->crida_number;
        }else{
          $request->session()->flash('alert-danger', '  سندی با نمبر '. $request->crida_number . '  موجود است ');
          return redirect()->back()->withInput();
        }
    }
        
      

          //handle file upload ***********************************
     if($request->hasFile('file')){      
      
      $old = storage_path('app/files/Estelam/'. $estelam->file);
       if(file_exists($old)){  
        $old = storage_path('app/files/Estelam/'. $estelam->file);
        $new = storage_path('app/edited/Estelam/'. $estelam->file);
        $move = File::move($old, $new);
        }

       $file_name = $request->file('file')->getClientOriginalName();
              //get just filename
       $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
          // get just name extention
       $ext = $request->file('file')->getClientOriginalExtension();
        // filename to store
       $file_name_st = $only_name.'_'.time().'.'.$ext;
  
         $request->file->storeAs('files/Estelam',$file_name_st);
                $estelam->file = $file_name_st;
      } else {
         $file_name_st = $estelam->file;
      }

      
        //Setting the properties
        $estelam->crida_number =  $request->crida_number;      
        $estelam->date_of_estelam =  Helper::hejri_to_gr($request->date_of_estelam);
        $estelam->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
        $estelam->date_of_sodor =   Helper::hejri_to_gr($request->date_of_sodor);
        $estelam->add_of_sender =  $request->add_of_sender; 
        $estelam->marja =  $request->marja;  
        $estelam->reyasat =  $request->reyasat;  
        $estelam->wozarat =  $request->wozarat;  
        $estelam->kholasmatlab =   $request->kholasmatlab; 
        $estelam->asal =   $request->asal;            
        $estelam->zamema =  $request->zamema;
        $estelam->place =  $request->place;  
        $estelam->taslemi =  $request->taslemi; 
        $estelam->more =  $request->more; 
       

        DB::transaction(function() use ($estelam) {
          //real storing happens here 
          $estelam->save();
        });
     
  $request->session()->flash('alert-info', ' موفقانه ویرایش گردید   ');
  return redirect()->route('panel_estelam');
       
 }








// access files and help you to see all the availble user files 
public function accessFile($id){       
    $file = Estelam::with('authorizedUsers')->findOrFail($id);
    return view('Estelam.access_estelam',compact('file'));

}


     
//granting access to specific users  handling post grant permision - used in access blade
public function grant(Request $request){
      
      if ($request->user_id != "") {
        foreach ($request->user_id as $val) 
             {
                  $c = new EstelamUser;
                  $c->estelam_id     = $request->estelam_id;
                    $c->user_id      = $val;
                    DB::transaction(function() use ($c) {
                       $c->save();
                    });
                    Helper::add_noti_access('Estelam',  $c->user_id,  $c->estelam_id);
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
    public function deleteUserAccess(Request $request, $record_id, $user_id)
    {
     
      $record = EstelamUser::findOrFail($record_id);
      $del_noti_access = Noti::where('noti_for', 1)->where('notifiable_id', $user_id)->where('type', 'estelam')->where('file_id',$record->estelam_id);
      DB::transaction(function() use ($record,$del_noti_access) {
        $record->delete();
        $del_noti_access->delete();
      });
        
      $request->session()->flash('alert-warning', ' دسترسی کاربر حذف شد  ');
      return redirect()->back()->with('message');
    }



//handels deleting a file, its comments and attachments 
public function delete($record_id, Request $request){
  if(Estelam::findOrFail($record_id)->first() != " " ) {  
    $file = Estelam::findOrFail($record_id);
    $deleted = new EstelamDeleted;

         

      /////////////////////////////////////////////

      $deleted->crida_number = $file->crida_number;
      $deleted->database_id = $file->id;
      $deleted->date_of_estelam =  $file->date_of_estelam;
      $deleted->date_of_archiving =  $file->date_of_archiving; 
      $deleted->date_of_sodor =  $file->date_of_sodor;   
      $deleted->add_of_sender =  $file->add_of_sender;
      $deleted->marja =  $file->marja; 
      $deleted->reyasat =   $file->reyasat; 
      $deleted->wozarat =   $file->wozarat; 
      $deleted->kholasmatlab =  $file->kholasmatlab;
      $deleted->asal =   $file->asal; 
      $deleted->zamema =  $file->zamema;
      $deleted->place =  $file->place;
      $deleted->taslemi =  $file->taslemi;
      $deleted->more = $file->more;        
      $deleted->file =  $file->file; 
      $deleted->uuid =  $file->uuid; 

    

      $del_comment = EstelamComment::where('estelam_id', $record_id);
      $del_access = EstelamUser::where('estelam_id',$record_id);
      $del_notis = Noti::where('file_id', $record_id);
 
      DB::beginTransaction();
        try {
          $deleted->save();
              //to delete its comments

            //to move a file in the (deleted) folder
            if(file_exists(storage_path('app/files/Estelam/'. $file->file))){  
              $old = storage_path('app/files/Estelam/'. $file->file);
              $new = storage_path('app/deleted/Estelam/'. $file->file);
              $move = File::move($old, $new);
            }

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




    //show accessed data for user in the home_sadera blade
    public function index(Request $request){

        $user = Auth::user();
        $user = $user->estelams;
        return view('Estelam.home_estelam',compact('user'));
    }

}
