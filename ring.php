<?php
include "cons2.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
  {
  try{
    if (isset($_POST['update'])) {          
      $dataRingUpdate = array(
          'id_ring' => $_POST['id_ring'],
          'kd_ring' => $_POST['kd_ring'],
          'nama' => $_POST['nama'],
      );
      $query = $pdo->prepare("UPDATE ring SET kd_ring=:kd_ring, nama=:nama WHERE (id_ring = :id_ring) ");  
      $query->execute($dataRingUpdate);

      echo "Data Rekening telah diupdate";

    }elseif (isset($_POST['delete'])) {
      $id_ring = (string)$_POST['id_ring_del'];
      $query1 = $pdo->prepare("DELETE kr FROM komponen_ring kr JOIN ring r ON kr.`kd_ring`=r.`kd_ring` WHERE r.`id_ring` = '".$id_ring."'");                          
      $query1->execute();

      $query2 = $pdo->prepare("DELETE FROM ring WHERE id_ring = '".$id_ring."'");
      $query2->execute();

      echo "Data Rekening telah dihapus";
    }
  }catch(PDOException $e){
      echo "Error! gagal menyimpan data rekening:".$e->getMessage();  
  }
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KORMI | Dashboard</title>

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
      <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Kode Ring</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Kode Rekening</th>
                    <th>Uraian</th>
                    <th>Tombol Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    include("cons2.php");
                    $query = $pdo->prepare("SELECT * FROM ring ");
                    $query->execute();
                    ?>
                    <?php $i = 1;?>
                    <?php while($ring = $query->fetch()){?>
                    <?php $i++; ?>
                    <tr>
                      <td><?php echo $ring['kd_ring']?></td>
                      <td><?php echo $ring['nama']?></td>
                      <td>   
                        <input type="hidden" name="kd_ring_i" id=<?php echo "kd_ring".$i ?> value="<?php echo $ring['kd_ring']?>" >	
                        <input type="hidden" name="id_ring_i" id=<?php echo "id_ring".$i ?> value="<?php echo $ring['id_ring']?>" >	
                        <input type="hidden" name="nama_i" id=<?php echo "nama".$i ?> value="<?php echo $ring['nama']?>" >			
                        <div class="row">
                          <div class="col-2">
                            <input data-toggle="modal" data-target="#modalEdit" type="button" class="btn btn-success" name="edit"  value="Edit"  onclick="change(<?php echo $i ?>)"> 
                          </div>
                          <div class="col">
                            <form method="post"> 
                              <input type="hidden" id="id_ring_del" name="id_ring_del" value="<?php echo $ring['id_ring']?>"> 
                              <button type="submit" class="btn btn-danger" name="delete" value="delete" >Delete</button>
                            </form>
                          </div>
                        </div>

                          
                                           
                      </td> 
                    </tr>
                  <?php }?>  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Kode Rekening</th>
                    <th>Uraian</th>
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
  <!-- /.content-wrapper -->
  <!-- form edit -->
  
  <div class="modal fade" id="modalEdit" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
        <form class="form-horizontal" method="post">
          <div class="form-group">
            <!-- <label class="col-sm-2 control-label">Kode rekening</label>
            <input type="hidden" id="id_ring" name="id_ring" class="form-control" autocomplete="off" value="">
            <div class="col-sm-10">
                <input type="text" id="kd_ring" name="kd_ring" class="form-control" autocomplete="off" value="">
            </div> -->
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Uraian</label>
            <div class="col-sm-10"> 
                <input type="text" id="nama" name="nama" class="form-control" size="50" autocomplete="off" value="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-primary" name="update" value="update">Update DPA</button>
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
    var nama_i = document.getElementById("nama"+$i);
    var nama = document.getElementById("nama");
		nama.value = nama_i.value;

    var kd_ring_i = document.getElementById("kd_ring"+$i);
    var kd_ring = document.getElementById("kd_ring");
		kd_ring.value = kd_ring_i.value;

    var id_ring_i = document.getElementById("id_ring"+$i);
    var id_ring = document.getElementById("id_ring");
		id_ring.value = id_ring_i.value;

	};
</script>
</body>
</html>
