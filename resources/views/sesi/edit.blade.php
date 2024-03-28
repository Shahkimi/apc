{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>--}}

@extends('layouts.app')
@section('content')
 <br><br>
<div class="container-fluid  ">
		
	<form enctype="multipart/form-data" class="bg-light rounded p-4 shadow-lg" action="{{url('/sesi/edit')}}" method="POST" style="width: 500px; margin: auto;">
		<h4 style="text-align: center">KEMASKINI - sesi</h4>
		@csrf
		

		<div class="form-group">
		
		<input type="text" name="id" id="id" class="form-control" value="{{$sesi->id}}" hidden>

		<label>sesi<font color='red'> *</font></label>
		<input type="text" name="sesi" id="sesi" class="form-control " value="{{$sesi->sesi}}" required>
		</div>
	
		<div class="form-check">
		  <input class="form-check-input" type="radio" name="buka"  value="1" {{$sesi->buka=='1'? "checked" : ""}}>
		  <label class="form-check-label">BUKA</label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="radio" name="buka"  value="0" {{$sesi->buka=='0'? "checked" : ""}}>
		  <label class="form-check-label">TUTUP </label>
		</div>

		<br>
		<label>No Terakhir<font color='red'> *</font></label>
	
		<input type="text" name="no_last" id="no_last" class="form-control" value="{{$sesi->no_last}}" required>

	 

      <br><br>

		<div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
      <input type="submit" name="submit" value="Hantar" class="btn btn-primary mb-2">
      </div>
	</form>
</div>
 <br><br>
@endsection