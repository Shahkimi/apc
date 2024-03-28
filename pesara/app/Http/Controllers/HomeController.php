<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Sesi;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  /*  public function index(Request $request)
    {
        $request->session()->flash('success', 'testing success flash message');
        $request->session()->flash('warning', 'testing warning flash message');
        $request->session()->flash('error', 'testing error flash message');

        return view('home');
    }*/

    public function index()
    {

        $count_sesi = Pegawai::all()->groupBy('sesi')->groupBy('kehadiran')->count();
 
        $laporan1 = DB::table('pegawai')
                     ->select(DB::raw('count(*) as jumlah, sesi, kehadiran'))
                     ->groupBy('sesi')
                     ->groupBy('kehadiran')
                     ->orderBy('sesi')
                     ->orderBy('kehadiran', 'desc')
                     ->get();

        $laporan2 = DB::table('pegawai')
                     ->select(DB::raw('count(*) as jumlah, sesi, maklumbalas_kehadiran'))
                     ->groupBy('sesi')
                     ->groupBy('maklumbalas_kehadiran')
                     ->orderBy('sesi')
                     ->orderBy('maklumbalas_kehadiran', 'desc')
                     ->get();

        return view('home', [
            'laporan1' => $laporan1,
            'laporan2' => $laporan2,
        ]);

    }
}
