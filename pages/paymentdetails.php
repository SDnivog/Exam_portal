<?php

session_start();
include '../database/config.php';

extract($_POST);
if(isset($payment)){
    // recipt,reciptno,amount,phone
    $admin_id = $_SESSION['id'];
   	$first_name =$_SESSION['first_name'];
	$last_name = $_SESSION['last_name'];
	$name = $first_name." ".$last_name;

	$email =$_SESSION['email'];
// 	$phone = $_SESSION['phone'];
	$image = $_FILES['recipt']['name'];
	$des = "payments/".basename($image);
	$updated_plan = $_SESSION['updated_plan'];
	$payment_id = 'P-'.rand(100,999).'-'.rand(100,999).'-'.rand(100,999);
 
	
    if(!empty($_FILES['recipt']) and !empty($reciptno) and !empty($amount) and !empty($phone)  and (strlen($phone) ==10  or strlen($phone == 11))){
        
        
        $sql = "select * from tbl_payment  where admin_id='$admin_id' and utr ='$reciptno' and amount = '$amount'";
        
        $result = $conn->query($sql);
        
        if($result->num_rows>0){
                header("location:../payment.php");
        }
        else{
            $date = date("Y-m-d");
            $sql1 ="insert into tbl_payment values('$payment_id','$admin_id','$name','$email','$phone','-','$reciptno','$amount','$des','$date',1)";
            
            $result1 = $conn->query($sql1);
            
            if($result1){
                  $today_date = date("Y-m-d");
            if($updated_plan == "Basic"){
                $sql2 ="update tbl_users set register_date='$today_date',plan='$updated_plan',no_attempt='$noa' where user_id='$admin_id' and email='$email'";
                $result2  = $conn->query($sql2);
                }
            else{
                $sql2 ="update tbl_users set register_date='$today_date',plan='$updated_plan' where user_id='$admin_id' and email='$email'";
                $result2 = $conn->query($sql2);
                }
                
                $_SESSION['success_msg'] = "Your account will activeded with in 1 hour,In  case if your account is not activeded you can contact on this no :9027997165 ";
                $_SESSION['success_color']="bg-success";
                header("location:../index.php");
             
              
                
                $from = "examinfo@trando.co";
                $to = "querytrando2020@gmail.com";
                $subject = "Payment Details";
                $messages = 'Hey Trando! We Got Payment
                Payment Details Are :
                    Payment Id :'.$payment_id.'
                    Admin Name :'.$name.',
                    Admin Id :'.$admin_id.',
                    Admin Email :'.$email.',
                    Admin Phone:'.$phone.',
                    Admin Transiction Id :'.$reciptno.',
                    Admin Amount :'.$amount.'';
                $header = "From :".$from;
                
                mail($to,$subject,$messages,$header);
                
                
                
            }
        }
    
    }
    
    
    
    
}






?>