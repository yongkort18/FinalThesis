<?php


session_start();
$conn = mysqli_connect('localhost','u562528100_loreto','Loreto2024!','u562528100_cateringdb');

// if

if(isset($_POST["action"])){
     if($_POST["action"] == "login"){
        login();
    }
}


//LOGIN

function login(){
    global $conn;
    
  $email = mysqli_escape_string($conn, $_POST['email']);
  $password = mysqli_escape_string($conn, $_POST['password']);

  $user_name = mysqli_query($conn, "SELECT * FROM tbl_users_account WHERE email = '$email'");

  if($user_name->num_rows > 0){
    $row = mysqli_fetch_assoc($user_name);

    if(password_verify($password ,$row['password'])){
      echo"login Succesfully";

      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      $_SESSION["fistname"] = $row["firstname"];
      $_SESSION["middlename"] = $row["middlename"];
      $_SESSION["lastname"] = $row["lastname"];
      $_SESSION["email"] = $row["email"];

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