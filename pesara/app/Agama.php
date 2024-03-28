<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Pegawai;


class Agama extends Model
{
    protected $table = 'agama';

	public $sortable = ['id', 'agama'];

    public function pegawai() 
    {
        return $this->hasOne(Pegawai::class,'agama_id','id');
    }

}
