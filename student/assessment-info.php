<?php include 'includes/check_user.php';
include '../database/config.php';

if (isset($_SESSION['record_id'])) {
$record_id = $_SESSION['record_id'];


$sql = "SELECT * FROM tbl_assessment_records WHERE record_id = '$record_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
    $exam_name = $row['exam_name'];
	$score = $row['score'];
	$status = $row['status'];
	$next_retake = $row['next_retake'];
    $taking_date = $row['date'];
    $exam_id = $row['exam_id'];
    }
} else {
    header("location:./index");
}



    $sql1 = "select * from tbl_assessment_records where  exam_id='$exam_id'";

    $result1 = $conn->query($sql1);
    $total_student = $result1->num_rows;
                                                    
                                            
                                                 
     $total_student_less_score = 0;

    while($row1 = $result1->fetch_assoc()){
         if($score <= $row1['score']){
             $total_student_less_score++;
         }
    }

                                                  

     $percentile = (100*$total_student_less_score)/$total_student;


}else{
	
header("location:./index");	
}



//marks code

  $sql2 = "select * from tbl_responses where stu_id='$stu_id' and exam_id='$exam_id'";

                                            $result2 = $conn->query($sql2);
                                            $count = $result2->num_rows;
                                            
                                            $total_marks = 0;

                                          
                                            $correct_answer=0;
                                            $wrong_answer = 0;
                                            $unattempt_answer = 0;


                                            while($row1 = $result2->fetch_assoc()){
                                               
                                               
                                                $question_id = $row1['question_id'];
                                                $stu_response = $row1['stu_response'];
                                                $sql1 = "select * from tbl_questions where question_id='$question_id' and exam_id ='$exam_id'";

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
                                           

                                              if($question_type == "MTQ"){
                                                  if($bonus_question == 1){
                                                       $total_marks += $pmarks;
                                                  }else if($bonus_question ==0){
                                                       $par_status = $arr['par_status'];
                                                      if($par_status ==1){
                                                          /// partial marking
                                                          $answer_option = $row1['mul_response'];
                                                          if($answer == $answer_option){
                                                               $total_marks += $pmarks;
                                                                
                                                          }else{
                                                              $flag =0 ;
                                                              for($i=1;$i<5;$i++){
                                                         if(strpos($answer,'option'.$i)  !== false){
                                                             if(strpos($answer_option,'option'.$i)  !== false){
                                                                     $par_total+= 1;
                                                                }
                                                         }else if(strpos($answer_option,'option'.$i)  !== false){
                                                               $total_marks += $nmarks;
                                                            
                                                                $flag =1;
                                                                break;
                                                                }
                                                           
                                                        } 
                                                        if($flag == 0){
                                                          $total_marks += $par_total;
                                                     
                                                        }
                                                              
                                                          }
                                                          
                                                          
                                                          
                                                   
                                                          
                                                          
                                                          
                                                          
                                                      }else{
                                                    $answer_option = $row1['mul_response'];
                                                  if($answer == $answer_option){
                                                      $total_marks += $pmarks;
                                                    
                                                  }
                                                  else if($answer_option == "" and $row['stu_response'] == ""){
                                                    $total_marks = $total_marks;
                                                   
                                     
                                                    }
                                                  else{
                                                      $total_marks += $nmarks;
                                                   
                                                  }
                                                  }
                                                  }
                                          
                                             }else if($question_type == "FQ"){
                                                  if($bonus_question == 1){
                                                       $total_marks += $pmarks;
                                                  }else if($bonus_question ==0){
                                                        if(!empty($stu_response)){
                                                          $end_range = explode("-",$answer);
                                                               if($end_range[0] != "" and $end_range[1] != ""){
                                                                   if($stu_response>=$end_range[0] and $end_range[1]>=$stu_response){
                                                                           $total_marks = $total_marks+$pmarks; 
                                                                      }
                                                               
                                                               }else{
                                                                    if(strtolower($stu_response) == strtolower($answer)){
                                                                   $total_marks = $total_marks+$pmarks;
                                                                  }
                                                               }
                                                        }
                                                 
                                                //   if(strtolower($stu_response) == strtolower($answer)){
                                                //     $total_marks = $total_marks+$pmarks;
                                               
                                                // }
                                                else if($stu_response == ""){
                                                    $total_marks = $total_marks;
                                                  

                                                }
                                                else{
                                                    $total_marks = $total_marks+$nmarks;
                                                  
                                                }
                                                  }
                                                 
                                             }else if($question_type == "TQ"){
                                                  if($bonus_question == 1){
                                                       $total_marks += $pmarks;
                                                  }else if($bonus_question ==0){
                                                 $arr = ['true','false'];
                                                 for($i=1;$i<=2;$i++){
                                                     if($answer == "option".$i ){
                                                         $mainanswer = $arr[$i-1];
                                                     }
                                                 }
                                                 if($stu_response == $mainanswer){
                                                    $total_marks = $total_marks+$pmarks;
                                                  
                                                }else if($stu_response == ""){
                                                    $total_marks = $total_marks;
                                                   
                                                  

                                                }
                                                else {
                                                    $total_marks = $total_marks+$nmarks;
                                                
                                                }
                                                  }
                                                 
                                             }
                                             
                                             
                                             
                                             
                                             else if($question_type== 'STQ'){
                                                  if($bonus_question == 1){
                                                       $total_marks += $pmarks;
                                                  }else if($bonus_question ==0){
                                                if($stu_response == $answer_val){
                                                    $total_marks = $total_marks+$pmarks;
                                                 
                                                }else if($stu_response == ""){
                                                    $total_marks = $total_marks;
                                                   
                                                 

                                                }
                                                else{
                                                    $total_marks = $total_marks+$nmarks;
                                                  
                                                }
                                            }
                                           
                                        }
                                              

                                        }









?>
<!DOCTYPE html>
<html>
    
<head>
        
        <title>Kendel | Take Assessment</title>
        
      <?php include 'header.php';?>
                    <!--<ul class="menu accordion-menu">-->
                    <!--    <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>-->
                    <!--    <li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                    <!--    <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>-->
                    <!--    <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>-->
                    <!--    <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>-->

                    <!--</ul>-->
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Assessment Results</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="./index">Home</a></li>
                            <li class="active"><?php echo "$exam_name"; ?></li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                          
                                <div class="row">
                           <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Results Information</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive project-stats">  
                                       <table class="table">
                                           </thead>
                                           <tbody>
                                               <tr>
                                                   <th scope="row">1</th>
                                                   <td>Exam Name</td>
                                                   <td><?php echo "$exam_name"; ?></td>
                                               </tr>
											     <tr>
                                                   <th scope="row">2</th>
                                                   <td>Student_name</td>
                                                   <td><?php echo "$myfname $mylname"; ?></td>
                                               </tr>
                                             
                                                <tr>
                                                   <th scope="row">3</th>
                                                   <td>Score</td>
                                                   <td>
                                                   <?php 
                                                
                                                   echo "$total_marks";
                                                    ?></td>
                                               </tr>
                                               <!--<tr>-->
                                               <!--    <th scope="row">4</th>-->
                                               <!--    <td>Percentile Score</td>-->
                                               <!--    
                                               <!--</tr>-->

											   
											  <tr>
                                                   <th scope="row">5</th>
                                                   <td>Next Re-take</td>
                                                   <td><?php echo "$next_retake";?></td>
                                               </tr>
                                           
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
   
                                </div>
                           
                        </div>
						
                           <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Status</h3>
                                </div>
                                <div class="panel-body">
                                <?php
                                 if ($status == "PASS") {
								print '
                                <div class="alert alert-success" role="alert">
                                        Well done! You have pass this examination.
                                    </div>';								
								}else{
																print '
                                <div class="alert alert-danger" role="alert">
                                       You have fail to pass this examination.
                                    </div>';		
									
                                }
                               
                              
								
								?>
                                </div>
                            </div>
                        </div>
						
	
                    </div>

                </div>
                
            </div>
        </main>

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
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/jquery-counterup/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/toastr/toastr.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/metrojs/MetroJs.min.js"></script>
        <script src="../assets/js/modern.js"></script>

		<script src="../assets/js/canvasjs.min.js"></script>
		 

        
    </body>


</html>