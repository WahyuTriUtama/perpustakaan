<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Transaksi Buku</a>
            </li>
            <li>
                <a href="<?php echo site_url('pinjam');?>"><?php echo $title;?></a><span></span>
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
                        <a href="<?php echo site_url('pinjam');?>" class="btn btn-info btn-outline btn-sm" type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
                        <div class="row">
                            <div class="col-lg-8">
                                <h5>Data Buku</h5><small><?php echo form_error('id_buku') ?></small>
                                <table class="table table-striped table-striped" id="mytable">
                                    <thead>
                                        <tr style="text-align:left;">
                                            <th>Cek</th>
                                            <th>Kode</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Penerbit</th>
                                            <th>Terbit</th>
                                            <th>Stok</th>
                                            <th>Dipinjam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach ($dt_buku as $buku) 
                                        { 
                                         if ($buku->id_buku == $id_buku) { ?>
                                            <tr style="text-align:left;">
                                                <td><input type="radio" name="id_buku" class="radio" value="<?php echo $buku->id_buku;?>" checked /></td>
                                                <td><?php echo $buku->id_buku;?></td>
                                                <td><?php echo $buku->judul;?></td>
                                                <td><?php echo $buku->kategori;?></td>
                                                <td><?php echo $buku->penerbit;?></td>
                                                <td><?php echo $buku->thn_terbit;?></td>
                                                <td><?php echo $buku->stok;?></td>
                                                <td><?php echo $buku->st_out;?></td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr style="text-align:left;">
                                                <td><input type="radio" name="id_buku" class="radio" value="<?php echo $buku->id_buku;?>"/></td>
                                                <td><?php echo $buku->id_buku;?></td>
                                                <td><?php echo $buku->judul;?></td>
                                                <td><?php echo $buku->kategori;?></td>
                                                <td><?php echo $buku->penerbit;?></td>
                                                <td><?php echo $buku->thn_terbit;?></td>
                                                <td><?php echo $buku->stok;?></td>
                                                <td><?php echo $buku->st_out;?></td>
                                            </tr>
                                        <?php } 
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Kode <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="id_pinjam" id="id_pinjam" readonly="readonly" value="<?php echo $id_pinjam; ?>" />
                                        <small><?php echo form_error('id_pinjam') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Anggota <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="id_anggota" id="chosen" data-placeholder="Pilih Anggota...">
                                            <option value=""></option>
                                            <?php foreach ($dt_anggota as $anggota) {
                                                if ($anggota->id_anggota === $id_anggota) {
                                                    echo "<option value='".$anggota->id_anggota."' selected>".$anggota->NIS." - ".$anggota->nama." - ".$anggota->kelas."</option>";
                                                }else{
                                                    echo "<option value='".$anggota->id_anggota."'>".$anggota->NIS." - ".$anggota->nama." - ".$anggota->kelas."</option>";
                                                }
                                            }?>
                                        </select>
                                        <small><?php echo form_error('id_anggota') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Tgl. Pinjam <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="tgl_pinjam" id="tgl_pinjam" readonly="readonly" value="<?php echo $tgl_pinjam; ?>" />
                                        <small><?php echo form_error('tgl_pinjam') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Tgl. Kembali <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="tgl_kembali" id="tgl_kembali" readonly="readonly" value="<?php echo $tgl_kembali; ?>" />
                                        <small><?php echo form_error('tgl_kembali') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Petugas <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="petugas" id="petugas" readonly="readonly" value="<?php echo $petugas; ?>" />
                                        <small><?php echo form_error('petugas') ?></small>
                                    </div>
                                </div>
                                <hr/>
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