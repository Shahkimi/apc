<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Aduan;


class Gred extends Model
{
    use Sortable;

    protected $table = 'gred';

	public $sortable = ['id', 'gred'];

    public function aduan() 
    {
        return $this->hasOne(Aduan::class,'gred_id','id');
    }
}
