<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';

if (isset($_GET['eid'])) {
include '../database/config.php';
$exam_id = $_GET['eid'];
$sql = "SELECT * FROM tbl_assessment_records WHERE exam_id = '$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $exam_name = $row['exam_name'];
    }
} else {

}
$conn->close();
	
}else{
	
header("location:./index");	
}
?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Trando | <?php echo "$exam_name" ?> Results</title>
        
        <?php include('header.php')?>
                    <ul class="menu accordion-menu">
                        <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Streams</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Classes</p></a></li>
                        <!--<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <!--<li><a href="liveclass.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Live Class</p></a></li>-->
                        <li ><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!--<li ><a href="assignment.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Assignments</p></a></li>-->
                        <!--<li ><a href="material.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Notes</p></p></a></li>-->
                        <li ><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <!--<li><a href="doubts.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Doubts</p></a></li>-->
                        <li class="active"><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>

                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3><?php echo "$exam_name" ?>Results</h3>



                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
						<div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-white">
                                    <div class="panel-body">
                                                        <div class="table-responsive">
										   <?php
										   include '../database/config.php';
										 $sql = "SELECT * FROM tbl_assessment_records WHERE exam_id = '$exam_id' order by score desc";
                                           $result = $conn->query($sql);

                                           if ($result->num_rows > 0) {
										print '
										<table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Student Name</th>
												<th>Student ID</th>
											
                                                <th>Score</th>
                                                    <th>Submission Type</th>
                                                <th>Correct Answers</th>
                                                <th>Wrong Answer</th>
                                                <th>attempt Question</th>
                                                <th>Unattempt Question</th>
                                                <th>Status</th>
												<th>Date</th>
											
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Student Name</th>
												<th>Student ID</th>
											 <th>Submission Type</th>
                                                <th>Score</th>
                                                <th>Correct Answers</th>
                                                <th>Wrong Answer</th>
                                                <th>attempt Question</th>
                                                <th>Unattempt Question</th>
                                                <th>Status</th>
												<th>Date</th>
											
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>';
                                            $sno=1;
     
                                           while($row = $result->fetch_assoc()) {
                                            $stu_id =$row['student_id'];
                                            $exam_id = $row['exam_id'];
                                            
                                            $remaining_time = $row['end_time'];
                                            
                                            
                                            if($row['submission_type'] == "SUCCESS"){
                                                $submission_type = "success";
                                            }else if($row['submission_type'] == "OUT_SUBMISSION"){
                                                    $submission_type = "nofullscreensubmission";
                                            }else if($row['submission_type'] == "AUTO_OUT_SUBMISSION"){
                                                    $submission_type = "autosubmissionccheating";
                                            }else if($row['submission_type'] == "AUTO_SUBMISSION"){
                                                    $submission_type = "autosubmission";
                                            }else if($row['submission_type'] == "Window Close"){
                                                    $submission_type = $row['submission_type'];
                                            }
                                            else if($submission_type == NULL){
                                              $submission_type = "Online"; 
                                            }
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            

                                           
                                                $sql2 = "select * from tbl_responses where stu_id='$stu_id' and exam_id='$exam_id'";

                                                    $result2 = $conn->query($sql2);
                                                    
                                                     $sqlctf = "select * from tbl_examinations where exam_id='$exam_id'";
                                                    $resultctf = $conn->query($sqlctf);
                                                    $rowctf=$resultctf->fetch_assoc();
                                                    
                                                    
                                                    $count = $result2->num_rows;
                                                    
                                                    $total_marks = 0;

                                                  
                                                    $correct_answer=0;
                                                    $wrong_answer = 0;
                                                    $unattempt_answer = 0;


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

                                                        $question_type = $arr['question_type'];
                                                       
                                                         $bonus_question = $arr['bonus'];
                                                       
                                                 
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
                                                          }else if($answer_option == "" and $row['stu_response']==""){
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
                                                  }else if($bonus_question == 0){
                                                      
                                                     
                                                        
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
                                                        //       if(strtolower($stu_response) == strtolower($answer)){
                                                        //     $total_marks = $total_marks+$pmarks;
                                                        //     $correct_answer++;
                                                        // }else 
                                                        else if($stu_response == ""){
                                                            $total_marks = $total_marks;
                                                           
                                                            $unattempt_answer++;

                                                        }
                                                        else{
                                                            $total_marks = $total_marks+$nmarks;
                                                            $wrong_answer++;
                                                        }
                                                  } 
                                                         }
                                                         else if($question_type == "TQ"){
                                                               if($bonus_question == 1){
                                                         if($stu_response == ""){
                                                        
                                                            $unattempt_answer++;

                                                        }
                                                       $total_marks += $pmarks;
                                                       $bonus_count++;
                                                  }else if($bonus_question ==0){
                                                             $arr = ['true','false'];
                                                             for($i=1;$i<=2;$i++){
                                                                 if($answer == "option".$i){
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
                                                        else{
                                                            $total_marks = $total_marks+$nmarks;
                                                            $wrong_answer++;
                                                        }
                                                  }   
                                                         }
                                                         
                                                         else if($question_type == "STQ"){
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
                                                    }}
                                                        
                                                        }
                                                    $attempt_question = $count-$unattempt_answer;


                                                    print '
                                                    <tr>
                                                     <td>'.$sno.'</td>
                                                     <td>'.$row['student_name'].'</td>
                                                     <td>'.$row['student_id'].'</td>
                                                     <td><b>'.$total_marks.'</b></td>
                                                      <td><b>'.$submission_type.'</b></td>
                                                     <td><b>'.$correct_answer.'</b></td>
                                                     <td><b>'.$wrong_answer.'</b></td>
                                                     <td><b>'.$attempt_question.'</b></td>
                                                     <td><b>'.$unattempt_answer.'</b></td>
                                                     <td>';
                                                     
                                                     if($total_marks>=$rowctf['cutoff_marks']){
                                                         echo 'Good';
                                                     }else{
                                                         echo 'Below Cutoff';
                                                     }
                                                     
                                                     print'</td>
                                                     <td>'.$row['date'].'</td>
                                               
                                                     <td><div class="btn-group" role="group">
                                                     <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                         Select Action
                                                         <span class="caret"></span>
                                                     </button>
                                                     <ul class="dropdown-menu" role="menu">
                                                         <li><a href="question-result.php?sid='.$row['student_id'].'&eid='.$row['exam_id'].'">View Responses</a></li>
                                                         <li><a href="student-result.php?sid='.$row['student_id'].'&eid='.$row['exam_id'].'">View Result</a></li>
                                                       
                                                         <li><a'; ?> onclick = "return confirm('Reactivate exam for <?php echo $row['student_name']; ?> ?')" <?php print ' href="pages/re-activate.php?rid='.$row['record_id'].'&eid='.$exam_id.'">Re-activate</a></li>';
                                                         
                                                         
                                                         
                                                         $sql_id_check = "select * from outexams where id='$stu_id' and exam_id='$exam_id'";
                                                         
                                                         $result_id = $conn->query($sql_id_check);
                                                         
                                                         if($result_id->num_rows>0){
                                                             
                                                         }else{
                                                     
                                                         if($rowctf['Restrict_time'] == "Non Restricted"){
                                                             
                                                             $current_date = date("Y-m-d");
                                                             $deadline = date("Y-m-d",strtotime($rowctf['date']));
                                                             
                                                             if($current_date<=$deadline){
                                                             
                                                            if($row['end_time'] > 0){
                                                                 print ' <li><a'; ?> onclick = "return confirm('Resume the  exam for <?php echo $row['student_name']; ?> ?')" <?php print ' href="pages/resume-exam.php?rid='.$row['record_id'].'&eid='.$exam_id.'">Resume Exam</a></li>';
                                                             }
                                                             }
                                                         }else if($rowctf['Restrict_time'] == "Retricted"){
                                                             
                                                               $current_date = date("Y-m-d");
                                                             $deadline = date("Y-m-d",strtotime($rowctf['edate']));
                                                             
                                                             if($current_date<=$deadline){
                                                                 
                                                                 $current_time = date("H:i:s");
                                                                 
                                                                 $endTime = date("H:i:s", strtotime($rowctf['edate'])+($rowctf['duration']*60));
                                                               
                                                               if($current_date <= $endTime){
                                                                    //  if($row['end_time'] > 0){
                                                                 print ' <li><a'; ?> onclick = "return confirm('Resume the  exam for <?php echo $row['student_name']; ?> ?')" <?php print ' href="pages/resume-exam.php?rid='.$row['record_id'].'&eid='.$exam_id.'">Resume Exam</a></li>';
                                                            //  }
                                                               }
                                                                 
                                                             
                                                          
                                                             }
                                                             
                                                             
                                                             
                                                             
                                                         }
                                                         
                                                         }
                                                         
                                                         
                                                         
                                                         
                                                         
                                                         
                                                         print'</ul>
                                                 </div></td>
               
                                                 </tr>';
                                                $sno++;


                                            $submission_type='';
                                         
                                           }
										   
										   print '
									   </tbody>
                                       </table>  ';
                                            } else {
											print '
												<div class="alert alert-info" role="alert">
                                        Nothing was found in database.
                                    </div>';
    
                                           }
                                           $conn->close();
										   
										   ?>

<!--<form method="post" action="excel/student_result_exam.php?exam_id=<?php echo $exam_id; ?>">-->
<!--     <input type="submit" name="export" class="btn btn-success" style="float: right;" value="Download result Yah Abhi Work nhi kr raha hai" />-->
<!--    </form> -->

                 

                                    </div>
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
        <script src="../assets/plugins/summernote-master/summernote.min.js"></script>
        <script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="../assets/js/pages/form-elements.js"></script>
		

		<script>
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>