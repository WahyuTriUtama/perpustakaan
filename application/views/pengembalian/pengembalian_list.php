<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Transaksi</a>
            </li>
            <li class="active">
                <strong>Pengembalian</strong>
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
                    <h5>Data Pengembalian<small></small></h5>
                    <div class="box-tools">
                        <?php echo anchor(site_url('pengembalian/excel'), '<i class="fa fa-file-excel-o"></i> Eksport', 'class="btn btn-warning btn-sm"'); ?>
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
                                    <th>Peminjam</th>
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Tgl. Pinjam</th>
                                    <th>Tgl. Kembali</th>
                                    <th>Telat (hari)</th>
                                    <th>Denda (Rp)</th>
                                    <th width="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($pengembalian_data as $pengembalian)
                                { ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo $pengembalian->id_pinjam ?></td>
                                        <td><?php echo $pengembalian->NIS ?></td>
                                        <td><?php echo $pengembalian->id_buku ?></td>
                                        <td><?php echo $pengembalian->judul ?></td>
                                        <td><?php echo $pengembalian->tgl_pinjam ?></td>
                                        <td><?php echo $pengembalian->tgl_terima ?></td>
                                        <td><?php echo $pengembalian->telat ?></td>
                                        <td><?php echo $pengembalian->denda ?></td>
                                        <td>
                                        <?php 
                                        echo anchor(site_url('pengembalian/read/'.$pengembalian->id_pengembalian),'<button class="btn btn-outline btn-primary btn-xs" title="View"><i class="fa fa-search"></i></button>'); 
                                        if ($this->session->userdata('level') == 'admin') {
                                        echo ' '; 
                                        echo anchor(site_url('pengembalian/delete/'.$pengembalian->id_pengembalian),'<button class="btn btn-outline btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button>','onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
                                        }
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