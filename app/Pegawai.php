<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Pegawai;
use App\Sokongan;
use App\Jawatan;
use App\Gred;
use App\Ptj;
use App\Bahagian;
use App\Bangsa;
use App\Agama;

class Pegawai extends Model
{
    use Sortable;

    protected $table = 'pegawai';

    protected $fillable = ['gambar'];
	
	protected $primaryKey = 'id';

    public $sortable = ['id', 'nokp', 'nama','markah_keseluruhan'];

    public $timestamps = false;

 	public static function getMarkahPegawai($id_pegawai) {

        $pegawai = Pegawai::where('id',$id_pegawai)->first();
		$resultpegawai = new Pegawai;
        $result = $resultpegawai->getResultPegawai($pegawai);;

//dd($result);
 		return $result['markah_keseluruhan'];
 	}

    public function jawatan() 
    {
       return $this->belongsTo(Jawatan::class);
    }

    public function gred() 
    {
       return $this->belongsTo(Gred::class);
    }

    public function ptj() 
    {
       return $this->belongsTo(Ptj::class);
    }

    public function bahagian() 
    {
       return $this->belongsTo(Bahagian::class);
    }

    public function bangsa() 
    {
       return $this->belongsTo(Bangsa::class);
    }

    public function agama() 
    {
       return $this->belongsTo(Agama::class);
    }

    
}
