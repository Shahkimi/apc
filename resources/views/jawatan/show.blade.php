
@extends('layouts.app')

@section('content')

<br><br>
<div class="container-fluid" style="max-width: 30%;">

<table class="table">
  <thead>
    <tr class="thead-dark">
        <th colspan="2" style="text-align: center;">Jawatan [{{ $jawatan->jawatan }}] </th>
    </tr>
    <tr>
    	<td></td>
    </tr>
    <tr>
        <td style="text-align: right;">Jawatan : </td>
        <td style="text-align: left;"> {{ $jawatan->jawatan }}<br></td>
    </tr>
  </thead>
  <tbody>
    

  </tbody>
    </table>

<br>
<center>
  <a href="/sapp/public/jawatan" class="back"><- Kembali ke Senarai Jawatan</a>
</center>

</div>


  <br><br>
@endsection
