<?php
require 'login.php';
if(isset($_SESSION["id"])){
    header("Location: dashboard.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Loreto's</title>

    <link rel="shortcut icon" type="x-icon" href="../assets/img/logo.jpg">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />


</head>

<body class="bg-gradient-dark">

    <div class="container mt-5">

        <!-- Outer Row -->
        <div class="row justify-content-center mt-5">

            <div class="col-xl-4 col-lg-12 ">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <img src="../assets/img/logo.jpg" style="width: 200px; height: 200px; border-radius: 50%;">
                                        <h1 class="h2 text-gray-900 m-4">Loreto's Admin</h1>
                                    </div>
                                    <form  autocomplete="off" action="" method="post">
                                    <input type="hidden" id="action" value="login" >
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" aria-describedby="emailHelp"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                        <button type="button" class="btn btn-dark w-100" onclick="submitData()">Login</button>
                                        </div>
                                    </form>
                                    <?php require 'script.php' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    
    <!--- Ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</body>

</html>