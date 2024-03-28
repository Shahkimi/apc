@extends('layouts.app')
@section('content')

<br><br>

   <div class="container-fluid  ">

   
   <form enctype="multipart/form-data" class="bg-white rounded p-4 shadow-lg" action="{{url('/bahagian/')}}"method="POST" style="width: 35%; margin: auto;">
   	<br>
      <h4 style="text-align: center">TAMBAH BAHAGIAN</h4>
      @csrf

      <br>
      <br>
 
      <div class="form-group">
         <label for="name">PTJ:</label>
         <select class="form-control btn-sm" name="ptj_id">
              @foreach($ptj as $row)
                  <option value="{{$row->id}}" >{{ $row->ptj }} </option>
              @endforeach
         </select>
      </div>
      

      <div class="form-group">
        <label for="name">Bahagian:</label>
		<input type="text" id="bahagian" name="bahagian" class="form-control">
      </div>
      
      <br>
      <br>
      <div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="{{url('/bahagian')}}">Batal</a>
      <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary mb-2">
      </div>


   </form>
</div>

<br><br>

@endsection



