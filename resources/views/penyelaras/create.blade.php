{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>--}}

@extends('layouts.app')
@section('content')

<br><br>

   <div class="container-fluid  ">

      @error('idpenyelaras')
<span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror
      
   <form enctype="multipart/form-data" class="bg-white rounded p-4 shadow-lg" action="{{url('/penyelaras')}}" method="POST" style="width: 500px; margin: auto;">
   	<br>
      <h4 style="text-align: center">TAMBAH PENYELARAS</h4>
      @csrf

      <br>
      <br>

      <div class="form-group">
      <label>Jenis Aduan<font color='red'> *</font></label><br>
      <input type="radio" name="jenis_aduan" value="1" required>
      <label>Kebersihan</label>
      <input type="radio" name="jenis_aduan" value="2">
      <label>Penyelenggaraan</label>
      </div>
      
      <div class="form-group">
      <label>Penyelaras<font color='red'> *</font></label>
      <select name="idpenyelaras" class="custom-select" id="idpenyelaras" required>
         @can('for-admin')
         <option value="">--Pilih--</option>
         @endcan
         @foreach($idpenyelaras as $row)
         <option value="{{$row->id}}">{{$row->name}}</option>
         @endforeach
      </select>
      <br>
      </div>

      <div class="form-group">
      <label>Ketua<font color='red'> *</font></label><br>
      <input type="radio" name="ketua" value="1" required>
      <label>Ya</label>
      <input type="radio" name="ketua" value="2">
      <label>Tidak</label>
      </div>


     
      
      <br>
      <br>
      <div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="{{url('/penyelaras')}}">Batal</a>
      <input type="submit" name="submit" value="Hantar" class="btn btn-primary mb-2">
      </div>


   </form>
</div>

<br><br>

@endsection