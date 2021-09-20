<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;
use App\Models\Sadera;
use Spatie\Activitylog\LogOptions;

class SaderaComment extends Model
{
   
    protected $table = 'sadera_comments';
 
    
    //loging related codes ....
    use LogsActivity; // for loging purpose
    
    
    public function getActivitylogOptions(): LogOptions {
      return LogOptions::defaults()->logOnly( ['comment'] )->useLogName(' اجرات بالای صادره     ');
       
    }


     
     protected $fillable = [
      'comment', 'sadera_id', 'user_id',
    ];

    public function file()
    {
        return $this->belongsTo(Sadera::class);
    }




 /**
     * Get the user that owns the comment.
     */
public function user() {

	return $this->belongsTo(User::class,'user_id');

}


}
