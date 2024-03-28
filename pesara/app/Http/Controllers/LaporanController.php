<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Sesi;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;
use App\Exports\UsersExport;
use App\Exports\PegawaiExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;


class LaporanController extends Controller
{
    public function hadir($sesi,$jenis){


        $result = Pegawai::orderBy('no_kerusi');

        switch ($sesi) {
            case 'PAGI':
                $tajuk = "LAPORAN PEGAWAI HADIR MAJLIS APC (SESI PAGI)";
                $result->where('kehadiran',1);
                break;
             case 'PAGI_LEWAT':
                $tajuk = "LAPORAN PEGAWAI HADIR MAJLIS APC (SESI PAGI LEWAT)";
                $result->where('kehadiran',1);
                break;
             case 'PETANG':
                $tajuk = "LAPORAN PEGAWAI HADIR MAJLIS APC (SESI PETANG)";
                $result->where('kehadiran',1);
                break;
             case 'PETANG_LEWAT':
                $tajuk = "LAPORAN PEGAWAI HADIR MAJLIS APC (SESI PETANG LEWAT)";
                $result->where('kehadiran',1);
                break;

             case 'TH_PAGI':
                $tajuk = "LAPORAN PEGAWAI TIDAK HADIR MAJLIS APC (PAGI) (RSVP = YA)";
                $sesi = "PAGI";
                $result->where('kehadiran',0)
                        ->where('maklumbalas_kehadiran',"YA");
                break;

             case 'TH_PETANG':
                $tajuk = "LAPORAN PEGAWAI TIDAK HADIR MAJLIS APC (PETANG) (RSVP = YA)";
                $sesi = "PETANG";
                $result->where('kehadiran',0)
                        ->where('maklumbalas_kehadiran',"YA");
                break;
        }

        $pegawai = $result->where('sesi',$sesi)->get();

        if ($jenis=='view') {
    		return view('laporan.laporan_hadir', [
                'pegawai' => $pegawai,
                'tajuk' => $tajuk,
    			'sesi' => $sesi,

    		]);
        }
        else if ($jenis=='pdf') {
            $pdf = PDF::loadView('laporan.laporan_hadir', [
                'pegawai' => $pegawai,
                'tajuk' => $tajuk,
                'sesi' => $sesi,

            ]);

            return $pdf->download('invoice.pdf');
        }

    }

    function hadirPDF(){

        $pegawai = Pegawai::where('kehadiran','1')
            ->orderBy('sesi')
            ->orderBy('no_kerusi')
            ->get();

        $pdf = PDF::loadView('laporan.hadirPDF' , 
                [   'pegawai' => $pegawai, 
                ])
                ->setPaper('a4', 'potrait');

        //fileName = $tpegawai->nama;

        return $pdf->stream('senarai_hadir.pdf');

    }

     public function importExportView()

    {

       return view('laporan.import');

    }

   

    /**

    * @return \Illuminate\Support\Collection

    */

    public function export() 

    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

   
    public function exportPegawai() 

    {
        return Excel::download(new PegawaiExport, 'pegawai.xlsx');
    }


    /**

    * @return \Illuminate\Support\Collection

    */

    public function import() 

    {
        Excel::import(new UsersImport,request()->file('file'));
        return back();
    }

}
