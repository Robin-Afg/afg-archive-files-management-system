<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Saderamali;
use App\Models\SaderamaliComment;
use App\Models\SaderamaliUser;
use App\Models\SaderamaliDeleted;
use App\Models\Noti;
use Webpatser\Uuid\Uuid;
use Auth;
use Carbon\Carbon;
use Verta;
use Helper;
use DB;
use File;

class saderamaliController extends Controller
{
        //to show Saderamali blade panel
        public function index_saderamali(Request $request){

              $saderamali = Saderamali::with('authorizedUsers')->take(100);
          
              if ($request->end_date && $request->start_date) {                
                  $start_date =  Helper::hejri_to_gr($request->start_date);                 
                  $end_date =  Helper::hejri_to_gr($request->end_date);

                  $saderamali = Saderamali::where('date_of_archiving', '>=', $start_date );
                  $saderamali = $saderamali->where('date_of_archiving', '<=',$end_date); 
              }

              if ($request->start_date && !$request->end_date) {                                      
                  if($request->start_date == Helper::current_year_full()){
                    $saderamali = Saderamali::whereYear('date_of_archiving', '=', date('Y'));
                  }
              }
              
              $saderamali = $saderamali->get()->sortByDesc('id'); 

              return view('Saderamali.panel_saderamali', compact('saderamali'));
        
        }
    
      
        
        // to add a Saderamali page  
        public function add(){
        $last_id = Saderamali::orderBy('id', 'desc')->first();
            
                if($last_id == null){
                    $last_id = 1;
                } else {
                    $last_id =  Helper::extract_number($last_id->crida_number) + 1 ;
                }
    
        return view('Saderamali.add_saderamali',compact('last_id'));
    
        }
                 
    
        // for storing the saderamali file
        public function store(Request $request){
    
        
            $this->validate($request,[
                        
                    'crida_number' => 'required|Numeric',
                    'date_of_archiving' => 'required',
                    'date_of_sodor' => 'required',
                    'mursal' => 'required',
                    'mursal_alia' => 'required',
                    'kholasmatlab' =>  'required',
                    'asal' =>  'required',
                   // 'copy' =>  'required',
                   // 'zamema' =>  'required',
                   // 'num_of_dosia' =>  'required',
                  //  'number_of_archive' =>  'required',
                    'place' =>  'required',
                    'file' => 'required|mimes:pdf|max:2048000',
                    ],
    
                    [
                    'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
                    'crida_number.Numeric' => 'نمبر مسلسل باید عدد باشد   ',  
                    'date_of_archiving.required' => 'تاریخ ثبت باید موجود باشد   ',
                    'date_of_sodor.required' => 'تاریخ صدور باید موجود باشد   ',
                    'mursal.required' => ' مرسل باید موجود باشد   ',
                    'mursal_alia.required' => ' مرسل الیه باید موجود باشد   ',
                    'asal.required' => ' اصل  باید موجود باشد   ',
                    'kholasmatlab.required' => 'خلص موضوع باید موجود باشد   ',
                    'place.required' => 'محل باید موجود باشد   ',
                    'file.required' => 'فایل باید موجود باشد   ',
                    'file.max' => 'اندازه فایل شما نباید از 200 ام بی تجاوز کند     ',
                    ]);
    
            $request->crida_number = Helper::format_number($request->date_of_archiving, $request->crida_number); 
            
            if(Saderamali::where('crida_number',  $request->crida_number)->first() || Saderamali::where('crida_number',  $request->crida_number)->first() ){
            $request->session()->flash('alert-danger', '  فایلی با این نمبر موجود است   ');
            return redirect()->back()->withInput();
            }else{ 
            
                $saderamali = new Saderamali;
        
                        //handle file uploading ---
                            if($request->hasFile('file')){  
                                $file_name = $request->file('file')->getClientOriginalName();
                                    //get just filename
                                $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
                                    // get just name extention
                                $ext = $request->file('file')->getClientOriginalExtension();
                                    // filename to store
                                $file_name_st = $only_name.'_'.time().'.'.$ext;
                                
                                $request->file->storeAs('files/Saderamali',$file_name_st);
                        }else{
                                    $file_name_st = 'nofile';
                        }
    
            //real storing happens here 
    
            $saderamali->crida_number =  $request->crida_number;      
            $saderamali->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
            $saderamali->date_of_sodor =  Helper::hejri_to_gr($request->date_of_sodor); 
            $saderamali->mursal =  $request->mursal; 
            $saderamali->mursal_alia =  $request->mursal_alia;  
            $saderamali->kholasmatlab =   $request->kholasmatlab; 
            $saderamali->asal =   $request->asal; 
            $saderamali->copy =   $request->copy; 
            $saderamali->zamema =   $request->zamema; 
            $saderamali->place =   $request->place; 
            $saderamali->num_of_dosia =  $request->num_of_dosia;  
            $saderamali->number_of_archive =  $request->number_of_archive;  
            $saderamali->more =  $request->more; 
            //setting file name and generating uuid
            $saderamali->file = $file_name_st;
            $saderamali->uuid = (string)Uuid::generate();
            DB::transaction(function() use ($saderamali) {
                $saderamali->save();
                //safe saving a file using db transaction
            });
    
                $request->session()->flash('alert-success', ' موفقانه اضافه گردید ! مکتوب شماره ' . $request->crida_number);
    
                if($request->has('save_and_new')){
                    return redirect("add_saderamali");
                } else {
                    return redirect("panel_saderamali");
                } 
            
    
    
            }
        }
    
    
    // to show a specific record in view blade
     public function show_file($file) {
      $file = Saderamali::with('comments')->with('authorizedUsers')->findOrFail($file); 
      return view('Saderamali.show_saderamali',compact('file'));
    
      }
    
    
    
      //handeling downloads
      public function download($uuid){
        $file = Saderamali::where('uuid', $uuid)->firstOrFail();
        if(file_exists(storage_path('app/files/Saderamali/'. $file->file))){
           $path = storage_path('app/files/Saderamali/'. $file->file);
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
            $comment = new SaderamaliComment;
            $comment->comment = $request->comment;
            $comment->saderamali_id = $request->saderamali_id;
            $comment->user_id = $user_id;
            DB::transaction(function() use ($comment) {
              $comment->save();
            });
            //to generate its notifications
            Helper::add_noti('Saderamali',  $comment->id, $comment->saderamali_id);
            $request->session()->flash('alert-success', ' اجرات شما افزوده شد ' );
            return redirect()->back();
     
     }
    
    
    
    
     
    //handels that the user who posted can update his or her comment used in the view blade comment section of show blade
    public function editcomment(Request $request){
       
      if($request->user_id == Auth::user()->id){
          $comment =  SaderamaliComment::findOrFail($request->comment_id);
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
            $comment =  SaderamaliComment::findOrFail($record_id);
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
      $file = Saderamali::findOrFail($record_id);  
      return view('Saderamali.edit_saderamali',compact('file'));
     }
    
    
    
    // to actuallay update a file 
    
    public function edit(Request $request, $record_id ){
    
            $this->validate($request,[
              'crida_number' => 'required|Numeric',
              'date_of_archiving' => 'required',
              'date_of_sodor' => 'required',
              'mursal' => 'required',
              'mursal_alia' => 'required',
              'kholasmatlab' =>  'required',
              'asal' =>  'required',
             // 'copy' =>  'required',
             // 'zamema' =>  'required',
             // 'num_of_dosia' =>  'required',
            //  'number_of_archive' =>  'required',
              // 'place' =>  'required',
              'file' => 'mimes:pdf|max:2048000',
        
              ],

              [
              'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
              'crida_number.Numeric' => 'نمبر مسلسل باید عدد باشد   ',  
              'date_of_archiving.required' => 'تاریخ ثبت باید موجود باشد   ',
              'date_of_sodor.required' => 'تاریخ صدور باید موجود باشد   ',
              'mursal.required' => ' مرسل باید موجود باشد   ',
              'mursal_alia.required' => ' مرسل الیه باید موجود باشد   ',
              'asal.required' => ' اصل  باید موجود باشد   ',
              'kholasmatlab.required' => 'خلص موضوع باید موجود باشد   ',
             // 'place.required' => 'محل باید موجود باشد   ',
             'file.mimes' => 'فایل باید پی دی اف باشد   ',
            
          
          ]);
    
      $request->crida_number = Helper::format_number($request->date_of_archiving, $request->crida_number); 
      $saderamali = Saderamali::findOrFail($record_id);    
    
        if($request->crida_number != $saderamali->crida_number ){
          
            if (Saderamali::where('crida_number',$request->crida_number)->first() == "") {
                $saderamali->crida_number =  $request->crida_number;
            }else{
              $request->session()->flash('alert-danger', '  سندی با نمبر '. $request->crida_number . '  موجود است ');
              return redirect()->back()->withInput();
            }
        }
            
          
    
              //handle file upload ***********************************
         if($request->hasFile('file')){      
          
          $old = storage_path('app/files/Saderamali/'. $saderamali->file);
           if(file_exists($old)){  
            $old = storage_path('app/files/Saderamali/'. $saderamali->file);
            $new = storage_path('app/edited/Saderamali/'. $saderamali->file);
            $move = File::move($old, $new);
            }
    
           $file_name = $request->file('file')->getClientOriginalName();
                  //get just filename
           $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
              // get just name extention
           $ext = $request->file('file')->getClientOriginalExtension();
            // filename to store
           $file_name_st = $only_name.'_'.time().'.'.$ext;
      
             $request->file->storeAs('files/Saderamali',$file_name_st);
                    $saderamali->file = $file_name_st;
          } else {
             $file_name_st = $saderamali->file;
          }
          

            //real storing happens here   
            $saderamali->crida_number =  $request->crida_number;      
            $saderamali->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
            $saderamali->date_of_sodor =  Helper::hejri_to_gr($request->date_of_sodor); 
            $saderamali->mursal =  $request->mursal; 
            $saderamali->mursal_alia =  $request->mursal_alia;  
            $saderamali->kholasmatlab =   $request->kholasmatlab; 
            $saderamali->asal =   $request->asal; 
            $saderamali->copy =   $request->copy; 
            $saderamali->zamema =   $request->zamema; 
            $saderamali->place =   $request->place; 
            $saderamali->num_of_dosia =  $request->num_of_dosia;  
            $saderamali->number_of_archive =  $request->number_of_archive;  
            $saderamali->more =  $request->more;    
    
            DB::transaction(function() use ($saderamali) {
              //real storing happens here 
              $saderamali->save();
            });
         
      $request->session()->flash('alert-info', ' موفقانه ویرایش گردید   ');
      return redirect()->route('panel_saderamali');
           
     }
    
    
    
    
    
    
    
    
    // access files and help you to see all the availble user files 
    public function accessFile($id){       
        $file = Saderamali::with('authorizedUsers')->findOrFail($id);
        return view('Saderamali.access_saderamali',compact('file'));
    
    }
    
    
         
    //granting access to specific users  handling post grant permision - used in access blade
    public function grant(Request $request){
          
          if ($request->user_id != "") {
            foreach ($request->user_id as $val) 
                 {
                      $c = new SaderamaliUser;
                      $c->saderamali_id     = $request->saderamali_id;
                        $c->user_id      = $val;
                        DB::transaction(function() use ($c) {
                           $c->save();
                        });
                        Helper::add_noti_access('Saderamali',  $c->user_id,  $c->saderamali_id);
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
         
          $record = SaderamaliUser::findOrFail($record_id);
          $del_noti_access = Noti::where('noti_for', 1)->where('notifiable_id', $user_id)->where('type', 'saderamali')->where('file_id',$record->saderamali_id);
          DB::transaction(function() use ($record,$del_noti_access) {
            $record->delete();
            $del_noti_access->delete();
          });
            
          $request->session()->flash('alert-warning', ' دسترسی کاربر حذف شد  ');
          return redirect()->back()->with('message');
        }
    
    
    
    //handels deleting a file, its comments and attachments 
    public function delete($record_id, Request $request){
      if(Saderamali::findOrFail($record_id)->first() != " " ) {  
        $file = Saderamali::findOrFail($record_id);
        $deleted = new SaderamaliDeleted;
          
    
          //////////////////////////////////////////////
          $deleted->crida_number = $file->crida_number;
          $deleted->database_id = $file->id;
          $deleted->date_of_archiving =  $file->date_of_archiving; 
          $deleted->date_of_sodor =  $file->date_of_sodor;  
          $deleted->mursal =  $file->mursal;
          $deleted->mursal_alia =  $file->mursal_alia;
          $deleted->kholasmatlab =  $file->kholasmatlab;
          $deleted->asal =  $file->asal;
          $deleted->copy =  $file->copy;
          $deleted->zamema =  $file->zamema;
          $deleted->place =  $file->place;
          $deleted->num_of_dosia =  $file->num_of_dosia;
          $deleted->number_of_archive =  $file->number_of_archive;
          $deleted->more =   $file->more; 
          $deleted->file =   $file->file; 
          $deleted->uuid =  $file->uuid; 
        
    
          $del_comment = SaderamaliComment::where('saderamali_id', $record_id);
          $del_access = SaderamaliUser::where('saderamali_id',$record_id);
          $del_notis = Noti::where('file_id', $record_id);
     
          DB::beginTransaction();
            try {
              $deleted->save();

                //to move a file in the (deleted) folder
                if(file_exists(storage_path('app/files/Saderamali/'. $file->file))){  
                  $old = storage_path('app/files/Saderamali/'. $file->file);
                  $new = storage_path('app/deleted/Saderamali/'. $file->file);
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
            $user = $user->saderamalis;
            return view('Saderamali.home_saderamali',compact('user'));
        }
}
