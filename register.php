<?php

include 'included/header.php';


?>

<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link defer rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">


<title>Registration</title>

<style>
    label {
        margin-bottom: 10px;
    }

    #btn_register {
        background-color: gold;
        border-color: gold;
    }

    #register_box {
        margin-top: 110px;
    }
</style>


<div class="containter" style="margin-top: 150px;">
    <div class="row justify-content-center mx-5">
    
        <div class="col-xl-5 col-lg-12">
    
            <div id="register_box" class="card o-hidden border-0 shadow-lg  p-1">
            <div class="text-center mt-4">
                                        <h2 id="title">Register</h2>
                                    </div><hr>
                <div class="card-body p-4">
                    <form id="save_user" action="" method="post">
                        <div class="row">
                            <div id="errorMessage" class="alert alert-warning d-none"></div>
                            <div class="col-md-4 p-2">
                                <div class="form-group">
                                    <label for="">First Name:</label> <small id="error_firstname"></small>
                                    <input type="text" name="first_name" class="form-control firstname" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" placeholder="First Name">
                                </div>
                            </div>
    
                            <div class="col-md-4 p-2">
                                <div class="form-group">
                                    <label for="">Last Name:</label> <small id="error_lastname"></small>
                                    <input type="text" name="last_name" class="form-control lastname" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-4 p-2">
                                <div class="form-group">
                                    
                                    <label for="">Middle Name:</label> <small id="error_middlename"></small>
                                    <input type="text" name="middle_name" class="form-control middlename" onkeypress="return /[a-zA-Z\s]/i.test(event.key)" placeholder="Middle Name">
                                </div>
                            </div>
    
                            <div class="col-md-12 p-2">
                                <div class="form-group">
                                    <label for="">Email Address:</label> <small id="error_email"></small>
                                    <input type="email" name="email" class="form-control email" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-md-12 p-2">
                                <div class="form-group">
                                    <label for="">Password:</label>
                                    <input type="password" name="password" class="form-control password" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="col-md-12 p-2">
                                <div class="form-group">
                                    <label for="">Confirm Password:</label>
                                    <input type="password" name="confirm_password" class="form-control cpassword" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="col-md-12 p-2  text-center">
                                <button id="btn_register" type="submit" name="register_btn" class="btn btn-primary mt-3">Register Now</button>
                            </div>
                            <div class="text-center">
                                <p>Have an existing account?<a href="login.php">Login</a></p>
                            </div>
    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('included/footer.php'); ?>
<script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script defer src="register.js"></script>