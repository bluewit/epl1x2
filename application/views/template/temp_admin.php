<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Admin Zone</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>">
        <!-- CSS -->
        <!--<link rel="stylesheet" href="<?php echo base_url('assets/plugins/morris/morris.css') ?>">-->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/css/icons.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">     
        <!-- DataTables -->
        <link href="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/datatables/buttons.bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/datatables/fixedHeader.bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/datatables/responsive.bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/plugins/datatables/scroller.bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Sweet Alert -->
        <link href="<?php echo base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.css') ?>" rel="stylesheet" type="text/css">
        <!-- Datepicker -->
        <link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
        <!-- Timepicker -->
        <link href="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css') ?>" rel="stylesheet">        
        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/modernizr.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/detect.js')?>"></script>
        <script src="<?php echo base_url('assets/js/fastclick.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.blockUI.js')?>"></script>
        <script src="<?php echo base_url('assets/js/waves.js')?>"></script>
        <script src="<?php echo base_url('assets/js/wow.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.nicescroll.js')?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js')?>"></script>
        <!-- Datatables-->
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.buttons.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/buttons.bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/jszip.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/pdfmake.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/vfs_fonts.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/buttons.html5.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/buttons.print.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.fixedHeader.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.keyTable.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.responsive.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/responsive.bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables/dataTables.scroller.min.js')?>"></script>
        <!-- Sweet-Alert  -->
        <script src="<?php echo base_url('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') ?>"></script>
        <!-- Datepicker -->
        <script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js')?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.th.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datetimepicker.th.js') ?>"></script>
        <!-- Timepicker -->
        <script src="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.js') ?>"></script>
        <!-- Loadingoverlay JS -->
        <script src="<?php echo base_url('assets/plugins/loadingoverlay/loadingoverlay.js') ?>"></script>
        <!-- Bootstrap File Style -->
        <script src="<?php echo base_url('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') ?>"></script>
        <script type="text/javascript">
		$(function(){
			sweetAlertInitialize();
		<?php if($this->session->flashdata('msg_error')){ ?>
            swal("Sorry!", "<?php echo $this->session->flashdata('msg_error') ?>", "error");	
        <?php } ?>
        <?php if($this->session->flashdata('msg_success')){ ?>
            swal({
              title: "Good job!",
              text: "<?php echo $this->session->flashdata('msg_success') ?>",
              imageUrl: '<?php echo base_url('assets/plugins/bootstrap-sweetalert/thumbs-up.jpg') ?>'
            });
        <?php } ?>
			$(".datepicker").datepicker({
				 language:'th',
				 format: "yyyy-mm-dd",
				 /*startDate: '-3d',*/
				 endDate: '0d',
				 todayHighlight: true,
				 autoclose: true
			});
			$('.datetimepicker').datetimepicker({
				language:'th',
				weekStart: 1,
				todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				forceParse: 0,
				/*minuteStep:1*/
			});
		});
		</script>
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar"> 
			  <!-- LOGO -->
			  <div class="topbar-left">
				<div class="text-center"> <a href="" class="logo"><span>Web</span>System</a> <a href="index.html" class="logo-sm"><span>W</span></a> 
				  <!--<a href="index.html" class="logo"><img src="assets/images/logo_white_2.png" height="28"></a>--> 
				  <!--<a href="index.html" class="logo-sm"><img src="assets/images/logo_sm.png" height="36"></a>--> 
				</div>
			  </div>
			  <!-- Button mobile view to collapse sidebar menu -->
			  <div class="navbar navbar-default" role="navigation">
				<div class="container">
				  <div class="">
					<div class="pull-left">
					 <button type="button" class="button-menu-mobile open-left waves-effect waves-light"> <i class="ion-navicon"></i> </button>
					  <span class="clearfix"></span> </div>
					<!--<form class="navbar-form pull-left" role="search">
					  <div class="form-group">
						<input type="text" class="form-control search-bar" placeholder="Search...">
					  </div>
					  <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
					</form>-->
					<ul class="nav navbar-nav navbar-right pull-right">
					  <li class="hidden-xs"> <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="mdi mdi-fullscreen"></i></a> </li>
					  <li class="dropdown"> <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"> <img src="<?php echo base_url('assets/images/users/avatar-1.jpg') ?>" alt="user-img" class="img-circle"> <span class="profile-username"> <?php echo $this->session->userdata('name') ?> <br/>
						<small>จัดการข้อมูล</small> </span> </a>
						<ul class="dropdown-menu">
						  <!--<li><a href="javascript:void(0)"> Profile</a></li>
						  <li><a href="javascript:void(0)"><span class="badge badge-success pull-right">5</span> Settings </a></li>
						  <li><a href="javascript:void(0)"> Lock screen</a></li>
						  <li class="divider"></li>-->
						  <li><a href="<?php echo site_url('ad-manage/logout') ?>"> Logout</a></li>
						</ul>
					  </li>
					</ul>
				  </div>
				  <!--/.nav-collapse --> 
				</div>
			  </div>
			</div>
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
			  <div class="sidebar-inner slimscrollleft">
				<div class="user-details">
				  <!--<div class="text-center"> <img src="assets/images/users/avatar-1.jpg" alt="" class="img-circle"> </div>-->
				  <div class="user-info">
					<div class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $this->session->userdata('name') ?></a>
					  <ul class="dropdown-menu">
						<!--<li><a href="javascript:void(0)"> Profile</a></li>
						<li><a href="javascript:void(0)"> Settings</a></li>
						<li><a href="javascript:void(0)"> Lock screen</a></li>
						<li class="divider"></li>-->
						<li><a href="<?php echo site_url('ad-manage/logout') ?>"> Logout</a></li>
					  </ul>
					</div>
					<p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
				  </div>
				</div>
				<!--- Divider -->
				
				<div id="sidebar-menu">
				  <ul>
					<li><a href="<?php echo site_url('ad-manage') ?>" class="waves-effect"><i class="mdi mdi-home"></i><span> หน้าแรก Admin</span></a></li>
					<li><a href="<?php echo site_url('ad-manage/national') ?>" class="waves-effect"><i class="mdi mdi-arrow-right"></i><span> ประเทศ / โซน</span></a></li>
					<li><a href="<?php echo site_url('ad-manage/league') ?>" class="waves-effect"><i class="mdi mdi-arrow-right"></i><span>ลีก / รายการในประเทศ</span></a></li>
					<li><a href="<?php echo site_url('ad-manage/club') ?>" class="waves-effect"><i class="mdi mdi-arrow-right"></i><span>สโมสร</span></a></li>
                    <li><a href="<?php echo site_url('ad-manage/member') ?>" class="waves-effect"><i class="mdi mdi-arrow-right"></i><span>สมาชิก</span></a></li>
                    <li><a href="<?php echo site_url('ad-manage/gameweek') ?>" class="waves-effect"><i class="mdi mdi-arrow-right"></i><span>เกมส์วีค</span></a></li>                    
                    <li><a href="<?php echo site_url('ad-manage/match') ?>" class="waves-effect"><i class="mdi mdi-arrow-right"></i><span>คู่แข่งขัน</span></a></li>
                    <li><a href="<?php echo site_url('ad-manage/memberscore') ?>" class="waves-effect"><i class="mdi mdi-arrow-right"></i><span>คะแนนสมาชิก</span></a></li>
				  </ul>
				</div>
				<div class="clearfix"></div>
			  </div>
			  <!-- end sidebarinner --> 
			</div>
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                <?php echo $Content ?>
                </div> <!-- content -->
                <footer class="footer">
                     © 2022 WebAdmin - All Rights Reserved. {elapsed_time}
                </footer>
            </div>
            <!-- End Right content here -->
        </div>
        <!-- END wrapper -->
        
        <!--Morris Chart-->
        <!--<script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>
        <script src="assets/pages/dashborad.js"></script>-->
        <script src="<?php echo base_url('assets/plugins/parsleyjs/parsley.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/app.js' )?>"></script>
    </body>
</html>