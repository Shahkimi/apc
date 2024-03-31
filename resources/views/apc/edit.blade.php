<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

@extends('layouts.app')
@section('content')

    <br><br>
    <div class="container-fluid  ">

        <form enctype="multipart/form-data" class="bg-light rounded p-4 shadow-lg" action="{{ url('/apc/edit') }}"
            method="POST" style="width: 1000px; margin: auto;">
            <h4 style="text-align: center">KEMASKINI - PEGAWAI</h4>
            @csrf
            <br>
            <input type="text" name="id" id="id" class="form-control" value="{{ $pegawai->id }}" hidden>

            <div class="row">
                <div class="col-lg-8 form-group">
                    <label>NAMA<font color='red'> *</font></label>
                    <input type="text" class="form-control " value="{{ $pegawai->nama }}" readonly>
                </div>

                <div class="col-lg-4 form-group">
                    <label>NO KP<font color='red'> *</font></label>
                    <input type="text" class="form-control " value="{{ $pegawai->nokp }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 form-group">
                    <label>PTJ<font color='red'> *</font></label>
                    <input type="text" class="form-control " value="{{ $pegawai->ptj }}" readonly>
                </div>

                <div class="col-lg-4 form-group">
                    <label>JAWATAN<font color='red'> *</font></label>
                    <input type="text" class="form-control " value="{{ $pegawai->jawatan }}" readonly>
                </div>

                <div class="col-lg-2 form-group">
                    <label>GRED<font color='red'> *</font></label>
                    <input type="text" class="form-control " value="{{ $pegawai->gred }}" readonly>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-3 form-group">
                    <label>RSVP<font color='red'> *</font></label>
                    <input type="text" class="form-control " value="{{ $pegawai->maklumbalas_kehadiran }}" readonly>
                </div>

                <div class="col-lg-3 form-group">
                    <label>SESI<font color='red'> *</font></label>
                    <select name="sesi" id = 'sesi' class="custom-select" required>
                        <option value="PAGI" {{ $pegawai->sesi == 'PAGI' ? 'selected' : '' }}>PAGI</option>
                        <option value="PETANG" {{ $pegawai->sesi == 'PETANG' ? 'selected' : '' }}>PETANG</option>
                        <option value="PAGI_LEWAT" {{ $pegawai->sesi == 'PAGI_LEWAT' ? 'selected' : '' }}>PAGI (LEWAT)
                        </option>
                        <option value="PETANG_LEWAT" {{ $pegawai->sesi == 'PETANG_LEWAT' ? 'selected' : '' }}>PETANG
                            (LEWAT)
                        </option>
                    </select>
                </div>

                <div class="col-lg-3 form-group">
                    <label>KEHADIRAN<font color='red'> *</font></label>
                    <select name="kehadiran" class="custom-select" id="kehadiran" required>
                        <option value="1" {{ $pegawai->kehadiran == '1' ? 'selected' : '' }}>YA</option>
                        <option value="0" {{ $pegawai->kehadiran == '0' ? 'selected' : '' }}>TIDAK/BELUM MENDAFTAR
                        </option>
                    </select>
                </div>

                <div class="col-lg-3 form-group">
                    <label>NO KERUSI<font color='red'> *</font></label>
                    <input type="text" name="no_kerusi" class="form-control" value="{{ $pegawai->no_kerusi }}">
                    <div id='no_terakhir_lewat'></div>
                </div>
            </div>

            @isset($sesi)
                @foreach ($sesi ?? [] as $item)
                    <div class="row">
                        <div class="col-lg-6 form-group"></div>

                        <div class="col-lg-4 form-group text-right col-form-label">
                            <label style="width: 100%;">{{ $item->sesi ?? '' }}</label>
                        </div>

                        <div class="col-lg-2 form-group text-center">
							<input type="text" class="form-control text-center" value="{{ $item->no_last ?? '' }}" readonly>
						</div>						
                    </div>
                @endforeach
            @endisset

            <br><br>

            <div style="text-align: center;">
                <a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
                <input type="submit" name="submit" value="Hantar" class="btn btn-primary mb-2">
            </div>
        </form>
    </div>
    <br><br>
@endsection

<script type="text/javascript">
    $(document).ready(function() {
        var sesi = document.getElementById('sesi');

        sesi.onchange = function() {
            //alert('onchange, sesi='+sesi.value);
            if (sesi.value == 'PAGI_LEWAT' || sesi.value == 'PETANG_LEWAT') {
                axios.get('/apc/public/apc/getNoLewat/' + sesi.value)
                    .then(function(response) {
                        //console.log('yes berjaya');
                        //console.log(response);
                        console.log(response.data);
                        $("#no_terakhir_lewat").text("No " + sesi.value + " terakhir = " + response
                            .data);
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                        alert('error axios');
                    });

            }
        }

    });
</script>
