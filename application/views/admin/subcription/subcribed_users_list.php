<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('admin/top_css'); ?>
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/extra-libs/multicheck/multicheck.css'; ?>">
	<link href="<?php echo base_url() . 'common/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'; ?>" rel="stylesheet">
	<title><?php echo comp_name; ?> | Subscription</title>
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
						<h4 class="page-title">Subscription List</h4>
						<div class="ml-auto text-right">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"> Subscription List</li>
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
							<div class="card-body">
								<h5 class="card-title">Subscription List</h5>
								<div class="table-responsive">
									<table id="zero_config" class="table table-striped table-bordered">
										<thead>
											<tr class="textcen">
												<th>Sl</th>
												<th>User Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Package Name</th>
												<th>Package Type</th>
												<th>Subcription Start Date</th>
												<th>Subcription End Date</th>
												<th>Amount(₹)</th>
												<th>Payment Status</th>
												<th>Transaction ID</th>
												<th>Receipt No</th>
												<th>Status</th>
												<th>Download Receipt</th>
											</tr>
										</thead>
										<tbody class="textcen">
											<?php
											if (!empty($all_subscription)) {
												$sl = 1;
												$CI = get_instance();
            									$CI->load->model('Auth_model');
												foreach ($all_subscription as $key => $val) 
												{
													$user_details 		= $CI->Auth_model->getUserData(array('user_id'=>$val->user_id), $many = FALSE);
													$package_details 	= $CI->Auth_model->getPackageData(array('id'=>$val->package_id), $many = FALSE);
													
													if($val->payment_status == '1')
													{
														$payment_status = 'Success';
													}
													else
													{
														$payment_status = 'Pending';
													}

													if($val->status == '1')
													{
														$status = 'Active';
													}
													else
													{
														$status = 'Inactive';
													}

											?>
													<tr>
														<td><?php echo $sl; ?></td>
														<td><?php echo $user_details->full_name; ?></td>
														<td><?php echo $user_details->email; ?></td>
														<td><?php echo $user_details->phone; ?></td>
														<td><?php echo $package_details->package_name; ?></td>
														<td><?php echo $package_details->package_duration; ?></td>
														<td><?php echo date('d-m-Y H:i:s',strtotime($val->subcription_start_date)); ?></td>
														<td><?php echo date('d-m-Y H:i:s',strtotime($val->subcription_end_date)); ?></td>
														<td><?php echo $val->amount; ?></td>
														<td><?php echo $payment_status; ?></td>
														<td><?php echo $val->transaction_id; ?></td>
														<td><?php echo $val->receipt_no; ?></td>
														<td><?php echo $status; ?></td>
														<td>
															<a href="<?php echo base_url('uploads/payment_receipt/sample.pdf')?>" target='_blank'><i class="icofont-download"></i></a>
														</td>
													</tr>
												<?php
													$sl++;
												}
											} else {
												?>
												<tr>
													<td colspan="14">No data found</td>
												</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>

							</div>
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
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('#zero_config').DataTable({
		        dom: 'Bfrtip',
		        buttons: ['excel','csv']
		    });
		});
	</script>

</body>
</html>