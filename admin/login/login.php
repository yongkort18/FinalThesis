<?php


session_start();
include '../connect.php';

// if

if(isset($_POST["action"])){
     if($_POST["action"] == "login"){
        login();
    }
}


//LOGIN

function login(){
    global $con;
    
  $username = mysqli_escape_string($con, $_POST['username']);
  $password = mysqli_escape_string($con, $_POST['password']);

  $user = mysqli_query($con, "SELECT * FROM tbl_admin_account WHERE username = '$username'");

  if($user->num_rows > 0){
    $row = mysqli_fetch_assoc($user);

    if(password_verify($password ,$row['password'])){
      echo"login Succesfully";

      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      $_SESSION["name"] = $row["name"];
      $_SESSION["type"] = $row["type"];
   }
    else{
        echo"wrong password";
        exit;
    }
  }
  else
  {
    echo "User not Found";
    exit;
  }
}
?>