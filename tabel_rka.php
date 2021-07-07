<?php
include "cons2.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
try{
  if (isset($_POST['update'])) {        
    $wkupdate = array( 
        'kd_wk' => $_POST['kd_wk'],
        'qty' => $_POST['qty'],
        'kegiatan' => $_POST['kegiatan'],
    );
    $query = $pdo->prepare("UPDATE wk SET qty=:qty, kegiatan=:kegiatan WHERE (kd_wk = :kd_wk) ");  
    $query->execute($wkupdate);
    echo "Data Komponen telah diupdate";
  } elseif (isset($_POST['delete'])) {
    $kd_wk = $_POST['kd_wk_del'];  

    $query2 = $pdo->prepare("DELETE FROM wk WHERE kd_wk =".$kd_wk);
    $query2->execute();

    echo "Data Komponen telah dihapus";
    }
  }catch(PDOException $e){
    echo "Error! gagal menyimpan data komponen:".$e->getMessage();   
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
                <h3 class="card-title">Data RKA</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>DPA</th>
                    <th>Tahun</th>
                    <th>Nama Barang</th>
                    <th>Kuantitas</th>
                    <th>Banyak Kegiatan</th>
                    <th>Harga</th>
                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $query = $pdo->prepare("SELECT rka.kd_wk, rka.qty, rka.kegiatan, d.program, d.jumlah, d.year, kmp.nama, kmp.spec, kmp.harga, kmp.satuan FROM wk rka INNER JOIN dpa d ON d.kd_dpa = rka.kd_dpa INNER JOIN komponen kmp ON kmp.kd_komponen = rka.kd_komponen");
                    $query->execute();
                  ?>
                  <?php  
                    include("cons2.php");
                    $total = 0;

                    ?>
                    <?php $i=1;
                          $id=''; ?>
                    <?php while($ring = $query->fetch()){?>
                    <tr>
                        <?php
                         $harga = $ring['qty'] * $ring['kegiatan'] * $ring['harga'];
                         $total += $harga; ?>
                        <td><?php echo $ring['program']?></td>
                        <td><?php echo $ring['year']?></td>
                        <td id=<?php echo "nama".$i ?>><?php echo $ring['nama']?></td>
                        <td ><?php echo $ring['qty']?></td>
                        <td ><?php echo $ring['kegiatan']?></td>
                        <td>Rp. <?php echo $harga?></td>
                        <td> 
                          <input type="hidden" name="kd_wk_i" id=<?php echo "kd_wk".$i ?> value="<?php echo $ring['kd_wk']?>" >
                          <input type="hidden" id=<?php echo "qty".$i ?> value="<?php echo $ring['qty']?>"  >
                          <input type="hidden" id=<?php echo "kegiatan".$i ?> value="<?php echo $ring['kegiatan']?>" >
                          <div class="row">
                            <div class="col-3">
                              <input type="button" class="btn btn-success" name="edit" data-toggle="modal" data-target="#updateModal" value="Edit" onclick="change(<?php echo $i ?>)">
                            </div>
                            <div class="col">
                            <form method="post"> 
                              <input type="hidden" id="kd_wk_del" name="kd_wk_del" value="<?php echo $ring['kd_wk']?>"> 
                              <button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>
                            </form> 
                            </div>
                          </div>

                        </td>
                    </tr>
                  <?php $i++; }?>  
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>DPA</th>
                    <th>Tahun</th>
                    <th>Nama Barang</th>
                    <th>Kuantitas</th>
                    <th>Banyak Kegiatan</th>
                    <th>Rp. <?php echo $total?></th>
                    <th>Edit</th>
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
  <!-- class="form-horizontal"  -->

  <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form class="form-horizontal" method="post">
        <div class="modal-header">
        
          <div class="form-group">
            <label class="col-sm-5control-label" id="nama" name="nama" style="font-size:20px; font-weight:bolder;"></label>
            <input type="hidden" id="kd_wk" name="kd_wk" value="">
          </div>
        </div>
        <div class="modal-body">
            <div class="form-group">
            <label class="col-sm-10 control-label">Kuantitas</label>
            <div class="col-sm-10">
                <input type="text" id="qty" name="qty" class="form-control" autocomplete="off" value="">
            </div>
            </div>
            <div class="form-group">
            <label class="col-sm-10 control-label">Jumlah Kegiatan</label>
            <div class="col-sm-10">
                <input type="text" id="kegiatan" name="kegiatan" class="form-control" autocomplete="off" value="">
            </div>
            </div>
        </div>
        <div class="modal-footer">
        <input type="hidden" class="btn btn-primary" name="update" value="update">
          <button type="submit" class="btn btn-primary" name="update" value="update">
            Update RKA
          </button>
            <button type="reset" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      </form> 
    </div>
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
<script>
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
    var kd_wk_i = document.getElementById("kd_wk"+$i);
    var kd_wk = document.getElementById("kd_wk");
		kd_wk.value = kd_wk_i.value;

    var nama_i = document.getElementById("nama"+$i);
    var nama = document.getElementById("nama");
		nama.innerHTML = nama_i.innerHTML;

    var qty_i = document.getElementById("qty"+$i);
    var qty = document.getElementById("qty");
		qty.value = qty_i.value;

    var kegiatan_i = document.getElementById("kegiatan"+$i);
    var kegiatan = document.getElementById("kegiatan");
		kegiatan.value = kegiatan_i.value;
	};

</script>
</body>
</html>
