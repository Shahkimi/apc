@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   Selamat Datang {{ Auth::user()->name }}
                    <br> <br>

                    <table class="table table-sm" width="70%">
                        <thead class="thead-dark">
                            <td>#</td>
                            <td>SESI</td>
                            <td>KEHADIRAN</td>
                            <td class="text-center">JUMLAH</td>
                        </thead>

                        @php
                            $i= 1;
                            $jumlah_keseluruhan = 0;
                            $prev_sesi = 'X';
                            $total_pagi = 0;
                            $total_petang = 0;
                        @endphp

                        @foreach($laporan1 as $key=>$row)

                            @php 

                                if ($row->sesi == 'PAGI' || $row->sesi == 'PAGI_LEWAT') {
                                    $total_pagi = $total_pagi + $row->jumlah;
                                }

                                if ($row->sesi == 'PETANG' || $row->sesi == 'PETANG_LEWAT') {
                                    $total_petang = $total_petang + $row->jumlah;
                                }

                                if (($prev_sesi == 'PAGI' || $prev_sesi == 'PAGI_LEWAT') && $row->sesi == 'PETANG') {
                                    echo "<tr style='background-color:#E3F6FF'>";
                                    echo "    <td></td>";
                                    echo "    <td colspan=2 class='font-weight-bold'>TOTAL SESI PAGI</td>";
                                    echo "    <td class='text-center font-weight-bold'>".$total_pagi."</td>";
                                    echo "</tr> ";
                                }

                                $prev_sesi = $row->sesi;

                                $jumlah_keseluruhan = $jumlah_keseluruhan + $row->jumlah  ;
                            @endphp

                            <tr  style='background-color:white'>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->sesi }}</td>
                                <td>{{ ($row->kehadiran==1) ? "HADIR":"TIDAK HADIR/BELUM MENDAFTAR" }}</td>
                                <td class="text-center">{{ $row->jumlah }}</td>
                            </tr> 

                            @if (($i-1)==$laporan1->count())
                                <tr  style='background-color:#E3F6FF'>
                                    <td></td>
                                    <td colspan=2 class='font-weight-bold'>TOTAL SESI PETANG</td>
                                    <td class="text-center font-weight-bold">{{ $total_petang }}</td>
                                </tr> 
                            @endif
                        @endforeach

                        <thead class="thead-dark">
                            <td>#</td>
                            <td colspan="2">JUMLAH KESELURUHAN </td>
                            <td class="text-center font-weight-bold">{{ $jumlah_keseluruhan }}</td>
                        </thead>

                    </table>
                </div>


                <div class="card-body">
                    <table class="table table-sm" width="70%">
                        <thead class="thead-dark">
                            <td>#</td>
                            <td>SESI</td>
                            <td>MAKLUMBALAS KEHADIRAN</td>
                            <td class="text-center">JUMLAH</td>
                        </thead>

                        @php
                            $i= 1;
                            $jumlah_keseluruhan = 0;
                        @endphp

                        @foreach($laporan2 as $key=>$row)

                            <tr  style='background-color:white'>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->sesi }}</td>
                                <td>{{ $row->maklumbalas_kehadiran }}</td>
                                <td class="text-center">{{ $row->jumlah }}</td>
                            </tr> 

                            @php
                                 $jumlah_keseluruhan = $jumlah_keseluruhan + $row->jumlah ;
                            @endphp
                            
                        @endforeach

                        <thead class="thead-dark">
                            <td>#</td>
                            <td colspan="2">JUMLAH KESELURUHAN </td>
                            <td class="text-center font-weight-bold">{{ $jumlah_keseluruhan }}</td>
                        </thead>

                    </table>
                </div>


            </div>
        </div>
    </div>

@endsection
