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
                            <form class="form-horizontal" method="post" action="<?php echo base_admin_url() . 'update-admin-password'; ?>">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="old_pass" class="col-sm-3 text-right control-label col-form-label">Old Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Old Password..." required>
                                            <label id="chk_old_pass" style="display: none;"></label>
                                            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('userid'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_pass" class="col-sm-3 text-right control-label col-form-label">New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="New Password..." required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="conf_pass" class="col-sm-3 text-right control-label col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="conf_pass" name="conf_pass" placeholder="Confirm Password..." required>
                                            <label id="chk_conf_pass" style="display: none;"></label>
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
        $(document).on('keyup', '#old_pass', function () {
            var BASE_URL    = "<?php echo base_admin_url();?>";
            var old_pass    = $('#old_pass').val();

            if (old_pass != '') 
            {
                $.ajax({
                    type: "POST",
                    url: BASE_URL + 'verify-old-password',
                    data: {
                        old_pass: old_pass
                    },

                    success: function (d) {
                        console.log(d);
                        if (d.user_exists == 1) 
                        {
                            $('#chk_old_pass').show();
                            $('#chk_old_pass').html('<i class="icofont-close-squared-alt"></i> ' + d.out_message);
                            $("#chk_old_pass").css("color", "red");
                            $('.user_btn_submit').attr("disabled", true);
                            return false;
                        } 
                        else 
                        {
                            $('#chk_old_pass').show();
                            $('#chk_old_pass').html('<i class="icofont-tick-boxed"></i> ' + d.out_message);
                            $("#chk_old_pass").css("color", "green");
                            $('.user_btn_submit').attr("disabled", false);
                        }
                    }
                });
            }
            else 
            {
                $('#chk_old_pass').hide();
            }
        });

        $(document).on('keyup', '#conf_pass', function () {
            var new_pass    = $('#new_pass').val();
            var conf_pass   = $('#conf_pass').val();

            if (conf_pass != '') 
            {
                if(new_pass != '')
                {    
                    if(new_pass == conf_pass)
                    {
                        $('#chk_conf_pass').show();
                        $('#chk_conf_pass').html('<i class="icofont-tick-boxed"></i> Password Matched');
                        $("#chk_conf_pass").css("color", "green");
                        $('.user_btn_submit').attr("disabled", false);
                    } 
                    else
                    {
                        $('#chk_conf_pass').show();
                        $('#chk_conf_pass').html('<i class="icofont-close-squared-alt"></i> Password Mis-Matched');
                        $("#chk_conf_pass").css("color", "red");
                        $('.user_btn_submit').attr("disabled", true);
                        return false;
                    } 
                }
                else 
                {
                    $('#chk_conf_pass').show();
                    $('#chk_conf_pass').html('<i class="icofont-close-squared-alt"></i> Please enter new Password');
                    $("#chk_conf_pass").css("color", "red");
                    $('.user_btn_submit').attr("disabled", true);
                    return false;
                }      
            } 
            else 
            {
                $('#chk_conf_pass').hide();
            }
        });
    </script>
</body>

</html>