<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cyber IT Solutions | CMS Panel</title>

    <?php $this->load->helper('HTML');
        // Bootstrap Core CSS
        echo link_tag('css/bootstrap.css');

        //DataTables CSS
        echo link_tag('cms_resource/dist/css/sb-admin-2.css');

        //DataTables Responsive CSS
        echo link_tag('cms_resource/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');

        //Custom Fonts
        echo link_tag('cms_resource/bower_components/datatables-responsive/css/dataTables.responsive.css');

        //Custom Fonts
        echo link_tag('cms_resource/bower_components/font-awesome/css/font-awesome.min.css');

        //Alert
        echo link_tag('cms_resource/bower_components/alert/alertify.core.css');
        echo link_tag('cms_resource/bower_components/alert/alertify.default.css');

        //WYSIWYG Editor
        echo link_tag('cms_resource/dist/css/bootstrap-wysihtml5.css');
    ?>
    
    <style>
        /*Pagination*/
        ul.pagination li.active a{
            pointer-events:none;
        }
    </style>
    
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>

    <!-- Alert -->
    <script src="<?php echo base_url(); ?>cms_resource/bower_components/alert/alertify.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= site_url("home_cms/index") ?>">CMS Panel</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="<?= site_url('user/profileDetail')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>-->
                    <li class="divider"></li>
                    <li><a href="<?= site_url('user/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <!--li class="sidebar-search"-->
                        <!--div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div-->
                        <!-- /input-group -->
         
                        <li>
                            <a href="<?= site_url("user/userListCms")?>"><i class="fa fa-files-o fa-fw"></i> Manage Admins<span class="fa arrow"></span></a>
            
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Manage Appointments<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= site_url("appointment/appointmentListCms") ?>">Appointments</a>
                                </li>
                            </ul>
                        </li>
                        
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <?php $this->load->view($main_content); ?>
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>cms_resource/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>cms_resource/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>cms_resource/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>cms_resource/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>cms_resource/dist/js/sb-admin-2.js"></script>

<!-- WYSIWYG Editor js -->
<script src="<?php echo base_url(); ?>cms_resource/dist/js/wysihtml5-0.3.0.min.js"></script>
<script src="<?php echo base_url(); ?>cms_resource/dist/js/bootstrap-wysihtml5.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

</body>

</html>