$(document).ready(function () {
    $(document).on('click', '.del_user', function () {

        var user_id = $(this).attr('data-userid');
        var fullname = $(this).attr('data-fullname');


        Swal.fire({
            title: "Are you sure?",
            text: fullname + " will be deleted parmanently!",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((willDelete) => {
            if (willDelete.isConfirmed == true) {
                $.ajax({

                    type: 'POST',

                    url: BASE_URL + 'deluser',

                    data: { userid: user_id },

                    success: function (d) {

                        if (d.deleted == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'User deleted!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                            window.location.reload();

                        }
                        else if (d.deleted == 'not_exists') {

                            Swal.fire({
                                icon: 'error',
                                title: 'User not exists!',
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

    $(document).on('keyup', '#user_name', function () {
        var username = $('#user_name').val();
        if (username != '') {
            $.ajax({
                type: "POST",
                url: BASE_URL + 'duplicate_check_un',
                data: {
                    user_name: username
                },

                success: function (d) {
                    if (d.user_exists == 1) {
                        $('#chk_username').show();
                        $('#chk_username').html('<i class="icofont-close-squared-alt"></i> ' + d.out_message);
                        $("#chk_username").css("color", "red");
                        $('.user_btn_submit').attr("disabled", true);
                        return false;
                    } else if (d.user_exists == 3) {
                        $('#chk_username').show();
                        $('#chk_username').html('<i class="icofont-close-squared-alt"></i> ' + d.out_message);
                        $("#chk_username").css("color", "red");
                        $('.user_btn_submit').attr("disabled", true);
                    } else {
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

    $('#create_user_form2').validate({
        rules: {
            full_name: {
                required: true,
            },
            user_name: {
                required: true,
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 16,
                pwcheck: true
            }
        },
        messages: {
            full_name: {
                required: 'Please enter your full name',
            },
            user_name: {
                required: 'Please enter your username',
            },
            password: {
                required: 'Please enter your password',
                minlength: 'Minimum 8 characters required',
                maxlength: 'Maximum 16 characters allowed'
            }
        },
        errorPlacement: function (error, element) {
            error.insertBefore(element);
        },
        submitHandler: function (f) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'createuser',
                cache: false,
                data: $('#create_user_form').serialize(),
                beforeSend: function () {
                    $('#user_btn_submit').html('Creating..').prop('disabled', true);
                },
                success: function (d) {
                    if (d.user_added == 'rule_error') {

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: d.errors,
                            confirmButtonText: 'Close',
                            confirmButtonColor: '#d33',
                            allowOutsideClick: false,
                        });
                        $('#user_btn_submit').html('Submit').prop('disabled', false);

                    } else if (d.user_added == 'success') {

                        Swal.fire({
                            icon: 'success',
                            title: 'User added!',
                            confirmButtonText: 'Close',
                            confirmButtonColor: '#d33',
                            allowOutsideClick: false,
                        });
                        window.location.reload();

                    } else if (d.user_added == 'already_exists') {

                        Swal.fire({
                            icon: 'error',
                            title: 'User already exists!',
                            confirmButtonText: 'Close',
                            confirmButtonColor: '#d33',
                            allowOutsideClick: false,
                        });
                        $('#user_btn_submit').html('Submit').prop('disabled', false);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            confirmButtonText: 'Close',
                            confirmButtonColor: '#d33',
                            allowOutsideClick: false,
                        });
                        $('#user_btn_submit').html('Submit').prop('disabled', false);
                    }
                }
            });
        }
    });

    $("#create_user_form").submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'createuser',
            cache: false,
            data: $('#create_user_form').serialize(),
            beforeSend: function () {
                $('#user_btn_submit').html('Creating..').prop('disabled', true);
            },
            success: function (d) {
                //alert(d.user_added);
                if (d.user_added == "rule_error") {

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: d.errors,
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });
                    $('#user_btn_submit').html('Submit').prop('disabled', false);

                } else if (d.user_added == 'success') {

                    Swal.fire({
                        icon: 'success',
                        title: 'User added!',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });

                    setTimeout(function () {
                        window.location.reload();
                    }, 100);

                } else if (d.user_added == 'already_exists') {

                    Swal.fire({
                        icon: 'error',
                        title: 'User already exists!',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });
                    $('#user_btn_submit').html('Submit').prop('disabled', false);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });
                    $('#user_btn_submit').html('Submit').prop('disabled', false);
                }
            }
        });

    });


    $(document).on('click', '.generate_pass', function makeid() {
        var text = "";

        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 10; i++)

            text += possible.charAt(Math.floor(Math.random() * possible.length));

        $('#password').val(text);
    });

    $(document).on('change','#country', function(){
        var selectedCountry = $("#country").val();
        $.ajax({
            type: "POST",
            url: BASE_URL + 'get_states',
            data: {
                selectedCountry: selectedCountry
            },
        }).done(function(data){
            var newArr = [];
            for(var i = 0; i < data.length; i++)
            {
                newArr = newArr.concat(data[i]);
            }

            var selectElem = $("#state");
            selectElem.html('<option value="">Select State</option>');
            $.each(newArr, function(index){
              $("<option/>", {
                      value: newArr[index].id,
                      text: newArr[index].name
                  }).appendTo(selectElem);
            });
            
            $('#city').html('');
            $("#city").html('<option value="">Select City</option>');
        });
    });

    $(document).on('change','#state', function(){
        var state = $("#state").val();
        $.ajax({
            type: "POST",
            url: BASE_URL + 'get_cities',
            data: {
                state: state
            },
        }).done(function(data){
            var newArr = [];
            for(var i = 0; i < data.length; i++)
            {
                newArr = newArr.concat(data[i]);
            }

            var selectElem = $("#city");
            selectElem.html('<option value="">Select City</option>');
            $.each(newArr, function(index){
              $("<option/>", {
                      value: newArr[index].id,
                      text: newArr[index].name
                  }).appendTo(selectElem);
            });
        });
    });

    $(document).on('blur','#gst_no', function() {
        var gst_no          = $("#gst_no").val().toUpperCase();
        var gstinformat     = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9]{1}Z[a-zA-Z0-9]{1}$');

        if(gst_no != '')
        {
            if (!gstinformat.test(gst_no)) 
            {    
                $('#err_gst').show();
                $("#gst_no").focus(); 
                $('#user_btn_submit').html('Submit').prop('disabled', true);
            } 
            else 
            {    
                $('#err_gst').hide();  
                $('#user_btn_submit').html('Submit').prop('disabled', false);
            }
        } 
        else
        {
            $('#err_gst').hide();  
            $('#user_btn_submit').html('Submit').prop('disabled', false);
        }   
    });

    $(document).on('blur','#pan_no', function() {
        var pan_no          = $("#pan_no").val().toUpperCase();
        var panformat     = new RegExp('[A-Z]{5}[0-9]{4}[A-Z]{1}');

        if(pan_no != '')
        {
            if (!panformat.test(pan_no)) 
            {    
                $('#err_pan').show();
                $("#pan_no").focus(); 
                $('#user_btn_submit').html('Submit').prop('disabled', true);
            } 
            else 
            {    
                $('#err_pan').hide();  
                $('#user_btn_submit').html('Submit').prop('disabled', false);
            }
        } 
        else
        {
            $('#err_pan').hide();  
            $('#user_btn_submit').html('Submit').prop('disabled', false);
        }   
    });

    $(document).on('change','#user_category', function(){
        var user_category = $("#user_category").val();

        if(user_category == '3')
        {
            $('#sub_user_category').show();
        } 
        else 
        {
            $('#sub_user_category').hide();
            $('#local').prop('checked', true);
            $("#international").prop("checked", false);
        }   
        
    });
});