<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ptj;
use App\Status;
use App\Bahagian;
use App\User;
use App\Aduan;
use App\Jenis;
use App\Role_user;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

date_default_timezone_set("Asia/Kuala_Lumpur");

class ShareController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $ids = Auth::id();
        $no_kp_user = Auth::user()->username;
        $user_role = Role_user::where('user_id',$ids)->first();

        $edited = "";



        $ptj = Ptj::orderBy('ptj','asc')->get();
        $bahagian = Bahagian::orderBy('bahagian','asc')->get();
        $status = Status::orderBy('status','asc')->get();
        $jenis = Jenis::orderBy('jenis','asc')->get();

        $aduan = Aduan::query();

        if ($user_role->role_id =='3') {  //3 = user
            $aduan = $aduan->where('aduan.user_id', $ids);
        }
        $aduan = $aduan
                    ->select('aduan.*', 'ptj.ptj','a.name as nama_pengadu','b.name as nama_penyelaras')
                    ->leftjoin('users as a', 'a.id', '=', 'aduan.user_id')
                    ->leftjoin('users as b', 'b.id', '=', 'aduan.penyelaras_id')
                    ->leftjoin('ptj', 'ptj.id', '=', 'a.ptj_id')
                    ->orderBy('aduan.status_id','asc')
                    ->orderBy('aduan.created_at','desc')
                    ->paginate(25);

        return view('share.index', [
            'aduan' => $aduan,
            'ptj' => $ptj,
            'bahagian' => $bahagian,
            'status' => $status,
            'jenis' => $jenis,
            'fstatus',
            'message',
        ]);
    
    }

    public function edit($id)
    {

        $ids = Auth::id();
        $user_role = Role_user::where('user_id',$ids)->first();

        $edited = "";

        if ($user_role->role_id =='3') {  //3 = user
            $edited = 'readonly';
        }

        $aduan = Aduan::findOrFail($id);
        $ptj = Ptj::orderBy('ptj','asc')->get();
        $bahagian = Bahagian::orderBy('bahagian','asc')->get();
        $status = Status::orderBy('status','asc')->get();

        $jenis = Jenis::orderBy('jenis','asc')->get();

        $roleName = "penyelaras";
        
        $penyelaras = User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('roles.name', $roleName);
            })->get();


        $aduan = Aduan::select('aduan.*', 'aduan.id as id_aduan', 'ptj.ptj','a.*', 'b.name as nama_penyelaras','bahagian.bahagian', 'jawatan.jawatan','gred.gred', 'jenis.jenis', 'status.status')
                    ->leftjoin('users as a', 'a.id', '=', 'aduan.user_id')
                    ->leftjoin('users as b', 'b.id', '=', 'aduan.penyelaras_id')
                    ->leftjoin('ptj', 'ptj.id', '=', 'a.ptj_id')
                    ->leftjoin('bahagian', 'bahagian.id', '=', 'a.bahagian_id')
                    ->leftjoin('jawatan', 'jawatan.id', '=', 'a.jawatan_id')
                    ->leftjoin('gred', 'gred.id', '=', 'a.gred_id')
                    ->leftjoin('status', 'status.id', '=', 'aduan.status_id')
                    ->leftjoin('jenis', 'jenis.id', '=', 'aduan.jenis_id')
                    ->orderBy('aduan.status_id','asc')
                    ->where('aduan.id',$id)
                    ->first();

        return view('share.edit', [
            'aduan' => $aduan,
            'ptj' => $ptj,
            'bahagian' => $bahagian,
            'penyelaras' => $penyelaras,
            'status' => $status,
            'edited'=> $edited,
            'jenis' => $jenis,
        ]);
    }

    public function update(Request $request)
    {
        $ids = Auth::id();

        $id = request('id_aduan');

        $aduan_asal = Aduan::where('id',$id)->first();

        $tarikh_tindakan = $aduan_asal->tarikh_tindakan;

        if ($aduan_asal->status_id == 1 && request('status_id') <> 1) {
            $tarikh_tindakan = date('Y-m-d G:i:s');
        } 

        $data = [
            'penyelaras_id' => request('penyelaras_id'), 
            'status_id' => request('status_id'),
            'tindakan' => request('tindakan'),
            'tarikh_tindakan' => $tarikh_tindakan,
            'tarikh_selesai' => request('tarikh_selesai'),
            'updated_by' => $ids, 
            'updated_at' => date('Y-m-d G:i:s')
        ];

        Aduan::where('id', $id)->update($data);

        return redirect('/senarai/')->with('message','Maklumat berjaya dikemaskini.');

       
            //return redirect('/pegawai');
    }

    public function destroy($id){

        $aduan = Aduan::where('id', $id)->firstOrFail();

        //echo json_encode($pegawai);

        $aduan->delete();

        return redirect('/senarai/')->with('message','Maklumat telah dihapuskan.');
    }



}
                    