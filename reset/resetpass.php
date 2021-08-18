<?php
   include'../database/config.php';
   session_start();
    $email_r=$_POST['email'];
    $pass1=$_POST['pass1'];
    $pass2=$_POST['pass2'];
    if($pass1==$pass2){
        $result1= $conn->query("SELECT * FROM tbl_users where email='$email_r'");
        if($result1->num_rows>0){
        $en_pass=md5($pass1);
        $result=$conn->query("UPDATE tbl_users set login='$en_pass', resetpass=1 where email='$email_r'");
           $to = $email_r;
            $subject = 'New Password';
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
            <p style="color:#0e1f47;font-size:16px;">Your Password has been updated </p> 
            <p style="color:#0e1f47;font-size:16px;">Your New password - '.$pass1.' </p> 
            <p style="color:#2c84b0;font-size:18px;">Thank You</p>
<p style="color:#2c7db0;font-size:18px;">Team Kendel</p>
            </body></html>';
             $retval = mail ($to, $subject, $message, $headers);
         if( $retval == true ){
              $_SESSION['msg']= "Your password has been updated successfully";
              $_SESSION['status']= "show";
              $_SESSION['type']="#0aad4e";
              header('location:../index.php');
         }else {
              $_SESSION['msg']= "We are facing Tecnical issue!";
              $_SESSION['status']= "show";
              $_SESSION['type']="#f28561";
              header('location:./index.php');
         }
    
    }
    else{
         $_SESSION['msg']= "Something Went wrong!";
              $_SESSION['status']= "show";
              $_SESSION['type']="#f28561";
              header('location:./index.php?verified='.$email_r.'');
    }
   
} else{
           $_SESSION['msg']= "Please enter same password in both fields!";
              $_SESSION['status']= "show";
              $_SESSION['type']="#f28561";
              header('location:./index.php?verified='.$email_r.'');
    }
?>