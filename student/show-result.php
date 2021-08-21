<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';
?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Trando | My Results</title>

        <?php include 'header.php';?>
                    <!--<ul class="menu accordion-menu">-->
                    <!--    <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>-->
                    <!--    <li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                    <!--    <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>-->
                    <!--    <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>-->
                    <!--    <li class="active"><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>-->

                    <!--</ul>-->
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>My Results</h3>
 <ol class="breadcrumb">
                            <li><a href="./index">Home</a></li>
                            <li class="active">My Result</li>
                        </ol>


                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
						<div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-white">
                                    <div class="panel-body">
                                    <?php
										   include '../database/config.php';
                                          
                                            
                                           $stu_id = htmlentities(mysqli_real_escape_string($conn,$_GET['stu_id'])) ;
                                           $exam_id = htmlentities(mysqli_real_escape_string($conn,$_GET['exam_id'])) ;

                                           if(isset($stu_id) and isset($exam_id)){
                                               
                                               
                                            
                                            $sql2 = "select * from tbl_responses where stu_id='$stu_id' and exam_id='$exam_id'";

                                            $result2 = $conn->query($sql2);
                                            $count = $result2->num_rows;
                                            
                                            $total_marks = 0;

                                          
                                            $correct_answer=0;
                                            $wrong_answer = 0;
                                            $unattempt_answer = 0;
                                            $bonus_count=0;


                                            while($row1 = $result2->fetch_assoc()){
                                               
                                               
                                                $question_id = $row1['question_id'];
                                                $stu_response = $row1['stu_response'];
                                                $sql1 = "select * from tbl_questions where question_id = '$question_id' and exam_id ='$exam_id'";

                                                $result1 = $conn->query($sql1);
                                                
                                                $arr = $result1->fetch_assoc();
                                                
                                                $answer = $arr['answer'];
                                                $answer_val = $arr[$answer];
                                                $type = $arr['type'];
                                                $pmarks = $arr['pos_marks'];
                                                $nmarks = $arr['neg_marks'];
                                                $question_type=$arr['question_type'];
                                                $bonus_question = $arr['bonus'];
                                                 $par_total=0;
                                               
                                            //   if($type=="MC"){

                                              if($question_type == "MTQ"){
                                                   if($bonus_question == 1){
                                                     if($answer_option == "" and $row['stu_response'] == ""){
                                                            $unattempt_answer++;
                                     
                                                    }
                                                       $total_marks += $pmarks;
                                                       $bonus_count++;
                                                  }else if($bonus_question ==0){
                                                       $par_status = $arr['par_status'];
                                                      if($par_status ==1){
                                                          /// partial marking
                                                          $answer_option = $row1['mul_response'];
                                                          if($answer == $answer_option){
                                                               $total_marks += $pmarks;
                                                                 $correct_answer++;
                                                          }else if($answer_option == "" and $row['stu_response']== ""){
                                                               $unattempt_answer++;
                                                          }
                                                          else{
                                                              $flag =0 ;
                                                              for($i=1;$i<5;$i++){
                                                         if(strpos($answer,'option'.$i)  !== false){
                                                             if(strpos($answer_option,'option'.$i)  !== false){
                                                                     $par_total+= 1;
                                                                }
                                                         }else if(strpos($answer_option,'option'.$i)  !== false){
                                                               $total_marks += $nmarks;
                                                                $wrong_answer++;
                                                                $flag =1;
                                                                break;
                                                                }
                                                           
                                                        } 
                                                        if($flag == 0){
                                                          $total_marks += $par_total;
                                                          $correct_answer++;
                                                        }
                                                              
                                                          }
                                                          
                                                          
                                                          
                                                   
                                                          
                                                          
                                                          
                                                          
                                                      }else{
                                                      
                                                      
                                                      
                                                $answer_option = $row1['mul_response'];
                                                   if($answer == $answer_option){
                                                      $total_marks += $pmarks;
                                                      $correct_answer++;
                                                   }
                                                   else if($answer_option == "" and $row['stu_response'] == ""){
                                                    $total_marks = $total_marks;
                                                    $unattempt_answer++;
                                     
                                                    }
                                                   else{
                                                      $total_marks += $nmarks;
                                                      $wrong_answer++;
                                                   }
                                                  }
                                                  }
                                          
                                             }else if($question_type == "FQ"){
                                                   if($bonus_question == 1){
                                                       if($stu_response == ""){
                                                 
                                                    $unattempt_answer++;

                                                }
                                                       $total_marks += $pmarks;
                                                        $bonus_count++;
                                                  }else if($bonus_question ==0){
                                                      if(!empty($stu_response)){
                                                          $end_range = explode("-",$answer);
                                                               if($end_range[0] != "" and $end_range[1] != ""){
                                                                   if($stu_response>=$end_range[0] and $end_range[1]>=$stu_response){
                                                                          $total_marks = $total_marks+$pmarks;
                                                                            $correct_answer++; 
                                                                      }
                                                               
                                                               }else{
                                                                    if(strtolower($stu_response) == strtolower($answer)){
                                                                  $total_marks = $total_marks+$pmarks;
                                                                    $correct_answer++;
                                                                  }
                                                               }
                                                        }
                                                //   if(strtolower($stu_response) == strtolower($answer)){
                                                //     $total_marks = $total_marks+$pmarks;
                                                //     $correct_answer++;
                                                // }
                                                else if($stu_response == ""){
                                                    $total_marks = $total_marks;
                                                    $unattempt_answer++;

                                                }
                                                else{
                                                    $total_marks = $total_marks+$nmarks;
                                                    $wrong_answer++;
                                                }
                                                  }
                                                 
                                             }else if($question_type == "TQ"){
                                                   if($bonus_question == 1){
                                                       if($stu_response == ""){
                                                  
                                                   
                                                    $unattempt_answer++;

                                                }
                                                       $total_marks += $pmarks;
                                                        $bonus_count++;
                                                  }else if($bonus_question ==0){
                                                 $arr = ['true','false'];
                                                 for($i=1;$i<=2;$i++){
                                                     if($answer == "option".$i ){
                                                         $mainanswer = $arr[$i-1];
                                                     }
                                                 }
                                                 if($stu_response == $mainanswer){
                                                    $total_marks = $total_marks+$pmarks;
                                                    $correct_answer++;
                                                }else if($stu_response == ""){
                                                    $total_marks = $total_marks;
                                                   
                                                    $unattempt_answer++;

                                                }
                                                else {
                                                    $total_marks = $total_marks+$nmarks;
                                                    $wrong_answer++;
                                                }
                                                  }
                                             }
                                             
                                             
                                             
                                             
                                             else if($question_type== 'STQ'){
                                                   if($bonus_question == 1){
                                                       if($stu_response == ""){
                                               
                                                   
                                                    $unattempt_answer++;

                                                }
                                                       $total_marks += $pmarks;
                                                        $bonus_count++;
                                                  }else if($bonus_question ==0){
                                                if($stu_response == $answer_val){
                                                    $total_marks = $total_marks+$pmarks;
                                                    $correct_answer++;
                                                }else if($stu_response == ""){
                                                    $total_marks = $total_marks;
                                                   
                                                    $unattempt_answer++;

                                                }
                                                else{
                                                    $total_marks = $total_marks+$nmarks;
                                                    $wrong_answer++;
                                                }
                                            }
                                             }
                                               }
                                          
                                            $attempt_question = $count-($unattempt_answer);
                                                $sqls = "select * from tbl_users where user_id='$stu_id'";
                                                $results = $conn->query($sqls);

                                                $arrs = $results->fetch_assoc();

                                               
                                                //  <div class="col-lg-6">
                                                // <h3 class="text-center">Student Details</h3>
                                                    
                                                // <div class="col-lg-8">
                                                //     <h4 style="padding:10px">Student Id: '.$stu_id.'</h4>
                                                //     <h4 style="padding:10px">Student Name : '.$arrs['first_name'].$arrs['last_name'].'</h4>
                                                    

                                                //     <h4 style="padding:10px">Student Email : '.$arrs['email'].'</h4>
                                                //     <h4 style="padding:10px">Student Department : '.$arrs['department'].'</h4>
                                                //     <h4 style="padding:10px">Student Class : '.$arrs['category'].'</h4>
                                                // </div>
                                                // <div class="col-lg-4">
                                                // <div style="margin-top:25px">
                                            //     ';
                                            //     if ($myavatar == NULL) {
                                            //         $dis .=' <img class="img-circle avatar"  width="100%" height="100%" style="padding:30px" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
                                            //         }else{
                                            //         $dis .='<img width="100%" height="100%" src="data:image/jpeg;base64,'.base64_encode($myavatar).'" style="padding:10px" class="img-circle avatar"  alt="'.$myfname.'"/>';	
                                            //         }
                                               

                                                
                                            //   $dis .='</div>
                                            //   </div>
                                            //      </div>
                                             $dis = '
                                                <div >
                                                <div class="col-lg-12">
                                                
                                                <h3 class="text-center">Student Performance</h3>
                                                <h4 style="padding:10px;padding-left:50px">Exam Id : '.$exam_id.'</h4>
                                                <h4 style="padding:10px;padding-left:50px">Total Marks Obtained :'.$total_marks.' </h4>
                                                <h4 style="padding:10px;padding-left:50px">Total Correct Answer :'.$correct_answer.'</h4>
                                                <h4 style="padding:10px;padding-left:50px">Total Wrong Answer :'.$wrong_answer.'</h4>
                                                <h4 style="padding:10px;padding-left:50px">Total Attempt Question :'.$attempt_question.'</h4>
                                                <h4 style="padding:10px;padding-left:50px">Total UnAttempt Question :'.$unattempt_answer.'</h4>';
                                                
                                                if($bonus_count >0){
                                                $dis .= '<h4 style="padding:10px;padding-left:50px">Total Bonus Question :'.$bonus_count.'</h4>'; 
                                                }
                                                
                                                
                                                $dis .= '
                                                    
                                                </div>
                                                 
                                                </div>
                                                
                                            
                                                

                                                
                                                ';
                                                
                                                
                                                 $exam_sql = "select * from tbl_examinations where exam_id='$exam_id'";
                                               $result_exam = $conn->query($exam_sql);
                                               
                                               $exam_row = $result_exam->fetch_assoc();
                                               
                                               if($exam_row['section_name'] != ""){
                                                   $dis .= '<h3 style="text-align:center">Section Wise Marks</h3>';
                                                    $sec=explode('/', $exam_row['section_name']);
                                                        $i=0;
                                                       
                                                            foreach($sec as $out) {
                                                                                                     
                                                            if(!empty($out)){

                                                            $dis .= '<button id="Section_name'.$i.'" type="button" onclick="Sectionchange('.$i.')" style="margin:5px;">'.$out.'</button>';
                                                                $i++;
                                                              
                                                            }
                                                                                    
                                                                                            
                                                        }
                                                         $dis .= '<input type="hidden" id="total-section" value="'.$i.'">';
                                                        
                                                         $section_total_marks = [];

                                          
                                                        $section_correct_answer=[];
                                                        $section_wrong_answer = [];
                                                        $section_unattempt_answer = [];
                                                        $section_attempt_answer=[];
                                                        $section_count = [];
                                                        $j=0;
                                                        $bonus_count = [];
                                                        
                                                        
                                                        foreach($sec as $out1) {
                                                                                                     
                                                            if(!empty($out1)){
                                                                 $sql2 = "select * from tbl_responses where stu_id='$stu_id' and exam_id='$exam_id' ";

                                                            $result2 = $conn->query($sql2);
                                                           
                                            
                                                        $section_total_marks[$j] =0;

                                          
                                                        $section_correct_answer[$j] =0;
                                                        $section_wrong_answer[$j] =0;
                                                        $section_unattempt_answer[$j] =0;
                                                        $section_attempt_answer[$j] =0;
                                                        $section_count[$j] =0;
                                                        $bonus_count[$j] =0;
                                                        
                                           


                                            while($row1 = $result2->fetch_assoc()){
                                               
                                               
                                                $question_id = $row1['question_id'];
                                                $stu_response = $row1['stu_response'];
                                                $sql1 = "select * from tbl_questions where question_id = '$question_id' and exam_id ='$exam_id' and sec_name='$out1'";

                                                $result1 = $conn->query($sql1);
                                                
                                                
                                                $sql_question = "select * from tbl_questions where exam_id='$exam_id' and sec_name='$out1'";
                                                $result_question = $conn->query($sql_question);
                                                $count = $result_question->num_rows;
                                                
                                                $arr = $result1->fetch_assoc();
                                                
                                                $answer = $arr['answer'];
                                                $answer_val = $arr[$answer];
                                                $type = $arr['type'];
                                                $pmarks = $arr['pos_marks'];
                                                $nmarks = $arr['neg_marks'];
                                                $question_type=$arr['question_type'];
                                                  $bonus_question = $arr['bonus'];
                                                $par_total=0;
                                          

                                              if($question_type == "MTQ"){
                                                     if($bonus_question == 1){
                                                         if($answer_option == "" and $row['stu_response'] == ""){
                                                  
                                                            $section_unattempt_answer[$j]++;
                                     
                                                    }
                                                             $section_total_marks[$j] = $section_total_marks[$j]+$pmarks;
                                                       $bonus_count[$j]++;
                                                  }else if($bonus_question ==0){
                                                      $par_status = $arr['par_status'];
                                                      if($par_status ==1){
                                                          /// partial marking
                                                          $answer_option = $row1['mul_response'];
                                                          if($answer == $answer_option){
                                                               $section_total_marks[$j] += $pmarks;
                                                                $section_correct_answer[$j]++;
                                                          }else if($answer_option == "" and $row['stu_response'] == "" ){
                                                                 $section_unattempt_answer[$j]++;
                                                          }
                                                          else{
                                                              $flag_sec = 0;
                                                              for($i=1;$i<5;$i++){
                                                         if(strpos($answer,'option'.$i)  !== false){
                                                             if(strpos($answer_option,'option'.$i)  !== false){
                                                                $par_total+= 1;
                                                                }
                                                         }else if(strpos($answer_option,'option'.$i)  !== false){
                                                                 $section_total_marks[$j] += $nmarks;
                                                                  $section_wrong_answer[$j]++;
                                                                  $flag=1;
                                                                  break;
                                                                }
                                                           
                                                        } 
                                                        if($flag==0){
                                                         $section_total_marks[$j] += $par_total;
                                                         $section_correct_answer[$j]++;
                                                        }
                                                       
                                                              
                                                          }
                                                          
                                                          
                                                          
                                                   
                                                          
                                                          
                                                          
                                                          
                                                      }else{
                                                      
                                                      
                                                      
                                                      
                                                      
                                                      
                                                $answer_option = $row1['mul_response'];
                                                   if($answer == $answer_option){
                                                      $section_total_marks[$j] += $pmarks;
                                                      $section_correct_answer[$j]++;
                                                   }
                                                   else if($answer_option == "" and $row['stu_response'] == ""){
                                                    $section_total_marks[$j] = $section_total_marks[$j];
                                                    $section_unattempt_answer[$j]++;
                                     
                                                    }
                                                   else{
                                                      $section_total_marks[$j] += $nmarks;
                                                      $section_wrong_answer[$j]++;
                                                   }
                                                  }
                                                  }
                                                  
                                          
                                             }else if($question_type == "FQ"){
                                                    if($bonus_question == 1){
                                                         if($stu_response == ""){
                                                
                                                     $section_unattempt_answer[$j]++;

                                                }
                                                             $section_total_marks[$j] = $section_total_marks[$j]+$pmarks;
                                                       $bonus_count[$j]++;
                                                  }else if($bonus_question ==0){
                                                      if(!empty($stu_response)){
                                                          $end_range = explode("-",$answer);
                                                               if($end_range[0] != "" and $end_range[1] != ""){
                                                                   if($stu_response>=$end_range[0] and $end_range[1]>=$stu_response){
                                                                         $section_total_marks[$j] = $section_total_marks[$j]+$pmarks;
                                                    $section_correct_answer[$j]++; 
                                                                      }
                                                               
                                                               }else{
                                                                    if(strtolower($stu_response) == strtolower($answer)){
                                                                 $section_total_marks[$j] = $section_total_marks[$j]+$pmarks;
                                                    $section_correct_answer[$j]++;
                                                                  }
                                                               }
                                                        }
                                                //   if(strtolower($stu_response) == strtolower($answer)){
                                                //     $section_total_marks[$j] = $section_total_marks[$j]+$pmarks;
                                                //     $section_correct_answer[$j]++;
                                                // }
                                                else if($stu_response == ""){
                                                    $section_total_marks[$j] = $section_total_marks[$j];
                                                     $section_unattempt_answer[$j]++;

                                                }
                                                else{
                                                    $section_total_marks[$j] = $section_total_marks[$j]+$nmarks;
                                                    $section_wrong_answer[$j]++;
                                                }
                                                  }
                                                 
                                                 
                                             }else if($question_type == "TQ"){
                                                    if($bonus_question == 1){
                                                         if($stu_response == ""){
                                                  
                                                   
                                                     $section_unattempt_answer[$j]++;

                                                }
                                                             $section_total_marks[$j] = $section_total_marks[$j]+$pmarks;
                                                       $bonus_count[$j]++;
                                                  }else if($bonus_question ==0){
                                                 $arr = ['true','false'];
                                                 for($i=1;$i<=2;$i++){
                                                     if($answer == "option".$i ){
                                                         $mainanswer = $arr[$i-1];
                                                     }
                                                 }
                                                 if($stu_response == $mainanswer){
                                                    $section_total_marks[$j] = $section_total_marks[$j]+$pmarks;
                                                    $section_correct_answer[$j]++;
                                                }else if($stu_response == ""){
                                                    $section_total_marks[$j] = $section_total_marks[$j];
                                                   
                                                     $section_unattempt_answer[$j]++;

                                                }
                                                else {
                                                    $section_total_marks[$j] = $section_total_marks[$j]+$nmarks;
                                                    $section_wrong_answer[$j]++;
                                                }
                                                  }
                                                 
                                             }
                                             
                                             
                                             
                                             
                                             else if($question_type== 'STQ'){
                                                    if($bonus_question == 1){
                                                        if($stu_response == ""){
                                                 
                                                   
                                                     $section_unattempt_answer[$j]++;

                                                }
                                                        $section_total_marks[$j] = $section_total_marks[$j]+$pmarks;
                                                       $bonus_count[$j]++;
                                                  }else if($bonus_question ==0){
                                                if($stu_response == $answer_val){
                                                    $section_total_marks[$j] = $section_total_marks[$j]+$pmarks;
                                                    $section_correct_answer[$j]++;
                                                }else if($stu_response == ""){
                                                    $section_total_marks[$j] = $section_total_marks[$j];
                                                   
                                                     $section_unattempt_answer[$j]++;

                                                }
                                                else{
                                                    $section_total_marks[$j] = $section_total_marks[$j]+$nmarks;
                                                    $section_wrong_answer[$j]++;
                                                }
                                                  
                                            }
                                             }
                                               
                                               $section_count[$j] = $count; 
                                                
                                            }
                                            
                                             
                                          
                                            $section_attempt_answer[$j] = $section_count[$j]-($section_unattempt_answer[$j]);
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
    
                                                            $dis .= '<div  id="Section'.$j.'" style="';
                                                            
                                                            if($j==0){
                                                                $dis.= 'display:block';
                                                            }else{
                                                                $dis.='display:none';
                                                            }
                                                            
                                                            $dis .='">
                                                                
                                                            <h4>Total Marks Obtained in '.$out.' : '.$section_total_marks[$j].'</h4>
                                                            <h4>Total Corrent Questions in '.$out.' : '.$section_correct_answer[$j].'</h4>
                                                            <h4>Total Wrong Questions in '.$out.' : '.$section_wrong_answer[$j].'</h4>
                                                            <h4>Total Attempt Question in '.$out.' : '.$section_attempt_answer[$j].'</h4>
                                                            <h4>Total UnAttempt Question in '.$out.' : '.($section_unattempt_answer[$j]).'</h4> ';
                                                            
                                                            if($bonus_count>0){
                                                                $dis .= ' <h4>Total Bonus Question in '.$out.' : '.$bonus_count[$j].'</h4>';
                                                            }
                                                            
                                                            
                                                            $dis .= '
                                                                           
                                                                     
                                                                            
                                                          
                                                            </div>';
                                                          
                                                               $j++;  
                                                            }
                                                                              
                                                                                            
                                                        }
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                               }
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                

                                                $dis .= '</div>';
                                                echo $dis;





                                           

                                           }



										   
										   ?>
                                            
                                        
                                    </div>
                                </div>  
  
                            </div>
                        </div>


                        </div>
                    </div>
                </div>
                
            </div>
        </main>
		<?php if ($ms == "1") {
?> <div class="alert alert-success" id="snackbar"><?php echo "$description"; ?></div> <?php	
}else{
	
}
?>

        <div class="cd-overlay"></div>

        <script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="../assets/plugins/pace-master/pace.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="../assets/plugins/waves/waves.min.js"></script>
        <script src="../assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="../assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="../assets/plugins/moment/moment.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="../assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="../assets/js/modern.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
		<script src="../assets/plugins/select2/js/select2.min.js"></script>


		<script>
		
		function Sectionchange(data){
		    var total = document.querySelector('#total-section').value;
		  
		    for(i=0;i<total;i++){
		       
		        if(i==data){
		           document.querySelector('#Section'+data).style.display="block";
		        }else{
		             document.querySelector('#Section'+i).style.display="none";
		        }
		    }
		    
		    
		    
		    
		}
		
		
		
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>

    </body>

</html>