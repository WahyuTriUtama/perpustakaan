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
                <strong><?php echo $button;?></strong>
            </li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <!-- notification template -->
            <?php
            if($this->session->flashdata('message') <> '') { ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <?php echo $this->session->flashdata('message'); ?>
                <div class="clear"></div>
            </div>
            <?php
            } ?>
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
                    <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Nama Lengkap <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nama" id="key" placeholder="Nama" value="<?php echo $nama; ?>" />
                                        <small><?php echo form_error('nama') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Username <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                                        <small><?php echo form_error('username') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Password <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                                        <small><?php echo form_error('password') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Level <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <div class="radio">
                                            <label class="col-sm-8">
                                                <input class="" type="radio" name="level" value="admin" <?php if ($level === "admin") {echo "checked='checked'";}?> /> Administrator
                                            </label>
                                            <label class="col-sm-8">
                                                <input class="" type="radio" name="level" value="user" <?php if ($level === "user") {echo "checked='checked'";}?> /> User
                                            </label>
                                            <small><?php echo form_error('level') ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="action pull-right">
                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
                                    <input type="submit" name="save" value="Simpan" class="btn btn-success">
                                    <input type="reset" name="save" value="Reset" class="btn btn-danger">
                                </div>
                            </div>
                        </div>     
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->