
@extends('layouts.app')

@section('content')


<div class="container-fluid" style="max-width: 60%;">

<br><br>

   <table class="table table-hover">
        <thead class="thead">
            <tr>    
                <th scope="col">
                <a href="{{ route('unit.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Unit</a>
                </th>
                <th colspan="4"><h2>SENARAI UNIT</h2></th>   
            </tr>
    </thead>

   </table>

<table class="table table-hover">
	<thead class="thead-dark">
            <tr>    
                <th scope="col">#</th>
                <th scope="col">Bahagian</th>
                <th scope="col">Unit</th>
                <th width="10%"></th>
   
            </tr>
        </thead>

        <thead class="thead-light">
            <tr> 

                <th scope="col"></th>
                <form action="{{url('/unit/search')}}" method="GET" id="search">
                    @csrf

                 <th scope="col"><select class="form-control btn-sm" name="bahagian" form="search">
                    <option value="%">Bahagian</option>
                    @foreach($tbahagian as $row)
                        <option value="{{$row->id}}"  {{($row->id == $fbahagian)? "selected" : ""}}>{{$row->bahagian}}</option>
                    @endforeach
                </select></th>
                <th scope="col"><input class="form-control" type="text" name="unit" form="search"></th>
      
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian Unit" form="search"></th>
        
                </form>
                <!--<th scope="col"></th>-->
            </tr>  
        </thead>

@foreach($unit as $key=>$row)
	<tr>
		<td>{{ $unit->firstItem() + $key }}</td>
        <td>{{ $row->bahagian }}</td>
		<td>{{ $row->unit }}</td>

         <td style="text-align: center">
            <div class="d-flex flex-row">
                <div class="p-2">
                 <a href="{{--url('/siasatan/show/'.$k_siasatan->id)--}}{{ route('unit.show',$row->id)}}" class="fa fa-eye" style="font-size:20px;"></a>   
                </div>
                
                <div class="p-2">
                   <a href="{{url('/unit/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>
            
                <div class="p-2">
                    
                     <form action="{{url('/unit/'.$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                         <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->unit}}')" ></button>
                    </form>
                </div>
                 
                    
                   
            </div>
                    
                   
        </td>
        
	</tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$unit->appends(request()->query())->links()}}</div></dir></div>

</div>
       
@endsection
