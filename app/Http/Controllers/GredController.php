<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gred;
use Illuminate\Support\Facades\Auth;
use DB;

class GredController extends Controller
{
    public function index(){

		$gred = Gred::orderBy('gred')->paginate(25);

		return view('gred.index', [
			'gred' => $gred,
            'fgred' => "",
		]);


    }

    public function create(){

    	return view('gred.create');

    }

    public function store(Request $request)
    {
        $gred = new Gred();
    
        $gred->gred = strtoupper(request('gred'));
                         
        $gred->save();
        
        return redirect('/gred')->with('success','Maklumat berjaya disimpan.');
        
    }

    public function edit($id)
    {
        $gred = Gred::findOrFail($id);

        return view('gred.edit', 
            [
                'gred' => $gred, 
            ]);
    }

    public function update(Request $request)
    {
        $id = request('id');
        $gred  = strtoupper(request('gred'));
       
        $ids = Auth::id();

        $gred = DB::table('gred')
            ->where('id',$id)
            ->update([
                'gred'=>$gred,
                'updated_by'=>$ids,
                'updated_at' => date('Y-m-d G:i:s')]);

        return redirect('/gred')->with('success','Maklumat berjaya dikemaskini.');
    }

    public function destroy($id){
        $gred = Gred::findOrFail($id);
        $gred->delete();

        return redirect('/gred');
    }

    public function search(){

        $id = Auth::id();
      
        $greds = request('gred');

        $gred = Gred::where('gred','like','%'.$greds.'%')
                    ->paginate(25);

        return view('gred.index', [
            'gred' => $gred,
            'fgred' => $greds,
        ]);


    }


}
