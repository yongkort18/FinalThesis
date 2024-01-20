<script>
     $(document).on('submit', '#save_reservation', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("Save_Reservation", true);
        $.ajax({
            type: "post",
            url: "reservation_code.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              
                            document.getElementById('number').value = "";
                           
                            document.getElementById('date').value = "";
                            document.getElementById('inputGroupSelect01').value = "";
                            document.getElementById('priceInput').value = "";
                            document.getElementById('pax').value = "";
                            document.getElementById('total').value = "";
                            document.getElementById('image').value = "";
                         
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

                }
            }
        });


    });
</script>