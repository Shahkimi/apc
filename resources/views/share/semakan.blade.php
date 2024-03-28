
@extends('layouts.app')

@section('content')

<div class="container-fluid" style="max-width: 60%">

 <br><br>

   <table class="table table-hover">
        <thead class="thead">
            <tr>    
                <th colspan="4"><h2>Carian Pegawai Di LAIN-LAIN PTJ</h2></th>   
            </tr>
        </thead>
   </table>

    <form action="{{url('/pegawai/semakan')}}" method="GET" id="search">
    @csrf
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="nokp" class="col-form-label">No KP</label>
            </div>
            
            <div class="col-auto">
                <input type="text" id="nokp" class="form-control" name = 'nokp' value = '{{$fnokp}}' required>
            </div>

            <div class="col-auto">
                <input class="btn btn-primary" type="submit" name="" value="Carian" form="search">
            </div>
        </div>
    </form>


<table class="table table-hover">
	<thead class="thead-dark">
            <tr>    
                <th scope="col" width="3%">#</th>
                <th scope="col" width="30%">PTJ</th>
                <th scope="col" width="40%">Nama</th>
                <th scope="col" width="20%">No KP</th>
                <th width="7%"></th>
   
            </tr>
        </thead>

        <tr><br>
            <p class="text-danger">{{ $msg }}</p>
        </tr>

@foreach($pegawai as $key=>$row)

        @php   
          //  if ($row->ptj=="") $row->ptj = 'Tiada';
        @endphp

	<tr>
		<td>{{ $pegawai->firstItem() + $key }}</td>
        <td>{{ $row->kodptj }}</td>
        <td>{{ $row->nama }}</td>
        <td>{{ $row->nokp }}</td>

        @php   
            if (($role=='2') && $row->kodptj <> '079999' && $row->kodptj <> $userptj && $row->kodptj <> "")  { //079999 = ptj luar
                    continue;
            }
        @endphp
        
        <td style="text-align: center">
            <div class="d-flex flex-row">
                <div class="p-2">
                 <a href="{{ route('pegawai.show',$row->nokp)}}" class="fa fa-eye" style="font-size:20px;"></a>   
                </div>
                <div class="p-2">
                   <a href="{{url('/pegawai/edit/'.$row->nokp)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                </div>
            </div>
                             
        </td>

	</tr>
@endforeach
</table>
<br>
    <div class="container-fluid pagination" style="justify-content: center;"><div>{{$pegawai->appends(request()->query())->links()}}</div></dir></div>

</div>

{{-- <div class="container-fluid" style="max-width: 60%">
<p>CARIAN PEGAWAI DI LAIN-LAIN PTJ / PTJ LUAR DAN  TIADA PTJ (sila gunakan ic sahaja untuk carian)</p>

<form action="{{url('/pegawai/search2')}}" method="GET" id="search">
    @csrf

      <div class="form-group row">
          <label for="nokp" class="col-md-4 col-form-label text-md-left">No KP</label>

          <div class="col-md-6">
              <input id="nokp" type="text" class="form-control" name="email" value="">
          </div>
      </div>
            
</form>

    <table class="table table-hover">
        <thead class="thead-dark">
                <tr>    
                    <th scope="col" width="3%">#</th>
                    <th scope="col" width="30%">PTJ</th>
                    <th scope="col" width="40%">Nama</th>
                    <th scope="col" width="20%">No KP</th>
                    <th width="7%"></th>
       
                </tr>
            </thead>

            <thead class="thead-light">
                <tr> 
                    <th scope="col"></th>
                    
                    <!--<th scope="col"></th>-->
                </tr>  
            </thead>

            <tr><p class="text-danger">{{ $msg }}</p></tr>

    @foreach($pegawai as $key=>$row)

            @php   
                if ($row->ptj=="") $row->ptj = 'Tiada';
            @endphp

        <tr>
            <td>{{ $pegawai->firstItem() + $key }}</td>
            <td>{{ $row->ptj }}</td>
            <td>{{ $row->nama }}</td>
            <td style="text-align:center;">{{ $row->nokp }}</td>

            <td style="text-align: center">
                <div class="d-flex flex-row">
                    <div class="p-2">
                     <a href="{{ route('pegawai.show',$row->nokp)}}" class="fa fa-eye" style="font-size:20px;"></a>   
                    </div>
                    
                    <div class="p-2">
                       <a href="{{url('/pegawai/edit/'.$row->nokp)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                    </div>
                
                    <div class="p-2">
                        
                         <form action="{{url('/pegawai/'.$row->nokp)}}" method="POST">
                            @csrf
                            @method('DELETE')
                             <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$row->nokp}}')" ></button>
                        </form>
                    </div>       
                </div>
                                 
            </td>
        </tr>
    @endforeach
</table>

</div> --}}

<br>
@endsection
