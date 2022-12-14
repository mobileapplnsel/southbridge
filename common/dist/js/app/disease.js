$(document).ready(function () {
    $(document).on('change', '#category_name', function () {

        var category_name   = $('#category_name').val();
        var disease_name    = $('#disease_name').val();

        if (category_name != '') 
        {
            $('#chk_category_name').show();
            $('#chk_category_name').html('<i class="icofont-tick-boxed"></i> OK');
            $("#chk_category_name").css("color", "green");
            $('.user_btn_submit').attr("disabled", false);
        } 
        else 
        {
            $('#chk_category_name').show();
            $('#chk_category_name').html('<i class="icofont-close-squared-alt"></i> Please Select Any Category');
            $("#chk_category_name").css("color", "red");
            $('.user_btn_submit').attr("disabled", true);
        }

        if (disease_name != '' && category_name != '') 
        {
            $('.user_btn_submit').attr("disabled", false);
        } 
        else 
        {
            $('.user_btn_submit').attr("disabled", true);
        }
    });

    $(document).on('keyup', '#disease_name', function () {

        var category_name   = $('#category_name').val();
        var disease_name    = $('#disease_name').val();

        if (disease_name != '') 
        {
            $('#chk_disease_name').show();
            $('#chk_disease_name').html('<i class="icofont-tick-boxed"></i> OK');
            $("#chk_disease_name").css("color", "green");
            $('.user_btn_submit').attr("disabled", false);
        } 
        else 
        {
            $('#chk_disease_name').show();
            $('#chk_disease_name').html('<i class="icofont-close-squared-alt"></i> Please Emter Disease Name');
            $("#chk_disease_name").css("color", "red");
            $('.user_btn_submit').attr("disabled", true);
        }

        if (disease_name != '' && category_name != '') 
        {

            $('.user_btn_submit').attr("disabled", false);
        } 
        else 
        {
            $('.user_btn_submit').attr("disabled", true);
        }
    });

    $(document).on('click', '.del_user', function () {

        var user_id = $(this).attr('data-userid');
        var fullname = $(this).attr('data-fullname');


        Swal.fire({
            title: "Are you sure?",
            text: fullname + " Will Be Deleted Parmanently!",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((willDelete) => {
            if (willDelete.isConfirmed == true) {
                $.ajax({

                    type: 'POST',

                    url: BASE_URL + 'delete-disease',

                    data: { dis_id: user_id },

                    success: function (d) {

                        if (d.deleted == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Disease deleted!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                            window.location.reload();

                        }
                        else if (d.deleted == 'not_exists') {

                            Swal.fire({
                                icon: 'error',
                                title: 'Disease not exists!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                        }

                    }

                });
            } else {
                //Swal.fire("Okay!");
            }
        });

    });

    $(document).on('click', '.del_disease_sol', function () {

        var user_id = $(this).attr('data-userid');
        var fullname = $(this).attr('data-fullname');


        Swal.fire({
            title: "Are you sure?",
            text: fullname + " Will Be Deleted Parmanently!",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((willDelete) => {
            if (willDelete.isConfirmed == true) {
                $.ajax({

                    type: 'POST',

                    url: BASE_URL + 'delete-disease-sol',

                    data: { dis_sol_id: user_id },

                    success: function (d) {

                        if (d.deleted == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Disease Solution deleted!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                            window.location.reload();

                        }
                        else if (d.deleted == 'not_exists') {

                            Swal.fire({
                                icon: 'error',
                                title: 'Disease Solution not exists!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                        }

                    }

                });
            } else {
                //Swal.fire("Okay!");
            }
        });

    });

    $(document).on('keyup', '#disease_sol_name', function () {

        var disease_sol_name            = $('#disease_sol_name').val();
        var disease_sol_protocol        = $('#disease_sol_protocol').val();

        if (disease_sol_name != '') 
        {
            $('#chk_disease_sol_name').show();
            $('#chk_disease_sol_name').html('<i class="icofont-tick-boxed"></i> OK');
            $("#chk_disease_sol_name").css("color", "green");
            $('.user_btn_submit').attr("disabled", false);
        } 
        else 
        {
            $('#chk_disease_sol_name').show();
            $('#chk_disease_sol_name').html('<i class="icofont-close-squared-alt"></i> Please Emter Disease Solution Name');
            $("#chk_disease_sol_name").css("color", "red");
            $('.user_btn_submit').attr("disabled", true);
        }

        if (disease_sol_name != '' && disease_sol_protocol != '') 
        {

            $('.user_btn_submit').attr("disabled", false);
        } 
        else 
        {
            $('.user_btn_submit').attr("disabled", true);
        }
    });

    $(document).on('keyup', '#disease_sol_protocol', function () {

        var disease_sol_name            = $('#disease_sol_name').val();
        var disease_sol_protocol        = $('#disease_sol_protocol').val();

        if (disease_sol_protocol != '') 
        {
            $('#chk_disease_sol_protocol').show();
            $('#chk_disease_sol_protocol').html('<i class="icofont-tick-boxed"></i> OK');
            $("#chk_disease_sol_protocol").css("color", "green");
            $('.user_btn_submit').attr("disabled", false);
        } 
        else 
        {
            $('#chk_disease_sol_protocol').show();
            $('#chk_disease_sol_protocol').html('<i class="icofont-close-squared-alt"></i> Please Emter Disease Solution Protocol');
            $("#chk_disease_sol_protocol").css("color", "red");
            $('.user_btn_submit').attr("disabled", true);
        }

        if (disease_sol_name != '' && disease_sol_protocol != '') 
        {

            $('.user_btn_submit').attr("disabled", false);
        } 
        else 
        {
            $('.user_btn_submit').attr("disabled", true);
        }
    });

    $(document).on('change', '#disease_sol_protocol_img', function () {

        var disease_sol_name            = $('#disease_sol_name').val();
        var disease_sol_protocol        = $('#disease_sol_protocol').val();
        var disease_sol_protocol_img    = $('#disease_sol_protocol_img').val();

        if (disease_sol_protocol_img != '') 
        {
            var fileUpload          = document.getElementById("disease_sol_protocol_img");
            var ext                 = fileUpload.value.split('.'); 
            var allowedExtensions   = ["img","jpg","jpeg","IMG","JPG","JPEG"];

            if(allowedExtensions.includes(ext[ext.length-1]) == false)
            {
                $('#chk_disease_sol_protocol_img').show();
                $('#chk_disease_sol_protocol_img').html('<i class="icofont-close-squared-alt"></i> Invalid File Type. Allowed File Types (img,IMG,jpg,JPG,jpeg,JPEG)');
                $("#chk_disease_sol_protocol_img").css("color", "red");
                $('.user_btn_submit').attr("disabled", true);
            }  
            else 
            {
                $('#chk_disease_sol_protocol_img').show();
                $('#chk_disease_sol_protocol_img').html('<i class="icofont-tick-boxed"></i> OK');
                $("#chk_disease_sol_protocol_img").css("color", "green");
                $('.user_btn_submit').attr("disabled", false);
            }    
        } 


        if (disease_sol_name != '' && disease_sol_protocol != '') 
        {

            $('.user_btn_submit').attr("disabled", false);
        } 
        else 
        {
            $('.user_btn_submit').attr("disabled", true);
        }
    });
});