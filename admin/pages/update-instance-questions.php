<?php


//old code


// include '../../database/config.php';
// include '../../includes/uniques.php';



// if (isset($_GET['question_id']) and isset($_GET['exam_id'])) {


//     $question_id = $_GET['question_id'];
//     $exam_id=$_GET['exam_id'];
//     $question = $_POST['question'];
    
//     $question_type =$_POST['question_data'];
   
//     $mainanswer = '';
   
    
//     if($question_type== "STQ"){
//         $arr = ['A','B','C','D'];
//         for($i=1;$i<=4;$i++){
//             if($arr[$i-1] == $_POST['radio']){
//                 $mainanswer = "option".$i;
//             }
//         }
//          $type_val =1;
//     }else if($question_type == "MTQ"){
//         $arr = ['A','B','C','D'];
//         for($i=1;$i<=4;$i++){
//             if($arr[$i-1] == $_POST['checkbox'.$i]){
//                 $mainanswer .= "option".$i;
//             }
//         }
//          $type_val =1;
//     }else if($question_type == "FQ"){
//         $mainanswer = $_POST['fill'];
//          $type_val =0;
//     }else if($question_type == "TQ"){
//          $arr = ['true','false'];
//         for($i=1;$i<=2;$i++){
//             if($arr[$i-1] == $_POST['true']){
//                 $mainanswer = "option".$i;
//             }
//         }
//          $type_val =2;
       
//     }
    
    

//     $pos_marks = mysqli_real_escape_string($conn,$_POST['pmarks']);
//     $neg_marks = mysqli_real_escape_string($conn,$_POST['nmarks']);

//     $file = $_FILES['ModalImage']['name'];
//     // $filename = unique().'png';
//     $folderPath = 'Upload/'.$file;

// if(!empty($file)){
    

// if(!empty($question)){
//     if(!empty($question_type)){
//       $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question',type_val='$type_val',question_type='$question_type',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
//     }else{
//         $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question',type_val='$type_val' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
//     }
   
// }else{
//     if(!empty($question_type)){
//       $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',question_type='$question_type',type_val='$type_val',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
//     }else{
//           $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks' WHERE question_id='$question_id'  and exam_id='$exam_id'"; 
//     }
    
    
    

// }

// }
// else{
//     if(!empty($question)){
//           if(!empty($question_type)){
         
//       $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question',question_type='$question_type',type_val='$type_val',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
//     }else{
   
//         $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
//     }
    
// }else{
//      if(!empty($question_type)){
       
//       $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',question_type='$question_type',type_val='$type_val',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
//     }else{
       
//         $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
//     }
    
// }
   
// }

// if ($conn->query($sql) === TRUE) {
//     if(!empty($file)){
//         move_uploaded_file($_FILES['ModalImage']['tmp_name'],$folderPath);
//     }
//     header("location:../view-instance-questions.php?eid=$exam_id");	
// } else {
   
//     header("location:../view-instance-questions.php?eid=$exam_id");	
// }




// }




// new code 





include '../../database/config.php';
include '../../includes/uniques.php';


if (isset($_GET['question_id']) and isset($_GET['exam_id']) and isset($_GET['sec_name'])) {

    // $sec_name=$_GET['sec_name'];
    $question_id = $_GET['question_id'];
    $exam_id=$_GET['exam_id'];
    $question = $_POST['question'];
    
    $question_type =$_POST['question_data'];
   
    $mainanswer = '';
   
    
    if($question_type== "STQ"){
        $arr = ['A','B','C','D'];
        for($i=1;$i<=4;$i++){
            if($arr[$i-1] == $_POST['radio']){
                $mainanswer = "option".$i;
            }
        }
         $type_val =1;
    }else if($question_type == "MTQ"){
        $arr = ['A','B','C','D'];
        for($i=1;$i<=4;$i++){
            if($arr[$i-1] == $_POST['checkbox'.$i]){
                $mainanswer .= "option".$i;
            }
        }
         $type_val =1;
    }else if($question_type == "FQ"){
        $mainanswer = $_POST['fill'];
         $type_val =0;
    }else if($question_type == "TQ"){
         $arr = ['true','false'];
        for($i=1;$i<=2;$i++){
            if($arr[$i-1] == $_POST['true']){
                $mainanswer = "option".$i;
            }
        }
         $type_val =2;
       
    }
    
    

    $pos_marks = mysqli_real_escape_string($conn,$_POST['pmarks']);
    $neg_marks = mysqli_real_escape_string($conn,$_POST['nmarks']);

    $file = $_FILES['ModalImage']['name'];
    $file1 = $_FILES['ModalImagehindi']['name'];
    // $filename = unique().'png';
    $folderPath = 'Upload/'.$file;
     $folderPath1 = 'Upload/'.$file1;

if(!empty($file)){
    

if(!empty($question)){
    if(!empty($question_type)){
       $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question',type_val='$type_val',question_type='$question_type',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }else{
        $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question',type_val='$type_val' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
    }
   
}else{
    if(!empty($question_type)){
       $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',question_type='$question_type',type_val='$type_val',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }else{
          $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks' WHERE question_id='$question_id'  and exam_id='$exam_id'"; 
    }
    
    
    

}

}
else{
    if(!empty($question)){
          if(!empty($question_type)){
         
      $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question',question_type='$question_type',type_val='$type_val',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }else{
   
        $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
    }
    
}else{
     if(!empty($question_type)){
       
      $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',question_type='$question_type',type_val='$type_val',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }else{
       
        $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
    }
    
}
   
}

if ($conn->query($sql) === TRUE) {
    
    if(!empty($file1)){
         $sql1 = "UPDATE tbl_questions SET hindi_image='$folderPath1' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
         $result1 = $conn->query($sql1);
         if($result1){
             move_uploaded_file($_FILES['ModalImagehindi']['tmp_name'],$folderPath1);
         }
    }
    
    if(!empty($file)){
        move_uploaded_file($_FILES['ModalImage']['tmp_name'],$folderPath);
    }
    header("location:../view-questions.php?eid=$exam_id#".$question_id."");	
} else {
   
    header("location:../view-questions.php?eid=$exam_id#".$question_id."");	
}




}

else if (isset($_GET['question_id']) and isset($_GET['exam_id'])) {


    $question_id = $_GET['question_id'];
    $exam_id=$_GET['exam_id'];
    $question = $_POST['question'];
    
    $question_type =$_POST['question_data'];
   
    $mainanswer = '';
   
    
    if($question_type== "STQ"){
        $arr = ['A','B','C','D'];
        for($i=1;$i<=4;$i++){
            if($arr[$i-1] == $_POST['radio']){
                $mainanswer = "option".$i;
            }
        }
         $type_val =1;
    }else if($question_type == "MTQ"){
        $arr = ['A','B','C','D'];
        for($i=1;$i<=4;$i++){
            if($arr[$i-1] == $_POST['checkbox'.$i]){
                $mainanswer .= "option".$i;
            }
        }
         $type_val =1;
    }else if($question_type == "FQ"){
        $mainanswer = $_POST['fill'];
         $type_val =0;
    }else if($question_type == "TQ"){
         $arr = ['true','false'];
        for($i=1;$i<=2;$i++){
            if($arr[$i-1] == $_POST['true']){
                $mainanswer = "option".$i;
            }
        }
         $type_val =2;
       
    }
    
    

    $pos_marks = mysqli_real_escape_string($conn,$_POST['pmarks']);
    $neg_marks = mysqli_real_escape_string($conn,$_POST['nmarks']);

    $file = $_FILES['ModalImage']['name'];
    // $filename = unique().'png';
    $folderPath = 'Upload/'.$file;

if(!empty($file)){
    

if(!empty($question)){
    if(!empty($question_type)){
       $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question',type_val='$type_val',question_type='$question_type',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }else{
        $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question',type_val='$type_val' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
    }
   
}else{
    if(!empty($question_type)){
       $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',question_type='$question_type',type_val='$type_val',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }else{
          $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks' WHERE question_id='$question_id'  and exam_id='$exam_id'"; 
    }
    
    
    

}

}
else{
    if(!empty($question)){
          if(!empty($question_type)){
         
      $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question',question_type='$question_type',type_val='$type_val',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }else{
   
        $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',question='$question' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
    }
    
}else{
     if(!empty($question_type)){
       
      $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',question_type='$question_type',type_val='$type_val',answer='$mainanswer' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }else{
       
        $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks' WHERE question_id='$question_id' and exam_id='$exam_id'"; 
    }
    
}
   
}

if ($conn->query($sql) === TRUE) {
    if(!empty($file)){
        move_uploaded_file($_FILES['ModalImage']['tmp_name'],$folderPath);
    }
    header("location:../view-questions.php?eid=$exam_id#".$question_id."");	
} else {
   
    header("location:../view-questions.php?eid=$exam_id#".$question_id."");	
}




}





?>