<?php
include "cons2.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
try{

    foreach ($_POST['kd_komponen'] as $row)
    {
      if ($_POST['qty'][$row] == NULL) continue;
      if ($_POST['kegiatan'][$row] == NULL) { 
        echo "Kegiatan tidak boleh kosong pada komponen yang berkuantitas"; 
        continue;
      }
      $query = $pdo->prepare("INSERT INTO wk VALUES (0,:dpa,:uraian,'',:kmp,:qty1,:kegiatan1)");
      $datawk = array(
          ':dpa' => $_POST['dpa'],
          ':uraian' => $_POST['uraian'],
          ':kmp' => $row,
          ':qty1' => $_POST['qty'][$row],
          ':kegiatan1' => $_POST['kegiatan'][$row],
      );
      $query->execute($datawk);
    }
    echo "Data Detail RKA telah disimpan";
}catch(PDOException $e){
    echo "Error! gagal menyimpan data Detail RKA:".$e->getMessage();  
}
}
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
            <h1>Pembuatan RKA</h1>
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
      <label class="col-sm-2 control-label">Kode DPA</label>
      <div class="col-sm-10">
          <select name="dpa" class="form-control">
          <?php
            include("cons2.php");
            $query = $pdo->prepare("SELECT kd_dpa,program,CONCAT('Rp ',fRupiah(jumlah)) AS jumlah,d.`year` FROM DPA d");
            $query->execute();
          ?>
          <?php while($dpa = $query->fetch()){?>
            <option value="<?php echo $dpa['kd_dpa']?>"><?php echo $dpa['program']?> <?php echo $dpa['jumlah']?> Tahun <?php echo $dpa['year']?></option>
            <?php }?>
          </select>
      </div>
  </div>
  <div class="form-group">
      <label class="col-sm-2 control-label">Uraian</label>
      <div class="col-sm-10">
      <input type="text" name="uraian" class="form-control" autocomplete="off">
      </div>
  </div>
  <!-- fetch data db ring -->
  <?php
    include("cons2.php");
    $query1 = $pdo->prepare("SELECT * FROM ring WHERE LENGTH(kd_ring)>6");
    $query1->execute();
    while($ring = $query1->fetch()){
      $kd_ring=$ring['kd_ring'];
  ?>
  <div class="form-group">
  <?php
    include("cons2.php");
    $query2 = $pdo->prepare("SELECT k.`kd_komponen`,k.`nama`, k.`spec`,k.`satuan`,r.`kd_ring` FROM komponen k JOIN komponen_ring kr ON k.`kd_komponen`=kr.`kd_komponen` LEFT JOIN ring r ON kr.`kd_ring`=r.`kd_ring` WHERE kr.`kd_ring`='$kd_ring'");
    $query2->execute();
    if (!$query2->rowCount()) continue;
    
  ?>
  <div class="col-sm-10">
  <!-- show data tables kd_ring -->
    <label class="col-sm-10 control-label" style="font-size:30px; font-weight:bolder;"><?php echo $ring['kd_ring']?> <?php echo $ring['nama']?></label>
    
  </div>
  <!-- fetch data db komponen -->
  



  <!-- show data tables komponen -->
  <?php while($komponen = $query2->fetch()) {?>
  <label class="col-sm-105 control-label"><?php echo $komponen['nama']?> Spesifikasi <?php echo $komponen['spec']?></label>
  <input type="hidden" name="kd_komponen[<?php echo $komponen['kd_komponen']?>]" value="<?php echo $komponen['kd_komponen']?>">
  <input type="hidden" name="kd_ring[<?php echo $komponen['kd_komponen']?>]" value="<?php echo $ring['kd_ring']?>">
    <div class="col-sm-10">
      <label class="col-sm-10">Qty</label>
    <input type="text" name="qty[<?php echo $komponen['kd_komponen']?>]" class="form-control" autocomplete="off">
    <label class="col-sm-10">Kegiatan</label>
    <input type="text" name="kegiatan[<?php echo $komponen['kd_komponen']?>]" class="form-control" autocomplete="off">
    <br>
    </div>
    <?php }?>
  </div>
  <?php }?>
  <!-- <div class="form-group">
      <label class="col-sm-2 control-label">Nama Kode Rekening</label>
      <div class="col-sm-10">
  </div>
  </div> -->
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <button type="submit" class="btn btn-primary">Masukan Detail RKA</button>
        <button type="reset" class="btn btn-primary">Reset</button>
    </div>
  </div>
  </form>
  <!-- form section end -->
  <!-- /.content-wrapper -->

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
</script>
</body>
</html>