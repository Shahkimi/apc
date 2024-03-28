<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

@extends('layouts.app')
@section('content')

<script type="text/javascript">
    $(document).ready(function () {
        $('#tkhlahir').datepicker();
    });
</script> 

<br>
   <div class="container-fluid">

   <form enctype="multipart/form-data" class="bg-white rounded p-4 shadow-lg" action="{{url('/share')}}"  method="POST" style="max-width: 600px ; margin: auto;">
   	<br>
      <h4 style="text-align: center">Sila nyatakan aduan/maklum balas anda</h4>
      @csrf

      <hr class="bg-info border-2 border-top border-info">

      <div class="row">
            <label class ="font-weight-bold">Jenis : <font color='red'></font></label>
            <select class="form-control btn-sm" name="jenis_id">
                @foreach($jenis as $tjenis)
                    <option value="{{$tjenis->jenis_id}}" {{(old('jenis_id')==$tjenis->jenis_id)? "selected" : ""}}>{{$tjenis->jenis}}
                    </option>
                @endforeach
            </select>
         </div>  
      <br>

      <div class="row">
            <label class ="font-weight-bold">Tajuk : <font color='red'> *</font></label>
            <input type="text" name="tajuk" id="tajuk" class="form-control"  required value = "{{old('tajuk')}}">
      </div>
      <br>
      <div class="row">
            <label class ="font-weight-bold">Butiran : <font color='red'> *</font></label>
            <textarea name="butiran" id="butiran" class="form-control"  required>{{old('butiran')}} </textarea> 
      </div>
      <br>

      <div class="row">
            <label class ="font-weight-bold">Cadangan Penambahbaikan : </font></label>
            <input type="text" name="cadangan" id="cadangan" class="form-control" value = "{{old('cadangan')}}">
      </div>
      <br>

      <div class="row">
            <label class ="font-weight-bold">Lokasi : <font color='red'> *</font></label>
            <input type="text" name="lokasi" id="tajuk" class="form-control" value = "{{old('lokasi')}}">
      </div>
      <br>

      <div class="row">
            <label class ="font-weight-bold">Lampiran : </label>
            <input type="file" name="lampiran" id="lampiran" class="form-control" value = "{{old('lampiran')}}">
      </div>

      <br>
       {{--   <div class="col">
            <label class ="font-weight-bold">No KP : <font color='red'> *</font></label>
            <input type="text" name="nokp" id="nokp" style="width:150px" class="form-control"  maxlength="12" size="12" required 
                value = "{{old('nokp')}}">
            <div id="result" class="text-danger"></div>

            @if ($errors->has('nokp'))
                  <span class="text-danger" id='result2'>{{ $errors->first('nokp') }}</span>
            @endif

         </div>
          <div class="col">
            <label class ="font-weight-bold">Nama : <font color='red'> *</font></label>
            <input type="text" name="nama" id="nama" class="form-control"  required value = "{{old('nama')}}">
         </div>
      </div>
      </br>



         <div class="col">
            <label class ="font-weight-bold">Jantina : <font color='red'> *</font></label>
             <div class="col-auto">
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="jantina" id="jantina" value = 'P'>
                     <label class="form-check-label" for="jantina">Perempuan</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="jantina" id="jantina" value = 'L'>
                     <label class="form-check-label" for="jantina">Lelaki</label>
                 </div>
             </div>
         </div>
      </div>
      </br>


      <div class="row">
         <div class="col">
            <label class ="font-weight-bold">Bangsa : <font color='red'> *</font></label>
            <select class="form-control btn-sm" name="bangsa">
                @foreach($bangsa as $tbangsa)
                          <option value="{{$tbangsa->kodbangsa}}" {{(old('bangsa')==$tbangsa->kodbangsa)? "selected" : ""}}>{{$tbangsa->bangsa}}</option>
                    @endforeach
               </select>
         </div>
         <div class="col">
            <label class ="font-weight-bold">Agama : <font color='red'>*</font></label>
            <select class="form-control btn-sm" name="agama">
                @foreach($agama as $tagama)
                          <option value="{{$tagama->kodagama}}" {{(old('agama')==$tagama->kodagama)? "selected" : ""}}>{{$tagama->agama}}</option>
                    @endforeach
               </select>
         </div>      
      </div>
      </br>
                  

      <div class="row">
         <div class="col">
            <label class ="font-weight-bold">Tarikh Lahir : <font color='red'> *</font></label>
            <input type="text" name="tkhlahir" id="tkhlahir" style="" class="form-control"  value = "{{old('tkhlahir')}}" required>
         </div>   

         <div class="col">
            <label class ="font-weight-bold">Umur</label>
            <input type="text" name="umur" id="umur" style="" class="form-control" readonly value = "{{old('umur')}}">
         </div>   
         <div class="col">
            <label class ="font-weight-bold">Merokok :</label>
             <div class="col-auto">
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="merokok" id="merokok" value = 'Y' {{(old('merokok') == "Y")? "checked" : ""}}>
                     <label class="form-check-label" for="merokok">Ya</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="merokok" id="merokok" value = 'T' {{(old('merokok') == "T")? "checked" : ""}}>
                     <label class="form-check-label" for="merokok">Tidak</label>
                 </div>
             </div>
         </div>   
         <div class="col">
            <label class ="font-weight-bold">Saman Trafik :</label>
             <div class="col-auto">
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="samantrafik" id="samantrafik" value = 'Y' {{(old('samantrafik') == "Y")? "checked" : ""}}>
                     <label class="form-check-label" for="samantrafik">Ya</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="samantrafik" id="samantrafik" value = 'T' {{(old('samantrafik') == "T")? "checked" : ""}}>
                     <label class="form-check-label" for="samantrafik">Tidak</label>
                 </div>
             </div>
         </div>
      </div>
      </br>

      <div class="row">
         <div class="col">
            <label class ="font-weight-bold">APC Pernah Diterima (selain dari sistem dan dari luar PTJ) :</label>
            <input type="text" name="APCpernahditerima" id="APCpernahditerima" class="form-control" value = "{{old('APCpernahditerima')}}">
         </div>
      </div>
      <hr class="bg-info border-2 border-top border-info">
      <br>
      <div class="row">
         <div class="col">
            <label class ="font-weight-bold">Tarikh Lantikan : <font color='red'> *</font></label>
            <input type="date" name="tkhlantikan" id="tkhlantikan" style="" class="form-control" value = "{{old('tkhlantikan')}}" required>
         </div>
         <div class="col">
            <label class ="font-weight-bold">Tarikh Sah Lantikan :</label>
            <input type="date" name="tkhsahlantikan" id="tkhsahlantikan" style="" class="form-control" value = "{{old('tkhsahlantikan')}}">
         </div>
         <div class="col">
            <label class ="font-weight-bold">Tarikh Sah Jawatan :</label>
            <input type="date" name="tkhsahjawatan" id="tkhsahjawatan" style="" class="form-control" value = "{{old('tkhsahjawatan')}}">
         </div>      
         <div class="col">
            <label class ="font-weight-bold">T/T/Keselamatan :</label>
            <input type="date" name="tkhtapisan" id="tkhtapisan" style="" class="form-control" value = "{{old('tkhtapisan')}}">
         </div>   
      </div>
      <br>

      <div class="row"> 
         <div class="col">
            <label class ="font-weight-bold">Status Khidmat </label>
            <input type="text" name="statuskhidmat" id="statuskhidmat" class="form-control" value = "{{old('statuskhidmat')}}">
         </div>
         <div class="col">
            <label class ="font-weight-bold">Pergerakan Gaji :</label>
            <div class="col-auto">
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="pergerakangaji" id="pergerakangaji" value = '1/1' {{(old('pergerakangaji') == "1/1")? "checked" : ""}}>
                     <label class="form-check-label" for="pergerakangaji">JAN &nbsp;&nbsp;</label>

                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="pergerakangaji" id="pergerakangaji" value = '1/4' {{(old('pergerakangaji') == "1/4")? "checked" : ""}}>
                     <label class="form-check-label" for="pergerakangaji">APR &nbsp;&nbsp;</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="pergerakangaji" id="pergerakangaji" value = '1/7' {{(old('pergerakangaji') == "1/7")? "checked" : ""}}>
                     <label class="form-check-label" for="pergerakangaji">JUL &nbsp;&nbsp;</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="pergerakangaji" id="pergerakangaji" value = '1/10' {{(old('pergerakangaji') == "1/10")? "checked" : ""}}>
                     <label class="form-check-label" for="pergerakangaji">OKT &nbsp;&nbsp;</label>
                 </div> 
             </div>
         </div>
         <div class="col">
            <label class ="font-weight-bold">Tarikh Kemasukan Pencen:</label>
            <input type="date" name="tkhmpencen" id="tkhmpencen" class="form-control" value = "{{old('tkhmpencen')}}">
         </div>   
         <div class="col">
            <label class ="font-weight-bold">Opsyen Pencen :</label>
            <div class="col-auto">
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="opsyenpencen" id="opsyenpencen" value = '55' {{(old('opsyenpencen') == "55")? "checked" : ""}}>
                     <label class="form-check-label" for="opsyenpencen">55 &nbsp;&nbsp;</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="opsyenpencen" id="opsyenpencen" value = '56' {{(old('opsyenpencen') == "56")? "checked" : ""}}>
                     <label class="form-check-label" for="opsyenpencen">56 &nbsp;&nbsp;</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="opsyenpencen" id="opsyenpencen" value = '58' {{(old('opsyenpencen') == "58")? "checked" : ""}}>
                     <label class="form-check-label" for="opsyenpencen">58 &nbsp;&nbsp;</label>
                 </div>
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="opsyenpencen" id="opsyenpencen" value = '60' {{(old('opsyenpencen') == "60")? "checked" : ""}}>
                     <label class="form-check-label" for="opsyenpencen">60 &nbsp;&nbsp;</label>
                 </div> 
                 <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="opsyenpencen" id="opsyenpencen" value = 'Pilihan' {{(old('opsyenpencen') == "Pilihan")? "checked" : ""}}>
                     <label class="form-check-label" for="opsyenpencen">Pilihan</label>
                 </div>                              
             </div>
         </div>
         <br>
       </div>
      <br>
 --}}
      <br>
      <br>
      <div style="text-align: center;">
      <a class="btn btn-outline-primary mb-2" href="{{url('/pegawai')}}">Batal</a>
      <input type="submit" name="submit" value="TAMBAH" class="btn btn-primary mb-2">
      </div>

   </form>
</div>


<br><br>

@endsection
<script type="text/javascript">

  $(document).ready(function(){
      $("#nokp").on("input", function(){
          // Print entered value in a div box
          var nokp = jQuery(this).val();

          var msg = "";

          $("#result2").text("");

          var len = nokp.length;

          if (len == 12) {
            jQuery.ajax({
                 url : 'http://apps8.kdh.moh.gov.my/eppsm/public/pegawai/semaknokp/'+nokp,
                type : "GET",
                dataType : "json",
                success:function(data)
                {
                    jQuery.each(data, function(value,key) {
                        if (nokp == key) {
                          msg = "No KP telah wujud. Sila semak.";
                          $("#result").text(msg);
                        } 
                    });
                }
            });

            // set jantina
            if(nokp.substr(nokp.length - 1) % 2 == 0) 
                  $("input[name=jantina][value=" + "P" + "]").prop('checked', true);
            else 
                  $("input[name=jantina][value=" + "L" + "]").prop('checked', true);

            // set tarikh lahir
            // let now = new Date();
            // let today = now.getDate()  + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
            // console.log(today);
            // $('#tkhlahir').val(today);


            let tmp_tahun = nokp.substring(0, 2);
            let bulan = nokp.substring(2, 4);
            let hari = nokp.substring(4, 6);

            if(tmp_tahun >= 00 && tmp_tahun <= 30) {
              tmp_tahun = 20+tmp_tahun;
            }

            if(tmp_tahun >= 31 && tmp_tahun <= 99) {
              tmp_tahun = 19+tmp_tahun;
            }

            //set tarikh lahir
            let tarikh = hari  + '/' + bulan + '/' + tmp_tahun;
            //console.log(tarikh);
            $('#tkhlahir').val(tarikh);

            //set umur
            var umur = getAge(tarikh); 
            //alert(umur);
            $('#umur').val(umur);

          } else {
            msg = "Must be 12 characters long ("+len+")";
          }
          $("#result").text(msg);
      });
  }); 

function getAge(dateString) {
  var now = new Date();
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());

  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();

  var dob = new Date(dateString.substring(6,10),
                     dateString.substring(0,2)-1,                   
                     dateString.substring(3,5)                  
                     );

  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = "";
  var yearString = "";
  var monthString = "";
  var dayString = "";


  yearAge = yearNow - yearDob;

  if (monthNow >= monthDob)
    var monthAge = monthNow - monthDob;
  else {
    yearAge--;
    var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
    var dateAge = dateNow - dateDob;
  else {
    monthAge--;
    var dateAge = 31 + dateNow - dateDob;

    if (monthAge < 0) {
      monthAge = 11;
      yearAge--;
    }
  }

  age = {
      years: yearAge,
      months: monthAge,
      days: dateAge
      };

  ageString = age.years + " tahun , " + age.months + " bulan dan " + age.days +" hari.";

  return ageString;
}

$(".tkhlahir").on("change", function(){
  var dob = $('.tkhlahir').val();
  alert(dob);
  var umur = getAge(dob); 
  $('.umur').val(umur);
});
</script>
