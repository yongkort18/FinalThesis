<?php
require '../connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

if (isset($_POST['confirm_user'])) {
    $confirm_id = mysqli_real_escape_string($con, $_POST['confirm_id']);
    $query = "UPDATE tbl_reservation SET status = 1 WHERE id = '$confirm_id'";
    $email = mysqli_real_escape_string($con, $_POST['user_email']);
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $clientName = mysqli_escape_string($con, $_POST['clientName']);
        $fee = mysqli_escape_string($con, $_POST['fee']);

        $subject = "Your booking has been reserved.";
        $message = "Dear [client name],

            We hope this message finds you well. Thank you for choosing Loreto's Event Management for your upcoming event. We are delighted to confirm your reservation and look forward to welcoming you on [reservation date].
            
            Reservation Details:
            
            Full Name:
            Email Address:
            Phone Number:
            Date of Event:
            Package: 
            Pax: 
            Total Amount:
            
            We appreciate your trust in Loreto's Event Management, and we are committed to providing you with a memorable experience. Should you have any questions or require further assistance, do not hesitate to reach out to us.
            
            Once again, thank you for choosing us. We look forward to serving you and ensuring your event is comfortable and enjoyable.
            
            Best regards,
            
            Mr. Edison Christopher Ordoyo
            Owner
            Loreto's Event Management
            0912 942 2005";

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'loretoscatering@gmail.com';
            $mail->Password = 'gnpx zzlz epxr kdri';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('loretoscatering@gmail.com');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = ($subject);
            $mail->Body = ($message);

            $mail->send();

            // If the email is sent successfully, proceed with the database query
            $insert_fee = "INSERT INTO tbl_fee (reservation_id, user_id, fee, amount, dateAt) VALUES (?, ?, ?, ?, CURDATE())";
            $stmt_insert_fee = mysqli_prepare($con, $insert_fee);
            mysqli_stmt_bind_param($stmt_insert_fee, "iiii", $confirm_id, $confirm_id, $fee, $fee);
            $query_run = mysqli_stmt_execute($stmt_insert_fee);

            if ($query_run) {
                $res = [
                    "status" => 200,
                    "message" => 'Payment recorded successfully, status updated'
                ];
                echo json_encode($res);
                exit();
            } else {
                $res = [
                    "status" => 500,
                    "message" => 'Error While payment'
                ];
                echo json_encode($res);
                exit();
            }
        } catch (Exception $e) {
            // Handle exception if the email fails to send
            $res = [
                "status" => 500,
                "message" => 'Error sending email: ' . $mail->ErrorInfo
            ];
            echo json_encode($res);
            exit();
        }
    }
}

// for Archive
if (isset($_POST['update_status'])) {

    $reserve_id = mysqli_real_escape_string($con, $_POST['confirm_id']);
    $query = "UPDATE tbl_reservation SET archive = 1 WHERE id = $reserve_id ";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $res = [
            "status" => 200,
            "message" => 'Reservation decline.'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            "status" => 500,
            "message" => 'Error'
        ];
        echo json_encode($res);
        return false;
    }
}
?>
