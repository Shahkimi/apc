@extends('layouts.app')
@section('content')

<br><br>

   <div class="container-fluid  ">

   
   <form enctype="multipart/form-data" class="bg-white rounded p-4 shadow-lg" action="{{url('/gred/')}}" method="POST" style="width: 35%; margin: auto;">
   	<br>
      <h4 style="text-align: center">TAMBAH GRED</h4>
      @csrf

      <br>
      <br>

      
      <div class="form-group">
      <label for="name">Gred:<font color='red'> *</font></label>
		<input type="text" id="gred" name="gred" style="text-transform:uppercase;" class="form-control" required>
      </div>

        
      
      <br>
      <br>
      <div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="{{url('/gred')}}">Batal</a>
      <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary mb-2">
      </div>


   </form>
</div>

<br><br>

@endsection


