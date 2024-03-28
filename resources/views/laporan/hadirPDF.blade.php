<!DOCTYPE html>
<html>
<head>
    <title>Resume</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<style>
    #header,
    #footer {
      position: fixed;
      left: 0;
      right: 0;
      color: #aaa;
      font-size: 0.9em;
    }
    #header {
      top: 0;
      border-bottom: 0.1pt solid #aaa;
    }
    #footer {
      bottom: 0;
      border-top: 0.1pt solid #aaa;
    }
    .page-number:before {
      content: "Page " counter(page);
    }
    .page-break {
      page-break-after: always;
    }

</style>

</head>
  @php
    $jatanegara = '/img/jatanegara.png';
  @endphp
<body>

<script type="text/php">
    if (isset($pegawai)) {
        $text = "page {PAGE_NUM} / {PAGE_COUNT}";
        $size = 10;
        $font = $fontMetrics->getFont("Verdana");
        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
        $x = ($pdf->get_width() - $width) / 2;
        $y = $pdf->get_height() - 35;
        $pdf->page_text($x, $y, $text, $font, $size);
    }
</script>

<!-- <header class="bg-white" style="color: white">
</header> -->

<div id="footer">
  <div class="row">
    <div class="page-number col"></div>
  </div>
</div>

<main>
        <div class="title m-b-md" style="font-size: 20px; ">
          <u>SENARAI KEHADIRAN PEGAWAI MAJLIS APC 2023</u>  
        </div>

       <table class="table table-sm table-bordered">
            <thead class="thead-light">
            <tr class="text-info font-weight-bold">
                <td colspan=4">{{ $pegawai->count() }} rekod dijumpai.</td></tr>
            <tr>    
                <th scope="col text-center" style="text-align:center;">#</th>
                <th scope="col">PTJ</th>
                <th scope="col">Nama</th>
                <th scope="col text-center">No Sijil</th>
            </tr>
        </thead>

 @php
    $bil = 1;
 @endphp

@foreach($pegawai as $key=>$row)
    <tr>
        <td class="text-center">{{ $bil++ }}</td>
        <td>{{ $row->ptj->ptj }}</td>
        <td>{{ $row->nama }}</td>
        <td class = "text-center">{{ $row->no_sijil}}</td>
    </tr>
@endforeach
</table>
    
</main>


</body>
</html>


