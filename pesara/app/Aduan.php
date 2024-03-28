<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Status;
use App\Jenis;
use App\User;
use App\Ptj;
use App\Bahagian;
use App\JAwatan;

class Aduan extends Model
{

      use Sortable;

      protected $table = 'aduan';

      public $sortable = ['status_id', 'created_at', 'cadangan'];

      public function jenis() 
      {
       return $this->belongsTo(Jenis::class);
      }

      public function status() 
      {
       return $this->belongsTo(Status::class);
      }


}
