<!-- Bootstrap js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Custom script -->
<script type="text/javascript">
  $(document).ready(function () {
    displayData();

    // Add event listener for the Enter key on the password field
    $('#password').keypress(function (e) {
      if (e.which === 13) {
        submitData();
      }
    });
  });

  // Display function
  function displayData() {
    var displayData = "true";
    $.ajax({
      url: "display.php",
      type: 'post',
      data: {
        displaySend: displayData
      },
      success: function (data, status) {
        $('#displayDataTable').html(data);
        new DataTable('#example');
      }
    });
  }

  // Submit function
  function submitData() {
    var data = {
      name: $('#name').val(),
      username: $('#username').val(),
      type: $('#type').val(),
      password: $('#password').val(),
      action: $('#action').val()
    };
    $.ajax({
      url: 'login.php',
      type: 'post',
      data: data,
      success: function (response) {
        alert(response);
        window.location = "dashboard.php";
      }
    });
  }
</script>
