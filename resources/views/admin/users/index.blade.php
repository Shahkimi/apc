@extends('layouts.app')

@section('content')

<br>

<div class="container-fluid shadow-lg" style="width:90%">
    <br>
    <div class="card">
        <table class="table table-hover">
            <thead class="thead">
                <tr>  
                    @can('add-pengguna')  
                    <th scope="col">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Tambah Pengguna</a>
                    </th>
                    @endcan
                    <th colspan="4"><h2>SENARAI Pengguna</h2></th>   
                </tr>
            </thead>

        </table>


        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Name</th>
                        <th scope="col">Peranan</th>
                        <th scope="col" width="15%">Actions</th>
                    </tr>
                </thead>

                <thead class="thead-light">
                    <tr> 
                        <th scope="col"></th>

                        <form action="{{url('/admin/users/search')}}" method="GET" id="search">

                        @csrf

                        <th scope="col"><input class="form-control" type="text" name="username" value = '{{ $fusername }}' form="search"></th>
                        <th scope="col"><input class="form-control" type="text" name="name" value = '{{ $fname }}' form="search"></th>
                        <th scope="col">
                            <select class="form-control btn-sm" name="role_id" form="search">
                                <option value="%">Peranan</option>
                                @foreach($roles as $row)
                                    <option value="{{$row->id}}"  {{($row->id == $frole_id)? "selected" : ""}}>{{$row->name}}</option>
                                @endforeach
                            </select>
                        </th>
                        <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian Pengguna" form="search"></th>
                        </form>
                        <!--<th scope="col"></th>-->
                    </tr>  
                </thead>

                <tbody>
                    @foreach($users as $key=>$user)
                        <tr>
                            <th scope="row">{{ $users->firstItem() + $key }}</th>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{implode(', ',$user->roles()->get()->pluck('name')->toArray())}}</td>

                            <td style="text-align: center">
                                <div class="d-flex flex-row">
                                    <div class="p-2">
                                       <a href="{{route('admin.users.edit', $user)}}" class="fa fa-edit" style=" font-size:20px"></a> 
                                    </div>
                                
                                    <div class="p-2">
                                         @can('delete-users')
                                         <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                             <button class="fa fa-trash-o" style="font-size:20px; border: none; background-color: transparent; " onclick="return confirm('Delete {{$user->name}}')" ></button>
                                        </form>
                                        @endcan
                                    </div>       
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <div class="container-fluid pagination" style="justify-content: center;">
                <div>
                    {{$users->appends(request()->query())->links()}}
                </div>
            </dir>
        </div>  <!-- tutup card-body  -->

    </div> <!-- tutup card  -->
</div>
<br><br>
@endsection

<style type="text/css">
   html,body {
    background-color:#FFF9F9 !important;
   }
</style>
