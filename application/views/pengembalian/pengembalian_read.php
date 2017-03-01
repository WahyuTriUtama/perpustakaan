<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Transaksi Buku</a>
            </li>
            <li>
                <a href="<?php echo site_url('pengembalian');?>"><?php echo $title;?></a><span></span>
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
            <!-- end of notification template-->
            <div class="box">
                <div class="box-title">
                    <h5 class="form-title"><?php echo $button;?> <?php echo $title;?></h5>
                    <div class="box-tools">
                        <a href="<?php echo site_url('pengembalian');?>" class="btn btn-info btn-outline btn-sm" type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <form action="#" method="post" class="form-horizontal">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Kode Pinjam<i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="id_pinjam" id="id_pinjam" readonly="readonly" value="<?php echo $id_pinjam; ?>" />
                                        <small><?php echo form_error('id_pinjam') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Anggota <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="id_anggota" readonly="readonly">
                                            <?php foreach ($dt_anggota as $anggota) {
                                                if ($anggota->id_anggota === $id_anggota) {
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
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Batas Kembali <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="bts" id="" readonly="readonly" value="<?php echo $bts_kembali; ?>" />
                                        <small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Tgl. Kembali <i style="color:red">*</i></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="tgl_terima" id="tgl_terima" readonly="readonly" value="<?php echo $tgl_terima; ?>" />
                                        <small><?php echo form_error('tgl_terima') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Telat</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="telat" id="telat" readonly="readonly" value="<?php echo $telat; ?>" />
                                        <small><?php echo form_error('telat') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Denda</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="denda" id="denda" readonly="readonly" value="<?php echo $denda; ?>" />
                                        <small><?php echo form_error('denda') ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="varchar" class="col-sm-4 control-label">Petugas</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="petugas" id="petugas" readonly="readonly" value="<?php echo $petugas; ?>" />
                                        <small><?php echo form_error('petugas') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <hr/>
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>Data Buku</h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="text-align:left;">
                                            <th>Kode</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Pengarang</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $kode;?></td>
                                            <td><?php echo $judul;?></td>
                                            <td><?php echo $kategori;?></td>
                                            <td><?php echo $pengarang;?></td>
                                            <td><?php echo $penerbit;?></td>
                                            <td><?php echo $thn;?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->