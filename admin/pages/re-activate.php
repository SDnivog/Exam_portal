<?php
include '../../database/config.php';
include '../includes/check_user.php';
$rsid = mysqli_real_escape_string($conn, $_GET['rid']);
$exid = mysqli_real_escape_string($conn, $_GET['eid']);

 $sql2 = "select * from tbl_assessment_records where record_id='$rsid' and exam_id='$exid'";

$result2 = $conn->query($sql2);

$arr = $result2->fetch_assoc();

$student_id = $arr['student_id'];


$sql_coins = "select * from tbl_users where user_id='$login_user_id'";
        
$result_coins = $conn->query($sql_coins);
        
$row_coins = $result_coins->fetch_assoc();
        
if($row_coins['coins'] > 0){

$sql = "DELETE FROM tbl_assessment_records WHERE record_id='$rsid'";

if ($conn->query($sql) === TRUE) {
    
    $delete_user_outexam = "select * from outexams where id = '$student_id' and exam_id='$exid'";
    
    $delete_result = $conn->query($delete_user_outexam);
    
    if($delete_result->num_rows>0){
        $delete_user = "delete from outexams where id='$student_id'";
        $result_user = $conn->query($delete_user);
        
    }

    $sql1 = "delete from tbl_responses where exam_id='$exid' and stu_id='$student_id'";
    
    $result = $conn->query($sql1);
    if($result){
     
            // $total_coins = $row_coins['coins']-1;
            // $update_coins = "update tbl_users set coins='$total_coins' where user_id='$login_user_id'";
            
            // $update_result = $conn->query($update_coins);
            
            // if($update_result){
               header("location:../view-results.php?rp=7823&eid=$exid"); 
            // }
       
    }
} else {
     header("location:../view-results.php?rp=1298&eid=$exid");
}
 }else{
             header("location:../view-results.php?rp=401&eid=$exid");
        }

$conn->close();
?>
