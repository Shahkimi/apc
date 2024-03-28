<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Auth;
use DB;

class RoleController extends Controller
{
    public function index(){

        //$gred = Gred::all();
        //$tpegawai = Pegawai::orderBy('pegawai_nama','asc');

        $role = DB::table('roles')
                    
                        ->select('*')         
                        ->paginate(25);

        return view('role.index', [
            'role' => $role
        ]);

    }

    public function create(){

        return view('role.create');

    }

    public function store(Request $request)
    {
        //$id = Auth::id();

        
        $role = new Role();
    
        $role->name = request('name');
        $role->view_aduan = request('view_aduan');
        $role->add_aduan = request('add_aduan');
        $role->edit_aduan = request('edit_aduan');
        $role->delete_aduan = request('delete_aduan');
        $role->view_penyelaras = request('view_penyelaras');
        $role->add_penyelaras = request('add_penyelaras');
        $role->edit_penyelaras = request('edit_penyelaras');
        $role->delete_penyelaras = request('delete_penyelaras');
        $role->view_pengguna = request('view_pengguna');
        $role->add_pengguna = request('add_pengguna');
        $role->edit_pengguna = request('edit_pengguna');
        $role->delete_pengguna = request('delete_pengguna');
                         
        $role->save();
        
        return redirect('/role')->with('success','Maklumat berjaya disimpan.');
        
    }

    public function edit($id)
    {
        /*
        $siasatan = Siasatan::all();
        $akta = Akta::all();
        $daerah = Daerah::all();

        return view('siasatan.edit',compact('siasatan', 'akta', 'daerah'));
        */
        $role = Role::findOrFail($id);

        return view('role.edit', ['role' => $role]);
    }

    public function update(Request $request)
    {
        $id = request('id');
        //$name  = strtoupper(request('name'));
        $name  = request('name');
        $view_aduan = request('view_aduan');
        $add_aduan = request('add_aduan');
        $edit_aduan = request('edit_aduan');
        $delete_aduan = request('delete_aduan');
        $view_penyelaras = request('view_penyelaras');
        $add_penyelaras = request('add_penyelaras');
        $edit_penyelaras = request('edit_penyelaras');
        $delete_penyelaras = request('delete_penyelaras');
        $view_pengguna = request('view_pengguna');
        $add_pengguna = request('add_pengguna');
        $edit_pengguna = request('edit_pengguna');
        $delete_pengguna = request('delete_pengguna');
       
        $ids = Auth::id();


            $role = DB::table('roles')
            ->where('id',$id)
            ->update([
                'name'=>$name,
                'view_aduan'=>$view_aduan,
                'add_aduan'=>$add_aduan,
                'edit_aduan'=>$edit_aduan,
                'delete_aduan'=>$delete_aduan,
                'view_penyelaras'=>$view_penyelaras,
                'add_penyelaras'=>$add_penyelaras,
                'edit_penyelaras'=>$edit_penyelaras,
                'delete_penyelaras'=>$delete_penyelaras,
                'view_pengguna'=>$view_pengguna,
                'add_pengguna'=>$add_pengguna,
                'edit_pengguna'=>$edit_pengguna,
                'delete_pengguna'=>$delete_pengguna,
                'updated_by'=>$ids,
                'updated_at' => date('Y-m-d G:i:s')]);
        //$tsticker=Sticker::find($id);
        //$tsticker->touch();
        return redirect('/role')->with('success','Maklumat berjaya dikemaskini.');
        

       
            //return redirect('/pegawai');
    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('/role');
    }

    public function search(){

        $id = Auth::id();
      
            $name = request('name');
          

            $role = DB::table('roles')
                    
                        ->select('*')
              
                        ->where('name','like','%'.$name.'%')
               
                        ->paginate(25);
                        //echo $akta;
                //echo json_encode($siasatan);
            return view('role.index', ['role' => $role]);
                

    }



}
