
@extends('layouts.app')

@section('content')
<br><br>
<div class="container-fluid" style="max-width: 40%;">

<table class="table">
  <thead>
    <tr class="thead-dark">
        <th colspan="2" style="text-align: center;">Penyelaras [{{ $penyelaras->name }}] </th>
    </tr>
    <tr>
    	<td></td>
    </tr>
     <tr>
        <td style="text-align: right;">Jenis Aduan : </td>
        <td style="text-align: left;">
            @if($penyelaras->jenis_aduan == '1')
                KEBERSIHAN
            @elseif($penyelaras->jenis_aduan == '2')
                PENYELENGGARAAN
            @else
                -
            @endif
        </td>
    </tr>
     <tr>
        <td style="text-align: right;">Penyelaras : </td>
        <td style="text-align: left;"> {{ $penyelaras->name }}<br></td>
    </tr>

    <tr>
        <td style="text-align: right;">Ketua : </td>
        <td style="text-align: left;">
            @if($penyelaras->ketua == '1')
                YA
            @elseif($penyelaras->ketua == '2')
                TIDAK
            @else
                -
            @endif
        </td>
    </tr>

    
   
  </thead>
  <tbody>
    

  </tbody>
    </table>

    <br>

<center>
<a href="/sapp/public/penyelaras" class="back"><- Kembali ke Senarai Penyelaras</a>
</center>

</div>
<br><br>

@endsection
