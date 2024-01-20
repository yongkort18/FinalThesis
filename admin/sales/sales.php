<?php
require '../login/login.php';
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_admin_account WHERE id = $id"));
} else {
    header("Location: ../login/index.php");
}
?>
<?php include '../include/header.php'; ?>

<style>
    #addsales {
        color: white;
        background-color: black;
        border-style: none;
    }
</style>

<title>Sales</title>

<main id="main" class="main">
    <div class="row">
        <div class="pagetitle col-sm-10">
            <h1>Sales</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Reservation fee</a></li>
                    <li class="breadcrumb-item active">Record</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <!-- Button trigger modal -->
        <div class="col ml-6 d-none">
            <div class="mt-3">
                <button id="addsales" type="button" class="btn btn-sm btn-primary px-3 float-end" data-bs-toggle="modal" data-bs-target="#salesmodal">
                    Add Payment
                </button>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="salesmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="save_sales" action="post">
                    <div class="modal-body row">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="col-md-6">
                            <label for="">Name</label> 
                            <input name="user_Id_fee">
                            <select class="form-select" id="inputGroupSelect1" name="confirm_name" onchange="updatePrice(this)">
                                <?php
                                include '../connect.php';
                                $user_name_result = mysqli_query($con, "SELECT tbl_fee.*, tbl_reservation.user_name AS user_name ,  tbl_fee.reservation_id AS reserve_id
                                FROM tbl_fee
                                JOIN tbl_reservation ON tbl_fee.reservation_id = tbl_reservation.id ");

                                // Check if there are rows in the result set
                                if (mysqli_num_rows($user_name_result) > 0) {
                                    echo '<option value="" disabled selected hidden>Select Name</option>';

                                    while ($row = mysqli_fetch_assoc($user_name_result)) {
                                         echo '<option data-id ="'.$row['user_id'] .'" value="' . $row['reserve_id'] . '" data-price="' . $row['fee'] . '">' . $row['user_name'] . '</option>'; 
                                     
                                    }
                                } else {
                                    // Display "None" option if no rows are returned
                                    echo '<option value="none" disabled selected hidden>None</option>';
                                }
                                ?>

                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="">Fee</label>
                            <input type="number" name="fee" class="form-control disabled" readonly placeholder=""/>
                        </div>
                        <div class="col-md-3">
                            <label for="">Amount</label>
                            <input type="number" name="amount" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="section mt-3">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sales</h5>
                        <!-- Table with stripped rows -->
                        <table id="myTable" class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Fee</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../connect.php';

                                $query = "SELECT tbl_fee.*, tbl_reservation.user_name AS user_name 
                                FROM tbl_fee
                                JOIN tbl_reservation ON tbl_fee.reservation_id = tbl_reservation.id";

                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $user) {
                                ?>
                                        <tr>
                                            <td><?= $user['user_name'] ?></td>
                                            <td><?= $user['fee'] ?></td>
                                            <td><?= $user['amount'] ?></td>
                                            <td class="d-flex justify-content-center gap-2">
                                                <!-- <button type="button" value="<?= $user['id']; ?>" class="editAdminbtn btn btn-sm btn-warning" style="color: white;">Edit</button>
                                                <button type="button" value="<?= $user['id']; ?>" class="deleteAdminbtn btn btn-sm btn-danger">Delete</button>  -->
                                                <p > Paid</p>                               
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
</main><!-- End #main -->


<?php
include '../include/footer.php';
?>

<?php include 'script.php' ?> 
<?php include 'save_fee.php'?>

<script>
    new DataTable('#myTable');
</script>