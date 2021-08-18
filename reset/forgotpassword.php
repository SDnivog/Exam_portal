<?php 
include'../database/config.php';
session_start();
extract($_POST);
$result=$conn->query("SELECT *FROM tbl_users  where email = '$r_email'");

if($result->num_rows>0){
           $conn->query("update tbl_users set resetpass=0  where email = '$r_email'");
           $to = $r_email;
            $subject = 'Password Reset';
            $from = 'support@kendel.in';
            $replyto='support@kendel.in';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0'."\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$replyto."\r\n" .
            'X-Mailer: PHP/' . phpversion();
            // Compose a simple HTML email message
            $message = '<html><body>
            <h1 style="color:#7accf5;">Hello Dear!!</h1>
            <p style="color:#0e1f47;font-size:16px;">Please reset your password by clicking the link given below</p> 
           <a href="https://kendel.in/exam/reset/index?verified='.$r_email.'">Reset Your Password </a>
            <p style="color:#2c84b0;font-size:18px;">Thank You</p>
<p style="color:#2c7db0;font-size:18px;">Team Kendel</p>
            </body></html>';
             $retval = mail ($to, $subject, $message, $headers);
         if( $retval == true ){
              $_SESSION['msg']= "We have sent an email on your email adress please reset password from there!";
              $_SESSION['status']= "show";
              $_SESSION['type']="#0aad4e";
              header('location:./forgot.php');
         }else {
              $_SESSION['msg']= "We are facing Tecnical issue!";
              $_SESSION['status']= "show";
              $_SESSION['type']="#f28561";
              header('location:./forgot.php');
         }
    
}else{
      $_SESSION['msg']= "No Account found with this email";
              $_SESSION['status']= "show";
              $_SESSION['type']="#f28561";
              header('location:./forgot.php');
}

?>
