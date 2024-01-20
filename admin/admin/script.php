<script> 


    $(document).on('submit', '#save_admin', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("Save_Admin", true);
        $.ajax({
            type: "post",
            url: "code.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    $('#errorMessage').removeClass('d-none');
                    $('#errorMessage').text(res.message);

                } else if (res.status == 200) {
                    $('#errorMessage').addClass('d-none');
                    $('#adminmodal').modal('hide');
                    $('#save_admin')[0].reset();

                    alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable"); 
                    window.onload = function() {
                        setTimeout(function() {
                        }, 2000);
                    };

                }
            }
        });


    });

    $(document).on('click', '.editAdminbtn', function() {
        var admin_id = $(this).val();

        $.ajax({
            type: 'GET',
            url: "code.php?admin_id=" + admin_id,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $('#admin_id').val(res.data.id);
                    $('#name').val(res.data.name);
                    $('#username').val(res.data.username);
                    $('#password').val(res.data.password);

                    $('#adminEditmodal').modal('show'); 

                }
            }
        });
    });

    $(document).on('submit', '#update_admin', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("updateadmin", true);
        $.ajax({
            type: "post",
            url: "code.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    $('#errorMessageUpdate').removeClass('d-none');
                    $('#errorMessageUpdate').text(res.message);

                } else if (res.status == 200) {
                    $('#errorMessageUpdate').addClass('d-none');
                    $('#adminEditmodal').modal('hide');
                    $('#update_admin')[0].reset();

                    $('#myTable').load(location.href + " #myTable"); 

                     window.onload = function() {
                    setTimeout(function() {
                    }, 2000);
                };

                }
            }
        });


    });

    $(document).on('click', '.deleteAdminbtn ', function(e) {
                e.preventDefault();
                var admin_id = $(this).val();
         alertify.confirm('Archive', 'Are you sure you want  to Archive this data?',
            function() {
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_admin': true,
                        'admin_id': admin_id
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                   
                    }

               
                });
                alertify.success("Archive Admin Successfully"); 
                setTimeout(() => {
                        location.href = "./admin-user.php"
                       }, 1000);   
            },
            function() {
                alertify.error('Cancel')
            });


    }); 



    $(document).on('click', '.restoreAdminbtn  ', function(e) {
                e.preventDefault();
                var admin_id = $(this).val();
         alertify.confirm('Restore', 'Are you sure you to Restore this data?',
            function() {
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'restore_admin': true,
                        'admin_id': admin_id
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        $('#myTable').load(location.href + " #myTable");
                    }

               
                });
                alertify.success("Restore Admin Successfully"); 
                setTimeout(() => {
                        location.href = "./archive.php"
                       }, 1000);   
            },
            function() {
                alertify.error('Cancel')
            });


    });
</script>