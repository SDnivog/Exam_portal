<?php


include '../../database/config.php';

include '../includes/check_user.php';

extract($_POST);

if(isset($coins)){
    
    $sql = "select * from tbl_users where user_id='$login_user_id'";
    
    $result = $conn->query($sql);
    
    if($result){
        
        $row = $result->fetch_assoc();
        
        echo "Total Coins :".$row['coins'];
        
    }
    
}








?>