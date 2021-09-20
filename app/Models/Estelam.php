<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

use App\Models\EstelamComment;
use App\Models\User;
use App\Models\EstelamUser;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Estelam extends Model implements Searchable
{
    protected $table = 'estelams';

   
    
    //loging related codes ....
    use LogsActivity; // for loging purpose
        
        
    public function getActivitylogOptions(): LogOptions {
    return LogOptions::defaults()->logOnly( ['crida_number', 'id'] )->useLogName(' استعلام ');
    
    }


    //for searching 
    public function getSearchResult(): SearchResult
    {
 
        return new SearchResult(
            $this,
            $this->date_of_archiving,
            $this->crida_number,
            $this->date_of_estelam,
            $this->date_of_sodor,
            $this->add_of_sender,
            $this->marja,
            $this->reyasat,
            $this->wozarat,
            $this->kholasmatlab,
            $this->place,
            $this->taslemi,
            $this->more
           
            );
    }


    
    //this relationship retrives comment from estelam_comment table -- used in show_estelam blade ...
    public function comments(){
    return $this->hasMany(EstelamComment::class,'estelam_id');
    }


  //Many to many relationship
    public function users()
    {
        return $this->belongsToMany(User::class,'estelam_user');
    }
   
// to control user access in the many to many relation
    public function authorizedUsers()
    {
        return $this->hasMany(EstelamUser::class,'estelam_id')->with('user');
    }

}
