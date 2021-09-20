<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\PeshnehadComment;
use App\Models\User;
use App\Models\PeshnehadUser;

class Peshnehad extends Model implements Searchable
{
  protected $table = 'peshnehads';

   
    //loging related codes ....
    use LogsActivity; // for loging purpose
        
        
    public function getActivitylogOptions(): LogOptions {
    return LogOptions::defaults()->logOnly( ['crida_number', 'id'] )->useLogName(' پیشنهاد ');
    
    }

    

    

        //for searching 
        public function getSearchResult(): SearchResult
        {
    
            return new SearchResult(
                $this,
                $this->date_of_archiving,
                $this->crida_number,
                $this->date_of_peshnehad,
                $this->add_of_peshnehader,
                $this->kholasmatlab,
                $this->taslemi,
                $this->more
              
                );
        }



    //this relationship retrives comment from sadera_comment table -- used in show_sadera blade ...
    public function comments(){
      return $this->hasMany(PeshnehadComment::class,'peshnehad_id');
    }



  //Many to many relationship
    public function users()
    {
        return $this->belongsToMany(User::class,'peshnehad_user');
    }
   
  // to control user access in the many to many relation
  public function authorizedUsers()
  {
      return $this->hasMany(PeshnehadUser::class,'peshnehad_id')->with('user');
  }


}
