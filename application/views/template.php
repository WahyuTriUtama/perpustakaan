<!DOCTYPE html>
<html lang="en">
<!-- head -->
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
    <meta name='description' content="-" />
    <meta name='keywords' content="" />
    <meta name='robots' content='index,follow' />
    <title><?php echo $title;?> - <?php echo $this->config->item('site');?></title>
    <link href="<?php echo base_url('assets/front/img/logo.png');?>" rel="SHORTCUT ICON" />
    <!-- themes style -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/load-style.css');?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/datetimepicker/bootstrap-datetimepicker.min.css');?>" media="all" />
    <!-- other style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/chosen.css') ?>"/>
</head>
<!-- body -->
<body>
    <!-- layout -->
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('admin');?>"><?php echo $this->config->item('site');?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                    <!-- dropdown -->
                    <li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-transform: capitalize;">
                            <?php echo $user->username;?> | <?php echo $user->level;?>
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo site_url('user/read/'.$user->id_user);?>"><i class="fa fa-user fa-fw"></i> <?php echo $user->username;?></a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('admin/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="spacer">&nbsp;</li>
                            <li><a class="" href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Dashboard</a></li>
                            <li><a  href="#"><i class="fa fa-retweet"></i>&nbsp;&nbsp;Transaksi Buku<span class="fa arrow"></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo site_url('pinjam');?>"  title="Peminjaman Buku">Peminjaman Buku</a></li>
                                    <li><a href="<?php echo site_url('pengembalian');?>"  title="Pengembalian Buku">Pengembalian Buku</a></li>
                                </ul>
                            </li>
                            <li><a  href="<?php echo site_url('anggota');?>"><i class="fa fa-users"></i>&nbsp;&nbsp;Data Anggota</a></li>
                            <li><a  href="#"><i class="fa fa-database"></i>&nbsp;&nbsp;Data Master<span class="fa arrow"></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo site_url('buku');?>"  title="Buku">Buku</a></li>
                                    <li><a href="<?php echo site_url('kategori');?>"  title="Kategori Buku">Kategori Buku</a></li>
                                    <li><a href="<?php echo site_url('penerbit');?>"  title="Penerbit">Penerbit</a></li>
                                    <li><a href="<?php echo site_url('pengarang');?>"  title="Pengarang">Pengarang</a></li>
                                    <?php if ($this->session->userdata('level') == 'admin') { ?>
                                    <li><a href="<?php echo site_url('kelas');?>"  title="Pengarang">Kelas</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php if ($this->session->userdata('level') == 'admin') { ?>
                            <li><a  href="#"><i class="fa fa-wrench"></i>&nbsp;&nbsp;Pengaturan<span class="fa arrow"></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="<?php echo site_url('user');?>"  title="User Account">User Account</a></li>
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>                    
                    </div>
                </div>
            </nav>
            <div id="page-wrapper">
                <?php $this->load->view($content);?>           
            </div>
            <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<!-- end of layout	-->
    <!-- load javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery/jquery.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/bootstrap/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/metismenu/metisMenu.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/custom.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/moment/moment.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/datetimepicker/bootstrap-datetimepicker.min.js');?>"></script>
    <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/chosen.jquery.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/keyup.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
                $("#mytable").dataTable();
                // dropdown menu
                $(".parent").click(function () {
                    $(this).toggleClass('down');
                    $(this).siblings().slideToggle(100);
                    return false;
                });
                $("#chosen").chosen();
                $("#chosen1").chosen();
                $("#chosen2").chosen();
                $("#chosen3").chosen();
                $("#key").capitalize();
                $("#key1").capitalize();
            });
    </script>
</body>
<!-- end body -->
</html>

