{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>--}}

@extends('layouts.app')
@section('content')

<br><br>
<div class="container-fluid  ">
		
	<form enctype="multipart/form-data" class="bg-light rounded p-4 shadow-lg" action="{{url('/role/edit')}}" method="POST" style="width: 500px; margin: auto;">
		<h4 style="text-align: center">KEMASKINI - PERANAN</h4>
		@csrf
		

		<div class="form-group">
		<label>Peranan<font color='red'> *</font></label>
		<input type="text" name="name" id="name" class="form-control " value="{{$role->name}}" required>
		</div><br>

		Aduan<br>
	
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="view_aduan" id="view_aduan" value="1" {{ ($role->view_aduan =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="view_aduan">View</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="add_aduan" id="add_aduan" value="1" {{ ($role->add_aduan =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="add_aduan">Add</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="edit_aduan" id="edit_aduan" value="1" {{ ($role->edit_aduan =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="edit_aduan">Edit</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="delete_aduan" id="delete_aduan" value="1" {{ ($role->delete_aduan =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="delete_aduan">Delete</label>
		</div>
		<br><br>

		Penyelaras<br>
	
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="view_penyelaras" id="view_penyelaras" value="1" {{ ($role->view_penyelaras =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="view_penyelaras">View</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="add_penyelaras" id="add_penyelaras" value="1" {{ ($role->add_penyelaras =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="add_penyelaras">Add</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="edit_penyelaras" id="edit_penyelaras" value="1" {{ ($role->edit_penyelaras =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="edit_penyelaras">Edit</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="delete_penyelaras" id="delete_penyelaras" value="1" {{ ($role->delete_penyelaras =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="delete_penyelaras">Delete</label>
		</div>
		<br><br>

		Pengguna<br>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="view_pengguna" id="view_pengguna" value="1" {{ ($role->view_pengguna =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="view_pengguna">View</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="add_pengguna" id="add_pengguna" value="1" {{ ($role->add_pengguna =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="add_pengguna">Add</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="edit_pengguna" id="edit_pengguna" value="1" {{ ($role->edit_pengguna =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="edit_pengguna">Edit</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="delete_pengguna" id="delete_pengguna" value="1" {{ ($role->delete_pengguna =="1")? "checked" : "" }} >

		  <label class="form-check-label" for="delete_pengguna">Delete</label>
		</div>

	
		<input type="text" name="id" id="id" class="form-control" value="{{$role->id}}" hidden>

	 

      <br><br>

		<div style="text-align: center;">
     <!--  <a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a> -->
     <a class="btn btn-outline-primary mb-2" href="{{url('/role')}}">Batal</a> 
      <input type="submit" name="submit" value="Hantar" class="btn btn-primary mb-2">
      </div>
	</form>
</div>

<br><br>

@endsection