<?php



include '../../database/config.php';
$exid = mysqli_real_escape_string($conn, $_GET['id']);


$sql1 = "select * from tbl_questions where exam_id='$exid'";

$result1 = $conn->query($sql1);
$count = 0;

while($row = $result1->fetch_assoc()){
    if($row['answer'] == ""){
        $count++;
    }
}


if($result1->num_rows>0){

if($count ==0){


$sql = "UPDATE tbl_examinations SET status='Active' WHERE exam_id='$exid'";

if ($conn->query($sql) === TRUE) {
    header("location:../examinations.php?rp=7823");
} else {
    header("location:../examinations.php?rp=1298");
}
}else{
     header("location:../examinations.php?rp=7001");
}
}else{
     header("location:../examinations.php?rp=7002");
}
$conn->close();



?>
