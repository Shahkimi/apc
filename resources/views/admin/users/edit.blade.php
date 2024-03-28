<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends('layouts.app')

@section('content')

<br>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-12">
<div class="card">
<div class="card-header text-center"><h4>KEMASKINI PENGGUNA</h4></div>
<div class="card-body">
<form action="{{ route('admin.users.update', $user) }}" method="POST">

      <input type="text" name="id" id="id" class="form-control" value="{{$user->id}}" hidden>
     

      <div class="form-group row">
          <label for="username" class="col-md-4 col-form-label text-md-right">Username / No KP</label>

          <div class="col-md-6">
              <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" required autofocus>

              @error('username')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
      </div>

      <div class="form-group row">
          <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

          <div class="col-md-6">
              <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

              @error('name')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
      </div>

       @csrf
           {{ method_field('PUT') }}
           
      @can('edit-records')

          <div class="form-group row">
            <label for="roles" class="col-md-4 col-form-label text-md-right">Roles</label>
            <div class="col-md-6">
                @foreach($roles as $role)
                    <div class="form-check">
                    <input type="radio" name="roles" value="{{ $role->id }}" @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                    <label>{{ $role->name }}</label>

                    </div>
                @endforeach
            </div>
          </div>
      @else 
          <input type="hidden" name = "roles" value="3" >
      @endcan

      <div class="form-group row">
        <label for="new_password" class="col-md-4 col-form-label text-md-right">New Password</label>
        <div class="col-md-6">
            <input type = "password" id = "new_password" name="new_password" class="form-control">
        </div>
      </div>

      <div class="form-group row">
        <label for="confirm_new_password" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>
        <div class="col-md-6">
            <input type = "password" id = "confirm_new_password" name="confirm_new_password" class="form-control">
        </div>
      </div>

     <!--  <div class="form-group row">
          <label for="ptj_id" class="col-md-4 col-form-label text-md-right">PTJ</label>

          <div class="col-md-6">
              <select name="ptj_id" class="custom-select" id="inlineFormCustomSelect" required>

              @foreach($ptj as $row)
              <option value="{{$row->id}}" {{ ($row->id==$user->ptj_id)? "selected" : "" }} >{{$row->ptj}}</option>
              @endforeach
              </select>
          </div>
      </div>

      <div class="form-group row">
          <label for="bahagian_id" class="col-md-4 col-form-label text-md-right">Bahagian</label>

          <div class="col-md-6">
              <select name="bahagian_id" class="custom-select" id="inlineFormCustomSelect" required>

              @foreach($bahagian as $row)
                  <option value="{{$row->id}}" {{ ($row->id==$user->bahagian_id)? "selected" : "" }} >{{$row->bahagian}}</option>
              @endforeach
              </select>
          </div>
      </div>

      <div class="form-group row">
          <label for="jawatan_id" class="col-md-4 col-form-label text-md-right">Jawatan</label>

          <div class="col-md-6">
              <select name="jawatan_id" class="custom-select" id="inlineFormCustomSelect" required>

              @foreach($jawatan as $row)
                  <option value="{{$row->id}}" {{ ($row->id==$user->jawatan_id)? "selected" : "" }} >{{$row->jawatan}}</option>
              @endforeach
              </select>
          </div>
      </div>

      <div class="form-group row">
          <label for="gred_id" class="col-md-4 col-form-label text-md-right">Gred</label>

          <div class="col-md-6">
              <select name="gred_id" class="custom-select" id="inlineFormCustomSelect" required>

              @foreach($gred as $row)
                  <option value="{{$row->id}}" {{ ($row->id==$user->gred_id)? "selected" : "" }} >{{$row->gred}}</option>
              @endforeach
              </select>
          </div>
      </div> -->

      <div class="form-group row">
          <label for="no_telefon" class="col-md-4 col-form-label text-md-right">No Telefon</label>

          <div class="col-md-6">
              <input id="no_telefon" type="text" class="form-control" name="no_telefon" value="{{ $user->no_telefon }}" required autofocus>

              @error('no_telefon')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
      </div>

      <div class="form-group row">
          <label for="email" class="col-md-4 col-form-label text-md-right">Emel</label>

          <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required autofocus>

              @error('email')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>
      </div>

      <div style="text-align: center;">
          <a class="btn btn-outline-primary mb-2" href="{{url('/admin/users')}}">Batal</a>
          <input type="submit" name="submit" value="Kemaskini Pengguna" class="btn btn-primary mb-2">
      </div>

</form>
</div>
</div>
</div>
</div>
</div>
<br><br>
@endsection

<script type="text/javascript">

jQuery(document).ready(function()
    {
            jQuery('select[name="ptj_id"]').on('change',function() {
                var ptj_id = jQuery(this).val();
                
                // alert(ptj_id);
                if (ptj_id) {
                    axios.get('/share/public/getBahagian/'+ptj_id)
                    .then(function (response) {
                        // console.log('yes berjaya');
                        // console.log(response);
                        // console.log(response.data);

                        var data = response.data;

                        jQuery('select[name="bahagian_id"]').empty();
                        
                        jQuery.each(data, function(value,key) {
                            $('select[name="bahagian_id"]').append('<option value="'+ key +'">'+ value +'</option>')
                        });
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        alert('error axios');

                    });

                }

            });



    });




</script>