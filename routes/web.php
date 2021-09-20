<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\saderaController;
use App\Http\Controllers\waradaController;
use App\Http\Controllers\peshnehadController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\ahkamController;
use App\Http\Controllers\saderamaliController;
use App\Http\Controllers\estelamController;
use App\Http\Controllers\BackupController;
//middlewares
use App\Http\middleware\isViewer;
use App\Http\middleware\archive;
use App\Http\middleware\isAdmin;
use App\Http\middleware\isVadmin;
use App\Http\middleware\LastUserActivity;
use App\Http\middleware\check_download;

use App\Http\middleware\ahkam_access;
use App\Http\middleware\ahkam_delete_comment;
use App\Http\middleware\ahkam_edit_comment;


use App\Http\middleware\estelam_access;
use App\Http\middleware\estelam_delete_comment;
use App\Http\middleware\estelam_edit_comment;


use App\Http\middleware\peshnehad_access;
use App\Http\middleware\peshnehad_delete_comment;
use App\Http\middleware\peshnehad_edit_comment;

use App\Http\middleware\report_access;
use App\Http\middleware\report_delete_comment;
use App\Http\middleware\report_edit_comment;

use App\Http\middleware\sadera_access;
use App\Http\middleware\sadera_delete_comment;
use App\Http\middleware\sadera_edit_comment;

use App\Http\middleware\saderamali_access;
use App\Http\middleware\saderamali_delete_comment;
use App\Http\middleware\saderamali_edit_comment;

use App\Http\middleware\warada_access;
use App\Http\middleware\warada_delete_comment;
use App\Http\middleware\warada_edit_comment;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// Password Reset Routes...
Route::get('forgot-password', function(){
	return view('auth.forgot-password');
})->name('forgot-password');

Route::get('password-reset', function(){
	return view('auth.reset');
})->name('password-reset');

// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::middleware(['auth'])->group(function () {

	///only Admin and archive and viewer routes start
	Route::group(['middleware' => [isViewer::class] ], function() {
		
		//return sadera panel 
		Route::get('panel_sadera', [saderaController::class , 'index_sadera'])->name('panel_sadera');
		
		//return warada panel 
		Route::get('panel_warada', [waradaController::class, 'index_warada'])->name('panel_warada');

		//return peshnehad panel 
		Route::get('panel_peshnehad', [peshnehadController::class, 'index_peshnehad'])->name('panel_peshnehad');

		//return Estelam panel 
		Route::get('panel_estelam', [estelamController::class, 'index_estelam'])->name('panel_estelam');

		//return Ahkam panel 
		Route::get('panel_ahkam', [ahkamController::class, 'index_ahkam'])->name('panel_ahkam');

		//return Saderamali panel 
		Route::get('panel_saderamali', [saderamaliController::class, 'index_saderamali'])->name('panel_saderamali');

		//return Saderamali panel 
		Route::get('panel_report', [reportController::class, 'index_report'])->name('panel_report');

		// Activity log route
		Route::get('activity_log', [HomeController::class, 'show_activity_log'])->name('activity_log')->middleware([isVadmin::class]);
		Route::get('d_activity_log/{id}', [HomeController::class, 'show_d_activity_log'])->name('d_activity_log')->middleware([isVadmin::class]);
		
		//Search routes		
		Route::post('search', [HomeController::class, 'search'])->name('search');

		// Dashboard Routes 
		Route::get('dashboard', [HomeController::class, 'show_dashboard'])->name('dashboard');


	Route::group(['middleware' => [isViewer::class] ], function() {

		Route::get('/', [HomeController::class, 'show_dashboard'])->name('dashboard');
        // Registration Routes...
		Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware([isAdmin::class]);
		Route::post('register', [RegisterController::class, 'register'])->middleware([isAdmin::class]);
		
        // User_panel Routes to manage users
		Route::get('panel_user', [HomeController::class, 'show_user_panel'])->name('panel_user')->middleware([isAdmin::class]);
		Route::get('delete_user/{user_id}', [HomeController::class, 'delete_user'])->name('delete_user')->middleware([isAdmin::class]);
		
		//send emails to all users includes credentails of users in the system
		Route::get('send_email',[HomeController::class, 'send_email'])->middleware([isAdmin::class]);


		 // Backup routes
		 Route::get('backup', [BackupController::class, 'index'])->middleware([isAdmin::class]);	 
		 Route::get('backup/create', [BackupController::class, 'create'])->middleware([isAdmin::class]); //backup only database
		 //Route::get('backup/create_files', [BackupController::class, 'create_files'])->middleware([isAdmin::class]); //backup whole app
		 Route::post('backup/download/{file_name}', [BackupController::class, 'download'])->middleware([isAdmin::class],[check_download::class]);
		 Route::post('backup/delete/{file_name}', [BackupController::class, 'delete'])->middleware([isAdmin::class],[check_download::class]);



//////////////////////////// Sadera admin routes start ////////////////////////////////

		

		//retrives the adding file page for saderea
		Route::get('add_sadera', [saderaController::class, 'add'])->name('add_sadera');
		
		//save a file sadera
		Route::post('save_sadera', [saderaController::class, 'store'])->name('save_sadera');

		//to load the page to give access to a record
		Route::get('panel_sadera/access/{file}',[saderaController::class, 'accessFile'])->name('panel_sadera/access');

		//to give access to the file post handeling
		Route::post('grant_sadera',[saderaController::class, 'grant'])->name('grant_sadera');

		// to revoke user access to sadera files
		Route::get('panel/sadera/revoke/{record_id}/{user_id}', [saderaController::class, 'deleteUserAccess']);

		//to delete a file
		Route::get('panel_sadera/delete/{record_id}', [saderaController::class, 'delete'])->name('panel_sadera/delete')->middleware([isAdmin::class]);	
		
		//to show edit sadera form
		Route::get('panel_sadera/update/{record_id}', [saderaController::class, 'show_edit'])->name('panel_sadera/update');
		
		//to  edit sadera form
		Route::put('edit_sadera/{record_id}', [saderaController::class, 'edit'])->name('edit_sadera');	
		

//////////////////////////// Sadera admin routes end //////////////////////////////////////////////////////////////	

//////////////////////////// Warada admin routes start /////////////////////////////////////////////////////////////////

		

		//retrives the adding file page for saderea
		Route::get('add_warada', [waradaController::class, 'add'])->name('add_warada');

		//save a file warada
		Route::post('save_warada', [waradaController::class, 'store'])->name('save_warada');

		//to load the page to give access to a record
		Route::get('panel_warada/access/{file}',[waradaController::class, 'accessFile'])->name('panel_warada/access');

		//to give access to the file post handeling
		Route::post('grant_warada',[waradaController::class, 'grant'])->name('grant_warada');

		// to revoke user access to warada files
		Route::get('panel/warada/revoke/{record_id}/{user_id}', [waradaController::class, 'deleteUserAccess']);

		//to delete a file
		Route::get('panel_warada/delete/{record_id}', [waradaController::class, 'delete'])->name('panel_warada/delete')->middleware([isAdmin::class]);	
		//to show edit warada form
		Route::get('panel_warada/update/{record_id}', [waradaController::class, 'show_edit'])->name('panel_warada/update');
		//to  edit warada form
		Route::put('edit_warada/{record_id}', [waradaController::class, 'edit'])->name('edit_warada');	


//////////////////////////// warada admin routes end ///////////////////////////////////////////////////////////////////////


//////////////////////////// Peshnehad admin routes start /////////////////////////////////////////////////////////////////

		

		//retrives the adding file page for saderea
		Route::get('add_peshnehad', [peshnehadController::class, 'add'])->name('add_peshnehad');

		//save a file peshnehad
		Route::post('save_peshnehad', [peshnehadController::class, 'store'])->name('save_peshnehad');

		//to load the page to give access to a record
		Route::get('panel_peshnehad/access/{file}',[peshnehadController::class, 'accessFile'])->name('panel_peshnehad/access');

		//to give access to the file post handeling
		Route::post('grant_peshnehad',[peshnehadController::class, 'grant'])->name('grant_peshnehad');

		// to revoke user access to peshnehad files
		Route::get('panel/peshnehad/revoke/{record_id}/{user_id}', [peshnehadController::class, 'deleteUserAccess']);

		//to delete a file
		Route::get('panel_peshnehad/delete/{record_id}', [peshnehadController::class, 'delete'])->name('panel_peshnehad/delete')->middleware([isAdmin::class]);	
		//to show edit peshnehad form
		Route::get('panel_peshnehad/update/{record_id}', [peshnehadController::class, 'show_edit'])->name('panel_peshnehad/update');
		//to  edit warada form
		Route::put('edit_peshnehad/{record_id}', [peshnehadController::class, 'edit'])->name('edit_peshnehad');	

//////////////////////////// Peshnehad admin routes end ///////////////////////////////////////////////////////////////////////


//////////////////////////// Estelam admin routes start /////////////////////////////////////////////////////////////////

		

		//retrives the adding file page for saderea
		Route::get('add_estelam', [estelamController::class, 'add'])->name('add_estelam');

		//save a file estelam
		Route::post('save_estelam', [estelamController::class, 'store'])->name('save_estelam');

		//to load the page to give access to a record
		Route::get('panel_estelam/access/{file}',[estelamController::class, 'accessFile'])->name('panel_estelam/access');

		//to give access to the file post handeling
		Route::post('grant_estelam',[estelamController::class, 'grant'])->name('grant_estelam');	

		// to revoke user access to Estelam files
		Route::get('panel/estelam/revoke/{record_id}/{user_id}', [estelamController::class, 'deleteUserAccess']);

		//to delete a file
		Route::get('panel_estelam/delete/{record_id}', [estelamController::class, 'delete'])->name('panel_estelam/delete')->middleware([isAdmin::class]);	
		//to show edit Estelam form
		Route::get('panel_estelam/update/{record_id}', [estelamController::class, 'show_edit'])->name('panel_estelam/update');
		//to  edit warada form
		Route::put('edit_estelam/{record_id}', [estelamController::class, 'edit'])->name('edit_estelam');	


//////////////////////////// Estelam admin routes end ///////////////////////////////////////////////////////////////////////


//////////////////////////// Ahkam admin routes start /////////////////////////////////////////////////////////////////

		

		//retrives the adding file page for saderea
		Route::get('add_ahkam', [ahkamController::class, 'add'])->name('add_ahkam');

		//save a file Ahkam
		Route::post('save_ahkam', [ahkamController::class, 'store'])->name('save_ahkam');

		//to load the page to give access to a record
		Route::get('panel_ahkam/access/{file}',[ahkamController::class, 'accessFile'])->name('panel_ahkam/access');

		//to give access to the file post handeling
		Route::post('grant_ahkam',[ahkamController::class, 'grant'])->name('grant_ahkam');

		// to revoke user access to Ahkam files
		Route::get('panel/ahkam/revoke/{record_id}/{user_id}', [ahkamController::class, 'deleteUserAccess']);

		//to delete a file
		Route::get('panel_ahkam/delete/{record_id}', [ahkamController::class, 'delete'])->name('panel_ahkam/delete')->middleware([isAdmin::class]);	
		//to show edit Ahkam form
		Route::get('panel_ahkam/update/{record_id}', [ahkamController::class, 'show_edit'])->name('panel_ahkam/update');
		//to  edit warada form
		Route::put('edit_ahkam/{record_id}', [ahkamController::class, 'edit'])->name('edit_ahkam');	
	

//////////////////////////// Ahkam admin routes end ///////////////////////////////////////////////////////////////////////


//////////////////////////// Saderamali admin routes start /////////////////////////////////////////////////////////////////

		

		//retrives the adding file page for Saderamali
		Route::get('add_saderamali', [saderamaliController::class, 'add'])->name('add_saderamali');

		//save a file Saderamali
		Route::post('save_saderamali', [saderamaliController::class, 'store'])->name('save_saderamali');

		//to load the page to give access to a record
		Route::get('panel_saderamali/access/{file}',[saderamaliController::class, 'accessFile'])->name('panel_saderamali/access');

		//to give access to the file post handeling
		Route::post('grant_saderamali', [saderamaliController::class, 'grant'])->name('grant_saderamali');

		// to revoke user access to Saderamali files
		Route::get('panel/saderamali/revoke/{record_id}/{user_id}', [saderamaliController::class, 'deleteUserAccess']);

		//to delete a file
		Route::get('panel_saderamali/delete/{record_id}', [saderamaliController::class, 'delete'])->name('panel_saderamali/delete')->middleware([isAdmin::class]);	
		
		//to show edit Saderamali form
		Route::get('panel_saderamali/update/{record_id}', [saderamaliController::class, 'show_edit'])->name('panel_saderamali/update');
		
		//to  edit Saderamali form
		Route::put('edit_saderamali/{record_id}', [saderamaliController::class, 'edit'])->name('edit_saderamali');	

	

//////////////////////////// Saderamali admin routes end ///////////////////////////////////////////////////////////////////////

//////////////////////////// Reports admin routes start /////////////////////////////////////////////////////////////////

		

		//retrives the adding file page for Report
		Route::get('add_report', [reportController::class, 'add'])->name('add_report');

		//save a file Report
		Route::post('save_report', [reportController::class, 'store'])->name('save_report');

		//to load the page to give access to a record
		Route::get('panel_report/access/{file}',[reportController::class, 'accessFile'])->name('panel_report/access');

		//to give access to the file post handeling
		Route::post('grant_report',[reportController::class, 'grant'])->name('grant_report');

		// to revoke user access to Report files
		Route::get('panel/report/revoke/{record_id}/{user_id}', [reportController::class, 'deleteUserAccess']);

		//to delete a file
		Route::get('panel_report/delete/{record_id}', [reportController::class, 'delete'])->name('panel_report/delete')->middleware([isAdmin::class]);	
		
		//to show edit Report form
		Route::get('panel_report/update/{record_id}', [reportController::class, 'show_edit'])->name('panel_report/update');
		
		//to  edit Report form
		Route::put('edit_report/{record_id}', [reportController::class, 'edit'])->name('edit_report');	

	

//////////////////////////// Reports admin routes end ///////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////// General admin routes /////////////////////////////////////////////////////////

//to get authorized users and show it in the panel blades 
Route::get('get_data/{table}/{id}', [HomeController::class, 'get_data']);

/////////////////////////////////////////////////// General admin routes end /////////////////////////////////////////////////////////
	
}); //archive group ended 



}); //isViewer group ended 


///////////////////////////////////only Admin and archive routes end///////////////////////////////////


// ****************************** All Sadera routes here - For Users  starts ******************************************

	
	//showing the main sadera page for users and retrives records whom has access to
	Route::get('/sadera',[saderaController::class, 'index'])->name('sadera');

	//showing a spefic sadera record and access of records handeled as well
	Route::get('panel_sadera/view/{file}', [saderaController::class, 'show'])->name('panel_sadera/view')->middleware([sadera_access::class]);

	//downloading file some polices applied here 
	Route::post('/show_sadera/{file}/Download',[saderaController::class, 'download'])->middleware([check_download::class]);

	//to comment on a file -- This is better to make an extra controller for this
	Route::post('sadera_comment',[saderaController::class, 'addComment'])->name('sadera_comment');

	//to edit sadera comments -- handel this for normal user
	Route::put('edit_comment_sadera', [saderaController::class, 'editcomment'])->name('edit_comment_sadera')->middleware([sadera_edit_comment::class]);
	
	//to delete sadera comments
	Route::post('panel_sadera/view/delete_comment/{record_id}', [saderaController::class, 'deletecomment'])->name('panel_sadera.view.delete_comment')->middleware([sadera_delete_comment::class]);
  
	// ****************************** All Sadera routes here - For Users ends  ********************************************



	// ****************************** All Warada routes here - For Users  starts ******************************************

	
	//showing the main warada page for users and retrives records whom has access to
	Route::get('/warada',[waradaController::class, 'index'])->name('warada');

	//showing a spefic warada record and access of records handeled as well
	Route::get('panel_warada/view/{file}', [waradaController::class, 'show_file'])->name('panel_warada/view')->middleware([warada_access::class]);

	//downloading file some polices applied here 
	Route::post('/show_warada/{file}/Download',[waradaController::class, 'download'])->middleware([check_download::class]);

	//to comment on a file -- This is better to make an extra controller for this
	Route::post('warada_comment',[waradaController::class, 'addComment'])->name('warada_comment');

	//to edit warada comments -- handel this for normal user
	Route::put('edit_comment_warada', [waradaController::class, 'editcomment'])->name('edit_comment_warada')->middleware([warada_edit_comment::class]);
	
	//to delete warada comments
	Route::post('panel_warada/view/delete_comment/{record_id}', [waradaController::class, 'deletecomment'])->name('panel_warada.view.delete_comment')->middleware([warada_delete_comment::class]);
  
	// ****************************** All Warada routes here - For Users ends  ********************************************


// ****************************** All peshnehad routes here - For Users  starts ******************************************

	
	//showing the main peshnehad page for users and retrives records whom has access to
	Route::get('/peshnehad', [peshnehadController::class, 'index'])->name('peshnehad');

	//showing a spefic warada record and access of records handeled as well
	Route::get('panel_peshnehad/view/{file}', [peshnehadController::class, 'show_file'])->name('panel_peshnehad/view')->middleware([peshnehad_access::class]);

	//downloading file some polices applied here 
	Route::post('/show_peshnehad/{file}/Download',[peshnehadController::class, 'download'])->middleware([check_download::class]);

	//to comment on a file -- This is better to make an extra controller for this
	Route::post('peshnehad_comment',[peshnehadController::class, 'addComment'])->name('peshnehad_comment');

	//to edit peshnehad comments -- handel this for normal user
	Route::put('edit_comment_peshnehad', [peshnehadController::class, 'editcomment'])->name('edit_comment_peshnehad')->middleware([peshnehad_edit_comment::class]);
	
	//to delete peshnehad comments
	Route::post('panel_peshnehad/view/delete_comment/{record_id}', [peshnehadController::class, 'deletecomment'])->name('panel_peshnehad.view.delete_comment')->middleware([peshnehad_delete_comment::class]);
  
	// ****************************** All peshnehad routes here - For Users ends  ********************************************



	// ****************************** All Estelam routes here - For Users  starts ******************************************

	
	//showing the main estelam page for users and retrives records whom has access to
	Route::get('/estelam', [estelamController::class, 'index'])->name('estelam');

	//showing a spefic warada record and access of records handeled as well
	Route::get('panel_estelam/view/{file}', [estelamController::class, 'show_file'])->name('panel_estelam/view')->middleware([estelam_access::class]);

	//downloading file some polices applied here 
	Route::post('/show_estelam/{file}/Download',[estelamController::class, 'download'])->middleware([check_download::class]);

	//to comment on a file -- This is better to make an extra controller for this
	Route::post('estelam_comment',[estelamController::class, 'addComment'])->name('estelam_comment');

	//to edit estelam comments -- handel this for normal user
	Route::put('edit_comment_estelam', [estelamController::class, 'editcomment'])->name('edit_comment_estelam')->middleware([estelam_edit_comment::class]);
	
	//to delete estelam comments
	Route::post('panel_estelam/view/delete_comment/{record_id}', [estelamController::class, 'deletecomment'])->name('panel_estelam.view.delete_comment')->middleware([estelam_delete_comment::class]);
  
	// ****************************** All Estelam routes here - For Users ends  ********************************************


	// ****************************** All Ahkam routes here - For Users  starts ******************************************

	//showing the main ahkam page for users and retrives records whom has access to
	Route::get('/ahkam',[ahkamController::class, 'index'])->name('ahkam');

	//showing a spefic ahkam record and access of records handeled as well
	Route::get('panel_ahkam/view/{file}', [ahkamController::class, 'show_file'])->name('panel_ahkam/view')->middleware([ahkam_access::class]);

	//downloading file some polices applied here 
	Route::post('/show_ahkam/{file}/Download',[ahkamController::class, 'download'])->middleware([check_download::class]);
	
	//to comment on a file -- This is better to make an extra controller for this
	Route::post('ahkam_comment',[ahkamController::class, 'addComment'])->name('ahkam_comment');

	//to edit ahkam comments -- handel this for normal user
	Route::put('edit_comment_ahkam', [ahkamController::class, 'editcomment'])->name('edit_comment_ahkam')->middleware([ahkam_edit_comment::class]);
	
	//to delete ahkam comments
	Route::post('panel_ahkam/view/delete_comment/{record_id}', [ahkamController::class, 'deletecomment'])->name('panel_ahkam.view.delete_comment')->middleware([ahkam_delete_comment::class]);
  
	// ****************************** All Ahkam routes here - For Users ends  ********************************************

	
	// ****************************** All Saderamali routes here - For Users  starts ******************************************

	//showing the main Saderamali page for users and retrives records whom has access to
	Route::get('/saderamali',[saderamaliController::class, 'index'])->name('saderamali');

	//showing a spefic Saderamali record and access of records handeled as well
	Route::get('panel_saderamali/view/{file}', [saderamaliController::class, 'show_file'])->name('panel_saderamali/view')->middleware([saderamali_access::class]);

	//downloading file some polices applied here 
	Route::post('/show_saderamali/{file}/Download',[saderamaliController::class, 'download'])->middleware([check_download::class]);

	//to comment on a file -- This is better to make an extra controller for this
	Route::post('saderamali_comment',[saderamaliController::class, 'addComment'])->name('saderamali_comment');

	//to edit Saderamali comments -- handel this for normal user
	Route::put('edit_comment_saderamali', [saderamaliController::class, 'editcomment'])->name('edit_comment_saderamali')->middleware([saderamali_edit_comment::class]);
	
	//to delete Saderamali comments
	Route::post('panel_saderamali/view/delete_comment/{record_id}', [saderamaliController::class, 'deletecomment'])->name('panel_saderamali.view.delete_comment')->middleware([saderamali_delete_comment::class]);
  
	// ****************************** All Saderamali routes here - For Users ends  ********************************************
	
	// ****************************** All Report routes here - For Users  starts ******************************************

	//showing the main Saderamali page for users and retrives records whom has access to
	Route::get('/report',[reportController::class, 'index'])->name('report');

	//showing a spefic Saderamali record and access of records handeled as well
	Route::get('panel_report/view/{file}', [reportController::class, 'show_file'])->name('panel_report/view')->middleware([report_access::class]);

	//downloading file some polices applied here 
	Route::post('/show_report/{file}/Download',[reportController::class, 'download'])->middleware([check_download::class]);

	//to comment on a file -- This is better to make an extra controller for this
	Route::post('report_comment',[reportController::class, 'addComment'])->name('report_comment');

	//to edit Saderamali comments -- handel this for normal user
	Route::put('edit_comment_report', [reportController::class, 'editcomment'])->name('edit_comment_report')->middleware([report_edit_comment::class]);
	
	//to delete Saderamali comments
	Route::post('panel_report/view/delete_comment/{record_id}', [reportController::class, 'deletecomment'])->name('panel_report.view.delete_comment')->middleware([report_delete_comment::class]);
  
	// ****************************** All Report routes here - For Users ends  ********************************************




	// ****************************** General  User Routes Started  ********************************************

		Route::get("/notification/{id}", [HomeController::class, 'markAsRead'])->name('markAsRead');

		Route::post('/change_password', [HomeController::class, 'change_password']);
		
		// User dashboard Routes 
		Route::get('user_dashboard', [HomeController::class, 'show_user_dashboard'] )->name('user_dashboard');

		// Show help view for all users
		Route::get('help', [HomeController::class, 'show_help'])->name('help');

		//getting online users and it will be showed for everyone
		Route::get('get_online_user', [HomeController::class, 'get_online_users']);
		

		
		
	// ****************************** General  User Routes Finished  ********************************************
	
});

  Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
	\UniSharp\LaravelFilemanager\Lfm::routes();
  });


// Route::get('/', function () {
//     return view('welcome');
// });
