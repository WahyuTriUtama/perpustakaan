<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Data Master</a>
            </li>
            <li class="active">
                <strong>Pengarang</strong>
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
                    <h5>Data Pengarang<small></small></h5>
                    <div class="box-tools">
                        <a href="<?php echo site_url('pengarang/create');?>" class="btn btn-info btn-sm" type="button"><span class="fa fa-plus"></span> Tambah Data</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <div class="">
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th width="8%">No</th>
                                    <th>Pengarang</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($pengarang_data as $pengarang)
                                { ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo $pengarang->pengarang ?></td>
                                        <td>
                                        <?php 
                                        echo anchor(site_url('pengarang/update/'.$pengarang->id_pengarang),'<button class="btn btn-outline btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</button>'); 
                                        echo ' '; 
                                        echo anchor(site_url('pengarang/delete/'.$pengarang->id_pengarang),'<button class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>','onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
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