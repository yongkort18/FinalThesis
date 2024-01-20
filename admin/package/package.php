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

    include '../include/header.php';
    ?>

    <style>
        #addadmin {
            color: white;
            background-color: black;
            border-style: none;
        }
    </style>

    <title>Package</title>

    <main id="main" class="main ">
        <div class="row">
            <div class="pagetitle col-sm-10">
                <h1>Package</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Food Package</a></li>
                        <li class="breadcrumb-item active">Management</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <!-- Button trigger modal -->
            <div class="col ml-6 ">
                <div class="mt-3">
                    <button id="addadmin" type="button" class="btn btn-sm btn-primary px-3 float-end" data-bs-toggle="modal" data-bs-target="#packagemodal">
                        Add Package
                    </button>

                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="packagemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="save_package" method="POST" action="#">
                        <div class="modal-body">
                            <div id="errorMessage" class="alert alert-warning d-none"></div>
                            <div class="mb-3">
                                <label for="">Package Name</label>
                                <input type="text" name="package_name" class="form-control" placeholder="name" />
                            </div>
                            <div class="mb-1">
                                <label for="">Food</label>
                            </div>
                            <div id="show_item">
                                <div class="row">
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
                                        <button class="btn btn-success add_food_btn">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Amount</label>
                                <input type="number" name="amount" min="200" max="1000" class="form-control" placeholder="amount" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="add_btn" value="Add" class="btn btn-primary">Save package</button>
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
                            <h5 class="card-title">Package</h5>
                            <!-- Table with stripped rows -->
                            <table id="myTable" class="table table-striped">
                                <thead class="table-dark">
                                    <tr>

                                        <th width="40%">PackageName</th>
                                        <th width="40%">Amount</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require '../connect.php';
                                    $query = "SELECT * FROM package";
                                    $query_run = mysqli_query($con, $query);


                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $food_package) {
                                    ?>
                                            <tr>
                                                <td><?= $food_package['package_name'] ?></td>
                                                <td><?= $food_package['price'] ?></td>
                                                <td>
                                                    <button type="button" value="<?= $food_package['id']; ?>" class="editPackagebtn btn btn-sm btn-warning" style="color: white;">Edit</button>
                                                    <button type="button" value="<?= $food_package['id']; ?>" class="deletePackagebtn btn btn-sm btn-danger">Delete</button>
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
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <?php include 'script.php' ?>
    </main><!-- End #main -->


    <?php
    include '../include/footer.php';
    ?>


    </script>
    <script>
        new DataTable('#myTable');
    </script>