<?php
date_default_timezone_set('Asia/Kolkata');
include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';


function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789@#$%&!";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$student_id = 'S'.get_rand_numbers(3).'-'.get_rand_numbers(3).'-'.get_rand_numbers(3).'';
$fname = ucwords(mysqli_real_escape_string($conn, $_POST['fname']));
$lname = ucwords(mysqli_real_escape_string($conn, $_POST['lname']));
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
// $address = ucwords(mysqli_real_escape_string($conn, $_POST['address']));
// $dob = mysqli_real_escape_string($conn, $_POST['dob']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$register_date = date('d-m-Y');
$random_pass = randomPassword();
$passw=md5($random_pass);

$sql = "SELECT * FROM tbl_users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    
     // if email exits in tbl_users 
                            
    
        $row_data = $result->fetch_assoc();
                            
        $id = $row_data['user_id'];
                                
        $sql_checking1 = "select * from tbl_account where student_id='$id' and teacher_id='$login_user_id'  and department='$department' and category='$category'";
                            
        $result_checking1 = $conn->query($sql_checking1);  
                            
                            if($result_checking1->num_rows>0){
                                $sem = $row_data['email'];
                            	$sph = $row_data['phone'];
                            	if ($sem == $email) {
                            	 header("location:../students.php?rp=1189");	
                            	}else{
                            	
                            	if ($sph == $phone) {
                            	 header("location:../students.php?rp=2074");	
                            	}
                            	
                            	}
                                
                        
                            }else{
                                
                        $insert_data = "INSERT INTO tbl_account (student_id,teacher_id,department,category) VALUES ('$id','$login_user_id', '$department','$category')";
                        $result_data =$conn->query($insert_data);
        
                        
                          if($result_data){
                            
                              $from = "examinfo@kendel.in";
                                $to =   $email;
                                $subject = "Class Details";
                                $message = "Hello $fname $lname !
                                You Was Add by your Teacher in class $category
                                "
                                ;
                                
                                $headers = "From :".$from;
                                
                                if(mail($to,$subject,$message,$headers)){
                                   header("location:../students.php?rp=6310");
                                }
                                
                                
                            }
                                
                                
                            }
                            
                            
                    
                        
                        //     while($row = $result->fetch_assoc()) {
                        //     $sem = $row['email'];
                        // 	$sph = $row['phone'];
                        // 	if ($sem == $email) {
                        // 	 header("location:../students.php?rp=1189");	
                        // 	}else{
                        	
                        // 	if ($sph == $phone) {
                        // 	 header("location:../students.php?rp=2074");	
                        // 	}else{
                        		
                        // 	}
                        	
                        // 	}
                        	
                        //     }
                            


} else {

$sql = "INSERT INTO tbl_users (user_id,teacher_id, first_name, last_name, gender, email, phone, department, category,login,register_date)
VALUES ('$student_id','$login_user_id', '$fname', '$lname', '$gender', '$email', '$phone', '$department','$category','$passw','$register_date')";

$sql2 = "INSERT INTO tbl_account(student_id,teacher_id,department,category) VALUES ('$student_id','$login_user_id', '$department','$category')";

$runsql2 =$conn->query($sql2);

$runsql1 =$conn->query($sql);

   if($runsql1){
        $from = "examinfo@kendel.in";
        $to =   $email;
        $subject = "Account Details";
        $message = "Welcome $fname $lname !
        Your account has been created successfully.
        Your Login Details for examination portal Are
        Registration Id :$student_id  
        Or 
        Email :$email 
        Password Is :$random_pass
        Thank You!
        -----------------------------
        "
        ;
        
        $headers = "From :".$from;
        
        if(mail($to,$subject,$message,$headers)){
           header("location:../students.php?rp=6310");
        }
          } 
          
 else {
          header("location:../students.php?rp=9157");
      }










}

$conn->close();
?>