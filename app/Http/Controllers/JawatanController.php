<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawatan;
use Illuminate\Support\Facades\Auth;
use DB;

class JawatanController extends Controller
{
    public function index(){

		$jawatan = Jawatan::orderBy('jawatan')    
                        ->paginate(25);

		return view('jawatan.index', [
			'jawatan' => $jawatan,
		]);


    }

    public function create(){

    	return view('jawatan.create');

    }

    public function store(Request $request)
    {
        //$id = Auth::id();

        
        $jawatan = new Jawatan();
    
        $jawatan->jawatan = request('jawatan');                         
        $jawatan->save();
        
        return redirect('/jawatan')->with('success','Maklumat berjaya disimpan.');
        
    }

    public function edit($id)
    {
        /*
        $siasatan = Siasatan::all();
        $akta = Akta::all();
        $daerah = Daerah::all();

        return view('siasatan.edit',compact('siasatan', 'akta', 'daerah'));
        */
        $jawatan = Jawatan::findOrFail($id);

        return view('jawatan.edit', ['jawatan' => $jawatan]);
    }

    public function update(Request $request)
    {
        $id = request('id');
        $jawatan = strtoupper(request('jawatan'));
       
        $ids = Auth::id();


            $jawatan=DB::table('jawatan')
            ->where('id',$id)
            ->update([
                'jawatan'=>$jawatan,
  
                'updated_by'=>$ids,
                'updated_at' => date('Y-m-d G:i:s')]);
        //$tsticker=Sticker::find($id);
        //$tsticker->touch();
        return redirect('/jawatan/show/'.$id.'/')->with('success','Maklumat berjaya dikemaskini.');
        

       
            //return redirect('/pegawai');
    }

    public function show($id){

        $jawatan = Jawatan::findOrFail($id);

        return view('jawatan.show', ['jawatan' => $jawatan]);

   

    }

    public function destroy($id){
        $jawatan = Jawatan::findOrFail($id);
        $jawatan->delete();

        return redirect('/jawatan');
    }

    public function search(){

        $id = Auth::id();
      

   
            $jawatans = request('jawatan');
          

            $jawatan = DB::table('jawatan')
                    
                        ->select('*')
              
                        ->where('jawatan','like','%'.$jawatans.'%')
               
                        ->paginate(25);
                        //echo $akta;
                //echo json_encode($siasatan);
            return view('jawatan.index', ['jawatan' => $jawatan]);
                

        }

}
