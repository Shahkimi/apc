
@extends('layouts.app')

@section('content')


<div class="container-fluid" style="max-width: 35%">

 <br><br>

   <table class="table table-hover">
        <thead class="thead">
            <tr>    
                <th scope="col">
                <a href="{{ route('sesi.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah sesi</a>
                </th>
                <th colspan="4"><h2>SENARAI sesi</h2></th>   
            </tr>
    </thead>

   </table>


<table class="table table-hover">
	<thead class="thead-dark">
            <tr>    
                <th scope="col">#</th>
                <th scope="col">sesi</th>
                <th scope="col">buka</th>
                <th scope="col">no terakhir</th>
                <th width="10%"></th>
   
            </tr>
        </thead>

@foreach($sesi as $key=>$row)
	<tr>
		<td>{{ $sesi->firstItem() + $key }}</td>
        <td>{{ $row->sesi }}</td>
        <td>{{ $row->buka==1 ? "BUKA" : "TUTUP" }}</td>
		<td>{{ $row->no_last }}</td>

        <td style="text-align: center">
            <div class="d-flex flex-row">
                <div class="p-2">
                   <a href="{{url('/sesi/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>
            
                @can('delete-records')
                    <div class="p-2">
                         <form action="{{url('/sesi/'.$row->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                             <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->sesi}}')" ></button>
                        </form>
                    </div> 
                @endcan      
            </div>
                             
        </td>
        
	</tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$sesi->appends(request()->query())->links()}}</div></dir></div>

</div>

<br><br>
       
@endsection
