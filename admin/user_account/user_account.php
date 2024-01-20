<?php
require '../login/login.php';
if(isset($_SESSION["id"])){
    $id = $_SESSION["id"];
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbl_admin_account WHERE id = $id"));
}
else{
    header("Location: ../login/index.php");
}
?>
<?php

include '../include/header.php';
?>

<style>
    #addadmin {
        color: white;
        background-color: black;
        border-style: none;


    }
</style>

<title>User Account</title>

<main id="main" class="main">
    <div class="row">
        <div class="pagetitle col-sm-10">
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">User Account</a></li>
                    <li class="breadcrumb-item active">Management</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <!-- Button trigger modal -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="adminmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="save_admin" action="">
                    <div class="modal-body">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" required />
                        </div>
                        <div class="mb-3">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" />
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Select</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="type" name="type">
                                    <option selected></option>
                                    <option value="Admin">Admin</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" />
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

    <!-- Edit Modal -->
    <div class="modal fade" id="adminEditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="update_users" action="">
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
                        <input type="hidden" name="users_id" id="users_id">

                        <div class="mb-3">
                            <label for="">First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="Firstname" />
                        </div>
                        <div class="mb-3">
                            <label for="">Middle Name</label>
                            <input type="text" name="mname" id="mname" class="form-control" placeholder="Middlename" />
                        </div> 

                        <div class="mb-3">
                            <label for="">Last Name</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Lastname" />
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
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
                        <h5 class="card-title">User Account</h5>
                        <!-- Table with stripped rows -->
                        <table id="myTable" class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Middle Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../connect.php';
                                $query = "SELECT * FROM tbl_users_account WHERE archive = 0";
                                $query_run = mysqli_query($con, $query);


                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $user) {
                                ?>
                                        <tr>
                                            <td><?= $user['firstname'] ?></td>
                                            <td><?= $user['middlename'] ?></td>
                                            <td><?= $user['lastname'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td>
                                                <button type="button" value="<?= $user['id']; ?>" class="editAdminbtn btn btn-sm btn-warning" style="color: white;">Edit</button>
                                                <button type="button" value="<?= $user['id']; ?>" class="deleteUserbtn btn btn-sm btn-danger">Archive</button>
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
</script>
<script>
    new DataTable('#myTable');
</script>