<?php

$exam_id =  $_SESSION['current_examid'];
include 'includes/check_user.php';

include '../database/config.php';

session_start();




$sql ="update tbl_assessment_records set submission_type='Window Close' where student_id='$stu_id' and exam_id='$exam_id'";

$result = $conn->query($sql);






?>