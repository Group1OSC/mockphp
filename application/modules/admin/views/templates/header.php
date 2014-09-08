<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>public/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/tree-view.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Table Bootstrap Style  --> <!--acc05 - toannt2-->
    <link href="<?php echo base_url(); ?>public/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

<!-- jQuery UI --> <!--acc05 - toannt2-->
    <link href="<?php echo base_url(); ?>public/css/jquery-ui.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url(); ?>public/javascript/jquery-1.11.0.js"></script>
    
    <!-- jQuery UI --> <!--acc05 - toannt2-->
    <script src="<?php echo base_url(); ?>public/javascript/jquery-ui.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>admin/user/index">Admin Panel</a>
            </div>

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('logged_in') ? $this->session->userdata('logged_in') : "Admin"; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">

                        <li>
                            <a href="<?php echo base_url(); ?>authen/login/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/user/index">List Users</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/user/insert">Insert Users</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#brands"><i class="fa fa-fw fa-bookmark"></i> Brands <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="brands" class="collapse">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/brand/index">List Brands</a>
                            </li>
                          
                            <li>
                                <a href="<?php echo base_url(); ?>admin/brand/insert">Insert Brands</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/brand/search">Search Brands</a>
                            </li>                            
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#products"><i class="fa fa-fw fa-cubes"></i> Products <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="products" class="collapse">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/product/index">List Products</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>admin/product/insert">Insert Products</a>
                            </li>                            
                            <li>
                                <a href="<?php echo base_url(); ?>admin/product/search">Search Products</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#categories"><i class="fa fa-fw fa-folder-open"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="categories" class="collapse">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/category/index">List Categories</a>
                            </li>
                          
                            <li>
                                <a href="<?php echo base_url(); ?>admin/category/insert">Insert Categories</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url(); ?>admin/category/move">Move Categories</a>
                            </li>                            
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>admin/order/index"><i class="fa fa-fw fa-shopping-cart"></i> Orders Manager</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/slider/index"><i class="fa fa-fw fa-photo"></i> Sliders Manager</a>
                    </li>    
                    <li>
                        <a href="<?php echo base_url(); ?>admin/feedback/index"><i class="fa fa-fw fa-comments"></i> Feedbacks Manager</a>
                    </li>                    
                    <li>
                        <a href="<?php echo base_url(); ?>admin/config/index"><i class="fa fa-fw fa-wrench"></i> Config</a>
                    </li> 

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#report"><i class="fa fa-fw fa-list-ol"></i> Report <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="report" class="collapse">
                            <li>
                                <a href="<?php echo base_url(); ?>admin/report/product">Products</a>
                            </li>
                          
                            <li>
                                <a href="<?php echo base_url(); ?>admin/report/category">Categories</a>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo isset($title) ? $title : ""; ?>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="main-content">

