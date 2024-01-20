<?php   
require '../connect.php'; 

if (isset($_POST['Save_Sales'])) {
    $confirm_name = mysqli_real_escape_string($con, $_POST['confirm_name']); 
    $user_id = mysqli_real_escape_string($con, $_POST['user_Id_fee']);  
    $fee = mysqli_real_escape_string($con, $_POST['fee']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $reservation_id = mysqli_real_escape_string($con, $_POST['confirm_name']); 

    if (empty($confirm_name) || empty($fee) || empty($amount)) {
        $res = [
            "status" => 422,
            "message" => 'All fields are required'
        ];
        echo json_encode($res); 
    } else {
         // insert fee in tbl_fee 
         $insert_fee = "INSERT INTO tbl_fee (reservation_id, user_id, fee, amount, dateAt) VALUES (?, ?, ?, ?, CURDATE())";
         $stmt_insert_fee = mysqli_prepare($con, $insert_fee);
         mysqli_stmt_bind_param($stmt_insert_fee, "iiii", $reservation_id, $user_id, $fee, $amount); 
         $query_run = mysqli_stmt_execute($stmt_insert_fee); 
         if($query_run) { 
            $res = [
                "status" => 200,
                "message" => 'Payment recorded successfully, status updated'
            ];
            echo json_encode($res);
            exit();
        } else {
            $res = [
                "status" => 500,
                "message" => 'Eror While payment'
            ];
            echo json_encode($res);
            exit();
        
                              
         }
      
         
    } 
}
?>