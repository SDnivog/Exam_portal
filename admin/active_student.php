<?php
include '../database/config.php';
include 'includes/check_user.php';


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "update tbl_account set acc_status=1 where student_id='$id' and teacher_id='$login_user_id'";
    
    $result = $conn->query($sql);
    
    if($result){
        header('location:notification.php');
        
     
    }
    
    
}








?>