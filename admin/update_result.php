<?php

include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';

if(isset($_GET['exam_id'])){
    $exam_id = $_GET['exam_id'];
    $sql = "select * from tbl_examinations where exam_id='$exam_id' and result_type='manual'";

    $result = $conn->query($sql);

    if($result->num_rows>0){
        $sql1 = "update tbl_examinations set result_status=1 where exam_id='$exam_id'";
        $result1 = $conn->query($sql1);
        if($result1){
            header('location:results.php');
        }
    }



}
if(isset($_GET['exam_id_hide'])){
    $exam_id = $_GET['exam_id_hide'];
    $sql = "select * from tbl_examinations where exam_id='$exam_id' and result_type='manual'";

    $result = $conn->query($sql);

    if($result->num_rows>0){
        $sql1 = "update tbl_examinations set result_status=0 where exam_id='$exam_id'";
        $result1 = $conn->query($sql1);
        if($result1){
            header('location:results.php');
        }
    }



}



?>