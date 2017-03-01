<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
        <meta name='description' content="-" />
        <meta name='keywords' content="" />
        <meta name='robots' content='index,follow' />
        <title>Login - <?php echo $this->config->item('site');?></title>
        <link href="<?php echo base_url('assets/front/img/logo.png');?>" rel="SHORTCUT ICON" />
        <!-- themes style -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/load-style.css');?>" media="screen" />
        <!-- other style -->
        
    </head>
    <!-- body -->
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="<?php echo site_url('home'); ?>" title="Home"><img src="<?php echo base_url('assets/front/img/banner_1.jpg');?>" width="100%" alt="Login"></a></h3>
                        </div>
                        <div class="panel-body">
                            <div class="login-body">
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                    <p><strong>ERROR:</strong> Invalid username or password! </p>
                                    <div class="clear"></div>
                                </div>
                                <?php echo form_open($action);?>
                                    <fieldset>
                                        <div class="form-group">
                                            <input class="form-control input-lg" placeholder="Username" name="username" maxlength="30" type="text" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Password" name="password" maxlength="30" type="password" value="">
                                        </div>
                                        <!-- Change this to a button or input when using this as a form -->
                                        <button type="submit" class="btn btn-success btn-block">Login</button>
                                    </fieldset>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- load javascript -->
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/jquery/jquery.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/js/bootstrap/bootstrap.min.js');?>"></script>

        <!-- end of javascript  -->
    </body>
    <!-- end body -->
</html>
