<?php 

include 'database/config.php';

session_start();

$login_user_id = $_POST['user_id'];

$razorpay_payment_id = $_POST['razorpay_payment_id'];

$plan  =$_POST['Plan'];




if(isset($razorpay_payment_id) and isset($plan)){
    
    $date = date("Y-m-d h:i:s");
    $sql = "insert into tbl_payment (payment_id,admin_id,amount,date,payment_status) values ('$razorpay_payment_id','$login_user_id','$plan','$date','1')";
    
    $result = $conn->query($sql);
    
    if($result){
        
        $plan_data = "select * from tbl_plan where plan_code='$plan'";
        
        $result_data = $conn->query($plan_data);
        
        $row_plan = $result_data->fetch_assoc();
        
        $sql_coins = "select * from tbl_users where user_id='$login_user_id'";
        
        $result_coins  = $conn->query($sql_coins);
        $row_coins = $result_coins->fetch_assoc();
        $useremail = $row_coins['email'];
        $total_coins = $row_plan['plan_amount']+$row_coins['coins'];
        
        
        $update_coins = "update tbl_users set coins='$total_coins' where user_id='$login_user_id'";
        $result_update = $conn->query($update_coins);
    
    
    
    
        if($result_update){
            
        $to =$useremail;
        $subject = 'Payments Details';
        $from = 'examinfo@kendel.in';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $message = '<html><body style="display: flex;justify-content: center;align-items: center;">
       <div>
        <h4 style="color:#444;">Dear User,</h4>
        <p style="color:#666;font-size:18px;">Your Payment of Rs. '.$row_plan['plan_amount'].' has been completed Succesfully</p>
        <p style="color:#666;font-size:18px;">
        Your user id: <span style="background:#687bf2;color:white;">'.$login_user_id.'</span> <br>
        </p>
        <p><a href="https://kendel.in/exam/index" style="background-color: #231e3b;color: #fff;text-decoration: none;padding: 5px 10px;box-shadow: 1px 1px 12px -4px #666;">Go to Panel</a></p>
        <p style="color:#61c456;font-size:20px;">Thank You !</p>
       </div>
        </body></html>';
        
        if(mail($to, $subject, $message, $headers)){
            
                 
        $too = 'dhanwant.nitj@gmail.com';
        $subject2 = 'Payments Details';
        $from2 = 'examinfo@kendel.in';
        $headers2  = 'MIME-Version: 1.0' . "\r\n";
        $headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers2 .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $message2 = '<html><body style="display: flex;justify-content: center;align-items: center;">
       <div>
        <h4 style="color:#444;">Dear Owner,</h4>
        <p style="color:#666;font-size:18px;">Payment of Rs. '.$row_plan['plan_amount'].' has been completed Succesfully</p>
        <p style="color:#666;font-size:18px;">
        Teacher user id: <span style="background:#687bf2;color:white;">'.$login_user_id.'</span> <br>
        </p>
        <p style="color:#61c456;font-size:20px;">Thank You !</p>
       </div>
        </body></html>';
        if(mail($too, $subject2, $message2, $headers2)){
         session_start();
        $_SESSION['success_msg'] ="Your Account Created Successfully!";
        $_SESSION['success_color']="bg-success";
        header('location:index.php');  
        }
       
        }
            
            
            
        }
        
        
        
        
        
        
       
    }
    
    
    
}








?>