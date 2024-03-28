
@extends('layouts.app')

@section('content')

<div class="container-fluid" style="max-width: 50%;">

  <br>

   <table class="table table-hover">
        <thead class="thead">
            <tr>    
                <th scope="col">
                <a href="{{ route('status.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Status</a>
                </th>
                <th colspan="4"><h2>SENARAI STATUS</h2></th>   
            </tr>
    </thead>

   </table>

<table class="table table-hover">
	<thead class="thead-light">
            <tr>    
                <th scope="col">#</th>
                <th scope="col">Status</th>
                <th width="10%">Tindakan</th>
   
            </tr>
        </thead>

@foreach($status as $key=>$row)
	<tr>
		<td>{{ $status->firstItem() + $key }}</td>
		<td>{{ $row->status }}</td>

        <td style="text-align: center">
            <div class="d-flex flex-row">
                <div class="p-2">
                   <a href="{{url('/status/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>
            
                @can('delete-records')
                    <div class="p-2">
                         <form action="{{url('/status/'.$row->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                             <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->status}}')" ></button>
                        </form>
                    </div>      
                @endcan 
            </div>
                             
        </td>
        
	</tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$status->appends(request()->query())->links()}}</div></dir></div>


</div>

<br><br>
       
@endsection
