
@extends('layouts.app')
@section('content')

<br><br>

   <div class="container-fluid  ">

   
   <form enctype="multipart/form-data" class="bg-white rounded p-4 shadow-lg" action="{{url('/ptj/')}}" method="POST" style="width: 35%; margin: auto;">
   	<br>
      <h4 style="text-align: center">TAMBAH PTJ</h4>
      @csrf
      <div class="form-group">
            <label for="name">PTJ :<font color='red'> *</font></label>
            <input type="text" id="ptj" name="ptj" class="form-control" required
               value="{{old('ptj')}}">
            <div id="result" class="text-danger"></div>

            @if($errors->has('ptj'))
               <span class="text-danger">{{ $errors->first('ptj') }}</span>
            @endif
      </div>

      <br>
      <div class="form-group">
         <label for="name">GROUP PENYELARAS :<font color='red'> *</font></label>
         <select name="group_penyelaras" class="custom-select" id="group_penyelaras" required>
               <option value="JKN" >JKN</option>
               <option value="HOSPITAL" >HOSPITAL</option>
               <option value="PKD" >PKD</option>
               <option value="PKPD" >PKPD</option>
           </select>
        </div>
      
      <br>
      <br>
      <div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="{{url('/ptj')}}">Batal</a>
      <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary mb-2">
      </div>


   </form>
</div>

<br><br>

@endsection



