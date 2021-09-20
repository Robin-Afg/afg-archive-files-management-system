<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\TReport;
use App\Models\User;
use Spatie\Activitylog\LogOptions;

class TReportComment extends Model
{
    protected $table = 'treport_comments';
    

    //loging related codes ....
    use LogsActivity; // for loging purpose
    
    
    public function getActivitylogOptions(): LogOptions {
      return LogOptions::defaults()->logOnly( ['comment'] )->useLogName(' اجرات بالای گزارش های تخنیکی ');
       
    }


       
       protected $fillable = [
        'comment', 'report_id', 'user_id',
       ];
   
       public function file()
       {
           return $this->belongsTo(TReport::class);
       }
   
   
   
   
    /**
        * Get the user that owns the comment.
        */
   public function user() {
   
       return $this->belongsTo(User::class,'user_id');
   
   }

}
