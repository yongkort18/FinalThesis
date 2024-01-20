<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include('functions/userfunctions.php');
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $maintenance = getAll("tbl_maintenance");

    if (mysqli_num_rows($maintenance) > 0) {
        foreach ($maintenance as $data) {
    ?>
     <link rel="shortcut icon" type="x-icon" href="admin/logo/<?= $data['image'] ?>">
    <?php
        }
    } else {
        echo "No Records Found";
    }
    ?>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
    <?php include('navbar.php'); ?>