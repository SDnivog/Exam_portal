<?php

include '../../database/config.php';
include '../includes/check_user.php';

$sql = "select * from tbl_examinations where user_id = '$login_user_id'";

$result = $conn->query($sql);

if($result->num_rows>0){
    
    while($row = $result->fetch_assoc()){
        $exam_id = $row['exam_id'];
        $exam_name =$row['exam_name'];
        $sql1 = "select * from tbl_assessment_records  where exam_id='$exam_id' and complete_exam = '0'";

        $result1 = $conn->query($sql1);

        if($result1->num_rows>0){
           echo '<div class="alert alert-success alert-dismissible">
           <button type="button" class="close" data-dismiss="alert">&times;</button>
           <strong> Exam Name :'.$exam_name.'</strong> And <strong>Exam Id:'.$exam_id.'</strong> And This Much Student Giving <strong> Live Exam :'.$result1->num_rows.'</strong>
         </div>';
        }
        else{

        }






    }



}
else{

}










?>