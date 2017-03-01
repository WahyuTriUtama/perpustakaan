<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Data Master</a>
            </li>
            <li class="active">
                <strong>Buku</strong>
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
                    <h5>Data Buku<small></small></h5>
                    <div class="box-tools">
                        <a href="<?php echo site_url('buku/create');?>" class="btn btn-info btn-sm" type="button"><span class="fa fa-plus"></span> Tambah Data</a>
                        <?php echo anchor(site_url('buku/excel'), '<i class="fa fa-file-excel-o"></i> Cetak', 'class="btn btn-warning btn-sm"'); ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <div class="">
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Buku</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Stok</th>
                                    <th>Dipinjam</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($buku_data as $buku)
                                { ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo $buku->id_buku ?></td>
                                        <td><?php echo $buku->judul ?></td>
                                        <td><?php echo $buku->kategori ?></td>
                                        <td><?php echo $buku->pengarang ?></td>
                                        <td><?php echo $buku->penerbit ?></td>
                                        <td><?php echo $buku->thn_terbit ?></td>
                                        <td><?php echo $buku->stok; ?></td>
                                        <td><?php echo $buku->st_out; ?></td>
                                        <td>
                                        <?php 
                                        echo anchor(site_url('buku/read/'.$buku->id_buku),'<button class="btn btn-outline btn-primary btn-xs" title="View"><i class="fa fa-search"></i></button>'); 
                                        echo ' '; 
                                        echo anchor(site_url('buku/update/'.$buku->id_buku),'<button class="btn btn-outline btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></button>'); 
                                        if ($this->session->userdata('level') == 'admin') {
                                        echo ' '; 
                                        echo anchor(site_url('buku/delete/'.$buku->id_buku),'<button class="btn btn-outline btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button>','onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
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