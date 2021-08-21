<?php
include '../../database/config.php';
$sid = mysqli_real_escape_string($conn, $_GET['id']);
$department = mysqli_real_escape_string($conn, $_GET['dp']);
$class = mysqli_real_escape_string($conn, $_GET['cl']);
$tid = mysqli_real_escape_string($conn, $_GET['tc']);


$sql1 = "select * from tbl_account where student_id='$sid' and department='$department' and category='$class' and teacher_id='$tid'";

$result1 = $conn->query($sql1);

if($result1->num_rows>0){
 $count = $result1->num_rows;
 if($count == 1){
     
$sql = "UPDATE tbl_users SET acc_stat='0' WHERE user_id='$sid'";
$sql1 = "UPDATE tbl_account SET acc_status='0' WHERE student_id='$sid'  and department='$department' and category='$class' and teacher_id='$tid'";
if ($conn->query($sql) === TRUE and $conn->query($sql1)) {
    header("location:../students.php?rp=7823");
} else {
    header("location:../students.php?rp=1298");
}
 }else{
     
$sql = "UPDATE tbl_account SET acc_stat='0' WHERE user_id='$sid' and department='$department' and category='$class' and teacher_id='$tid'";

if ($conn->query($sql) === TRUE) {
    header("location:../students.php?rp=7823");
} else {
    header("location:../students.php?rp=1298");
}
     
     
     
 }
 
 
 
    
}
// else{

// $sql = "UPDATE tbl_users SET acc_stat='0' WHERE user_id='$sid'";

// if ($conn->query($sql) === TRUE) {
//     header("location:../students.php?rp=7823");
// } else {
//     header("location:../students.php?rp=1298");
// }

// }
$conn->close();
?>
