<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Ahkam;
use App\Models\AhkamComment;
use App\Models\AhkamUser;
use App\Models\AhkamDeleted;
use App\Models\Noti;
use Webpatser\Uuid\Uuid;
use Auth;
use Carbon\Carbon;
use Verta;
use Helper;
use DB;
use File;

class ahkamController extends Controller
{
    //to show Ahkam blade panel
    public function index_ahkam(Request $request){
        
        $ahkam = Ahkam::with('authorizedUsers')->take(100);
    
        if ($request->end_date && $request->start_date) {                
            $start_date =  Helper::hejri_to_gr($request->start_date);                 
            $end_date =  Helper::hejri_to_gr($request->end_date);

            $ahkam = Ahkam::where('date_of_archiving', '>=', $start_date );
            $ahkam = $ahkam->where('date_of_archiving', '<=',$end_date); 
        }

        if ($request->start_date && !$request->end_date) {                                      
            if($request->start_date == Helper::current_year_full()){
              $ahkam = Ahkam::whereYear('date_of_archiving', '=', date('Y'));
            }
        }
        
        $ahkam = $ahkam->get()->sortByDesc('id'); 

        return view('Ahkam.panel_ahkam', compact('ahkam'));

        
    
    }

  
    
    // to add a ahkam page  
    public function add(){
     $last_id = Ahkam::orderBy('id', 'desc')->first();
        
            if($last_id == null){
                $last_id = 1;
            } else {
                $last_id =  Helper::extract_number($last_id->crida_number) + 1 ;
            }

      return view('Ahkam.add_ahkam',compact('last_id'));

    }
             

    // for storing the ahkam file
    public function store(Request $request){

    
        $this->validate($request,[
                    
                'crida_number' => 'required|Numeric',
                'date_of_archiving' => 'required',
                'type_of_document' => 'required',
                'number_of_document' => 'required',
                'date_of_document' =>  'required',
                'kholasmatlab' =>  'required',
                'molahezat' =>  'required',
                'file' => 'required|mimes:pdf|max:2048000',
                ],

                [
                'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
                'crida_number.Numeric' => 'نمبر مسلسل باید عدد باشد   ',  
                'date_of_archiving.required' => 'تاریخ ثبت باید موجود باشد   ',
                'type_of_document.required' => 'نوعیت سند باید موجود باشد   ',
                'number_of_document.required' => 'نمبر سند باید موجود باشد   ',
                'date_of_document.required' => ' تاریخ سند باید موجود باشد   ',
                'kholasmatlab.required' => 'خلص موضوع باید موجود باشد   ',
                'molahezat.required' => 'ملاحظات باید موجود باشد   ',
                'file.required' => 'فایل باید موجود باشد   ',
                'file.mimes' => 'فایل باید پی دی اف باشد   ',
                ]);

        $request->crida_number = Helper::format_number($request->date_of_archiving, $request->crida_number); 
        
        if(Ahkam::where('crida_number',  $request->crida_number)->first() || Ahkam::where('crida_number',  $request->crida_number)->first() ){
        $request->session()->flash('alert-danger', '  فایلی با این نمبر موجود است   ');
        return redirect()->back()->withInput();
        }else{ 
        
            $ahkam = new Ahkam;
    
                    //handle file uploading ---
                        if($request->hasFile('file')){  
                            $file_name = $request->file('file')->getClientOriginalName();
                                //get just filename
                            $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
                                // get just name extention
                            $ext = $request->file('file')->getClientOriginalExtension();
                                // filename to store
                            $file_name_st = $only_name.'_'.time().'.'.$ext;
                            
                            $request->file->storeAs('files/Ahkam',$file_name_st);
                    }else{
                                $file_name_st = 'nofile';
                    }

        //real storing happens here 

        $ahkam->crida_number =  $request->crida_number;      
        $ahkam->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
        $ahkam->type_of_document =  $request->type_of_document; 
        $ahkam->number_of_document =  $request->number_of_document;  
        $ahkam->date_of_document =  Helper::hejri_to_gr($request->date_of_document);  
        $ahkam->kholasmatlab =   $request->kholasmatlab; 
        $ahkam->molahezat =  $request->molahezat;  
        $ahkam->more =  $request->more; 
        //setting file name and generating uuid
        $ahkam->file = $file_name_st;
        $ahkam->uuid = (string)Uuid::generate();
        DB::transaction(function() use ($ahkam) {
            $ahkam->save();
            //safe saving a file using db transaction
        });

      

            $request->session()->flash('alert-success', ' موفقانه اضافه گردید ! مکتوب شماره ' . $request->crida_number);

            if($request->has('save_and_new')){
                return redirect("add_ahkam");
            } else {
                return redirect("panel_ahkam");
            } 
        


        }
    }


// to show a specific record in view blade
 public function show_file($file) {
  $file = Ahkam::with('comments')->with('authorizedUsers')->findOrFail($file); 
  return view('Ahkam.show_ahkam',compact('file'));

  }



  //handeling downloads
  public function download($uuid){
    $file = Ahkam::where('uuid', $uuid)->firstOrFail();
    if(file_exists(storage_path('app/files/Ahkam/'. $file->file))){
       $path = storage_path('app/files/Ahkam/'. $file->file);
       return response()->download($path);
    }else {
      return response()->json(['result' => 'failed']);
    }
  
  }

  

  //to add comment for both admin and user
  Public function addComment(Request $request){
    // return $id;

    $this->validate($request,[   
      'comment' => 'required',   
      ],

      [
      'comment.required' => ' اجرات خود را بنویسید   ',
      ]);

        $user_id = Auth::user()->id;
        $comment = new AhkamComment;
        $comment->comment = $request->comment;
        $comment->ahkam_id = $request->ahkam_id;
        $comment->user_id = $user_id;
        DB::transaction(function() use ($comment) {
          $comment->save();
        });
        //to generate its notifications
        Helper::add_noti('Ahkam',  $comment->id, $comment->ahkam_id);
        $request->session()->flash('alert-success', ' اجرات شما افزوده شد ' );
        return redirect()->back();
 
 }




 
//handels that the user who posted can update his or her comment used in the view blade comment section of show blade
public function editcomment(Request $request){
   
  if($request->user_id == Auth::user()->id){
      $comment =  AhkamComment::findOrFail($request->comment_id);
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
        $comment =  AhkamComment::findOrFail($record_id);
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

// to show edit blade
public function show_edit($record_id){
  $file = Ahkam::findOrFail($record_id);  
  return view('Ahkam.edit_ahkam',compact('file'));
 }



// to actuallay update a file 

public function edit(Request $request, $record_id ){

        $this->validate($request,[
                          
          'crida_number' => 'required|Numeric',
          'date_of_archiving' => 'required',
          'type_of_document' => 'required',
          'number_of_document' => 'required',
          'date_of_document' =>  'required',
          'kholasmatlab' =>  'required',
          'molahezat' =>  'required',
          'file' => 'mimes:pdf|size:2048000',
       
      ],

      [
      'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
      'crida_number.Numeric' => 'نمبر مسلسل باید عدد باشد   ',  
      'date_of_archiving.required' => 'تاریخ ثبت باید موجود باشد   ',
      'type_of_document.required' => 'نوعیت سند باید موجود باشد   ',
      'number_of_document.required' => 'نمبر سند باید موجود باشد   ',
      'date_of_document.required' => ' تاریخ سند باید موجود باشد   ',
      'kholasmatlab.required' => 'خلص موضوع باید موجود باشد   ',
      'molahezat.required' => 'ملاحظات باید موجود باشد   ',
      'file.mimes' => 'فایل باید پی دی اف باشد   ',
      
      ]);

  $request->crida_number = Helper::format_number($request->date_of_archiving,$request->crida_number); 
  $ahkam = Ahkam::findOrFail($record_id);    

    if($request->crida_number != $ahkam->crida_number ){
      
        if (Ahkam::where('crida_number',$request->crida_number)->first() == "") {
            $ahkam->crida_number =  $request->crida_number;
        }else{
          $request->session()->flash('alert-danger', '  سندی با نمبر '. $request->crida_number . '  موجود است ');
          return redirect()->back()->withInput();
        }
    }
        
      

          //handle file upload ***********************************
     if($request->hasFile('file')){      
      
      $old = storage_path('app/files/Ahkam/'. $ahkam->file);
       if(file_exists($old)){  
        $old = storage_path('app/files/Ahkam/'. $ahkam->file);
        $new = storage_path('app/edited/Ahkam/'. $ahkam->file);
        $move = File::move($old, $new);
        }

       $file_name = $request->file('file')->getClientOriginalName();
              //get just filename
       $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
          // get just name extention
       $ext = $request->file('file')->getClientOriginalExtension();
        // filename to store
       $file_name_st = $only_name.'_'.time().'.'.$ext;
  
         $request->file->storeAs('files/Ahkam',$file_name_st);
                $ahkam->file = $file_name_st;
      } else {
         $file_name_st = $ahkam->file;
      }

      
     
        //real storing happens here 

        $ahkam->crida_number =  $request->crida_number;      
        $ahkam->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
        $ahkam->type_of_document =  $request->type_of_document; 
        $ahkam->number_of_document =  $request->number_of_document;  
        $ahkam->date_of_document =  Helper::hejri_to_gr($request->date_of_document);  
        $ahkam->kholasmatlab =   $request->kholasmatlab; 
        $ahkam->molahezat =  $request->molahezat;  
        $ahkam->more =  $request->more; 
    
 

        DB::transaction(function() use ($ahkam) {
          //real storing happens here 
          $ahkam->save();
        });
     
  $request->session()->flash('alert-info', ' موفقانه ویرایش گردید   ');
  return redirect()->route('panel_ahkam');
       
 }








// access files and help you to see all the availble user files 
public function accessFile($id){       
    $file = Ahkam::with('authorizedUsers')->findOrFail($id);
    return view('Ahkam.access_ahkam',compact('file'));

}


     
//granting access to specific users  handling post grant permision - used in access blade
public function grant(Request $request){
      
      if ($request->user_id != "") {
        foreach ($request->user_id as $val) 
             {
                  $c = new AhkamUser;
                  $c->ahkam_id     = $request->ahkam_id;
                    $c->user_id      = $val;
                    DB::transaction(function() use ($c) {
                       $c->save();
                    });
                    Helper::add_noti_access('Ahkam',  $c->user_id,  $c->ahkam_id);
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
     
      $record = AhkamUser::findOrFail($record_id);
      $del_noti_access = Noti::where('noti_for', 1)->where('notifiable_id', $user_id)->where('type', 'ahkam')->where('file_id',$record->ahkam_id);
      DB::transaction(function() use ($record,$del_noti_access) {
        $record->delete();
        $del_noti_access->delete();
      });
        
      $request->session()->flash('alert-warning', ' دسترسی کاربر حذف شد  ');
      return redirect()->back()->with('message');
    }



//handels deleting a file, its comments and attachments 
public function delete($record_id, Request $request){
  if(Ahkam::findOrFail($record_id)->first() != " " ) {  
    $file = Ahkam::findOrFail($record_id);
    $deleted = new AhkamDeleted;

          
      /////////////////////////////////////////////


      $deleted->crida_number = $file->crida_number;
      $deleted->database_id = $file->id;
      $deleted->date_of_archiving =  $file->date_of_archiving; 
      $deleted->type_of_document =  $file->type_of_document;  
      $deleted->number_of_document =  $file->number_of_document;
      $deleted->date_of_document =  $file->date_of_document; 
      $deleted->kholasmatlab =  $file->kholasmatlab;
      $deleted->molahezat =   $file->molahezat; 
      $deleted->more =   $file->more; 
      $deleted->file =   $file->file; 
      $deleted->uuid =  $file->uuid; 


      $del_comment = AhkamComment::where('ahkam_id', $record_id);
      $del_access = AhkamUser::where('ahkam_id',$record_id);
      $del_notis = Noti::where('file_id', $record_id);
 
      DB::beginTransaction();
        try {
          $deleted->save();

            //to move a file in the (deleted) folder
            if(file_exists(storage_path('app/files/Ahkam/'. $file->file))){  
              $old = storage_path('app/files/Ahkam/'. $file->file);
              $new = storage_path('app/deleted/Ahkam/'. $file->file);
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




    //show accessed data for user in the home blade
    public function index(Request $request){
        $user = Auth::user();
        $user = $user->ahkams;
        return view('Ahkam.home_ahkam',compact('user'));
    }

}
