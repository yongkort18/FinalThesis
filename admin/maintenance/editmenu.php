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

<title>Menu Maintenance</title>

<main id="main" class="main">
    <section class="section mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $menu = getByID("tbl_menu", $id);

                        if (mysqli_num_rows($menu) > 0) {
                            $data = mysqli_fetch_array($menu);
                    ?>
                            <div class="card-header">
                                <h5 class="modal-title" >Edit Food Item for <?= $data['foodname'] ?>  </h5>
                            </div>
                            <div class="card-body">

                                <!--FORM-->
                                <form action="../code.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group m-3">
                                        <input type="hidden" name="menu_id" value="<?= $data['id'] ?>">
                                        <label for="">Food Name</label>
                                        <input type="text" name="foodname" value="<?= $data['foodname'] ?>" class="form-control" placeholder="Foodname" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" required>
                                    </div>
                                    <div class="form-group m-3">
                                        <label for="">Food Category</label>
                                        <select class="form-select" name="foodtype" aria-label="Default select example" required>
                                            <option selected><?= $data['foodtype'] ?></option>
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
                                        <input type="text" name="foodprice" value="<?= $data['foodprice'] ?>" class="form-control" placeholder="Food Price"  onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" required>
                                    </div>
                                    <div class="form-group m-3">
                                        <label for="">Food Serving</label>
                                        <select class="form-select" name="foodserving" aria-label="Default select example" required>
                                            <option selected><?= $data['foodserving'] ?></option>
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
                                        <label for="">Image</label>
                                       <input type="file" name="image" id="image" class="form-control" accept=".jpg, .jpeg, .png">
                                        <label for="">Current Image:</label>
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                        <img src="../uploads/<?= $data['image'] ?>" width="100px" height="100px" alt="">
                                    </div>
                                    <div class="modal-footer">
                                        <a href="menu.php" class="btn btn-secondary me-2">Close</a>
                                        <button type="submit" name="update_food" class="btn btn-primary me-3">Save changes</button>
                                    </div>
                                </form>
                            </div>
                    <?php
                        } else {
                            echo "Menu Item not found";
                        }
                    } else {
                        echo "ID is missing in url";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('../include/footer.php'); ?>