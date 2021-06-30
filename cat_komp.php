<?php
include "cons2.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
try{
    $query = $pdo->prepare("INSERT INTO komponen_ring VALUES(0,:kd_komponen,:kd_ring)");
    $dataKomponen = array(
        ':kd_komponen' => $_POST['kd_komponen'],
        ':kd_ring' => $_POST['kd_ring'],
    );
    $query->execute($dataKomponen);
    echo "Data Komponen telah disimpan";
}catch(PDOException $e){
    echo "Error! gagal menyimpan data komponen:".$e->getMessage();  
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
            <h1>Kategori Komponen</h1>
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
      <label class="col-sm-2 control-label">Komponen</label>
      <div class="col-sm-10">
          <select name="kd_komponen" class="form-control">
          <?php
            include("cons2.php");
            $query = $pdo->prepare("SELECT k.`kd_komponen`,k.`nama`,k.`spec` FROM komponen k LEFT JOIN komponen_ring kr ON k.`kd_komponen`=kr.`kd_komponen` WHERE kr.`kd_komponen` IS NULL");
            $query->execute();
          ?>
          <?php while($komponen = $query->fetch()){?>
            <option value="<?php echo $komponen['kd_komponen']?>"><?php echo $komponen['nama']?> <?php echo $komponen['spec']?></option>
            <?php }?>
          </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Kode Ring</label>
      <div class="col-sm-10">
          <select name="kd_ring" class="form-control">
          <?php
            include("cons2.php");
            $query = $pdo->prepare("SELECT * FROM ring WHERE LENGTH(kd_ring)>6");
            $query->execute();
          ?>
          <?php while($ring = $query->fetch()){?>
            <option value="<?php echo $ring['kd_ring']?>"><?php echo $ring['kd_ring']?> <?php echo $ring['nama']?></option>
            <?php }?>
          </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Masukan Komponen</button>
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
