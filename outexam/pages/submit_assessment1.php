<?php

include '../../database/config.php';
include '../includes/check_user.php';
error_reporting(0);
session_start();
$total_questions = $_POST['tq'];
$starting_mark = 1;

$exam_id = $_POST['eid'];
$record = $_POST['ri'];
$stu_id = $_SESSION['id'];

/// coded by suraj 

/// code for insert student responses

$sql = "select * from tbl_questions where exam_id='$exam_id'";

$result = $conn->query($sql);
$qn=1;
while($row = $result->fetch_assoc()){

 


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
    
    $sql2 = "select * from tbl_responses where exam_id='$exam_id' and stu_id='$stu_id' and question_id='$question_id'";
    $result2 = $conn->query($sql2);
    
    if($result2->num_rows>0){

    }
    else{
     
  $sql1 = "insert into tbl_responses values('$stu_id','$exam_id','$question_id','$stu_response','$mul_response','')";

  $result1 = $conn->query($sql1);
    }

   $qn++;
 




}


$mytotal_marks = 0;



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
      
      if($type == "MC"){

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
      }
      
      else{
            if($stu_response == $answer){
         $mytotal_marks += $ans['pos_marks']; 
      }
      else if($stu_response == ''){
         $mytotal_marks = $mytotal_marks;
      }
      else{
         $mytotal_marks += $ans['neg_marks'];
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
        
        
      $record =    $_SESSION['record_id'] ;
      
        $sql = "UPDATE tbl_assessment_records SET score='$mytotal_marks', status='$status' WHERE record_id='$record'";
        
        if ($conn->query($sql) === TRUE) {
            session_destroy();
            session_start();
            $_SESSION['id'] = $stu_id;
            $_SESSION['data_id'] = $exam_id;
            header("location:../successful.php");
        } else{
            header('location:../error.php');
        }


?>