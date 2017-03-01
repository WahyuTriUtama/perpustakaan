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
                        <a href="<?php echo site_url('buku');?>" class="btn btn-info btn-outline btn-sm" type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-lg-6">

                            <table class="table">
                                <tr><td>Kode</td><td>:</td><td><?php echo $id_buku; ?></td></tr>
                                <tr><td>Judul</td><td>:</td><td><?php echo $judul; ?></td></tr>
                                <tr><td>Kategori</td><td>:</td><td><?php echo $id_kategori; ?></td></tr>
                                <tr><td>Pengarang</td><td>:</td><td><?php echo $id_pengarang; ?></td></tr>
                                <tr><td>Penerbit</td><td>:</td><td><?php echo $id_penerbit; ?></td></tr>
                                <tr><td>Tahun Terbit</td><td>:</td><td><?php echo $thn_terbit; ?></td></tr>
                                <tr><td>stok</td><td>:</td><td><?php echo $stok; ?></td></tr>
                                <tr><td>Dipinjam</td><td>:</td><td><?php echo $st_out; ?></td></tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->