<?php
include "cons2.php";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
try{
  if (isset($_POST['update'])) {        
    $dataDPAUpdate = array(
        'kd_dpa' => $_POST['kd_dpa'],
        'program' => $_POST['program'],
        'jumlah' => $_POST['jumlah'],
        'year' => $_POST['year'],
    );
    $query = $pdo->prepare("UPDATE dpa SET program=:program, jumlah=:jumlah, year=:year WHERE (kd_dpa = :kd_dpa) ");  
    $query->execute($dataDPAUpdate);
    echo "Data DPA telah diupdate";
  }
}catch(PDOException $e){
    echo "Error! gagal menyimpan data DPA:".$e->getMessage();  
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
                <h3 class="card-title">Data DPA</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Detail Program</th>
                    <th>Jumlah Anggaran</th>
                    <th>Tahun Anggaran</th>
                    <th>Tombol Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    include("cons2.php");
                    $query = $pdo->prepare("SELECT d.`kd_dpa`,d.`program`,CONCAT('Rp ',fRupiah(d.`jumlah`)) AS rupiah,d.`year`,d.`jumlah` FROM dpa d");
                    $query->execute();
                    ?>
                    <?php $i = 1?>
                    <?php while($ring = $query->fetch()){
                    $i++;
                    ?>
                    <tr>
                      <td><?php echo $ring['program']?></td>
                      <td><?php echo $ring['rupiah']?></td>
                      <td><?php echo $ring['year']?></td>
                      <td>   
                        <input type="hidden" name="kd_dpa_i" id=<?php echo "kd_dpa".$i ?> value="<?php echo $ring['kd_dpa']?>" >	
                        <input type="hidden" name="program_i" id=<?php echo "program".$i ?> value="<?php echo $ring['program']?>" >		
                        <input type="hidden" name="jumlah_i" id=<?php echo "jumlah".$i ?> value="<?php echo $ring['jumlah']?>" >	
                        <input type="hidden" name="year_i" id=<?php echo "year".$i ?> value="<?php echo $ring['year']?>" >
                        <input data-toggle="modal" data-target="#modalEdit" type="button" class="btn btn-success" name="edit"  value="Edit" onclick="change(<?php echo $i ?>)">                     
                      </td>  
                    </tr>
                  <?php }?>  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Detail Program</th>
                    <th>Jumlah Anggaran</th>
                    <th>Tahun Anggaran</th>
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
            <label class="col-sm-10 control-label">Detail Program</label>
            <input type="hidden" id="kd_dpa" name="kd_dpa" value="">
            <div class="col-sm-10">
                <input type="text" id="program" name="program" class="form-control" autocomplete="off" value="">
            </div>
          </div>
          <div class="form-group" >
            <label class="col-sm-10 control-label">Jumlah Anggaran</label>
            <div class="row">
              <div class="input-group-prepend col-sm-2">
                  <div class="input-group-text" style="background-color:gray; margin-left:5px;">Rp</div>
              </div>
              <div class="col">
                <input type="text" id="jumlah" name="jumlah" class="form-control" autocomplete="off" value="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-10 control-label">Tahun Anggaran</label>
            <div class="col-sm-10">
                <input type="text" id="year" name="year" class="form-control" autocomplete="off" value="">
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
    var kd_dpa_i = document.getElementById("kd_dpa"+$i);
    var kd_dpa = document.getElementById("kd_dpa");
		kd_dpa.value = kd_dpa_i.value;

    var program_i = document.getElementById("program"+$i);
    var program = document.getElementById("program");
		program.value = program_i.value;

    var jumlah_i = document.getElementById("jumlah"+$i);
    var jumlah = document.getElementById("jumlah");
		jumlah.value = jumlah_i.value;

    var year_i = document.getElementById("year"+$i);
    var year = document.getElementById("year");
		year.value = year_i.value;

	};

</script>
</body>
</html>
