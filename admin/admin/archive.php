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

<title>Admin Account</title>

<main id="main" class="main">
    <div class="row">
        <div class="pagetitle col-sm-10">
            <h1>Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Account</a></li>
                    <li class="breadcrumb-item active">Management</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <!-- Button trigger modal -->
        <div class="col ml-6 ">
            <div class="mt-3">
                <button id="addadmin" type="button" class="btn btn-sm btn-primary px-3 float-end" data-bs-toggle="modal" data-bs-target="#adminmodal">
                    Add Admin
                </button>

            </div>
        </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="update_admin" action="">
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
                        <input type="hidden" name="admin_id" id="admin_id">

                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" />
                        </div>
                        <div class="mb-3">
                            <label for="">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
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
                        <h5 class="card-title">Admin</h5>
                        <!-- Table with stripped rows -->
                        <table id="myTable" class="table table-striped text-center">
                            <thead>
                                <tr>
                                
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../connect.php';
                                $query = "SELECT * FROM tbl_admin_account WHERE archive  =  1";
                                $query_run = mysqli_query($con, $query);


                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $user) {
                                ?>
                                        <tr>
                                            
                                            <td><?= $user['name'] ?></td>
                                            <td><?= $user['username'] ?></td>
                                            <td><?= $user['type'] ?></td>
                                            <td>
                                                
                                                <button type="button" value="<?= $user['id']; ?>" class="restoreAdminbtn btn btn-sm btn-danger">Restore</button>
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