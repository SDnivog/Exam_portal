<?php
include '../../database/config.php';
$rsid = mysqli_real_escape_string($conn, $_GET['rid']);
$exid = mysqli_real_escape_string($conn, $_GET['eid']);

 $sql2 = "select * from tbl_assessment_records where record_id='$rsid' and exam_id='$exid'";

$result2 = $conn->query($sql2);

$arr = $result2->fetch_assoc();

$student_id = $arr['student_id'];




$sql = "update tbl_assessment_records set resume_status=1 where record_id='$rsid'";

if ($conn->query($sql) === TRUE) {
  

  header("location:../view-results.php?rp=7823&eid=$exid");
    
} else {
     header("location:../view-results.php?rp=1298&eid=$exid");
}

$conn->close();
?>
