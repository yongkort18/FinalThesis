<?php include('included/header.php'); ?>

<title>About Us</title>

<style>
    .image-container {
        position: relative;
        overflow: hidden;
        margin-top: 100px;
    }

    .cover-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
    }

    .service-card {
        position: relative;
        overflow: hidden;
    }

    .service-type-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.7);
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .service-card:hover .service-type-overlay {
        opacity: 1;
    }

    .service-image {
        width: 400px;
        height: 400px;
        object-fit: cover;
    }
</style>

<?php
$about = getAll("tbl_about");
if (mysqli_num_rows($about) > 0) {
    foreach ($about as $data) {
?>
        <div class="image-container">
            <img src="admin/logo/<?= $data['image'] ?>" alt="Event Management Image" class="cover-image">
            <div class="overlay-text">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="about-us-content text-center">
                                <h2 class="about-us-heading"><?= $data['heading']; ?></h2>
                                <p class="about-us-text">
                                    <?= $data['paragraph']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "No Records Found";
}
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12 text-center my-5">
            <h1 class="title">Catering Services</h1>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 text-center">
        <?php
        $about = getAll("tbl_services");
        if (mysqli_num_rows($about) > 0) {
            foreach ($about as $data) {
        ?>
                <div class="col">
                    <div class="service-card position-relative">
                        <img src="admin/services/<?= $data['image']; ?>" class="my-3 img-fluid service-image" alt="<?= $data['servicesType']; ?>">
                        <div class="service-type-overlay">
                            <h4 class="title m-3"><?= $data['servicesType']; ?></h4>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No Records Found";
        }
        ?>
    </div>
</div>


<?php include('included/footer.php'); ?>