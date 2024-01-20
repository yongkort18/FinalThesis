<?php

session_start();
require '../connect.php';

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;

    exit();
}

?>