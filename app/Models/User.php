<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Sadera;
use App\Models\Warada;
use App\Models\Peshnehad;
use App\Models\Estelam;
use App\Models\Ahkam;
use App\Models\Saderamali;
use App\Models\TReport;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //many to many relationships  - for sadera files to be viewed in the for specific users used in home blade
    public function saderas() {
        return $this->belongsToMany(Sadera::class, 'sadera_user')->orderBy('sadera_user.id','desc');
   }

   //many to many relationships  - for waradas files to be viewed in the for specific users used in home blade
   public function waradas() {
         return $this->belongsToMany(Warada::class, 'warada_user')->orderBy('warada_user.id','desc');
   }


    //many to many relationships  - for peshnehads files to be viewed in the for specific users used in home blade
   public function peshnehads()
   {
       return $this->belongsToMany(Peshnehad::class, 'peshnehad_user')->orderBy('peshnehad_user.id','desc');
   }

    //many to many relationships  - for estelams files to be viewed in the for specific users used in home blade
    public function estelams()
    {
        return $this->belongsToMany(Estelam::class,'estelam_user')->orderBy('estelam_user.id','desc');
    }

     //many to many relationships  - for ahkams files to be viewed in the for specific users used in home blade
     public function ahkams()
     {
         return $this->belongsToMany(Ahkam::class, 'ahkam_user')->orderBy('ahkam_user.id','desc');
     }

     //many to many relationships  - for saderamalis files to be viewed in the for specific users used in home blade
     public function saderamalis()
     {
         return $this->belongsToMany(Saderamali::class, 'saderamali_user')->orderBy('saderamali_user.id','desc');
     }

     //many to many relationships  - for reports files to be viewed in the for specific users used in home blade
     public function reports()
     {
         return $this->belongsToMany(TReport::class, 'treport_user','user_id','report_id')->orderBy('treport_user.id','desc');
     }

     //to check if a user is online (returns true if user is online)
     public function isOnline(){
        return Cache::has('user-is-online'. $this->id);
    }




}
