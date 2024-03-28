<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'tunit';
    public function users(){
    	return $this->belongsToMany('App\User');
    }
}
