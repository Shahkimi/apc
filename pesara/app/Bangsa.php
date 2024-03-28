<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Pegawai;


class Bangsa extends Model
{
    protected $table = 'bangsa';

	public $sortable = ['id', 'bangsa'];

    public function pegawai() 
    {
        return $this->hasOne(Pegawai::class,'bangsa_id','id');
    }

}
