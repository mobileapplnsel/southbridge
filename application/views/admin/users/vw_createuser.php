<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('admin/top_css'); ?>
	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/extra-libs/multicheck/multicheck.css'; ?>">
	<link href="<?php echo base_url() . 'common/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'; ?>" rel="stylesheet">
	<style type="text/css">
		.err_msg{
			font-weight: 700;
		    font-size: smaller;
		    color: red;
		}
	</style>
	<title><?php echo comp_name; ?> | Add User</title>
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
						<h4 class="page-title">Add User</h4>
						<div class="ml-auto text-right">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add User</li>
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
							<?php
							if (isset($update_success) && $update_success != '') {
								echo "<p><i class=\"icofont-tick-boxed\" style=\"color:green\"></i> Status: " . $update_success . "</p>";
							} elseif (isset($update_failure) && $update_failure != '') {
								echo "<p><i class=\"fas fa-exclamation-triangle\" style=\"color:yellow\"></i> Error: " . $update_failure . "</p>";
							} else {
								//echo "<p style='color:#f5f2f0'><i class=\"fas fa-exclamation-triangle\" style=\"color:yellow\"></i> Something went wrong!</p>";
							}
							?>
							<form class="form-horizontal" id="create_user_form">
								<?php //print_obj($user_data);die; 
								?>
								<div class="card-body">
									<h4 class="card-title">Create New User <button type="button" class="btn badge badge-pill badge-success" onclick="location.href='<?php echo base_admin_url() . 'users'; ?>'">Users List</button></h4>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">Full Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name.." required>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">Company Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name.." required>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">Email</label>
										<div class="col-sm-9">
											<input type="email" class="form-control" id="email" name="email" placeholder="Email.." required>
											<label id="chk_username" style="display: none;"></label>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">Phone</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone.." onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required>
											<label id="chk_phone" style="display: none;"></label>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">Address</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="address" name="address" placeholder="Address.." required></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="user_group" class="col-sm-3 text-right control-label col-form-label" >Country</label>
										<div class="col-sm-9">
											<select class="form-control" id="country" name="country" required>
												<?php 
													if(!empty($all_countries))
													{
												?>
														<option value="">Select Country</option>
												<?php 		
														foreach ($all_countries as $key => $country) 
														{
												?>
															<option value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
												<?php 
														}	
													}
													else 
													{
												?>
														<option value="">No Country Found</option>
												<?php 		
													}	
												?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="user_group" class="col-sm-3 text-right control-label col-form-label">State</label>
										<div class="col-sm-9">
											<select class="form-control" id="state" name="state" required>
												<option value="">Select State</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="user_group" class="col-sm-3 text-right control-label col-form-label">City</label>
										<div class="col-sm-9">
											<select class="form-control" id="city" name="city" required>
												<option value="">Select City</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">PIN Code</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="pin_code" name="pin_code" placeholder="PIN Code .." onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">IEC No</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="iec_no" name="iec_no" placeholder="IEC No.." required>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">GSTIN No</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="GSTIN No.." required>
											<span class="err_msg" id="err_gst" style="display: none;">GSTIN No format dose not match</span>
										</div>
									</div>
									<div class="form-group row">
										<label for="full_name" class="col-sm-3 text-right control-label col-form-label">PAN No</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="pan_no" name="pan_no" placeholder="PAN No.." required>
											<span class="err_msg" id="err_pan" style="display: none;">PAN No format dose not match</span>
										</div>
									</div>
									<div class="form-group row">
										<label for="password" class="col-sm-3 text-right control-label col-form-label">Password</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="password" name="password" placeholder="Password.." required>
										</div>
										<div class="col-sm-2">
											<button type="button" class="btn btn-success generate_pass">Generate</button>
										</div>
									</div>
									<div class="form-group row">
										<label for="user_group" class="col-sm-3 text-right control-label col-form-label">User Category</label>
										<div class="col-sm-9">
											<select class="form-control" id="user_category" name="user_category" required>
												<?php 
													if(!empty($all_user_category))
													{
												?>
														<option value="">Select Category</option>
												<?php 		
														foreach ($all_user_category as $key => $user_category) 
														{
												?>
															<option value="<?php echo $user_category->id;?>"><?php echo $user_category->category_name;?></option>
												<?php 
														}	
													}
													else 
													{
												?>
														<option value="">No Category Found</option>
												<?php 		
													}	
												?>
											</select>
										</div>
									</div>
									<div class="form-group row" id="sub_user_category" style="display: none;">
										<label for="password" class="col-sm-3 text-right control-label col-form-label">User Sub category</label>
										<div class="col-sm-6">
											<input type="radio" class="form-control" name="sub_category" value="0" required> Local <input type="radio" class="form-control" name="sub_category" value="1" required> International
										</div>
									</div>
								</div>
								<div class="border-top">
									<div class="card-body">
										<button type="submit" id="user_btn_submit" class="btn btn-primary user_btn_submit" disabled>Submit</button>
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
	<script src="<?php echo base_url() . 'common/dist/js/app/users.js?v=' . random_strings(6); ?>"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#country').select2();
		    $('#state').select2();
		    $('#city').select2();
		});

		$(document).on('keyup', '#email', function () {
	        var username 	= $('#email').val();

	        if (username != '') {
	            $.ajax({
	                type: "POST",
	                url: BASE_URL + 'duplicate_check_un',
	                data: {
	                    user_name: username
	                },

	                success: function (d) {
	                	console.log(d);
	                    if (d.user_exists == 1) 
	                    {
	                        $('#chk_username').show();
	                        $('#chk_username').html('<i class="icofont-close-squared-alt"></i> ' + d.out_message);
	                        $("#chk_username").css("color", "red");
	                        $('.user_btn_submit').attr("disabled", true);
	                        return false;
	                    } 
	                    else if (d.user_exists == 3) 
	                    {
	                        $('#chk_username').show();
	                        $('#chk_username').html('<i class="icofont-close-squared-alt"></i> ' + d.out_message);
	                        $("#chk_username").css("color", "red");
	                        $('.user_btn_submit').attr("disabled", true);
	                    } 
	                    else 
	                    {
	                        $('#chk_username').show();
	                        $('#chk_username').html('<i class="icofont-tick-boxed"></i> ' + d.out_message);
	                        $("#chk_username").css("color", "green");
	                        $('.user_btn_submit').attr("disabled", false);
	                    }
	                }
	            });
	        } else {
	            $('#chk_username').hide();
	        }
	    });

	    $(document).on('keyup', '#phone', function () {
	        var phone 	= $('#phone').val();

	        if (phone != '') {
	            $.ajax({
	                type: "POST",
	                url: BASE_URL + 'duplicate_check_phone',
	                data: {
	                    phone: phone
	                },

	                success: function (d) {
	                	console.log(d);
	                    if (d.user_exists == 1) 
	                    {
	                        $('#chk_phone').show();
	                        $('#chk_phone').html('<i class="icofont-close-squared-alt"></i> ' + d.out_message);
	                        $("#chk_phone").css("color", "red");
	                        $('.user_btn_submit').attr("disabled", true);
	                        return false;
	                    } 
	                    else if (d.user_exists == 3) 
	                    {
	                        $('#chk_phone').show();
	                        $('#chk_phone').html('<i class="icofont-close-squared-alt"></i> ' + d.out_message);
	                        $("#chk_phone").css("color", "red");
	                        $('.user_btn_submit').attr("disabled", true);
	                    } 
	                    else 
	                    {
	                        $('#chk_phone').show();
	                        $('#chk_phone').html('<i class="icofont-tick-boxed"></i> ' + d.out_message);
	                        $("#chk_phone").css("color", "green");
	                        $('.user_btn_submit').attr("disabled", false);
	                    }
	                }
	            });
	        } else {
	            $('#chk_phone').hide();
	        }
	    });
	</script>
</body>

</html>