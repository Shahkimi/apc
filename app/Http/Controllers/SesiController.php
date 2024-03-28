<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sesi;
use Illuminate\Support\Facades\Auth;
use DB;

class SesiController extends Controller
{
    public function index(){

		$sesi = Sesi::orderBy('sesi')->paginate(25);

		return view('sesi.index', [
			'sesi' => $sesi,
            'fsesi' => "",
		]);


    }

    public function create(){

    	return view('sesi.create');

    }

    public function store(Request $request)
    {
        $sesi = new Sesi();
    
        $sesi->sesi = strtoupper(request('sesi'));
                         
        $sesi->save();
        
        return redirect('/sesi')->with('success','Maklumat berjaya disimpan.');
        
    }

    public function edit($id)
    {
        $sesi = Sesi::findOrFail($id);
echo "lailai";
        return view('sesi.edit', 
            [
                'sesi' => $sesi, 
            ]);
    }

    public function update(Request $request)
    {
        $id = request('id');
        $sesi  = request('sesi');
        $no_last  = request('no_last');
        $buka  = request('buka');
       
        $ids = Auth::id();

        $sesi = DB::table('sesi')
            ->where('id',$id)
            ->update([
                'sesi'=>$sesi,
                'buka'=>$buka,
                'no_last'=>$no_last,
                'updated_by'=>$ids,
                'updated_at' => date('Y-m-d G:i:s')]);

        return redirect('/sesi')->with('success','Maklumat berjaya dikemaskini.');
    }

    public function destroy($id){
        $sesi = Sesi::findOrFail($id);
        $sesi->delete();

        return redirect('/sesi');
    }

    public function search(){

        $id = Auth::id();
      
        $sesis = request('sesi');

        $sesi = Sesi::where('sesi','like','%'.$sesis.'%')
                    ->paginate(25);

        return view('sesi.index', [
            'sesi' => $sesi,
            'fsesi' => $sesis,
        ]);


    }


}
