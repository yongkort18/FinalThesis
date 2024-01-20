<?php
require '../connect.php';

if(isset($_POST['delete_package']))
  {
    $package_id = mysqli_real_escape_string($con, $_POST['package_id']);
    $query = "DELETE FROM package WHERE id='$package_id'";
    $query_sec = "DELETE FROM tbl_food_list WHERE package_id='$package_id'";

    $query_run = mysqli_query($con, $query);
    $query_run_food =  mysqli_query($con, $query_sec);
    if($query_run && $query_run_food)
    {
     $res = [
         "status"=> 200,
         "message"=>'Package Deleted Successfully'
     ];
     echo json_encode($res);
     return false;
    }
    else
    {
     $res = [
         "status"=> 500,
         "message"=>'Package not Deleted'
     ];
     echo json_encode($res);
     return false;
    }
}
?>