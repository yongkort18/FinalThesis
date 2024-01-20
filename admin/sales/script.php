<script>
   $(document).on('submit', '#save_sales', function (e) {
        e.preventDefault();
        var formData = new FormData(this); 
        formData.append("Save_Sales", true);
        $.ajax({
            type: "post",
            url: "save_fee.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    $('#errorMessage').removeClass('d-none');
                    $('#errorMessage').text(res.message);
                } else if (res.status == 200) {
                    $('#errorMessage').addClass('d-none');
                    $('#salesmodal').modal('hide');
                    $('#save_sales')[0].reset();

                    alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    });
    function updatePrice(select) {
        var selectedName = select.value;
        var feeInput = document.getElementsByName('fee')[0];  
        var user_Id_fee = document.getElementsByName('user_Id_fee')[0]; 
        var selectedOption = select.options[select.selectedIndex];
        var dataId = selectedOption.getAttribute('data-id');

        // Print the value to the console
        console.log('Selected data-id:', dataId);   
        console.log(selectedName);
        // Make an AJAX request to fetch the fee based on the selected name
        $.ajax({
            type: 'POST',
            url: 'get_fee.php', // Replace with the actual path to your server-side script
            data: { selectedId: selectedName, user_id:dataId },
            success: function(response) {
                // Parse the JSON response
              console.log(response) 
              var data = JSON.parse(response);
               // console.log(response);
                // Set the value of the "Fee" input
                feeInput.value = data.fee;  
                user_Id_fee.value = data.user_id;

            },
            error: function() {
                console.error('Error fetching fee.');
            }
        });
    }
</script>