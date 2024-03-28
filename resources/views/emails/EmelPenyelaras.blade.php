<style>
    .email-row {
    }
    .email-col-2 {
        width: 49%;
        display: inline-block;
    }
    .table-condensed{
        font-size: 10px;
    }
</style>
<body>

@component('mail::message')


<div style="email-row"><br>
    <p>Assalammualaikum / Salam Sejahtera, </p>
    <br>
    <p>Adalah dimaklumkan Sistem Aduan / Maklumbalas Jabatan Kesihatan Negeri Kedah telah menerima aduan / maklumbalas baharu seperti berikut :
    <br>

    <table class="table table-sm table-striped">
        <tr><td>Tarikh / Masa</td>      <td>:</td><td>{{ $aduan['created_at'] }} </td></tr>
        <tr><td>Jenis</td>              <td>:</td><td>{{ $aduan['jenis'] }} </td></tr>
        <tr><td>Tajuk</td>              <td>:</td><td>{{ $aduan['tajuk'] }} </td></tr>
        <tr><td>Butiran</td>            <td>:</td><td>{{ $aduan['butiran'] }} </td></tr>
        <tr><td>Lokasi</td>             <td>:</td><td>{{ $aduan['lokasi'] }} </td></tr>
        <tr><td>Nama</td>               <td>:</td><td>{{ $aduan['name'] }} </td></tr>
        <tr><td>No KP</td>              <td>:</td><td>{{ $aduan['username'] }} </td></tr>
        <tr><td>PTJ</td>                <td>:</td><td>{{ $aduan['ptj'] }} </td></tr>
        <tr><td>Bahagian / KK / KD</td> <td>:</td><td>{{ $aduan['bahagian'] }} </td></tr>
        <tr><td>Jawatan / Gred</td>     <td>:</td><td>{{ $aduan['jawatan'] }} </td></tr>
        <tr><td>No Telefon</td>         <td>:</td><td>{{ $aduan['no_telefon'] }} </td></tr>
        <tr><td>Emel</td>               <td>:</td><td>{{ $aduan['email'] }} </td></tr>
    </table>
    <br>

    <p>Sila Klik butang dibawah untuk log masuk ke dalam sistem dan mengemaskini tindakan.</p>

    @component('mail::button', ['url' => 'http://apps8.kdh.moh.gov.my/share/public/', 'color' => 'green'])
    Log Masuk Sistem
    @endcomponent

    <br><br>
    <p>Sekian, terima kasih</p>
    <br><br>
    <p><b>"MALAYSIA MADANI"</b></p>
    <p><b>"BERKHIDMAT UNTUK NEGARA"</b></p>
    <p><b>"KEDAH SEJAHTERA NIKMAT UNTUK SEMUA"</b></p>
<br>
    <p>Saya yang menjalankan amanah,</p> 
    <p>Pentadbir Sistem Aduan / Maklumbalas JKN Kedah</p>

</div>

</body>
</html> 