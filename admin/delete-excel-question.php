<?php

include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';

if(isset($_GET['question_id']) and isset($_GET['exam_id'])){

$question_id=$_GET['question_id'];

$exam_id = $_GET['exam_id'];


$sql = "delete from  tbl_questions where user_id='$login_user_id' and question_id='$question_id' and exam_id='$exam_id'";

$result= $conn->query($sql);

if($result){
    header('location:view-excel-questions.php?rp=5001&eid='.$exam_id.'');
}




}
else{
    echo "sorry contact to developer";
}





?>