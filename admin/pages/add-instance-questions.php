<?php
// old code
// include '../../database/config.php';
// include '../../includes/uniques.php';
// include '../includes/check_user.php';

// $examid = mysqli_real_escape_string($conn, $_GET['exam_id']);





// if(isset($_FILES['ModalImage']['name']) and  isset($examid)){


// // Count # of uploaded files in array
// $total = count($_FILES['ModalImage']['name']);

// // Loop through each file
// for( $i=0 ; $i < $total ; $i++ ) {
  
//   //Get the temp file path

// $question_id = 'QS-'.get_rand_numbers(6).'';


// $filename =  $_FILES['ModalImage']['name'][$i];

//  $folderPath = 'Upload/';
    
//         $filename_change = uniqid() . '.png';
//         $file = $folderPath .$filename_change;

// $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND user_id = '$login_user_id' AND image='$file'";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {

//  header('location:../view-instance-questions.php?eid='.$examid.'');
// } else {
    
 
//     $sql ="INSERT INTO tbl_questions (user_id,question_id,question_no, exam_id, type,image,question_type ,option1,option2,option3,option4,pos_marks,neg_marks,type_val) VALUES ('$login_user_id','$question_id','0', '$examid', 'MC', '$file','','A','B','C','D','4','-1','1')";

// if ($conn->query($sql) === TRUE) {
  
    
//   move_uploaded_file($_FILES["ModalImage"]["tmp_name"][$i], $file);
// header("location:../view-instance-questions.php?rp=0357&eid=$examid");	
// } else{
//      header("location:../view-instance-questions.php?rp=3903&eid=$examid");	
// }





	
// }
// }



// }




//new code

include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

$examid = mysqli_real_escape_string($conn, $_GET['exam_id']);

$sec_name = mysqli_real_escape_string($conn, $_GET['sec_name']);





if(isset($sec_name) and !empty($sec_name) and isset($examid) and count($_FILES['ModalImage']['name'])>1 and count($_FILES['ModalImageHindi']['name'])<= 1){
    
   
    
    
    
        // Count # of uploaded files in array
        $total = count($_FILES['ModalImage']['name']);
        
        // Loop through each file
        for( $i=0 ; $i < $total ; $i++ ) {
          
         //Get the temp file path
        
        $question_id = 'QS-'.get_rand_numbers(6).'';
        
        
        $filename =  $_FILES['ModalImage']['name'][$i];
        
         $folderPath = 'Upload/';
            
                $filename_change = uniqid() . '.png';
                $file = $folderPath .$filename_change;
        
        $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND user_id = '$login_user_id' AND image='$file'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
        
         header('location:../view-questions.php?eid='.$examid.'');
        } else {
            
         
            $sql ="INSERT INTO tbl_questions (user_id,question_id,bonus, exam_id, type,image,question_type ,option1,option2,option3,option4,pos_marks,neg_marks,type_val,sec_name) VALUES ('$login_user_id','$question_id','0', '$examid', 'MC', '$file','','A','B','C','D','4','-1','1','$sec_name')";
        
        if ($conn->query($sql) === TRUE) {
          
            
          move_uploaded_file($_FILES["ModalImage"]["tmp_name"][$i], $file);
        header("location:../view-questions.php?rp=0357&eid=$examid");	
        } else{
             header("location:../view-questions.php?rp=3903&eid=$examid");	
        }
        
        
        
        
        
        	
        }
        }
        
        
        $sql_sec= "select * from tbl_assessment_records where exam_id='$examid'";
    
     $result_sec = $conn->query($sql_sec);
    
    if($result_sec->num_rows>0){
        $sql_up = "update tbl_examinations set status='Inactive' where exam_id='$examid'";
        
        $result_up = $conn->query($sql_up);
        
        if($result_up){
            header("location:../view-questions.php?rp=3903&eid=$examid");	
        }else{
            header("location:../view-questions.php?rp=3903&eid=$examid");	
        }
    }
        
        
        
        
        
    
    
}
else if(isset($sec_name) and !empty($sec_name) and isset($examid) and count($_FILES['ModalImage']['name'])<=1 and count($_FILES['ModalImageHindi']['name'])>1){
    
    
    
    
        // Count # of uploaded files in array
        $total = count($_FILES['ModalImageHindi']['name']);
        
        // Loop through each file
        for( $i=0 ; $i < $total ; $i++ ) {
          
         //Get the temp file path
        
        $question_id = 'QS-'.get_rand_numbers(6).'';
        
        
        $filename =  $_FILES['ModalImageHindi']['name'][$i];
        
         $folderPath = 'Upload/';
            
                $filename_change = uniqid() . '.png';
                $file = $folderPath .$filename_change;
        
        $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND user_id = '$login_user_id' AND image='$file'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
        
         header('location:../view-questions.php?eid='.$examid.'');
        } else {
            
         
            $sql ="INSERT INTO tbl_questions (user_id,question_id,bonus, exam_id, type,hindi_image,question_type ,option1,option2,option3,option4,pos_marks,neg_marks,type_val,sec_name) VALUES ('$login_user_id','$question_id','0', '$examid', 'MC', '$file','','A','B','C','D','4','-1','1','$sec_name')";
        
        if ($conn->query($sql) === TRUE) {
          
            
          move_uploaded_file($_FILES["ModalImageHindi"]["tmp_name"][$i], $file);
        header("location:../view-questions.php?rp=0357&eid=$examid");	
        } else{
             header("location:../view-questions.php?rp=3903&eid=$examid");	
        }
        
        
        
        
        
        	
        }
        }
        
        
        $sql_sec= "select * from tbl_assessment_records where exam_id='$examid'";
    
     $result_sec = $conn->query($sql_sec);
    
    if($result_sec->num_rows>0){
        $sql_up = "update tbl_examinations set status='Inactive' where exam_id='$examid'";
        
        $result_up = $conn->query($sql_up);
        
        if($result_up){
            header("location:../view-questions.php?rp=3903&eid=$examid");	
        }else{
            header("location:../view-questions.php?rp=3903&eid=$examid");	
        }
    }
        
        
        
        
        
    
    
} 
else if(isset($sec_name) and !empty($sec_name) and isset($examid) and count($_FILES['ModalImage']['name'])>1 and count($_FILES['ModalImageHindi']['name'])>1){
    
   
    
    
        // Count # of uploaded files in array
        $total = count($_FILES['ModalImage']['name']);
        $total1 = count($_FILES['ModalImageHindi']['name']);
        
        if($total == $total1){
        // Loop through each file
        for( $i=0 ; $i < $total ; $i++ ) {
          
         //Get the temp file path
        
        $question_id = 'QS-'.get_rand_numbers(6).'';
        
        
        $filename =  $_FILES['ModalImage']['name'][$i];
        
         $folderPath = 'Upload/';
            
                $filename_change = uniqid() . '.png';
                $file = $folderPath .$filename_change;
                $file1 = $folderPath ."hindi".$filename_change;
        
        $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND user_id = '$login_user_id' AND image='$file' and hindi_image='$file1'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
        
         header('location:../view-questions.php?eid='.$examid.'');
        } else {
            
         
            $sql ="INSERT INTO tbl_questions (user_id,question_id,bonus, exam_id, type,image,hindi_image,question_type ,option1,option2,option3,option4,pos_marks,neg_marks,type_val,sec_name) VALUES ('$login_user_id','$question_id','0', '$examid', 'MC', '$file','$file1','','A','B','C','D','4','-1','1','$sec_name')";
        
        if ($conn->query($sql) === TRUE) {
          
            
          move_uploaded_file($_FILES["ModalImage"]["tmp_name"][$i], $file);
          move_uploaded_file($_FILES["ModalImageHindi"]["tmp_name"][$i], $file1);
        header("location:../view-questions.php?rp=0357&eid=$examid");	
        } else{
             header("location:../view-questions.php?rp=3903&eid=$examid");	
        }
        
        
        
        
        
        	
        }
        }
        
        
        $sql_sec= "select * from tbl_assessment_records where exam_id='$examid'";
    
     $result_sec = $conn->query($sql_sec);
    
    if($result_sec->num_rows>0){
        $sql_up = "update tbl_examinations set status='Inactive' where exam_id='$examid'";
        
        $result_up = $conn->query($sql_up);
        
        if($result_up){
            header("location:../view-questions.php?rp=3903&eid=$examid");	
        }else{
            header("location:../view-questions.php?rp=3903&eid=$examid");	
        }
    }
        
        
        
        
    } 
    
    
}




// else if(isset($_FILES['ModalImage']['name']) and  isset($examid)){


// // Count # of uploaded files in array
// $total = count($_FILES['ModalImage']['name']);

// // Loop through each file
// for( $i=0 ; $i < $total ; $i++ ) {
  
//   //Get the temp file path

// $question_id = 'QS-'.get_rand_numbers(6).'';


// $filename =  $_FILES['ModalImage']['name'][$i];

//  $folderPath = 'Upload/';
    
//         $filename_change = uniqid() . '.png';
//         $file = $folderPath .$filename_change;

// $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND user_id = '$login_user_id' AND image='$file'";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {

//  header('location:../view-questions.php?eid='.$examid.'');
// } else {
    
 
//     $sql ="INSERT INTO tbl_questions (user_id,question_id,bonus, exam_id, type,image,question_type ,option1,option2,option3,option4,pos_marks,neg_marks,type_val) VALUES ('$login_user_id','$question_id','0', '$examid', 'MC', '$file','','A','B','C','D','4','-1','1')";

// if ($conn->query($sql) === TRUE) {
  
    
//   move_uploaded_file($_FILES["ModalImage"]["tmp_name"][$i], $file);
// header("location:../view-questions.php?rp=0357&eid=$examid");	
// } else{
//      header("location:../view-questions.php?rp=3903&eid=$examid");	
// }





	
// }
// }



// }



?>