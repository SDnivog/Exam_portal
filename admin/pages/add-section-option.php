<?php
include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';


$total_question = $_POST['total_question'];
$exam_id=$_POST['exam_id'];

$q_data = $_POST['btndata'];
$msg =''; 



if(isset($_GET['section_name'])){

for($i=1;$i<=$total_question;$i++){
    
    $question_type = $_POST['question_type'.$i];
     $question_id=$_POST['question_id'.$i];
     $mainanswer ='';
     
     $questio_type_db  = ''; 
     
     $sec_name = $_GET['section_name'];
 
    $sec_name =str_replace(' ', '', $sec_name);
   
         
    if($question_type=="single"){
        $answer = $_POST['answerradio'.$i];
        $arr = ['A','B','C','D'];
        for($j=1;$j<=4;$j++){
            if($arr[$j-1] == $answer){
                $mainanswer = 'option'.$j;
            }
        }
        $question_type_db = "STQ";
        $type_val =1;
    }
    else if($question_type=="multiple"){
       
        $arr = ['A','B','C','D'];
        for($j=1;$j<=4;$j++){
             $answer = $_POST['answercheckbox'.$j.$i];
            if($arr[$j-1] == $answer){
                $mainanswer .= 'option'.$j;
            }
        }
        $question_type_db = "MTQ";
        $type_val =1;
        
    }else if($question_type == "fill"){
        $mainanswer = $_POST['answerfill'.$i];
         $question_type_db = "FQ";
         $type_val =0;
    }else if($question_type == "true"){
         $answer = $_POST['answertrue'.$i];
        $arr = ['true','false'];
          for($j=1;$j<=2;$j++){
        if($arr[$j-1] == $answer){
            $mainanswer = 'option'.$j;
        }
        }
        $question_type_db = "TQ";
        $type_val =2;
    }
    
    
    
  
  if(!empty($mainanswer)){
    
     
     $questions= $_POST['question'.$sec_name.$i];
     
    
     
    if(!empty($questions)){
         $sql1 = "update tbl_questions set answer='$mainanswer',question='$questions',question_type='$question_type_db',type_val='$type_val' where exam_id='$exam_id' and question_id='$question_id'"; 
    }else{
          $sql1 = "update tbl_questions set answer='$mainanswer',question_type='$question_type_db',type_val='$type_val' where exam_id='$exam_id' and question_id='$question_id'";
    }

    
     

        $result1 = $conn->query($sql1);

        if($result1){
            $msg = "success";
        }
        
    
    
    
    
   
    
    
}else {
    
  
    
     $questions= $_POST['question'.$sec_name.$i];
     
  
        if(!empty($questions)){
             $sql1 = "update tbl_questions set question='$questions' where exam_id='$exam_id' and question_id='$question_id'";
             
        $result1 = $conn->query($sql1);

        if($result1){
            $msg = "success";
        }
        
        }
    
       
      
    }
    

        
    
    
    
    
   
    










}






if($msg == "success"){
    
    header('location:../view-questions.php?eid='.$exam_id.'&rp=4001');
}
else{
    header('location:../view-questions.php?eid='.$exam_id.'&rp=3903');
}


}


?>