<?php
require '../login/login.php';
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_admin_account WHERE id = $id"));
} else {
    header("Location: ../login/index.php");
}
?>
<?php include('../include/header.php');?>

<title>Setting</title>

<main id="main" class="main">
    <section class="section mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Home Maintenance</h5>
                    </div>
                    <div class="card-body">
                        <table  class="table table-striped-columns" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th>Website Logo</th>
                                    <th>Website Titlepage</th>
                                    <th>Navigation Bar Color</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                $maintenance = getAll("tbl_maintenance");
        
                                if (mysqli_num_rows($maintenance) > 0) {
                                    foreach ($maintenance as $data) {
                                ?>
                                        <tr>
                                            <td>
                                                <img src="../logo/<?= $data['image']; ?>" width="100px" height="100px">
                                            </td>
                                            <td><?= $data['titlepage']; ?></td>
                                            <td><?= $data['navcolor']; ?></td>
                                            <td>
                                                  <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#EditWebsiteModal">EDIT</button>
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
                        <div class="card-header">
                            <h5 class="modal-title">Image Carousel</h5>
                        </div>
                        <div class="card-body">
                            <table  class="table table-striped-columns" style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Image Carousel</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                    $carousel = getAll("tbl_carousel");
            
                                    if (mysqli_num_rows($carousel) > 0) {
                                        foreach ($carousel as $data) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <img src="../logo/<?= $data['image']; ?>" width="100px" height="100px">
                                                </td>
                                                <td><?= $data['description']; ?></td>
                                                <td>
                                                    <a href="editcarousel.php?id=<?= $data['id']; ?>" class="btn btn-primary">EDIT</a>
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
        </div>
    </section>

    <section class="section mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Services Management </h5>
                         <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#AddModal">ADD</button>
                    </div>
                    <div class="card-body">
                        <table  class="table table-striped-columns" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th>Image Service</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                require '../connect.php';
                                $query = "SELECT * FROM tbl_management WHERE status = 0";
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
                                                <a href="editmanagement.php?id=<?= $data['id']; ?>" class="btn btn-primary">EDIT</a>
                                                <button type="button" class="btn btn-danger" onclick="setArchiveManagement(<?= $data['id']; ?>, '<?= $data['description']; ?>')" data-bs-toggle="modal" data-bs-target="#archiveManagementModal">ARCHIVE</button>
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


<!-- ADD MODAL -->
<div class="modal fade" id="AddModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Services</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--FORM-->
                <form id="foodForm" action="../code.php" method="post" enctype="multipart/form-data">
                    <div class="form-group m-3">
                        <label for="">Description:</label>
                        <textarea name="description" id="description" rows="5" cols="20" class="form-control" placehoder="Type Answer" required></textarea>
                    </div>
                    <div class="form-group m-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_management" class="btn btn-primary">Add Food Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- EDIT MODAL -->
<div class="modal fade" id="EditWebsiteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT MAINTENANCE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--FORM-->
                <?php
                $maintenance = getAll("tbl_maintenance");

                if (mysqli_num_rows($maintenance) > 0) {
                    foreach ($maintenance as $data) {
                ?>
                        <form action="../code.php" method="post" enctype="multipart/form-data">
                            <div class="form-group m-3">
                                <input type="hidden" name="maintenance_id" value="<?= $data['id'] ?>">
                                <label for="">Website Title:</label>
                                <input type="text" name="titlepage" value="<?= $data['titlepage'] ?>" class="form-control" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="">Navbar Color:</label>
                                <select class="form-select" name="navcolor" value="<?= $data['navcolor'] ?>" required>
                                    <option selected><?= $data['navcolor'] ?></option>
                                    <option value="Red">Red</option>
                                    <option value="Yellow">Yellow</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Black">Black</option>
                                    <option value="Green">Green</option>
                                </select>
                            </div>
                            <div class="form-group m-3">
                                <label for="">New Logo</label>
                                <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png">
                                <label for="">Current Logo:</label>
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                <img src="../logo/<?= $data['image'] ?>" width="100px" height="100px" alt="">
                            </div>
                            <div class="form-group text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="update_maintenance" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                <?php
                    }
                } else {
                    echo "No Records Found";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- ARCHIVE MODAL -->
<div class="modal fade" id="archiveManagementModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Archive Services</span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../code.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="archiveManagementID" name="management_id" value="">
                    <h1 class="text">Are you sure you want to archive <span id="archiveManagement"></span>?</h1>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="archive_management" class="btn btn-outline-danger">Archive</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setArchiveManagement(id, description) {
        document.getElementById('archiveManagementID').value = id;
        document.getElementById('archiveManagement').textContent = description;
    }
</script>


<?php include('../include/footer.php'); ?>