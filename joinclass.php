<?php
session_start();
include 'database/config.php';

if(isset($_POST['student'])){
    
    $teacehr_code= htmlentities(mysqli_real_escape_string($conn,$_POST['code']));

    $sql = "select * from tbl_users where user_id='$teacehr_code' and role='admin'";

    $runsql = $conn->query($sql);

    if(mysqli_num_rows($runsql)){
       header('location:studentdetails.php');
       $arr = $runsql->fetch_assoc();
        $_SESSION['teacher_name']=$arr['first_name']." ".$arr['last_name'];
        $_SESSION['teacher_code']=$teacehr_code;
    }
    else{
        $error_msg="Their Is No Teacher With This Code";
    }


}



$header = '  
<p class="text-center bg-danger">'.$error_msg.'</p>
<a style="color:#fff;" href="./index" class="logo-name text-lg text-center">Join Class Created By Your Teacher at Kendel Digital Platform</a>
<p style="color:#fff;" class="text-center m-t-md">Please Register your account.</p>';
$form= ' <form class="m-t-md"  method="POST">
<div class="form-group">
    <input type="text" class="form-control" placeholder="Enter Your Teacher Code"  autocomplete="off" name="code" required>
</div>
<button type="submit" class="btn btn-success btn-block" name="student">Join Class</button>

<!-- <a href="forgot_pw.php" class="display-block text-center m-t-md text-sm">Forgot Password?</a> -->

<div class="text-center">
<a href="plancard.php" class="text-center btn btn-success text-center m-t-md text-sm"> CREATE CLASS</a>
</div>

</form>';

include 'mainpages.php';


?>