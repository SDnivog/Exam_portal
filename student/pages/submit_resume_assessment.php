<?php

include '../../database/config.php';
include '../includes/check_user.php';
session_start();
error_reporting(0);
$total_questions = $_POST['tq'];
$starting_mark = 1;
$mytotal_marks = 0;
$exam_id = $_POST['eid'];
$record = $_POST['ri'];



$time = $_POST['remaining_time'];

$submission_type = $_POST['submission_type'];


// code if exam is section

$sql_check = "select * from tbl_examinations where exam_id='$exam_id'";

$result_check = $conn->query($sql_check);

$arr = $result_check->fetch_assoc();

if($arr['section_name'] != ''){
  
/// coded by suraj 


$sec=explode('/', $arr['section_name']);
$i=0;
$mytotal_marks = 0;

foreach($sec as $out) {
                                                             
if(!empty($out)){
                
                                                               
            $main_out =str_replace(' ', '', $out);                                                

/// code for insert student responses

$sql = "select * from tbl_questions where exam_id='$exam_id' and sec_name='$out'";

$result = $conn->query($sql);
$qn=1;
while($row = $result->fetch_assoc()){

 


  $question_id = $row['question_id'];
  $val = 'an'.$main_out.$qn;
  $sql_check = "select * from tbl_questions where exam_id='$exam_id' and question_id='$question_id' and sec_name='$out'";
  $result_check = $conn->query($sql_check);

  $arr_check = $result_check->fetch_assoc();

  $question_type = $arr_check['question_type'];

  $stu_response = '';
  $mul_response = '';

  if($question_type == "MTQ"){
      for($i=1;$i<=4;$i++){
         $stu_response .= mysqli_real_escape_string($conn,$_POST['an'.$main_out.$i.$qn]);
         if(!empty(mysqli_real_escape_string($conn,$_POST['an'.$main_out.$i.$qn]))){
            $mul_response .= "option".$i;
         }
      }
  }
  else{
      $stu_response = mysqli_real_escape_string($conn,$_POST[$val]);
  }
    
    $sql2 = "select * from tbl_responses where exam_id='$exam_id' and stu_id='$stu_id' and question_id='$question_id'";
    $result2 = $conn->query($sql2);
    
    if($result2->num_rows>0){
 $sql1 = "update tbl_responses set stu_response ='$stu_response',mul_response='$mul_response' where stu_id='$stu_id' and exam_id='$exam_id' and question_id='$question_id'";
        $result1 = $conn->query($sql1);
    }
//     else{
     
// //   $sql1 = "insert into tbl_responses values('$stu_id','$exam_id','$question_id','$stu_response','$mul_response','')";

// //   $result1 = $conn->query($sql1);
//     }

  $qn++;
 




}






// code for insert student socre and status 


$sql1 = "select * from tbl_responses where exam_id='$exam_id' and stu_id='$stu_id'";

$result = $conn->query($sql1);

  while($row = $result->fetch_assoc()){
      
      $q_id = $row['question_id'];
      $stu_response = $row['stu_response'];


      $sql2 = "select * from tbl_questions where question_id='$q_id' and sec_name='$out'";

      $result2 = $conn->query($sql2);

      $ans = $result2->fetch_assoc();

      $question_type = $ans['question_type'];
      $answer= $ans['answer'];
      $answer_val = $ans[$answer];

      
     

    
      $type= $ans['type'];
      
    //   if($type == "MC"){

      if($question_type == "MTQ"){
         $answer_option = $row['mul_response'];
            if($answer == $answer_option){
              $mytotal_marks += $ans['pos_marks'];
            }
            else if($answer_option == "" and $row['stu_response'] == ""){
              $mytotal_marks = $mytotal_marks;

            }
            else{
              $mytotal_marks += $ans['neg_marks'];
            }
   
      }else if($question_type == "FQ"){
            $end_range = explode("-",$answer);
           
           if($end_range[0] != "" and $end_range[1] != ""){
           if($stu_response>=$end_range[0] and $stu_response<=$end_range[0]){
                 $mytotal_marks += $ans['pos_marks']; 
              }
           
           }else{
                if($stu_response == $answer){
                 $mytotal_marks += $ans['pos_marks']; 
              }
           }
    //       if($stu_response == $answer){
    //      $mytotal_marks += $ans['pos_marks']; 
    //   }
       if($stu_response == ''){
         $mytotal_marks = $mytotal_marks;
      }
      else{
         $mytotal_marks += $ans['neg_marks'];
      }
          
      }else if($question_type== "TQ"){
          $arr_answer = ['true','false'];
          for($i=1;$i<=2;$i++){
              if($answer == "option".$i){
                  $mainanswer = $arr_answer[$i-1];
              }
          }
          
          if($stu_response == $mainanswer){
                 $mytotal_marks += $ans['pos_marks']; 
              }
              else if($stu_response == ''){
                 $mytotal_marks = $mytotal_marks;
              }
              else{
                 $mytotal_marks += $ans['neg_marks'];
              }
          
      }
      else{

      if($stu_response == $answer_val){
         $mytotal_marks += $ans['pos_marks']; 
      }
      else if($stu_response == ''){
         $mytotal_marks = $mytotal_marks;
      }
      else{
         $mytotal_marks += $ans['neg_marks'];
      }
  }
    //   }
      
    //   else{
    //         if($stu_response == $answer){
    //      $mytotal_marks += $ans['pos_marks']; 
    //   }
    //   else if($stu_response == ''){
    //      $mytotal_marks = $mytotal_marks;
    //   }
    //   else{
    //      $mytotal_marks += $ans['neg_marks'];
    //   }
    //   }
   

  }



        

    
}
                                             
                                                    
 }
    
      $sql3 = "select * from tbl_examinations where exam_id='$exam_id'";

  $result3 = $conn->query($sql3);
   
  $arr  = $result3->fetch_assoc();
   
  $cutoff_marks = $arr['cutoff_marks'];



        if ($mytotal_marks >= $cutoff_marks) {
        $status = "PASS";	
        }else{
        $status = "FAIL";	
        }
        
    
      $_SESSION['record_id'] = $record;
      
      
        $sql = "UPDATE tbl_assessment_records SET score='$mytotal_marks', status='$status',end_time='$time',submission_type ='$submission_type',resume_status=0  WHERE record_id='$record'";
        
        if ($conn->query($sql) === TRUE) {
          
          header("location:../assessment-info.php");
        } else{
             header("location:../assessment-info.php");
        }
    
    
    

    
    
    
    
    
    
    
    
    
    
    
}else{

/// coded by suraj 

/// code for insert student responses

$sql = "select * from tbl_questions where exam_id='$exam_id'";

$result = $conn->query($sql);
$qn=1;
while($row = $result->fetch_assoc()){

  $student_id = $stu_id;


  $question_id = $row['question_id'];
  $val = 'an'.$qn;
  $sql_check = "select * from tbl_questions where exam_id='$exam_id' and question_id='$question_id'";
  $result_check = $conn->query($sql_check);

  $arr_check = $result_check->fetch_assoc();

  $question_type = $arr_check['question_type'];

  $stu_response = '';
  $mul_response = '';

  if($question_type == "MTQ"){
      for($i=1;$i<=4;$i++){
         $stu_response .= mysqli_real_escape_string($conn,$_POST['an'.$i.$qn]);
         if(!empty(mysqli_real_escape_string($conn,$_POST['an'.$i.$qn]))){
            $mul_response .= "option".$i;
         }
      }
  }
  else{
      $stu_response = mysqli_real_escape_string($conn,$_POST[$val]);
  }
    
    $sql2 = "select * from tbl_responses where exam_id='$exam_id' and stu_id='$student_id' and question_id='$question_id'";
    $result2 = $conn->query($sql2);
    
    if($result2->num_rows>0){
        $sql1 = "update tbl_responses set stu_response ='$stu_response',mul_response='$mul_response' where stu_id='$student_id' and exam_id='$exam_id' and question_id='$question_id'";
        $result1 = $conn->query($sql1);
        
 
    }
//     else{
// //   $sql1 = "insert into tbl_responses values('$student_id','$exam_id','$question_id','$stu_response','$mul_response','')";

// //   $result1 = $conn->query($sql1);

// $sql1 = "update tbl_responses set stu_response ='$stu_response',mul_response='$mul_response' where stu_id='$student_id' and exam_id='$exaxm_id' and question_id='$question_id'";
// $result1 = $conn->query($sql1);
//     }

  $qn++;
 




}






// code for insert student socre and status 


$sql1 = "select * from tbl_responses where exam_id='$exam_id' and stu_id='$stu_id'";

$result = $conn->query($sql1);

  while($row = $result->fetch_assoc()){
      
      $q_id = $row['question_id'];
      $stu_response = $row['stu_response'];


      $sql2 = "select * from tbl_questions where question_id='$q_id'";

      $result2 = $conn->query($sql2);

      $ans = $result2->fetch_assoc();

      $question_type = $ans['question_type'];
      $answer= $ans['answer'];
      $answer_val = $ans[$answer];

      
     

    
      $type= $ans['type'];
      
    //   if($type == "MC"){

      if($question_type == "MTQ"){
         $answer_option = $row['mul_response'];
            if($answer == $answer_option){
              $mytotal_marks += $ans['pos_marks'];
            }
            else if($answer_option == "" and $row['stu_response'] == ""){
              $mytotal_marks = $mytotal_marks;

            }
            else{
              $mytotal_marks += $ans['neg_marks'];
            }
   
      }else if($question_type == "FQ"){
          if($stu_response == $answer){
         $mytotal_marks += $ans['pos_marks']; 
      }
      else if($stu_response == ''){
         $mytotal_marks = $mytotal_marks;
      }
      else{
         $mytotal_marks += $ans['neg_marks'];
      }
          
      }else if($question_type== "TQ"){
          $arr_answer = ['true','false'];
          for($i=1;$i<=2;$i++){
              if($answer == "option".$i){
                  $mainanswer = $arr_answer[$i-1];
              }
          }
          
          if($stu_response == $mainanswer){
                 $mytotal_marks += $ans['pos_marks']; 
              }
              else if($stu_response == ''){
                 $mytotal_marks = $mytotal_marks;
              }
              else{
                 $mytotal_marks += $ans['neg_marks'];
              }
          
      }
      else{

      if($stu_response == $answer_val){
         $mytotal_marks += $ans['pos_marks']; 
      }
      else if($stu_response == ''){
         $mytotal_marks = $mytotal_marks;
      }
      else{
         $mytotal_marks += $ans['neg_marks'];
      }
  }
    //   }
      
    //   else{
    //         if($stu_response == $answer){
    //      $mytotal_marks += $ans['pos_marks']; 
    //   }
    //   else if($stu_response == ''){
    //      $mytotal_marks = $mytotal_marks;
    //   }
    //   else{
    //      $mytotal_marks += $ans['neg_marks'];
    //   }
    //   }
   

  }


  $sql3 = "select * from tbl_examinations where exam_id='$exam_id'";

  $result3 = $conn->query($sql3);
   
  $arr  = $result3->fetch_assoc();
   
  $cutoff_marks = $arr['cutoff_marks'];



if ($mytotal_marks >= $cutoff_marks) {
$status = "PASS";	
}else{
$status = "FAIL";	
}




$_SESSION['record_id'] = $record;
include '../../database/config.php';


$sql = "UPDATE tbl_assessment_records SET score='$mytotal_marks', status='$status',end_time='$time',submission_type ='$submission_type',resume_status=0  WHERE record_id='$record'";



if ($conn->query($sql) === TRUE) {

	
  header("location:../assessment-info.php");
} else {
  header("location:../assessment-info.php");
}
}

$conn->close();
?>
