@extends('layouts.app')

@section('content')
    <br>
    <img src="{{ asset('img/banner2.png') }}" alt="description of myimage">

    <br>

    <br><br>

    @foreach ($pegawai as $key => $row)
        <div class="card-body">
            <div class="h1 p-2 text-center font-weight-bold" style="color:darkblue;font-size:80px;">{{ $row->nama }} </div>
            <div class="h1 p-2 text-center font-weight-bold" style="color:darkblue;font-size:60px;">
                {{ strtoupper($row->jawatan) . ' ' . strtoupper($row->gred) }} </div>
            <div class="h1 p-4 text-center font-weight-bold" style="color:black;font-size:60px;">{{ strtoupper($row->ptj) }}
            </div>
            <div class=" text-right font-weight-bold">{{ $row->no_kerusi }}</div>
        </div>
    @endforeach


    <div class="container-fluid pagination" style="justify-content: center; visibility: hidden;">
        <ul class="pagination">
            <li class="page-item m-4"><a id="previousLink" class="page-link"
                    href="{{ $pegawai->previousPageUrl() }}">Previous</a></li>
            <li class="page-item m-4"><a id="nextLink" class="page-link" href="{{ $pegawai->nextPageUrl() }}">Next</a></li>
        </ul>
    </div>
    <script>
        document.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowRight') {
                document.getElementById('nextLink').click();
            }
            if (event.key === 'ArrowLeft') {
                document.getElementById('previousLink').click();
            }
        });
    </script>
    <br><br>
@endsection
