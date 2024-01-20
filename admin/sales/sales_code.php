<?php

include '../connect.php';

if (isset($_POST['Save_Sales'])) {
    $confirm_name = mysqli_real_escape_string($con, $_POST['confirm_name']);
    $fee = mysqli_real_escape_string($con, $_POST['fee']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);

    if (empty($confirm_name) || empty($fee) || empty($amount)) {
        $res = [
            "status" => 422,
            "message" => 'All fields are required'
        ];
        echo json_encode($res);
    } else {
        // Fetch the id from tbl_reservation based on confirm_name
        $query_select_id = "SELECT id FROM tbl_reservation WHERE user_name = ? AND status = 1";
        $stmt_select_id = mysqli_prepare($con, $query_select_id);
        mysqli_stmt_bind_param($stmt_select_id, "s", $confirm_name);
        mysqli_stmt_execute($stmt_select_id);
        $result_id = mysqli_stmt_get_result($stmt_select_id);

        if ($result_id && $row = mysqli_fetch_assoc($result_id)) {
            $reservation_id = $row['id'];

            // Fetch user_id from tbl_users_account based on the concatenated full name
            $query_select_user_id = "SELECT id FROM tbl_users_account WHERE CONCAT(firstname, ' ', middlename, ' ', lastname) = ?";
            $stmt_select_user_id = mysqli_prepare($con, $query_select_user_id);
            mysqli_stmt_bind_param($stmt_select_user_id, "s", $confirm_name);
            mysqli_stmt_execute($stmt_select_user_id);
            $result_user_id = mysqli_stmt_get_result($stmt_select_user_id);

            if ($result_user_id && $user_row = mysqli_fetch_assoc($result_user_id)) {
                $user_id = $user_row['id'];

                // Insert into tbl_fee with user_id
                $query_insert_fee = "INSERT INTO tbl_fee (reservation_id, user_id, fee, amount, dateAt) VALUES (?, ?, ?, ?, CURDATE())";
                $stmt_insert_fee = mysqli_prepare($con, $query_insert_fee);
                mysqli_stmt_bind_param($stmt_insert_fee, "iiii", $reservation_id, $user_id, $fee, $amount);
                $query_run = mysqli_stmt_execute($stmt_insert_fee);

                if ($query_run) {
                    // Update status in tbl_reservation from 1 to 2
                    $query_update_status = "UPDATE tbl_reservation SET status = 2 WHERE id = ?";
                    $stmt_update_status = mysqli_prepare($con, $query_update_status);
                    mysqli_stmt_bind_param($stmt_update_status, "i", $reservation_id);
                    $result_update_status = mysqli_stmt_execute($stmt_update_status);

                    if ($result_update_status) {
                        $res = [
                            "status" => 200,
                            "message" => 'Payment recorded successfully, status updated'
                        ];
                        echo json_encode($res);
                        exit();
                    } else {
                        $res = [
                            "status" => 500,
                            "message" => 'Payment recorded successfully, but status update failed'
                        ];
                        echo json_encode($res);
                        exit();
                    }
                } else {
                    $res = [
                        "status" => 500,
                        "message" => 'Payment not recorded'
                    ];
                    echo json_encode($res);
                    exit();
                }
            } else {
                $res = [
                    "status" => 404,
                    "message" => 'User not found'
                ];
                echo json_encode($res);
                exit();
            }
        } else {
            $res = [
                "status" => 404,
                "message" => 'Reservation not found'
            ];
            echo json_encode($res);
            exit();
        }
    }
}

?>
