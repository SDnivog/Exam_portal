<?php

include '../database/config.php';
// include 'includes/check_user.php';

session_start();

$stu_id =  $_SESSION['id'];

extract($_POST);

$count = mysqli_real_escape_string($conn,$count);
if(isset($count) and isset($exam_id)){
    
    $sql= "update tbl_assessment_records set student_status='$count' where student_id = '$stu_id' and exam_id='$exam_id'";
    $result = $conn->query($sql);
    if($result){
        echo $count;
    }
    
    
}





?>