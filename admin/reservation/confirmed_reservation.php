<script>
 // Wrap your code inside a function
function initializeConfirmation() {
  $(document).on('click', '.confirmreservationbtn', function (e) {
    e.preventDefault();
    var values = $(this).val().split('|');
    var reservationId = values[0];
    var clientName = values[1];
    var fee = values[2];
    var email = values[3];


    alertify.confirm('Confirm', 'Confirm users reservation?',
      function () {
        $.ajax({
          type: "Post",
          url: "confirm.php",
          data: {
            'confirm_user': true,
            'confirm_id': reservationId,
            'clientName': clientName,
            'fee': fee,
            'user_email': email
          },
          success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status === 200) {
              alertify.success(res.message);
              setTimeout(() => {
                location.href = "../reservation/reservation.php";
              }, 1300);
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
}

// Call the initialization function when the document is ready
$(document).ready(function () {
  initializeConfirmation();
});


    $(document).on('click', '.deletePackagebtn', function (e) {
      e.preventDefault();  
       var reservationId = $(this).val();
       console.log(reservationId);
      alertify.confirm('Confirm', 'Are you sure to decline this reservation?',
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
                        location.href = "../reservation/reservation.php"
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
