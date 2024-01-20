<?php require_once('dbconn.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php

include '../include/header.php';
?> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            margin:0;
            padding:0;

        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
    </style>
</head>

<main id="main" class="main">
  <section  style="position: absolute; width:80%;">
  <div class="wrapper">
       <div class="col p-2">       
        <div class="card-body">
      <h2 class="text-center " style="font-size: 40px;">CALENDAR</h2>
       <div id='calendar'></div>
       </div>
       </div>
   
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Email</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Name</dt>
                            <dd id="description" class=""></dd> 
                            <dt class="text-muted">Phone number</dt>
                            <dd id="phone" class=""></dd>
                            <dt class="text-muted">Reservation Date</dt>
                            <dd id="start" class=""></dd>
                            <!-- <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd> -->
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <!-- <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button> -->
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  </section>
  
    <!-- Event Details Modal -->

<?php 
$schedules = $con->query("SELECT * FROM `tbl_reservation`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['date']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['date']));
    $sched_res[$row['id']] = $row;
}
?>
<?php 
if(isset($con)) $con->close();
?>
</main>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>') 
    console.log(scheds);
</script>
<script src="./js/script.js"></script>
<?php
include '../include/footer.php';
?>
</html>