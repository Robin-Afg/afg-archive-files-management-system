<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\AhkamComment;
use App\Models\User;
use App\Models\AhkamUser;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;



class Ahkam extends Model implements Searchable
{
    protected $table = 'ahkams';
    
    
    //loging related codes ....
    use LogsActivity; // for loging purpose
        
        
    public function getActivitylogOptions(): LogOptions {
    return LogOptions::defaults()->logOnly( ['crida_number', 'id'] )->useLogName('  احکام و فرامین ');
    
    }



    
    

    //for searching 
    public function getSearchResult(): SearchResult
    {
        $url = url('Ahkam/view', $this->id);

        return new SearchResult(
            $this,
            $this->type_of_document,
            $this->kholasmatlab,
            $this->date_of_archiving,
            $this->molahezat,
            $url
            );
    }

    //for searching end
    
    //this relationship retrives comment from ahkam_comment table -- used in show_ahkam blade ...
    public function comments(){
    return $this->hasMany(AhkamComment::class,'ahkam_id');
    }


    //Many to many relationship
    public function users()
    {
        return $this->belongsToMany(User::class,'ahkam_user');
    }
   
    // to control user access in the many to many relation
    public function authorizedUsers()
    {
        return $this->hasMany(AhkamUser::class,'ahkam_id')->with('user');
    }
}
