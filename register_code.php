<?php
session_start();

$conn = mysqli_connect("localhost","u562528100_loreto","Loreto2024!","u562528100_cateringdb");

if (isset($_POST['Save_user'])) {
    $firstname = mysqli_escape_string($conn, $_POST['first_name']);
    $lastname = mysqli_escape_string($conn, $_POST['last_name']);
    $middlename = mysqli_escape_string($conn, $_POST['middle_name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_escape_string($conn, $_POST['confirm_password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if (empty($firstname) || empty($lastname)  || empty($email) || empty($password) || empty($confirm_password)) {
        $res = [
            "status" => 422,   //Error 422
            "message" => 'All field are required'
        ];
        echo json_encode($res);
        return false;
    } else {
        if ($password == $confirm_password) {
           
            $sql = "INSERT INTO tbl_users_account (firstname,lastname,middlename,email,password) VALUES ('$firstname', '$lastname','$middlename', '$email', '$password_hash')";
            $query_run = mysqli_query($conn, $sql);
            if ($query_run) {
                $res = [
                    "status" => 200,
                    "message" => 'User Created Successfully'
                ];
                echo json_encode($res);
                return false;
            } else {
                $res = [
                    "status" => 500,
                    "message" => 'User not Created'
                ];
                echo json_encode($res);
                return false;
            }
        } else 
        {
            $res = [
                "status" => 401,
                "message" => 'Password mismatch'
            ];
            echo json_encode($res);
            return false;
        }
    }
}

?>