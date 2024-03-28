<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bahagian;
use App\PTJ;
use Illuminate\Support\Facades\Auth;
use DB;

class BahagianController extends Controller
{
    public function index(){

        $ptj = Ptj::orderBy('ptj')
                ->get();

        $bahagian = Bahagian::select('bahagian.*', 'ptj.ptj')
                    ->leftJoin('ptj', 'ptj.id', '=', 'bahagian.ptj_id')
                    ->orderby('ptj')
                    ->orderby('bahagian')
                    ->paginate(25);

		return view('bahagian.index', [
            'bahagian' => $bahagian,
			'ptj' => $ptj,
            'fptj' => "",
            'fbahagian' => "",
		]);
    }

    public function create(){

    	$ptj = Ptj::orderBy('ptj')->get();

        return view('bahagian.create', [
            'ptj' => $ptj,
        ]);

    }

    public function search(){

        $id = Auth::id();
        $nama_ptj = request('nama_ptj');
        $nama_bahagian = request('nama_bahagian');
        
        $ptj = Ptj::orderBy('ptj')->get();

        $bahagian = Bahagian::leftJoin('ptj', 'ptj.id', '=', 'bahagian.ptj_id')
                    ->where('bahagian','like','%'.$nama_bahagian.'%')
                    ->where('ptj.ptj','like','%'.$nama_ptj.'%')
                    ->orderby('ptj')
                    ->orderby('bahagian')
                    ->paginate(25);

            //echo json_encode($siasatan);

        return view('bahagian.index', [
            'bahagian' => $bahagian,
            'ptj' => $ptj,
            'fptj' => $nama_ptj,
            'fbahagian' => $nama_bahagian,
        ]);
    }

    public function store(Request $request)
    {
        //$id = Auth::id();

        $bahagian = new Bahagian();
    
        $bahagian->ptj_id = request('ptj_id');
        $bahagian->bahagian = request('bahagian');
                         
        $bahagian->save();

        return redirect('bahagian')->with('success','Maklumat berjaya disimpan.');
        
    }

    public function edit($id)
    {
        $ptj = Ptj::orderBy('ptj')->get();
        $bahagian = Bahagian::findOrFail($id);

        return view('bahagian.edit', [
                'ptj' => $ptj,
                'bahagian' => $bahagian,
            ]);
    }

    public function update(Request $request)
    {
        $id = request('id');
        $ptj_id = request('ptj_id');
        $bahagian = request('bahagian');
       
        $ids = Auth::id();


            $bahagian=DB::table('bahagian')
            ->where('id',$id)
            ->update([
                'ptj_id'=>$ptj_id,
                'bahagian'=>$bahagian,
                'updated_by'=>$ids,
                'updated_at' => date('Y-m-d G:i:s')]);
        //$tsticker=Sticker::find($id);
        //$tsticker->touch();
        return redirect('/bahagian/')->with('success','Maklumat berjaya dikemaskini.');
        

       
            //return redirect('/pegawai');
    }


    public function destroy($id){
        $bahagian = Bahagian::findOrFail($id);
        $bahagian->delete();

        return redirect('/bahagian');
    }
        
}
