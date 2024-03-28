
@extends('layouts.app')
@section('content')

<br><br>

   <div class="container-fluid  ">

   
   <form enctype="multipart/form-data" class="bg-white rounded p-4 shadow-lg" action="/sapp/public/unit" method="POST" style="width: 35%; margin: auto;">
   	<br>
      <h4 style="text-align: center">TAMBAH UNIT</h4>
      @csrf

      <br>
      <br>

      <div class="form-group">
      <label>Bahagian:<font color='red'> *</font></label>
      <select name="bahagian" class="custom-select" id="bahagian" required>
         @can('for-admin')
         <option value="">--Pilih--</option>
         @endcan
         @foreach($bahagian as $row)
         <option value="{{$row->id}}">{{$row->bahagian}}</option>
         @endforeach
      </select>
      </div>
      
      <div class="form-group">
      <label for="name">Unit:<font color='red'> *</font></label>
		<input type="text" id="unit" name="unit" style="text-transform:uppercase;" class="form-control" required>
      </div>

        
      
      <br>
      <br>
      <div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="{{url('/unit')}}">Batal</a>
      <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary mb-2">
      </div>


   </form>
</div>

<br><br>

@endsection







