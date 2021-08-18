<?php
include '../../database/config.php';

$exam_name =   mysqli_real_escape_string($conn, $_GET['exam_id']);



$count_cat = count($_POST['class']);

$cat = '';

for($i=0;$i<$count_cat;$i++){
    $cat .= $_POST['class'][$i];
}


$sql  = "update tbl_examinations set add_class='$cat' where exam_id='$exam_name'";

if ($conn->query($sql) === TRUE) {
    header("location:../examinations.php?rp=7823");
} else {
    header("location:../examinations.php?rp=1298");
}



$conn->close();
?>