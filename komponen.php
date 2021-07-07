<?php
include "cons2.php";
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
  try{
    if (isset($_POST['update'])) {        
      $dataKomponenUpdate = array(
          'kd_komponen' => $_POST['kd_komponen'],
          'nama' => $_POST['nama'],
          'spec' => $_POST['spec'],
          'satuan' => $_POST['satuan'],
          'harga' => $_POST['harga'],
      );
      $query = $pdo->prepare("UPDATE komponen SET nama=:nama, spec=:spec, satuan=:satuan, harga=:harga WHERE (kd_komponen = :kd_komponen) ");  
      $query->execute($dataKomponenUpdate);
      echo "Data Komponen telah diupdate";
    }elseif (isset($_POST['delete'])) {
      $kd_komponen = $_POST['kd_komponen_del'];  
      $query = $pdo->prepare("SELECT kr.`kd_ring` FROM komponen_ring kr JOIN komponen k ON kr.`kd_komponen`=k.`kd_komponen` JOIN ring r ON kr.`kd_ring`=r.`kd_ring` 
                              WHERE k.`kd_komponen` = ".$kd_komponen);                          
      $query->execute();
      while($komponen = $query->fetch()){
        $kd_ring = $komponen['kd_ring'];
      };
      $query1 = $pdo->prepare("DELETE kr FROM komponen_ring kr JOIN komponen k ON kr.`kd_komponen`=k.`kd_komponen` JOIN ring r ON kr.`kd_ring`=r.`kd_ring` WHERE k.`kd_komponen` = ".$kd_komponen);
      $query1->execute();

      $query2 = $pdo->prepare("DELETE FROM komponen WHERE kd_komponen =".$kd_komponen);
      $query2->execute();

      //$query3 = $pdo->prepare("DELETE FROM ring WHERE kd_ring = \'".$kd_ring."\'");
      //$query3->execute();

      echo "Data Komponen telah dihapus";
    }
  }catch(PDOException $e){
      echo "Error! gagal menyimpan data komponen:".$e->getMessage();  
  }
}

?>
<?php

include "cons2.php";
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KORMI | DASHBOARD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini dark-mode">  
    <!-- Main content -->
    <section class="content">
    <form class="form-horizontal" method="post">
      <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Komponen</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Kode Ring</th>
                    <th>Komponen</th>
                    <th>Spesifikasi</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Tombol Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    include("cons2.php");
                    $query = $pdo->prepare("SELECT k.`kd_komponen`,k.`nama`,k.`spec`,r.`kd_ring`,k.`satuan`,k.`harga` FROM komponen_ring kr INNER JOIN komponen k ON kr.`kd_komponen`=k.`kd_komponen` INNER JOIN ring r ON kr.`kd_ring`=r.`kd_ring`");
                    $query->execute();
                    ?>
                    <?php $i=1;
                          $id='';
                    ?>
                    <?php while($komponen = $query->fetch()){?>
                    <?php $i++; ?>
                    <tr>                    
                      <td><?php echo $komponen['kd_ring']?></td>
                      <td><?php echo $komponen['nama']?></td>
                      <td><?php echo $komponen['spec']?></td>
                      <td><?php echo $komponen['satuan']?></td>
                      <td><?php echo $komponen['harga']?></td>
                      <td>   
                        <input type="hidden" name="kd_komponen_i" id=<?php echo "kd_komponen".$i ?> value="<?php echo $komponen['kd_komponen']?>" >	
                        <input type="hidden" name="nama+_i" id=<?php echo "nama".$i ?> value="<?php echo $komponen['nama']?>" >		
                        <input type="hidden" name="spec_i" id=<?php echo "spec".$i ?> value="<?php echo $komponen['spec']?>" >	
                        <input type="hidden" name="harga_i" id=<?php echo "harga".$i ?> value="<?php echo $komponen['harga']?>" >		
                        <input type="hidden" name="satuan_i" id=<?php echo "satuan".$i ?> value="<?php echo $komponen['satuan']?>" >															                                             
                        <div class="row">
                          <div class="col-5">
                            <input data-toggle="modal" data-target="#modalEdit" type="button" class="btn btn-success" name="edit"  value="Edit" onclick="change(<?php echo $i ?>)">
                          </div>
                          <div class="col">
                            <form method="post"> 
                              <input type="hidden" id="kd_komponen_del" name="kd_komponen_del" value="<?php echo $komponen['kd_komponen']?>"> 
                              <button type="submit" class="btn btn-danger" name="delete" value="delete" onclick="changeDel(<?php echo $i ?>)">Delete</button>
                            </form> 
                          </div>
                        </div>
                        
                      </td>                
                    </tr>
                  <?php }?>  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Kode Ring</th>
                    <th>Komponen</th>
                    <th>Spesifikasi</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Tombol Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  </form>
  <!-- /.content-wrapper -->
  <!-- form edit -->

  <div class="modal fade" id="modalEdit" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
        <form class="form-horizontal" method="post">
          <div class="form-group">
            <label class="col-sm-10 control-label">Nama Komponen</label>
            <input type="hidden" id="kd_komponen" name="kd_komponen" value="">
            <div class="col-sm-10">
                <input type="text" id="nama" name="nama" class="form-control" size="50" autocomplete="off" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-10 control-label">Spek Komponen</label>
            <div class="col-sm-10">
                <input type="text" id="spec" name="spec" class="form-control" size="50" autocomplete="off" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-10 control-label">Satuan Komponen</label>
            <div class="col-sm-10">
                <input type="text" id="satuan" name="satuan" class="form-control" size="50" autocomplete="off" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-10 control-label">Harga Satuan</label>
            <div class="col-sm-10">
                <input type="text" id="harga" name="harga" class="form-control" size="100" autocomplete="off" value="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary" name="update" value="update">Update Komponen</button>
                <button type="reset" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>  
        </div>
      </div>
    </div>
  </div>


  <form class="form-horizontal" method="post">
  
</form>  
  <!-- /.form edit -->                
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
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  function change($i) 
	{
    var kd_komponen_i = document.getElementById("kd_komponen"+$i);
    var kd_komponen = document.getElementById("kd_komponen");
		kd_komponen.value = kd_komponen_i.value;

    var nama_i = document.getElementById("nama"+$i);
    var nama = document.getElementById("nama");
		nama.value = nama_i.value;

    var spec_i = document.getElementById("spec"+$i);
    var spec = document.getElementById("spec");
		spec.value = spec_i.value;

    var satuan_i = document.getElementById("satuan"+$i);
    var satuan = document.getElementById("satuan");
		satuan.value = satuan_i.value;

    var harga_i = document.getElementById("harga"+$i);
    var harga = document.getElementById("harga");
		harga.value = harga_i.value;
	};

  function changeDel($i) 
	{
    var kd_komponen_i = document.getElementById("kd_komponen"+$i);
    var kd_komponen = document.getElementById("kd_komponen");
		kd_komponen.value = kd_komponen_i.value;
	};
</script>
</body>
</html>



