<?php

include '../../database/config.php';
include '../includes/check_user.php';


if(isset($_GET['question_id']) and isset($_GET['page']) and isset($_GET['exam_id'])){
    
    $question_id = $_GET['question_id'];
    $page = $_GET['page'];
    
    $exam_id=$_GET['exam_id'];
    
    $sql = "update tbl_questions set bonus=1 where question_id='$question_id' and user_id='$login_user_id'";
    
    $result = $conn->query($sql);
    
    if($result){
        // if($page == 1){
        //      header('location:../view-instance-questions.php?eid='.$exam_id.'');
        // }else if($page == 2){
        //       header('location:../view-section-questions.php?eid='.$exam_id.'');
        // }else if($page == 3){
        //     header('location:../view-excel-questions.php?eid='.$exam_id.'');
        // }else if($page ==4){
        //     header('location:../view-questions.php?eid='.$exam_id.'');
        // }
        
         header('location:../view-questions.php?eid='.$exam_id.'');
        
     
    }else{
        // if($page == 1){
        //      header('location:../view-instance-questions.php?eid='.$exam_id.'');
        // }else if($page == 2){
        //       header('location:../view-section-questions.php?eid='.$exam_id.'');
        // }else if($page == 3){
        //     header('location:../view-excel-questions.php?eid='.$exam_id.'');
        // }else if($page ==4){
        //     header('location:../view-questions.php?eid='.$exam_id.'');
        // }
         header('location:../view-questions.php?eid='.$exam_id.'');
    }
    
    
    
    
}










?>