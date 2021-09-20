<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\SaderaComment;
use App\Models\SaderaUser;
use App\Models\User;

class Sadera extends Model implements Searchable
{
    protected $table = 'saderas';

    //loging related codes ....
    use LogsActivity; // for loging purpose
        
        
    public function getActivitylogOptions(): LogOptions {
    return LogOptions::defaults()->logOnly( ['crida_number', 'id'] )->useLogName(' صادره ');
    
    }


    

       
    //for searching 
    public function getSearchResult(): SearchResult
    {
 
        return new SearchResult(
            $this,
            $this->date_of_archiving,
            $this->crida_number,
            $this->mursal,
            $this->mursal_alia,
            $this->kholasmatlab,
            $this->num_of_dosia,
            $this->place,
            $this->more
           
            );
    }



    //this relationship retrives comment from sadera_comment table -- used in show_sadera blade ...
    public function comments(){
        return $this->hasMany(SaderaComment::class,'sadera_id');
    }





  //Many to many relationship
    public function users()
    {
        return $this->belongsToMany(User::class, 'sadera_user');
    }
   
// to control user access in the many to many relation
    public function authorizedUsers()
    {
        return $this->hasMany(SaderaUser::class, 'sadera_id')->with('user');
    }


    
}
