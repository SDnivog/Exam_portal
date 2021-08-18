<?php
include '../../database/config.php';
include '../includes/check_user.php';


if(isset($_GET['question_id']) and isset($_GET['exam_id']) and isset($_GET['data'])){
    
    $main = $_GET['data'];
    $id=$_GET['question_id'];
    $exam_id = $_GET['exam_id'];
    
    if($main == "par"){
        $sql = "update tbl_questions set par_status=1 where question_id='$id' and exam_id='$exam_id'";
        
        $result = $conn->query($sql);
        
        if($result){
            header('location:../view-questions.php?eid='.$exam_id.'');
        }
        
        
        
    }else if($main == "nopar"){
         $sql = "update tbl_questions set par_status=0 where question_id='$id' and exam_id='$exam_id'";
        
        $result = $conn->query($sql);
        
        if($result){
            header('location:../view-questions.php?eid='.$exam_id.'');
        }
    }else{
        header('location:../view-questions.php?eid='.$exam_id.'');
    }
    
    
    
    
}










?>