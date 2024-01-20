<?php
require '../login/login.php';
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_admin_account WHERE id = $id"));
} else {
    header("Location: ../login/index.php");
}
?>
<?php
include('../include/header.php');
?>

<title>About Maintenance</title>

<main id="main" class="main">
    <section class="section mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Edit About Us</h5>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-stripe" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th width="25%">Image</th>
                                    <th width="25%">Heading</th>
                                    <th width="40%">Paragraph</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $about = getAll("tbl_about");

                                if (mysqli_num_rows($about) > 0) {
                                    foreach ($about as $data) {
                                ?>
                                        <tr>
                                            <td><img src="../logo/<?= $data['image'] ?>" width="100px" height="100px" alt=""></td>
                                            <td><?= $data['heading']; ?></td>
                                            <td><?= $data['paragraph']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal">EDIT</button>
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

    <section class="section mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Services Maintenance</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddServicesModal">Add Services</button>
                    </div>
                    <div class="card-body">
                        <table id="datatable2" class="table table-striped" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th width="40%">Services Image</th>
                                    <th width="40%">Services Type</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $services = getAll("tbl_services");

                                if (mysqli_num_rows($services) > 0) {
                                    foreach ($services as $data) {
                                ?>
                                        <tr>
                                            <td>
                                                <img src="../services/<?= $data['image']; ?>" width="100px" height="100px">
                                            </td>
                                            <td><?= $data['servicesType']; ?></td>
                                            <td>
                                                <form action="../code.php" method="post">
                                                    <a href="editservices.php?id=<?= $data['id']; ?>" class="btn btn-primary">EDIT</a>

                                                    <button type="button" class="btn btn-danger" onclick="setDeleteIdAndName(<?= $data['id']; ?>, '<?= $data['servicesType']; ?>')" data-bs-toggle="modal" data-bs-target="#deleteServicesModal">DELETE</button>

                                                </form>
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

<!-- EDIT ABOUT MODAL -->
<div class="modal fade" id="EditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit About Us</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--FORM-->
                <?php
                $about = getAll("tbl_about");

                if (mysqli_num_rows($about) > 0) {
                    foreach ($about as $data) {
                ?>
                        <form action="../code.php" method="post" enctype="multipart/form-data">
                            <div class="form-group m-3">
                                <input type="hidden" name="about_id" value="<?= $data['id'] ?>">
                                <label for="">Heading:</label>
                                <input type="text" name="heading" value="<?= $data['heading'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="">Paragraph:</label>
                                <textarea name="paragraph" rows="5" cols="20" class="form-control" required><?= $data['paragraph'] ?></textarea>
                            </div>
                            <div class="form-group m-3">
                                <label for="">New Image</label>
                                <input type="file" name="image" accept=".jpg, .jpeg, .png" class="form-control">
                                <label for="">Current Image:</label>
                                <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                <img src="../logo/<?= $data['image'] ?>" width="100px" height="100px" alt="">
                            </div>
                            <div class="form-group text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="hidden" name="about_id" value="<?= $data['id'] ?>">
                                <button type="submit" name="update_about" class="btn btn-primary">Save</button>
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

<!-- ADD SERVICES MODAL -->
<div class="modal fade" id="AddServicesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Services</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--FORM-->
                <form action="../code.php" method="post" enctype="multipart/form-data">
                    <div class="form-group m-3">
                        <label for="">Service Type</label>
                        <input type="text" name="servicesType" class="form-control" placehoder="Services Name" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" required>
                    </div>
                    <div class="form-group m-3">
                        <label for="">Service Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_services" class="btn btn-primary">Add Services</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EDIT SERVICES MODAL -->
<div class="modal fade" id="EditServicesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Services</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--FORM-->
                <form action="../code.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="service_id" name="services_id">
                    <div class="form-group m-3">
                        <label for="">Service Type</label>
                        <input type="text" id="service_type" name="servicesType" class="form-control" required>
                    </div>
                    <div class="form-group m-3">
                        <label for="">Service Image</label>
                        <input type="file" name="image" class="form-control" accept=".jpg, .jpeg, .png">
                        <label for="">Current Image:</label>
                        <input type="hidden" name="old_image" id="current_image">
                        <img id="current_image_preview" width="100px" height="100px" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_services" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DELETE SERVICES MODAL -->
<div class="modal fade" id="deleteServicesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteServicesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title fs-5 text-white" id="deleteServicesModalLabel">Delete Services</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 class="text">Are you sure you want to delete <span id="servicesTypesToDelete"></span>?</h1>
            </div>
            <div class="modal-footer">
                <form action="../code.php" method="post">
                    <input type="hidden" id="servicesIdToDelete" name="services_id" value="">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="delete_services" class="btn btn-outline-danger">DELETE</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function setDeleteIdAndName(id, servicesType) {
        document.getElementById('servicesIdToDelete').value = id;
        document.getElementById('servicesTypesToDelete').textContent = servicesType;
    }

   document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-services');
        const serviceIdField = document.getElementById('service_id');
        const serviceTypeField = document.getElementById('service_type');
        const currentImageField = document.getElementById('current_image');
        const currentImagePreview = document.getElementById('current_image_preview');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr'); // Find the closest table row
                const serviceId = this.getAttribute('data-serviceid');
                const serviceType = row.querySelector('td:nth-child(2)').textContent.trim();
                const currentImageSrc = row.querySelector('img').getAttribute('src');

                serviceIdField.value = serviceId;
                serviceTypeField.value = serviceType;
                currentImageField.value = currentImageSrc.split('/').pop(); // Extracts the image filename
                currentImagePreview.setAttribute('src', currentImageSrc);
            });
        });
    });
</script>

<?php include('../include/footer.php'); ?>