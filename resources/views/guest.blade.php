<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ url('\css\main.css')}}" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<!-- <meta http-equiv="refresh" content="120"> -->

<style type="text/css">
.gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}

  .required:after {
    content:" *";
    color: red;
  }

</style>

@extends('layouts.layout')

@section('content')

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden">

<div class="header">
    <h1 class="text-center m-4" style="color: skyblue;">
                JABATAN KESIHATAN NEGERI KEDAH <br>
                <span style="color: hsl(218, 81%, 75%)">Aduan / Cadangan untuk Penambahbaikan Perkhidmatan</span>
    </h1>
            <!-- <img src="{{asset('/img/building-art.png')}}" alt="pizzahot logo"><br> -->
        @if(Session::has('message'))
            <p class="alert alert-warning text-center font-weight-bold">{{ Session::get('message') }}</p>
        @endif

</div>
<div class="right mr-3 mt-2" style ="text-align: right;">
    <a class="text-light" href="{{ route('login') }}">Log Masuk </a>
</div>

<div class="container text-center ">
    <div class="row mb-1">
        <div class="col-lg-8 mb-2 mb-lg-0 position-relative">
            <div class="card bg-glass">
                
                <div class="m-4 font-weight-bold" style="">

Jabatan Kesihatan Negeri Kedah mengendalikan aduan/ maklum balas Staf ke atas sistem penyampaian perkhidmatan berkaitan fasiliti kesihatan awam di Kedah. Pelanggan yang berhasrat untuk mengemukakan maklum balas diminta memastikan butiran maklum balas di bawah adalah lengkap untuk memudahkan proses siasatan. Sila nyatakan :<br><br>

i.  Tarikh kejadian; dan <br>
ii. Lokasi kejadian yang spesifik (Sila nyatakan hospital/ klinik/ Jabatan/ Bahagian/ Institusi yang berkaitan. Jika maklum balas melibatkan pelaporan premis makanan, sila nyatakan alamat  premis terlibat).
<br><br>
JKN Kedah berhak menolak aduan yang dikemukakan sekiranya pengadu enggan memberikan maklumat yang betul dan lengkap, aduan yang berniat jahat, berbentuk ugutan atau ancaman dan sebarang aduan yang menggunakan bahasa kesat dan lucah seperti yang dinyatakan di laman web JKN Kedah.
<br><br>
JKN Kedah juga tidak akan mencampuri dalam urusan kes-kes aduan yang melibatkan keputusan mana-mana mahkamah/ badan arbitari/ seumpamanya serta mana-mana pertikaian yang melibatkan masalah peribadi antara syarikat/ individu yang tiada kaitan dengan peranan/ fungsi agensi Kerajaan. <br><br>
            </div>

        <div class="card bg-glass">

                <form name = "addform" enctype="multipart/form-data" action="{{url('/share/')}}" method="POST">
                {{ csrf_field() }}

                @csrf

                <div class="card-body px-1 ml-4 mr-4 py-3 px-md-5">

                    <div class="form-outline mb-4">
                        <div class="bg-warning"><h3>Sila nyatakan aduan/maklum balas anda: </h3></div><br>

                        <label class="form-label font-weight-bold" for="form3Example3">Jenis</label>
                        <select class="form-control btn-sm" name="jenis_id" id="jenis_id" required>
                                @foreach($jenis as $row)
                                    <option value="{{$row->id}}">{{$row->jenis}} </option>
                                @endforeach
                            </select> 
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label font-weight-bold" for="tajuk" required>Tajuk</label>
                        <textarea name="tajuk" class="form-control" required></textarea> 
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label font-weight-bold required">Butiran</label>
                        <textarea  rows="4" name="butiran" class="form-control" required></textarea> 
                    </div>
                    
                    <div class="form-outline mb-4">
                        <label class="form-label font-weight-bold">Lokasi</label>
                       <input type="text" rows="1" name="lokasi" class="form-control" max = '255'>
                    </div>
         
                    <div class="form-outline">
                        <label class="form-label font-weight-bold">Lampiran</label>
                    </div>

                    <div class="row">
                        <div class="card-body">

                        <!-- print success message after file upload  -->
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                        @php
                                            Session::forget('success');
                                        @endphp
                                    </div>
                                @endif

                                <div class="form-group" {{ $errors->has('lampiran') ? 'has-error' : '' }}>
                                    <label for="lampiran"></label>
                                        <input type="file" name="lampiran" id="lampiran" class="form-control">
                                        <span class="text-danger"> {{ $errors->first('lampiran') }}</span>
                                </div>
                        </div>
                    </div>

                    <hr class="bg-info border-3 border-top border-info">

                    <div class="bg-warning"><h3>Maklumat Staf</h3></div>

                    <br>
                    @if (Auth::guest()) 
                        <div class="row">
                            <div class="col-md-4 mb-4">
                              <div class="form-outline">
                                <label class="form-label font-weight-bold required">No KP (tanpa -)</label>
                                <input class="form-control" type="text" name="username" maxlength = "15" required>
                              </div>
                            </div>
                            <div class="col-md-8 mb-4">
                              <div class="form-outline">
                                <label class="form-label font-weight-bold required" >Nama Staf</label>
                                    <input class="form-control" type="text" name="name" maxlength="255">

                              </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 mb-4">
                              <div class="form-outline">
                                <label class="form-label font-weight-bold required">
                                    PTJ
                                </label>
                                <select class="form-control btn-sm" name="ptj_id" id="ptj_id" required>
                                    @foreach($ptj as $row)
                                        <option value="{{$row->id}}">{{$row->ptj}} </option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6 mb-4">
                              <div class="form-outline">
                                <label class="form-label font-weight-bold required" >Bahagian / KK / KD</label>
                                <select class="form-control btn-sm" name="bahagian_id" id="bahagian_id">
                                    @foreach($bahagian as $row)
                                        <option value="{{$row->id}}">{{$row->bahagian}} </option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                              <div class="form-outline">
                                <label class="form-label font-weight-bold required">Jawatan</label>
                                <select class="form-control btn-sm" name="jawatan_id" id="jawatan_id">
                                    @foreach($jawatan as $row)
                                        <option value="{{$row->id}}">{{$row->jawatan}} </option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6 mb-4">
                              <div class="form-outline">
                                <label class="form-label font-weight-bold" for="form3Example1">Gred</label>
                                <select class="form-control btn-sm" name="gred_id" id="gred_id">
                                    @foreach($gred as $row)
                                        <option value="{{$row->id}}">{{$row->gred}} </option>
                                    @endforeach
                                </select>
                              </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                              <div class="form-outline">
                                <label class="form-label font-weight-bold required" >No Telefon</label>
                                <input type="text" name="no_telefon" class="form-control" maxlength = "20" required>
                              </div>
                            </div>
                            <div class="col-md-6 mb-4">
                              <div class="form-outline">
                                <label class="form-label font-weight-bold required">Emel</label>
                                <input type="email" name="email" maxlength = "255" class="form-control" required/>
                              </div>
                            </div>
                        </div>
                    @else 
                        <input type = 'hidden' name = 'username' value = " {{ Auth::user()->username }} ">
                        <input type = 'hidden' name = 'name' value = " {{ Auth::user()->name }}">
                        <input type = 'hidden' name = 'ptj_id'   value = "{{Auth::user()->ptj_id}}">
                        <input type = 'hidden' name = 'bahagian_id' value = " {{ Auth::user()->bahagian_id }}">
                        <input type = 'hidden' name = 'jawatan_id' value = " {{ Auth::user()->jawatan_id }} ">
                        <input type = 'hidden' name = 'gred_id' value = " {{ Auth::user()->gred_id }} ">
                        <input type = 'hidden' name = 'email' value = " {{ Auth::user()->email }} ">
                        <input type = 'hidden' name = 'no_telefon' value = " {{ Auth::user()->no_telefon }} ">

                        <table class="table table-sm">
                            <tr> <td>Nama</td><td class="font-weight-bold"> {{ Auth::user()->name }} </td></tr>
                            <tr> <td>No KP</td><td class="font-weight-bold"> {{ Auth::user()->username }}</td></tr>
                            <tr> <td>PTJ</td><td class="font-weight-bold"> {{ Auth::user()->ptj->ptj }}</td></tr>
                            <tr> <td>Bahagian</td>
                                 <td class="font-weight-bold">{{ Auth::user()->bahagian->bahagian }}  </td></tr>
                            <tr> <td>Jawatan</td><td class="font-weight-bold">{{ Auth::user()->jawatan->jawatan }}</td> </tr>
                            <tr> <td>Gred</td>          <td  class="font-weight-bold">{{ Auth::user()->gred->gred }}</td>   </tr>
                            <tr> <td>No Telefon</td><td  class="font-weight-bold"> {{ Auth::user()->no_telefon }}</td>    </tr>
                            <tr> <td>Emel</td>          <td  class="font-weight-bold"> {{ Auth::user()->email }}</td> </tr>
                        </table>
                        <hr class="bg-info"></hr>

                    @endif
                    <div>

<br>
                        <h5>Akuan Pengesahan: </h5>
<div class="font-weight-bold">Saya mengaku bahawa saya telah membaca dan memahami takrif aduan dan prosidur pengurusan aduan oleh pihak Kerajaan Malaysia. Segala maklumat diri dan maklumat perkara yang dikemukakan oleh saya adalah benar dan saya bertanggungjawab ke atasnya.</div><br><br>

Kerajaan Malaysia tidak bertanggungjawab terhadap sebarang kehilangan atau kerosakan yang dialami kerana menggunakan perkhidmatan ini di dalam sistem ini.<br><br>

Semua maklumat akan dirahsiakan dan hanya digunakan oleh Kerajaan Malaysia.<br><br>
<h5>Penafian:</h5>
Kerajaan Malaysia tidak bertanggungjawab terhadap sebarang kehilangan, kerosakan atau keaiban yang dialami kerana menggunakan perkhidmatan ini.
 


                    </div><br><br>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Hantar
                    </button>

                    <!-- Register buttons -->
                </div>
                </form>
            </div>

        </div>
        <div class="col-lg-4 mb-1 mb-lg-0" style="z-index: 2">

             @if (Auth::guest()) 
                <div class="card">
                    <div class="card-header bg-info font-weight-bold text-light">Log Masuk</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right font-weight-bold">Username (No KP)</label>

                                <div class="col-md-8">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


<!--                             <div class="form-group row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group row mb-0">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">
                                        Log Masuk
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Lupa Kata Laluan?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- tutup login -->
            @else 
            <div class="card">
                <p class="card-header font-weight-bold">Selamat Datang.. </p>
                <p class="card-body">Anda telah log masuk sebagai <br> <font color="blue">{{ Auth::user()->name }} </font></p>
                <p class="font-weight-bold"><a href="{{url('/senarai')}}">SENARAI MAKLUM BALAS </a></p>

                <p class="font-weight-bold"><a href="{{route('admin.users.edit', Auth::user())}}">KEMASKINI USER </a></p>
                <p>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                </p>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
</section>
<!-- Section: Design Block -->

@endsection

<script type="text/javascript">

jQuery(document).ready(function()
    {
            jQuery('select[name="ptj_id"]').on('change',function() {
                var ptj_id = jQuery(this).val();
                
                // alert(ptj_id);
                if (ptj_id) {
                    axios.get('/share/public/getBahagian/'+ptj_id)
                    .then(function (response) {
                        // console.log('yes berjaya');
                        // console.log(response);
                        // console.log(response.data);

                        var data = response.data;

                        jQuery('select[name="bahagian_id"]').empty();
                        
                        jQuery.each(data, function(value,key) {
                            $('select[name="bahagian_id"]').append('<option value="'+ key +'">'+ value +'</option>')
                        });
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        alert('error axios');

                    });

                }

            });



    });




</script>