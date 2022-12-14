<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('admin/top_css'); ?>
	<title><?php echo comp_name; ?> | Dashboard</title>
</head>

<body>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- Topbar header - style you can find in pages.scss -->
		<?php $this->load->view('admin/header_main'); ?>
		<!-- End Topbar header -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<?php $this->load->view('admin/sidebar_main'); ?>
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-12 d-flex no-block align-items-center">
						<h4 class="page-title">Dashboard</h4>
						<div class="ml-auto text-right">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_admin_url();?>">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Dashboard </li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- Container fluid  -->
			<!-- ============================================================== -->
			<div class="container-fluid">

			</div>
			<!-- ============================================================== -->
			<!-- footer -->
			<!-- ============================================================== -->
			<?php $this->load->view('admin/footer'); ?>
			<!-- ============================================================== -->
			<!-- End footer -->
			<!-- ============================================================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Page wrapper  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<?php $this->load->view('admin/bottom_js'); ?>
	<!--This page JavaScript -->
	<!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->

	<!-- Charts js Files -->
	<script src="<?php echo base_url() . 'common/assets/libs/flot/excanvas.js'; ?>"></script>
	<script src="<?php echo base_url() . 'common/assets/libs/flot/jquery.flot.js'; ?>"></script>
	<script src="<?php echo base_url() . 'common/assets/libs/flot/jquery.flot.pie.js'; ?>"></script>
	<script src="<?php echo base_url() . 'common/assets/libs/flot/jquery.flot.time.js'; ?>"></script>
	<script src="<?php echo base_url() . 'common/assets/libs/flot/jquery.flot.stack.js'; ?>"></script>
	<script src="<?php echo base_url() . 'common/assets/libs/flot/jquery.flot.crosshair.js'; ?>"></script>
	<script src="<?php echo base_url() . 'common/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'common/dist/js/pages/chart/chart-page-init.js'; ?>"></script>
	<!-- ============================================================== -->

</body>

</html>