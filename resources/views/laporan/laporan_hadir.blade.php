
@extends('layouts.app')

@section('content')

<div class="container-fluid" style="max-width: 85% ;">
<br><br>
<div class="row">
    <div class="col-lg-12 tbl-print"> <h3>{{ $tajuk }} </h3></div>
</div>

<p class="tbl-print">{{ $pegawai->count() }} rekod dijumpai.</p>
<!-- <center>  <a href="{{url('/laporan/hadirPDF/')}}" class="" target="_blank">CETAK PDF</a></center> -->

<center> <button onclick="window.print()">Print this page</button></center>

<a class="btn" href="{{ url('laporan/hadir/PAGI/pdf') }}" >HADIR PAGI</a>

<!-- <table class="table table-md table-hover table-bordered table-striped"> -->

<table border="1">
  <thead>
                <th class="tbl-print" width="5%" style="text-align:center;">#</th>
                <th class="tbl-print" width="37%" style="text-align:center;">PTJ</th>
                <th class="tbl-print" width="43%" style="text-align:center;">Nama</th>
                <th class="tbl-print" width="7%" style="text-align:center;">Sesi</th>
                <th class="tbl-print" width="7%" style="text-align:center;">No Sijil</th>
                @if($sesi=='PAGI_LEWAT' || $sesi=='PETANG_LEWAT')
                <th class="tbl-print" width="7%" style="text-align:center;">RSVP</th>
                <th class="tbl-print" width="7%" style="text-align:center;">NO KERUSI</th>
                @endif
        </thead>

 @php
    $bil = 1;
 @endphp

@foreach($pegawai as $key=>$row)
    <tr>
        <td class="tbl-print" style="text-align:center;">{{ $bil++ }}</td>
        <td class="tbl-print">{{ $row->ptj->ptj }}</td>
        <td class="tbl-print">{{ $row->nama }}</td>
        <td class="tbl-print" style="text-align:center;">{{ $row->sesi }}</td>
        <td class="tbl-print" style="text-align:center;">{{ $row->no_sijil}}</td>
        @if($row->sesi=='PAGI_LEWAT' || $row->sesi=='PETANG_LEWAT')
            <td class="tbl-print" style="text-align:left;">{{ $row->maklumbalas_kehadiran}} </td>
            <td class="tbl-print" style="text-align:left;">{{ $row->no_kerusi}} </td>
        @endif
    </tr>
@endforeach
</table>



</div>

<br><br>
@endsection

<script type="text/javascript">

</script>
