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

<title>REPORT FOODS</title>

<main id="main" class="main">
    <section class="section mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="modal-title" >REPORT FOOD</H5>
                        <button class="btn btn-success" id="PrintButton" onclick="PrintPage()">Print</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped-columns" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    
                                    <th>Food Name</th>
                                    <th>Food Category</th>
                                    <th>Food Price</th>
                                    <th>Food Serving</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $menus = getAll("tbl_menu");

                                if (mysqli_num_rows($menus) > 0) {
                                    foreach ($menus as $data) {
                                ?>
                                        <tr>
                                           
                                            <td><?= $data['foodname']; ?></td>
                                            <td><?= $data['foodtype']; ?></td>
                                            <td><?= $data['foodprice']; ?></td>
                                            <td><?= $data['foodserving']; ?></td>
                                            
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

<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
</script>