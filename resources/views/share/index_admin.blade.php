
@extends('layouts.app')

@section('content')

<br>
<div class="container-fluid bg-white" style="max-width: 90%">

   <table class="table table-hover">
        <thead class="thead">
            <tr>    
                <th colspan="8"><h2>Senarai Maklum Balas</h2></th>   
            </tr>
    </thead>

   </table>

<!-- <th>@sortablelink('name')</th> -->
            <!-- <th>@sortablelink('price')</th> -->
            <!-- <th>@sortablelink('details')</th> -->
            <!-- <th>@sortablelink('created_at')</th> -->

<table class="table table-hover">
    <thead class="thead-light">
        <tr>    
            <th scope="col" class="align-top">#</th>
            <th scope="col" class="align-top">Jenis</th>
            <th scope="col" class="align-top">Tarikh Aduan</th>
            <th scope="col" class="align-top">PTJ</th>
            <th scope="col" class="align-top">Nama</th>
            <th scope="col" class="align-top">Tajuk</th>
            <th scope="col" class="align-top">Status</th>
            <th scope="col" class="align-top">Tindakan</th>
            <th scope="col" class="align-top">Pegawai</th>
            <th scope="col" class="align-top">Tarikh Tindakan</th>
            <th scope="col" class="align-top">Tarikh Selesai</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <thead>
        <tr> 
            <th scope="col"></th>
            <form action="{{url('/aduan/search')}}" method="GET" id="search">
                @csrf

                <th scope="col">
                    <select class="form-control btn-sm" name="jenis_id" form="search">
                        <option value="%">Jenis</option>
                        @foreach ($jenis as $row)
                            <option value="{{$row->id}}" {{($row->id == $fjenis)? "selected" : "" }}>{{$row->jenis}}</option>
                        @endforeach
                    </select>
                </th>

                <th scope="col"><input class="form-control" type="date" name="created_at" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="ptj_id" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="nama" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="tajuk" form="search"></th>
                <th scope="col">
                    <select class="form-control btn-sm" name="status_id" form="search">
                        <option value="%">Status</option>
                        @foreach ($status as $tstatus)
                            <option value="{{$tstatus->id}}" {{($tstatus->id == $fstatus)? "selected" : "" }}>{{$tstatus->status}}</option>
                        @endforeach
                    </select>
                </th>
                <th scope="col"><input class="form-control" type="text" name="tindakan" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="nama_pegawai" form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="tarikh_selesai" form="search"></th>

                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian" form="search"></th>
        
            </form>
                <!--<th scope="col"></th>-->
            </tr>  
    </thead>

        <tr><p class="text-danger">{{ $msg }}</p></tr>

@foreach($aduan as $key=>$row)
    <tr>
        <td>{{ $aduan->firstItem() + $key }}</td>
        <td>{{ $row->jenis_id}}</td>
        <td>{{ $row->created_at }}</td>
        <td>ptj - belum selesai</td>
        <td>{{ $row->pengadu->name }}</td>
        <td>{{ $row->tajuk }}</td>
        <td>{{ $row->status->status }}</td>
        <td>{{ $row->tindakan }}</td>
        <td>{{ $row->pegawai_id}}</td>
        <td>{{ $row->tarikh_tindakan }}</td>
        <td>{{ $row->tarikh_selesai }}</td>

        <td style="text-align: center">
            <div class="d-flex flex-row">
                <div class="p-2">
                 <a href="{{--url('/siasatan/show/'.$k_siasatan->id)--}}{{ route('share.show',$row->id)}}" class="fa fa-eye" style="font-size:20px;"></a>   
                </div>
                
                <div class="p-2">
                   <a href="{{url('/share/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>
            
                <div class="p-2">
                    
                     <form action="{{url('/share/'.$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                         <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->tajuk}}')" ></button>
                    </form>
                </div>       
            </div>
                             
        </td>
        
    </tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$aduan->appends(request()->query())->links()}}</div></dir></div>

</div>

<br>
@endsection
