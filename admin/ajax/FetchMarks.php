<?php

include '../../database/config.php';

extract($_POST);


if(isset($exam_id) and isset($question_id)){
    
   
    $sql = "select * from tbl_questions where exam_id='$exam_id' and question_id='$question_id'";
    
    $result = $conn->query($sql);
    
    $response = array();

        $row = $result->fetch_assoc();
        
        $response =$row;
        
        echo json_encode($response);
}











?>