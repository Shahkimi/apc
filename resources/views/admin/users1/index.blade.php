@extends('layouts.app')

@section('content')

@php

// session(['s_name'     => $fname,
//          's_email'    => $femail,
//          's_idptj'    => $fidptj,
//          's_idrole'   => $fidrole,
//          's_status'   => $fstatus,
//         ]);

@endphp
<br><br>
<div class="container-fluid" style="width:75%">
    <div class="">
        <div class="">
            <div class="card">

                       <table class="table table-hover">
                            <thead class="thead">
                                <tr>  
                                    @can('add-pengguna')  
                                    <th scope="col">
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Pengguna</a>
                                    </th>
                                    @endcan
                                    <th colspan="4"><h2>SENARAI PENGGUNA</h2></th>   
                                </tr>
                        </thead>

                       </table>

                {{-- <div class="card-header">Pengguna</div> --}}

                <div class="card-body">

                  <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Username</th>
                      <th scope="col">PTJ</th>
                      <th scope="col">Peranan</th>
                      <th scope="col">Status</th>
                      <th scope="col" width="15%">Actions</th>
                    </tr>
                  </thead>
        <thead class="thead-light">
            <tr> 

                <th scope="col"></th>
                <form action="{{url('/admin/users')}}" method="GET" id="search">
                
                @csrf

                <th scope="col"><input class="form-control" type="text" name="name" value = '{{ $fname }}' form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="email" value = '{{ $femail }}' form="search"></th>
                <th scope="col" width="20%">
                  <select class="form-control btn-sm" name="idptj" form="search">
                    <option value="%" {{($fidptj=='%')? "selected" : ""}} >PTJ</option>
                    @foreach($ptj as $tptj)
                        <option value="{{$tptj->kodptj}}"  {{($tptj->kodptj == $fidptj)? "selected" : ""}}>{{$tptj->ptj}}</option>
                    @endforeach
                  </select>
                </th>
                <th scope="col" width="20%">
                  <select class="form-control btn-sm" name="idrole" form="search">
                    <option value="%">Peranan</option>
                    @foreach($roles as $troles)
                        <option value="{{$troles->id}}"  {{($troles->id == $fidrole)? "selected" : ""}}>{{$troles->name}}</option>
                    @endforeach
                  </select>
                </th>
               <th scope="col"></th>
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian Pengguna" form="search"></th>
        
                </form>
                <!--<th scope="col"></th>-->
            </tr>  
        </thead>





                  <tbody>
                   {{--  @php $count = 1;  @endphp --}}
                @foreach($users as $key=>$user)
                    <tr>
                      <th scope="row">{{ $users->firstItem() + $key }}</th>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->ptj }}</td>
                      <td>{{ $user->peranan }}</td>
                      <td></td>
                      <td>
                          @can('edit-penggunas')
                            <a class="btn btn-outline-primary" href="{{url('/admin/users/edit/'.$user->id.'/'.$user->role_user_id)}}">Edit</a>
                          @endcan
                          @can('delete-pengguna')
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="btn">
                          @csrf 
                          {{ method_field('DELETE') }} 
                          <button type="submit" class="btn btn-warning" onclick="return confirm('Delete {{$user->name}}')">Delete</button>
                          </form>

                        @endcan
                          
        
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
@endsection
