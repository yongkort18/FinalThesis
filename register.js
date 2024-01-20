$(document).on('submit', '#save_user', function(e) {
       
    e.preventDefault();
    
    var formData = new FormData(this);
    formData.append("Save_user", true);
    $.ajax({
        type: "post",
        url: "register_code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {

            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);

            } 
            if (res.status == 401) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);

            } 
            else if (res.status == 200) {
                $('#errorMessage').addClass('d-none');
                $('#save_user')[0].reset();
                window.location.href = "login.php";
            }
        }
    });


});
