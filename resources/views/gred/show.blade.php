
@extends('layouts.app')

@section('content')

<br><br>
<div class="container-fluid" style="max-width: 800px ;">

<table class="table">
  <thead>
    <tr class="thead-dark">
        <th colspan="2" style="text-align: center;">Gred [{{ $gred->gred }}] </th>
    </tr>
    <tr>
    	<td></td>
    </tr>
    <tr>
        <td style="text-align: right;">Gred : </td>
        <td style="text-align: left;"> {{ $gred->gred }}<br></td>
    </tr>
  </thead>
  <tbody>
    

  </tbody>
    </table>
<br>

<center>
  <a href="/sapp/public/gred" class="back"><- Kembali ke Senarai Gred</a>
</center>

</div>


<br><br>
@endsection
