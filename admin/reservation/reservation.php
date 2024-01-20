<?php
require '../login/login.php';
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_admin_account WHERE id = $id"));
} else {
    header("Location: ../login/index.php");
    exit();
}
?>
<?php include '../include/header.php'; ?>

<title>Reservation</title>
<main id="main" class="main ">
    <div class="row">

        <section class="section mt-3">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card" id="reservationTable">
                        <div class="card-body">
                            <h5 class="card-title">Reservation</h5>
                            <!-- Table with stripped rows -->
                            <table id="myTable" class="table table-striped text-center" style="font-size:13px">
                                <thead>
                                    <tr>

                                        <th class="text-center">Name</th>
                                        <th class="text-center">Phone Number</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Package</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Pax</th>
                                        <th class="text-center">Total Price</th>
                                        <th class="text-center">Fee</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require '../connect.php';
                                    $query = "SELECT * FROM tbl_reservation WHERE archive = 0";
                                    $query_run = mysqli_query($con, $query);


                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $data) {
                                    ?>
                                            <tr>
                                                <td><?= $data['user_name']; ?></td>
                                                <td><?= $data['number']; ?></td>
                                                <td><?= $data['email']; ?></td>
                                                <td><?= $data['date']; ?></td>
                                                <td><?= $data['food_package']; ?></td>
                                                <td><?= $data['price']; ?></td>
                                                <td><?= $data['pax']; ?></td>
                                                <td><?= $data['total']; ?></td>

                                                <td> <a href="../fee_receipt/<?= $data['image']; ?>" target="_blank">View File</a></td>
                                                <td class="<?= ($data['status'] == 1 || $data['status'] == 2) ? 'verified' : 'unverified'; ?>">
                                                    <?= ($data['status'] == 1) ? 'Verified' : (($data['status'] == 2) ? 'Verified' : 'Unverified'); ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $reservation_Fee = 200;
                                                    if ($data['status'] != 1 && $data['status'] != 2) {
                                                        // Display the Confirm button only if the status is not 1 or 2
                                                    ?>                                                          
                                                        <button type="button" value="<?= $data['id'] . '|' . $data['user_name'] .'|'. $data['price'] .'|'. $data['email']?>" id="confirmreservationbtn"class="confirmreservationbtn btn btn-sm btn-success" style="color: white;">Confirm</button>
                                                    <?php
                                                    } 
                                                    if ($data['status'] == 0) {
                                                        ?><button type="button" value="<?= $data['id']?>" class="deletePackagebtn btn btn-sm btn-danger">Decline</button> 
                                                        <?php
                                                    }
                                                    ?> 
                                                    
                                                    
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>

                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>
</main>
<script>
        function getSubcategories() {
            var categoryId = $("#category").val();

            $.ajax({
                type: "POST",
                url: "get_subcategories.php",  // PHP script to handle the AJAX request
                data: { category_id: categoryId },
                success: function(response) {
                    $("#subcategory").html(response);
                }
            });
        }
</script>
<?php include '../include/footer.php'; ?>
<?php include 'confirmed_reservation.php'; ?>
<script>
    new DataTable('#myTable');
    new DataTable('#myTable1');
</script>