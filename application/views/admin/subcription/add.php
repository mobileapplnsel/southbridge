<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('admin/top_css'); ?>
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/extra-libs/multicheck/multicheck.css'; ?>">
	<link href="<?php echo base_url() . 'common/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'; ?>" rel="stylesheet">
	<title><?php echo comp_name; ?> | Add Package</title>
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
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<?php $this->load->view('admin/header_main'); ?>
		<!-- End Topbar header -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<?php $this->load->view('admin/sidebar_main'); ?>
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">
			<!-- ============================================================== -->
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-12 d-flex no-block align-items-center">
						<h4 class="page-title">Add Package</h4>
						<div class="ml-auto text-right">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Package</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<div class="container-fluid">
				<!-- ============================================================== -->
				<div class="row">
					<div class="col-12">
						<div class="card">
							<form class="form-horizontal" id="create_user_form" action="<?php echo base_admin_url();?>create-package" method='POST'>
								<div class="card-body">
									<h4 class="card-title">Create New Package <button type="button" class="btn badge badge-pill badge-success" onclick="location.href='<?php echo base_admin_url() . 'package-list'; ?>'">Package List</button></h4>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">Package Type</label>
										<div class="col-sm-9">
											<select class="form-control" id="package_duration" name="package_duration" required>
												<option value="Monthly">Monthly</option>
												<option value="Quaterly">Quaterly</option>
												<option value="Yearly" selected>Yearly</option>
											</select>
											<label id="chk_category_name" style="display: none;"></label>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">Package Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="package_name" name="package_name" placeholder="Package Name.." required>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">Package Details</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="package_details" name="package_details" placeholder="Package Details.." required></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">Price (₹)</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="price" name="price" placeholder="Price.." onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required>
										</div>
									</div>
								</div>
								<div class="border-top">
									<div class="card-body">
										<button type="submit" id="user_btn_submit" class="btn btn-primary user_btn_submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- ============================================================== -->
			</div>
			<!-- ============================================================== -->
			<!-- End Container fluid  -->
			<!-- ============================================================== -->
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
	<?php $this->load->view('admin/bottom_js'); ?>
	<!-- this page js -->
	<script src="<?php echo base_url() . 'common/assets/extra-libs/multicheck/datatable-checkbox-init.js'; ?>"></script>
	<script src="<?php echo base_url() . 'common/assets/extra-libs/multicheck/jquery.multicheck.js'; ?>"></script>
	<script src="<?php echo base_url() . 'common/assets/extra-libs/DataTables/datatables.min.js'; ?>"></script>
	<!-- <script src="<?php //echo base_url() . 'common/dist/js/app/service.js?v=' . random_strings(6); ?>"></script> -->
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#category_name').select2();
		});
	</script>
</body>

</html>