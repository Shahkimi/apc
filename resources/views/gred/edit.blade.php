{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>--}}

@extends('layouts.app')
@section('content')
 <br><br>
<div class="container-fluid  ">
		
	<form enctype="multipart/form-data" class="bg-light rounded p-4 shadow-lg" action="{{url('/gred/edit')}}" method="POST" style="width: 500px; margin: auto;">
		<h4 style="text-align: center">KEMASKINI - GRED</h4>
		@csrf
		

		<div class="form-group">
		<label>Gred<font color='red'> *</font></label>
		<input type="text" name="gred" id="gred" style="text-transform:uppercase" class="form-control " value="{{$gred->gred}}" required>
		</div>
	
		<input type="text" name="id" id="id" class="form-control" value="{{$gred->id}}" hidden>

	 

      <br><br>

		<div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
      <input type="submit" name="submit" value="Hantar" class="btn btn-primary mb-2">
      </div>
	</form>
</div>
 <br><br>
@endsection