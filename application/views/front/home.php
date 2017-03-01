<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $this->config->item('site');?></title>
        <link href="<?php echo base_url('assets/front/img/logo.png');?>" rel="SHORTCUT ICON" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Perpustakaan Berbasis Web">
        <meta name="keywords" content="Perpustakaan, perpus, online, website">
        <meta name="author" content="Wahyu"/>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url('assets/front/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url('assets/front/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/front/css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo base_url('assets/front/css/jvectormap/jquery-jvectormap-1.2.2.css');?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/front/css/style.css');?>" rel="stylesheet" type="text/css" />
        <!-- Table style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <script type="text/javascript">
        // 1 detik = 1000
            window.setTimeout("waktu()",1000);  
            function waktu() {   
              var tanggal = new Date();  
              setTimeout("waktu()",1000);  
              document.getElementById("output").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
            }
            </script>
            <script language="JavaScript">
            var tanggallengkap = new String();
            var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
            namahari = namahari.split(" ");
            var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
            namabulan = namabulan.split(" ");
            var tgl = new Date();
            var hari = tgl.getDay();
            var tanggal = tgl.getDate();
            var bulan = tgl.getMonth();
            var tahun = tgl.getFullYear();
            tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;

              var popupWindow = null;
              function centeredPopup(url,winName,w,h,scroll){
              LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
              TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
              settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
              popupWindow = window.open(url,winName,settings)
            }
        </script>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo site_url('home');?>" class="logo">
                <b><script language="javascript">document.write(tanggallengkap);</script></b> - 
                <b id="output" class="jam" ></b> WIB
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu" style="text-align:right">
                            <a href="<?php echo site_url('login');?>" data-placement="bottom" data-toggle="tooltip" title="Login Admin">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
          <aside>
            <!-- Main content -->
              <section class="content">
                <!-- Main row -->
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom:20px">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                  <img src="<?php echo base_url('assets/front/img/banner_1.jpg');?>" width="100%" style="height:200px" alt="">  
                                </div>
                                <div class="item">
                                  <img src="<?php echo base_url('assets/front/img/banner.jpg');?>" width="100%" style="height:200px" alt="">  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <!--<marquee behavior="alternate" direction="left" onmouseover="this.stop();" onmouseout="this.start();">-->
                          <b>Selamat Datang di <?php echo $this->config->item('site');?>, Untuk Login Admin silahkan klik Icon User atau klik <a href="<?php echo site_url('login');?>">disini</a></b>
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                        <section class="panel">
                            <header class="panel-heading">
                                <b>Kategori Buku</b>
                            </header>
                            <div class="panel-body">
                                <div class="twt-area">
                                    <ol style="margin-left:-10px;">
                                    <?php
                                    foreach ($dt_kategori as $kat)
                                    { ?>
                                        <a href="<?php echo site_url('home/view?id='.$kat->id_kategori.'&search=kategori&index');?>"><li><?php echo $kat->kategori;?></li></a>
                                    <?php } ?>
                                    </ol>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-8">
                        <section class="panel">
                            <header class="panel-heading">
                              <b>Data Buku</b>
                            </header>
                            <div class="panel-body table-responsive">
                                <table class="table table-hover" id="mytable">
                                  <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Kategori</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $start = 0;
                                    foreach ($dt_buku as $buku)
                                    { ?>
                                      <tr>
                                        <td><?php echo $buku->judul ?></td>
                                        <td><?php echo $buku->pengarang ?></td>
                                        <td><?php echo $buku->penerbit ?></td>
                                        <td><?php echo $buku->thn_terbit ?></td>
                                        <td><?php echo $buku->kategori ?></td>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                            </div>
                          </section>

                    
          </div><!--end col-6 -->

        </div>
      </section>
                  
          </div>
              <!-- row end -->
                <!-- /.content -->
                <div class="footer-main">
                    Copyright &copy 2016. All right reserved <a href="<?php echo site_url('home');?>" target="_self"><?php echo $this->config->item("site");?></a>.
                </div>
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->
      
        <!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url('assets/front/js/jquery.min.js');?>" type="text/javascript"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo base_url('assets/front/js/jquery-ui-1.10.3.min.js');?>" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url('assets/front/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <!--Data Table-->
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                    $("#mytable").dataTable();
            });
            $(function() {
                "use strict";
                //BAR CHART
                var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [65, 59, 80, 81, 56, 55, 40]
                        },
                        {
                            label: "My Second dataset",
                            fillColor: "rgba(151,187,205,0.2)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: [28, 48, 40, 19, 86, 27, 90]
                        }
                    ]
                };
            });
        </script>
    </body>
</html>