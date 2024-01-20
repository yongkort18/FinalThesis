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

<title>Menu Maintenance</title>

<main id="main" class="main">
    <section class="section mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title">Menu Maintenance</H5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">Add Food Item</button>
                        <a href="print.php" target="_blank" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> Print</a>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-striped-columns" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th>Food Image</th>
                                    <th>Food Name</th>
                                    <th>Food Category</th>
                                    <th>Food Price</th>
                                    <th>Food Serving</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $menus = getAll("tbl_menu");

                                if (mysqli_num_rows($menus) > 0) {
                                    foreach ($menus as $data) {
                                ?>
                                        <tr>
                                            <td>
                                                <img src="../uploads/<?= $data['image']; ?>" width="100px" height="100px">
                                            </td>
                                            <td><?= $data['foodname']; ?></td>
                                            <td><?= $data['foodtype']; ?></td>
                                            <td><?= $data['foodprice']; ?></td>
                                            <td><?= $data['foodserving']; ?></td>
                                            <td>
                                                <a href="editmenu.php?id=<?= $data['id']; ?>" class="btn btn-primary">EDIT</a>
                                                <button type="button" class="btn btn-danger" onclick="setDeleteIdAndName(<?= $data['id']; ?>, '<?= $data['foodname']; ?>')" data-bs-toggle="modal" data-bs-target="#deleteMenuModal">DELETE</button>

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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Food Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--FORM-->
                <form id="foodForm" action="../code.php" method="post" enctype="multipart/form-data">
                    <div class="form-group m-3">
                        <label for="">Food Name</label>
                        <input type="text" id="foodname" name="foodname" class="form-control" placeholder="Food Name" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" required>
                    </div>
                    <div class="form-group m-3">
                        <label for="">Food Category</label>
                        <select class="form-select" name="foodtype" aria-label="Default select example" required>
                            <option value="Pork">Pork</option>
                            <option value="Beef">Beef</option>
                            <option value="Chicken">Chicken</option>
                            <option value="Fish">Fish</option>
                            <option value="Vegetables">Vegetables</option>
                            <option value="Seafood">Seafood</option>
                            <option value="Desserts">Desserts</option>
                            <option value="Drinks">Drinks</option>
                            <option value="Pasta">Pasta</option>
                            <option value="Pancit">Pancit</option>
                            <option value="Soup">Soup</option>
                            <option value="Lechon">Lechon</option>
                            <option value="Appetizer">Appetizer</option>
                            <option value="Kakanin">Kakanin</option>
                        </select>
                    </div>
                    <div class="form-group m-3">
                        <label for="">Food Price</label>
                        <input type="text" name="foodprice" class="form-control" placeholder="Food Price" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"  min="100" required>
                    </div>
                    <div class="form-group m-3">
                        <label for="">Food Serving</label>
                        <select class="form-select" name="foodserving" aria-label="Default select example" required>
                            <option value="Tray">Tray</option>
                            <option value="Piece">Piece</option>
                            <option value="Tub">Tub</option>
                            <option value="Pitcher">Pitcher</option>
                            <option value="Couldron">Couldron</option>
                            <option value="10 to 100 person">10 to 100 person</option>
                            <option value="10 to 40 person">10 to 40 person</option>
                            <option value="Bottle">Bottle</option>
                            <option value="Bilao">Bilao</option>
                        </select>
                    </div>
                    <div class="form-group m-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save_food" class="btn btn-primary">Add Food Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteMenuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Delete <span id="foodNameToDeleteHeader"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../code.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="deleteFoodId" name="menu_id" value="">
                    <h1 class="text">Are you sure you want to delete <span id="foodNameToDeleteBody"></span> in Food Menu?</h1>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="delete_food" class="btn btn-outline-danger">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteIdAndName(id, foodName) {
        document.getElementById('deleteFoodId').value = id;
        document.getElementById('foodNameToDeleteHeader').textContent = foodName;
        document.getElementById('foodNameToDeleteBody').textContent = foodName;
    }
</script>



<?php include('../include/footer.php'); ?>