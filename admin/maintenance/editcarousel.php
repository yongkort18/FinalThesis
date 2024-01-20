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

<title>Carousel Maintenance</title>

<main id="main" class="main">
    <section class="section mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($_GET['id'])) 
                    {
                        $id = $_GET['id'];
                        $carousel = getByID("tbl_carousel", $id);

                        if (mysqli_num_rows($carousel) > 0) 
                        {
                            $data = mysqli_fetch_array($carousel);
                    ?>
                            <div class="card-header">
                                <H1>Edit Carousel Image and Description</H1>
                            </div>
                            <div class="card-body">

                                <!--FORM-->
                                <form action="../code.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group m-3">
                                        <input type="hidden" name="carousel_id" value="<?= $data['id'] ?>">
                                        <label for="">Description:</label>
                                        <textarea name="description" rows="5" cols="20" class="form-control" required><?= $data['description'] ?></textarea>
                                        
                                    </div>
                                    <div class="form-group m-3">
                                        <label for="">New Image</label>
                                        <input type="file" name="image" accept=".jpg, .jpeg, .png" class="form-control">
                                        <label for="">Current Image:</label>
                                        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                        <img src="../logo/<?= $data['image'] ?>" width="100px" height="100px" alt="">
                                    </div>
                                    
                                    <div class="form-group text-end">
                                        <a href="maintenance.php" class="btn btn-secondary me-2">Close</a>
                                        <button type="submit" name="update_carousel" class="btn btn-primary">Save</button>
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