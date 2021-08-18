<?php


date_default_timezone_set('Africa/Dar_es_salaam');
include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

include 'SimpleXLSX.php';



$exam_id = 'EX-'.get_rand_numbers(6).'';
$exam = ucwords(mysqli_real_escape_string($conn, $_POST['exam']));
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$attempts = mysqli_real_escape_string($conn, $_POST['attempts']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$terms = ucfirst(mysqli_real_escape_string($conn, $_POST['instructions']));
$tmarks = mysqli_real_escape_string($conn, $_POST['tmarks']);
$cmarks = mysqli_real_escape_string($conn, $_POST['cmarks']);
$result_type = mysqli_real_escape_string($conn, $_POST['result_type']);

$datacheck = mysqli_real_escape_string($conn,$_POST['datatype']);

$exam_type1 = mysqli_real_escape_string($conn,$_POST['Exam_type']); 

$pos_marks = mysqli_real_escape_String($conn,$_POST['pmarks']);
$neg_marks = mysqli_real_escape_String($conn,$_POST['nmarks']);

$exittime = mysqli_real_escape_string($conn, $_POST['exit']);

$Restrict_time = mysqli_real_escape_string($conn, $_POST['Restrict_time']);

$edate = $_POST['edate'];

$sql = "SELECT * FROM tbl_examinations WHERE user_id = '$login_user_id' AND exam_name = '$exam' AND subject = '$subject' AND category = '$category'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../examinations.php?rp=1185");
    }
} else {

    if($datacheck== "files"){
$sql = "INSERT INTO tbl_examinations (user_id,exam_id, category, subject, exam_name, date, duration,cutoff_marks,re_exam,result_type,terms,status,exam_type,edate,no_exit,Restrict_time)
VALUES ('$login_user_id','$exam_id', '$category', '$subject', '$exam', '$date', '$duration','$cmarks', '$attempts','$result_type', '$terms','Inactive','Instance','$edate',
'$exittime','$Restrict_time')";
    }
    else if($datacheck == "excel"){
        $sql = "INSERT INTO tbl_examinations (user_id,exam_id, category, subject, exam_name, date, duration,cutoff_marks,re_exam,result_type,terms,status,exam_type,edate,no_exit,Restrict_time)
VALUES ('$login_user_id','$exam_id', '$category', '$subject', '$exam', '$date', '$duration','$cmarks', '$attempts','$result_type', '$terms','Inactive','excel','$edate','$exittime','$Restrict_time')";

    }

if ($conn->query($sql) === TRUE) {
    
    
    
    /// code to send exam is created 
    
    
     $sql1 = "select * from tbl_account where category='$category'";
    
    $result1 = $conn->query($sql1);
    
    while($row1 = $result1->fetch_assoc()){
        $id = $row1['student_id'];
        
        $sql2 = "select * from tbl_users where user_id='$id'";
        
        $result2 = $conn->query($sql2);
        
        $row2 = $result2->fetch_assoc();
        $stu_email = $row2['email'];
    
        $from = "examinfo@trando.co";
        $to =   $stu_email;
        $subject = "Exam Details";
        $message = "Welcome $stu_first_name $stu_last_name !
       Your Teacher Has Created Exam which will be held on
        $edate
       
        "
        ;
        
        $headers = "From :".$from;
        
        mail($to,$subject,$message,$headers);
    
    
        }
    
    
    
    
    
    


  if($datacheck == "files"){


// // Count # of uploaded files in array
$total = count($_FILES['upload']['name']);



// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {
  
  //Get the temp file path

$question_id = 'QS-'.get_rand_numbers(6).'';


$filename =  $_FILES['upload']['name'][$i];

 $folderPath = 'Upload/';
    
        $filename_change = uniqid() . '.png';
        $file = $folderPath .$filename_change;

$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' AND user_id = '$login_user_id' AND image='$file'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

 header('location:../view-instance-questions.php?eid='.$exam_id.'&rp=4001');	
} else {
    
    $sql ="INSERT INTO tbl_questions (user_id,question_id,bonus, exam_id, type,image,question_type ,option1,option2,option3,option4,answer,pos_marks,neg_marks,type_val) VALUES ('$login_user_id','$question_id','0', '$exam_id', 'MC', '$file','','A','B','C','D','','$pos_marks','$neg_marks','1')";

if ($conn->query($sql) === TRUE) {
  
    
  move_uploaded_file($_FILES["upload"]["tmp_name"][$i], $file);

    
    
    header('location:../view-instance-questions.php?eid='.$exam_id.'&rp=4001');	
} 





	
}
}





 header('location:../view-instance-questions.php?eid='.$exam_id.'&rp=2932');	


  }
else if($datacheck == "excel"){
     
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
                      $sub_code = $rowData[0][0];
                      $sub_name = $rowData[0][1];
                      $sub_option1 = $rowData[0][2];
                      $sub_option2 = $rowData[0][3];
                      $sub_option3 = $rowData[0][4];
                      $sub_option4 = $rowData[0][5];
                      $answer = $rowData[0][6];
                      $pos_marks = $rowData[0][7];
                      $neg_marks = $rowData[0][8];
                      $question_id = 'QS-'.get_rand_numbers(6).'';
                    
                  
               


                      for($i=2;$i<=5;$i++){
                        if($answer == $rowData[0][$i]){
                            $data = $i-1;
                            $answer = "option".$data;
                        }

                      }
                    
                    
                    
                  
                  



                    if($sub_name != '' and $sub_code != ''){

                      $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' AND user_id = '$login_user_id' AND question='$sub_name'";
                      $result = $conn->query($sql);
                      
                      if ($result->num_rows > 0) {
                      
                      } 
                      else{
                        
                        $sql = "INSERT INTO tbl_questions (user_id,question_id,bonus, exam_id, type,question ,question_type,option1,option2,option3,option4,answer,pos_marks,neg_marks,type_val)
                        VALUES ('$login_user_id','$question_id','0', '$exam_id', 'MC', '$sub_name','STQ','$sub_option1','$sub_option2','$sub_option3','$sub_option4','$answer','$pos_marks','$neg_marks','1')";
                        
                        $result = $conn->query($sql);
                        if($result and $row == $total_rows){
                            header('location:../view-instance-questions.php?eid='.$exam_id.'&rp=4001');
                        }
                      }
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
  






} else {
header("location:../examinations.php?rp=7788");
}


}



}




?>













 
 