<?php   
include ('./connect.php');
if(isset($_GET['user_id']))
{
    $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
    $query = "SELECT * FROM tbl_users_account WHERE id= '$user_id'";
    $sql = mysqli_query($con, $query);
    if(mysqli_num_rows($sql) == 1)
    {
        $admin =  mysqli_fetch_array($sql);
        $res = [
            "status"=> 200,   
            "message"=>'User Fetch Successfully',
            "data"=>$admin
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            "status"=> 404,   //Error 404
            "message"=>'users id not found'
        ];
        echo json_encode($res);
        return false;
    }
} 

  

if(isset($_POST['update_users']))
{
    $admin_id = mysqli_escape_string($con, $_POST['users_id']);
    $fname = mysqli_escape_string($con, $_POST['fname']);
    $mname = mysqli_escape_string($con, $_POST['mname']);
    $lname = mysqli_escape_string($con, $_POST['lname']);


    if($fname== null || $mname == null  || $lname == null )
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
        $query = "UPDATE tbl_users_account SET firstname='$fname', middlename='$mname', lastname ='$lname'  WHERE id='$admin_id'";
        
        $query_run =  mysqli_query($con, $query);
       if($query_run)
       {
        $res = [
            "status"=> 200,
            "message"=>'Users Updated Successfully' 
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
?>