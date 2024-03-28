<?php

namespace App\Exports;

use App\Pegawai;
use DB;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PegawaiExport implements FromCollection, WithHeadings
{
    //use Exportable;

public function collection()
    {
        $type = Pegawai::select('pegawai.id','ptj.ptj','nama','nokp','jawatan.jawatan', 'gred.gred','maklumbalas_kehadiran',
                                'sesi',
                                \DB::raw('(CASE 
                                                WHEN kehadiran = "0" THEN "Tidak Hadir" 
                                                WHEN kehadiran = "1" THEN "Hadir" 
                                                ELSE "Owner" 
                                                END) AS kehadiran'),
                                'no_kerusi', 'no_kerusi_asal')
                ->leftjoin('ptj','ptj.id', 'pegawai.ptj_id')
                ->leftjoin('jawatan','jawatan.id', 'pegawai.jawatan_id')
                ->leftjoin('gred','gred.id', 'pegawai.gred_id')
                ->orderby('sesi')
                ->orderby('kehadiran')
                ->orderby('no_kerusi')
                ->get();
        return $type ;
    }

    public function headings(): array
    {
        return ["bil","PTJ", "nama", "nokp","Jawatan","Gred","RSVP", "Sesi", "Kehadiran", "No Kerusi", "No Kerusi Asal"];
    }
}