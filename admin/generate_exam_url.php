<?php
include '../database/config.php';
include '../includes/uniques.php';
include 'includes/check_user.php';

if(isset($_GET['eid'])){
    $exam_id = $_GET['eid'];
   
    
    $exam_url ="https://kendel.in/exam/outexam/exam.php?eid=$exam_id";
    
    
    
    $sql = "update tbl_examinations set exam_url='$exam_url' where exam_id='$exam_id' and user_id='$login_user_id'";
    $result = $conn->query($sql);
    
    header('location:examinations.php');
    
    
    
    
    
    
    
}







?>