<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sadera;
use App\Models\Warada;
use App\Models\Peshnehad;
use App\Models\Estelam;
use App\Models\Ahkam;
use App\Models\Saderamali;
use App\Models\TReport;

use App\Models\SaderaUser;
use App\Models\WaradaUser;
use App\Models\PeshnehadUser;
use App\Models\EstelamUser;
use App\Models\AhkamUser;
use App\Models\SaderamaliUser;
use App\Models\TReportUser;

use App\Models\SaderaComment;
use App\Models\WaradaComment;
use App\Models\PeshnehadComment;
use App\Models\EstelamComment;
use App\Models\AhkamComment;
use App\Models\SaderamaliComment;
use App\Models\TReportComment;

use App\Models\Noti;
use Auth;
use Carbon\Carbon;
use DB;
use Hash;
use Spatie\Searchable\Search;
use Spatie\Activitylog\Models\Activity;
use Artisan;
use App\Notifications\CustomEmail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
          
       return view('welcome');
    }
   
   //This function works with showing users from the panel page used with ajax 
    public function get_data($table,$id)
    {
        switch ($table) {
            case 'panel_sadera':
                return Sadera::with('authorizedUsers')->where('id',$id)->get(); 
                break;
            case 'panel_warada':
                return Warada::with('authorizedUsers')->where('id',$id)->get(); 
                break;
            case 'panel_peshnehad':
                return Peshnehad::with('authorizedUsers')->where('id',$id)->get(); 
                break;
            case 'panel_estelam':
                return Estelam::with('authorizedUsers')->where('id',$id)->get(); 
                break;
            case 'panel_ahkam':
                return Ahkam::with('authorizedUsers')->where('id',$id)->get(); 
                break;
            case 'panel_saderamali':
                return Saderamali::with('authorizedUsers')->where('id',$id)->get(); 
                break;
            case 'panel_report':
                return TReport::with('authorizedUsers')->where('id',$id)->get(); 
                break;    
            default:
                return abort(401);
                break;
        }
    }

    //this function update the read column in notifications
    public function markAsRead($not_id)
    {
        $not = Noti::findOrFail($not_id);
        $not->read = Carbon::now();
        DB::transaction(function() use ($not) {
            $not->save();
        });
        return redirect('panel_'.$not->type.'/view/'.$not->file_id);
    }
    


//user can change password in notification area
    public function change_password(Request $request){
        
        $user = Auth::user();

        $this->validate($request,[
            'current_password' => 'required|min:8', 
            'new_password' => 'required|min:8', 
            'confirm_new_password' => 'required|min:8', 
        ],

        [
        'current_password.required' => 'رمز عبور فعلی باید موجود باشد   ',
        'new_password.required' => 'رمز عبور جدید باید موجود باشد   ',
        'confirm_new_password.required' => 'تاییدی رمز عبور جدید باید موجود باشد   ',
        'current_password.min' => 'رمز عبور فعلی باید حد اقل هشت حرف باشد   ',
        'new_password.min' => 'رمز عبور جدید  باید حد اقل هشت حرف باشد   ',
        'confirm_new_password.min' => 'تاییدی رمز عبور فعلی باید حد اقل هشت حرف باشد   ',

        ]);

        if(Hash::check($request->current_password, $user->password)){

            if($request->new_password == $request->confirm_new_password){
                $user->password = bcrypt($request->new_password);
                DB::transaction(function() use ($user) {
                    $user->save();
                });
                $request->session()->flash('alert-info', '  رمز عبور شما موفقانه ویرایش شد    ');
            }else {
               
                $request->session()->flash('password_alert', 'رمز عبور جدید شما با تایید آن مطابقت ندارد');
            }

            }else{
                $request->session()->flash('password_alert', 'رمز عبور فعلی شما درست نمی باشد');
                
            }

        return redirect()->back();

     }

     // to show all users for user panel blade
     public function show_user_panel(){
         $users = User::get()->sortByDesc('id');
         return view('auth.panel_user',compact('users'));
     }
     
     //to delete a user, user notifications, and user aceess
     public function delete_user($user_id){
        $user = User::findOrFail($user_id);

        $del_notis = Noti::where('user_id', $user_id)->where('noti_for', null);
        
        $del_user_access_sadera = SaderaUser::where('user_id', $user_id);
        $del_user_access_warada = WaradaUser::where('user_id', $user_id);
        $del_user_access_estelam = EstelamUser::where('user_id', $user_id);
        $del_user_access_peshnehad = PeshnehadUser::where('user_id', $user_id);
        $del_user_access_ahkam = AhkamUser::where('user_id', $user_id);
        $del_user_access_saderamali = SaderamaliUser::where('user_id', $user_id);
        $del_user_access_report = SaderamaliUser::where('user_id', $user_id);

        $del_sadera_comment = SaderaComment::where('user_id', $user_id);
        $del_warada_comment = WaradaComment::where('user_id', $user_id);
        $del_estelam_comment = EstelamComment::where('user_id', $user_id);
        $del_peshnehad_comment = PeshnehadComment::where('user_id', $user_id);
        $del_ahkam_comment = AhkamComment::where('user_id', $user_id);
        $del_saderamali_comment = SaderamaliComment::where('user_id', $user_id);
        $del_report_comment = TReportComment::where('user_id', $user_id);

     

        DB::transaction(function() use ($user, $del_notis, $del_user_access_sadera, $del_user_access_warada ,$del_user_access_estelam, $del_user_access_peshnehad, $del_user_access_ahkam, $del_user_access_saderamali, $del_user_access_report, $del_sadera_comment, $del_warada_comment , $del_estelam_comment, $del_peshnehad_comment, $del_ahkam_comment, $del_saderamali_comment, $del_report_comment  ) {
            
            $user->status = 0;
            $user->save();
            //deleting related notifications for the concerenced user
            $del_notis->delete();
            //deleting user access
            $del_user_access_sadera->delete();
            $del_user_access_warada->delete();
            $del_user_access_estelam->delete();
            $del_user_access_peshnehad->delete();
            $del_user_access_ahkam->delete();
            $del_user_access_saderamali->delete();
            $del_user_access_report->delete();
            //deleting user comments
            $del_sadera_comment->delete();
            $del_warada_comment->delete();
            $del_estelam_comment->delete();
            $del_peshnehad_comment->delete();
            $del_ahkam_comment->delete();
            $del_saderamali_comment->delete();
            $del_report_comment->delete();



        });
        return response()->json('success',200);
    }


    //to show dashboard 
    public function show_dashboard(){
        
        $activity = count(Activity::all());
        $sadera = count(Sadera::all());
        $warada = count(Warada::all());
        $peshnehad = count(Peshnehad::all());
        $estelam = count(Estelam::all());
        $ahkam = count(Ahkam::all());
        $saderamali = count(Saderamali::all());
        $report = count(TReport::all());
        $user = count(User::where('type',0)->where('status', 1)->get());
        $a_user = count(User::where('type', 2)->where('status', 1)->get());
        $admin_user = count(User::where('type', 1)->where('status', 1)->get());
        $viewer_user = count(User::where('type', 3)->where('status', 1)->get());

        return view('dashboard',compact('activity',
        'sadera', 'warada','peshnehad', 'estelam','ahkam', 'saderamali',
        'report','user', 'a_user', 'admin_user','viewer_user'));

    }

    //to show user dashboard
    public function show_user_dashboard(){
        return view('user_dashboard');
    }



    //For searching
    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Ahkam::class, ['kholasmatlab','molahezat','more'])
            ->registerModel(Sadera::class, ['kholasmatlab','more','crida_number','mursal','mursal_alia','num_of_dosia','place','date_of_archiving'])
            ->registerModel(Warada::class, ['date_of_archiving','crida_number','mursal','reyasat','date_of_warada','moderyat','kholasmatlab','mursal_alia','almary','more'])
            ->registerModel(Peshnehad::class, ['date_of_archiving','crida_number','date_of_peshnehad','add_of_peshnehader','kholasmatlab','taslemi','more'])
            ->registerModel(Estelam::class, ['date_of_archiving','crida_number','date_of_estelam','date_of_sodor','add_of_sender','marja','reyasat','wozarat','kholasmatlab','place','taslemi','more'])
            ->registerModel(Saderamali::class, ['date_of_archiving','crida_number','date_of_sodor','mursal','mursal_alia','kholasmatlab','number_of_archive','place','more'])
            ->registerModel(TReport::class, ['date_of_archiving','crida_number','author','kholasmatlab','revised_num','place','report_num','more'])
            ->perform($request->input('search'));
        return view('search', compact('searchResults'));
    }

    //return activity log blade
    public function show_activity_log(){
        $activity = Activity::all();
        return view('Activitylog.activity_log',compact('activity'));
    }
    //provide details in an extra page
    public function show_d_activity_log($id){
        $activity = Activity::findOrFail($id);
        return view('Activitylog.d_activity_log',compact('activity'));
    }

    //show help page
    public function show_help(){
        return view('helps');
    }

    
    //getting online users
    public function get_online_users(){
        $users = User::all();
        $username = '';
        $dept = '';

        $online_users = array();

        foreach($users as $user){
            if($user->isOnline()){
                array_push($online_users, $user->name . " ( " . $user->dept . " )");
            }
        }
        echo json_encode($online_users);
    }

    public function send_email(){
        
       // $users = User::where('status', 1)->whereNotIn('id', [2, 3, 4, 5, 6, 14])->get();
       
        // dd($users); exit;

        // foreach($users as $user){
        //    $user->notify(new CustomEmail()); 
        // }
        
        
    }
    


}
