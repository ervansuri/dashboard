<?php
include "cons2.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KORMI| DASHBOARD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Print Report DPA</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- form section start -->
  <form class="form-horizontal" method="post">
    <div class="form-group">
      <label class="col-sm-2 control-label">Pilih DPA</label>
      <div class="col-sm-10">
          <select id='p_ring' name="p_ring" class="form-control">
          <?php
            include("cons2.php");
            $query = $pdo->prepare("SELECT * FROM dpa");
            $query->execute();
            $k=1;
          ?>
          <?php while($dpa = $query->fetch()){
            $k++;
          ?>
            <option value="<?php $dpa['kd_dpa']?>"> <?php echo $dpa['year']?> <?php echo $dpa['program']?></option>       
            <?php }?>
          </select>
      </div>
    </div>
    <div class="form-group">
    <input type="hidden" name="kd_dpa" id="kd_dpa" value="" >
      <div class="col-lg-offset-2 col-lg-10">          
          <?php $query = $pdo->prepare("SELECT rka.kd_wk, rka.qty, rka.kegiatan, d.program, d.jumlah, d.year, kmp.nama, kmp.spec, kmp.harga, kmp.satuan FROM wk rka INNER JOIN dpa d ON d.kd_dpa = rka.kd_dpa INNER JOIN komponen kmp ON kmp.kd_komponen = rka.kd_komponen");
                    $query->execute(); 
                    $i=1;?>
           <?php while($ring = $query->fetch()){
             $i++;
            ?>
            <input type="hidden" name="program_i" id=<?php echo "program".$i ?> value="<?php echo $ring['program']?>" >
            <input type="hidden" name="kegiatan_i" id=<?php echo "kegiatan".$i ?> value="<?php echo $ring['kegiatan']?>" >
            <input type="hidden" name="nama_i" id=<?php echo "nama".$i ?> value="<?php echo $ring['nama']?>" >
            <input type="hidden" name="qty_i" id=<?php echo "qty".$i ?> value="<?php echo $ring['qty']?>" >
            <input type="hidden" name="jumlah_i" id=<?php echo "jumlah".$i ?> value="<?php echo $ring['jumlah']?>" >
            <input type="hidden" name="harga_i" id=<?php echo "harga".$i ?> value="<?php echo $ring['harga']?>" >
            <input type="button" class="btn btn-primary" name="Print DPA" value="Edit" onclick="change(<?php echo $i ?>)"> 
           <?php } ?>              
          
      </div>
    </div>
  </form>
  <!-- form section end -->
  <!-- /.content-wrapper -->
  <div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <img src="../../dist/img/icon.jpg" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
          <small class="float-right">Date: 22/05/2021</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->

    <table border="1" align="center">
      <tr>
        <td colspan="5" align="center">DOKUMEN PELAKSAAN ANGGARAN SATUAN KERJA PERANGKAT DAERAH</td>
        <td rowspan="2" colspan="2" align="center">Formulir DPA-RINCIAN BELANJA SKPD</td>
      </tr>
      <tr>
        <td colspan="5" align="center">Pemerintahan Provinsi Jawa Barat Tahun Anggaran 2021</td>
      </tr>
      <tr>
        <td>DPA</td>
        <td>:</td>
        <td colspan="5"> <input style="background:transparent; border:transparent; color:white;" id="program" value='' readonly></input></td>
      </tr>
      <tr>
        <td>Nama Barang</td>
        <td>:</td>
        <td colspan="5"><input style="background:transparent; border:transparent; color:white;" id="nama" value='' readonly></td>
      </tr>
      <tr>
        <td>Kuantitas</td>
        <td>:</td>
        <td colspan="5"><input style="background:transparent; border:transparent; color:white;" id="qty" value='' readonly></td>
      </tr>
      <tr>
        <td>Banyak Kegiatan</td>
        <td>:</td>
        <td colspan="5"><input style="background:transparent; border:transparent; color:white;" id="kegiatan" value='' readonly></td>
      </tr>
      <tr>
        <td>Harga</td>
        <td>:</td>
        <td colspan="5"><input style="background:transparent; border:transparent; color:white;" id="harga" value='' readonly></td>
      </tr>

    </table>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>          
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});

function change($i) 
	{
    var check = $('#p_ring').find(":selected").text();
    var kd_dpa = document.getElementById("kd_dpa");
    kd_dpa.value = check;

    var program_i = document.getElementById("program"+$i);
    var program = document.getElementById("program");
		program.value = program_i.value;

    var nama_i = document.getElementById("nama"+$i);
    var nama = document.getElementById("nama");
		nama.value = nama_i.value;

    var qty_i = document.getElementById("qty"+$i);
    var qty = document.getElementById("qty");
		qty.value = qty_i.value; 

    var kegiatan_i = document.getElementById("kegiatan"+$i);
    var kegiatan = document.getElementById("kegiatan");
		kegiatan.value = kegiatan_i.value;

    var harga_i = document.getElementById("harga"+$i);
    var harga = document.getElementById("harga");
		harga.value = harga_i.value;
	};
</script>
</body>
</html>
