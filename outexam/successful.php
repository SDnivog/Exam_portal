<?php

include '../database/config.php';
session_start();
$exam_id = $_SESSION['data_id'];

function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

if(!isset($_SESSION['id']) and !isset($_SESSION['email'])){
    header('location:details.php?eid='.$exam_id.'');
}


$stu_id = $_SESSION['id'];

/// coded by suraj 




$mytotal_marks = 0;



// code for insert student socre and status 


$sql1 = "select * from tbl_responses where exam_id='$exam_id' and stu_id='$stu_id'";

$result = $conn->query($sql1);
$total_marks =0;
$total_count = "select * from tbl_questions where exam_id='$exam_id'";
$total_result = $conn->query($total_count);
while($total = $total_result->fetch_assoc()){
    $total_marks += $total['pos_marks'];
}

   while($row = $result->fetch_assoc()){
      
      $q_id = $row['question_id'];
      $stu_response = $row['stu_response'];


      $sql2 = "select * from tbl_questions where question_id='$q_id'";

      $result2 = $conn->query($sql2);

      $ans = $result2->fetch_assoc();

      $question_type = $ans['question_type'];
      $answer= $ans['answer'];
      $answer_val = $ans[$answer];

      
         $bonus_question = $ans['bonus'];
                                               
        $par_total=0;
    
      $type= $ans['type'];
      
    //   if($type == "MC"){

      if($question_type == "MTQ"){
           if($bonus_question == 1){
                                                        $mytotal_marks += $ans['pos_marks'];
                                                  }else if($bonus_question ==0){
                                                       $par_status = $arr['par_status'];
                                                      if($par_status ==1){
                                                          /// partial marking
                                                          $answer_option = $row1['mul_response'];
                                                          if($answer == $answer_option){
                                                               $mytotal_marks += $ans['pos_marks'];
                                                                
                                                          }else{
                                                              $flag =0 ;
                                                              for($i=1;$i<5;$i++){
                                                         if(strpos($answer,'option'.$i)  !== false){
                                                             if(strpos($answer_option,'option'.$i)  !== false){
                                                                     $par_total+= 1;
                                                                }
                                                         }else if(strpos($answer_option,'option'.$i)  !== false){
                                                                 $mytotal_marks += $ans['neg_marks'];
                                                            
                                                                $flag =1;
                                                                break;
                                                                }
                                                           
                                                        } 
                                                        if($flag == 0){
                                                          $mytotal_marks += $par_total;
                                                     
                                                        }
                                                              
                                                          }
                                                          
                                                          
                                                          
                                                   
                                                          
                                                          
                                                          
                                                          
                                                      }else{
                                                  $answer_option = $row['mul_response'];
                                                if($answer == $answer_option){
                                                   $mytotal_marks += $ans['pos_marks'];
                                                }
                                                else if($answer_option == "" and $row['stu_response'] == ""){
                                                   $mytotal_marks = $mytotal_marks;
                                    
                                                }
                                                else{
                                                   $mytotal_marks += $ans['neg_marks'];
                                                }
                                                  }
                                                  }
          
          
          
         
        
   
      }else if($question_type == "FQ"){
           if($bonus_question == 1){
                $mytotal_marks += $ans['pos_marks']; 
            }else if($bonus_question ==0){
          
          
           if(!empty($stu_response)){
                                                          $end_range = explode("-",$answer);
                                                               if($end_range[0] != "" and $end_range[1] != ""){
                                                                   if($stu_response>=$end_range[0] and $end_range[1]>=$stu_response){
                                                                         $mytotal_marks += $ans['pos_marks']; 
                                                                      }
                                                               
                                                               }else{
                                                                    if(strtolower($stu_response) == strtolower($answer)){
                                                                  $mytotal_marks += $ans['pos_marks']; 
                                                                  }
                                                               }
                                                        }
          
    //       if($stu_response == $answer){
    //      $mytotal_marks += $ans['pos_marks']; 
    //   }
      else if($stu_response == ''){
         $mytotal_marks = $mytotal_marks;
      }
      else{
         $mytotal_marks += $ans['neg_marks'];
      }
          
      }  
      }else if($question_type== "TQ"){
           if($bonus_question == 1){
                                                        $mytotal_marks += $ans['pos_marks']; 
                                                  }else if($bonus_question ==0){
          $arr_answer = ['true','false'];
          for($i=1;$i<=2;$i++){
              if($answer == "option".$i){
                  $mainanswer = $arr_answer[$i-1];
              }
          }
          
           if($stu_response == $mainanswer){
                 $mytotal_marks += $ans['pos_marks']; 
              }
              else if($stu_response == ''){
                 $mytotal_marks = $mytotal_marks;
              }
              else{
                 $mytotal_marks += $ans['neg_marks'];
              }
                                                  }
      }
      else if($question_type== "STQ"){
          if($bonus_question == 1){
                                                    $mytotal_marks += $ans['pos_marks']; 
        }else if($bonus_question ==0){ 

      if($stu_response == $answer_val){
         $mytotal_marks += $ans['pos_marks']; 
      }
      else if($stu_response == ''){
         $mytotal_marks = $mytotal_marks;
      }
      else{
         $mytotal_marks += $ans['neg_marks'];
      }
      }
   }
    //   }
      
    //   else{
    //         if($stu_response == $answer){
    //      $mytotal_marks += $ans['pos_marks']; 
    //   }
    //   else if($stu_response == ''){
    //      $mytotal_marks = $mytotal_marks;
    //   }
    //   else{
    //      $mytotal_marks += $ans['neg_marks'];
    //   }
    //   }
   

   }


   $sql3 = "select * from tbl_examinations where exam_id='$exam_id'";

   $result3 = $conn->query($sql3);
   
   $arr  = $result3->fetch_assoc();
   
   $cutoff_marks = $arr['cutoff_marks'];



        if ($mytotal_marks >= $cutoff_marks) {
        $status = "PASS";	
        }else{
        $status = "FAIL";	
        }
        
        
      $record =    $_SESSION['record_id'] ;
      
        $sql = "UPDATE tbl_assessment_records SET score='$mytotal_marks', status='$status' WHERE record_id='$record'";
        
        $result = $conn->query($sql);
        
        
        
        /// code to send email  for marks

    
    
        
        $sql2 = "select * from outexams where id='$stu_id'";
        
        $result2 = $conn->query($sql2);
        
        $exam_name = $arr['exam_name'];
        
        $row2 = $result2->fetch_assoc();
        $stu_email = $row2['email'];
        $name = $row2['name'];
    
        // $from = "examinfo@kendel.in";
        // $to =   $stu_email;
        // $subject = "Exam Details";
        // $message = "       Welcome  $name !
        // Your Score In $exam_name  is
        // Score : $mytotal_marks/$total_marks
       
        // "
        // ;
        
        $headers = "From :".$from;
        
        $to = $stu_email;
        $subject = 'Exam Details';
        $from = 'examinfo@kendel.in';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
         
        // Compose a simple HTML email message
        $message = '<html><body style="display: flex;justify-content: center;align-items: center;">
       <div>
        <h4 style="color:#444;">Hello '.$name.'!,</h4>
        <p style="color:#666;font-size:18px;">
       Your Score In '.$exam_name.'  is '.$mytotal_marks.'/'.$total_marks.'
        </p>
        <p style="color:#61c456;font-size:20px;">Thank You !</p>
       </div>
        </body></html>';
        
        
        mail($to,$subject,$message,$headers);
        
        
   
        




?>








<html>
    <head>
        <title>Kendel | Exam</title>
        <style>
            .show_result{
                position:absolute;
                left:50%;
                transform:translate(-50%,0%);
                top:30%;
                text-align:center;
            }
            .show_result .pexm{
                font-size:30px !important;
                color:green;
            }
            .scoretext{
                font-size:24px !important;
                color:#1b263b;
            }
            .center{
                height:150px;
                width:150px;
                background:#349eeb;
                display:flex;
                justify-content:center;
                align-items:center;
                font-size:30px;
                border-radius:50%;
                color:white;
            }
            .score{
                 position:absolute;
                left:50%;
                transform:translate(-50%,0%);
                top:80%;
            }
            #link{
                text-decoration:none;
                
            }
        </style>
    </head>
    <body>
        <div class="show_result ">
            <p class="pexm">Your Response Recoreded Successfully For Exam <?php echo $arr['exam_name']; ?></p>
            <p class="scoretext">Your Score  </p>
           <div class="score">
                <p class="center"><?php
                echo $mytotal_marks."/".$total_marks;
                // session_destroy();
                unset($_SESSION['id']);
                unset($_SESSION['email']);
               unset($_SESSION['active_data']);
        
                     unset($_SESSION['username']);
                ?></p>
                <a href="response_exam.php?sid=<?php echo $stu_id;  ?>&content =  <?php echo getName(40); ?>&eid=<?php echo $exam_id; ?>" class="btn btn-primary">Your Response</a>
                <a href="details.php?eid=<?php echo $exam_id; ?>" id="link">Give Same Exam Again</a>
           </div>
        </div>
    </body>
</html>