<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Data Master</a>
            </li>
            <li>
                <a href="<?php echo site_url('penerbit');?>"><?php echo $title;?></a><span></span>
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
                        <a href="<?php echo site_url('penerbit');?>" class="btn btn-info btn-outline btn-sm" type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Penerbit <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="penerbit" id="key" placeholder="Penerbit" value="<?php echo $penerbit; ?>" />
                                        <small><?php echo form_error('penerbit') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="action pull-right">
                                    <input type="hidden" name="id_penerbit" value="<?php echo $id_penerbit; ?>" /> 
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