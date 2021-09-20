<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Noti extends Model
{
    protected $table = "notis";

   
    
    public function SaderaUser()
    {
    	return $this->hasOne(User::class,'id','notifiable_id');
    }



    public function WaradaUser()
    {
    	return $this->hasOne(User::class,'id','notifiable_id');
    }
   

}
