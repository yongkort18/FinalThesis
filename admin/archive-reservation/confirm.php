
<?php
require '../connect.php';
 
if(isset($_POST['update_status']))
  { 

    $reserve_id= mysqli_real_escape_string($con, $_POST['confirm_id']);
    $query = "UPDATE tbl_reservation SET archive = 0 WHERE id = $reserve_id ";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
     $res = [
         "status"=> 200,
         "message"=>'Reservation Restore.'
     ];
     echo json_encode($res);
     return false;
    }
    else
    {
     $res = [
         "status"=> 500,
         "message"=>'error'
     ];
     echo json_encode($res);
     return false;
    }
}


?>
