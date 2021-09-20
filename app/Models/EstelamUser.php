<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EstelamUser extends Model
{
    protected $table = 'estelam_user';


  	// This relationship has been made to control user access to show only users which has record in the user table -- for access blade --- select part 
  	public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
