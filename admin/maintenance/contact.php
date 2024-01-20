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

<title>Contact Maintenance</title>

<main id="main" class="main">
    <!--CONTACT-->
    <section class="section mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Edit Contact Us</h5>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered table-stripe" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th width="20%">Introduction</th>
                                    <th width="20%">Location</th>
                                    <th width="30%">Email</th>
                                    <th width="20%">Phone Number</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contacts = getAll("tbl_contact");

                                if (mysqli_num_rows($contacts) > 0) {
                                    foreach ($contacts as $data) {
                                ?>
                                        <tr>
                                            <td class="limited-width"><?= $data['Intro']; ?></td>
                                            <td><?= $data['Location']; ?></td>
                                            <td><?= $data['Email']; ?></td>
                                            <td><?= $data['Phone']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">EDIT</button>
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
    <!--FAQ-->
    <section class="section mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Frequently Asked Question Maintenance</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddFAQModal">Add FAQ</button>
                    </div>
                    <div class="card-body">
                        <table id="datatable2" class="table table-striped" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th width="40%">Question</th>
                                    <th width="40%">Answer</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $faq = getAll("tbl_faq");

                                if (mysqli_num_rows($faq) > 0) {
                                    foreach ($faq as $data) {
                                ?>
                                        <tr>
                                            <td><?= $data['question']; ?></td>
                                            <td><?= $data['answer']; ?></td>
                                            <td>
                                                <form action="../code.php" method="post">
                                                    <a href="editfaq.php?id=<?= $data['id']; ?>" class="btn btn-primary">EDIT</a>
                                                    <button type="button" value="<?= $data['id']; ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteFAQModal">Delete</button>
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

<!-- CONTACT EDIT MODAL -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Contact Us</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--FORM-->
                <?php
                $contacts = getAll("tbl_contact");

                if (mysqli_num_rows($contacts) > 0) {
                    foreach ($contacts as $data) {
                ?>
                        <form action="../code.php" method="post">
                            <div class="form-group m-3">
                                <input type="hidden" name="contact_id" value="<?= $data['id'] ?>">
                                <label for="">Introduction:</label>
                                <textarea name="Intro" rows="5" cols="20" class="form-control" required><?= $data['Intro'] ?></textarea>
                            </div>
                            <div class="form-group m-3">
                                <label for="">Location:</label>
                                <input type="text" name="Location" value="<?= $data['Location'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="">Email:</label>
                                <input type="email" name="Email" value="<?= $data['Email'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="">Phone:</label>
                                <input type="text" name="Phone" value="<?= $data['Phone'] ?>" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" required>
                            </div>
                            <div class="form-group text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="hidden" name="contact_id" value="<?= $data['id']; ?>">
                                <button type="submit" name="update_contact" class="btn btn-primary">Save</button>
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

<!-- FAQ ADD MODAL -->
<div class="modal fade" id="AddFAQModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Frequently Asked Question</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../code.php" method="post">
                    <div class="form-group m-3">
                        <label for="">Question:</label>
                        <input type="text" name="question" class="form-control" placehoder="Type Question" required>
                    </div>
                    <div class="form-group m-3">
                        <label for="">Answer:</label>
                        <textarea name="answer" rows="5" cols="20" class="form-control" placehoder="Type Answer" required></textarea>
                    </div>
                    <div class="form-group text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_faq" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteFAQModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Delete FAQ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- FORM -->
                <form action="../code.php" method="post" enctype="multipart/form-data">
                    <h1 class="text">Are you sure to delete FAQ?</h1>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="hidden" id="faqIdToDelete" name="faq_id">
                        <button type="submit" name="delete_faq" class="btn btn-outline-danger">DELETE</button>                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteFAQModal"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const faqId = this.value;
                document.getElementById('faqIdToDelete').value = faqId;
            });
        });
    });
</script>



<?php include('../include/footer.php'); ?>