
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.3.min.js"></script>

@extends('layouts.app')
@section('content')

<br>
<div class="container-fluid px-5 pb-3" style="max-width: auto ;">
		<div class="p-3 text-white justify-content-start" style="background-color : #902639;"> 
			<span class = "h4 font-weight-bold" style="text-align:center"><center>KEMASKINI MAKLUMAT</center></span>
		</div>
</div>

<form enctype="multipart/form-data" action="{{url('/share/update')}}"  method="POST" style="margin: auto;">
@csrf

<div class="container-fluid px-5 pb-3">
<div class="row">
	<div class="col-lg-5">
		<div class=" container pr-5 pl-5 pt-2 shadow-lg bg-light" style="max-width: auto ;">
		
		<table class="table table-sm">
				<tr>
						<td>Tarikh Aduan</td>
						<td class="font-weight-bold">{{ \Carbon\Carbon::parse($aduan->updated_at)->format('d-m-Y h:i:s  (l)') }} </td>
				</tr>
				<tr> <td>ID</td>				<td class="font-weight-bold"> {{ $aduan->id_aduan }} </td></tr>
				<tr> <td>PTJ</td>				<td class="font-weight-bold"> {{ $aduan->ptj }} </td></tr>
				<tr> <td>No KP</td>				<td class="font-weight-bold"> {{ $aduan->username }}</td></tr>
				<tr> <td>Nama</td>				<td class="font-weight-bold"> {{ $aduan->name }}</td></tr>
				<tr> <td>Bahagian</td>	<td class="font-weight-bold"> {{ $aduan->bahagian }} </td></tr>
				<tr> <td>Jawatan</td>		<td class="font-weight-bold">{{ $aduan->jawatan }}</td> </tr>
				<tr> <td>Gred</td>			<td  class="font-weight-bold">{{ $aduan->gred }}</td>	</tr>
				<tr> <td>No Telefon</td><td  class="font-weight-bold">{{ $aduan->no_telefon }} </td>	</tr>
				<tr> <td>Emel</td>			<td  class="font-weight-bold"> {{ $aduan->email }}</td>	</tr>
		</table>
		<hr class="bg-info"></hr>

		@if ($edited=='readonly')
		<div class="row px-3">
		    <label class ="font-weight-bold">Pegawai Penyelaras : <font color='red'> *</font></label>
		    <input type="hidden" name="penyelaras_id" value = "{{$aduan->penyelaras_id}}">
		    <input type="text" name="penyelaras_id" value = "{{$aduan->nama_penyelaras}}"  class="form-control" readonly>
		</div>
		<br>		
		
		@else 

		<div class="row px-3">
		    <label class ="font-weight-bold">Pegawai Penyelaras : <font color='red'> *</font></label>
		   	<select class="form-control btn-sm" name="penyelaras_id">
		        @foreach($penyelaras as $row)
		            <option value="{{$row->id}}" {{($aduan->penyelaras_id==$row->id)? "selected" : ""}}>{{$row->name}}
		            </option>
		        @endforeach
		    </select>
		</div>
		<br>
		@endif

		<div class="row">
			<div class="col col-lg-6 px-3">
			    <label class ="font-weight-bold">Tarikh Tindakan : </label>
			   
			    <input type="text" name="tarikh_tindakan" id="tarikh_tindakan" class="form-control" value = "{{ ($aduan->tarikh_tindakan<>NULL)? \Carbon\Carbon::parse($aduan->tarikh_tindakan)->format('d-m-Y h:i:s'): '' }}" readonly>
			</div>

			<div class="col col-lg-6 px-3">
			    <label class ="font-weight-bold">Tarikh Selesai : <font color='red'> *</font></label>
			    @if($edited=='readonly')
			    <input type="text" name="tarikh_selesai" id="tarikh_selesai" class="form-control" value = "{{ ($aduan->tarikh_selesai<>NULL)? \Carbon\Carbon::parse($aduan->tarikh_selesai)->format('d-m-Y h:i:s'): '' }}" readonly>
			    @else
			    <input type="date" name="tarikh_selesai" id="tarikh_selesai" class="form-control" value = "{{$aduan->tarikh_selesai}}" {{ $edited }}>
			    @endif
			    <div id="result_tarikh_selesai" class="text-danger"></div>
			</div>
		</div>
		<br>

		</div>
	</div>
	<div class="col-lg-7 ">
		<div class="container pr-5 pl-5 pt-2 bg-light shadow-lg" style="max-width: auto ;">
	
		<input type="hidden" name="id_aduan" value="{{ $aduan->id_aduan }}">
	 
	 	@if ($edited=='readonly')
		<div class="row">
				<div class="col-md-6 mb-4">
						<div class="form-outline">
								<label class="form-label font-weight-bold required" >Status</label>
		    				<input type="hidden" name="status_id" id = "status_id" value="{{ $aduan->status_id }}">
		    				<input type="text" style="background-color: Azure;" value = "{{$aduan->status}}"  class="form-control" readonly>
						</div>
				</div>

				<div class="col-md-6 mb-4">
						<div class="form-outline">
								<label class="form-label font-weight-bold required">Jenis</label>
		    				<input type="hidden" name="jenis_id" value="{{ $aduan->jenis_id }}">
		    				<input type="text" style="background-color: Azure;" value = "{{$aduan->jenis}}"  class="form-control" readonly>

						</div>
				</div>
		</div>


		@else 

		<div class="row">
				<div class="col-md-6 mb-4">
						<div class="form-outline">
								<label class="form-label font-weight-bold required" >Status</label>
								<select class="form-control btn-sm" name="status_id" id = "status_id">
						        @foreach($status as $row)
						            <option value="{{$row->id}}" {{($aduan->status_id==$row->id)? "selected" : ""}}>{{$row->status}}
						            </option>
						        @endforeach
		    				</select>
						</div>
				</div>

				<div class="col-md-6 mb-4">
						<div class="form-outline">
								<label class="form-label font-weight-bold required">Jenis</label>
						    <select class="form-control btn-sm" name="jenis_id">
						        @foreach($jenis as $row)
						            <option value="{{$row->id}}" {{($aduan->jenis_id==$row->id)? "selected" : ""}}>{{$row->jenis}}
						            </option>
						        @endforeach
						    </select>
						</div>
				</div>
		</div>
		@endif

		<div class="row px-3">
			    <label class ="font-weight-bold">Aduan / Maklumbalas: <font color='red'> *</font></label>
			    <textarea class="form-control" style="background-color: Azure;" readonly >{{$aduan->tajuk}}</textarea>
		</div>
		<br>
		
		<div class="row px-3">
		    <label class ="font-weight-bold">Butiran : <font color='red'> *</font></label>
		    <textarea class="form-control" style="background-color: Azure;" readonly rows='5'>{{$aduan->butiran}}</textarea> 
		</div>
		<br>

		<div class="row px-3">
		    <label class ="font-weight-bold">Lokasi : </label>
		    <input class="form-control" style="background-color: Azure;" readonly value = "{{$aduan->lokasi}}"> 
		</div>
		<br>

		<div class="row px-3">
		    <label class ="font-weight-bold">Lampiran : 
		    		@if ($aduan->lampiran)
		    				<a href="{{ asset('lampiran/'.$aduan->lampiran) }}" target="_blank"> View Lampiran</a>
		    		@else 
		    				Tiada
		    		@endif
		    </label>

		    
		   
		</div>
		<br>

		<div class="row px-3">
		    <label class ="font-weight-bold">Tindakan Penyelaras: <font color='red'> *</font></label>
		    <textarea class="form-control" rows="5" name="tindakan" id="tindakan" class="form-control" required {{ $edited }}>{{$aduan->tindakan}}</textarea>
		</div>
		<br>

		<hr class="bg-info border-2 border-top border-info">
		<div class="row">
			<div class="col">
					<label>Tarikh Akhir Kemaskini : {{ \Carbon\Carbon::parse($aduan->updated_at)->format('d-m-Y h:i:s') }}</label>
			</div>
		</div>
		<br>
		
		<div style="text-align: center;">
					<a class="btn btn-outline-primary mb-2" href="{{ url('/senarai/') }}">Kembali</a>
					@if ($edited<>'readonly')
						<input type="submit" name="submit" value="Simpan" onclick=" return validate()" class="btn btn-primary mb-2">
					@endif
			</div>
		</div>
	
	</div>
</form>

</div>



@endsection

<script type="text/javascript">
	
const tx = document.getElementsByTagName("textarea");

for (let i = 0; i < tx.length; i++) {
  tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
  tx[i].addEventListener("input", OnInput, false);
}

function OnInput() {
  this.style.height = 0;
  this.style.height = (this.scrollHeight) + "px";
}


$(document).ready( function() {



});

function validate() {
	
		var tarikh_selesai = document.getElementById('tarikh_selesai');
		var status_id = document.getElementById("status_id").value;

		if (status_id==3 && tarikh_selesai.valueAsDate == null) {
				alert ('Sila masukkan tarikh selesai');
				$("#result_tarikh_selesai").text('Sila isi tarikh selesai');
				return false;
		}

		return true;

}



</script>

