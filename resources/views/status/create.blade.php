
@extends('layouts.app')
@section('content')

<br><br>

   <div class="container-fluid  ">

   
   <form enctype="multipart/form-data" class="bg-white rounded p-4 shadow-lg" action="{{url('/status/')}}"method="POST" style="width: 35%; margin: auto;">
   	<br>
      <h4 style="text-align: center">TAMBAH STATUS ADUAN</h4>
      @csrf

      <br>
      <br>

  
      <div class="form-group">
     	<label for="name">Jawatan:</label>
		<input type="text" id="status" name="status" class="form-control">
      </div>

        
      
      <br>
      <br>
      <div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="{{url('/status')}}">Batal</a>
      <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary mb-2">
      </div>


   </form>
</div>

<br><br>

@endsection



