<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Transaksi Buku</a>
            </li>
            <li class="active">
                <strong><?php echo $title;?></strong>
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
                    <h5><?php echo $title;?><small></small></h5>
                    <div class="box-tools">
                        <a href="<?php echo site_url('pinjam/create');?>" class="btn btn-info btn-sm" type="button"><span class="fa fa-plus"></span> Tambah Data</a>
                        <?php echo anchor(site_url('pinjam/excel'), '<i class="fa fa-file-excel-o"></i> Cetak', 'class="btn btn-warning btn-sm"'); ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <div class="">
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pinjam</th>
                                    <th>Anggota</th>
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Tgl. Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($pinjam_data as $pinjam)
                                { ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo $pinjam->id_pinjam ?></td>
                                        <td><?php echo $pinjam->NIS ?></td>
                                        <td><?php echo $pinjam->id_buku ?></td>
                                        <td><?php echo $pinjam->judul; ?></td>
                                        <td><?php echo $pinjam->tgl_pinjam ?></td>
                                        <td><?php echo $pinjam->tgl_kembali ?></td>
                                        <td>
                                        <?php 
                                        echo anchor(site_url('pinjam/read/'.$pinjam->id_pinjam),'<button class="btn btn-outline btn-primary btn-xs" title="View"><i class="fa fa-search"></i></button>'); 
                                        if ($this->session->userdata('level') == 'admin') {
                                        echo ' '; 
                                        echo anchor(site_url('pinjam/delete/'.$pinjam->id_pinjam),'<button class="btn btn-outline btn-danger btn-xs"title="Delete"><i class="fa fa-trash"></i></button>','onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
                                        }
                                        echo ' <> '; 
                                        echo anchor(site_url('pengembalian/create?kode='.$pinjam->id_pinjam.'&m=index'),'<button class="btn btn-outline btn-info btn-xs" title="Pengembalian Buku"><i class="fa fa-link"></i> Diterima</button>'); 
                                        ?>
                                        </td>
                                   </tr>
                                   <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>