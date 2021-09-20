<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Ahkam;
use App\Models\User;
use Spatie\Activitylog\LogOptions;


class AhkamComment extends Model
{
    protected $table = 'ahkam_comments';
   
    
     //loging related codes ....
     use LogsActivity; // for loging purpose
    
    
    public function getActivitylogOptions(): LogOptions {
      return LogOptions::defaults()->logOnly( ['comment'] )->useLogName(' اجرات بالای احکام و فرامین ');
       
    }
    
     
     protected $fillable = [
      'comment', 'ahkam_id', 'user_id',
  ];
    

    // Get the file that owns the comment.
    public function file()
     {
       return $this->belongsTo(Ahkam::class);
     }




    // Get the user that owns the comment.
    public function user() 
    {
     return $this->belongsTo(User::class,'ahkam_id');
    }
}
