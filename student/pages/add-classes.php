<?php
include '../includes/check_user.php';
include '../../database/config.php';

$teacher_id= mysqli_real_escape_string($conn,$_POST['teacherid']);
$department= mysqli_real_escape_string($conn,$_POST['department']);
$category= mysqli_real_escape_string($conn,$_POST['category']);

$sql = "select * from tbl_account where student_id='$stu_id' and teacher_id='$teacher_id' and department='$department' and category='$category'";

$result = $conn->query($sql);

if ($result->num_rows>0) {
    header('location:../AddClass.php');
} else {
    
    
    $sql2 = "select * from tbl_account where student_id='$stu_id' and teacher_id='$teacher_id'";
    
    $result2 = $conn->query($sql2);
    
    if($result2->num_rows>0){
         $sql1 = "insert into tbl_account(student_id,teacher_id,department,category,acc_status) values('$stu_id','$teacher_id','$department','$category',0)";
             $result1 = $conn->query($sql1);
              header('location:../AddClass.php?rp=4403');
        
        
    }else{
             $sql1 = "insert into tbl_account(student_id,teacher_id,department,category) values('$stu_id','$teacher_id','$department','$category')";
             $result1 = $conn->query($sql1);
              header('location:../AddClass.php');
  
    }
 
}

$conn->close();
?>