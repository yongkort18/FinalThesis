<?php

require '../connect.php';

if(isset($_POST['delete_admin']))
  {
    $admin_id = mysqli_real_escape_string($con, $_POST['admin_id']);
    $query = "UPDATE tbl_admin_account SET archive = 1 WHERE id ='$admin_id'";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
     $res = [
         "status"=> 200,
         "message"=>'Admin Deleted Successfully'
     ];
     echo json_encode($res);
     return false;
    }
    else
    {
     $res = [
         "status"=> 500,
         "message"=>'Admin not Deleted'
     ];
     echo json_encode($res);
     return false;
    }
}

if(isset($_POST['updateadmin']))
{
    $admin_id = mysqli_escape_string($con, $_POST['admin_id']);
    $name = mysqli_escape_string($con, $_POST['name']);
    $username = mysqli_escape_string($con, $_POST['username']);
    $password = mysqli_escape_string($con, $_POST['password']);


    if($name == null || $username == null  || $password == null )
    {
        $res = [
            "status"=> 422,   
            "message"=>'All field are required'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $query = "UPDATE tbl_admin_account SET name='$name', username='$username', password='$password' WHERE id='$admin_id'";
        
        $query_run =  mysqli_query($con, $query);
       if($query_run)
       {
        $res = [
            "status"=> 200,
            "message"=>'Admin Updated Successfully' 
        ];
        echo json_encode($res);
        return false;
       }
       else
       {
        $res = [
            "status"=> 500,
            "message"=>'Admin not Updated'
        ];
        echo json_encode($res);
        return false;
       }
    }
}
if(isset($_GET['admin_id']))
{
    $admin_id = mysqli_real_escape_string($con, $_GET['admin_id']);

    $query = "SELECT * FROM tbl_admin_account WHERE id= '$admin_id'";
    $sql = mysqli_query($con, $query);

    if(mysqli_num_rows($sql) == 1)
    {
        $admin =  mysqli_fetch_array($sql);

        $res = [
            "status"=> 200,   
            "message"=>'Admin Fetch Successfully',
            "data"=>$admin
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            "status"=> 404,   //Error 404
            "message"=>'admin id not found'
        ];
        echo json_encode($res);
        return false;
    }

}

if(isset($_POST['Save_Admin']))
{
    $name = mysqli_escape_string($con, $_POST['name']);
    $username = mysqli_escape_string($con, $_POST['username']);
    $password = mysqli_escape_string($con, $_POST['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $type =  mysqli_escape_string($con, $_POST['type']);
    if($name == null || $username == null  || $password == null )
    {
        $res = [
            "status"=> 422,   //Error 422
            "message"=>'All field are required'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $query = "INSERT INTO tbl_admin_account (name,username,password,type) values('$name','$username','$password_hash','$type')";
        $query_run =  mysqli_query($con, $query);
       if($query_run)
       {
        $res = [
            "status"=> 200,
            "message"=>'Admin Created Successfully'
        ];
        echo json_encode($res);
        return false;
       }
       else
       {
        $res = [
            "status"=> 500,
            "message"=>'Admin not Created'
        ];
        echo json_encode($res);
        return false;
       }
    }
} 


// to restore admin account 

if(isset($_POST['restore_admin']))
  {
    $admin_id = mysqli_real_escape_string($con, $_POST['admin_id']);
    $query = "UPDATE tbl_admin_account SET archive = 0 WHERE id ='$admin_id'";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
     $res = [
         "status"=> 200,
         "message"=>'Admin Restored Successfully'
     ];
     echo json_encode($res);
     return false;
    }
    else
    {
     $res = [
         "status"=> 500,
         "message"=>'Admin not Restore '
     ];
     echo json_encode($res);
     return false;
    }
}
