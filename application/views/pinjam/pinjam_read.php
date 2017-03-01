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
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table table-striped" id="">
                                <tr><td width="40%">Kode Pinjam</td><td>:</td><td><?php echo $id_pinjam; ?></td></tr>
                                <tr><td>NIS</td><td>:</td><td><?php echo $id_anggota; ?></td></tr>
                                <tr><td>Nama</td><td>:</td><td><?php echo $nama; ?></td></tr>
                                <tr><td>Kelas</td><td>:</td><td><?php echo $kelas; ?></td></tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-striped" id="">
                                <tr><td width="40%">Tgl. Pinjam</td><td>:</td><td><?php echo $tgl_pinjam; ?></td></tr>
                                <tr><td>Batas Kembali</td><td>:</td><td><?php echo $tgl_kembali; ?></td></tr>
                                <tr><td>Status</td><td>:</td><td><?php if ($status == '1'){ echo "Dipinjam"; } else { echo "Kembali"; } ?></td></tr>
                                <tr><td>Petugas Peminjam</td><td>:</td><td><?php echo $petugas; ?></td></tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>&nbsp; Data Buku</h5>
                            <table class="table">
                                <thead>
                                    <tr style="text-align:left">
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
                                        <td><?php echo $id_buku; ?></td>
                                        <td><?php echo $judul; ?></td>
                                        <td><?php echo $kategori; ?></td>
                                        <td><?php echo $pengarang; ?></td>
                                        <td><?php echo $penerbit; ?></td>
                                        <td><?php echo $thn; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="action pull-right">
                                <?php echo anchor(site_url('pengembalian/create?kode='.$id_pinjam.'&m=index'),'<button class="btn btn-primary" title="Pengembalian Buku"><i class="fa fa-link"></i> Buku Dikembalikan</button>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->