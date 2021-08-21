<?php

include 'database/config.php';
include 'database/config1.php';

extract($_POST);
session_start();

$plan = $_GET['plan'];

if($plan != ''){


if(isset($_POST['register'])){
    
    $sql_checking_plan = "select * from tbl_plan where plan_code='$plan'";
    
    $result_plan  = $conn->query($sql_checking_plan);
    
    $row_plan = $result_plan->fetch_assoc();
    
    if($result_plan->num_rows>0){
    
    $referbox = htmlentities(mysqli_real_escape_string($conn,$referbox));
    
    if($referbox == "on"){
        $refer_code = htmlentities(mysqli_real_escape_string($conn,$refer_code));
    }else{
        $refer_code = "";
    }
    

    $email = htmlentities(mysqli_real_escape_string($conn,$email));
    $first_name = htmlentities(mysqli_real_escape_string($conn,$first_name));
    $mobileno = htmlentities(mysqli_real_escape_string($conn,$mobileno));
    $cname = htmlentities(mysqli_real_escape_string($conn,$cname));
    $gender = htmlentities(mysqli_real_escape_string($conn,$gender));
    $last_name = htmlentities(mysqli_real_escape_string($conn,$last_name));
    $address = htmlentities(mysqli_real_escape_string($conn,$address));
    $pass = md5($pass);
    $cpass = md5($cpass);
    $register_date = date("Y-m-d");
   
    $register_id = 'T'.rand(100,999).'-'.rand(100,999).'-'.rand(100,999).'';
    
    $checkuserexits = "select * from tbl_users where email='$email' and phone='$mobileno'";
    
    $runquery = $conn->query($checkuserexits);


   
    if(mysqli_num_rows($runquery)>0){
        $_SESSION['msg'] ="Already Class Is Created By This Email Or Phone Number";
        $_SESSION['color']="bg-danger";
    }
    else{
        if(strlen($mobileno)==10 or strlen($mobileno) ==11){
            if($pass == $cpass){
                if(($referbox == "on" and !empty($refer_code)) or ($referbox == "" and empty($refer_code))){
                    if($_GET['plan'] == "0"){
                    
                        $code = $first_name.rand(100,99999).$last_name."@".rand(100,99999);
                        
                        if(!empty($refer_code)){
                        
                        
                        $sql_cheking_refer = "select * from tbl_users where your_refer='$refer_code'";
                        $result_checking_refer = $conn->query($sql_cheking_refer);
                        
                   
                        
                        if($result_checking_refer->num_rows>0){
                              $sql = "insert into tbl_users values('$register_id','-','$first_name','$last_name','$gender','-','$address','$email','$mobileno','-','-','$pass','admin','','1','$cname','$register_date','$plan','','$code','$refer_code','15','0')";
                        
            
                        $runsql = $conn->query($sql);
                        if($runsql){
                            $row_coins = $result_checking_refer->fetch_assoc();
                            $coins = $row_coins['coins']+15;
                            $sql_coins = "update tbl_users set coins ='$coins' where your_refer = '$refer_code'";
                            $result_coins = $conn->query($sql_coins);
                            if($result_coins){
                                  header('location:index.php');
            
                                    $_SESSION['success_msg'] = "Your Account Created Successfully!";
                                    $_SESSION['success_color']="bg-success";
                            }
                        }
                        }else{
                           
                             $_SESSION['msg'] = "Wrong Referal Code";
                                $_SESSION['color']="bg-danger";
                        }
                        }else{
                            
                              $sql = "insert into tbl_users values('$register_id','-','$first_name','$last_name','$gender','-','$address','$email','$mobileno','-','-','$pass','admin','','1','$cname','$register_date','$plan','','$code','$refer_code','15','0')";
                        
            
                        $runsql = $conn->query($sql);
                        if($runsql){
                          
                                  header('location:index.php');
            
                                    $_SESSION['success_msg'] = "Your Account Created Successfully!";
                                    $_SESSION['success_color']="bg-success";
                            
                        }
                            
                            
                            
                            
                        }
                      
                      
                    }
                    else{
                        
                         $code = $first_name.rand(100,99999).$last_name."@".rand(100,99999);
                        
                        if(!empty($refer_code)){
                        
                        
                        $sql_cheking_refer = "select * from tbl_users where your_refer='$refer_code'";
                        $result_checking_refer = $conn->query($sql_cheking_refer);
                        
                   
                        
                        if($result_checking_refer->num_rows>0){
                              $sql = "insert into tbl_users values('$register_id','-','$first_name','$last_name','$gender','-','$address','$email','$mobileno','-','-','$pass','admin','','1','$cname','$register_date','$plan','','$code','$refer_code','15','0')";
                        
            
                        $runsql = $conn->query($sql);
                        if($runsql){
                            $row_coins = $result_checking_refer->fetch_assoc();
                            $coins = $row_coins['coins']+15;
                            $sql_coins = "update tbl_users set coins ='$coins' where your_refer = '$refer_code'";
                            $result_coins = $conn->query($sql_coins);
                            if($result_coins){
                                  header('location:MakePayment.php?id='.$register_id.'');
                                   
            
                                    // $_SESSION['success_msg'] = "Your Account Created Successfully!";
                                    // $_SESSION['success_color']="bg-success";
                            }
                        }
                        }else{
                           
                             $_SESSION['msg'] = "Wrong Referal Code";
                                $_SESSION['color']="bg-danger";
                        }
                        }else{
                            
                              $sql = "insert into tbl_users values('$register_id','-','$first_name','$last_name','$gender','-','$address','$email','$mobileno','-','-','$pass','admin','','1','$cname','$register_date','$plan','','$code','$refer_code','0','0')";
                        
            
                        $runsql = $conn->query($sql);
                        if($runsql){
                                 
                                  header('location:MakePayment.php?id='.$register_id.'');
                                 
            
                                    // $_SESSION['success_msg'] = "Your Account Created Successfully!";
                                    // $_SESSION['success_color']="bg-success";
                            
                        }
                            
                            
                            
                            
                        }
                        
            
                    }
                }else if($referbox == "on" and empty($refer_code)){
                    $_SESSION['msg'] = "Please Enter The Refer Code";
            $_SESSION['color']="bg-danger";
                     
                }
       
        }
        else{
            $_SESSION['msg'] = "Password Does Not Matched";
            $_SESSION['color']="bg-danger";
        }
        }
        else{
             $_SESSION['msg'] = "Mobile No. Is Not Valid";
            $_SESSION['color']="bg-danger";
        }
    }
    
    }

}



$header = ' 
 <p class="text-center  '.$_SESSION['color'].' message">'.$_SESSION['msg'].'</p>   
<a style="color:#fff" href="./index" class="logo-name text-lg text-center">Create A Class On Kendel Digital Platform</a>
<p style="color:#fff" class="text-center m-t-md">Please Register your account.</p>';






$form .='<form class="m-t-md"  method="POST">
<div class="form-group">
<input type="text" class="form-control" placeholder="Enter Your First Name"  autocomplete="off" name="first_name" required>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="Enter Your Last Name"  autocomplete="off" name="last_name" required>
</div>
<div class="form-group">
<select class="form-control" name="gender">
<option value="" selected disabled>Select Gender</option>
<option>Male</option>
<option>Female</option>

</select>
</div>

<div class="form-group">
   <textarea class="form-control" placeholder="Enter Your Address" name="address" required></textarea>
</div>
<div class="form-group">
    <input type="email" class="form-control" placeholder="Enter Your Email"  autocomplete="off" name="email" required>
</div>
<div class="form-group">
    <input type="number" class="form-control" placeholder="Enter Your Mobile No"  autocomplete="off" name="mobileno" required>
</div>
<div class="form-group">
    <input type="text" class="form-control" placeholder="Enter Your Company Name"  autocomplete="off" name="cname" required>
</div>


<div class="form-group">
    <input type="password" class="form-control" placeholder="Enter Your  Password"  autocomplete="off" name="pass" required>
</div>
<div class="form-group">
    <input type="password" class="form-control" placeholder="Enter Your Conform Password"  autocomplete="off" name="cpass" required>
</div>
<div class="form-group">
    <input type="checkbox" class="form-control"   autocomplete="off" name="referbox" onclick="refershow()" >Do You Have A Refer Code
</div>

<div class="form-group" id="refer" style="display:none">
    <input type="text" class="form-control" placeholder="Enter Referal Code" id="refer_data" autocomplete="off" name="refer_code" >
</div>




<button type="submit" class="btn btn-success btn-block" name="register">Register</button>


<a href="joinclass.php" class=" btn btn-primary text-center m-t-md text-sm">JOIN CLASS</a>

</form>';
}
else{
    $form = "<h3>Something Went Wrong,Please Try Again</h3>";
}


include 'mainpages.php';




?>