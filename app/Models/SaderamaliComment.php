<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Saderamali;
use App\Models\User;
use Spatie\Activitylog\LogOptions;

class SaderamaliComment extends Model
{
    protected $table = 'saderamali_comments';
   
    
    //loging related codes ....
    use LogsActivity; // for loging purpose
    
    
    public function getActivitylogOptions(): LogOptions {
      return LogOptions::defaults()->logOnly( ['comment'] )->useLogName(' اجرات بالای صادره مالی  ');
       
    }


    
    protected $fillable = [
     'comment', 'saderamali_id', 'user_id',
 ];
    

    // Get the file that owns the comment.
    public function file()
     {
       return $this->belongsTo(Saderamali::class);
     }




    // Get the user that owns the comment.
    public function user() 
    {
     return $this->belongsTo(User::class,'saderamali_id');
    }

}
