<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Share</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        {{-- <link href="{{url('\css\main.css')}}" rel="stylesheet"> --}}
        {{-- <link rel="stylesheet" type="text/css" href="/css/main.css"> --}}
        <link rel="stylesheet" type="text/css" href="{{url('\css\main.css')}}">
        {{-- <link rel="stylesheet" type="text/css" href="{{url('/css/bootstraps.css')}}"> --}}

    </head>
    <body>


        @yield('content')

        <footer>
            Copyright 2023 Unit ICT JKN Kedah
        </footer>

    </body>
    </html>