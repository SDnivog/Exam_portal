<?php

include '../../database/config.php';


if(isset($_FILES['ModalImage']) and isset($_GET['question_id']) and isset($_GET['exam_id']) ){
    
    $file = $_FILES['ModalImage'];
    $filename = $file['name'];
    
    $question_id =$_GET['question_id'];
    $exam_id = $_GET['exam_id'];
    
    $path = 'Upload/'.$filename;
    
    $sql = "update tbl_questions set image='$path' where exam_id='$exam_id' and question_id='$question_id'";
    
    $result = $conn->query($sql);
    
    if($result){
        move_uploaded_file($file['tmp_name'],$path);
        header('location:../view-excel-questions.php?eid='.$exam_id.'');
    }else{
        header('location:../view-excel-questions.php?eid='.$exam_id.'');  
    }
    
    
    
    
    
    
}else{
    echo "hjhj";
}







?>