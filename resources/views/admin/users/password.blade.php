@extends('layouts.app')

@section('content')

<br><br>
<div class="container" style="max-width: 100%;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pengguna</div>

                <div class="card-body">

                  <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Username</th>
                      <th scope="col" width="25%">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                @foreach($users as $key=>$user)
                    <tr>
                      <th scope="row">{{ $users->firstItem() + $key }}</th>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @can('edit-users')
                          <a href="{{ route('admin.users.edit_password', $user->id) }}"><button type="button" class="btn btn-primary float-left">Edit Password</button></a>
                        @endcan
                          
                         {{--  <a href="{{ route('admin.users.destroy', $user->id) }}"><button type="button" class="btn btn-warning">Delete</button></a> --}}
                      </td>
                    </tr>
                @endforeach
               
                  </tbody>
                </table>
                <br>
                  <div class="container-fluid pagination" style="justify-content: center;"><div>{{$users->appends(request()->query())->links()}}</div></dir></div>

                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
@endsection
