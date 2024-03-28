
@extends('layouts.app')

@section('content')

<br>
<div class="container-fluid bg-white" style="max-width: 60%;">

    @if(session()->has('message'))
        <div class="alert alert-success font-weight-bold text-center">
            {{ session()->get('message') }}
        </div>
    @endif

   <table class="table table-hover">
        
        <thead class="thead">
            <tr>    
                <th scope="col">
                <a href="{{ route('ptj.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah PTJ</a>
                </th>
                <th colspan="4"><h2>SENARAI PTJ</h2></th>   
            </tr>
        </thead>

   </table>

<table class="table table-hover">
    <thead class="thead-dark">
            <tr>    
                <th scope="col">#</th>
                <th scope="col">@sortablelink('ptj', 'PTJ')</th>
                <th width="10%"></th>
   
            </tr>
        </thead>

        <thead class="thead-light">
            <tr> 

                <th scope="col"></th>
                <form action="{{url('/ptj/search')}}" method="GET" id="search">
                    @csrf

                <th scope="col"><input class="form-control" type="text" name="ptj" form="search" value="{{ $fptj }}"></th>

                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian PTJ" form="search"></th>
        
                </form>
                <!--<th scope="col"></th>-->
            </tr>  
        </thead>

@foreach($ptj as $key=>$row)
    <tr>
        <td>{{ $ptj->firstItem() + $key }}</td>
        <td>{{ $row->ptj }}</td>

        <td style="text-align: center">
            <div class="d-flex flex-row">
<!--                 <div class="p-2">
                 <a href="{{ route('ptj.show',$row->id)}}" class="fa fa-eye" style="font-size:20px;"></a>   
                </div> -->
                
                <div class="p-2">
                   <a href="{{url('/ptj/edit/'.$row->id)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>

                @can('delete-records')
                    <div class="p-2">
                         <form action="{{url('/ptj/'.$row->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                             <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->ptj}}')" ></button>
                        </form>
                    </div>   
                @endcan

            </div>
                             
        </td>
        
    </tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$ptj->appends(request()->query())->links()}}</div></dir></div>


</div>

<br><br>
       
@endsection
