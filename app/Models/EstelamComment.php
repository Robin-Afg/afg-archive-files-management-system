<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Estelam;
use App\Models\User;
use Spatie\Activitylog\LogOptions;

class EstelamComment extends Model
{
    protected $table = 'estelam_comments';
   
      

      //loging related codes ....
     use LogsActivity; // for loging purpose
    
    
     public function getActivitylogOptions(): LogOptions {
       return LogOptions::defaults()->logOnly( ['comment'] )->useLogName(' اجرات بالای استعلام ');
        
     }


  
       
       protected $fillable = [
        'comment', 'estelam_id', 'user_id',
    ];
    

    // Get the file that owns the comment.
    public function file()
     {
       return $this->belongsTo(Estelam::class);
     }




    // Get the user that owns the comment.
    public function user() 
    {
     return $this->belongsTo(User::class,'estelam_id');
    }


}
