{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>--}}

@extends('layouts.app')
@section('content')
<br><br>
<div class="container-fluid  ">
		
	<form enctype="multipart/form-data" class="bg-light rounded p-4 shadow-lg" action="{{url('/penyelaras/edit')}}" method="POST" style="width: 500px; margin: auto;">
		<h4 style="text-align: center">KEMASKINI - PENYELARAS</h4>
		<br>
		@csrf

		<div class="form-group">
		<label>Jenis Aduan<font color='red'> *</font></label><br>
	      <input type="radio" name="jenis_aduan" value="1" {{ ($penyelaras->jenis_aduan =="1")? "checked" : "" }} required>
	      <label>Kebersihan</label>
	      <input type="radio" name="jenis_aduan" value="2" {{ ($penyelaras->jenis_aduan =="2")? "checked" : "" }}>
	      <label>Penyelenggaraan</label>
	    </div>
		
		<div class="form-group">
		<label>Penyelaras<font color='red'> *</font></label>
	      <select name="idpenyelaras" class="custom-select" id="inlineFormCustomSelect" required>
	      	@can('for-admin')
	         <option value="0">--Pilih--</option>
	        @endcan
	         @foreach($idpenyelaras as $row)
	         <option value="{{$row->id}}" {{ ($row->id==$penyelaras->idpenyelaras)? "selected" : "" }} >{{$row->name}}</option>
	         @endforeach
	      </select>
	    </div>
		
		<div class="form-group">
		<label>Ketua<font color='red'> *</font></label><br>
	      <input type="radio" name="ketua" value="1" {{ ($penyelaras->ketua =="1")? "checked" : "" }} required>
	      <label>Ya</label>
	      <input type="radio" name="ketua" value="2" {{ ($penyelaras->ketua =="2")? "checked" : "" }}>
	      <label>Tidak</label>
	    </div>
	
		<input type="text" name="id" id="id" class="form-control" value="{{$penyelaras->id}}" hidden>

	 

      <br><br>

		<div style="text-align: center;">
      		<a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
      <input type="submit" name="submit" value="Hantar" class="btn btn-primary mb-2">
      </div>
	</form>
</div>

<br><br>

@endsection