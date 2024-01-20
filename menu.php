
<?php include('included/header.php'); ?>

<title>Menu</title>

<style>    
    .section-left {
        position: fixed;
        left: 40;
        margin-top: 125px;
        width: 200px;
        background-color: #f8f9fa;
        border-right: 1px solid #dee2e6;
        height: 100%;
        overflow-y: auto;
    }
    
    .left-sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .left-sidebar-nav li {
        margin-bottom: 10px;
        border-radius: 8px;
        overflow: hidden;
    }

    .left-sidebar-nav li a {
        display: block;
        padding: 10px;
        text-decoration: none;
        border-radius: inherit;
    }

    .section-right {
        margin-left: 180px;
        padding: 20px;
    }

    .card.text-center {
        margin-bottom: 20px;
    }

    .card {
        width: 100%; 
        max-width: 300px; 
        height: 100%; 
        padding: 10px;
    }

    .img-wrapper {
        position: relative;
        width: 100%; /* Change width to 100% for responsiveness */
        padding-top: 100%;
        overflow: hidden;
    }
    
    .scroll-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }

    .img-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 25px;
    }

    @media (max-width: 768px) {
        .section-left {
            position: static;
            width: 100%;
            border-right: none;
            margin-bottom: 20px;
        }

        .section-right {
            margin-left: 0;
            padding: 10px; /* Optional: adjust padding for smaller screens */
        }
    }
</style>

<div class="container">
    <div class="row">
        <div class="section-left col-md-1 border rounded-3 bg-warning">
            <h5>CATEGORY LIST</h5>
            <ul class="left-sidebar-nav">
                <?php
                $menus = getAll("tbl_menu");

                if (mysqli_num_rows($menus) > 0) {
                    $foodCategory = array();

                    foreach ($menus as $item) {
                        $foodType = $item['foodtype'];
                        if (!isset($foodCategory[$foodType])) {
                            $foodCategory[$foodType] = array();
                        }
                        $foodCategory[$foodType][] = $item;
                    }

                    foreach ($foodCategory as $foodType => $foodItems) {
                        ?>
                        <li>
                            <a href="#<?= $foodType; ?>">
                                <span><?= $foodType; ?></span>
                            </a>
                        </li>
                        <?php
                    }
                } else {
                    echo "No data available";
                }
                ?>
            </ul>
        </div>

        <div class="section-right col-md-11 col-sm-12">
            <div class="header" style="margin-top: 125px;">
                <h1 class="title text-center">FOOD CATEGORY</h1>
            </div>

            <?php
            if (mysqli_num_rows($menus) > 0) {
                foreach ($foodCategory as $foodType => $foodItems) {
                    ?>
                    <div class="card-body section" id="<?= $foodType; ?>">
                        <hr><h1 class="header text-center m-3"><?= $foodType; ?></h1><hr>
                        <div class="row justify-content-center">
                            <?php foreach ($foodItems as $foodItem) { ?>
                                <div class="col-sm-3 p-3">
                                    <div class="card text-center">
                                        <div class="image mt-4">
                                            <div class="img-wrapper">
                                                <img src="admin/uploads/<?= $foodItem['image']; ?>" alt="Food Image" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="foodname m-2"><?= $foodItem['foodname']; ?></h5>
                                            <p class="product_price my-4"><span>&#8369;</span><?= number_format($foodItem['foodprice'], 2); ?> per <?= $foodItem['foodserving']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No data available";
            }
            ?>
        </div>
    </div>
</div>

<div class="mt-5">
    <h4 class="text-center">Copyright &#9400; 2023 Loreto's Event Management</h4>
</div>

<div class="scroll-to-top">
    <button onclick="topFunction()" class="btn btn-primary" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i> </button>
</div>

<script>
    // Scroll to Top
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        var mybutton = document.getElementById("myBtn");

        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
</script>

<?php include('included/footer.php'); ?>