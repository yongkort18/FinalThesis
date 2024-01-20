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

<title>FAQ Maintenance</title>

<main id="main" class="main">
    <section class="section mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($_GET['id'])) 
                    {
                        $id = $_GET['id'];
                        $faq = getByID("tbl_faq", $id);

                        if (mysqli_num_rows($faq) > 0) 
                        {
                            $data = mysqli_fetch_array($faq);
                    ?>
                            <div class="card-header">
                                <H1>Edit FAQ for <?= $data['question'] ?>  </H1>
                            </div>
                            <div class="card-body">

                                <!--FORM-->
                                <form action="../code.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group m-3">
                                        <input type="hidden" name="faq_id" value="<?= $data['id'] ?>">
                                        <label for="">Question:</label>
                                        <input type="text" name="question" value="<?= $data['question'] ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group m-3">
                                        <label for="">Answer:</label>
                                        <textarea name="answer" rows="10" cols="20" class="form-control" required><?= $data['answer'] ?></textarea>
                                    </div>
                                    <div class="form-group text-end">
                                        <a href="contact.php" class="btn btn-secondary me-2">Close</a>
                                        <button type="submit" name="update_faq" class="btn btn-primary">Save</button>
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