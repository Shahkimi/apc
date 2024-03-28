<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ url('\css\main.css')}}" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

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
  <style>
    .background-radial-gradient {
      background-color: purple;
      background-image: radial-gradient(650px circle at 0% 0%,
          hsl(purple, 41%, 35%) 15%,
          hsl(purple, 41%, 30%) 35%,
          hsl(purple, 41%, 20%) 75%,
          hsl(purple, 41%, 19%) 80%,
          transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
          hsl(purple, 41%, 45%) 15%,
          hsl(purple, 41%, 30%) 35%,
          hsl(purple, 41%, 20%) 75%,
          hsl(purple, 41%, 19%) 80%,
          transparent 100%);
    }

    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#F449F7, #ad1fff); /*44006b */
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#F449F7, #ad1fff);  /*44006b */
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
</style>


<div class="right mr-3 mt-2" style ="text-align: right;">
    <a class="text-light" href="{{ route('login') }}">Log Masuk </a>
</div>

<div class="container px-1 py-1 px-md-1 text-center my-1">
    <div class="row  mb-1">
        <div class="col-lg-4 mb-1 mb-lg-0" style="z-index: 10">
            <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                JABATAN KESIHATAN NEGERI KEDAH <br /><br>
                <span style="color: hsl(218, 81%, 75%)">Idea / Cadangan untuk Penambahbaikan Perkhidmatan</span>
            </h1>
            <img src="{{asset('/img/building-art.png')}}" alt="pizzahot logo"><br>
        </div>
        
        <div class="col-lg-8 mb-5 mb-lg-0 position-relative">
            <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
            <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

            <div class="card bg-glass">

                <form name = "addform" enctype="multipart/form-data" action="{{url('/share/')}}" method="POST">
                {{ csrf_field() }}

                @csrf

                <div class="card-body px-1 py-3 px-md-5">

                    @if(session()->has('message'))
                        <div class="warning alert-success font-weight-bold mb-4">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="form-outline mb-4">
                        <label class="form-label font-weight-bold" for="form3Example3">Masalah</label>
                        <textarea name="masalah" class="form-control" ></textarea> 
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label font-weight-bold required">Idea / Cadangan Penambahbaikan</label>
                        <textarea  rows="4" name="cadangan" class="form-control" ></textarea> 
                    </div>
                    <hr class="bg-info border-2 border-top border-info">

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
                            <label class="form-label font-weight-bold required" >Bahagian</label>
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
                            <label class="form-label font-weight-bold" for="form3Example1">Unit</label>
                            <input type="text" name="unit" class="form-control" />
                          </div>
                        </div>
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
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                          <div class="form-outline">
                            <label class="form-label font-weight-bold required" >No Telefon</label>
                            <input type="text" name="no_telefon" class="form-control" max ='20' required>
                          </div>
                        </div>
                        <div class="col-md-6 mb-4">
                          <div class="form-outline">
                            <label class="form-label font-weight-bold">Emel</label>
                            <input type="email" name="emel" max= '100'class="form-control" />
                          </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                        Hantar
                    </button>

                    <!-- Register buttons -->
                </div>
                </form>
            </div>
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
                    axios.get('/shareandcares/public/getBahagian/'+ptj_id)
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