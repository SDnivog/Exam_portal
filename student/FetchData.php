<?php

include 'includes/check_user.php';
include '../database/config.php';

extract($_POST);


if(isset($id)){

    $sql ="select * from tbl_users where user_id='$id' and role='admin'";

    $result = $conn->query($sql);

    if($result->num_rows>0){
        echo "success";
    }
    else{
        echo "no";
    }



}

if(isset($teacherid)){

    $sql ="select * from tbl_departments where user_id='$teacherid'";

    $result = $conn->query($sql);
    

    if($result->num_rows>0){
        $output = '<option value="" selected disabled>-Select Department</option>';
     
        while($row = $result->fetch_assoc()) {
            $output .= '<option value="'.$row['name'].'">'.$row['name'].'</option>';
            }
            echo $output;
           
    }
    
    

}



if(isset($teacher_id) and isset($department_name)){

    $sql ="select * from tbl_categories where user_id='$teacher_id' and department='$department_name'";

    $result = $conn->query($sql);
    

    if($result->num_rows>0){
        $output = '<option value="" selected disabled>-Select Category</option>';
     
        while($row = $result->fetch_assoc()) {
            $output .= '<option value="'.$row['name'].'">'.$row['name'].'</option>';
            }
            echo $output;
           
    }
    
    

}








?>