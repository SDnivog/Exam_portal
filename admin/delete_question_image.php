<?php

include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';

if(isset($_GET['question_id']) and isset($_GET['type'])){
$exam_type=$_GET['sec_name'];
$type=  $_GET['type'];
$question_id=$_GET['question_id'];

$exam_id = $_GET['exam_id'];

if($type == "hindi"){
   $sql = "update tbl_questions set hindi_image='' where user_id='$login_user_id' and question_id='$question_id'"; 
}else if($type == "english" or $type =="normal"){

$sql = "update tbl_questions set image='' where user_id='$login_user_id' and question_id='$question_id'";
}

$result= $conn->query($sql);

if($result){
    header('location:view-questions.php?rp=5001&eid='.$exam_id.'#'.$question_id.'');
    // if($exam_type=='section'){
    // header('location:view-questions.php?rp=5001&eid='.$exam_id.'#'.$question_id.'');
    // }
    // else{
    //      header('location:view-questions.php?rp=5001&eid='.$exam_id.'#'.$question_id.'');
    // }
}




}






?>