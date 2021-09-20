<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Peshnehad;
use App\Models\User;
use Spatie\Activitylog\LogOptions;

class PeshnehadComment extends Model
{
    
    protected $table = 'peshnehad_comments';
   
      

      //loging related codes ....
     use LogsActivity; // for loging purpose
    
    
     public function getActivitylogOptions(): LogOptions {
       return LogOptions::defaults()->logOnly( ['comment'] )->useLogName(' اجرات بالای پیشنهاد   ');
        
     }



 
      
      protected $fillable = [
       'comment', 'peshnehad_id', 'user_id',
   ];

        /**
        * Get the file that owns the comment.
        */
   
   
       public function file()
       {
           return $this->belongsTo(Peshnehad::class);
       }
   
   
   
   
    /**
        * Get the user that owns the comment.
        */
   public function user() {
   
       return $this->belongsTo(User::class,'peshnehad_id');
   
   }
   
}
