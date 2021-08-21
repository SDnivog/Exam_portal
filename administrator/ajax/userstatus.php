<?php
include '../../database/config.php';

extract($_POST);

if(isset($id) and isset($status)){
    $sql = "update tbl_users set acc_stat='$status' where user_id='$id'";
    $result = $conn->query($sql);
  

}



?>