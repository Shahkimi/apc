
@extends('layouts.app')

@section('content')

<br><br>
<div class="container-fluid" style="max-width: 800px ;">



      <h3 class ="font-weight-bold"> {{ $aduan->jenis }} </h3>
      <p > Tarikh Aduan : {{ Carbon::parse($aduan->created_at)->format('d-m-Y h:i:s') }} </p>
      <hr class="bg-info border-2 border-top border-info">

      <div>
      <h5 class ="font-weight-bold text-info"> Tajuk </h5>
      <p > {{ $aduan->tajuk }} </p>
      <hr class="bg-info border-2 border-top border-info">
      </div>

    <div class="row">
      <div class="col-lg-2 form-group">
        <label class ="font-weight-bold text-info">Tajuk</label>
      </div>
      <div class="col-lg-10 form-group">
        <label >{{ $aduan->tajuk }} </label>
      </div>
    </div>
      <hr class="bg-info border-2 border-top border-info">


      <h5 class ="font-weight-bold text-info"> Butiran </h5>
      <p > {{ $aduan->butiran }} </p>
      <hr class="bg-info border-2 border-top border-info">

      <h5 class ="font-weight-bold text-info"> Lokasi </h5>
      <p > {{ $aduan->lokasi }} </p>
      <hr class="bg-info border-2 border-top border-info">

      <h5 class ="font-weight-bold text-info"> Lampiran </h5>
      <p > {{ $aduan->lampiran }} </p>
      <hr class="bg-info border-2 border-top border-info">
      
      <h5 class ="font-weight-bold text-info"> Status </h5>
      <p > {{ $aduan->status }} </p>
      <hr class="bg-info border-2 border-top border-info">

      <h5 class ="font-weight-bold text-info"> Tindakan </h5>
      <p > {{ $aduan->tindakan }} </p>
      <hr class="bg-info border-2 border-top border-info">
      
      <h5 class ="font-weight-bold text-info"> Pegawai </h5>
      <p > {{ $aduan->pegawai_id }} </p>
      <hr class="bg-info border-2 border-top border-info">

      <p > Tarikh Kemaskini : {{ Carbon::parse($aduan->updated_at)->format('d-m-Y h:i:s') }} </p>

<center>
  <a href="{{url('/share/')}}" class="back">Kembali</a>
</center>

</div>


<br><br>
@endsection
