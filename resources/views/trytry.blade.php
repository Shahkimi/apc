@extends('layouts.app')

@section('content')
@can('delete-pengguna')
<button class="btn btn-danger">Butang Delete</button>
@endcan
       
@endsection
