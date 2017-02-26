<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>DPT Admin | Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/dataTables.bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/select2.min.css">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/skin-red.min.css">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/morris.css">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/datepicker3.css">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/daterangepicker.css">
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>admin/bootstrap3-wysihtml5.min.css">       
        <link rel="stylesheet" href="<?php echo c('css_path_url'); ?>dropzone.css">       
        <script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
        <style type="text/css">
            .error{ font-size: 12px; color: #FF3636; font-weight: 400; }
            .skin-red .main-header .navbar{background-color: #40add6 !important;}
            .skin-red .main-header .logo{background-color: #248db5 !important;}
            .skin-red .main-header .navbar .sidebar-toggle:hover{background-color: #248db5 !important;}
            .skin-red .main-header .logo:hover{background-color: #1f81a7 !important;}
            .skin-red .main-header li.user-header{background-color: #3a9cc1 !important;}
            .user-panel>.image>img{height: 50px !important; width: 50px !important;}
        </style>
        <script>
            //function preventBack(){window.history.forward();}
            //setTimeout("preventBack()", 0);
            //window.onunload=function(){null};
        </script>

        <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=2l225mzji2ehq4bxk5v37quqbu2w4zegjzm0z41uhmyrxw5j"></script>
        <script>tinymce.init({ selector:'.textarea' });</script>
    </head>

    <body class="sidebar-mini skin-red">
        <div class="wrapper">
            <header class="main-header">
                <a href="<?php echo base_url(); ?>admin" class="logo">
                    <span class="logo-mini"><b>DPT</b></span>
                    <span class="logo-lg"><b>DPT</b> Admin</span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!--<li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success">4</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 4 messages</li>
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="<?php echo_image('img/avatar2.png'); ?>" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="<?php echo_image('img/avatar56.png'); ?>" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        DPT Design Team
                                                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="<?php echo_image('img/user4-128x128.jpg'); ?>" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Developers
                                                        <small><i class="fa fa-clock-o"></i> Today</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="<?php echo_image('img/user3-128x128.jpg'); ?>" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Sales Department
                                                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="<?php echo_image('img/user4-128x128.jpg'); ?>" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Reviewers
                                                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">See All Messages</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <!--<ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">View all</a>
                                    </li>
                                </ul>
                            </li>-->

                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo_image('images/logo-sm.png'); ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs">DPT Admin</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo_image('images/logo-sm.png'); ?>" class="img-circle" alt="User Image">

                                        <p>
                                            DPT - Admin
                                            <small>dubaiprivatetour.com</small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php url('admin/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo_image('images/logo-sm.png'); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>DPT Admin</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <ul class="sidebar-menu">
                        <li class="header">ADMIN NAVIGATION</li>

                        <li>
                            <a href="<?php echo admin_url(); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>



                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cubes"></i>
                                <span>Manage Categories</span>
                                <!--<span class="pull-right-container">
                                    <span class="label label-primary pull-right">4</span>
                                </span> -->
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo admin_url() . 'categories/add'; ?>"><i class="fa fa-plus"></i> Add Tour Category</a>
                                </li>
                                <li><a href="<?php echo admin_url() . 'categories'; ?>"><i class="fa fa-list"></i> List Tour Categories</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-plane"></i>
                                <span>Manage Emirates</span>                                
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo admin_url() . 'emirates/add'; ?>"><i class="fa fa-plus"></i> Add New Emirates</a>
                                </li>
                                <li><a href="<?php echo admin_url() . 'emirates'; ?>"><i class="fa fa-list"></i> List Emirates</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-suitcase" aria-hidden="true"></i>
                                <span>Manage Tours</span>                                
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo admin_url() . 'tours/add'; ?>"><i class="fa fa-plus"></i> Add New Tours</a>
                                </li>
                                <li><a href="<?php echo admin_url() . 'tours'; ?>"><i class="fa fa-list"></i> List Tours</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bookmark" aria-hidden="true"></i>
                                <span>Manage Bookings</span>                                
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo admin_url() . 'tour-booking'; ?>"><i class="fa fa-list"></i> Tour Bookings</a>
                                </li> 
                                <li><a href="<?php echo admin_url() . 'transfer-service-booking'; ?>"><i class="fa fa-list"></i> Transfer Service Bookings</a>
                                </li> 
                                <!--<li><a href="<?php echo admin_url() . 'email-template'; ?>"><i class="fa fa-list"></i> Edit email template</a>
                                </li>-->                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                <span>Manage Gallery</span>                                
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo admin_url() . 'gallery'; ?>"><i class="fa fa-list"></i> List Gallery</a>
                                </li>                              
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span>Manage Menu</span>                                
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo admin_url() . 'menu'; ?>"><i class="fa fa-list"></i> List Menu</a>
                                </li>                              
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span>Manage Reviews/Questions</span>                                
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo admin_url() . 'reviews'; ?>"><i class="fa fa-list"></i> Reviews</a>
                                </li> 
                                <li><a href="<?php echo admin_url() . 'questions'; ?>"><i class="fa fa-list"></i> Ask Questions</a>
                                </li>                    
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Manage Tour Agents</span>                                
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo admin_url() . 'agents'; ?>"><i class="fa fa-list"></i> List Agents</a>
                                </li> 
                            </ul>
                        </li>

                        <!-- <li class="divider" style="border: #304148 solid 1px;"></li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span>Admin Profile Settings</span>                               
                            </a>
                            <ul class="treeview-menu"> 
                                <li><a href="#"><i class="fa fa-circle-o"></i> Profile</a>
                                </li>
                                <li><a href="#"><i class="fa fa-lock"></i> Reset password</a>
                                </li>

                            </ul>
                        </li> --> 


                    </ul>
                </section>
            </aside>
            <?php
            //contents goes here
            echo $content;
            ?>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php url('admin'); ?>">DPT Admin</a>.</strong> All rights reserved.
            </footer>
        </div>
        <div data-href='<?php url('admin'); ?>/' id="admin_url"></div>
        <script src="<?php echo c('js_path_url'); ?>admin/jquery-2.2.3.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/jquery.validate.js"></script> 
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>        
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="<?php echo c('js_path_url'); ?>admin/bootstrap.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/jquery.dataTables.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/dataTables.bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/morris.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/jquery.sparkline.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/jquery-jvectormap-world-mill-en.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/jquery.knob.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/daterangepicker.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/bootstrap-datepicker.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/select2.full.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/bootstrap3-wysihtml5.all.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/jquery.slimscroll.min.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/fastclick.js"></script>
        <script src="<?php echo c('js_path_url'); ?>admin/app.min.js"></script>
        <!-- dropzone -->
        <script src="<?php echo c('js_path_url'); ?>dropzone.js"></script>

        <?php if($dashboard_js == "yes") { ?>
        <script src="<?php echo c('js_path_url'); ?>admin/dashboard.js"></script>
        <?php } ?>
        <script src="<?php echo c('js_path_url'); ?>admin/demo.js"></script>  
        <script src="<?php echo c('js_path_url'); ?>admin/admin.js"></script>             
    </body>

</html>