<script>
    $(document).on('click', '.editAdminbtn', function() {
        var admin_id = $(this).val();

        $.ajax({
            type: 'GET',
            url: "code.php?user_id=" + admin_id,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    alert(res.message);
                } else if (res.status == 200) { 
                    $('#users_id').val(res.data.id);
                    $('#fname').val(res.data.firstname);
                    $('#mname').val(res.data.middlename);
                    $('#lname').val(res.data.lastname);

                    $('#adminEditmodal').modal('show');

                }
            }
        });
    });

    $(document).on('submit', '#update_users', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_users", true);
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
                    $('#update_users')[0].reset();
                    alertify.success("User Successfully updated"); 
                   //('#myTable').load(location.href + " #myTable");  
                   setTimeout(() => {
                        location.href = "./user_account.php"
                       }, 1000); 
                    
                } 
                
            }
        });


    });

    $(document).on('click', '.deleteUserbtn ', function(e) {
                e.preventDefault();
                var user_id = $(this).val();
         alertify.confirm('Archive', 'Are you sure you want  to Archive this data?',
            function() {
                $.ajax({
                    type: "POST",
                    url: "user_code.php",
                    data: {
                        'delete_user': true,
                        'user_id': user_id
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        $('#myTable').load(location.href + " #myTable");
                    }

               
                });
                alertify.success("User Archive Successfully");  
                setTimeout(() => {
                        location.href = "./user_account.php"
                       }, 1000); 
                
            },
            function() {
                alertify.error('Cancel')
            });


    }); 

    $(document).on('click', '.restoreUserbtn ', function(e) {
                e.preventDefault();
                var user_id = $(this).val();
         alertify.confirm('Archive', 'Are you sure you want  to Restore this data?',
            function() {
                $.ajax({
                    type: "POST",
                    url: "user_code.php",
                    data: {
                        'restore_user': true,
                        'user_id': user_id
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        $('#myTable').load(location.href + " #myTable");
                    }

               
                });
                alertify.success("User Archive Successfully");  
                setTimeout(() => {
                        location.href = "./archive.php"
                       }, 1000); 
                
            },
            function() {
                alertify.error('Cancel')
            });


    });
</script>