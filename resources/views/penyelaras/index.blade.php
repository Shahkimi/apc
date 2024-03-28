
@extends('layouts.app')

@section('content')


<div class="container-fluid" style="max-width: 65%;">

 {{--   <a href="{{ route('penyelaras.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Penyelaras</a> --}}

   <br><br>

   <table class="table table-hover">
        <thead class="thead">
            <tr>    
                <th scope="col">
                <a href="{{ route('penyelaras.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Penyelaras</a>
                </th>
                <th colspan="4"><h2>SENARAI PENYELARAS</h2></th>   
            </tr>
    </thead>

   </table>

<table class="table table-hover">

	<thead class="thead-dark">
            <tr>    
                <th scope="col">#</th>
                <th scope="col">Jenis Aduan</th>
                <th scope="col">Penyelaras</th>
                <th scope="col">Ketua</th>
                <th width="10%"></th>
   
            </tr>
        </thead>

        <thead class="thead-light">
            <tr> 

                <th scope="col"></th>
                <form action="{{url('/penyelaras/search')}}" method="GET" id="search">
                    @csrf

                <th scope="col">
                    <select class="form-control btn-sm" name="jenis_aduan" form="search">
                    <option value="%">Jenis Aduan</option>
                    <option value="1">KEBERSIHAN </option>
                    <option value="2">PENYELENGGARAAN </option>
                   
                </select></th>

                 <th scope="col"><select class="form-control btn-sm" name="idpenyelaras" form="search">
                    <option value="%">Penyelaras</option>
                    @foreach($user as $row)
                        <option value="{{$row->id}}"  {{($row->id == $fpenyelaras)? "selected" : ""}}>{{$row->name}}</option>
                    @endforeach
                </select></th>

                <th scope="col">
                    <select class="form-control btn-sm" name="ketua" form="search">
                    <option value="%">Ketua</option>
                    <option value="1">Ya</option>
                    <option value="2">Tidak</option>
                   
                </select></th>
                
      
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian Penyelaras" form="search"></th>
        
                </form>
                <!--<th scope="col"></th>-->
            </tr>  
        </thead> 

@foreach($penyelaras as $key=>$row)
	<tr>
		<td>{{ $penyelaras->firstItem() + $key }}</td>
        <td>
            @if($row->jenis_aduan == '1')
                KEBERSIHAN
            @elseif($row->jenis_aduan == '2')
                PENYELENGGARAAN
            @else
                -
            @endif
        </td>

         <td>{{ $row->name }}</td>
		<td>
            @if($row->ketua == '1')
                YA
            @elseif($row->ketua == '2')
                TIDAK
            @else
                -
            @endif
        </td>

          <td style="text-align: center">
            <div class="d-flex flex-row">
                @can('view-penyelaras')
                <div class="p-2">
                 <a href="{{ route('penyelaras.show',$row->id)}}" class="fa fa-eye" style="font-size:20px;"></a>   
                </div>
                @endcan
                
                @can('edit-penyelaras')
                <div class="p-2">
                   <a href="{{url('/penyelaras/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>
                @endcan

                @can('delete-penyelaras')
                <div class="p-2">
                    
                     <form action="{{url('/penyelaras/'.$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                         <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->name}}')" ></button>
                    </form>
                </div>
                @endcan
                    
                   
            </div>
                    
                   
        </td>  
        
	</tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$penyelaras->appends(request()->query())->links()}}</div></dir></div>

</div>
       
@endsection
