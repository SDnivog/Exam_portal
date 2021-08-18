<?php

include '../../database/config.php';


if(isset($_GET['exam_id']) and isset($_GET['question_id'])){
    $exam_id = mysqli_real_escape_string($conn,$_GET['exam_id']);
    
    $question_id = mysqli_real_escape_string($conn,$_GET['question_id']);

$sql = "update tbl_questions set image='' where exam_id='$exam_id' and question_id='$question_id'";

$result = $conn->query($sql);

if($result){
    header('location:../view-excel-questions.php?eid='.$exam_id.'&rp=8001');
}else{
    header('location:../view-excel-questions.php?eid='.$exam_id.'&rp=8002'); 
}


}






?>