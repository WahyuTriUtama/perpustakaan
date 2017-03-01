<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('anggota');?>"><?php echo $title;?></a><span></span>
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
                        <a href="<?php echo site_url('anggota');?>" class="btn btn-info btn-outline btn-sm" type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">NIS <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="NIS" id="NIS" placeholder="NIS" maxlength="4" value="<?php echo $NIS; ?>" />
                                        <small><?php echo form_error('NIS') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Nama Lengkap <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nama" id="key" placeholder="Nama" value="<?php echo $nama; ?>" />
                                        <small><?php echo form_error('nama') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Gender <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <div class="radio">
                                            <label class="col-sm-8">
                                                <input class="" type="radio" name="gender" value="L" <?php if ($gender === "L") {echo "checked='checked'";}?> /> Laki - Laki
                                            </label>
                                            <label class="col-sm-8">
                                                <input class="" type="radio" name="gender" value="P" <?php if ($gender === "P") {echo "checked='checked'";}?> /> Perempuan
                                            </label>
                                            <small><?php echo form_error('gender') ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Kelas <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="kelas" id="chosen" data-placeholder="Pilih Kelas...">
                                            <option value=""></option>
                                            <?php foreach ($dt_kelas as $kelas) {
                                                if ($kelas->id_kelas == $id_kelas) {
                                                    echo "<option value='".$kelas->id_kelas."' selected>".$kelas->kelas."</option>";
                                                }else{
                                                    echo "<option value='".$kelas->id_kelas."'>".$kelas->kelas."</option>";
                                                }
                                            }?>
                                        </select>
                                        <small><?php echo form_error('kelas') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Alamat <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="3" name="alamat" id="key1"><?php echo $alamat; ?></textarea>
                                        <small><?php echo form_error('alamat') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Telp. <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="hp" id="hp" placeholder="Telp." maxlength="12" value="<?php echo $hp; ?>" />
                                        <small><?php echo form_error('hp') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="action pull-right">
                                    <input type="hidden" name="id_anggota" value="<?php echo $id_anggota; ?>" /> 
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