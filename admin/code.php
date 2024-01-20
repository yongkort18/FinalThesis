<?php

include ('connect.php');
include('../functions/myfunctions.php');

// MENU CODE
if (isset($_POST['save_food']))
{
    $foodname = filter_var(mysqli_real_escape_string($con, $_POST['foodname']), FILTER_SANITIZE_STRING);
    $foodtype = filter_var(mysqli_real_escape_string($con, $_POST['foodtype']), FILTER_SANITIZE_STRING);
    $foodprice = filter_var(mysqli_real_escape_string($con, $_POST['foodprice']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $foodserving = filter_var(mysqli_real_escape_string($con, $_POST['foodserving']), FILTER_SANITIZE_STRING);

    $check_food_query = "SELECT * FROM tbl_menu WHERE foodname = ?";
    $stmt = mysqli_prepare($con, $check_food_query);
    mysqli_stmt_bind_param($stmt, "s", $foodname);
    mysqli_stmt_execute($stmt);
    $check_food_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($check_food_result) > 0) {
        redirect("../admin/maintenance/menu.php", "Food Name already exists");
        exit();
    }

    $check_image_query = "SELECT * FROM tbl_menu WHERE image = '$filename'";
    $check_image_result = mysqli_query($con, $check_image_query);

    if (mysqli_num_rows($check_image_result) > 0) {
        redirect("../admin/maintenance/menu.php", "The Image already exists");
        exit();
    }

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    
    $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_extensions = array("png", "jpeg", "jpg");

    if (!in_array($image_ext, $allowed_extensions)) {
        redirect("../admin/maintenance/menu.php", "Only PNG, JPEG, and JPG files are allowed");
        exit(); 
    }

    $filename = time() . '.' . $image_ext;
    $path = "uploads";

    $menu_query = "INSERT INTO tbl_menu (foodname, foodtype, foodprice, foodserving, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $menu_query);
    mysqli_stmt_bind_param($stmt, "ssdss", $foodname, $foodtype, $foodprice, $foodserving, $filename);
    $menu_query_run = mysqli_stmt_execute($stmt);

    if ($menu_query_run) {
        move_uploaded_file($image_tmp, $path . '/' . $filename);
        redirect("../admin/maintenance/menu.php", "Food Item Added Successfully");
    } else {
        redirect("../admin/maintenance/menu.php", "Something Went Wrong");
    }
}

else if (isset($_POST['update_food']))
{
    $menu_id = mysqli_real_escape_string($con, $_POST['menu_id']);
    $foodname = filter_var(mysqli_real_escape_string($con, $_POST['foodname']), FILTER_SANITIZE_STRING);
    $foodtype = filter_var(mysqli_real_escape_string($con, $_POST['foodtype']), FILTER_SANITIZE_STRING);
    $foodprice = filter_var(mysqli_real_escape_string($con, $_POST['foodprice']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $foodserving = filter_var(mysqli_real_escape_string($con, $_POST['foodserving']), FILTER_SANITIZE_STRING);
    
    $check_duplicate_query = "SELECT id FROM tbl_menu WHERE foodname=? AND id <> ?";
    $check_stmt = mysqli_prepare($con, $check_duplicate_query);
    mysqli_stmt_bind_param($check_stmt, "si", $foodname, $menu_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        redirect("../admin/maintenance/editmenu.php?id=$menu_id", "Food name already exists. Choose a different name.");
        exit();
    }
    
    $new_image = $_FILES['image'];
    $old_image = mysqli_real_escape_string($con, $_POST['old_image']);

    if (!empty($new_image['name']) && !file_exists($new_image['tmp_name'])) {
        redirect("../admin/maintenance/editmenu.php?id=$menu_id", "Please upload a valid image");
        exit();
    }

    if ($new_image['name'] != "") {
        $image_ext = strtolower(pathinfo($new_image['name'], PATHINFO_EXTENSION));
        $allowed_extensions = array("png", "jpeg", "jpg");

        if (in_array($image_ext, $allowed_extensions)) {
            $update_filename = time() . '.' . $image_ext;
        } else {
            redirect("../admin/maintenance/editmenu.php?id=$menu_id", "Only PNG, JPEG, and JPG files are allowed");
            exit();
        }
    } else {
        $update_filename = $old_image;
    }

    $path = "uploads";

    $update_query = "UPDATE tbl_menu SET foodname=?, foodtype=?, foodprice=?, foodserving=?, image=? WHERE id=?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, "sssssi", $foodname, $foodtype, $foodprice, $foodserving, $update_filename, $menu_id);
    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        if (!empty($new_image['name'])) {
            move_uploaded_file($new_image['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("uploads/" . $old_image)) {
                unlink("uploads/" . $old_image);
            }
        }
        redirect("../admin/maintenance/editmenu.php?id=$menu_id", "Food Item Updated Successfully");
    } else {
        redirect("../admin/maintenance/editmenu.php?id=$menu_id", "Something Went Wrong");
    }
}

else if (isset($_POST['delete_food'])) 
{
    $menu_id = mysqli_real_escape_string($con, $_POST['menu_id']);

    $menu_query = "SELECT * FROM tbl_menu WHERE id='$menu_id'";
    $menu_query_run = mysqli_query($con, $menu_query);
    $menu_data = mysqli_fetch_array($menu_query_run);
    $image = $menu_data['image'];

    $delete_query = "DELETE FROM tbl_menu WHERE id=?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $menu_id);
    $delete_query_run = mysqli_stmt_execute($stmt);

    if ($delete_query_run) 
    {
        if (file_exists("uploads/" . $image)) 
        {
            unlink("uploads/" . $image);
        }

        redirect("../admin/maintenance/menu.php", "Food Item Deleted Successfully");
    } 
    else 
    {
        redirect("../admin/maintenance/menu.php", "Something Went Wrong");
    }
}

// ABOUT CODE
if (isset($_POST['update_about']))
{
    $about_id = $_POST['about_id'];
    $heading = filter_var(mysqli_real_escape_string($con, $_POST['heading']), FILTER_SANITIZE_STRING);
    $paragraph = filter_var(mysqli_real_escape_string($con, $_POST['paragraph']), FILTER_SANITIZE_STRING);

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if (!empty($new_image)) {
        $image_ext = strtolower(pathinfo($new_image, PATHINFO_EXTENSION));
        $allowed_extensions = array("png", "jpeg", "jpg");

        if (!in_array($image_ext, $allowed_extensions)) {
            redirect("../admin/maintenance/about.php", "Only PNG, JPEG, and JPG files are allowed");
            exit();
        }

        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $path = "logo";

    $update_query = "UPDATE tbl_about SET heading=?, paragraph=?, image=? WHERE id=?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, "sssi", $heading, $paragraph, $update_filename, $about_id);
    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        if (!empty($new_image)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("logo/" . $old_image)) {
                unlink("logo/" . $old_image);
            }
        }

        redirect("../admin/maintenance/about.php", "About Us Updated Successfully");
    } else {
        redirect("../admin/maintenance/about.php", "Something Went Wrong");
    }
}

// SERVICE CODE
if (isset($_POST['add_services']))
{
    $count_query = "SELECT COUNT(*) AS count FROM tbl_services";
    $count_result = mysqli_query($con, $count_query);
    $count_data = mysqli_fetch_assoc($count_result);
    $current_count = $count_data['count'];

    if ($current_count < 10) {
        $servicesType = filter_var(mysqli_real_escape_string($con, $_POST['servicesType']), FILTER_SANITIZE_STRING);

        $check_service_query = "SELECT * FROM tbl_services WHERE servicesType = ?";
        $stmt = mysqli_prepare($con, $check_service_query);
        mysqli_stmt_bind_param($stmt, "s", $servicesType);
        mysqli_stmt_execute($stmt);
        $check_service_result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($check_service_result) > 0) {
            redirect("../admin/maintenance/about.php", "Services Type already exists");
            exit();
        }

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        if (empty($image) || !file_exists($image_tmp)) {
            redirect("../admin/maintenance/about.php", "Please upload a valid image");
            exit();
        }

        $path = "services";

        $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $allowed_extensions = array("png", "jpeg", "jpg");

        if (!in_array($image_ext, $allowed_extensions)) {
            redirect("../admin/maintenance/about.php", "Only PNG, JPEG, and JPG files are allowed");
            exit();
        }

        $filename = time() . '.' . $image_ext;

        $services_query = "INSERT INTO tbl_services (servicesType, image) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $services_query);
        mysqli_stmt_bind_param($stmt, "ss", $servicesType, $filename);
        $services_query_run = mysqli_stmt_execute($stmt);

        if ($services_query_run) {
            move_uploaded_file($image_tmp, $path . '/' . $filename);
            redirect("../admin/maintenance/about.php", "Services Added Successfully");
        } else {
            redirect("../admin/maintenance/about.php", "Something Went Wrong");
        }
    } else {
        redirect("../admin/maintenance/contact.php", "Limit of 10 entries reached");
    }
}

else if (isset($_POST['update_services']))
{
    $services_id = mysqli_real_escape_string($con, $_POST['services_id']);
    $servicesType = mysqli_real_escape_string($con, $_POST['servicesType']);
    
    $check_duplicate_query = "SELECT id FROM tbl_services WHERE servicesType=? AND id <> ?";
    $check_stmt = mysqli_prepare($con, $check_duplicate_query);
    mysqli_stmt_bind_param($check_stmt, "si", $servicesType, $services_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        redirect("../admin/maintenance/editservices.php?id=$services_id", "Service type already exists. Choose a different type.");
        exit();
    }
    
    $new_image = $_FILES['image'];
    $old_image = $_POST['old_image'];

    if (!empty($new_image['name']) && !file_exists($new_image['tmp_name'])) {
        redirect("../admin/maintenance/editservices.php?id=$services_id", "Please upload a valid image");
        exit(); 
    }

    if ($new_image['name'] != "") {
        $image_ext = pathinfo($new_image['name'], PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $path = "services";

    $update_query = "UPDATE tbl_services SET servicesType=?, image=? WHERE id=?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, "ssi", $servicesType, $update_filename, $services_id);
    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        if (!empty($new_image['name'])) {
            move_uploaded_file($new_image['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("services/" . $old_image)) {
                unlink("services/" . $old_image);
            }
        }
        redirect("../admin/maintenance/editservices.php?id=$services_id", "Services Updated Successfully");
    } else {
        redirect("../admin/maintenance/editservices.php?id=$services_id", "Something Went Wrong");
    }
}

else if (isset($_POST['delete_services'])) 
{
    $services_id = mysqli_real_escape_string($con, $_POST['services_id']);

    $services_query = "SELECT * FROM tbl_services WHERE id='$services_id'";
    $services_query_run = mysqli_query($con, $services_query);
    $services_data = mysqli_fetch_array($services_query_run);
    $image = $services_data['image'];

    $services_query = "DELETE FROM tbl_services WHERE id=?";
    $stmt = mysqli_prepare($con, $services_query);
    mysqli_stmt_bind_param($stmt, "i", $services_id);
    mysqli_stmt_execute($stmt);
    $services_query_run = mysqli_stmt_get_result($stmt);

    if ($delete_query_run) 
    {
        if (file_exists("services/".$image)) 
        {
            unlink("services/".$image);
        }

        redirect("../admin/maintenance/about.php", "Services Deleted Successfully");
    } 
    else 
    {
        redirect("../admin/maintenance/about.php", "Services Deleted Successfully");
    }
}

// REVIEW CODE 
if (isset($_POST['archive_review'])) {
    $review_id = mysqli_real_escape_string($con, $_POST['review_id']);

    $delete_query = "UPDATE review SET status = 1 WHERE id = ?";
    $stmt = mysqli_prepare($con, $delete_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $review_id);
        $delete_query_run = mysqli_stmt_execute($stmt);

        if ($delete_query_run) {
            redirect("../admin/maintenance/review.php", "Review Deleted Successfully");
        } else {
            redirect("../admin/maintenance/review.php", "Something Went Wrong");
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("../admin/maintenance/review.php", "Error preparing statement");
    }
}

else if (isset($_POST['restore_review'])) {
    $review_id = mysqli_real_escape_string($con, $_POST['review_id']);

    $delete_query = "UPDATE review SET status = 0 WHERE id = ?";
    $stmt = mysqli_prepare($con, $delete_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $review_id);
        $delete_query_run = mysqli_stmt_execute($stmt);

        if ($delete_query_run) {
            redirect("../admin/maintenance/archive.php", "Review Restored Successfully");
        } else {
            redirect("../admin/maintenance/archive.php", "Something Went Wrong");
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("../admin/maintenance/archive.php", "Error preparing statement");
    }
}

else if (isset($_POST['delete_review'])) 
{
    $review_id = mysqli_real_escape_string($con, $_POST['review_id']);
   
    $delete_query = "DELETE FROM review WHERE id=?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $review_id);
    $delete_query_run = mysqli_stmt_execute($stmt);

    if ($delete_query_run) 
    {
        redirect("../admin/maintenance/archive.php", "Review Deleted Successfully");
    } 
    else
    {
        redirect("../admin/maintenance/archive.php", "Something Went Wrong");
    }
} 

// CONTACT CODE 
if (isset($_POST['update_contact']))
{
    $contact_id = $_POST['contact_id'];
    $Intro = filter_var(mysqli_real_escape_string($con, $_POST['Intro']), FILTER_SANITIZE_STRING);
    $Location = filter_var(mysqli_real_escape_string($con, $_POST['Location']), FILTER_SANITIZE_STRING);
    $Email = filter_var(mysqli_real_escape_string($con, $_POST['Email']), FILTER_SANITIZE_EMAIL);
    $Phone = filter_var(mysqli_real_escape_string($con, $_POST['Phone']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $update_query = "UPDATE tbl_contact SET Intro=?, Location=?, Email=?, Phone=? WHERE id=?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, "ssssi", $Intro, $Location, $Email, $Phone, $contact_id);
    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        redirect("../admin/maintenance/contact.php", "Contact Updated Successfully");
    } else {
        redirect("../admin/maintenance/contact.php", "Something Went Wrong");
    }
}

// FAQ CODE
if (isset($_POST['add_faq']))
{
    $count_query = "SELECT COUNT(*) AS count FROM tbl_faq";
    $count_result = mysqli_query($con, $count_query);
    $count_data = mysqli_fetch_assoc($count_result);
    $current_count = $count_data['count'];

    if ($current_count < 10) {
        $question = filter_var(mysqli_real_escape_string($con, $_POST['question']), FILTER_SANITIZE_STRING);
        $answer = filter_var(mysqli_real_escape_string($con, $_POST['answer']), FILTER_SANITIZE_STRING);
        
        $check_question_query = "SELECT * FROM tbl_faq WHERE question = ?";
        $stmt = mysqli_prepare($con, $check_question_query);
        mysqli_stmt_bind_param($stmt, "s", $question);
        mysqli_stmt_execute($stmt);
        $check_question_result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($check_question_result) > 0) {
            redirect("../admin/maintenance/contact.php", "Question already exists");
            exit();
        }

        $faq_query = "INSERT INTO tbl_faq (question, answer) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $faq_query);
        mysqli_stmt_bind_param($stmt, "ss", $question, $answer);
        $faq_query_run = mysqli_stmt_execute($stmt);

        if ($faq_query_run) {
            redirect("../admin/maintenance/contact.php", "FAQ Added Successfully");
        } else {
            redirect("../admin/maintenance/contact.php", "Something Went Wrong");
        }
    } else {
        redirect("../admin/maintenance/contact.php", "Limit of 10 entries reached");
    }
}

else if (isset($_POST['update_faq']))
{
    $faq_id = $_POST['faq_id'];
    $question = filter_var(mysqli_real_escape_string($con, $_POST['question']), FILTER_SANITIZE_STRING);
    $answer = filter_var(mysqli_real_escape_string($con, $_POST['answer']), FILTER_SANITIZE_STRING);

    $update_query = "UPDATE tbl_faq SET question=?, answer=? WHERE id=?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, "ssi", $question, $answer, $faq_id);
    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        redirect("../admin/maintenance/editfaq.php?id=$faq_id", "FAQ Updated Successfully");
    } else {
        redirect("../admin/maintenance/editfaq.php?id=$faq_id", "Something Went Wrong");
    }
}

else if (isset($_POST['delete_faq'])) 
{
    $faq_id = mysqli_real_escape_string($con, $_POST['faq_id']);

    $delete_query = "DELETE FROM tbl_faq WHERE id=?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $faq_id);
    $delete_query_run = mysqli_stmt_execute($stmt);


    if ($delete_query_run) 
    {
        redirect("../admin/maintenance/contact.php", "FAQ Deleted Successfully");
    } 
    else 
    {
        redirect("../admin/maintenance/contact.php", "Something Went Wrong");
    }
}

// MAINTENANCE CODE
if (isset($_POST['update_maintenance']))
{
    $maintenance_id = $_POST['maintenance_id'];
    $titlepage = filter_var(mysqli_real_escape_string($con, $_POST['titlepage']), FILTER_SANITIZE_STRING);
    $navcolor = filter_var(mysqli_real_escape_string($con, $_POST['navcolor']), FILTER_SANITIZE_STRING);
    $bgcolor = filter_var(mysqli_real_escape_string($con, $_POST['bgcolor']), FILTER_SANITIZE_STRING);

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if (!empty($new_image)) {
        $image_ext = strtolower(pathinfo($new_image, PATHINFO_EXTENSION));
        $allowed_extensions = array("png", "jpeg", "jpg");

        if (in_array($image_ext, $allowed_extensions)) {
            $update_filename = time() . '.' . $image_ext;
        } else {
            redirect("../admin/maintenance/maintenance.php", "Only PNG, JPEG, and JPG files are allowed");
            exit();
        }
    } else {
        $update_filename = $old_image;
    }

    $path = "logo";

    $update_query = "UPDATE tbl_maintenance SET titlepage=?, navcolor=?, bgcolor=?, image=? WHERE id=?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, "ssssi", $titlepage, $navcolor, $bgcolor, $update_filename, $maintenance_id);
    $update_query_run = mysqli_stmt_execute($stmt);

    if ($update_query_run) {
        if (!empty($new_image)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("logo/" . $old_image)) {
                unlink("logo/" . $old_image);
            }
        }

        redirect("../admin/maintenance/maintenance.php", "Maintenance Updated Successfully");
    } else {
        redirect("../admin/maintenance/maintenance.php", "Something Went Wrong");
    }
}

if (isset($_POST['add_image'])) {
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    
    $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_extensions = array("png", "jpeg", "jpg");

    if (!in_array($image_ext, $allowed_extensions)) {
        redirect("../admin/maintenance/maintenance.php", "Only PNG, JPEG, and JPG files are allowed");
        exit(); 
    }

    $filename = time() . '.' . $image_ext;
    $path = "logo";

    $menu_query = "INSERT INTO tbl_carousel (description, image)
        VALUES ('$description', '$filename')";

    $menu_query_run = mysqli_query($con, $menu_query);

    if ($menu_query_run) {
        move_uploaded_file($image_tmp, $path . '/' . $filename);
        redirect("../admin/maintenance/maintenance.php", "IMAGE Added Successfully");
    } else {
        redirect("../admin/maintenance/maintenance.php", "Something Went Wrong");
    }
}

else if (isset($_POST['update_carousel'])) {
    $carousel_id = mysqli_real_escape_string($con, $_POST['carousel_id']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $new_image = $_FILES['image'];
    $old_image = $_POST['old_image'];

    if ($new_image['name'] != "") {
        $image_ext = strtolower(pathinfo($new_image['name'], PATHINFO_EXTENSION));
        $allowed_extensions = array("png", "jpeg", "jpg");

        if (in_array($image_ext, $allowed_extensions)) {
            $update_filename = time() . '.' . $image_ext;
        } else {
            redirect("../admin/maintenance/editcarousel.php?id=$carousel_id", "Only PNG, JPEG, and JPG files are allowed");
            exit();
        }
    } else {
        $update_filename = $old_image;
    }

    $path = "logo";

    $update_query = "UPDATE tbl_carousel SET description='$description', image='$update_filename' WHERE id='$carousel_id' ";

    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if (!empty($new_image['name'])) {
            move_uploaded_file($new_image['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("uploads/" . $old_image)) {
                unlink("uploads/" . $old_image);
            }
        }
        redirect("../admin/maintenance/editcarousel.php?id=$carousel_id", "Carousel Updated Successfully");
    } else {
        redirect("../admin/maintenance/editcarousel.php?id=$carousel_id", "Something Went Wrong");
    }
}

// MANAGEMENT CODE
if (isset($_POST['add_management'])) {
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    
    $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_extensions = array("png", "jpeg", "jpg");

    if (!in_array($image_ext, $allowed_extensions)) {
        redirect("../admin/maintenance/maintenance.php", "Only PNG, JPEG, and JPG files are allowed");
        exit(); 
    }

    $filename = time() . '.' . $image_ext;
    $path = "logo";

    $menu_query = "INSERT INTO tbl_management (description, image)
        VALUES ('$description', '$filename')";

    $menu_query_run = mysqli_query($con, $menu_query);

    if ($menu_query_run) {
        move_uploaded_file($image_tmp, $path . '/' . $filename);
        redirect("../admin/maintenance/maintenance.php", "Services Added Successfully");
    } else {
        redirect("../admin/maintenance/maintenance.php", "Something Went Wrong");
    }
}

else if (isset($_POST['update_management'])) {
    $management_id = mysqli_real_escape_string($con, $_POST['management_id']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    $new_image = $_FILES['image'];
    $old_image = $_POST['old_image'];

    if ($new_image['name'] != "") {
        $image_ext = strtolower(pathinfo($new_image['name'], PATHINFO_EXTENSION));
        $allowed_extensions = array("png", "jpeg", "jpg");

        if (in_array($image_ext, $allowed_extensions)) {
            $update_filename = time() . '.' . $image_ext;
        } else {
            redirect("../admin/maintenance/editmanagement.php?id=$management_id", "Only PNG, JPEG, and JPG files are allowed");
            exit();
        }
    } else {
        $update_filename = $old_image;
    }

    $path = "logo";

    $update_query = "UPDATE tbl_management SET description='$description', image='$update_filename' WHERE id='$management_id' ";

    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if (!empty($new_image['name'])) {
            move_uploaded_file($new_image['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("uploads/" . $old_image)) {
                unlink("uploads/" . $old_image);
            }
        }
        redirect("../admin/maintenance/editmanagement.php?id=$management_id", "Services Updated Successfully");
    } else {
        redirect("../admin/maintenance/editmanagement.php?id=$management_id", "Something Went Wrong");
    }
}

else if (isset($_POST['archive_management'])) {
    $management_id = mysqli_real_escape_string($con, $_POST['management_id']);

    $delete_query = "UPDATE tbl_management SET status = 1 WHERE id = ?";
    $stmt = mysqli_prepare($con, $delete_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $management_id);
        $delete_query_run = mysqli_stmt_execute($stmt);

        if ($delete_query_run) {
            redirect("../admin/maintenance/maintenance.php", "Services Archived Successfully");
        } else {
            redirect("../admin/maintenance/maintenance.php", "Something Went Wrong");
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("../admin/maintenance/maintenance.php", "Error preparing statement");
    }
}

else if (isset($_POST['restore_management'])) {
    $management_id = mysqli_real_escape_string($con, $_POST['management_id']);

    $delete_query = "UPDATE tbl_management SET status = 0 WHERE id = ?";
    $stmt = mysqli_prepare($con, $delete_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $management_id);
        $delete_query_run = mysqli_stmt_execute($stmt);

        if ($delete_query_run) {
            redirect("../admin/maintenance/archive.php", "Services Restored Successfully");
        } else {
            redirect("../admin/maintenance/archive.php", "Something Went Wrong");
        }

        mysqli_stmt_close($stmt);
    } else {
        redirect("../admin/maintenance/archive.php", "Error preparing statement");
    }
}

else if (isset($_POST['delete_management'])) 
{
    $management_id = mysqli_real_escape_string($con, $_POST['management_id']);
   
   
    $menu_query = "SELECT * FROM tbl_management WHERE id='$management_id'";
    $menu_query_run = mysqli_query($con, $menu_query);
    $menu_data = mysqli_fetch_array($menu_query_run);
    $image = $menu_data['image'];
    
    $delete_query = "DELETE FROM tbl_management WHERE id=?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $management_id);
    $delete_query_run = mysqli_stmt_execute($stmt);
    

    if ($delete_query_run) 
    {
        if (file_exists("uploads/" . $image)) 
        {
            unlink("uploads/" . $image);
        }

        redirect("../admin/maintenance/archive.php", "Service Deleted Successfully");
    } 
    else
    {
        redirect("../admin/maintenance/archive.php", "Something Went Wrong");
    }
}
?>