<?php include('included/header.php'); ?>

<title>Home</title>

<link rel="stylesheet" href="assets/css/index.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
<style>
    .card img {
        display: block;
        margin: 0 auto;
    }

    .title {

        color: #333;
        font-weight: bold;
        text-align: center;
        font-family: 'Montserrat', sans-serif;
    }

    @media (max-width: 768px) {
        .title {
            font-size: 1.5rem;
        }
    }
    
    @media (max-width: 700px) and (min-width: 401px) {
    .carousel-caption h1,
    .carousel-caption a.btn {
      display: block !important;
    }
  }

  @media (max-width: 400px) {
    .carousel-caption h1,
    .carousel-caption a.btn {
      display: block !important;
    }
  }
  #fullscreen-container {
        display: none;
        position: fixed;
        top: 10px;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    #fullscreen-image {
        max-width: 90%;
        max-height: 90%;
        border-radius: 10px;
    }

    #close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #fff;
        cursor: pointer;
        font-size: 50px;
        z-index: 1001;
    }
</style>
<div class="content" style="margin-top: 100px;">
    <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">
        <?php
        $carousel = getAll("tbl_carousel");

        if (mysqli_num_rows($carousel) > 0) {
            $active = "active";
            foreach ($carousel as $data) {
                ?>
                <div class="carousel-item <?= $active; ?>">
                    
                        <img src="admin/logo/<?= $data['image']; ?>" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= $data['description']; ?></h5>
                        </div>
                    
                </div>
                <?php
                $active = ""; // Remove 'active' class after the first iteration
            }
        } else {
            echo "No Records Found";
        }
        ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

    <!--SERVICE-->
   
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12 text-center my-5">
                <h1 class="title">Our Services Offered</h1>
            </div>
        </div>
    
        <div class="row row-cols-1 row-cols-md-3 g-4 text-center">
            <?php
                $servername = "localhost";
                $username = "u562528100_loreto";
                $password = "Loreto2024!";
                $db_name = "u562528100_cateringdb";
                
                $con = mysqli_connect($servername, $username, $password, $db_name);
                
                $query = "SELECT * FROM tbl_management WHERE status = 0";
                $query_run = mysqli_query($con, $query);
            
                if (mysqli_num_rows($query_run) > 0) {
                    while ($data = mysqli_fetch_assoc($query_run)) {
            ?>
                        <div class="col">
                            <img src="admin/logo/<?= $data['image']; ?>" class="rounded-5 bg-warning fullscreen-trigger" width="200px" height="200px">
                            <h4 class="title m-3"><?= $data['description']; ?></h4>
                        </div>
            <?php
                    }
                } else {
                    echo "No Records Found";
                }
            ?>
        </div>
    </div>
    
    <div id="fullscreen-container">
        <span id="close-btn">&times;</span>
        <img id="fullscreen-image" src="" alt="Fullscreen Image">
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var images = document.querySelectorAll('.fullscreen-trigger');

        images.forEach(function (image) {
            image.addEventListener('click', function () {
                document.getElementById('fullscreen-container').style.display = 'flex';
                document.getElementById('fullscreen-image').src = this.src;
            });
        });

        document.getElementById('close-btn').addEventListener('click', function () {
            document.getElementById('fullscreen-container').style.display = 'none';
        });
    });
</script>
<?php include('included/footer.php'); ?>