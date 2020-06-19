<!DOCTYPE html>
<html>
<head>
  <!-- Site made with Mobirise Website Builder v4.12.3, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="/assets/images/logo-162x162.png" type="image/x-icon">
  <meta name="description" content="Peta Sebaran Covid19">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  
  
  <title>Edit Data</title>
  <link rel="stylesheet" href="{{ asset('/assets/web/assets/mobirise-icons2/mobirise2.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/web/assets/mobirise-icons/mobirise-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/bootstrap-grid.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/bootstrap-reboot.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/tether/tether.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/dropdown/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/datatables/data-tables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/theme/css/style.css') }}">
  <link rel="preload" as="style" href="{{ asset('/assets/mobirise/css/mbr-additional.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/mobirise/css/mbr-additional.css') }}" type="text/css">
  
  
  
</head>
<body>


@include('layouts.header')


<!--         <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    CRUD Data Pegawai - <strong>EDIT DATA</strong> - <a href="https://www.malasngoding.com/category/laravel" target="_blank">www.malasngoding.com</a>
                </div>
                <div class="card-body">
                    <a href="/data" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
 
                    <form method="post" action="/data/update/{{ $positif->id_positif }}">
 
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
 
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="tgl" class="form-control" placeholder="Nama pegawai .." value=" {{ $positif->tgl }}">
 
 
                        </div>
 
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="ic" class="form-control" placeholder="Alamat pegawai .."> {{ $positif->ic }} </textarea>
 
 
                        </div>
 
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>
 
                    </form>
 
                </div>
            </div>
        </div>
    </body>
</html> -->

 

<section class="mbr-section form1 cid-rYFHaAtBbz" id="form1-1i">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">EDIT DATA</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">Jumlah Pasien Positif COVID19</h3>
            </div>

            <form method="post" action="/data/update/{{ $positif->id_positif }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="dragArea row">
                  <div class="col-md-3  form-group" >
                        <label for="kabupaten" class="form-control-label mbr-fonts-style display-7">Kabupaten</label>
                        <input type="text" name="kabupaten" disabled="disabled" value=" {{ $positif->kelurahan->kecamatan->kabupaten->nama_kabupaten }}" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3">
                      <label class="mbr-fonts-style display-7">Kecamatan</label>
                      <input type="text" name="kecamatan" disabled="disabled" value=" {{ $positif->kelurahan->kecamatan->nama_kecamatan }}" required="required" class="form-control input display-7">
                    </div>

                    <div class="col-md-3">
                      <label class="mbr-fonts-style display-7">Kelurahan</label>
                      <input type="text" name="kelurahan" disabled="disabled" value=" {{ $positif->kelurahan->nama_kelurahan }}" required="required" class="form-control input display-7">
                    </div>

                    <div class="col-md-3  form-group" >
                        <label class="form-control-label mbr-fonts-style display-7">Tanggal</label>
                        <input type="text" name="tgl" disabled="disabled" value=" {{ $positif->tgl }}" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Level</label>
                        <input type="text" name="level" value=" {{ $positif->level }}" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">PP-LN</label>
                        <input type="text" name="ppln" value=" {{ $positif->ppln }}" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">PP-DN</label>
                        <input type="text" name="ppdn" value=" {{ $positif->ppdn }}" required="required" class="form-control input display-7" >
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Transmisi Lokal</label>
                        <input type="text" name="tl" value=" {{ $positif->tl }}" required="required" class="form-control input display-7" >
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Lainnya</label>
                        <input type="text" name="lainnya" value=" {{ $positif->lainnya }}" required="required" class="form-control input display-7" >
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Total</label>
                        <input type="text" name="total" value=" {{ $positif->total }}" required="required" class="form-control input display-7" >
                    </div>
                    <div class="col-md-3  form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Dirawat</label>
                        <input type="text" name="dirawat" value=" {{ $positif->dirawat }}" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Sembuh</label>
                        <input type="text" name="sembuh" value=" {{ $positif->sembuh }}" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Meninggal</label>
                        <input type="text" name="meninggal" value=" {{ $positif->meninggal }}" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Total Positif</label>
                        <input type="text" name="jml_positif" value=" {{ $positif->jml_positif }}" required="required" class="form-control input display-7">
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="SIMPAN">
                    </div>
                </div>
            </form> <!-- Formbuilder Form -->
        </div>
    </div>
</section>


@include('layouts.footer')


  <script src="../assets/web/assets/jquery/jquery.min.js"></script>
  <script src="../assets/popper/popper.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/smoothscroll/smooth-scroll.js"></script>
  <script src="../assets/vimeoplayer/jquery.mb.vimeo_player.js"></script>
  <script src="../assets/tether/tether.min.js"></script>
  <script src="../assets/dropdown/js/nav-dropdown.js"></script>
  <script src="../assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="../assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="../assets/datatables/jquery.data-tables.min.js"></script>
  <script src="../assets/datatables/data-tables.bootstrap4.min.js"></script>
  <script src="../assets/parallax/jarallax.min.js"></script>
  <script src="../assets/theme/js/script.js"></script>
  <script src="../assets/formoid/formoid.min.js"></script>


  <script src="../assets1/js/core/jquery.min.js"></script>
  <script src="../assets1/js/core/popper.min.js"></script>
  <script src="../assets1/js/core/bootstrap.min.js"></script>
  <script src="../assets1/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets1/js/plugins/chartjs.min.js"></script>
  <script src="../assets1/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets1/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <script src="../assets1/demo/demo.js"></script>
  
  
</body>
</html> 
