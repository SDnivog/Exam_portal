<?php 
include '../database/config.php';
session_start();

if(isset($_POST['login'])){

$username = htmlentities(mysqli_real_escape_string($conn,$_POST['username']));

$password = md5($_POST['password']);

$sql = "select * from superadmin where username='$username' and password='$password'";

$result = $conn->query($sql);

if($result->num_rows>0){
    $_SESSION['super_admin'] = $username;
    header('location:super_admin_view.php');
}
else{
    $_SESSION['error_msg'] = "Username Or Password Is wrong";

}



}







?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>

        *{
            margin:0;
            padding:0;
        }
        body{
            background-color:rgba(0,0,0,0.02);
        }
        form{
            position:absolute;
            top:30%;
            left:50%;
            background-color:rgba(255,255,255,1);
            transform:translate(-50%,-30%);
            box-shadow:0px 4px 4px 8px rgba(0,0,0,0.02);
            padding:10px 100px 100px 100px;
        }
        form h3{
            margin-bottom:50px;
        }
        form button{
            position:relative;
            left:50%;
            transform:translate(-50%,0);
            width:100px;
        }


    </style>


</head>
<body>
   <div class="container">
      
        <form  method="post">
        <h3 class="text-center">Super Admin Login Form</h3>
                <div class="form-group">
                    <label for="">Username :</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="">Password :</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="off">
                </div>

                <button class="btn btn-primary" name="login">Login</button>


        </form>

    </div> 
</body>
</html>