{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends('layouts.app')
@section('content')

<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Pengguna</div>

                <div class="card-body">
                    <form action="{{route('admin.users.store')}}" method="POST">
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">username</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{old('username')}}" required  autofocus>
                                @if ($errors->has('username'))
                                      <span class="text-danger" id='result2'>{{ $errors->first('username') }}</span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Emel</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{old('email')}}" required  autofocus>
                                @if ($errors->has('email'))
                                      <span class="text-danger" id='result2'>{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idptj" class="col-md-4 col-form-label text-md-right">PTJ</label>

                            <div class="col-md-6">
                                <select name="ptj_id" class="custom-select" id="inlineFormCustomSelect" required>

                                <option value="0">--Pilih--</option>

                                @foreach($ptj as $row)
                                <option value="{{$row->id}}" {{($row->id==old('ptj_id'))? "selected" : ""}}>{{$row->ptj}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                              <label class="col-md-4 col-form-label text-md-right">Group Penyelaras</label>

                              <div class="col-md-6">
                                  <select name="group_penyelaras" class="custom-select" id="inlineFormCustomSelect" required>

                                    <option value="0">--Pilih--</option>

                                    <option value="HOSPITAL" {{ (old("group_penyelaras")=="HOSPITAL") ? "selected" : "" }} >HOSPITAL
                                    </option>
                                    <option value="PKD" {{ (old("group_penyelaras")=="PKD") ? "selected" : "" }} >PKD</option>
                                    <option value="PKPD" {{ (old("group_penyelaras")=="PKPD") ? "selected" : "" }} >PKPD</option>
                                  </select>
                              </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Password Confirmation</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                      @csrf

                      <div class="form-group row">
                      <label for="roles" class="col-md-4 col-form-label text-md-right">Roles</label>
                      <div class="col-md-6">
                      @foreach($roles as $role)
                        <div class="form-check">
                            <input type="radio" name="roles" id="roles" value="{{$role->id}}" {{($role->id == old('roles'))? "checked" : "" }}>
                            <label>{{$role->name}}</label>
                        </div>
                      @endforeach
                      @if ($errors->has('roles'))
                        <span class="text-danger" id='result2'>{{ $errors->first('roles') }}</span>
                      @endif
                    </div>

                  </div>

                  <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a class="btn btn-primary" href="{{url('/admin/users')}}">Batal</a>
                                <button type="submit" class="btn btn-primary">
                                   Tambah Pengguna
                                </button>
                            </div>
                  </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
@endsection