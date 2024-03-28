
@extends('layouts.app')
@section('content')

<br><br>

   <div class="container-fluid  ">

   
   <form enctype="multipart/form-data" class="bg-white rounded p-4 shadow-lg" action="/sapp/public/jawatan" method="POST" style="width: 35%; margin: auto;">
   	<br>
      <h4 style="text-align: center">TAMBAH JAWATAN</h4>
      @csrf

      <br>
      <br>

  
      <div class="form-group">
     	<label for="name">Jawatan:</label>
		<input type="text" id="jawatan" name="jawatan" style="text-transform:uppercase;" class="form-control">
      </div>

        
      
      <br>
      <br>
      <div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="{{url('/jawatan')}}">Batal</a>
      <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary mb-2">
      </div>


   </form>
</div>

<br><br>

@endsection



