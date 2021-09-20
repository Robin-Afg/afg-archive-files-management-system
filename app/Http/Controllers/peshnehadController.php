<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peshnehad;
use App\Models\PeshnehadComment;
use App\Models\PeshnehadUser;
use App\Models\Noti;
use Webpatser\Uuid\Uuid;
use Auth;
use Carbon\Carbon;
use Verta;
use Helper;
use DB;
use App\Models\PeshnehadDeleted;
use File;

class peshnehadController extends Controller
{
         
//to show warada blade panel
public function index_peshnehad(Request $request){
    
    $peshnehad = Peshnehad::with('authorizedUsers')->take(100);
    
        if ($request->end_date && $request->start_date) {                
            $start_date =  Helper::hejri_to_gr($request->start_date);                 
            $end_date =  Helper::hejri_to_gr($request->end_date);

            $peshnehad = Peshnehad::where('date_of_archiving', '>=', $start_date );
            $peshnehad = $peshnehad->where('date_of_archiving', '<=',$end_date); 
        }

        if ($request->start_date && !$request->end_date) {                                      
            if($request->start_date == Helper::current_year_full()){
              $peshnehad = Peshnehad::whereYear('date_of_archiving', '=', date('Y'));
            }
        }
        
        $peshnehad = $peshnehad->get()->sortByDesc('id'); 

        return view('Peshnehad.panel_peshnehad', compact('peshnehad'));

  }

  
    
// to add a sadera page  
public function add(){
  $last_id = Peshnehad::orderBy('id', 'desc')->first();
      
        if($last_id == null){
            $last_id = 1;
            } else {
                $last_id =  Helper::extract_number($last_id->crida_number) + 1 ;
        }

  return view('Peshnehad.add_peshnehad',compact('last_id'));

}
             


public function store(Request $request){

    
    $this->validate($request,[
                
                'crida_number' => 'required|Numeric',
                'date_of_peshnehad' => 'required',
                'date_of_archiving' => 'required',
                'add_of_peshnehader' => 'required',
                'to' =>  'required',
                'kholasmatlab' => 'required',
                'asal' => 'required',
                'copy' => 'required',
                'zamema' => 'required',
                'taslemi' => 'required',
                'file' => 'mimes:pdf|required|max:2048000',
            ],

            [
            'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
            'date_of_peshnehad.required' => 'تاریخ پیشنهاد باید موجود باشد   ',
            'date_of_archiving.required' => 'تاریخ ثبت پیشنهاد باید موجود باشد   ',
            'add_of_peshnehader.required' => 'آدرس پیشنهاد کننده باید موجود باشد   ',
            'to.required' => 'ارسال به شعبه مربوطه باید موجود باشد   ',
            'kholasmatlab.required' => 'خلص مطلب باید موجود باشد   ',
            'asal.required' => 'اصل باید موجود باشد   ',
            'copy.required' => 'کاپی باید موجود باشد   ',
            'zamema.required' => 'ضمیمه باید موجود باشد   ',
            'taslemi.required' => 'تسلیمی باید موجود باشد   ',
            'file.required' => 'فایل باید موجود باشد   ',
            'file.mimes' => 'فایل باید پی دی اف باشد   ',
            ]);

    $request->crida_number = Helper::format_number($request->date_of_archiving, $request->crida_number); 
      
    if(Peshnehad::where('crida_number',  $request->crida_number)->first() || Peshnehad::where('crida_number',  $request->crida_number)->first() ){
      $request->session()->flash('alert-danger', '  فایلی با این نمبر موجود است   ');
      return redirect()->back()->withInput();
    }else{ 
    
        $peshnehad = new Peshnehad;
   
                  //handle file uploading ---
                    if($request->hasFile('file')){  
                          $file_name = $request->file('file')->getClientOriginalName();
                              //get just filename
                          $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
                              // get just name extention
                          $ext = $request->file('file')->getClientOriginalExtension();
                              // filename to store
                          $file_name_st = $only_name.'_'.time().'.'.$ext;
                        
                          $request->file->storeAs('files/Peshnehad',$file_name_st);
                  }else{
                            $file_name_st = 'nofile';
                  }

//real storing happens here 

      $peshnehad->crida_number =  $request->crida_number;      
      $peshnehad->date_of_peshnehad =  Helper::hejri_to_gr($request->date_of_peshnehad);
      $peshnehad->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
      $peshnehad->add_of_peshnehader =  $request->add_of_peshnehader; 
      $peshnehad->to =  $request->to;  
      $peshnehad->kholasmatlab =   $request->kholasmatlab;  
      $peshnehad->asal =   $request->asal; 
      $peshnehad->copy =   $request->copy; 
      $peshnehad->zamema =  $request->zamema;
      $peshnehad->taslemi =  $request->taslemi; 
      $peshnehad->more =  $request->more; 
      //setting file name and generating uuid
      $peshnehad->file = $file_name_st;
      $peshnehad->uuid = (string)Uuid::generate();

        DB::transaction(function() use ($peshnehad) {
        
                $peshnehad->save();
                //safe saving a file using db transaction
        });

        $request->session()->flash('alert-success', ' موفقانه اضافه گردید ! مکتوب شماره ' . $request->crida_number);

        if($request->has('save_and_new')){
            return redirect("add_peshnehad");
        } else {
            return redirect("panel_peshnehad");
        } 
      


    }
 }



 public function show_file($file) {
  $file = Peshnehad::with('comments')->with('authorizedUsers')->findOrFail($file); 
  return view('Peshnehad.show_peshnehad',compact('file'));

}




  //handeling downloads
  public function download($uuid){
    $file = Peshnehad::where('uuid', $uuid)->firstOrFail();
    
    if(file_exists(storage_path('app/files/Peshnehad/'. $file->file))){
       $path = storage_path('app/files/Peshnehad/'. $file->file);
       return response()->download($path);
    }else {
      return response()->json(['result' => 'failed']);
    }
  
  }





// to show the  edit blade  ////////////////////////////////
public function show_edit($record_id){
  $file = Peshnehad::findOrFail($record_id);  
  $crida_number = Helper::extract_number($file->crida_number); 
  return view('Peshnehad.edit_peshnehad',compact('file','crida_number'));
 }



// to actuallay update a file 

public function edit(Request $request, $record_id ){

   
  $this->validate($request,[
                
    'crida_number' => 'required|Numeric',
    'date_of_peshnehad' => 'required',
    'date_of_archiving' => 'required',
    'add_of_peshnehader' => 'required',
    'to' =>  'required',
    'kholasmatlab' => 'required',
    'asal' => 'required',
    // 'copy' => 'required',
    // 'zamema' => 'required',
    'taslemi' => 'required',
    'file' => 'mimes:pdf|max:2048000',
  
],

[
'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
'date_of_peshnehad.required' => 'تاریخ پیشنهاد باید موجود باشد   ',
'date_of_archiving.required' => 'تاریخ ثبت پیشنهاد باید موجود باشد   ',
'add_of_peshnehader.required' => 'آدرس پیشنهاد کننده باید موجود باشد   ',
'to.required' => 'ارسال به شعبه مربوطه باید موجود باشد   ',
'kholasmatlab.required' => 'خلص مطلب باید موجود باشد   ',
'asal.required' => 'اصل باید موجود باشد   ',
// 'copy.required' => 'کاپی باید موجود باشد   ',
// 'zamema.required' => 'ضمیمه باید موجود باشد   ',
'taslemi.required' => 'تسلیمی باید موجود باشد   ',
'file.mimes' => 'فایل باید پی دی اف باشد   ',

]);


$request->crida_number = Helper::format_number($request->date_of_archiving,$request->crida_number); 

$peshnehad = Peshnehad::findOrFail($record_id);    

    if($request->crida_number != $peshnehad->crida_number ){
      
        if (Peshnehad::where('crida_number',$request->crida_number)->first() == "") {
            $peshnehad->crida_number =  $request->crida_number;
        }else{
          $request->session()->flash('alert-danger', '  سندی با نمبر '. $request->crida_number . '  موجود است ');
          return redirect()->back()->withInput();
        }
      }
        
      

          //handle file upload ***********************************
     if($request->hasFile('file')){      
      
      $old = storage_path('app/files/Peshnehad/'. $peshnehad->file);
       if(file_exists($old)){  
        $old = storage_path('app/files/Peshnehad/'. $peshnehad->file);
        $new = storage_path('app/edited/Peshnehad/'. $peshnehad->file);
        $move = File::move($old, $new);
        }

       $file_name = $request->file('file')->getClientOriginalName();
              //get just filename
       $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
          // get just name extention
       $ext = $request->file('file')->getClientOriginalExtension();
        // filename to store
       $file_name_st = $only_name.'_'.time().'.'.$ext;
  
         $request->file->storeAs('files/Peshnehad',$file_name_st);
                $peshnehad->file = $file_name_st;
      } else {
         $file_name_st = $peshnehad->file;
      }

      
        //Setting the properties
        $peshnehad->crida_number =  $request->crida_number;  
        $peshnehad->date_of_peshnehad =  Helper::hejri_to_gr($request->date_of_peshnehad);        
        $peshnehad->date_of_archiving =  Helper::hejri_to_gr($request->date_of_archiving);
        $peshnehad->add_of_peshnehader =  $request->add_of_peshnehader; 
        $peshnehad->to =  $request->to;   
        $peshnehad->kholasmatlab =  $request->kholasmatlab; 
        $peshnehad->asal =   $request->asal; 
        $peshnehad->copy =   $request->copy; 
        $peshnehad->zamema =  $request->zamema;
        $peshnehad->taslemi =  $request->taslemi;
        $peshnehad->more =  $request->more; 
       

        DB::transaction(function() use ($peshnehad) {
          //real storing happens here 
          $peshnehad->save();
        });
     
  $request->session()->flash('alert-info', ' موفقانه ویرایش گردید   ');
  return redirect()->route('panel_peshnehad');
       
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
          $comment = new PeshnehadComment;
          $comment->comment = $request->comment;
          $comment->peshnehad_id = $request->peshnehad_id;
          $comment->user_id = $user_id;

          DB::transaction(function() use ($comment) {
            $comment->save();
          });
          //to generate its notifications
          Helper::add_noti('Peshnehad',  $comment->id, $comment->peshnehad_id);
          $request->session()->flash('alert-success', ' اجرات شما افزوده شد ' );
          return redirect()->back();
   
   }




   
//handels that the user who posted can update his or her comment used in the view blade comment section of show_sadera blade
  public function editcomment(Request $request){
     
    if($request->user_id == Auth::user()->id){
        $comment =  PeshnehadComment::findOrFail($request->comment_id);
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
   $comment =  PeshnehadComment::findOrFail($record_id);
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




// access files and help you to see all the availble user files 
public function accessFile($id){       
    $file = Peshnehad::with('authorizedUsers')->findOrFail($id);
    return view('Peshnehad.access_peshnehad',compact('file'));

}


     
//granting access to specific users  handling post grant permision - -
public function grant(Request $request){
      
      if ($request->user_id != "") {
        foreach ($request->user_id as $val) 
             {
                  $c = new PeshnehadUser;
                  $c->peshnehad_id     = $request->peshnehad_id;
                    $c->user_id      = $val;
                    DB::transaction(function() use ($c) {
                       $c->save();
                    });
                  
                    Helper::add_noti_access('Peshnehad',  $c->user_id,  $c->peshnehad_id);
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
     
      $record = PeshnehadUser::findOrFail($record_id);
      $del_noti_access = Noti::where('noti_for', 1)->where('notifiable_id', $user_id)->where('type', 'peshnehad')->where('file_id',$record->peshnehad_id);
      DB::transaction(function() use ($record, $del_noti_access) {
        $record->delete();
        $del_noti_access->delete();
      });
        
      $request->session()->flash('alert-warning', ' دسترسی کاربر حذف شد  ');
      return redirect()->back()->with('message');
    }



//handels deleting a file, its comments and attachments 
public function delete($record_id, Request $request){
  if(Peshnehad::findOrFail($record_id)->first() != " " ) {  
    $file = Peshnehad::findOrFail($record_id);
    $deleted = new PeshnehadDeleted;

        
      /////////////////////////////////////////////

      $deleted->crida_number = $file->crida_number;
      $deleted->database_id = $file->id;
      $deleted->date_of_peshnehad =  $file->date_of_peshnehad;
      $deleted->date_of_archiving =  $file->date_of_archiving; 
      $deleted->add_of_peshnehader =  $file->add_of_peshnehader;   
      $deleted->to =  $file->to;
      $deleted->kholasmatlab =  $file->kholasmatlab; 
      $deleted->asal =   $file->asal; 
      $deleted->copy =   $file->copy; 
      $deleted->zamema =  $file->zamema;
      $deleted->taslemi =  $file->taslemi;
      $deleted->more = $file->more;        
      $deleted->file =  $file->file; 
      $deleted->uuid =  $file->uuid; 

      $del_comment = PeshnehadComment::where('peshnehad_id', $record_id);
      $del_access = PeshnehadUser::where('peshnehad_id',$record_id);
      $del_notis = Noti::where('file_id', $record_id);
 
      DB::beginTransaction();
        try {
          $deleted->save();

            //to move a file in the (deleted) folder
            if(file_exists(storage_path('app/files/Peshnehad/'. $file->file))){  
              $old = storage_path('app/files/Peshnehad/'. $file->file);
              $new = storage_path('app/deleted/Peshnehad/'. $file->file);
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




    //show accessed data for user in the home_sadera blade
    public function index(Request $request){
        $user = Auth::user();
        $user = $user->peshnehads;
        return view('Peshnehad.home_peshnehad',compact('user'));
    }




}
