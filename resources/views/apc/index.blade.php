
@extends('layouts.app')

@section('content')


<div class="container-fluid" style="max-width: 95%;">

  <br><br>

<h2>SENARAI PENERIMA APC</h2>

<table class="table table-hover">
	<thead class="thead-light">
            <tr class="text-light font-weight-bold"><td colspan=10">{{ $record_count }} rekod dijumpai.</td></tr>
            <tr>    
                <th scope="col">#</th>
                <th scope="col">PTJ</th>
                <th scope="col">No KP</th>
                <th scope="col">Nama</th>
                <th scope="col">Jawatan / Gred</th>
                <th scope="col">RSVP</th>
                <th scope="col">Sesi</th>
                <th scope="col">Kehadiran</th>
                <th scope="col">No Kerusi</th>
                <th width="10%"></th>
   
            </tr>
        </thead>

        <thead class="thead-light">
            <tr> 
                <th scope="col"></th>
                <form action="{{url('/apc/search')}}" method="GET" id="search">
                    @csrf

                <th scope="col"><input class="form-control" type="text" name="ptj" form="search" value="{{ $fptj }}"></th>
                <th scope="col"><input class="form-control" type="text" name="nokp" form="search" value="{{ $fnokp }}"></th>
                <th scope="col"><input class="form-control" type="text" name="nama" form="search" value="{{ $fnama }}"></th>
                <th scope="col"><input class="form-control" type="text" name="jawatan" form="search" value="{{ $fjawatan }}"></th>
                <th scope="col">
                    <select name="rsvp" class="form-control" form="search" >
                        <option value="%"></option>
                        <option value="YA" {{ ($frsvp=="YA")? "selected" : "" }} >YA</option>
                        <option value="TIDAK" {{ ($frsvp=="TIDAK")? "selected" : "" }} >TIDAK</option>
                    </select>
                </th>
                <th scope="col">
                    <select name="sesi" class="form-control" form="search" >
                        <option value="%"></option>
                        <option value="PAGI" {{ ($fsesi=="PAGI")? "selected" : "" }} >PAGI</option>
                        <option value="PAGI_LEWAT" {{ ($fsesi=="PAGI_LEWAT")? "selected" : "" }} >PAGI_LEWAT</option>
                        <option value="PETANG" {{ ($fsesi=="PETANG")? "selected" : "" }} >PETANG</option>
                        <option value="PETANG_LEWAT" {{ ($fsesi=="PETANG_LEWAT")? "selected" : "" }} >PETANG_LEWAT</option>
                    </select>
                </th>
                <th scope="col">
                    <select name="kehadiran" class="form-control" form="search" >
                        <option value="%"></option>
                        <option value="1" {{ ($fkehadiran=="YA")? "selected" : "" }} >YA</option>
                        <option value="0" {{ ($fkehadiran=="TIDAK")? "selected" : "" }} >TIDAK</option>
                    </select>
                </th>
                <th scope="col"><input class="form-control" type="text" name="no_kerusi" form="search" value="{{ $fno_kerusi }}"></th>
      
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian Pegawai" form="search"></th>
        
                </form>
                <!--<th scope="col"></th>-->
            </tr>  
        </thead>

@foreach($pegawai as $key=>$row)
    <tr style=" @if($row->sesi=='PETANG') 
                    background-color: #FEF98E 
                @else
                    background-color: white 
                @endif ">

		<td>{{ $pegawai->firstItem() + $key }}</td>
        <td>{{ $row->ptj }}</td>
        <td>{{ $row->nokp }}</td>
        <td>{{ $row->nama }}</td>
        <td>{{ $row->jawatan }} {{ $row->gred }}</td>
        <td>{{ $row->maklumbalas_kehadiran }}</td>
        <td>{{ $row->sesi }}</td>
        <td>{{ ($row->kehadiran==1) ? "HADIR":"" }}</td>
        <td>{{ ($row->kehadiran==1) ? $row->no_kerusi:"" }}</td>
        <td style="text-align: center">
            <div class="d-flex flex-row">
                @can('admin-menu')  
                    <div class="p-2">
                   <a href="{{url('/apc/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                    </div>
                @endcan
                @if($row->maklumbalas_kehadiran == "YA" AND $sesi_buka == $row->sesi)

                  <div class="p-2">
                   <a href="{{url('/apc/confirm_update/'.$row->id)}}" class="font-weight-bold text-info" style=" font-size:18px">SAH</a> 
                </div>
                @endif

            </div>
        </td>
	</tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$pegawai->appends(request()->query())->links()}}</div></dir></div>


</div>

<br><br>
       
@endsection
