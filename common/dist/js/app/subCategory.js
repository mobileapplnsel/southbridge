$(document).ready(function () {
    $(document).on('keyup', '#category_name', function () {
        var category_name = $('#category_name').val();
        if (category_name != '') 
        {
            $.ajax({
                        type: "POST",
                        url: BASE_URL + 'duplicate_category_check_un',
                        data: { 
                                category_name: category_name
                              },

                        success: function (d) 
                        {
                            if (d.user_exists == 1) 
                            {
                                $('#chk_category_name').show();
                                $('#chk_category_name').html('<i class="icofont-close-squared-alt"></i> ' + d.out_message);
                                $("#chk_category_name").css("color", "red");
                                $('.user_btn_submit').attr("disabled", true);
                                return false;
                            } 
                            else if (d.user_exists == 3) 
                            {
                                $('#chk_category_name').show();
                                $('#chk_category_name').html('<i class="icofont-close-squared-alt"></i> ' + d.out_message);
                                $("#chk_category_name").css("color", "red");
                                $('.user_btn_submit').attr("disabled", true);
                            } 
                            else 
                            {
                                $('#chk_category_name').show();
                                $('#chk_category_name').html('<i class="icofont-tick-boxed"></i> ' + d.out_message);
                                $("#chk_category_name").css("color", "green");
                                $('.user_btn_submit').attr("disabled", false);
                            }
                        }
                    });
        } 
        else 
        {
            $('#chk_category_name').hide();
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

                    url: BASE_URL + 'delete-sub-category',

                    data: { cat_id: user_id },

                    success: function (d) {

                        if (d.deleted == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Category deleted!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                            window.location.reload();

                        }
                        else if (d.deleted == 'not_exists') {

                            Swal.fire({
                                icon: 'error',
                                title: 'Category not exists!',
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