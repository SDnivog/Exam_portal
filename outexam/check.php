<?php
include '../database/config.php';
session_start();

$get_Exam = $_SESSION['exam_out_url'];





if(isset($_GET['eid'])){
    
    $id = $_GET['eid'];
    $username = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $rolno = mysqli_real_escape_string($conn,$_POST['rollno']);
    $user_id = "OS".rand(100,999)."-".rand(100,999)."-".rand(100,999);
    $date=date("Y-m-d");
    
    
 
    
    $sql = "select * from outexams where email='$email' and exam_id='$id'";
    $result = $conn->query($sql);
    
    if($result->num_rows>0){
        header('location:alreadygiven.php');
       
        
    }else{
        $sql1 = "insert into outexams values ('$user_id','$email','$rolno','$username','$date','$id')";
        $result1= $conn->query($sql1);
        
        
        if($result1){
            $_SESSION['active_data'] ="Examdata";
            $_SESSION['email'] =$email;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            
            $today_date = date("Y-m-d");
            
            $sql2 = "SELECT * FROM tbl_assessment_records WHERE student_id = '$user_id' and exam_id='$id'";
            $result2 = $conn->query($sql2);
            
            if ($result2->num_rows > 0) {
                header('location:alreadygiven.php');
                
             
                
            } else {
                
 
            
            $recid = 'RS'.rand(1000000,9999999).rand(1000000,9999999);
            $_SESSION['record_id'] = $recid;
            
            $sql3 = "INSERT INTO tbl_assessment_records (record_id, student_id, student_name, exam_id, score, status,date)
            VALUES ('$recid', '$user_id', '$username','$id', '0', 'FAIL', '$today_date')";
            
            if ($conn->query($sql3) === TRUE) {
                
                $sql_update = "select * from tbl_examinations where exam_id='$id'";
    
                    $result_sql = $conn->query($sql_update);
                    
                    $row_sql = $result_sql->fetch_assoc();
                    
                    $teacher_id_exam = $row_sql['user_id'];
                    
                    $data_sql = "select * from tbl_users where user_id='$teacher_id_exam'";
                    
                    $result_data = $conn->query($data_sql);
                    
                    $row_data  = $result_data->fetch_assoc();
                    $coins_data = $row_data['coins']-1;
                    
                    
                    $update_data = "update tbl_users set coins='$coins_data' where user_id='$teacher_id_exam'";
                    
                    $update_result = $conn->query($update_data);
                
                
                
                
                
                
                if(!empty($get_Exam)){
             header('location:'.$get_Exam.'?eid='.$id.'');
                }else if (empty($get_Exam)){
                    header('location:exam.php?eid='.$id.'');
                }
          
            
            } else {
                
            }
            
            }


           
        }
    }
    
    
    
    
    
    
    
}








?>