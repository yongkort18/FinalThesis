<?php

include 'included/header.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->

    <link href="./admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="./admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="./admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="./admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="./admin/assets/css/bootstrap.min.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="./admin/assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="./admin/assets/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./admin/assets/css/alertify.min.css" />
    <link rel="stylesheet" href="./admin/assets/css/default.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@500&display=swap');

        .nav-link:active {
            background-color: gold;
        }
        #title
        {
            font-family: 'Work Sans', sans-serif;
         
        }
     
      a:hover
      {
        color: gold;
      }
      
      #container_logs
      {
        margin-top: 110px;
      }
    </style>
    <title>Login</title>
</head>

<body class="">
    
    <div class="containter" style="margin-top: 150px;">
        <div class="row justify-content-center mx-5">
    
            <div class="col-xl-5 col-lg-12">
    
                <div id="container_logs" class="card o-hidden border-0 shadow-lg  p-1">
                        <div class="text-center mt-4">
                            <h2 id="title">Sign in</h2>
                            </div>
                        <hr>
                    <div class="card-body p-4">
    
                        <!-- Pills content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                            <form>
                                    
                                    <form  autocomplete="off" action="" method="post">
                                        <input type="hidden" id="action" value="login">
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        
                                        <label class="form-label mt-2" for="loginName">Email</label>
                                        <input type="email" id="email" class="form-control" placeholder="Email.." />
                                    </div>
    
                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        
                                        <label class="form-label mt-2" for="loginPassword">Password</label>
                                        <input type="password" id="password" class="form-control" placeholder="Password.."/>
                                    </div>
    
                                    <!-- 2 column grid layout -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <!-- Checkbox -->
                                            <div class="form-check mb-3 mb-md-0">
                                                <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                                <label class="form-check-label" for="loginCheck"> Remember me </label>
                                            </div>
                                        </div>
    
                                       
                                    </div>
    
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4 col-md-12" style="background-color:#F7C815; border-color:#F7C815;" onclick="submitData()">Sign in</button>
                                    </form>
                                    <!-- Register buttons -->
                                    <div class="text-center">
                                        <p>Don't have an account yet? <a href="register.php">Register</a></p>
                                    </div>
                                </form>
                                <?php require 'user_script.php' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('included/footer.php'); ?>
    <!-- Pills content -->
     <!-- Bootstrap core JavaScript-->
    <script src="./admin/assets/vendor/jquery/jquery.min.js"></script>
    <script src="./admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./admin/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

     <!--- Ajax -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     
</body>

</html>