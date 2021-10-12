<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Page</title>
    <!-- Bootstrap Styles-->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="<?php echo base_url(); ?>assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?php echo base_url(); ?>assets/css/custom-styles.css" rel="stylesheet" />
	
	<link rel="shortcut icon" href="<?php echo base_url(); ?>login/images/icons/logo-ikon.png" />
	
	<style>
        .tblst {
			height : 300px;
            overflow-y : scroll;
            overflow-x : scroll;
        }
    </style>
	<style type="text/css">
    input[type="date"]: {
		width: 50%;
	}
	#tglm::-webkit-calendar-picker-indicator {
        background: transparent;
        color: transparent;
        cursor: pointer;
        height: 20px;
        left: 0;
        position: absolute;
        right: 0;
        width: auto;
    }
	#tglm2::-webkit-calendar-picker-indicator {
        background: transparent;
        color: transparent;
        cursor: pointer;
        height: 20px;
        left: 0;
        position: absolute;
        right: 0;
        width: auto;
    }
	</style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><small><?php echo $_SESSION['role']; ?></small></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                    
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['username'];?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" data-toggle="modal" data-target="#cp"><i class="fa fa-key fa-fw"></i> Ganti Password</a></li>
                        <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
						
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>

		
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li>
						<a href="<?php echo base_url(); ?>home" <?php if($page=="dashboard"){echo 'class="active-menu"';}?>><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>kategori" <?php if($page=="kategori"){echo 'class="active-menu"';}?>><i class="fa fa-list"></i> Kategori</a>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>produk" <?php if($page=="produk"){echo 'class="active-menu"';}?>><i class="fa fa-archive"></i> Produk</a>
					</li>
					<li>
						<a href="#" <?php if($page=="about" or $page=="slide" or $page=="story"){echo 'class="active"';}?>><i class="fa fa-folder-open"></i> Pengaturan<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level <?php if($page=="about" or $page=="slide" or $page=="story"){echo 'in';} else{echo'out';}  ?>">
                            <li>
                                <a href="<?php echo base_url(); ?>about" <?php if($page=="about"){echo 'class="active-menu"';}?>>About</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>slide" <?php if($page=="slide"){echo 'class="active-menu"';}?>>Slide</a>
                            </li>
							<li>
                                <a href="<?php echo base_url(); ?>story" <?php if($page=="story"){echo 'class="active-menu"';}?>>Story</a>
                            </li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>akun" <?php if($page=="akun"){echo 'class="active-menu"';}?>><i class="fa fa-users"></i> Akun</a>
					</li>
				</ul>
			</div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
		<?php 
			if($page=="dashboard"){ 
				include'dashboard/dashboard_view.php';
			} 
			if($page=="kategori"){ 
				include'kategori/kategori_view.php';
			} 
			if($page=="produk"){ 
				include'produk/produk_view.php';
			} 
			if($page=="about"){ 
				include'setting/about_view.php';
			} 
			if($page=="slide"){ 
				include'setting/slide_view.php';
			} 
			if($page=="story"){ 
				include'setting/story_view.php';
			} 
			if($page=="akun"){ 
				include'akun/akun_view.php';
			} 
		?>
		</div>
		<!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
	<!-- modal Add -->
<div id="cp" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Ganti Password</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>Akun/change/" enctype="multipart/form-data">
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'];?>" readonly>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" maxlength="20" required>
					</div>
					<input type="submit" value="Simpan" class="btn btn-success">&emsp;
					<input type="button" value="Batal" class="btn btn-default" data-dismiss="modal">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END:modal Add -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="<?php echo base_url(); ?>assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/morris/morris.js"></script>
	<!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
		$(document).ready(function () {
			$('#dt-email').dataTable();
		});
		$(document).ready(function () {
			$('#dt-kategori').dataTable();
		});
		$(document).ready(function () {
			$('#dt-produk').dataTable();
		});
		
		$(document).ready(function () {
			$('#dt-akun').dataTable();
		});
		$(document).ready(function () {
			$('#dt-slide').dataTable();
		});
		$(document).ready(function () {
			$('#dt-story').dataTable();
		});
				
    </script>
	
	<script src="<?php echo base_url(); ?>assets/js/custom-scripts.js"></script>
	
</body>
</html>