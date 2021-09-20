<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\TReportComment;
use App\Models\User;
use App\Models\TReportUser;


class TReport extends Model implements Searchable
{
    protected $table = 'treports';
    

    //loging related codes ....
    use LogsActivity; // for loging purpose
        
        
    public function getActivitylogOptions(): LogOptions {
    return LogOptions::defaults()->logOnly( ['crida_number', 'id'] )->useLogName(' گزارش های تخنیکی ');
    
    }


    
    
    

    //for searching 
    public function getSearchResult(): SearchResult
    {
        $url = url('Report/view', $this->id);

        return new SearchResult(
            $this,
            $this->author,
            $this->kholasmatlab,
            $this->date_of_archiving,
            $this->revised_num,
            $url
            );
    }

    //for searching end
    
    //this relationship retrives comment from ahkam_comment table -- used in show_ahkam blade ...
    public function comments(){
    return $this->hasMany(TReportComment::class,'report_id');
    }


    //Many to many relationship
    public function users()
    {
        return $this->belongsToMany(User::class,'treport_user');
    }
   
    // to control user access in the many to many relation
    public function authorizedUsers()
    {
        return $this->hasMany(TReportUser::class,'report_id')->with('user');
    }
}
