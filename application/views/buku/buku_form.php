<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Data Master</a>
            </li>
            <li>
                <a href="<?php echo site_url('buku');?>"><?php echo $title;?></a><span></span>
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
                        <a href="<?php echo site_url('buku');?>" class="btn btn-info btn-outline btn-sm" type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Kode <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="id_buku" id="id_buku" readonly="readonly" value="<?php echo $id_buku; ?>" />
                                        <small><?php echo form_error('id_buku') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Judul <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="judul" id="key" placeholder="Judul" maxlength="100" value="<?php echo $judul; ?>" />
                                        <small><?php echo form_error('judul') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Kategori <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="id_kategori" id="chosen" data-placeholder="Pilih Kategori...">
                                            <option value=""></option>
                                            <?php foreach ($dt_kategori as $kategori) {
                                                if ($kategori->id_kategori === $id_kategori) {
                                                    echo "<option value='".$kategori->id_kategori."' selected>".$kategori->kategori."</option>";
                                                }else{
                                                    echo "<option value='".$kategori->id_kategori."'>".$kategori->kategori."</option>";
                                                }
                                            }?>
                                        </select>
                                        <small><?php echo form_error('id_kategori') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Pengarang <i style="color:red">*</i></label>
                                    <div class="controls col-sm-8">
                                        <select class="form-control" name="id_pengarang" id="chosen1" data-placeholder="Pilih Pengarang...">
                                            <option value=""></option>
                                            <?php foreach ($dt_pengarang as $pengarang) {
                                                if ($pengarang->id_pengarang === $id_pengarang) {
                                                    echo "<option value='".$pengarang->id_pengarang."' selected>".$pengarang->pengarang."</option>";
                                                }else{
                                                    echo "<option value='".$pengarang->id_pengarang."'>".$pengarang->pengarang."</option>";
                                                }
                                            }?>
                                        </select>
                                        <small><?php echo form_error('id_pengarang') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Penerbit <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="id_penerbit" id="chosen2" data-placeholder="Pilih Penerbit...">
                                            <option value=""></option>
                                            <?php foreach ($dt_penerbit as $penerbit) {
                                                if ($penerbit->id_penerbit === $id_penerbit) {
                                                    echo "<option value='".$penerbit->id_penerbit."' selected>".$penerbit->penerbit."</option>";
                                                }else{
                                                    echo "<option value='".$penerbit->id_penerbit."'>".$penerbit->penerbit."</option>";
                                                }
                                            }?>
                                        </select>
                                        <small><?php echo form_error('id_penerbit') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Tahun Terbit <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="thn_terbit" id="chosen3" data-placeholder="Pilih Tahun...">
                                            <option value=""></option>
                                            <?php
                                            $now=date('Y');
                                            for ($a=1970;$a<=$now;$a++)
                                            {                   
                                                if ($a == $thn_terbit) {
                                                    echo "<option value='".$a."' selected>".$a."</option>";
                                                }else{
                                                    echo "<option value='".$a."'>".$a."</option>";
                                                }
                                            } ?>
                                        </select>
                                        <small><?php echo form_error('thn_terbit') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Stok<i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="stok" id="stok" placeholder="Stok" maxlength="3" value="<?php echo $stok; ?>" />
                                        <small><?php echo form_error('stok') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="action pull-right"> 
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