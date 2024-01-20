<?php
require '../login/login.php';
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_admin_account WHERE id = $id"));
} else {
    header("Location: ../login/index.php");
}
?>
<?php include('../include/header.php'); ?>

<title>Archive Maintenance</title>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Review Archive</H5>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-striped-columns" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th>User Name</th>
                                    <th>User Rating</th>
                                    <th>User Review</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../connect.php';
                                $query = "SELECT * FROM review WHERE status = 1";
                                $query_run = mysqli_query($con, $query);


                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $data) {
                                ?>
                                        <tr>
                                            <td><?= $data['user_name']; ?></td>
                                            <td><?= $data['user_rating']; ?></td>
                                            <td><?= $data['user_review']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success delete-review-btn" onclick="setRestoreIdAndName(<?= $data['id']; ?>, '<?= $data['user_name']; ?>')" data-bs-toggle="modal" data-bs-target="#restoreReviewModal">RESTORE</button>
                                                <button type="button" class="btn btn-danger delete-review-btn" onclick="setDeleteIdAndName(<?= $data['id']; ?>, '<?= $data['user_name']; ?>')" data-bs-toggle="modal" data-bs-target="#deleteReviewModal">DELETE</button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "No Records Found";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Services Archive</H5>
                    </div>
                    <div class="card-body">
                        <table id="datatable2" class="table table-striped-columns" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th>Service Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../connect.php';
                                $query = "SELECT * FROM tbl_management WHERE status = 1";
                                $query_run = mysqli_query($con, $query);


                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $data) {
                                ?>
                                        <tr>
                                            <td>
                                                <img src="../logo/<?= $data['image']; ?>" width="100px" height="100px">
                                            </td>
                                            <td><?= $data['description']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success delete-review-btn" onclick="setRestoreManagement(<?= $data['id']; ?>,'<?= $data['description']; ?>')" data-bs-toggle="modal" data-bs-target="#restoreManagementModal">RESTORE</button>
                                                <button type="button" class="btn btn-danger delete-review-btn" onclick="setDeleteManagement(<?= $data['id']; ?>,'<?= $data['description']; ?>')" data-bs-toggle="modal" data-bs-target="#deleteManagementModal">DELETE</button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "No Records Found";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>



<!-- REVIEW DELETE MODAL -->
<div class="modal fade" id="deleteReviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Delete User Review</span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../code.php" method="post" enctype="multipart/form-data">
                    <h1 class="text">Are you sure you want to delete <span id="userNameToDelete"></span> review?</h1>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="hidden" id="reviewIdToDelete" name="review_id" value="">
                        <button type="submit" name="delete_review" class="btn btn-outline-danger">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- REVIEW RESTORE MODAL-->
<div class="modal fade" id="restoreReviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Restore User Review</span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../code.php" method="post" enctype="multipart/form-data">
                    <h1 class="text">Are you sure you want to restore <span id="userNameToRestore"></span> review?</h1>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="hidden" id="reviewIdToRestore" name="review_id" value="">
                        <button type="submit" name="restore_review" class="btn btn-outline-success">RESTORE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SERVICE DELETE MODAL -->
<div class="modal fade" id="deleteManagementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Delete Services</span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../code.php" method="post" enctype="multipart/form-data">
                    <h1 class="text">Are you sure you want to delete  <span id="descriptionToDelete"></span>?</h1>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="hidden" id="managementIdToDelete" name="management_id" value="">
                        <button type="submit" name="delete_management" class="btn btn-outline-danger">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SERVICE RESTORE MODAL-->
<div class="modal fade" id="restoreManagementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Restore Services</span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../code.php" method="post" enctype="multipart/form-data">
                    <h1 class="text">Are you sure you want to restore <span id="descriptionToRestore"></span>?</h1>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="hidden" id="managementIdToRestore" name="management_id" value="">
                        <button type="submit" name="restore_management" class="btn btn-outline-success">RESTORE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteIdAndName(id, userName) {
        document.getElementById('reviewIdToDelete').value = id;
        document.getElementById('userNameToDelete').textContent = userName;
    }
    function setRestoreIdAndName(id, userName) {
        document.getElementById('reviewIdToRestore').value = id;
        document.getElementById('userNameToRestore').textContent = userName;
    }
    function setDeleteManagement(id, description) {
        document.getElementById('managementIdToDelete').value = id;
        document.getElementById('descriptionToDelete').textContent = userName;
    }
    function setRestoreManagement(id, description) {
        document.getElementById('managementIdToRestore').value = id;
        document.getElementById('descriptionToRestore').textContent = userName;
    }
</script>

<?php include('../include/footer.php'); ?>