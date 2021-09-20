<?php
namespace App\Helpers;
use Verta;

use App\Models\User;
use App\Models\Noti;
use App\Models\SaderaUser;
use App\Models\WaradaUser;
use App\Models\PeshnehadUser;
use App\Models\EstelamUser;
use App\Models\AhkamUser;
use App\Models\SaderamaliUser;
use App\Models\TReportUser;
use DB;
use Auth;

class GeneralHelper 
{
    public static function gr_to_hejri($v)
    {
     //returns hejri date to be displayed in views
        $v = new Verta($v);
        
        $v = $v->format('Y-n-j');
        $v = Verta::enToFaNumbers($v);
        return $v;
    }
    public static function gr_to_hejri_style2($v)
    {
     //returns hejri date to be displayed in views
        $v = new Verta($v);
        $v = $v->format('  %Y - %B - %d  ');
        $v = Verta::enToFaNumbers($v);
        return $v;
    }
    public static function hejri_to_gr($v)
    {
        //returns gregorian date to be stored in database
        $v = Verta::faToEnNumbers($v);
        $v = Verta::parse($v);
        $v = $v->formatGregorian('Y-m-d');
        return $v;
    }
    public static function format_number($v,$number)
    {
        //gets a number and concats it with - and year to store it in the  database  
        $v = Verta::faToEnNumbers($v);
        $v = Verta::parse($v);
        $v = $v->format('%Y');
        $v = $v."-".$number;
        return $v;
    }
    public static function extract_number($number)
    {
        //returns only the number for other purposees 
        $number = explode('-',$number);
        return $number[1];
    }
    public static function current_year(){
        //return current year 
        $v = new Verta();
        $v = $v->format('Y');
        $v = Verta::faToEnNumbers($v);
        return $v;
    }

    public static function current_year_full(){
        //return current year 
        $v = new Verta();
        $v = $v->format('Y');
        $v = Verta::enToFaNumbers($v);
        return $v;
    }


    public static function hejri_to_gr_only_year($v)
    {
        //returns gregorian date to be stored in database
        $v = Verta::faToEnNumbers($v);
        $v = Verta::instance($v);
        $v = Verta::parse($v);
        $v = $v->formatGregorian('Y');
        return $v;
    }




   
    
    
    //add records to notification table 
    public static function add_noti($table,$comment_id,$file_id){
      
        if($table == 'Sadera'){
            $users =  SaderaUser::where('sadera_id', $file_id)->get();
                foreach($users as $user){
                        $noti = new Noti;
                        $noti->notifiable_id = $user->user_id;
                        $noti->comment_id = $comment_id;
                        $noti->file_id = $file_id;
                        $noti->type = 'sadera';
                        $noti->user_id = Auth::id();
                        DB::transaction(function() use ($noti) {
                            $noti->save();
                        });
                
                }
            
            //to show notification to all admins
                $admins = User::where('type', 1)->orWhere('type', 2)->get();

                foreach($admins as $admin){
                    $noti = new Noti;
                    $noti->notifiable_id = $admin->id;
                    $noti->comment_id = $comment_id;
                    $noti->file_id = $file_id;
                    $noti->type = 'sadera';
                    $noti->user_id = Auth::id();
                    DB::transaction(function() use ($noti) {
                        $noti->save();
                    });
            
                 } 

         }


         if($table == 'Warada'){
            $users =  WaradaUser::where('warada_id', $file_id)->get();
                foreach($users as $user){
                    $noti = new Noti;
                    $noti->notifiable_id = $user->user_id;
                    $noti->type = 'warada';
                    $noti->comment_id = $comment_id;
                    $noti->file_id = $file_id;
                    $noti->user_id = Auth::id();
                    DB::transaction(function() use ($noti) {
                        $noti->save();
                    });
                
                }

                //to show notification to all admins
                $admins = User::where('type', 1)->orWhere('type', 2)->get();

                foreach($admins as $admin){
                    $noti = new Noti;
                    $noti->notifiable_id = $admin->id;
                    $noti->comment_id = $comment_id;
                    $noti->file_id = $file_id;
                    $noti->type = 'warada';
                    $noti->user_id = Auth::id();
                    DB::transaction(function() use ($noti) {
                        $noti->save();
                    });
            
                 }
         }
        

         if($table == 'Peshnehad'){
            $users =  PeshnehadUser::where('peshnehad_id', $file_id)->get();
                foreach($users as $user){
                    $noti = new Noti;
                    $noti->notifiable_id = $user->user_id;
                    $noti->type = 'peshnehad';
                    $noti->comment_id = $comment_id;
                    $noti->file_id = $file_id;
                    $noti->user_id = Auth::id();
                    DB::transaction(function() use ($noti) {
                        $noti->save();
                    });
                
                }

                //to show notification to all admins
                $admins = User::where('type', 1)->orWhere('type', 2)->get();

                foreach($admins as $admin){
                    $noti = new Noti;
                    $noti->notifiable_id = $admin->id;
                    $noti->comment_id = $comment_id;
                    $noti->file_id = $file_id;
                    $noti->type = 'peshnehad';
                    $noti->user_id = Auth::id();
                    DB::transaction(function() use ($noti) {
                        $noti->save();
                    });
            
                 }
         }

        /////////////////////////////////////////////////////////
         if($table == 'Estelam'){
            $users =  EstelamUser::where('estelam_id', $file_id)->get();
                foreach($users as $user){
                        $noti = new Noti;
                        $noti->notifiable_id = $user->user_id;
                        $noti->comment_id = $comment_id;
                        $noti->file_id = $file_id;
                        $noti->type = 'estelam';
                        $noti->user_id = Auth::id();
                        DB::transaction(function() use ($noti) {
                            $noti->save();
                        });
                
                }
            
            //to show notification to all admins
                $admins = User::where('type', 1)->orWhere('type', 2)->get();

                foreach($admins as $admin){
                    $noti = new Noti;
                    $noti->notifiable_id = $admin->id;
                    $noti->comment_id = $comment_id;
                    $noti->file_id = $file_id;
                    $noti->type = 'estelam';
                    $noti->user_id = Auth::id();
                    DB::transaction(function() use ($noti) {
                        $noti->save();
                    });
            
                 } 

         }
        //////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////
        if($table == 'Ahkam'){
            $users =  AhkamUser::where('ahkam_id', $file_id)->get();
                foreach($users as $user){
                        $noti = new Noti;
                        $noti->notifiable_id = $user->user_id;
                        $noti->comment_id = $comment_id;
                        $noti->file_id = $file_id;
                        $noti->type = 'ahkam';
                        $noti->user_id = Auth::id();
                        DB::transaction(function() use ($noti) {
                            $noti->save();
                        });
                
                }
            
            //to show notification to all admins
                $admins = User::where('type', 1)->orWhere('type', 2)->get();

                foreach($admins as $admin){
                    $noti = new Noti;
                    $noti->notifiable_id = $admin->id;
                    $noti->comment_id = $comment_id;
                    $noti->file_id = $file_id;
                    $noti->type = 'ahkam';
                    $noti->user_id = Auth::id();
                    DB::transaction(function() use ($noti) {
                        $noti->save();
                    });
            
                 } 

         }
        //////////////////////////////////////////////////////////

           //////////////////////////////////////////////////////////////////
           if($table == 'Saderamali'){
            $users =  SaderamaliUser::where('saderamali_id', $file_id)->get();
                foreach($users as $user){
                        $noti = new Noti;
                        $noti->notifiable_id = $user->user_id;
                        $noti->comment_id = $comment_id;
                        $noti->file_id = $file_id;
                        $noti->type = 'saderamali';
                        $noti->user_id = Auth::id();
                        DB::transaction(function() use ($noti) {
                            $noti->save();
                        });
                
                }
            
            //to show notification to all admins
                $admins = User::where('type', 1)->orWhere('type', 2)->get();

                foreach($admins as $admin){
                    $noti = new Noti;
                    $noti->notifiable_id = $admin->id;
                    $noti->comment_id = $comment_id;
                    $noti->file_id = $file_id;
                    $noti->type = 'saderamali';
                    $noti->user_id = Auth::id();
                    DB::transaction(function() use ($noti) {
                        $noti->save();
                    });
            
                 } 

         }
        //////////////////////////////////////////////////////////

         //////////////////////////////////////////////////////////////////
         if($table == 'Report'){
            $users =  TReportUser::where('report_id', $file_id)->get();
                foreach($users as $user){
                        $noti = new Noti;
                        $noti->notifiable_id = $user->user_id;
                        $noti->comment_id = $comment_id;
                        $noti->file_id = $file_id;
                        $noti->type = 'report';
                        $noti->user_id = Auth::id();
                        DB::transaction(function() use ($noti) {
                            $noti->save();
                        });
                
                }
            
            //to show notification to all admins
                $admins = User::where('type', 1)->orWhere('type', 2)->get();

                foreach($admins as $admin){
                    $noti = new Noti;
                    $noti->notifiable_id = $admin->id;
                    $noti->comment_id = $comment_id;
                    $noti->file_id = $file_id;
                    $noti->type = 'report';
                    $noti->user_id = Auth::id();
                    DB::transaction(function() use ($noti) {
                        $noti->save();
                    });
            
                 } 

         }
        //////////////////////////////////////////////////////////

    }
   

//to create notifications when a user is granted access on a file
    public static function add_noti_access($table, $user_id, $file_id){
       
        if($table == 'Sadera'){
           
               
            $noti = new Noti;
            $noti->notifiable_id = $user_id;
            $noti->file_id = $file_id;
            $noti->type = 'sadera';
            $noti->noti_for = 1;

            $noti->user_id = Auth::id();
            DB::transaction(function() use ($noti) {
                $noti->save();
            });
    
    

        }
  
        if($table == 'Warada'){
            
                
            $noti = new Noti;
            $noti->notifiable_id = $user_id;
            $noti->file_id = $file_id;
            $noti->type = 'warada';
            $noti->noti_for = 1;

            $noti->user_id = Auth::id();
            DB::transaction(function() use ($noti) {
                $noti->save();
            });



        }

        if($table == 'Peshnehad'){
           
               
            $noti = new Noti;
            $noti->notifiable_id = $user_id;
            $noti->file_id = $file_id;
            $noti->type = 'peshnehad';
            $noti->noti_for = 1;

            $noti->user_id = Auth::id();
            DB::transaction(function() use ($noti) {
                $noti->save();
            });
              
                

        }

        if($table == 'Estelam'){
                        
            $noti = new Noti;
            $noti->notifiable_id = $user_id;
            $noti->file_id = $file_id;
            $noti->type = 'estelam';
            $noti->noti_for = 1;

            $noti->user_id = Auth::id();
            DB::transaction(function() use ($noti) {
                $noti->save();
            });

        }

        if($table == 'Ahkam'){
                        
            $noti = new Noti;
            $noti->notifiable_id = $user_id;
            $noti->file_id = $file_id;
            $noti->type = 'ahkam';
            $noti->noti_for = 1;

            $noti->user_id = Auth::id();
            DB::transaction(function() use ($noti) {
                $noti->save();
            });

        }

        if($table == 'Saderamali'){
                        
            $noti = new Noti;
            $noti->notifiable_id = $user_id;
            $noti->file_id = $file_id;
            $noti->type = 'saderamali';
            $noti->noti_for = 1;

            $noti->user_id = Auth::id();
            DB::transaction(function() use ($noti) {
                $noti->save();
            });

        }


        if($table == 'Report'){
                        
            $noti = new Noti;
            $noti->notifiable_id = $user_id;
            $noti->file_id = $file_id;
            $noti->type = 'report';
            $noti->noti_for = 1;

            $noti->user_id = Auth::id();
            DB::transaction(function() use ($noti) {
                $noti->save();
            });

        }



    }




    // this function is created to formate backup blade file size issues
    public static function humanFilesize($size, $precision = 2) {
        $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $step = 1024;
        $i = 0;
    
        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }
        
        return round($size, $precision).$units[$i];
    }



}
  

?>