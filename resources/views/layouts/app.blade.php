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

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('\css\main.css') }}" rel="stylesheet">
    <style>
        .tbl-print {
            padding: 5px;
            padding-left: 5px;
            padding-right: 5px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            color: black;
        }

        tr:nth-of-type(even) {
            background-color: #ECF2FF;
        }

        thead {
            background-color: #89BDF8;
            color: white;
        }
    </style>
</head>

<body style="background-color:#F3E8FF;">

    <div id="app">
        @if (!Request::is('apc/paparan'))
            <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#654E92;">
                <div class="container" style="margin-left:100px;">
                    <a class="navbar-brand text-white font-weight-bold" href="{{ url('/home') }}">
                        APC
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Right Side Of Navbar -->

                        <ul class="navbar-nav ml-auto">
                            <!-- Left Side Of Navbar -->
                            @guest
                            @else
                                <ul class="navbar-nav" style="">

                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-bold" href="{{ url('/apc') }}">SENARAI
                                            APC</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-bold" href="{{ url('/sesi') }}">SESI</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white font-weight-bold"
                                            href="{{ url('/apc/paparan') }}">PAPARAN</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            v-pre>
                                            LAPORAN <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ url('laporan/hadir/PAGI/view') }}">HADIR
                                                PAGI</a>
                                            <a class="dropdown-item"
                                                href="{{ url('laporan/hadir/PAGI_LEWAT/view') }}">HADIR
                                                PAGI (LEWAT)</a>
                                            <a class="dropdown-item" href="{{ url('laporan/hadir/PETANG/view') }}">HADIR
                                                PETANG</a>
                                            <a class="dropdown-item"
                                                href="{{ url('laporan/hadir/PETANG_LEWAT/view') }}">HADIR
                                                PETANG (LEWAT)</a>
                                            <a class="dropdown-item" href="{{ url('laporan/hadir/TH_PAGI/view') }}">TIDAK
                                                HADIR
                                                PAGI</a>
                                            <a class="dropdown-item" href="{{ url('laporan/hadir/TH_PETANG/view') }}">TIDAK
                                                HADIR PETANG </a>
                                            <a class="dropdown-item" href="{{ url('laporan/exportPegawai') }}">EXPORT EXCEL
                                            </a>
                                        </div>
                                    </li>
                                    @can('admin-menu')
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                v-pre>
                                                Kawalan <span class="caret"></span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ url('ptj') }}">PTJ</a>
                                                <a class="dropdown-item" href="{{ url('jawatan') }}">Jawatan</a>
                                                <a class="dropdown-item" href="{{ url('gred') }}">gred</a>
                                                <a class="dropdown-item" href="{{ url('status') }}">Semakan</a>
                                            </div>
                                        </li>
                                    @endcan
                                </ul>

            @endif

            <!-- </ul> -->

            <!-- Right Side Of Navbar -->
            <!--<ul class="navbar-nav" >-->
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <!-- untuk register new user
                                    @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif -->
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Selamat Datang {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @can('manage-users')
                            <a class="dropdown-item" href="{{ url('admin/users') }}">Senarai Pengguna</a>
                        @endcan
                        <a class="dropdown-item" href="{{ route('admin.users.edit', Auth::user()) }}">Kemaskini Pengguna</a>

                        <a class="dropdown-item" href="{{ url('/password') }}">Tukar Kata Laluan Pengguna</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
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
        @endif




        <main class="">

            @include('partials.alerts')
            @yield('content')

        </main>

        </div>
    </body>
    
    @if (!Request::is('apc/paparan'))
        <footer>
            Hakcipta Terpelihara 2023 Unit Pengurusan Maklumat JKN Kedah
        </footer>
    @endif

    </html>
