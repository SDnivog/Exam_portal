<?php


include '../database/config.php';


extract($_POST);



if(!empty($planname) and !empty($plancode) and !empty($planamount)){

$sql = "select * from tbl_plan where plan_name='$planname' and plan_code='$plancode' and plan_amount='$planamount'";

$result = $conn->query($sql);

if($result->num_rows>0){
    header('location:pricecard.php');
}else{
    $date = date('Y-m-d');
    $sql1 = "insert into tbl_plan (plan_code,plan_name,plan_amount,date) values('$plancode','$planname','$planamount','$date')";
    
    $result1 = $conn->query($sql1);
    
    if($result1){
        header('location:pricecard.php');
    }
}




}









?>