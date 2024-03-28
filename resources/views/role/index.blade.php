
@extends('layouts.app')

@section('content')


<div class="container-fluid" style="max-width: 30%; ">

 <br><br>

   <table class="table table-hover">
        <thead class="thead">
            <tr>    
                <th scope="col">
                <a href="{{ route('role.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Peranan</a>
                </th>
                <th colspan="4"><h2>SENARAI PERANAN</h2></th>   
            </tr>
    </thead>

   </table>


<table class="table table-hover">
	<thead class="thead-dark">
            <tr>    
                <th scope="col">#</th>
                <th scope="col">Peranan</th>
                <th width="8%"></th>
   
            </tr>
        </thead>
        <thead class="thead-light">
            <tr> 

                <th scope="col"></th>
                <form action="{{url('/role/search')}}" method="GET" id="search">
                    @csrf

                <th scope="col"><input class="form-control" type="text" name="name" form="search"></th>
      
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian Peranan" form="search"></th>
        
                </form>
               
            </tr>  
        </thead>

@foreach($role as $key=>$row)
	<tr>
		<td>{{ $role->firstItem() + $key }}</td>
		<td>{{ $row->name }}</td>

        <td style="text-align: center">
            <div class="d-flex flex-row">
                {{-- <div class="p-2">
                 <a href="{{ route('role.show',$row->id)}}" class="fa fa-eye" style="font-size:20px;"></a>   
                </div> --}}
                
                <div class="p-2">
                   <a href="{{url('/role/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>
            
                <div class="p-2">
                    
                     <form action="{{url('/role/'.$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                         <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->name}}')" ></button>
                    </form>
                </div>       
            </div>
                             
        </td>
        
	</tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$role->appends(request()->query())->links()}}</div></dir></div>

</div>

<br><br>
       
@endsection

