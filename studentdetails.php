<?php

session_start();
extract($_POST);
include 'database/config.php';


function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


function checkregisterid($id){
    $sql = "select * from where user_id = '$id'";
    $runsql = $conn->query($sql);
    if($runsql->num_rows>0){
        return "yes";
    }
    else{
        return "no";
    }
}


if(isset($_POST['stu_register'])){

    $stu_first_name = htmlentities(mysqli_real_escape_string($conn,$stu_first_name));
    $stu_last_name = htmlentities(mysqli_real_escape_string($conn,$stu_last_name));
    $gender = htmlentities(mysqli_real_escape_string($conn,$gender));
    $stu_email = htmlentities(mysqli_real_escape_string($conn,$stu_email));
    $stu_mobile = htmlentities(mysqli_real_escape_string($conn,$stu_mobile));
    $stream = htmlentities(mysqli_real_escape_string($conn,$stream)); 
    $category = htmlentities(mysqli_real_escape_string($conn,$category));
    $register_date = date('Y-m-d');
    $random_pass=randomPassword();
    $pass = md5($random_pass);

    $register_id = 'S'.rand(100,999).'-'.rand(100,999).'-'.rand(100,999).'';

    
    

    $checkemail  = "select * from tbl_users where email='$stu_email'";

    $runemail = $conn->query($checkemail);

    if($runemail->num_rows>0){
        $_SESSION['message'] = "Account Already Create By This Gmail Or Phone";
    }
    else{
        if(strlen($stu_mobile)==10 or strlen($stu_mobile) ==11){
        $teacher_id = $_SESSION["teacher_code"];
    $sql = "insert into tbl_users(user_id,teacher_id,first_name,last_name,gender,email,phone,department,category,login,role,acc_stat,register_date) values('$register_id','$teacher_id','$stu_first_name','$stu_last_name','$gender','$stu_email','$stu_mobile','$stream','$category','$pass','student','1','$register_date')";

    $runsql = $conn->query($sql);

    if($runsql){
        
        $add_sql = "insert into tbl_account(student_id,teacher_id,department,category) values('$register_id','$teacher_id','$stream','$category')";
        
        $add_result = $conn->query($add_sql);
        
        $to = $stu_email;
        $subject = 'Account Details';
        $from = 'examinfo@kendel.in';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $message = '<html><body style="display: flex;justify-content: center;align-items: center;">
       <div>
        <h4 style="color:#444;">Congratulation '.$stu_first_name . $stu_last_name.'!,</h4>
        <p style="color:#666;font-size:18px;">Your account has been created Succesfully</p>
        <p style="color:#666;font-size:18px;">Welcome to Kendel!</p>
        <p style="color:#666;font-size:18px;">
        Your user id: <span style="background:#687bf2;color:white;">'.$register_id.'</span> <br>
        Your login email : <span style="background:#687bf2;color:white;">'.$stu_email .'</span> <br>
         Password: <span style="background:#687bf2;color:white;">'.$random_pass.'</span> <br>
        </p>
        <p><a href="https://kendel.in/exam/index" style="background-color: #231e3b;color: #fff;text-decoration: none;padding: 5px 10px;box-shadow: 1px 1px 12px -4px #666;">Login Here</a></p>
        <p style="color:#61c456;font-size:20px;">Thank You !</p>
       </div>
        </body></html>';
 
        // $from = "examinfo@kendel.in";
        // $to =   $stu_email;
        // $subject = "Account Details";
        // $message = "Welcome $stu_first_name $stu_last_name !
        // Your account has been created successfully.
        // Your Login Details for examination portal Are
        // Registration Id :$register_id  
        // Or 
        // Email :$stu_email 
        // Password Is :$random_pass
        // Thank You!
        // -----------------------------
        // "
        // ;
        
        // $headers = "From :".$from;
        
        if(mail($to, $subject, $message, $headers)){
        header('location:index.php');
              $_SESSION['success_msg'] = "Your Account Created Successfully,Please Visit This Email : <span><b>$stu_email</b></span> For Login Details";
        $_SESSION['success_color']="bg-success";
        }
    }
        }
        else{
             $_SESSION['message'] = "Mobile No Is Not Valid";
        }
    }







}

if(isset($_SESSION['message'])){
$header = '  
<p class="text-center bg-danger">'.$_SESSION['message'].'</p>
<a href="./index" class="logo-name text-lg text-center">Join Class Created By Your Teacher at Kendel Digital Platform</a>
<p class="text-center m-t-md">Please Register your account.</p>';
}

else{
    
$header = '  
    <a style="color:#fff" href="./index" class="logo-name text-lg text-center">Join Class Created By Your Teacher at Kendel Digital Platform</a>
    <p style="color:#fff" class="text-center m-t-md">Please Register your account.</p>'; 
}


$form= ' <form class="m-t-md"  method="POST">
<div class="form-group">
    <input type="text" class="form-control" value="Teacher Name ='.$_SESSION["teacher_name"].' "  autocomplete="off" name="code" required disabled>
</div>
<div class="form-group">
    <input type="text" class="form-control" value="Teacher Code ='. $_SESSION['teacher_code'].' "  autocomplete="off" name="code" required disabled>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="Enter Your First Name"  autocomplete="off" name="stu_first_name" required>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="Enter Your Last Name"  autocomplete="off" name="stu_last_name" required>
</div>
<div class="form-group">
<select class="form-control" name="gender" required>
<option value="" selected disabled>Select Gender</option>
<option>Male</option>
<option>Female</option>

</select>
</div>

<div class="form-group">
    <input type="email" class="form-control" placeholder="Enter Your Email"  autocomplete="off" name="stu_email" required>
</div>
<div class="form-group">
    <input type="number" class="form-control" placeholder="Enter Your Mobile No"  autocomplete="off" name="stu_mobile" required>
</div>
<div class="form-group">
    <select class="form-control" name="stream" required onchange="FetchCategory(this.value)">
    <option value="" selected disabled>Select Stream</option>';

    $teacher_code = $_SESSION['teacher_code'];
   
  
  $sql1 = "select * from tbl_departments where user_id='$teacher_code' and status = 'Active'";
    
    $result1 = $conn->query($sql1);


    while($row = $result1->fetch_assoc()){
        $dep = $row['name'];
       
            $form .= '<option>'.$dep.'</option>';
    }



   


$form .= '
</select>
</div>
<div class="form-group">
    <select class="form-control" name="category" id="categroy" required>
    <option value="" disabled selected>Select Class</option>';



    // $sql1 = "select * from tbl_categories where user_id='$teacher_code' and  status = 'Active'";
    
    // $result1 = $conn->query($sql1);
   

    // while($row = $result1->fetch_assoc()){
    //     $dep = $row['name'];

    //         $form .= '<option>'.$dep.'</option>';
    // }


    
    
 $form .=  ' 
    </select>
</div>


<button type="submit" class="btn btn-success btn-block" name="stu_register">Register</button>

<!-- <a href="forgot_pw.php" class="display-block text-center m-t-md text-sm">Forgot Password?</a> -->


<a href="createclass.php" class=" btn btn-info text-center m-t-md text-sm"> CREATE CLASS</a>


</form>';




include 'mainpages.php';



?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    
function FetchCategory(CategoryFetch){
  
  $.ajax({
      url:'category-fetchmain.php',
      type:'post',
      data:{
         CategoryFetch :CategoryFetch
      },
      success:function(data){
         $('#categroy').html(data); 
      }
  })
  
  
  }
</script>