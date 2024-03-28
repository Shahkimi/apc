<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('\css\main.css')}}" rel="stylesheet">
</head>

<body>

<div><img src="{{asset('/img/sapp.png')}}" alt="sapp logo" style="width:100%; height:5%;"></div>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    Share and Care
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{--Menu bar--}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest
                    @else
                    <ul class="navbar-nav">
                    @can('view-aduan')
                        <li class="nav-item dropdown" style="margin-left: 30px;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    ADUAN
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" >
                                    <a class="dropdown-item" href=""
                                       onclick="">
                                       @can('add-aduan')
                                       <a class="dropdown-item" href="{{url('/aduan/create')}}" >Tambah Aduan</a>
                                       @endcan
                                       @can('view-aduan')
                                       <a class="dropdown-item" href="{{url('/aduan')}}" >Senarai Aduan</a>
                                       @endcan
                                       @can('view-penyelaras')
                                       <a class="dropdown-item" href="{{url('/penyelaras')}}" >Penyelaras Aduan</a>
                                       @endcan

                                        
                                    </a>

                                    
                                </div>
                            </li>
                            @endcan

                        @can('view-aduan')
                        <li class="nav-item dropdown" style="margin-left: 30px;">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    LAPORAN
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" >
                                    <a class="dropdown-item" href=""
                                       onclick="">
                                      
                                       @can('view-aduan')
                                       <a class="dropdown-item" href="{{url('/aduan/report1')}}" >Statistik Aduan</a>
                                       <a class="dropdown-item" href="{{url('/aduan/report2')}}" >Aduan Belum Selesai</a>
                                       <a class="dropdown-item" href="{{url('/aduan/report3')}}" >Laporan Bahagian</a>
                                       @endcan
                                

                                        
                                    </a>

                                    
                                </div>
                            </li>
                            @endcan
                        
                         <li class="nav-item dropdown" style="margin-left: 30px; margin-right: 20px">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    KAWALAN
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=""
                                       onclick="">
                                       <a class="dropdown-item" href="{{url('/bahagian')}}" >Bahagian</a>
                                       <a class="dropdown-item" href="{{url('/unit')}}" >Unit</a>
                                       <a class="dropdown-item" href="{{url('/lokasi')}}" >Lokasi</a>
                                       <a class="dropdown-item" href="{{url('/jawatan')}}" >Jawatan</a>
                                       <a class="dropdown-item" href="{{url('/gred')}}" >Gred</a>
                                        
                                    </a>

                                    
                                </div>
                            </li>
                            @can('view-pengguna')
                            <li class="nav-item dropdown" style="margin-left: 10px; margin-right: 20px">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    PENGGUNA
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=""
                                       onclick="">
                                       <a class="dropdown-item" href="{{ url('admin/users') }}" >Senarai Pengguna</a>
                                       @can('add-pengguna')
                                       <a class="dropdown-item" href="{{ url('admin/users/create')}}" >Daftar Pengguna</a>
                                       <a class="dropdown-item" href="{{ url('admin/users/password')}}" >Tukar Kata Laluan</a>
                                       <a class="dropdown-item" href="{{ url('/role')}}" >Peranan</a>
                                       @endcan
                                        
                                    </a>

                                    
                                </div>
                            </li>
                            @endcan
                    </ul>

                    @endif

                

                    {{--

                    <ul class="navbar-nav mr-auto">
                         <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    STICKER
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=""
                                       onclick="">
                                       <a class="dropdown-item" href="{{url('/sticker')}}" >Senarai Sticker</a>
                                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModalCenter">Permohonan Sticker</a>
                                    </a>

                                    
                                </div>
                            </li>
                    </ul>
                    --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('password.edit') }}">
                                        Tukar Kata Laluan
                                    </a>
                                    {{-- @can('for-admin')
                                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                        User Management
                                    </a>
                                    @endcan --}} 

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

       

        </nav>

        <main class="py-4">
            <div class="container">
            @include('partials.alerts')
            @yield('content')
            </div>
        </main>
    </div>



</body>
</html>
