
@extends('layouts.app')

@section('content')

<br><br>
<div class="container-fluid">

	<form class="bg-white rounded p-4 shadow-lg" action="/sapp/public/role" method="POST" style="width: 500px; margin: auto;">
		<br>
      <h4 style="text-align: center">TAMBAH PERANAN</h4>
		@csrf

		<br>
		<br>

		<div class="form-group">
		<label for="name">Peranan:</label>
		<input type="text" id="name" name="name" {{-- style="text-transform:uppercase" --}} class="form-control " required>
		</div>
		<br>
		Aduan<br>
	
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="view_aduan" id="view_aduan" value="1" />
		  <label class="form-check-label" for="view_aduan">View</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="add_aduan" id="add_aduan" value="1" />
		  <label class="form-check-label" for="add_aduan">Add</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="edit_aduan" id="edit_aduan" value="1" />
		  <label class="form-check-label" for="edit_aduan">Edit</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="delete_aduan" id="delete_aduan" value="1" />
		  <label class="form-check-label" for="delete_aduan">Delete</label>
		</div>
		<br><br>

		Penyelaras<br>
	
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="view_penyelaras" id="view_penyelaras" value="1" />
		  <label class="form-check-label" for="view_penyelaras">View</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="add_penyelaras" id="add_penyelaras" value="1" />
		  <label class="form-check-label" for="add_penyelaras">Add</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="edit_penyelaras" id="edit_penyelaras" value="1" />
		  <label class="form-check-label" for="edit_penyelaras">Edit</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="delete_penyelaras" id="delete_penyelaras" value="1" />
		  <label class="form-check-label" for="delete_penyelaras">Delete</label>
		</div>
		<br><br>
		
		Pengguna<br>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="view_pengguna" id="view_pengguna" value="1" />
		  <label class="form-check-label" for="view_pengguna">View</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="add_pengguna" id="add_pengguna" value="1" />
		  <label class="form-check-label" for="add_pengguna">Add</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="edit_pengguna" id="edit_pengguna" value="1" />
		  <label class="form-check-label" for="edit_pengguna">Edit</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="checkbox" name="delete_pengguna" id="delete_pengguna" value="1" />
		  <label class="form-check-label" for="delete_pengguna">Delete</label>
		</div>
		<br>
		
      <br>
      <div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="{{url('/')}}">Batal</a>
      <input type="submit" name="submit" value="Hantar" class="btn btn-primary mb-2">
      </div>


	</form>

</div>

<br><br>
@endsection
