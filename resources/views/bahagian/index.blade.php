
@extends('layouts.app')

@section('content')



<div class="container-fluid" style="max-width: 70%;">


<br><br>

   <table class="table table-hover">
        <thead class="thead">
            <tr>    
                <th scope="col">
                <a href="{{ route('bahagian.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Bahagian</a>
                </th>
                <th colspan="4"><h2>SENARAI BAHAGIAN</h2></th>   
            </tr>
    </thead>

   </table>

<table class="table table-hover">
	<thead class="thead-dark">
            <tr>    
                <th scope="col">#</th>
                <th scope="col">PTJ</th>
                <th scope="col">Bahagian</th>
                <th width="10%"></th>
   
            </tr>
    </thead>

      <thead class="thead-light">
            <tr> 

                <th scope="col"></th>
                <form action="{{url('/bahagian/search')}}" method="GET" id="search">
                    @csrf

                <th scope="col"><input class="form-control" type="text" name="nama_ptj" form="search" 
                        value="{{ $fptj }}"></th>
                <th scope="col"><input class="form-control" type="text" name="nama_bahagian" form="search"
                        value="{{ $fbahagian }}"></th>
      
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian Bahagian" form="search"></th>
        
                </form>
                <!--<th scope="col"></th>-->
            </tr>  
        </thead>

@foreach($bahagian as $key=>$row)
	<tr>
		<td>{{ $bahagian->firstItem() + $key }}</td>
        <td>{{ $row->ptj }}</td>
		<td>{{ $row->bahagian }}</td>

        <td style="text-align: center">
            <div class="d-flex flex-row">
                <div class="p-2">
                   <a href="{{url('/bahagian/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a>
                </div>
            
                @can('delete-records')
                    <div class="p-2">
                         <form action="{{url('/bahagian/'.$row->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                             <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->bahagian}}')" ></button>
                        </form>
                    </div>
                @endcan 
            </div>
                    
                   
        </td>
        
	</tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$bahagian->appends(request()->query())->links()}}</div></dir></div>

</div>

<br><br>
       
@endsection
