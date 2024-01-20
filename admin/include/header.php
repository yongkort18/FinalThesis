<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include('../functions/myfunctions.php');
    ?>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?php
    $maintenance = getAll("tbl_maintenance");

    if (mysqli_num_rows($maintenance) > 0) {
        foreach ($maintenance as $data) {
    ?>
     <link rel="shortcut icon" type="x-icon" href="../logo/<?= $data['image'] ?>">
    <?php
        }
    } else {
        echo "No Records Found";
    }
    ?>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../assets/css/alertify.min.css" />
    <link rel="stylesheet" href="../assets/css/default.min.css" />

    
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>


    <!-- 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    -->

<style>
    .text{
        font-family: sans-serif;
        font-size: 24px;
        font-weight: bolder;
    }
</style>
</head>


<body id="page-top">
    <div id="wrapper">
        <?php include '../include/sidebar.php'; ?>