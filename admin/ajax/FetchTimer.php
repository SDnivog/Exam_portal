<?php

include '../../database/config.php';
include '../includes/check_user.php'; 

extract($_POST);


if(isset($id)){


$sql ="select * from tbl_examinations where user_id='$login_user_id' and exam_id='$id'";

$result = $conn->query($sql);

$response = array();

$row = $result->fetch_assoc();

$response =$row;

echo json_encode($response);



}


if(isset($exam_id)){
    
  $sql  ="select * from tbl_examinations where exam_id='$exam_id' and status='ACTIVE'";
  
  $result = $conn->query($sql);
  if($result->num_rows>0){
      
  }else{
      $sql1 = "update tbl_examinations set status='Active' where exam_id='$exam_id'";
     
     $result = $conn->query($sql1);
     
    if($result){
        echo "success";
    }
  }
  
//   $row = $result->fetch_assoc();
  
//   $today_date  = date("Y-m-d H:i:s");
//   if($today_date <= $row['edate']){
//      $sql1 = "update tbl_examinations set status='Active' where exam_id='$exam_id'";
     
//      $result = $conn->query($sql1);
     
//     if($result){
//         echo "success";
//     }
//   }else{
//       echo "no";
//   }
}
















?>
