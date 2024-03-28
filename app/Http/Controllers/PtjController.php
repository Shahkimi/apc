<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ptj;
use App\Bahagian;
use DB;
use Illuminate\Support\Facades\Auth;

class PtjController extends Controller
{
    public function index(){

		$ptj = PTJ::sortable()->paginate(25);

		return view('ptj.index', [
			'ptj' => $ptj,
            'fptj' => "",
		]);

    }

    public function create(){

    	$ptj = Ptj::all();

    	return view('ptj.create',[
    		'ptj' => $ptj,
    	]);
    }

    public function store(Request $request)
    {
        //$id = Auth::id();

        
        $ptj = new ptj();

        $ptj->ptj = strtoupper(request('ptj'));
                         
        $ptj->save();
        
        return redirect('ptj')->with('success','Maklumat berjaya disimpan.');
      
        
    }

    public function edit($id)
    {

        $ptj = PTJ::where('ptj.id',$id)->first();
        //echo json_encode($tsticker);

        return view('ptj.edit',[
            'ptj' => $ptj,
        ]);

    }

    public function update(Request $request)
    {
        $id = request('id');
        $ptj = request('ptj');
        
        $ids = Auth::id();

        $ptj=DB::table('ptj')
            ->where('id',$id)
            ->update([
                'ptj'=>$ptj,
                'updated_by'=>$ids,
                'updated_at' => date('Y-m-d G:i:s')
                ]);

        return redirect('/ptj')->with('success','Maklumat berjaya dikemaskini.');
        
    }


    public function destroy($id){
        
        $ptj = Ptj::findOrFail($id);
        $ptj->delete();

        return redirect('/ptj')->with('success', $ptj->ptj. ' berjaya dihapuskan.');;
    }

    public function search(){

        $id = Auth::id();
        $namaptj = request('ptj');
        
        $ptj = PTJ::where('ptj','like','%'.$namaptj.'%')
                    ->sortable()
                    ->paginate(25);

            //echo json_encode($siasatan);

        return view('ptj.index', [
            'ptj' => $ptj,
            'fptj' => $namaptj
        ]);
    }


}
