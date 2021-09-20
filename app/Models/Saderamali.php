<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\SaderamaliComment;
use App\Models\User;
use App\Models\SaderamaliUser;


class Saderamali extends Model implements Searchable
{
    protected $table = 'saderamalis';

    

    //loging related codes ....
    use LogsActivity; // for loging purpose
        
        
    public function getActivitylogOptions(): LogOptions {
    return LogOptions::defaults()->logOnly( ['crida_number', 'id'] )->useLogName(' صادره مالی ');
    
    }




            //for searching 
            public function getSearchResult(): SearchResult
            {
        
                return new SearchResult(
                    $this,
                    $this->date_of_archiving,
                    $this->crida_number,
                    $this->date_of_sodor,
                    $this->mursal,
                    $this->mursal_alia,
                    $this->kholasmatlab,
                    $this->number_of_archive,
                    $this->place,
                    $this->more
                
                    );
            }

        //this relationship retrives comment from saderamali_comment table -- used in show_saderamali blade ...
        public function comments(){
            return $this->hasMany(SaderamaliComment::class,'saderamali_id');
        }
    
    
      //Many to many relationship
        public function users()
        {
            return $this->belongsToMany(User::class,'saderamali_user');
        }
       
    // to control user access in the many to many relation
        public function authorizedUsers()
        {
            return $this->hasMany(SaderamaliUser::class,'saderamali_id')->with('user');
        }
}
