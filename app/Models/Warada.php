<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\WaradaComment;
use App\Models\User;
use App\Models\WaradaUser;
class Warada extends Model implements Searchable
{
    protected $table = 'waradas';
    


    //loging related codes ....
    use LogsActivity; // for loging purpose
        
        
    public function getActivitylogOptions(): LogOptions {
    return LogOptions::defaults()->logOnly( ['crida_number', 'id'] )->useLogName(' وارده ');
    
    }


     
     

    //for searching 
    public function getSearchResult(): SearchResult
    {
 
        return new SearchResult(
            $this,
            $this->date_of_archiving,
            $this->crida_number,
            $this->mursal,
            $this->reyasat,
            $this->date_of_warada,
            $this->moderyat,
            $this->kholasmatlab,
            $this->mursal_alia,
            $this->almary,
            $this->more
           
            );
    }


    //this relationship retrives comment from sadera_comment table -- used in show_sadera blade ...
    public function comments(){
        return $this->hasMany(WaradaComment::class,'warada_id');
    }



  //Many to many relationship
    public function users()
    {
        return $this->belongsToMany(User::class,'warada_user');
    }
   
// to control user access in the many to many relation
    public function authorizedUsers()
    {
        return $this->hasMany(WaradaUser::class,'warada_id')->with('user');
    }


}
