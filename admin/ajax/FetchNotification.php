<?php


include '../../database/config.php';
include '../includes/check_user.php';

extract($_POST);


if(isset($noti)){
    
    $sql = "select * from tbl_account where teacher_id='$login_user_id' and acc_status=0";
    
    $result = $conn->query($sql);
    
    
    if($result->num_rows>0){
        echo $result->num_rows;
    }
    
    
    
    
    
    
}







?>