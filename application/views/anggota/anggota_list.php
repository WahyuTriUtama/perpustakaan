<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li class="active">
                <strong>Data Anggota</strong>
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
                    <h5>Data Anggota<small></small></h5>
                    <div class="box-tools">
                        <a href="<?php echo site_url('anggota/create');?>" class="btn btn-info btn-sm" type="button"><span class="fa fa-plus"></span> Tambah Data</a>
                        <?php echo anchor(site_url('anggota/excel'), '<i class="fa fa-file-excel-o"></i> Cetak', 'class="btn btn-warning btn-sm"'); ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <div class="">
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>Kelas</th>
                                    <th>Alamat</th>
                                    <th>Telp.</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($anggota_data as $anggota)
                                { ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo $anggota->NIS ?></td>
                                        <td><?php echo $anggota->nama ?></td>
                                        <td><?php if ($anggota->gender == 'L') { echo "Laki-laki";}else{echo "Perempuan";} ?></td>
                                        <td><?php echo $anggota->kelas; ?></td>
                                        <td><?php echo $anggota->alamat ?></td>
                                        <td><?php echo $anggota->hp ?></td>
                                        <td>
                                        <?php 
                                        echo anchor(site_url('anggota/update/'.$anggota->id_anggota),'<button class="btn btn-outline btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></button>'); 
                                        if ($this->session->userdata('level') == 'admin') {
                                            echo ' '; 
                                            echo anchor(site_url('anggota/delete/'.$anggota->id_anggota),'<button class="btn btn-outline btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button>','onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
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