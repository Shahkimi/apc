
@extends('layouts.app')

@section('content')

<br>

<div class="card center shadow-lg mx-auto" style="max-width: 50%;">

        <div class="card-header text-center">
            SILA CATIT MAKLUMAT PEGAWAI
        </div>

        <div class="card-body">
            <table class="table table-sm">
                <tr><td>Nama</td><td>{{ $pegawai->nama }} </td></tr>
                <tr><td>No KP</td><td>{{ $pegawai->nokp }} </td></tr>
                <tr><td>PTJ</td><td>{{ $pegawai->ptj->ptj }} </td></tr>
                <tr><td>Jawatan</td><td>{{ $pegawai->jawatan->jawatan. " ".$pegawai->gred->gred }} </td></tr>
                <tr><td>RSVP</td><td><p4>{{ $pegawai->maklumbalas_kehadiran }} </p4></td></tr>
                <tr><td>SESI</td><td><p4>{{ $pegawai->sesi }} </p4></td></tr>
                <tr><td>No Kerusi</td>
                    <td class="font-weight-bold text-info h2 mt-5">{{ $pegawai->no_kerusi }}</td>
                </tr>
                <tr></tr>
            </table>
        </div>

        <div style="text-align: center;">
            <a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>

            @if ($pegawai != "")
                <a href="{{url('/apc/sah_kehadiran/'.$pegawai->id)}}" class="btn btn-primary mb-2">SIMPAN</a> 
            @endif
        </div>
        <br>
</div>

<br>

       
@endsection

<script type="text/javascript">

    function semak(no) {
       alert(no);
    }

</script>