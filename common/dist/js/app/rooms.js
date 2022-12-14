$(document).ready(function () {
    $(document).on('click', '.del_row', function () {

        var delid = $(this).attr('data-delid');
        var rowname = $(this).attr('data-rowname');


        Swal.fire({
            title: "Are you sure?",
            text: rowname + " will be deleted parmanently!",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((willDelete) => {
            if (willDelete.isConfirmed == true) {
                $.ajax({

                    type: 'POST',

                    url: BASE_URL + 'delroom',

                    data: { delid: delid },

                    success: function (d) {

                        if (d.deleted == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Room deleted!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                            window.location.reload();

                        }
                        else if (d.deleted == 'not_exists') {

                            Swal.fire({
                                icon: 'error',
                                title: 'Room not exists!',
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

    $(document).on('keyup', '#name', function () {
        var name = $('#name').val();
        if (name != '') {
            $.ajax({
                type: "POST",
                url: BASE_URL + 'duplicate_check_room',
                data: {
                    name: name
                },

                success: function (d) {
                    if (d.if_exists == 1) {
                        $('#chk_name').show();
                        $('#chk_name').html('<i class="icofont-close-squared-alt"></i> Room already exists..!!');
                        $("#chk_name").css("color", "red");
                        return false;
                    } else {
                        $('#chk_name').show();
                        $('#chk_name').html('<i class="icofont-tick-boxed"></i> Room available.');
                        $("#chk_name").css("color", "green");
                    }
                }
            });

        } else {
            $('#chk_name').hide();
        }

    });



    $('#create_customer_form2').validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
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
            first_name: {
                required: 'Please enter your full name',
            },
            last_name: {
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
                data: $('#create_customer_form').serialize(),
                beforeSend: function () {
                    $('#customer_btn_submit').html('Creating..').prop('disabled', true);
                },
                success: function (d) {
                    if (d.added == 'rule_error') {

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: d.errors,
                            confirmButtonText: 'Close',
                            confirmButtonColor: '#d33',
                            allowOutsideClick: false,
                        });
                        $('#customer_btn_submit').html('Submit').prop('disabled', false);

                    } else if (d.added == 'success') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Customer added!',
                            confirmButtonText: 'Close',
                            confirmButtonColor: '#d33',
                            allowOutsideClick: false,
                        });
                        window.location.reload();

                    } else if (d.added == 'already_exists') {

                        Swal.fire({
                            icon: 'error',
                            title: 'Customer already exists!',
                            confirmButtonText: 'Close',
                            confirmButtonColor: '#d33',
                            allowOutsideClick: false,
                        });
                        $('#customer_btn_submit').html('Submit').prop('disabled', false);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            confirmButtonText: 'Close',
                            confirmButtonColor: '#d33',
                            allowOutsideClick: false,
                        });
                        $('#customer_btn_submit').html('Submit').prop('disabled', false);
                    }
                }
            });
        }
    });

    $("#create_form").submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'createroom',
            cache: false,
            data: $('#create_form').serialize(),
            beforeSend: function () {
                $('#btn_submit').html('Creating..').prop('disabled', true);
            },
            success: function (d) {
                if (d.added == "rule_error") {

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: d.errors,
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });
                    $('#btn_submit').html('Submit').prop('disabled', false);

                } else if (d.added == 'success') {

                    Swal.fire({
                        icon: 'success',
                        title: 'Room added!',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });

                    setTimeout(function () {
                        window.location.reload();
                    }, 100);

                } else if (d.added == 'already_exists') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Room already exists!',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });
                    $('#btn_submit').html('Submit').prop('disabled', false);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });
                    $('#btn_submit').html('Submit').prop('disabled', false);
                }
            }
        });

    });

    $(document).on('click', '.del_img', function () {

        var delid = $(this).attr('data-delid');
        var rowname = $(this).attr('data-rowname');


        Swal.fire({
            title: "Are you sure?",
            text: rowname + " will be deleted parmanently!",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((willDelete) => {
            if (willDelete.isConfirmed == true) {
                $.ajax({

                    type: 'POST',

                    url: BASE_URL + 'delroomimg',

                    data: { delid: delid },

                    success: function (d) {

                        if (d.deleted == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Image deleted!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                            window.location.reload();

                        }
                        else if (d.deleted == 'not_exists') {

                            Swal.fire({
                                icon: 'error',
                                title: 'Image not exists!',
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


    $(document).on('click', '.del_avl', function () {

        var delid = $(this).attr('data-delid');
        var rowname = $(this).attr('data-rowname');


        Swal.fire({
            title: "Are you sure?",
            text: rowname + " will be deleted parmanently!",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((willDelete) => {
            if (willDelete.isConfirmed == true) {
                $.ajax({

                    type: 'POST',

                    url: BASE_URL + 'delroomavl',

                    data: { delid: delid },

                    success: function (d) {

                        if (d.deleted == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Availability deleted!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                            window.location.reload();

                        }
                        else if (d.deleted == 'not_exists') {

                            Swal.fire({
                                icon: 'error',
                                title: 'Availability not exists!',
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

});