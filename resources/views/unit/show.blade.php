
@extends('layouts.app')

@section('content')

 <br><br>
<div class="container-fluid" style="max-width: 30%;">

<table class="table">
  <thead>
    <tr class="thead-dark">
        <th colspan="2" style="text-align: center;">Unit [{{ $unit->unit }}] </th>
    </tr>
    <tr>
    	<td></td>
    </tr>
     <tr>
        <td style="text-align: right;">Bahagian : </td>
        <td style="text-align: left;"> {{ $unit->bahagian }}<br></td>
    </tr>

    <tr>
        <td style="text-align: right;">Unit : </td>
        <td style="text-align: left;"> {{ $unit->unit }}<br></td>
    </tr>
   
  </thead>
  <tbody>
    

  </tbody>
    </table>
<br>

<center>
  <a href="/sapp/public/unit" class="back"><- Kembali ke Senarai Unit</a>
</center>
</div>


 <br><br>
@endsection
