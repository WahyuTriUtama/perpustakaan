<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Pengaturan</a>
            </li>
            <li>
                <a href="<?php echo site_url('user');?>"><?php echo $title;?></a><span></span>
            </li>
            <li class="active">
                <strong><?php echo $button;?> Detail</strong>
            </li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <!-- notification template -->

            <!-- end of notification template-->
            <div class="box">
                <div class="box-title">
                    <h5 class="form-title"><?php echo $button;?> <?php echo $title;?></h5>
                    <div class="box-tools">
                        <a href="<?php echo site_url('user');?>" class="btn btn-info btn-outline btn-sm" type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-lg-6">

                            <table class="table">
                                <tr><td>Nama</td><td>:</td><td><?php echo $nama; ?></td></tr>
                                <tr><td>Username</td><td>:</td><td><?php echo $username; ?></td></tr>
                                <tr><td>Password</td><td>:</td><td><?php echo "******"; ?></td></tr>
                                <tr><td>Level</td><td>:</td><td><?php echo $level; ?></td></tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->