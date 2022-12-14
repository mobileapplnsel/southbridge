<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('admin/top_css'); ?>
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/extra-libs/multicheck/multicheck.css'; ?>">
	<link href="<?php echo base_url() . 'common/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'; ?>" rel="stylesheet">
	<title><?php echo comp_name; ?> | Services</title>
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
						<h4 class="page-title">Service List</h4>
						<div class="ml-auto text-right">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"> Service List</li>
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
								<h5 class="card-title">User Category <button type="button" class="btn badge badge-pill badge-success" onclick="location.href='<?php echo base_admin_url() . 'add-service'; ?>'">Add Service</button></h5>
								<div class="table-responsive">
									<table id="zero_config" class="table table-striped table-bordered">
										<thead>
											<tr class="textcen">
												<th>Sl</th>
												<th>Category Name</th>
												<th>Service Name</th>
												<th>Service Details</th>
												<th>Price (₹)</th>
												<th>Created By</th>
												<th>Created Date</th>
												<th>Status</th>
												<th>Action</th>

											</tr>
										</thead>
										<tbody class="textcen">
											<?php
											if (!empty($all_services)) {
												//print_obj($broc_list);
												$sl = 1;
												$CI = get_instance();
            									$CI->load->model('Auth_model');
												foreach ($all_services as $key => $val) {
													$category_name 	= $CI->Auth_model->getServiceCategoryData(array('id'=>$val['category_id']), $many = FALSE);
													$created_by 	= $CI->Auth_model->getUserData(array('user_id'=>$val['created_by']), $many = FALSE);

											?>
													<tr>
														<td><?php echo $sl; ?></td>
														<td><?php echo $category_name->category_name; ?></td>
														<td><?php echo $val['service_name']; ?></td>
														<td><?php echo $val['service_details']; ?></td>
														<td><?php echo $val['price']; ?></td>
														<td><?php echo $created_by->full_name; ?></td>
														<td><?php echo date('d-m-Y',strtotime($val['created_date'])); ?></td>
														<td>
															<select class="form-control" id="cat_status<?php echo $sl; ?>" name="cat_status<?php echo $sl; ?>" onchange="updateServiceStatusAjax(<?php echo $sl.','.$val['id']; ?>);">
																<option value="1" <?php if($val['status'] == '1'){ echo "selected";}?>>Active</option>
																<option value="0" <?php if($val['status'] == '0'){ echo "selected";}?>>Inactive</option>
															</select>
														</td>
														<td>
															<button type="button" onclick="location.href='<?php echo base_admin_url() . 'edit-service/' . encode_url($val['id']); ?>'"><i class="icofont-pencil-alt-2"></i></button>
														</td>
													</tr>
												<?php
													$sl++;
												}
											} else {
												?>
												<tr>
													<td colspan="4">No data found</td>
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
<script type="text/javascript">
	function updateServiceStatusAjax(counter,service_id) 
	{
		var status = $('#cat_status'+counter).val();
		$.ajax({
                    type: "POST",
                    url: BASE_URL + 'update-service-status-ajax',
                    data: { 
                            service_id: service_id,
                            status: status
                          },

                    success: function (response) 
                    {
                        location.reload();	
                    }
                });
	}
</script>
</html>