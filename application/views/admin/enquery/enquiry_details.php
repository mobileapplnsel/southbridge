<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('admin/top_css'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/extra-libs/multicheck/multicheck.css'; ?>">
	<link href="<?php echo base_url() . 'common/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'; ?>" rel="stylesheet">
	<title><?php echo comp_name; ?> | Enquery Details</title>
</head>

<body>
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<div id="main-wrapper">
		<?php $this->load->view('admin/header_main'); ?>
		<?php $this->load->view('admin/sidebar_main'); ?>
		<div class="page-wrapper">
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-12 d-flex no-block align-items-center">
						<h4 class="page-title">Enquery Details</h4>
						<div class="ml-auto text-right">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"> Enquery Details</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Comments List </h5>
								<div class="table-responsive">
									<table id="zero_config" class="table table-striped table-bordered">
										<thead>
											<tr class="textcen">
												<th>Sl</th>
												<th>User Name</th>
												<th>Comment</th>
												<th>Image</th>
												<th>Created Date</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody class="textcen">
											<?php
											if (!empty($enquiry_data['comments'])) 
											{
												$sl = 1;

												foreach ($enquiry_data['comments'] as $key => $val) 
												{

											?>
													<tr>
														<td><?php echo $sl; ?></td>
														<td><?php echo $val['full_name']; ?></td>
														<td><?php echo $val['comment']; ?></td>
														<td>
															<a href="<?php echo base_url('uploads/comment_doc/').$val['comment_image']; ?>" target="_blank">
																<img style="width: 30%;" src="<?php echo base_url('uploads/comment_doc/').$val['comment_image']; ?>">
															</a>
														</td>
														<td><?php echo date('d-m-Y h:i A',strtotime($val['created_date'])); ?></td>
														<td>
															<select class="form-control" id="cat_status<?php echo $sl; ?>" name="cat_status<?php echo $sl; ?>" onchange="updateCommentStatusAjax(<?php echo $sl.','.$val['id']; ?>);">
																<option value="1" <?php if($val['status'] == '1'){ echo "selected";}?>>Active</option>
																<option value="0" <?php if($val['status'] == '0'){ echo "selected";}?>>Inactive</option>
															</select>
														</td>
													</tr>
											<?php
													$sl++;
												}
											} 
											else 
											{
											?>
												<tr>
													<td colspan="7">No data found</td>
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
	function updateCommentStatusAjax(counter,comment_id) 
	{
		var status = $('#cat_status'+counter).val();
		$.ajax({
                    type: "POST",
                    url: BASE_URL + 'update-comment-status-ajax',
                    data: { 
                            comment_id: comment_id,
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