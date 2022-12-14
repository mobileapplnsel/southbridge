<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $this->load->view('admin/top_css'); ?>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'common/assets/extra-libs/multicheck/multicheck.css'; ?>">
    <link href="<?php echo base_url() . 'common/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'; ?>" rel="stylesheet">
    <title><?php echo comp_name; ?> | <?php echo $page_title; ?></title>
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
                        <h4 class="page-title"><?php echo $page_title; ?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
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
                            <form class="form-horizontal" method="post" action="<?php echo base_admin_url() . 'update-admin-profile'; ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="full_name" class="col-sm-3 text-right control-label col-form-label">Full Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $admin_data->full_name; ?>" placeholder="Full Name.." required>
                                            <input type="hidden" name="user_id" value="<?php echo $admin_data->user_id; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="full_name" class="col-sm-3 text-right control-label col-form-label">Company Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $admin_data->company_name; ?>" placeholder="Company Name.." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="full_name" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $admin_data->user_name; ?>" placeholder="Email.." required>
                                            <label id="chk_username" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="full_name" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $admin_data->phone; ?>" placeholder="Phone.." onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required>
                                            <label id="chk_phone" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="full_name" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="address" name="address" placeholder="Address.." required><?php echo $admin_data->address; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" id="user_btn_submit" class="btn btn-primary user_btn_submit" >Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('admin/footer'); ?>
        </div>
    </div>
    <?php $this->load->view('admin/bottom_js'); ?>
    <script src="<?php echo base_url() . 'common/assets/extra-libs/multicheck/datatable-checkbox-init.js'; ?>"></script>
    <script src="<?php echo base_url() . 'common/assets/extra-libs/multicheck/jquery.multicheck.js'; ?>"></script>
    <script src="<?php echo base_url() . 'common/assets/extra-libs/DataTables/datatables.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'common/dist/js/app/users.js?v=' . random_strings(6); ?>"></script>
    <script type="text/javascript">
        $(document).on('keyup', '#email', function () {
            var username    = $('#email').val();

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
            var phone   = $('#phone').val();

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