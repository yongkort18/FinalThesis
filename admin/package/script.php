<script>
    $(document).ready(function() {
        $(".add_food_btn").click(function(e) {
            e.preventDefault();
            $("#show_item").prepend(`<div class="row append_item">
                                <div class="col-md-10 mb-3"> 
                                <select name="food_name[]" class="form-control">
                                <?php
                                            include '../connect.php';
                                            $packages = mysqli_query($con, "SELECT DISTINCT foodtype FROM tbl_menu");
                                            while ($row = mysqli_fetch_assoc($packages)) {
                                            ?>
                                                <option value="1 <?php echo $row['foodtype'] ?>">1 <?php echo $row['foodtype'] ?></option>
                                            <?php } ?>
                                        </select>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-danger remove_item_btn">-</button>
                                  </div>
                               </div>
                          </div>`);
        });
        $(document).on('click', '.remove_item_btn', function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
        //ajax
        $("#save_package").submit(function(e) {
            e.preventDefault();
            $("#add_btn").val('Adding...');
            $.ajax({
                url: 'code.php',
                type: 'post',
                data: $(this).serialize(),
                success: function(response) {
                    $("#add_btn").val('Add');
                    $("#save_package")[0].reset();
                    $(".append_item").remove();
                    $('#packagemodal').modal('hide');

                    alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success("Add Successfully");


                    $('#myTable').load(location.href + " #myTable");

                }
            })
        });
    });
    $(document).on('click', '.deletePackagebtn ', function(e) {
        e.preventDefault();
        var package_id = $(this).val();
        alertify.confirm('Delete', 'Are you sure you want  to delete this data?',
            function() {
                $.ajax({
                    type: "POST",
                    url: "function.php",
                    data: {
                        'delete_package': true,
                        'package_id': package_id
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        $('#myTable').load(location.href + " #myTable");
                    }


                });
                alertify.success("Delete Package  Successfully");
            },
            function() {
                alertify.error('Cancel')
            });


    });
</script>