<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Ptj;
use App\Bahagian;
use App\Jawatan;
use App\Gred;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'name', 'username','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function aduan() 
    {
        return $this->hasOne('App\Aduan','user_id','id'); //class, foreign_id, id
    }

    public function ptj() 
    {
        return $this->belongsTo(Ptj::class);
    }

    public function bahagian() 
    {
    return $this->belongsTo(Bahagian::class);
    }

    public function jawatan() 
    {
    return $this->belongsTo(Jawatan::class);
    }

    public function gred() 
    {
    return $this->belongsTo(Gred::class);
    }

    //---------------------------------------------------------

    public function hasAnyRoles($roles){
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }
        return false;
    }

    public function hasRoles($role){
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }

      //---------------------------------------------------------

    public function hasAnyBahagians($bahagians){
        if($this->bahagian()->whereIn('id', $bahagians)->first()){
            return true;
        }
        return false;
    }

    public function hasBahagians($bahagian){
        if($this->bahagian()->where('id', $bahagian)->first()){
            return true;
        }
        return false;
    }
    //--------------------------------------------------------------
     public function hasAnyUnits($units){
        if($this->unit()->whereIn('id', $units)->first()){
            return true;
        }
        return false;
    }

    public function hasUnits($unit){
        if($this->unit()->where('id', $unit)->first()){
            return true;
        }
        return false;
    }

  
}
