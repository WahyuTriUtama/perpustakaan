<div class="row page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="#">Pengaturan</a>
            </li>
            <li class="active">
                <strong>User Account</strong>
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
                    <h5>Data User Account<small></small></h5>
                    <div class="box-tools">
                        <a href="<?php echo site_url('user/create');?>" class="btn btn-info btn-sm" type="button"><span class="fa fa-plus"></span> Tambah Data</a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="box-content">
                    <div class="">
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th>No</th>
                        		    <th>Nama</th>
                        		    <th>Username</th>
                        		    <th>Level</th>
                        		    <th>Action</th>
                                </tr>
                            </thead>
                    	    <tbody>
                                <?php
                                $start = 0;
                                foreach ($user_data as $user)
                                { ?>
                                    <tr>
                            		    <td><?php echo ++$start ?></td>
                            		    <td><?php echo $user->nama ?></td>
                            		    <td><?php echo $user->username ?></td>
                            		    <td><?php echo $user->level ?></td>
                            		    <td width="20%">
                            			<?php 
                            			echo anchor(site_url('user/read/'.$user->id_user),'<button class="btn btn-outline btn-primary btn-xs"><i class="fa fa-search"></i> View</button>'); 
                            			echo ' '; 
                            			echo anchor(site_url('user/update/'.$user->id_user),'<button class="btn btn-outline btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</button>'); 
                            			echo ' '; 
                            			echo anchor(site_url('user/delete/'.$user->id_user),'<button class="btn btn-outline btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>','onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
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