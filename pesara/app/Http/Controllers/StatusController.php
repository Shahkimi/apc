<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use Illuminate\Support\Facades\Auth;
use DB;

class StatusController extends Controller
{
    public function index(){

        $status = Status::orderBy('status')         
                        ->paginate(25);

		return view('status.index', [
			'status' => $status,
		]);


    }

    public function create(){

    	return view('status.create');

    }

     public function store(Request $request)
    {
        
        $status = new Status();
    
        $status->status = strtoupper(request('status'));
                         
        $status->save();
        
        return redirect('/status')->with('success','Maklumat berjaya disimpan.');
        
    }

    public function edit($id)
    {
        $status = Status::findOrFail($id);

        return view('status.edit', ['status' => $status]);
    }

    public function update(Request $request)
    {
        $id = request('id');
        $status = strtoupper(request('status'));
       
        $ids = Auth::id();


            $status=DB::table('status')
            ->where('id',$id)
            ->update([
                'status'=>$status,
  
                'updated_by'=>$ids,
                'updated_at' => date('Y-m-d G:i:s')]);
        //$tsticker=Sticker::find($id);
        //$tsticker->touch();
        return redirect('/status')->with('success','Maklumat berjaya dikemaskini.');
        

       
            //return redirect('/pegawai');
    }

    public function destroy($id){
        $status = Status::findOrFail($id);
        $status->delete();

        return redirect('/status');
    }

    public function search(){

        $id = Auth::id();
      

   
            $bahagians = request('status');
          

            $status = DB::table('status')
                    
                        ->select('*')
              
                        ->where('status','like','%'.$bahagians.'%')
               
                        ->paginate(25);
                        //echo $akta;
                //echo json_encode($siasatan);
            return view('status.index', ['status' => $status]);
                

            }
      



        
}
