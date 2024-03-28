<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahagian extends Model
{
    protected $table = 'bahagian';

	public function aduan(){
		return $this->belongsToMany('App\User');
	}

	public function ptj() 
      {
       return $this->belongsToMany('App\Bahagian');
      }
}
