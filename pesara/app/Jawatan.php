<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Pegawai;

class Jawatan extends Model
{

	use Sortable;

    protected $table = 'jawatan';

	public $sortable = ['id', 'jawatan'];

    public function pegawai() 
    {
        // return $this->belongsTo(Pegawai::class);
        return $this->hasOne(Pegawai::class,'jawatan_id','id');
    }

}

