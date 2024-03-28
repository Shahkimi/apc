<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Ptj;
use App\Bahagian;
use App\Jawatan;
use App\Gred;
use App\Aduan;
use App\User;
use App\Jenis;
use App\Role;
use DB;
use Carbon\Carbon;
use App\Mail\EmelPenyelaras;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set("Asia/Kuala_Lumpur");



class GuestController extends Controller
{

   public function addAduan() {

        $jenis = Jenis::orderBy('jenis')->get();
        $ptj = Ptj::orderBy('ptj')->get();
        $ptjfirst = Ptj::orderBy('ptj')->first();

        $bahagian = Bahagian::orderBy('bahagian')->where('ptj_id', $ptjfirst->id)->get();

        $jawatan = Jawatan::orderBy('jawatan')->get();
        $gred = Gred::orderBy('gred')->get();

        return view('guest', [
            'ptj' => $ptj,
            'bahagian' => $bahagian,
            'jawatan' => $jawatan,
            'gred' => $gred,
            'jenis' => $jenis,
        ]);
   }


   public function index()
    {
        $ptj = Ptj::orderBy('ptj')->get();
        $ptjfirst = Ptj::orderBy('ptj')->first();

        $bahagian = Bahagian::orderBy('bahagian')->where('ptj_id', $ptjfirst->id)->get();

        $jawatan = Jawatan::orderBy('jawatan')->get();

        return view('welcome', [
            'ptj' => $ptj,
            'bahagian' => $bahagian,
            'jawatan' => $jawatan,
        ])
        ;
    }

    public function store(Request $request)
    {

        $image_name = "";

        if($file = $request->file('lampiran'))
        {
           $image_name = time() . '.' . $file->getClientOriginalExtension();
           $destinationPath = public_path('lampiran');
           $file->move($destinationPath,$image_name);
           $data['product_image'] = $image_name;
        }

        $temp_password = "";
        $user_exist = 0;

        if (Auth::guest()) {
                $user = new User();

                $user->username  = request('username');
                $user->name  = request('name');
                $user->ptj_id  = request('ptj_id');
                $user->bahagian_id  = request('bahagian_id');
                $user->jawatan_id  = request('jawatan_id');
                $user->gred_id  = request('gred_id');
                $user->no_telefon  = request('no_telefon');
                $user->email  = request('email');

                $temp_password = bin2hex(openssl_random_pseudo_bytes(4));

                $user->password  = Hash::make($temp_password);

                $user_exist = User::where('username', $user->username)->first();

                if ($user_exist) {
                    $info = "Berdasarkan No KP yang diberi, anda telah didaftarkan sebagai pengguna sistem. Sila semak emel ".$user_exist->email;

                    $user = User::where('username',$user->username)
                            ->update([
                                'name'=>$user->name,
                                'ptj_id'=>$user->ptj_id,
                                'bahagian_id'=>$user->bahagian_id,
                                'jawatan_id'=>$user->jawatan_id,
                                'gred_id'=>$user->gred_id,
                                'no_telefon'=>$user->no_telefon,
                                'email'=>$user->email,
                                'updated_by'=>$user_exist->id,
                                'updated_at' => date('Y-m-d G:i:s')]);
                    
                } else {
                    $info = "ADD";
                    $user->save();

                   // $role = Role::select('id')->where('name','User')->first();
                    $user->roles()->attach('3'); //3 user

                }

        } else {
            $user_exist = 1;
        } //end if guest

        $id_user = User::where('username', $request->username)->first();

        $aduan = new Aduan();
        
        $aduan->user_id = $id_user->id;
        $aduan->jenis_id = request('jenis_id');
        $aduan->status_id  = '1';
        $aduan->tajuk = request('tajuk');
        $aduan->butiran  = request('butiran');
        $aduan->lokasi  = request('lokasi');
        $aduan->created_at = date('Y-m-d G:i:s');
        $aduan->lampiran = $image_name;
        
        $aduan->save();

        $jenis = Jenis::where('id',request('jenis_id'))->first();
        $ptj = PTJ::where('id',request('ptj_id'))->first();
        $bahagian = Bahagian::where('id',request('bahagian_id'))->first();
        $jawatan = Jawatan::where('id',request('jawatan_id'))->first();
        $gred = Gred::where('id',request('gred_id'))->first();

        $data = [
            'username' => request('username'),
            'name' => request('name'), 
            'jenis' => $jenis->jenis,
            'ptj' => $ptj->ptj,
            'bahagian' => $bahagian->bahagian,
            'jawatan' => $jawatan->jawatan,
            'gred' => $gred->gred,
            'no_telefon' => request('no_telefon'),
            'email' => request('email'),
            'tajuk' => request('tajuk'),
            'butiran' => request('butiran'),
            'lokasi' => request('lokasi'),
            'lampiran' => request('lampiran'),
            'user_exist'=> $user_exist,
            'password'=> $temp_password,
            
            'created_at' => date('Y-m-d G:i:s')
        ];

        $emailArray = array();

        $EmelPenyelaras = User::select('users.*')
            ->leftjoin('role_user','role_user.user_id', 'users.id')
            ->where('role_user.role_id','2') //penyelaras
            ->get();

        foreach ($EmelPenyelaras as $key=>$row) {
            $emailArray[] = $row->email;

        }

        $emailArray[] = 'sistem.kdh@moh.gov.my';

        foreach($emailArray as $user){
            \Mail::to($user)->send(new \App\Mail\EmelPenyelaras($data));
        }  
        
        \Mail::to(request('email'))->send(new \App\Mail\EmelUser($data));

        return redirect('/')->with('message','Aduan / maklumbalas telah berjaya disimpan. Terima kasih di atas kerjasama anda. Salinan Aduan / maklumbalas akan dihantar ke emel anda. ('.Carbon::now()->format('d-m-Y h:i:s').")");
    }

    public function getBahagian($ptj_id) 
    {
        $bahagian = Bahagian::where('ptj_id', $ptj_id)->orderBy('bahagian')->pluck("id","bahagian");
        return json_encode($bahagian);
    }

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}
//