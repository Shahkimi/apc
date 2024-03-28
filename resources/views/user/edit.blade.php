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
          <label for="email" class="col-md-4 col-form-label text-md-right">Username</label>

          <div class="col-md-6">
              <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required autofocus readonly>

              @error('email')
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

      <div class="form-group row">
          <label for="ptj_id" class="col-md-4 col-form-label text-md-right">PTJ</label>

          <div class="col-md-6">
              <select name="ptj_id" class="custom-select" id="inlineFormCustomSelect" required>

              <option value="0">--Pilih--</option>

              @foreach($ptj as $row)
              <option value="{{$row->id}}" {{ ($row->id==$user->ptj_id)? "selected" : "" }} >{{$row->ptj}}</option>
              @endforeach
              </select>
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right">Group Penyelaras</label>

          <div class="col-md-6">
              <select name="group_penyelaras" class="custom-select" id="inlineFormCustomSelect" required>

                <option value="0">--Pilih--</option>

                <option value="HOSPITAL" {{ ($user->group_penyelaras=="HOSPITAL")? "selected" : "" }} >HOSPITAL
                </option>
                <option value="PKD" {{ ($user->group_penyelaras=="PKD")? "selected" : "" }} >PKD</option>
                <option value="PKPD" {{ ($user->group_penyelaras=="PKPD")? "selected" : "" }} >PKPD</option>
              </select>
          </div>
      </div>

      @csrf
      {{ method_field('PUT') }}
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

