<?php

require '../connect.php';

if(isset($_POST['delete_user']))
  {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $query = "UPDATE tbl_users_account SET archive = 1 WHERE id='$user_id'";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
     $res = [
         "status"=> 200,
         "message"=>'User Archive Successfully'
     ];
     echo json_encode($res);
     return false;
    }
    else
    {
     $res = [
         "status"=> 500,
         "message"=>'User not Deleted'
     ];
     echo json_encode($res);
     return false;
    }
} 



if(isset($_POST['restore_user']))
  {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $query = "UPDATE tbl_users_account SET archive = 0 WHERE id='$user_id'";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
     $res = [
         "status"=> 200,
         "message"=>'User Restored Successfully'
     ];
     echo json_encode($res);
     return false;
    }
    else
    {
     $res = [
         "status"=> 500,
         "message"=>'User not Deleted'
     ];
     echo json_encode($res);
     return false;
    }
}
?>
?>