<script>

    $(document).on('click', '.deletePackagebtn', function (e) {
      e.preventDefault();  
       var reservationId = $(this).val();
       console.log(reservationId);
      alertify.confirm('Confirm', 'Are you sure to restore this reservation?',
            function () {
                $.ajax({
                    type: "POST",
                    url: "confirm.php",
                    data: {
                        'update_status': true,
                        'confirm_id': reservationId,                       
                    },
                    success: function (response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status === 200) {
                            alertify.success(res.message);                       
                         setTimeout(() => {
                        location.href = "../archive-reservation/archive.php"
                       }, 1000);
                            ;
                        } else {
                            alertify.error(res.message);
                        }
                    }
                });
            },
            function () {
                alertify.error('Cancel');
            });
    });
    
</script>
