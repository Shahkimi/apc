
@extends('layouts.app')

@section('content')


<div class="container-fluid" style="max-width: 50%;">

  <br><br>

   <table class="table table-hover">
        <thead class="thead">
            <tr>    
                <th scope="col">
                <a href="{{ route('jawatan.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Jawatan</a>
                </th>
                <th colspan="4"><h2>SENARAI JAWATAN</h2></th>   
            </tr>
    </thead>

   </table>

<table class="table table-hover">
	<thead class="thead-dark">
            <tr>    
                <th scope="col">#</th>
                <th scope="col">Jawatan</th>
                <th width="10%"></th>
   
            </tr>
        </thead>

        <thead class="thead-light">
            <tr> 

                <th scope="col"></th>
                <form action="{{url('/jawatan/search')}}" method="GET" id="search">
                    @csrf

                <th scope="col"><input class="form-control" type="text" name="jawatan" form="search"></th>
      
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian Jawatan" form="search"></th>
        
                </form>
                <!--<th scope="col"></th>-->
            </tr>  
        </thead>

@foreach($jawatan as $key=>$row)
	<tr>
		<td>{{ $jawatan->firstItem() + $key }}</td>
		<td>{{ $row->jawatan }}</td>

        <td style="text-align: center">
            <div class="d-flex flex-row">
                <div class="p-2">
                 <a href="{{--url('/siasatan/show/'.$k_siasatan->id)--}}{{ route('jawatan.show',$row->id)}}" class="fa fa-eye" style="font-size:20px;"></a>   
                </div>
                
                <div class="p-2">
                   <a href="{{url('/jawatan/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>
            
                <div class="p-2">
                    
                     <form action="{{url('/jawatan/'.$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                         <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->jawatan}}')" ></button>
                    </form>
                </div>       
            </div>
                             
        </td>
        
	</tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$jawatan->appends(request()->query())->links()}}</div></dir></div>


</div>

<br><br>
       
@endsection
