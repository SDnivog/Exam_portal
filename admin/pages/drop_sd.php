<?php
include '../../database/config.php';
$sdid = mysqli_real_escape_string($conn, $_GET['id']);

$department = mysqli_real_escape_string($conn, $_GET['dp']);

$class = mysqli_real_escape_string($conn, $_GET['cl']);

$teacher_id = mysqli_real_escape_string($conn, $_GET['tc']);

$sql1 = "select * from tbl_account where student_id='$sdid' and department='$department' and category='$class' and teacher_id='$teacher_id'";

$result1 = $conn->query($sql1);

if($result1->num_rows>0){
    
  $sql = "DELETE FROM tbl_account WHERE student_id='$sdid' and department='$department' and category='$class' and teacher_id='$teacher_id'";

    if ($conn->query($sql) === TRUE) {
        header("location:../students.php?rp=7823");
    } else {
        header("location:../students.php?rp=1298");
    }

  
    
}
$conn->close();
?>
