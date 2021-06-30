<?php
include "cons.php";
include "session.php";
if ($jns_user !== '99') {
  echo "Anda tidak dapat mengakses halaman ini, harap hubungi administrator <br>";
}
else {
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$tanggal = $_POST['tanggal'];
$date = DateTime::createFromFormat('m/d/Y',$tanggal);
$dbdate = $date->format("Y-m-d");
try{
    $query = $pdo->prepare("INSERT INTO blasting VALUES(0,:kd_user,:tanggal1,:jam,:lubangblasting,:detanator,:primer,:anfo,:k75,:l75, :andesit, :besi)");
    $query1 = $pdo->prepare("update inventory set banyaknya = banyaknya - :banyaknya where kd_inventory = 2");
    $query2 = $pdo->prepare("update inventory set banyaknya = banyaknya - :banyaknya where kd_inventory = 3");
    $query3 = $pdo->prepare("update inventory set banyaknya = banyaknya - :banyaknya where kd_inventory = 4");
    $dataBlasting = array(
        ':kd_user' => $kd_season,
        ':tanggal1' => $dbdate,
        ':jam' => $_POST['jam'],
        ':lubangblasting' => $_POST['lubangblasting'],
        ':detanator' => $_POST['detanator'],
        ':primer' => $_POST['primer'],
        ':anfo' => $_POST['anfo'],
        ':k75' => $_POST['k75'],
        ':l75' => $_POST['l75'],
        ':andesit' => $_POST['andesit'],
        ':besi' => $_POST['besi'],
    );
    $datadetonator = array(
        ':banyaknya' => $_POST['detanator']
    );
    $dataprimer = array(
        ':banyaknya' => $_POST['primer']
    );
    $dataanfo = array(
        ':banyaknya' => $_POST['anfo']
    );
    $query->execute($dataBlasting);
    $query1->execute($datadetonator);
    $query2->execute($dataprimer);
    $query3->execute($dataanfo);
    echo "Data Blasting telah disimpan";
}catch(PDOException $e){
    echo "Error! gagal menyimpan data Blasting:".$e->getMessage();  
}
}
?> 

  <html>
  <head>
    <title>Admins</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>
            <!--logo start-->
            <a href="#" class="logo">Aplikasi Manajemen Tambang Bagian Admin</a>
            <!--logo end-->
            <div class="top-nav notification-row">                
                <ul class="nav pull-right top-menu">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username">Selamat Datang <?php echo $login_session; ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li>
                                <a href="logout.php"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
      </header>      
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
                  <li class="active">
                      <a class="" href="index.php">
                          <i class="icon_house_alt"></i>
                          <span>Halaman Utama</span>
                      </a>
                  </li>
                  <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <i class="icon_datareport"></i>
                            <span class="username">Lihat Data</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li>
                                <a href="tabel_cuaca.php">Cuaca</a>
                            </li>
                            <li>
                                <a href="tabel_barang.php">Produk</a>
                            </li>
                            <li>
                                <a href="tabel_blasting.php">Blasting</a>
                            </li>
                            <li>
                                <a href="tabel_historyexc.php">Eskavator</a>
                            </li>
                            <li>
                                <a href="tabel_historykendaraan.php">Kendaraan</a>
                            </li>
                            <li>
                                <a href="tabel_mesin.php">Mesin</a>
                            </li>
                            <li>
                                <a href="tabel_inventory.php">Inventory</a>
                            </li>
                            <li>
                                <a href="tabel_stockpile.php">Stock Pile</a>
                            </li>
                        </ul>
                    </li>
                  <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <i class="icon_plus-box"></i>
                            <span class="username">Buat Laporan</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li>
                                <a href="tambah_cuaca.php">Cuaca</a>
                            </li>
                            <li>
                                <a href="tambah_blasting.php">Blasting</a>
                            </li>
                            <li>
                                <a href="tambah_mencatatexc.php">Eskavator</a>
                            </li>
                            <li>
                                <a href="tambah_mencatatkendaraan.php">Kendaraan</a>
                            </li>
                            <li>
                                <a href="tambah_mesin.php">Output Mesin</a>
                            </li>
                        </ul>
                    </li>
                  <li class="">
                      <a class="" href="logout.php">
                          <i class="icon_key"></i>
                          <span>Logout</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
           <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
        <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-user"></i><p>Welcome <?php echo $login_session; ?><p></h3>
        </div>
                          </div>    
          </section>
        <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Form Tambah Blasting
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal" method="post">
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Tanggal</label>
                                      <div class="col-sm-10">
                                          <input type="text" id="datepicker" name="tanggal" class="form-control" autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Jam</label>
                                      <div class="col-sm-10">
                                          <select name="jam" class="form-control">
                                            <option value="1">08:00-10:00</option>
                                            <option value="2">10:00-12:00</option>
                                            <option value="3">13:00-15:00</option>
                                            <option value="4">15:00-17:00</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Banyaknya Lubang Blasting</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="lubangblasting" class="form-control" autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Detonator</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="detanator" class="form-control" autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Primer</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="primer" class="form-control" autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Anfo</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="anfo" class="form-control" autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Bolder Kurang Dari 75 CM</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="k75" class="form-control" autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Bolder Lebih Dari 75 CM</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="l75" class="form-control" autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Lubang target peledakan andesit</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="andesit" class="form-control" autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Lubang target peledakan beji besi</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="besi" class="form-control" autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-primary">Tambah Blasting</button>
                                          <button type="reset" class="btn btn-primary">Reset</button>
                                      </div>
                                  </div>
                              </form>                              
                          </div>
                      </section>
                  </div>
              </div>
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->


    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <!-- jQuery full calendar -->
    <<script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
	<script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
	<script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js" ></script>
	<script src="assets/chart-master/Chart.js"></script>
   
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
	<script src="js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="js/xcharts.min.js"></script>
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/jquery.placeholder.min.js"></script>
	<script src="js/gdp-data.js"></script>	
	<script src="js/morris.min.js"></script>
	<script src="js/sparklines.js"></script>	
	<script src="js/charts.js"></script>
	<script src="js/jquery.slimscroll.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});

  </script>

  </body>
</html>
<?php } ?>