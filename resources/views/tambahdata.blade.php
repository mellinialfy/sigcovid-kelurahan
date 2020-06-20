<!DOCTYPE html>
<html>
<head>
  <!-- Site made with Mobirise Website Builder v4.12.3, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="/logo-162x162.png" type="image/x-icon">
  <meta name="description" content="Peta Sebaran Covid19">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  
  
  <title>Tambah Data</title>
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

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  
  
  
</head>
<body>


@include('layouts.header')

<section class="mbr-section form1 cid-rYFHaAtBbz" id="form1-1i">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">INPUT DATA</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">Jumlah Pasien Positif COVID19</h3>
            </div>

            <form method="post" action="/data/store">
                {{ csrf_field() }}
                <div class="dragArea row">
                    <div class="col-md-3  form-group" >
                        <label for="kabupaten" class="form-control-label mbr-fonts-style display-7">Kabupaten</label>
                        <select name="id_kabupaten" id="id_kabupaten" class="form-control input display-7">
                            <option value="" selected="selected">Pilih Kabupaten</option>
                           @foreach($kabupaten as $k)
                            <option value="{{$k->id_kabupaten}}">{{$k->nama_kabupaten}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-3">
                      <label class="mbr-fonts-style display-7">Kecamatan</label>
                      <select name="id_kecamatan" id="id_kecamatan" class="form-control input display-7">
                        <option value="" selected="true">Pilih Kecamatan</option>

                      </select>
                    </div>

                    <div class="col-md-3">
                      <label class="mbr-fonts-style display-7">Kelurahan</label>
                      <select name="id_kelurahan" id="id_kelurahan" class="form-control input display-7">
                        <option value="" selected="selected">Pilih Kelurahan</option>

                      </select>
                    </div>

                    <div class="col-md-3  form-group" >
                        <label class="form-control-label mbr-fonts-style display-7">Tanggal</label>
                        <input type="date" name="tgl" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Level</label>
                        <input type="number" name="level" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">PP-LN</label>
                        <input type="number" name="ppln" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">PP-DN</label>
                        <input type="number" name="ppdn" required="required" class="form-control input display-7" >
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Transmisi Lokal</label>
                        <input type="number" name="tl" required="required" class="form-control input display-7" >
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Lainnya</label>
                        <input type="number" name="lainnya" required="required" class="form-control input display-7" >
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Total</label>
                        <input type="number" name="total" required="required" class="form-control input display-7" >
                    </div>
                    <div class="col-md-3  form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Dirawat</label>
                        <input type="number" name="dirawat" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Sembuh</label>
                        <input type="number" name="sembuh" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Meninggal</label>
                        <input type="number" name="meninggal" required="required" class="form-control input display-7">
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="form-control-label mbr-fonts-style display-7">Total Positif</label>
                        <input type="number" name="jml_positif" required="required" class="form-control input display-7">
                    </div>
                    
                    <div class="form-group" align="center" >
                        <input type="submit" class="btn btn-success" value="SIMPAN" >
                        
                    </div>
                </div>
            </form><!---Formbuilder Form--->
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  
  <script>
  $(function () {
    $('#id_kabupaten').on('change', function () {
        axios.post('{{ route('tambahdata.getKecamatan') }}', {id_kabupaten: $(this).val()})
            .then(function (response) {
                $('#id_kecamatan').empty();

                $.each(response.data, function (id_kecamatan, nama_kecamatan) {
                    $('#id_kecamatan').append('<option value=' + id_kecamatan + '>' + nama_kecamatan + '</option>');
                })
                console.log(response);
            });
    });

    $('#id_kecamatan').on('change', function () {
        axios.post('{{ route('tambahdatakel.getKelurahan') }}', {id_kecamatan: $(this).val()})
            .then(function (response) {
                $('#id_kelurahan').empty();

                $.each(response.data, function (id_kelurahan, nama_kelurahan) {
                    $('#id_kelurahan').append(new Option(nama_kelurahan, id_kelurahan))
                })
            });
    });
    
});
</script>
  
</body>
</html>
