<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;
use App\Models\Warada;
use Spatie\Activitylog\LogOptions;


class WaradaComment extends Model
{
    protected $table = 'warada_comments';
 


   //loging related codes ....
   use LogsActivity; // for loging purpose
    
    
   public function getActivitylogOptions(): LogOptions {
     return LogOptions::defaults()->logOnly( ['comment'] )->useLogName(' اجرات بالای وارده     ');
      
   }

    
    protected $fillable = [
     'comment', 'warada_id', 'user_id',
    ];

    public function file()
    {
        return $this->belongsTo(Warada::class);
    }




 /**
     * Get the user that owns the comment.
     */
public function user() {

	return $this->belongsTo(User::class,'user_id');

}

}
