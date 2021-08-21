<?php include 'includes/check_user.php';

include '../database/config.php';

$sql_checking = "select * from tbl_users where user_id = '$login_stu_teacher_id'";
$result_checking = $conn->query($sql_checking); 



$row_checking = $result_checking->fetch_assoc();


if($row_checking['coins'] <=  0){
    header('location:examinations.php?e=pe&rp=402');
}




if (isset($_GET['id'])) {
    
	
$exam_id = mysqli_real_escape_string($conn, $_GET['id']);
$record_found = 0;
$sql = "SELECT * FROM tbl_examinations WHERE exam_id = '$exam_id'";
$result = $conn->query($sql);
date_default_timezone_set('Asia/Kolkata');
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      
      if($row['Restrict_time'] == "Restricted"){  
    $msg = '';    
    //code if exam is over
    
   
    
    $exam_time = date("H:i:s",strtotime($row['edate']));
    $duration = $row["duration"];
    
    $endTime = strtotime(date("H:i:s", strtotime($row['edate'])+($duration*60)));
    
    $current_time = strtotime(date("H:i:s"));
    
    
    $exam_date = date("Y-m-d",strtotime($row['edate']));
    $current_date = date("Y-m-d");
    
    
    $mins = (int)(($endTime - $current_time) / 60);
    
   
    
    if($current_date >= $exam_date){
    if($mins <= 0){
        $msg ='<button type="button" class="btn btn-danger btn-lg"   disabled>Exam Over</button>';
    }

    }
    
    
    
      }    
        
    $restrict_type = $row['Restrict_time'];
    $date_time=$row['edate'];
	$subject = $row['subject'];
	$exam_name = $row['exam_name'];
	$deadline = $row['date'];
	$duration = $row['duration'];
	$reexam = $row['re_exam'];
	$terms = $row['terms'];
	$status = $row['status'];
	$today_date = date('Y/m/d');
    $next_retake = date('m/d/Y', strtotime($today_date. ' + '.$reexam.' days'));
	$dcv = date_format(date_create_from_format('m/d/Y', $deadline), 'Y/m/d');
	$deadline_format = date("Y-m-d",strtotime($row['date']));

	if ($status == "Inactive") {
	header("location:./index");	
	}
    }
} else {
header("location:./index");	
}
$quest = 0;
$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $quest++;
    }
} else {

}

$sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$stu_id' AND exam_id = '$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $record_found = 1;
	$score = $row['score'];
	$status = $row['status'];
	$take_date = $row['date'];
	$retake_date = $row['next_retake'];
	$today_date = date('Y/m/d');
	$retakeconv = date_format(date_create_from_format('m/d/Y', $retake_date), 'Y/m/d');
    $tc = strtotime($today_date);
	$rc = strtotime($retakeconv);
	$dc = strtotime($dcv);
    $td = ($tc - $rc)/86400;
	$dcc = ($tc - $dc)/86400;
	
	$resume_status = $row['resume_status'];
	
    }
} else {
    
}


////code for total marks 


$sql1 = "select * from tbl_questions where exam_id='$exam_id'";

$result1 = $conn->query($sql1);
$total_marks_exam=0;

while($arr = $result1->fetch_assoc()){
    $total_marks_exam += $arr['pos_marks']; 
}




}else{

header("location:./index");	
}

 ?>
<!DOCTYPE html>
<html>
    
<head>
        
        <title>Trando | Take Assessment</title>
      
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
                    <h3>Take Assessment</h3>
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
                                    <h4 class="panel-title">Examination Properties</h4>
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
                                                   <th scope="row">3</th>
                                                   <td>Deadline</td>
                                                   <td><?php echo "$deadline"; ?></td>
                                               </tr>
											   
											    <tr>
                                                   <th scope="row">4</th>
                                                   <td>Duration</td>
                                                   <td><?php echo "$duration"; ?> <b>min.</b></td>
                                               </tr>
											   
											  <tr>
                                                   <th scope="row">5</th>
                                                   <td>Next Re-take</td>
                                                   <td><?php 
												   if ($record_found == "1") {
													 echo "$retake_date";  
												   }else{
													 echo "$next_retake";  
												   }
												   
												   ?></td>
                                               </tr>
											   
											   
											   	<tr>
                                                   <th scope="row">6</th>
                                                   <td>Questions</td>
                                                   <td><b><?php echo "$quest"; ?></b></td>
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
                                    <h3 class="panel-title">Terms and conditions</h3>
                                </div>
                                <div class="panel-body">
                                    <?php echo "$terms"; ?>
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Take Assessment</h3>
                                </div>
                                <div class="panel-body">
								<?php
								if ($record_found == "1") {
									
								if ($td >= 0){
									
								if ($dcc > 1){
								print '
								<div class="alert alert-warning" role="alert">
                                The exam is already expired.
                                </div>';
								}else{
								$_SESSION['current_examid'] = $exam_id;
								$_SESSION['student_retake'] = 1;
								print '
                                 <div class="alert alert-success" role="alert">
                                  You are good to go.
                                    </div>

									'; ?>
									     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Retake Assessment</button>
									<!--<a onclick="return confirm('Are you sure you want to begin ?')" class="btn btn-success" href="assessment.php">Retake Assessment</a>-->
									
									<?php	
								}
                                
								}else{
                               
                                
                                	if ($resume_status == 1){
                                	    	$_SESSION['current_examid'] = $exam_id;
            								$_SESSION['student_retake'] = 0;
                                        echo '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Resume Assessment</button>';
                                    }else{
                                         print '
								<div class="alert alert-warning" role="alert">
                                You will be able to retake this exam on '.$retake_date.'
                                </div>';
                                    }
                                
                                
								}								
									
								}else{
								$_SESSION['current_examid'] = $exam_id;
								$_SESSION['student_retake'] = 0;
								print '
                                 <div class="alert alert-success" role="alert">
                                  You are good to go.
                                    </div>

									'; ?>
									<!-- <a onclick="openmsg()" class="btn btn-success">Begin Assessment</a> -->
									<?php if($msg == ""){ 
									
																	?>
                                    <div class="text-center" id="timer_working">
                                         <h5>Time Remaining To Start Exam </h5>
                                         <span id="days"></span>
                                     <span id="hours"></span>
                                     <span id="min"></span>
                                     <span id="sec"></span>
                                    </div>
                                    <?php } 
                                  
                                    
                                    
                                    else { 
                                    
                                        echo $msg;
                                        
                                    }
                                    
                                    ?>
                                    
                                    
       
									<?php
                                    				
									
								}
								
								?>

                                



  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="max-width:100%">
    <div class="modal-dialog">
                                
      <!-- Modal content-->
      <div class="modal-content p-2" style="max-width:100%">
     
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h1 class="modal-title text-center">Instruction For Exam </h1>
        </div>
        <br>
        <div class="modal-body">
          <h4><b>1)</b> Please do not click on submit button until you don't want to submit exam, because if you will click on submit button your exam will be submit with filled options.
          </h4>
          <br>

          <h4><b>2)</b>Please do not refresh the page while you are giving exam, otherwise your exam will be submitted and result will be counted as 0 marks and You will not be able to give exam again.
          </h4>
          <h4><b>3)</b> Best Wishes For the Exam !
          </h4>
        </div>
        <div class="modal-footer">
            <a class="btn btn-danger" href="<?php
            
            if($resume_status == 1){
                echo "ResumeAssessmentPaper.php";
            }else{
                echo "AssessmentPaper.php";
            }
            
            
            ?>" >Continue</a>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  



									
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Assessment History</h3>
                                </div>
                                <div class="panel-body">
                                <?php
                              
                                $sql2 = "select * from tbl_examinations where exam_id='$exam_id' and result_type ='manual' and result_status=0";
                                $result2 = $conn->query($sql2);
                                if($result2->num_rows>0){
                                	print '
                                 <div class="alert alert-info" role="alert">
                                  Your Response will be decleared later
                                    </div>';

                                }   
                                
								else if ($record_found == "1") {
								    // marks code
								    
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
								    
								    
								    
								    
								    
								    
								    
								print '
                                 <div class="alert alert-info" role="alert">
                                  You attend this exam on <strong>'.$take_date.'</strong> , your score was <strong>'.$total_marks.'</strong> Out Of <strong>'.$total_marks_exam.'<strong>
                                    </div>';		
								
								}else{
								print '
                                 <div class="alert alert-info" role="alert">
                                  No records found.
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


            <script>
            	document.addEventListener("contextmenu", function(e){
                    e.preventDefault();
                }, false);
                
                	
	$(document).keydown(function (event) {
    if (event.keyCode == 123  || event.keyCode == 120 || event.keyCode == 121 || event.keyCode == 122) {
        return false;
    }
    else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
        return false;
    }
});
                
                
            
    // code for fetching how much time is remaining
    
    
    <?php
    
    if($msg == ""){
    
    ?>
    
   
   window.onload = function(){
     
      var countDownDate = new Date("<?php  echo $date_time; ?>").getTime();
      
      var examDowndate = new Date("<?php echo date("Y-m-d",strtotime($date_time)); ?>");
       var currentDowndate = new Date("<?php echo date("Y-m-d"); ?>");
       var Deadlinedate = new Date("<?php echo $deadline_format; ?>");
        var restrict_type = "<?php echo $restrict_type; ?>";
        
      var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
      
        // alert(distance);
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
       
        // Display the result in the element with id="demo" 
        if(examDowndate >= currentDowndate && restrict_type == "Restricted"){
        document.getElementById("days").innerHTML = days+ " D";
        document.getElementById("hours").innerHTML = hours+ " H";
        document.getElementById("min").innerHTML = minutes+ " M" ;
        document.getElementById("sec").innerHTML = seconds + " S";
      
        // If the count down is finished, write some text
        if (distance <= 0 ) {
          document.getElementById('timer_working').innerHTML=' <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Begin Assessment</button>';
          
            clearInterval(x);
        }
        }else if (currentDowndate >= examDowndate && restrict_type == "Non Restricted" ){
            
            if( Deadlinedate >= currentDowndate ) { 
          document.getElementById("days").innerHTML = days+ " D";
        document.getElementById("hours").innerHTML = hours+ " H";
        document.getElementById("min").innerHTML = minutes+ " M" ;
        document.getElementById("sec").innerHTML = seconds + " S";
      
        // If the count down is finished, write some text
        if (distance <= 0 ) {
          document.getElementById('timer_working').innerHTML=' <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Begin Assessment</button>';
          
            clearInterval(x);
        }
        }else {
             document.getElementById('timer_working').innerHTML='<button type="button" class="btn btn-danger btn-lg"   disabled>Exam Over</button>';
        }
            
        }
        else if(currentDowndate > examDowndate && restrict_type == "Restricted"){
            document.getElementById('timer_working').innerHTML='<button type="button" class="btn btn-danger btn-lg"   disabled>Exam Over</button>';
        }
        },1000);
        
        
        
        
        }
          
            
            <?php } ?>
            
            
            
        </script>
        
    </body>


</html>