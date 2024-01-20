<?php
require '../connect.php';

if (isset($_POST['selectedId'])) {
    $selectById= $_POST['selectedId'];
    $user_Id = $_POST['user_id'];
    // Fetch the fee based on the selected name from the database
    $selectUser = "SELECT tbl_fee.*, tbl_reservation.user_name AS user_name 
    FROM tbl_fee
    JOIN tbl_reservation ON tbl_fee.reservation_id = tbl_reservation.id WHERE tbl_fee.reservation_id = '$selectById' AND tbl_fee.user_id = '$user_Id'  ";  
    $result = mysqli_query($con, $selectUser);

    if ($result) {
        $row = mysqli_fetch_assoc($result);      
        // Return the fee as JSON
       echo json_encode(array('fee' => $row['fee'], 'user_id' => $row['user_id']));
     
    } else {
        echo json_encode(['error' => 'Error fetching fee from the database.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>
