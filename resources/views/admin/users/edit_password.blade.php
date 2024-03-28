@extends('layouts.app')

@section('content')

<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">KEMASKINI KATA LALUAN PENGGUNA {{ $user->name }}</div>

                <div class="card-body">

                    <form action="{{ route('admin.users.update_password', $user) }}" method="POST">
                       @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row" hidden>
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
{{-- 
                      {{ method_field('PUT') }}
                  <div class="form-group row" hidden>
                      <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>
                    <div class="col-md-6">
                      @foreach($roles as $role)
                      <div class="form-check">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                        <label>{{ $role->name }}</label>
                        
                      </div>
                      @endforeach
                    </div>
                    </div> --}}

                         <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password" >
                                @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password Confirmation</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation">
                                @error('password_confirmation')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>

                        <input type="text" name="id" id="id" class="form-control" value="{{$user->id}}" hidden>

                      @csrf
                      {{-- {{ method_field('POST') }} --}}

                      <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    KEMASKINI
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
