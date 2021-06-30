<?php
include "cons2.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
try{
    $query = $pdo->prepare("INSERT INTO komponen VALUES(0,:nama,:spec,:satuan,:harga)");
    $dataKomponen = array(
        ':nama' => $_POST['nama'],
        ':spec' => $_POST['spec'],
        ':satuan' => $_POST['satuan'],
        ':harga' => $_POST['harga'],
    );
    $query->execute($dataKomponen);
    #$kd_komponen1 = lastInsertId($query);
   # $datakomponenring = array(
  #    ':kd_komponen1' => $kd_komponen1,
  #    ':kd_ring' => $_POST['kd_ring'],
  #  );
  #  $query2 = $pdo->prepare("INSERT INTO komponen_ring VALUES (0,:kd_komponen1,:kd_ring)");
 #   $query2->execute($datakomponenring);
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
            <h1>Insert Komponen</h1>
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
      <label class="col-sm-2 control-label">Nama Komponen</label>
      <div class="col-sm-10">
          <input type="text" name="nama" class="form-control" autocomplete="off">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Spek Komponen</label>
      <div class="col-sm-10">
          <input type="text" name="spec" class="form-control" autocomplete="off">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Satuan Komponen</label>
      <div class="col-sm-10">
          <input type="text" name="satuan" class="form-control" autocomplete="off">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Harga Satuan</label>
      <div class="col-sm-10">
          <input type="text" name="harga" class="form-control" autocomplete="off">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Tambah Komponen</button>
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
