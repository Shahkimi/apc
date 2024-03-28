<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Jawatan;
use App\Gred;
use App\Ptj;
use App\Sesi;
use Illuminate\Support\Facades\Auth;
use DB;

class PesaraController extends Controller
{
    public function index(){

		$result = Pegawai::select('pegawai.*','ptj.ptj','jawatan.jawatan','gred.gred')          
                            ->leftjoin('ptj','ptj.id', 'pegawai.ptj_id')
                            ->leftjoin('jawatan','jawatan.id', 'pegawai.jawatan_id')
                            ->leftjoin('gred','gred.id', 'pegawai.gred_id');

        $record_count = $result->count();

        $pegawai = $result->orderby('sesi')
                            ->orderBy(DB::raw('ISNULL(no_kerusi), no_kerusi'), 'ASC')
                            ->paginate(25);

        $sesi_buka = ApcController::getSesi_buka();

		return view('pesara.index', [
            'pegawai' => $pegawai,
            'record_count' => $record_count,
            'fnama' => "",
            'fnokp' => "",
            'fptj' => "",
            'fjawatan' => "",
            'frsvp' => "",
            'fsesi' => "",
            'fkehadiran' => "",
            'fno_kerusi' => "",
            'sesi_buka' => $sesi_buka,
        ]);

    }

    public function getSesi_buka() {

         $sesi = Sesi::where('buka',1)
                     ->where(function ($q) {
                            $q->where('sesi', 'PAGI')
                              ->orWhere('sesi', 'PETANG');
                    })
                    ->first();

        return $sesi->sesi;
    }

    public function confirm_update($id)
    {    
        $pegawai = Pegawai::findOrFail($id);

        return view('pesara.sah_kehadiran', [
            'pegawai' => $pegawai,
        ]);
    }

    public function sah_kehadiran($id){

        $ids = Auth::id();

        Pegawai::where('id',$id)
            ->update([
                'kehadiran'=>1,
                'updated_by'=>$ids,
                'updated_at' => date('Y-m-d G:i:s')]);

        $pegawai = Pegawai::select('pegawai.*','ptj.ptj','jawatan.jawatan','gred.gred')          
                            ->leftjoin('ptj','ptj.id', 'pegawai.ptj_id')
                            ->leftjoin('jawatan','jawatan.id', 'pegawai.jawatan_id')
                            ->leftjoin('gred','gred.id', 'pegawai.gred_id')
                            ->where('pegawai.id', $id)
                            ->paginate(25);
//dd($pegawai);
        $sesi_buka = ApcController::getSesi_buka();

        return view('pesara.index', [
            'pegawai' => $pegawai,
            'record_count' => 1,
            'fnama' => "",
            'fnokp' => "",
            'fptj' => "",
            'fjawatan' => "",
            'frsvp' => "",
            'fsesi' => "",
            'fkehadiran' => "",
            'fno_kerusi' => "",
            'sesi_buka' => $sesi_buka,
        ]);

    }


    public function create(){

    	return view('pesara.create');

    }

    public function store(Request $request)
    {
        //$id = Auth::id();

        $pegawai = new Pegawai();
    
        $pegawai->ptj_id = request('ptj_id');
                         
        $pegawai->save();
        
        return redirect('/pesara')->with('success','Maklumat berjaya disimpan.');
        
    }

    public function edit($id)
    {
        $pegawai = Pegawai::select('pegawai.*','ptj.ptj','jawatan.jawatan','gred.gred')          
                            ->leftjoin('ptj','ptj.id', 'pegawai.ptj_id')
                            ->leftjoin('jawatan','jawatan.id', 'pegawai.jawatan_id')
                            ->leftjoin('gred','gred.id', 'pegawai.gred_id')
                            ->where('pegawai.id',$id)
                            ->first();

        return view('pesara.edit', ['pegawai' => $pegawai]);
    }


    public function update(Request $request)
    {
        $id = request('id');
        $sesi = request('sesi');
        $kehadiran = request('kehadiran');
        $no_kerusi = request('no_kerusi');

        $old =  Pegawai::where('id',$id)->first();      

        $ids = Auth::id();

        Pegawai::where('id',$id)
            ->update([
                'sesi'=>$sesi,
                'kehadiran'=>$kehadiran,
                'no_kerusi'=>$no_kerusi,
                'updated_by'=>$ids,
                'updated_at' => date('Y-m-d G:i:s')]);

echo "no_kerusi".$old->no_kerusi;

        if ($sesi=="PAGI_LEWAT" && $old->no_kerusi <> $no_kerusi) {
echo "masuk lewat pagi";
            $no_kerusi_lewat_pagi = Sesi::where('no_last','LEWAT_PAGI')->first();
            Sesi::where('sesi','PAGI_LEWAT')->update(["no_last"=>$no_kerusi]);
        }
        if ($sesi=="LEWAT_PAGI") {
            $no_kerusi_lewat_petang = Sesi::where('no_last','LEWAT_PETANG')->first();
        }
echo "..selepas";

        $pegawai = Pegawai::select('pegawai.*','ptj.ptj','jawatan.jawatan','gred.gred')          
                            ->leftjoin('ptj','ptj.id', 'pegawai.ptj_id')
                            ->leftjoin('jawatan','jawatan.id', 'pegawai.jawatan_id')
                            ->leftjoin('gred','gred.id', 'pegawai.gred_id')
                            ->where('pegawai.id', $id)
                            ->paginate(25);

        $sesi_buka = ApcController::getSesi_buka();

        return view('pesara.index', [
            'pegawai' => $pegawai,
            'record_count' => 1,
            'fnama' => "",
            'fnokp' => "",
            'fptj' => "",
            'fjawatan' => "",
            'frsvp' => "",
            'fsesi' => "",
            'fkehadiran' => "",
            'fno_kerusi' => "",
            'sesi_buka' => $sesi_buka,
        ]);
    }

    public function search(){

        $ids = Auth::id();

        $nama_search = request('nama');
        $nokp_search = request('nokp');
        $ptj_search = request('ptj');
        $jawatan_search = request('jawatan');
        $rsvp_search = request('rsvp');
        $sesi_search = request('sesi');
        $kehadiran_search = request('kehadiran');
        $no_kerusi_search = request('no_kerusi');


       // ($no_kerusi_search=="") ? $no_kerusi_search = '%' : "";

      // \DB::enableQueryLog(); // Enable query log

        $result= Pegawai::select('pegawai.*','ptj.ptj','jawatan.jawatan','gred.gred')          
                            ->leftjoin('ptj','ptj.id', 'pegawai.ptj_id')
                            ->leftjoin('jawatan','jawatan.id', 'pegawai.jawatan_id')
                            ->leftjoin('gred','gred.id', 'pegawai.gred_id')
                            ->where('pegawai.nama','like','%'.$nama_search.'%')
                            ->where('pegawai.nokp','like','%'.$nokp_search.'%')
                            ->where('ptj.ptj','like','%'.$ptj_search.'%')
                            ->where('jawatan.jawatan','like','%'.$jawatan_search.'%')
                            ->where('pegawai.maklumbalas_kehadiran','like', $rsvp_search)
                            ->where('pegawai.sesi',  'like', $sesi_search )
                            ->where('pegawai.kehadiran', 'like', $kehadiran_search)
                            ;

        if ($no_kerusi_search != "") {
            $result->where('pegawai.no_kerusi', $no_kerusi_search);
        }

        $record_count = $result->count();

        $pegawai = $result->orderby('sesi')
                            ->orderBy(DB::raw('ISNULL(no_kerusi), no_kerusi'), 'ASC')
                            ->paginate(25);
 
 // dd(\DB::getQueryLog()); // Show results of log

        $sesi_buka = ApcController::getSesi_buka();

        return view('pesara.index', [
            'pegawai' => $pegawai,
            'record_count' => $record_count,
            'fnama' => $nama_search,
            'fnokp' => $nokp_search,
            'fptj' => $ptj_search,
            'fjawatan' => $jawatan_search,
             'frsvp' => $rsvp_search,
            'fsesi' => $sesi_search,
            'fkehadiran' => $kehadiran_search,
            'fno_kerusi' => $no_kerusi_search,
            'sesi_buka' => $sesi_buka,
        ]);

    }

    public function getNoLewat($nama_sesi) 
    {
        $sesi = Sesi::where('sesi', $nama_sesi)->pluck("no_last");
        $sesi = Sesi::where('sesi', $nama_sesi)->select("no_last")->first();

        //return json_encode($sesi);
        return $sesi->no_last;
    }


    public function paparan(){

        $pegawai = Pegawai::select('pegawai.*','ptj.ptj','jawatan.jawatan','gred.gred')          
                            ->leftjoin('ptj','ptj.id', 'pegawai.ptj_id')
                            ->leftjoin('jawatan','jawatan.id', 'pegawai.jawatan_id')
                            ->leftjoin('gred','gred.id', 'pegawai.gred_id')
                            ->where(function ($query) {
                                $query->where('sesi', 'PETANG')
                                      ->orWhere('sesi', 'PETANG_LEWAT');
                                    })
                            ->where('kehadiran','1')
                            ->orderby('no_kerusi')
                            ->paginate(1);

        return view('pesara.paparan', [
            'pegawai' => $pegawai,
        ]);

    }

}
