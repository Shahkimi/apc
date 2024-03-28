<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Aduan;
use App\Bahagian;

class Ptj extends Model
{
     use Sortable;

     protected $table = 'ptj';

    public $sortable = ['ptj', 'group_penyelaras'];

}
