<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
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
                                           <div class="table-responsive">
										   <?php
										   include '../database/config.php';
										   $sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$stu_id'";
                                           $result = $conn->query($sql);

                                       if ($result->num_rows > 0) {
                                               
										print '
										<table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>  
                                                <th>Rank</th>
                                                <th>Exam</th>
										
												<th>Score</th>
												<th>Date</th>
                                                <th>Next Retake</th>
                                                <th>Select Action</th>
                            
                                   
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>Rank</th>
                                                <th>Exam</th>
											
												<th>Score</th>
												<th>Date</th>
                                                <th>Next Retake</th>
                                                <th>Select Action</th>
                                            
                
                                            </tr>
                                        </tfoot>
                                        <tbody>';
                                        $sno=1;
     
                                            while($row = $result->fetch_assoc()) {
                                              
                                               $exam_id = $row['exam_id'];
                                            
                                              $score_user =$row['score'];
                                              $rank_sql = "select * from tbl_assessment_records where exam_id='$exam_id'";
                                               
                                              $rank_result =$conn->query($rank_sql);
                                              $rank = $rank_result->num_rows;
                                               
                                              while($rank_row = $rank_result->fetch_assoc()){
                                                  if($score_user>$rank_row['score']){
                                                      $rank--;
                                                  }
                                              }

                                                $check_sql = "select * from tbl_examinations where  exam_id='$exam_id' and user_id='$login_stu_teacher_id' and category='$mycategory'";

                                                $result_sql =$conn->query($check_sql);
                                                $arr_sql = $result_sql->fetch_assoc();
                                                
                                                
                                                  if($result_sql->num_rows>0){
                                                
                                                $result_type = $arr_sql['result_type'];
                                              
                                                
                                                $result_status = $arr_sql['result_status'];
                                                
                                                
                                             
                                                
                                                
                                                /// code for score
                                            
                                           
                                                
                                                
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
                                           
                                                
                                            
                                                
                                             
                                                
                                               
                                               
                                              if($result_sql->num_rows>0){
                                           
                                           
                                           
                                            if($arr_sql['add_class'] == "" and $arr_sql['category'] == $mycategory){
                                          print '<tr>
                                            
										       <td>'.$rank.'</td>
                                                <td>'.$row['exam_name'].'</td>
											
												<td>'.$total_marks.'</td>
                                                <td>'.$row['date'].'</td>
                                                <td>'.$row['next_retake'].'</td> 
                                                <td><div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    Select Action
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                 
                                                    <li><a href="show-result.php?stu_id='.$row['student_id'].'& exam_id='.$row['exam_id'].'">Show result</a></li>';
                                                    if($result_status == 1){
                                                
                                                    print '
                                                     <li><a href="show-question-result.php?stu_id='.$row['student_id'].'& exam_id='.$row['exam_id'].'">Show Responses</a></li>';
                                                    
                                                    
                                                     }else if($result_status == 0){
                                                         
                                                 
                                                         if($result_type == "automation"){
                                                             
                                                                date_default_timezone_set('Asia/Kolkata');

                                                                $sql_time = "select * from tbl_examinations where exam_id='$exam_id' and status='Active'";
                                                                $result_time = $conn->query($sql_time);
                                                                $arr_time = $result_time->fetch_assoc();
                                                                
                                                                $exam_time = date("H:i:s",strtotime($arr_time['edate']));
                                                                $duration = $arr_time["duration"];
                                                                
                                                                $endTime = strtotime(date("H:i:s", strtotime($arr_time['edate'])+($duration*60)));
                                                                
                                                                $current_time = strtotime(date("H:i:s"));
                                                                
                                                                
                                                                $exam_date = date("Y-m-d",strtotime($arr_time['edate']));
                                                                $current_date = date("Y-m-d");
                                                                
                                                                
                                                                $mins = (int)(($endTime - $current_time) / 60);
                                                                
                                                                if($current_date == $exam_date){
                                                                
                                                                    if($mins < 0){
                                                                        print '
                                                                    <li><a href="show-question-result.php?stu_id='.$row['student_id'].'& exam_id='.$row['exam_id'].'">Show Responses</a></li>';
                                                                    }
                                                                    }else if($current_date > $exam_date){
                                                                      print '
                                                                    <li><a href="show-question-result.php?stu_id='.$row['student_id'].'& exam_id='.$row['exam_id'].'">Show Responses</a></li>';
                                                                }
                                                             
                                                                    
                                                                }
                                                             
                                                        
                                                        }else{
                                                            print '
                                                     <li><a href="unauthorised.php">Show Responses</a></li>';
                                                    
                                                         
                                                     }print '
                                                </ul>
                                            </div></td>      
										
          
                                            </tr>';
                                           
                                            }
            else if($arr_sql['add_class'] != '' and (strpos($arr_sql['add_class'],$mycategory)  !== false or $arr_sql['category'] == $mycategory)){
                                                
                                               
                                              print '
										       <tr>
										  
										       <td>'.$rank.'</td>
                                                <td>'.$row['exam_name'].'</td>
												<td>'.$total_marks.'</td>
                                                <td>'.$row['date'].'</td>
                                                <td>'.$row['next_retake'].'</td> 
                                                <td><div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    Select Action
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                 
                                                    <li><a href="show-result.php?stu_id='.$row['student_id'].'& exam_id='.$row['exam_id'].'">Show result</a></li>';
                                                    if($result_status == 1){
                                                
                                                    print '
                                                     <li><a href="show-question-result.php?stu_id='.$row['student_id'].'& exam_id='.$row['exam_id'].'">Show Responses</a></li>';
                                                    
                                                    
                                                     }else if($result_status == 0){
                                                     
                                                         
                                                         if($result_type == "automation"){
                                                          
                                                                date_default_timezone_set('Asia/Kolkata');

                                                                $sql_time1 = "select * from tbl_examinations where exam_id='$exam_id' and status='Active'";
                                                                $result_time1 = $conn->query($sql_time1);
                                                                $arr_time1 = $result_time1->fetch_assoc();
                                                                
                                                                $exam_time1 = date("H:i:s",strtotime($arr_time1['edate']));
                                                                $duration1 = $arr_time1["duration"];
                                                                
                                                                $endTime1 = strtotime(date("H:i:s", strtotime($arr_time1['edate'])+($duration1*60)));
                                                                
                                                                $current_time1 = strtotime(date("H:i:s"));
                                                                
                                                                
                                                                $exam_date1 = date("Y-m-d",strtotime($arr_time1['edate']));
                                                                $current_date1 = date("Y-m-d");
                                                                
                                                                
                                                                $mins1 = (int)(($endTime1 - $current_time1) / 60);
                                                                
                                                                if($current_date1 == $exam_date1){
                                                                
                                                                    if($mins1 < 0){
                                                                        print '
                                                                    <li><a href="show-question-result.php?stu_id='.$row['student_id'].'& exam_id='.$row['exam_id'].'">Show Responses</a></li>';
                                                                    }
                                                                    
                                                                }else if($current_date1 > $exam_date1){
                                                                      print '
                                                                    <li><a href="show-question-result.php?stu_id='.$row['student_id'].'& exam_id='.$row['exam_id'].'">Show Responses</a></li>';
                                                                }
                                                             
                                                        
                                                        }else{
                                                            print '
                                                     <li><a href="unauthorised.php">Show Responses</a></li>';
                                                    }
                                                         
                                                     }print '
                                                </ul>
                                            </div></td>      
										
          
                                            </tr>';
                                          
                                                
                                                
                                                
                                                
                                            }
                                            
                                          }
                                           $sno++;
                                                  
                                            }
                                        
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
		

		<script>
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>