
@extends('layouts.app')

@section('content')

<br>
<div class="container-fluid bg-white shadow-lg p-0" style="max-width: 95%">


<!-- <th>@sortablelink('name')</th> -->
            <!-- <th>@sortablelink('price')</th> -->
            <!-- <th>@sortablelink('details')</th> -->
            <!-- <th>@sortablelink('created_at')</th> -->

<div class="m-0 p-3 text-center" style="background-color: #A4D7E1 !important;">
    <h2>Senarai Maklum Balas</h2>
</div>

<div>       
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
</div>
<br>
<div class="container-fluid">
<table class="table table-md table-hover table-bordered">
    <thead class="" style="background-color: #DAF1F9 !important;">
        <tr>    
            <th scope="col" class="align-top ">#</th>
            <th scope="col" class="align-top">Tarikh Aduan</th>
            <th scope="col" class="align-top">Jenis</th>
            <th scope="col" class="align-top">PTJ</th>
            <th scope="col" class="align-top">Tajuk</th>
            <th scope="col" class="align-top">Butiran</th>
            <th scope="col" class="align-top">Status</th>
            <th scope="col" class="align-top">Tindakan</th>
            <th scope="col" class="align-top">Nama Pengadu</th>
            <th scope="col" class="align-top">Pegawai Penyelaras</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <thead>
        <tr> 
            <form action="{{url('/aduan/search')}}" method="GET" id="search">
                @csrf
                <th scope="col"></th>
                <th scope="col"><input class="form-control" type="date" name="created_at" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="jenis_id" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="ptj_id" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="masalah" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="aduan" form="search"></th>
                <th scope="col">
                    <select class="form-control btn-sm" name="status_id" form="search">
                        <option value="%">Status</option>
                        @foreach ($status as $row)
                            <option value="{{$row->id}}" {{($row->id == 1)? "selected" : "" }}>{{$row->status}}</option>
                        @endforeach
                    </select>
                </th>
                <th scope="col"><input class="form-control" type="text" name="tindakan" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="nama_pegawai" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="nama_penyelaras" form="search"></th>
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian" form="search"></th>
        
            </form>
                <!--<th scope="col"></th>-->
            </tr>  
    </thead>

@foreach($aduan as $key=>$row)

    @php
        (strlen($row->butiran) > 200) ? $butiran_str = substr($row->butiran,0,200).'...' : $butiran_str = $row->butiran;

        switch ($row->status_id) {
              case "1": //new
                $color_coded = 'LightYellow';
                break;
              case '2': //dalam tindakan
                $color_coded = '#EEF1FF';
                break;
              default:
                $color_coded = '';
            }
    @endphp

    <tr  style="background-color:{{ $color_coded }} ">
        <td>{{ $aduan->firstItem() + $key }}</td>
        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }} <br> {{ \Carbon\Carbon::parse($row->created_at)->format('h:i:s') }}</td>
        <td>{{ $row->jenis->jenis }}</td>
        <td>{{ $row->ptj }}</td>
        <td>{{ $row->tajuk }}</td>
        <td>{{ $butiran_str }}</td>
        <td>{{ $row->status->status }}</td>
        <td>{{ $row->tindakan }}</td>
        <td>{{ $row->nama_pengadu}}</td>
        <td>{{ $row->nama_penyelaras}}</td>

        <td style="text-align: center">
            <div class="d-flex flex-row">
                <div class="p-2">
                   <a href="{{url('/share/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>
            
                @can('delete-records')
                <div class="p-2">
                     <form action="{{url('/share/'.$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                         <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->tajuk}}')" ></button>
                    </form>
                </div> 
                @endcan      
            </div>
                             
        </td>
        
    </tr>
@endforeach
</table>
</div>

<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$aduan->appends(request()->query())->links()}}</div></dir></div>

</div>

<br>
@endsection

<style type="text/css">
   html,body {
    background-color:#FAF7F0 !important;
   }
</style>
