<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TReport;
use App\Models\TReportComment;
use App\Models\TReportUser;
use App\Models\TReportDeleted;
use App\Models\Noti;
use Webpatser\Uuid\Uuid;
use Auth;
use Carbon\Carbon;
use Verta;
use Helper;
use DB;
use File;


class reportController extends Controller
{
      //to show Ahkam blade panel
      public function index_report(Request $request){
      
        $report = TReport::with('authorizedUsers')->take(100);
    
        if ($request->end_date && $request->start_date) {                
            $start_date =  Helper::hejri_to_gr($request->start_date);                 
            $end_date =  Helper::hejri_to_gr($request->end_date);

            $report = TReport::where('date_of_archiving', '>=', $start_date );
            $report = $report->where('date_of_archiving', '<=',$end_date); 
        }

        if ($request->start_date && !$request->end_date) {                                      
            if($request->start_date == Helper::current_year_full()){
              $report = TReport::whereYear('date_of_archiving', '=', date('Y'));
            }
        }
        
        $report = $report->get()->sortByDesc('id'); 

        return view('Report.panel_report', compact('report'));

    }

  
    
    // to add a ahkam page  
    public function add(){
    $last_id = TReport::orderBy('id', 'desc')->first();
        
            if($last_id == null){
                $last_id = 1;
            } else {
                $last_id =  Helper::extract_number($last_id->crida_number) + 1 ;
            }

    return view('Report.add_report',compact('last_id'));

    }
             

    // for storing the ahkam file
    public function store(Request $request){

    
        $this->validate($request,[
                    
                'crida_number' => 'required|Numeric',
                'date_of_archiving' => 'required',
                'report_num' => 'required',
                'place' =>  'required',
                'kholasmatlab' =>  'required',
                'author' => 'required',               
                'file' => 'required|mimes:pdf|max:2048000',
                ],

                [
                'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
                'crida_number.Numeric' => 'نمبر مسلسل باید عدد باشد   ',  
                'date_of_archiving.required' => 'تاریخ ثبت باید موجود باشد   ',
                'report_num.required' => 'شماره تفصیلی گزارش باید موجود باشد   ',
                'place.required' => 'محل نگهداری باید موجود باشد   ',
                'kholasmatlab.required' => 'خلص موضوع باید موجود باشد   ',
                'author.required' => 'مولف گزارش باید موجود باشد',
                'file.required' => 'فایل باید موجود باشد   ',
                'file.max' => 'اندازه فایل شما نباید از 200 ام بی تجاوز کند     ',
                'file.mimes' => 'فایل باید پی دی اف باشد   ',
                ]);

        $request->crida_number = Helper::format_number($request->date_of_archiving, $request->crida_number); 
        
        if(TReport::where('crida_number',  $request->crida_number)->first() || TReport::where('crida_number',  $request->crida_number)->first() ){
        $request->session()->flash('alert-danger', '  مکتوبی با این نمبر موجود است   ');
        return redirect()->back()->withInput();
        }else{ 
        
            $report = new TReport;
    
                    //handle file uploading ---
                        if($request->hasFile('file')){  
                            $file_name = $request->file('file')->getClientOriginalName();
                                //get just filename
                            $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
                                // get just name extention
                            $ext = $request->file('file')->getClientOriginalExtension();
                                // filename to store
                            $file_name_st = $only_name.'_'.time().'.'.$ext;
                            
                            $request->file->storeAs('files/Report',$file_name_st);
                    }else{
                                $file_name_st = 'nofile';
                    }

        //real storing happens here 

        $report->crida_number =  $request->crida_number;      
        $report->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
        $report->report_num =  $request->report_num; 
        $report->author =  $request->author; 
        $report->year =  Helper::hejri_to_gr($request->year);  
        $report->kholasmatlab =   $request->kholasmatlab; 
        $report->revised_num =  $request->revised_num;  
        $report->place =  $request->place; 
        $report->more =  $request->more; 
        //setting file name and generating uuid
        $report->file = $file_name_st;
        $report->uuid = (string)Uuid::generate();
        DB::transaction(function() use ($report) {
            $report->save();
            //safe saving a file using db transaction
        });


            $request->session()->flash('alert-success', ' موفقانه اضافه گردید ! مکتوب شماره ' . $request->crida_number);

            if($request->has('save_and_new')){
                return redirect("add_report");
            } else {
                return redirect("panel_report");
            } 
        


        }
    }


// to show a specific record in view blade
 public function show_file($file) {
  $file = TReport::with('comments')->with('authorizedUsers')->findOrFail($file); 
  return view('Report.show_report',compact('file'));

  }



  //handeling downloads
  public function download($uuid){
    $file = TReport::where('uuid', $uuid)->firstOrFail();
    if(file_exists(storage_path('app/files/Report/'. $file->file))){
       $path = storage_path('app/files/Report/'. $file->file);
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
        $comment = new TReportComment;
        $comment->comment = $request->comment;
        $comment->report_id = $request->report_id;
        $comment->user_id = $user_id;
        DB::transaction(function() use ($comment) {
          $comment->save();
          Helper::add_noti('Report',  $comment->id, $comment->report_id);
        });
        //to generate its notifications
        
        $request->session()->flash('alert-success', ' اجرات شما افزوده شد ' );
        return redirect()->back();
 
 }




 
//handels that the user who posted can update his or her comment used in the view blade comment section of show blade
public function editcomment(Request $request){
   
  if($request->user_id == Auth::user()->id){
      $comment =  TReportComment::findOrFail($request->comment_id);
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
        $comment =  TReportComment::findOrFail($record_id);
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
  $file = TReport::findOrFail($record_id);  

  return view('Report.edit_report',compact('file'));
 }



// to actuallay update a file 

public function edit(Request $request, $record_id ){

      $this->validate($request,[
                        
        'crida_number' => 'required|Numeric',
        'date_of_archiving' => 'required',
        'report_num' => 'required',
        'place' =>  'required',
        'kholasmatlab' =>  'required',
        'author' => 'required',               
        'file' => 'mimes:pdf|max:2048000',
        ],

        [
        'crida_number.required' => 'نمبر مسلسل باید موجود باشد   ',
        'crida_number.Numeric' => 'نمبر مسلسل باید عدد باشد   ',  
        'date_of_archiving.required' => 'تاریخ ثبت باید موجود باشد   ',
        'report_num.required' => 'شماره تفصیلی گزارش باید موجود باشد   ',
        'place.required' => 'محل نگهداری باید موجود باشد   ',
        'kholasmatlab.required' => 'خلص موضوع باید موجود باشد   ',
        'author.required' => 'مولف گزارش باید موجود باشد',
        'file.mimes' => 'فایل باید پی دی اف باشد   ',
        'file.max' => 'اندازه فایل شما نباید از 200 ام بی تجاوز کند     ',
        ]);

  $request->crida_number = Helper::format_number($request->date_of_archiving,$request->crida_number); 
  $report = TReport::findOrFail($record_id);    

    if($request->crida_number != $report->crida_number ){
      
        if (TReport::where('crida_number',$request->crida_number)->first() == "") {
            $report->crida_number =  $request->crida_number;
        }else{
          $request->session()->flash('alert-danger', '  سندی با نمبر '. $request->crida_number . '  موجود است ');
          return redirect()->back()->withInput();
        }
    }
        
      

          //handle file upload ***********************************
     if($request->hasFile('file')){      
      
      $old = storage_path('app/files/Report/'. $report->file);
       if(file_exists($old)){  
        $old = storage_path('app/files/Report/'. $report->file);
        $new = storage_path('app/edited/Report/'. $report->file);
        $move = File::move($old, $new);
        }

       $file_name = $request->file('file')->getClientOriginalName();
              //get just filename
       $only_name =  pathinfo($file_name, PATHINFO_FILENAME);
          // get just name extention
       $ext = $request->file('file')->getClientOriginalExtension();
        // filename to store
       $file_name_st = $only_name.'_'.time().'.'.$ext;
  
         $request->file->storeAs('files/Report',$file_name_st);
                $report->file = $file_name_st;
      } else {
         $file_name_st = $report->file;
      }

      
     
        //real storing happens here 

        $report->crida_number =  $request->crida_number;      
        $report->date_of_archiving =   Helper::hejri_to_gr($request->date_of_archiving);
        $report->report_num =  $request->report_num; 
        $report->author =  $request->author; 
        $report->year =  Helper::hejri_to_gr($request->year);  
        $report->kholasmatlab =   $request->kholasmatlab; 
        $report->revised_num =  $request->revised_num;  
        $report->place =  $request->place; 
        $report->more =  $request->more; 
     
        DB::transaction(function() use ($report) {
          //real storing happens here 
          $report->save();
        });
     
  $request->session()->flash('alert-info', ' موفقانه ویرایش گردید   ');
  return redirect()->route('panel_report');
       
 }








// access files and help you to see all the availble user files 
public function accessFile($id){       
    $file = TReport::with('authorizedUsers')->findOrFail($id);
    return view('Report.access_report',compact('file'));

}


     
//granting access to specific users  handling post grant permision - used in access blade
public function grant(Request $request){
      
      if ($request->user_id != "") {
        foreach ($request->user_id as $val) 
             {
                  $c = new TReportUser;
                  $c->report_id     = $request->report_id;
                    $c->user_id      = $val;
                    DB::transaction(function() use ($c) {
                       $c->save();
                    });
                    Helper::add_noti_access('Report',  $c->user_id,  $c->report_id);
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
      
      $record = TReportUser::findOrFail($record_id);
      $del_noti_access = Noti::where('noti_for', 1)->where('notifiable_id', $user_id)->where('type', 'report')->where('file_id',$record->report_id);
      DB::transaction(function() use ($record,$del_noti_access) {
        $record->delete();
        $del_noti_access->delete();
      });
        
      $request->session()->flash('alert-warning', ' دسترسی کاربر حذف شد  ');
      return redirect()->back()->with('message');
    }



//handels deleting a file, its comments and attachments 
public function delete($record_id, Request $request){
  if(TReport::findOrFail($record_id)->first() != " " ) {  
    $file = TReport::findOrFail($record_id);
    $deleted = new TReportDeleted;

          
      /////////////////////////////////////////////

    
      $deleted->crida_number =  $file->crida_number; 
      $deleted->database_id = $file->id;     
      $deleted->date_of_archiving =   $file->date_of_archiving;
      $deleted->report_num =  $file->report_num; 
      $deleted->author =  $file->author; 
      $deleted->year =  $file->year;  
      $deleted->kholasmatlab =   $file->kholasmatlab; 
      $deleted->revised_num =  $file->revised_num;  
      $deleted->place =  $file->place; 
      $deleted->more =  $file->more; 
      $deleted->uuid =  $file->uuid; 
      $deleted->file =  $file->file; 


      $del_comment = TReportComment::where('report_id', $record_id);
      $del_access = TReportUser::where('report_id',$record_id);
      $del_notis = Noti::where('file_id', $record_id);
 
      DB::beginTransaction();
        try {
          $deleted->save();

            //to move a file in the (deleted) folder
            if(file_exists(storage_path('app/files/Report/'. $file->file))){  
              $old = storage_path('app/files/Report/'. $file->file);
              $new = storage_path('app/deleted/Report/'. $file->file);
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
        $user = $user->reports;
        return view('Report.home_report',compact('user'));
    }
}
