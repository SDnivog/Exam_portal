<?php

include '../database/config.php';

session_start();

$id = $_SESSION['id'];

if(isset($_POST['exam_id'])){
$exam_id= $_POST['exam_id'];

$sql ="update tbl_assessment_records set submission_type='Window Close' where student_id='$id' and exam_id='$exam_id'";

$result = $conn->query($sql);


}





?>