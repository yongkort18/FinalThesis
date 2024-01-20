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

<title>Reports</title>
<main id="main" class="main">
    <div class="row">

        <section class="section mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">SALES REPORTS</h5>
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                <form action="" method="POST">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="control-label">Choose First Date:</label>
                                            <select class="form-control" id="" name="">
                                                <option value="">Select</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="" class="control-label">Choose End Date:</label>
                                            <select class="form-control" id="" name="">
                                                <option value="">Select</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="control-label" style="padding-top: 40px;"></label>
                                        <input type="submit" name="submit" class="btn btn-primary" id="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped text-center" style="font-size:13px">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Fee</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
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



