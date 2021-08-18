<?php

include '../../database/config.php';
include '../../includes/uniques.php';



if (isset($_GET['question_id']) and isset($_GET['exam_id']) and isset($_GET['datafile'])) {


    $question_id = $_GET['question_id'];
    $exam_id=$_GET['exam_id'];
    $datafile = $_GET['datafile'];
    $question = $_POST['question'];
    
    $answer = $_POST['answer'];
    
    $question_type = $_POST['question_data'];
   
 
   
    
    if($question_type== "STQ"){
        $type_val =1;
    }else if($question_type == "MTQ"){
        for($i=1;$i<=4;$i++){
            if($_POST['checkbox'.$i] != ""){
                $answer .= "option".$i;
            }
        }
         $type_val =1;
    }else if($question_type == "FQ"){
      
         $type_val =0;
    }else if($question_type == "TQ"){
       
         $type_val =2;
       
    }
    


    $pos_marks = mysqli_real_escape_string($conn,$_POST['pmarks']);
    $neg_marks = mysqli_real_escape_string($conn,$_POST['nmarks']);

    $file = $_FILES['ModalImage']['name'];
    $folderPath = 'Upload/'.$file;
    
    
    
    if(!empty($file)){
         $sql = "UPDATE tbl_questions SET image='$folderPath',pos_marks='$pos_marks',neg_marks='$neg_marks',answer='$answer',question='$question',type_val='$type_val',question_type='$question_type' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }else{
         $sql = "UPDATE tbl_questions SET pos_marks='$pos_marks',neg_marks='$neg_marks',answer='$answer',question='$question',type_val='$type_val',question_type='$question_type' WHERE question_id='$question_id' and exam_id='$exam_id'";  
    }


if($datafile == "singlefile"){

if ($conn->query($sql) === TRUE) {
    if(!empty($file)){
    move_uploaded_file($_FILES['ModalImage']['tmp_name'],$folderPath);
    }
    header("location:../view-questions.php?eid=$exam_id");	
} else {
   
    header("location:../view-questions.php?eid=$exam_id");	
}
}else if($datafile == "excel"){
    if ($conn->query($sql) === TRUE) {
    if(!empty($file)){
    move_uploaded_file($_FILES['ModalImage']['tmp_name'],$folderPath);
    }
    header("location:../view-excel-questions.php?eid=$exam_id");	
} else {
   
    header("location:../view-excel-questions.php?eid=$exam_id");	
}
}




}



?>