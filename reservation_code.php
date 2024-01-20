<?php

include ('database/dbconn.php');
include('functions/myfunctions.php');

if(isset($_POST['Save_Reservation']))
{
    $user_name = mysqli_escape_string($con, $_POST['user_name']);
    $number = mysqli_escape_string($con, $_POST['number']);
    $email = mysqli_escape_string($con, $_POST['email']);
    $date = mysqli_escape_string($con, $_POST['date']);
    $food_package =  mysqli_escape_string($con, $_POST['food_package']);
    $price =  mysqli_escape_string($con, $_POST['price']);
    $pax =  mysqli_escape_string($con, $_POST['pax']);
    $total =  mysqli_escape_string($con, $_POST['total']);

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_extensions = array("png", "jpeg", "jpg");

    if (!in_array($image_ext, $allowed_extensions)) {
        redirect("reservation.php", "Only PNG, JPEG, and JPG files are allowed");
        exit(); 
    }

    $filename = time() . '.' . $image_ext;
    $path = "./admin/fee_receipt";
 
    $menu_query = "INSERT INTO tbl_reservation (user_name, number, email, date, food_package, price, pax, total, image)
        VALUES ('$user_name', '$number', '$email', '$date', '$food_package', '$price', '$pax', '$total', '$filename')";

    $menu_query_run = mysqli_query($con, $menu_query);

    if ($menu_query_run) {
        move_uploaded_file($image_tmp, $path . '/' . $filename);
        redirect("reservation.php", "Food Item Added Successfully");
    } else {
        redirect("reservation.php", "Something Went Wrong");
    }
}

?>