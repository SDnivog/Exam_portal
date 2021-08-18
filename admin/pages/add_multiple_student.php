 <?php
date_default_timezone_set('Africa/Dar_es_salaam');
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




 
if(isset($_FILES['excelfile'])){
 
 
 $file = $_FILES['excelfile'];



      if ( isset($_FILES['excelfile']['name']) and $_FILES['excelfile']['name'] != "" ) {
          $allowedExtensions = array("xls","xlsx");
  // Return the extension of the file
          $ext = pathinfo( $_FILES['excelfile']['name'] , PATHINFO_EXTENSION );
          if ( in_array ($ext, $allowedExtensions)){
              $isUploaded = $_FILES['excelfile']['tmp_name'];
              if ($isUploaded) {
                  include "PHPExcel/Classes/PHPExcel/IOFactory.php";
   
                  try {
                      $objPHPExcel = PHPExcel_IOFactory::load($isUploaded);
                  } catch (Exception $e) {
                      die ( 'Error loading file "' . pathinfo($isUploaded, PATHINFO_BASENAME ) . '": ' . $e->getMessage());
                  }
                  // An excel file may contains many sheets so you have to specify which one you need to read or work with.
                  $sheet = $objPHPExcel->getSheet(0);
                  // It returns the highest number of rows.
                  $total_rows = $sheet->getHighestRow();
                  // It returns the highest number of columns.
                  $highest_column = $sheet->getHighestColumn();

                
                
              
                  for ($row = 2 ; $row <= $total_rows; $row++) {
                      // Read a row of data into an array
                      $rowData = $sheet-> rangeToArray ('A' . $row . ':' . $highest_column . $row, NULL, TRUE, FALSE);
                      $department = $rowData[0][1];
                      $class = $rowData[0][2];
                      $first_name = $rowData[0][3];
                      $last_name = $rowData[0][4];
                      $email = $rowData[0][5];
                      $mobile = $rowData[0][6];
                      $gender = $rowData[0][7];
                      
                      $department =mysqli_real_escape_string($conn,$department);
                      $class =mysqli_real_escape_string($conn,$class);
                      $fname =mysqli_real_escape_string($conn,$first_name);

                      $lname =mysqli_real_escape_string($conn,$last_name);
                      $mobile =mysqli_real_escape_string($conn,$mobile);
                      $gender =mysqli_real_escape_string($conn,$gender);
                      
                      
                     
                      if(!empty($department) and !empty($class) and !empty($first_name) and !empty($last_name) and !empty($email) and !empty($mobile) and !empty($gender)){
                          
                      
                      $sql_check1 = "select * from tbl_categories where name='$class' and department = '$department' and user_id='$login_user_id'";
                      $result_check1 =$conn->query($sql_check1);
                     
                     if($result_check1->num_rows>0){
                     
                     $student_id = 'S'.rand(100,999).'-'.rand(100,999).'-'.rand(100,999).'';
                  

                        $register_date = date('d-m-Y');
                        $random_pass = randomPassword();
                        $passw=md5($random_pass);
                        
                        $sql = "SELECT * FROM tbl_users WHERE email = '$email'";
                        $result = $conn->query($sql);
                        $row_data1 = $result->fetch_assoc();
                        
                        if ($result->num_rows > 0){
                            
                            $id = $row_data1['user_id'];
                            // if email exits in tbl_users 
                             $sql_checking1 = "select * from tbl_account where student_id='$id' and teacher_id='$login_user_id'  and department='$department' and category='$class'";
                            
                            $result_checking1 = $conn->query($sql_checking1);  
                            
                            if($result_checking1->num_rows>0){
                                   $sem = $row_data['email'];
                        	$sph = $row_data['phone'];
                        	if ($sem == $email) {
                        	 header("location:../students.php?rp=1189");	
                        	}else{
                        	
                        	if ($sph == $phone) {
                        	 header("location:../students.php?rp=2074");	
                        	}else{
                        		
                        	}
                        	
                        	}
                                
                        
                            }else{
                                
                        $insert_data = "INSERT INTO tbl_account (student_id,teacher_id,department,category) VALUES ('$id','$login_user_id', '$department','$class')";
                        $result_data =$conn->query($insert_data);
        
                        
                          if($result_data){
                            
                              $from = "examinfo@kendel.in";
                                $to =   $email;
                                $subject = "Account Details";
                                $message = "Welcome $fname $lname !
                                You Was Add By your Teacher In Class $class 
                               
                
                                "
                                ;
                                
                                $headers = "From :".$from;
                                
                                if(mail($to,$subject,$message,$headers)){
                                   header("location:../students.php?rp=6310");
                                }
                                
                                
                            }
                            }
                            
                        } else {
                        
                        $sql = "INSERT INTO tbl_users (user_id,teacher_id, first_name, last_name, gender,  email, phone, department, category,login,register_date)
                        VALUES ('$student_id','$login_user_id', '$fname', '$lname', '$gender', '$email', '$mobile', '$department','$class','$passw','$register_date')";
                        
                        $sql2 = "INSERT INTO tbl_account (student_id,teacher_id,deaprtment,category) VALUES ('$student_id','$login_user_id', '$department','$class')";
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
                      }else{
                          echo "no rows";
                      }
                        
                        
                        }else{
                            echo "not entered";
                        }
                    
                    
                    
                  
                  



                  
                
                }
             

                 
              
              } else {
                  echo '<span class="msg">File not uploaded!</span>';
              }
          } else {
              echo '<span class="msg">This type of file not allowed!</span>';
          }
      }
      else { echo '<span class="msg">Select an excel file first!</span>';
      }
  


}



?>
