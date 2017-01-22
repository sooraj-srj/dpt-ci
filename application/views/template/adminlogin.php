<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DPT Admin | Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/AdminLTE.min.css">
        <style>
            .img-center{
                display: block;
                margin: 0 auto;
            }
            .login-page, .register-page{
                background: #40add6 !important;
            }
            .login-logo a, .register-logo a{
                color: #000 !important;
            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">                
                <a href="#"><b>DPT </b> Admin</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <img src="<?php echo_image('images/logo.png'); ?>" class="img-responsive img-center"><br>
                <p class="login-box-msg">Sign in to start your session</p>
                <?php
                $error = f('error_message') ? f('error_message') : validation_errors();
                ?>
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
                <form action="<?php url('admin') ?>" method="post">

                    <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="User Name">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <div class="col-xs-8">
                            <a href="#" class="pull-right">Forgot password?</a>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <script src="<?php echo c('js_path_url'); ?>admin/jquery-2.2.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="<?php echo c('js_path_url'); ?>admin/bootstrap.min.js"></script>               
    </body>
</html>
