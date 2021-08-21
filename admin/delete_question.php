<?php

include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';

if(isset($_GET['question_id'])){
$exam_type=$_GET['sec_name'];
$question_id=$_GET['question_id'];

$exam_id = $_GET['exam_id'];


$sql = "delete from  tbl_questions where user_id='$login_user_id' and question_id='$question_id'";

$result= $conn->query($sql);

if($result){
      header('location:view-questions.php?rp=5001&eid='.$exam_id.'#'.$question_id.'');
    // if($exam_type=='section'){
    // header('location:view-section-questions.php?rp=5001&eid='.$exam_id.'#'.$question_id.'');
    // }
    // else{
    //     header('location:view-instance-questions.php?rp=5001&eid='.$exam_id.'#'.$question_id.'');
    // }
    
}




}
else{
    echo "non";
}





?>