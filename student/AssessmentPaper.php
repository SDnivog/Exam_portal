<?php 
date_default_timezone_set('Africa/Dar_es_salaam');
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../includes/uniques.php';
include '../database/config.php';


if (isset($_SESSION['current_examid'])){


$exam_id = $_SESSION['current_examid'];	
$retake_status = $_SESSION['student_retake'];


if ($retake_status == "1") {
    
$sql = "DELETE FROM tbl_assessment_records WHERE student_id = '$stu_id' AND exam_id = '$exam_id'";

if ($conn->query($sql) === TRUE) {
    
        $sql1 = "delete from tbl_responses where stu_id= '$stu_id' and exam_id='$exam_id'";
        
        $result1 = $conn->query($sql1);
        
    
    
    

} else {

}	
}


$sql = "SELECT * FROM tbl_examinations WHERE exam_id = '$exam_id'  AND status = 'Active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $exam_name =$row['exam_name'];
	$subject = $row['subject'];
	$deadline = $row['date'];
	$duration = $row['duration'];
	$passmark = $row['passmark'];
	$reexam = $row['re_exam'];
	$terms = $row['terms'];
	$status = $row['status'];
	$today_date = date('Y/m/d');
	$exam_date = $row['edate'];
    $next_retake = date('m/d/Y', strtotime($today_date. ' + '.$reexam.' days'));
	
	$today_date = date('m/d/Y');
	$Section = $row['section_name'];
	$restriction_check = $row['Restrict_time'];
	
	$no_exit_fullscreen = $row['no_exit'];
    }
} else {
header("location:./");	
}
}else{
header("location:./");	
}



$sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$stu_id' and exam_id='$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {


    while($row = $result->fetch_assoc()) {
        header("location:./take-assessment.php?id=$exam_id");
    }
} else {
$myname = "$myfname $mylname";
$recid = 'RS'.get_rand_numbers(14).'';

$sql = "INSERT INTO tbl_assessment_records (record_id, student_id, student_name, exam_name, exam_id, score, status, next_retake, date)
VALUES ('$recid', '$stu_id', '$myname', '$exam_name', '$exam_id', '0', 'FAIL', '$next_retake', '$today_date')";

if ($conn->query($sql) === TRUE) {
$sql_update = "select * from tbl_examinations where exam_id='$exam_id'";
    
    $result_sql = $conn->query($sql_update);
    
    $row_sql = $result_sql->fetch_assoc();
    
    $teacher_id_exam = $row_sql['user_id'];
    
    $data_sql = "select * from tbl_users where user_id='$teacher_id_exam'";
    
    $result_data = $conn->query($data_sql);
    
    $row_data  = $result_data->fetch_assoc();
    $coins_data = $row_data['coins']-1;
    
    
    $update_data = "update tbl_users set coins='$coins_data' where user_id='$teacher_id_exam'";
    
    $update_result = $conn->query($update_data);
} else {

}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
     <script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
    <link rel="stylesheet" href="style.css">
    <style>
     *{
         background:#fff;
     }          

#WarningModal,#WarningModal1,#WarningModal2{
    position:fixed;
    top:0%;
    left:0%;
    background:rgba(0,0,0,0.6);
    height:100vh;
    width:100%;
    z-index:999;
    display:none;
    z-index:999;
    /*border:3px solid white;*/
    box-shadow:1px 1px 6px -3px #1b263b;
}
#WarningModal h2,#WarningModal1 h2,#WarningModal2 h2{
    color:#1b2631;
  
    font-size:22px;
    line-height:1.5;
}
#WarningModal #message,#WarningModal1 #message,#WarningModal2 #message{
    padding:10px;
    position:absolute;
    top:30%;
    left:50%;
    transform:translate(-50%,0%);
    background:white;
    /*height:200px;*/
}
  @media only screen and (max-width:900px){
        #WarningModal #message,#WarningModal1 #message,#WarningModal2 #message{
    padding:10px;
    position:absolute;
    width:100%;
    top:20%;
    left:50%;
    transform:translate(-50%,0%);
    background:white;
    /*height:200px;*/
}
        }

#mybody:-webkit-full-screen {
	background-color: white;
	margin: 0;
	overflow-y:scroll;
}

#mybody:-moz-full-screen {
	background-color: white;
	margin: 0;
	overflow-y:scroll;
}

#mybody:-ms-fullscreen {
	background-color: white;
	margin: 0;
	overflow-y:scroll;

}

#mybody:fullscreen { 
	background: white;
	margin: 0;
	overflow-y:scroll;
	
}
#mainbody:fullscreen{
    	background-color: white;
}

/*#Start{*/
    
/*    position:absolute;*/
/*    top:50%;*/
/*    left:50%;*/
/*    transform:translate(-50%,-50%);*/
    
    
/*}*/


.borderr{
    height:400px;
    overflow:scroll;
}
        
        .submit_button{
            
        }
        
.instructioncolor button{
    margin-top:20px;margin-right:10px;
    box-shadow:1px 1px 8px -4px;border:none;
}
.instructioncolor button:hover{
    cursor:defau;
}
.instructioncolor button:focus{
    border:none;
    outline:none;
}
    </style>
</head>
<body id="mybody">
    
    <div class="container-fluid instruction" id="instr">
        <h2 class="alert alert-primary">
            Genral Instructions
        </h2>

    
    <div class="container">
        <section class="py-5">
            <div class="row">
                <div class="col-md-12 exam-confirm">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12" id="1">
                                <h4 class="text-center">Please read the instructions carefully</h4>
                                <h4><strong><u>General Instructions:</u></strong></h4>
                                <ol>
                                    <li>
                                        <ul class="ulInstruction">
                                            <li>Total duration of <?php echo  $exam_name?> is <?php echo  $duration?> min.</li>
                                        </ul>
                                    </li>
                                    <li>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</li>
                                    <li>
                                        The Questions Palette displayed on the right side of screen will show the status of each question using one of the following symbols:
                                        <ul class="instructioncolor">
                                            <li><button style="height:35px;width:35px;background-color:whitesmoke;border-radius:4px;"></button> You have not visited the question yet.<br /><br /></li>
                                            <!--<li><img src="/img/QuizIcons/Logo2.png" /> You have not answered the question.<br /><br /></li>-->
                                            <li><button style="height:40px;width:40px;background-color:green;border-radius:50%;"></button> You have answered the question. <br /><br /></li>
                                            <li><button style="height:35px;width:35px;background-color:red;border-radius:5px;"></button> You have NOT answered the question, but have visited the question.<br /><br /></li>
                                            <li><button style="height:35px;width:35px;background-color:blue;border-top-right-radius:50%;border-top-left-radius:50%;"></button> You are at the current question <br /><br /></li>
                                        </ul>
                                    </li>
                             
                                </ol>
                                <h4><strong><u>Navigating to a Question:</u></strong></h4>
                                <ol start="4">
                                    <li>
                                        To answer a question, do the followings:
                                        <ul type="a">
                                            <li>Click on the question number in the Question Palette at the right of your screen to go to that numbered question directly.</li>
                                          
                                        </ul>
                                    </li>
                                </ol>
                                <h4><strong><u>Answering a Question:</u></strong></h4>
                                <ol start="5">
                                    <li>
                                        Procedure for answering a multiple choice type question:
                                        <ul type="a">
                                            <li>To select you answer, click on the button of one of the options.</li>
                                            <li>To deselect your chosen answer, click on the button of the chosen option again or click on the <strong>Clear Response</strong> button</li>
                                            <li>To change your chosen answer, click on the button of another option</li>
                                         
                                        </ul>
                                    </li>
                                    <li>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</li>
                                </ol>
                                <h4><strong><u>Navigating through sections:</u></strong></h4>
                                <ol start="6">
                                    <li>Subjects in this question paper are displayed on the second top bar of the screen. Questions in a subject can be viewed by click on the subject name. The subject you are currently viewing is highlighted.</li>
                                 
                                    <li>You can shuffle between sections and questions anything during the examination as per your convenience only during the time stipulated.</li>
                                    <li>Candidate can view the corresponding section summery as part of the legend that appears in every section above the question palette.</li>
                                </ol>
                               
                               
                                <hr>
                                <div class=" text-center">
                                    <a onclick="StartTest()" class="btn btn-success text-white">Proceed</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                               
         <!--<button type="button" id="Start" onclick="StartTest()">Start Exam</button>-->
    </div>
     
	    <div id="mainbody" style="display:none;">
	      
   <div class="container-fluid pb-5">
           <form  action="pages/submit_assessment.php" class="p-3" method="POST" name="quiz" id="quiz_form">
    <nav  class="navbar fixed-top navbar-light bg-white shadow">  
   <div class="container">  
    <a href="javascript:void(0)" class="navbar-brand"><img src="../logo.png" style="width:80px;"></a>
    <span class="navbar-text" style="font-size: 16px;font-weight:600;"><span id="quiz-time-left"></span></span> 
       <input class="submit_button btn btn-link" type="button" onclick="SubmitModel()" id="submit_btn" style="font-size:15px;" value="Submit Exam">
   </div>
    </nav>

    <nav class="container sub nav-justified mb-3" style="margin-top: 80px;">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
         <?php
                      
                if(!empty($Section)){                                   
                $sec=explode('/', $Section);
                $i=0;
                $Count_Section = 0;
                    foreach($sec as $out) {
                                                             
                    if(!empty($out)){
                         $main_out =str_replace(' ', '', $out);
                        echo ' <a class="nav-item nav-link sub_tab ';
                        if($i == 0){
                            echo "active";
                        }
                        echo '" id="subject-data'.$i.'" data-toggle="tab" onclick = "checking()" href="#'.$main_out.'" role="tab" aria-controls="nav-subject1" aria-selected="true">'.$out.'</a>';
                        $i++;
                        $Count_Section++;
                    }
                                             
                                                    
                }
            echo '<input type="hidden" value="'.$i.'" id="total-tab">';
                }else if(empty($Section)){
                    echo ' <a class="nav-item nav-link sub_tab active" id="subject-data'.$i.'" onclick = "checking()" data-toggle="tab" href="#'.$out.'" role="tab" aria-controls="nav-subject1" aria-selected="true">'.  $exam_name.'</a>';
                }
                                                    
            ?>	
        
        </div>
      </nav>
      <hr style="margin-top: -17px;">
      <div class="tab-content" id="nav-tabContent">
          <?php 
          if(empty($Section)){ 
          ?>
        <div class="tab-pane fade show active" id="nav-subject1" role="tabpanel" aria-labelledby="nav-subject1-tab"> 
        <div class="container">
            <div class="row">
                <div class="col-2 col-lg-3 pb-3 borderr">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        
                      
                        
                                         
                        	<?php 
                                            include '../database/config.php';
                                            
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id'";
                                            $result = $conn->query($sql);
                                          
                                                // if exam is not a section exam
                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            $total_questions = 0;

                                            while($row = $result->fetch_assoc()) {
                                            $total_questions++;
                                            $type = $row['type_val'];
                                            
                                        
                                           
											if ($qno == "1") {
											    
											    print '  <li class="nav-item " >
                                    <a class="qlink active " id="pills-sub1q'.$qno.'-tab" data-toggle="pill" href="#pills-sub1q'.$qno.'" onclick="next('.$qno.','.$type.')" role="tab" aria-controls="pills-sub1q1" aria-selected="true">'.$qno.'  </a>
                                    
                                    </li>';
                                               
                                          
                                         


											}else{
											    			    print '  <li class="nav-item " id="qchg'.$qno.'">
                        <a class="qlink " id="pills-sub1q'.$qno.'-tab" data-toggle="pill" href="#pills-sub1q'.$qno.'" onclick="next('.$qno.','.$type.')" role="tab" aria-controls="pills-sub1q1" aria-selected="true">'.$qno.'  </a>
                        
                        </li>';
                                             
                                         
                                            }
                                            

											$qno = $qno + 1;
                                            }
                                            } else {
 
                                            }
                                            

											?>
                        

                    
                      
                      </ul>
                </div>
                <div class="col-10 col-lg-9 py-3 p-5 sec_border">
                    <div class="tab-content" id="pills-tabContent">
                       	<?php   
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            while($row = $result->fetch_assoc()) {
                                                $qsid = $row['question_id'];
                                                $qs = $row['question'];
                                                $question_type =$row['question_type'];
												$pmarks = $row['pos_marks'];
												$nmarks =$row['neg_marks'];
												$type = $row['type'];
												$op1 = $row['option1'];
												$op2 = $row['option2'];
												$op3 = $row['option3'];
												$op4 = $row['option4'];
												$ans = $row['answer'];
                                                $Image = $row['image'];
                                                $Hindi_Image = $row['hindi_image'];//Added by Govind
												$enan = $row[$ans];
     
											
											    
											    if($question_type == "STQ"){
											        $q_value=1;
											    }else if($question_type=="MTQ"){
											        $q_value=1;
											    }else if ($question_type == "FQ"){
											        $q_value=0;
											    }else if($question_type == "TQ"){
											        $q_value=2;
											    }
											    if($qno == 1 ){
											     echo '<input type="hidden" value="'.$q_value.'" id="typevalue">'; 
											    }
											     
											     if($question_type == "STQ"){
											         print ' <div class="tab-pane fade show';
											         if($qno==1){
											         print ' active';
											         }
											         print '" id="pills-sub1q'.$qno.'" role="tabpanel" aria-labelledby="pills-sub1q1-tab">';
											         print '<button type="button" onclick="ClearOptionQuestion('.$qno.',1)">Clear Option</button>';
											          print '<h5 class="tooltipmark">Q'.$qno.'';
											         if(!empty($qs)){
											         

                                                    print $qs.'?</h5>';
                                                    }
                                                    print'
                                                    <br>';
                                                    if(!empty($Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }
                                                  
                                                    
                                                    for($i=1;$i<5;$i++){
                                                        print '<div class="form-check">
                                                          <input class="form-check-input" type="radio" name="an'.$qno.'" value="'.$row['option'.$i].'" id="option'.$i.$qno.'">
                                                          <label class="form-check-label" for="option'.$i.$qno.'">'.$row['option'.$i].'</label>
                                                        </div>';
                                                    }
                                                        
                                                    print '</div>';
											     }else if($question_type == "MTQ"){
											         print '   <div class="tab-pane fade show';
											         if($qno==1){
											         print ' active';
											         }
											         print '" id="pills-sub1q'.$qno.'" role="tabpanel" aria-labelledby="pills-sub1q2-tab">';
											           
											           print '<h5 class="tooltipmark">Q'.$qno.'';
											         if(!empty($qs)){
											         
                                                   
                                                    
                                                    print $qs.'?</h5>';
                                                    }
                                                    print'
                                                                <br>';
                                                                
                                                                if(!empty($Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }
                                                                for($i=1;$i<5;$i++){
                                                                    print '  <div class="form-check ">
                                                                    <input class="form-check-input" name="an'.$i.$qno.'"  type="checkbox" value="'.$row["option".$i].'" id="option'.$i.$qno.'">
                                                                    <label class="form-check-label" for="option'.$i.$qno.'">'.$row["option".$i].'</label>
                                                                  </div>';
                                                                }
                                                                
                                                            print '
                                                            </div>';
											     }else if($question_type == "FQ"){
											      print '    <div class="tab-pane fade show';
											         if($qno==1){
											         print ' active';
											         }
											         print '" id="pills-sub1q'.$qno.'" role="tabpanel" aria-labelledby="pills-sub1q3-tab">';
											          print '<h5 class="tooltipmark">Q'.$qno.'';
											         if(!empty($qs)){
											         
                                                   
                                                    
                                                    print $qs.'?</h5>';
                                                    }
                                                    print'
                                                <br>';
                                               if(!empty($Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }
                                                    print '
                                                  <div class="form-group">
                                                   <input  type="text" class="form-control form-control-sm fill_type" placeholder="Enter Your Answer" name="an'.$qno.'" id="fill'.$qno.'">
                                                  </div>
                                            </div>';   
											     }else if($question_type == "TQ"){
											         print '     <div class="tab-pane fade show';
											         if($qno==1){
											         print ' active';
											         }
											         print '" id="pills-sub1q'.$qno.'" role="tabpanel" aria-labelledby="pills-sub1q4-tab">
                                                    ';
                                                     print '<button type="button" onclick="ClearOptionQuestion('.$qno.',2)">Clear Option</button>';
											         print '<h5 class="tooltipmark">Q'.$qno.'';
											         if(!empty($qs)){
											         
                                                   
                                                    
                                                    print $qs.'?</h5>';
                                                    }
                                                    print'
                                                    <br>';
                                                     if(!empty($Image)){
                                                                 print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }
                            
                                        for($i=1;$i<3;$i++){
                                            $arr = ['true','false'];
                                            
                                            print '  <div class="form-check">
                                            <input class="form-check-input" type="radio" name="an'.$qno.'"   value="'.$arr[$i-1].'" id="true'.$i.$qno.'">
                                            <label class="form-check-label" for="inlineRadio2">'.$arr[$i-1].'</label>
                                          </div>';
                                        }
                                      
                                       print'
                                    </div>';
											     }
											     
											      
											     $qno++;
											     
											   
											     
                                            }
											     
											     
											?>
									
                     
                       
                 
                        
                       
                      </div>
                </div>
            </div>
        </div>
        </div>
        <?php }}
        else if(!empty($Section)){
                $sec=explode('/', $Section);
                $i=0;
                $count_questions = [];
            foreach($sec as $out) {
                                                             
            if(!empty($out)){
                
                 $main_out =str_replace(' ', '', $out);
                
                       
                   
        
        ?>
        
        <!--code for section exam-->
         <div class="tab-pane fade show <?php 
         if($i==0){
            echo "active"; 
         }
         
         ?>" id="<?php echo $main_out; ?>" role="tabpanel" aria-labelledby="<?php echo $main_out ?>">
            
        <div class="container">
            <div class="row">
                <div class=" col-2 col-lg-3 pb-3 borderr">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                         
                        	<?php 
                                            include '../database/config.php';
                                            
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' and sec_name='$out'";
                                            $result = $conn->query($sql);
                                          
                                                // if exam is  a section exam
                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            $total_questions = 0;
                                            $count_questions[$i] = 0;

                                            while($row = $result->fetch_assoc()) {
                                            $total_questions++;
                                            $type = $row['type_val'];
                                            
                                        
                                           
											if ($qno == "1") {
											    print '  <li class="nav-item " onclick="ActiveCurrent('.$qno.',-10)" >
                                    <a class="qlink active " id="pills-sub1q'.$main_out.$qno.'-tab" data-toggle="pill" href="#pills-sub1q'.$main_out.$qno.'" onclick="sectionquestion('.$qno.','.$type.',-10)" role="tab" aria-controls="pills-sub1q1" aria-selected="true">'.$qno.'  </a>
                                    
                                    </li>';
                                   
                                               
                                          
                                         


											}else{
											    			    print '  <li class="nav-item " id="qchg'.$qno.'" onclick="ActiveCurrent('.$qno.',-10)"  >
                        <a class="qlink  " id="pills-sub1q'.$main_out.$qno.'-tab" data-toggle="pill" href="#pills-sub1q'.$main_out.$qno.'" onclick="sectionquestion('.$qno.','.$type.',-10)" role="tab" aria-controls="pills-sub1q1" aria-selected="true">'.$qno.'  </a>
                        
                        </li>';
                                   
                                             
                                         
                                            }
                                            
                                              $count_questions[$i]++;

											$qno = $qno + 1;
                                            }
                                            } else {
 
                                            }
                                            
                                            
											
											?>
                        

                    
                      
                      </ul>
                </div>
                <div class="col-10 col-lg-9 p-5 sec_border">
                    <div class="tab-content" id="pills-tabContent">
                       	<?php 
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' and sec_name='$out'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            while($row = $result->fetch_assoc()) {
                                                $qsid = $row['question_id'];
                                                $qs = $row['question'];
                                                $question_type =$row['question_type'];
												$pmarks = $row['pos_marks'];
												$nmarks =$row['neg_marks'];
												$type = $row['type'];
												$op1 = $row['option1'];
												$op2 = $row['option2'];
												$op3 = $row['option3'];
												$op4 = $row['option4'];
												$ans = $row['answer'];
                                                $Image = $row['image'];
                                                  $Hindi_Image = $row['hindi_image'];
												$enan = $row[$ans];
     
											
							
											    
											    if($question_type == "STQ"){
											        $q_value=1;
											    }else if($question_type=="MTQ"){
											        $q_value=1;
											    }else if ($question_type == "FQ"){
											        $q_value=0;
											    }else if($question_type == "TQ"){
											        $q_value=2;
											    }
											    if($qno == 1 ){
											     echo '<input type="hidden" value="'.$q_value.'" id="typevalue'.$main_out.'">'; 
											    
											    }
											     
											     if($question_type == "STQ"){
											         print ' <div class="tab-pane fade show';
											         if($qno==1){
											         print ' active';
											         }
											         print '" id="pills-sub1q'.$main_out.$qno.'" role="tabpanel" aria-labelledby="pills-sub1q1-tab">';
											        
											           print '<h5 class="tooltipmark">Q'.$qno.'';
											         if(!empty($qs)){
											         
                                                   
                                                    
                                                    print $qs.'?</h5>';
                                                    }
                                                    print'
                                                    <br>';
                                                    if(!empty($Image) and empty($Hindi_Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }else if(empty($Image) and !empty($Hindi_Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Hindi_Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }else if(!empty($Image) and !empty($Hindi_Image)){
                                                         print' <select onchange="FetchImage(this.value,'.$qno.')"  class="form-control" style="margin-bottom:10px">
                                                    <option value="English">English</option>
                                                    <option value="Hindi">Hindi</option>
                                                    </select>';
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" id="english'.$main_out.$qno.'" alt="" style="width:100%;">
                                                    </div>';
                                                    print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Hindi_Image.'" id="hindi'.$main_out.$qno.'" alt="" style="width:100%;display:none">
                                                    </div>';
                                                    }
                                                  
                                                    
                                                    for($i=1;$i<5;$i++){
                                                        print '<div class="form-check">
                                                          <input class="form-check-input" type="radio" name="an'.$main_out.$qno.'" value="'.$row['option'.$i].'" id="option'.$main_out.$i.$qno.'">
                                                          <label class="form-check-label" for="option'.$i.$qno.'">'.$row['option'.$i].'</label>
                                                        </div>';
                                                    }
                                                        
                                                      print '<button type="button"  class="btn btn-sm btn-dark" style="position:absolute;bottom:-30px;" onclick="ClearOptionQuestion('.$qno.',1)">Clear Option</button>';    
                                                    print '</div>';
											     }else if($question_type == "MTQ"){
											         print '   <div class="tab-pane fade show';
											         if($qno==1){
											         print ' active';
											         }
											         print '" id="pills-sub1q'.$main_out.$qno.'" role="tabpanel" aria-labelledby="pills-sub1q2-tab">';
											          
											         print '<h5 class="tooltipmark">Q'.$qno.'';
											          
											         if(!empty($qs)){
											         
                                                   
                                                    
                                                    print $qs.'?</h5>';
                                                    }
                                                    print'
                                                                <br>';
                                                                
                                                                 if(!empty($Image) and empty($Hindi_Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }else if(empty($Image) and !empty($Hindi_Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Hindi_Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }else if(!empty($Image) and !empty($Hindi_Image)){
                                                         print' <select onchange="FetchImage(this.value,'.$qno.')"  class="form-control" style="margin-bottom:10px">
                                                    <option value="English">English</option>
                                                    <option value="Hindi">Hindi</option>
                                                    </select>';
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" id="english'.$main_out.$qno.'" alt="" style="width:100%;">
                                                    </div>';
                                                    print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Hindi_Image.'" id="hindi'.$main_out.$qno.'" alt="" style="width:100%;display:none">
                                                    </div>';
                                                    }
                                                                for($i=1;$i<5;$i++){
                                                                    print '  <div class="form-check ">
                                                                    <input class="form-check-input" name="an'.$main_out.$i.$qno.'"  type="checkbox" value="'.$row["option".$i].'" id="option'.$main_out.$i.$qno.'">
                                                                    <label class="form-check-label" for="option'.$i.$qno.'">'.$row["option".$i].'</label>
                                                                  </div>';
                                                                }
                                                                
                                                            print '
                                                            </div>';
											     }else if($question_type == "FQ"){
											      print '    <div class="tab-pane fade show';
											         if($qno==1){
											         print ' active';
											         }
											         print '" id="pills-sub1q'.$main_out.$qno.'" role="tabpanel" aria-labelledby="pills-sub1q3-tab">';
											        
											           print '<h5 class="tooltipmark">Q'.$qno.'';
											         if(!empty($qs)){
											         
                                                   
                                                    
                                                    print $qs.'?</h5>';
                                                    }
                                                    print'
                                                <br>';
                                                 if(!empty($Image) and empty($Hindi_Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }else if(empty($Image) and !empty($Hindi_Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Hindi_Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }else if(!empty($Image) and !empty($Hindi_Image)){
                                                         print' <select onchange="FetchImage(this.value,'.$qno.')"  class="form-control" style="margin-bottom:10px">
                                                    <option value="English">English</option>
                                                    <option value="Hindi">Hindi</option>
                                                    </select>';
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" id="english'.$main_out.$qno.'" alt="" style="width:100%;">
                                                    </div>';
                                                    print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Hindi_Image.'" id="hindi'.$main_out.$qno.'" alt="" style="width:100%;display:none">
                                                    </div>';
                                                    }
                                                    print '
                                                  <div class="form-group">
                                                   <input  type="text" class="form-control form-control-sm fill_type" placeholder="Enter Your Answer" name="an'.$main_out.$qno.'" id="fill'.$main_out.$qno.'">
                                                  </div>
                                                
                                            </div>';   
											     }else if($question_type == "TQ"){
											         print '     <div class="tab-pane fade show';
											         if($qno==1){
											         print ' active';
											         }
											         print '" id="pills-sub1q'.$main_out.$qno.'" role="tabpanel" aria-labelledby="pills-sub1q4-tab">
                                                    ';
                                                  
											           print '<h5 class="tooltipmark">Q'.$qno.'';
											         if(!empty($qs)){
											         
                                                   
                                                    
                                                    print $qs.'?</h5>';
                                                    }
                                                    print'
                                                    <br>';
                                                      if(!empty($Image) and empty($Hindi_Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }else if(empty($Image) and !empty($Hindi_Image)){
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Hindi_Image.'" alt="" style="width:100%;">
                                                    </div>';
                                                    }else if(!empty($Image) and !empty($Hindi_Image)){
                                                         print' <select onchange="FetchImage(this.value,'.$qno.')"  class="form-control" style="margin-bottom:10px">
                                                    <option value="English">English</option>
                                                    <option value="Hindi">Hindi</option>
                                                    </select>';
                                                          print '
                                                    <div class="container mb-3" style="width:100%;">
                                                        <img src="../admin/pages/'.$Image.'" id="english'.$main_out.$qno.'" alt="" style="width:100%;">
                                                    </div>';
                                                    print '
                                                    <div class="container mb-3" style="max-width:100%;">
                                                        <img src="../admin/pages/'.$Hindi_Image.'" id="hindi'.$main_out.$qno.'" alt="" style="width:100%;display:none">
                                                    </div>';
                                                    }
                                                     
                            
                                        for($i=1;$i<3;$i++){
                                            $arr = ['true','false'];
                                            
                                            print '  <div class="form-check">
                                            <input class="form-check-input" type="radio" name="an'.$main_out.$qno.'"   value="'.$arr[$i-1].'" id="true'.$main_out.$i.$qno.'">
                                            <label class="form-check-label" for="inlineRadio2">'.$arr[$i-1].'</label>
                                          </div>';
                                        }   print '<button type="button" class="btn btn-sm btn-dark" style="position:absolute;bottom:-30px;" onclick="ClearOptionQuestion('.$qno.',2)">Clear Option</button>';
                                      
                                       print'
                                    </div>';
											     }
											     
											   
											     $qno++;
											     
                                            }
											     
                                            } else{
                                              echo '<input type="hidden" value="1" id="typevalue'.$main_out.'">';   
                                            }
											?>
											
										
										
										   
                     
                       
                 
                        
                       
                      </div>
                </div>
            </div>
        </div>
        </div>
    
        
     
        
        
        
        
        
       <?php 
         $i++;  
            }
            
                                         
                                                    
                }
        } ?>
      </div>
<!-- <hr> -->
<!--<nav  class="navbar fixed-bottom navbar-light bg-white border-top ">-->
<!--    <div class="container justify-content-center mx-auto" >-->
<!--            <input class="submit_button btn btn-link" type="submit" value="Submit Exam">-->
<!--    </div>-->
<!--</nav>-->
                                            <input type="hidden" name="tq" value="<?php echo "$total_questions"; ?>">
											<input type="hidden" id="exam_id" name="eid" value="<?php echo "$exam_id"; ?>">
											<input type="hidden" name="pm" value="<?php echo "$passmark"; ?>">
											<input type="hidden" name="ri" value="<?php echo "$recid"; ?>">
											
											<input type="hidden" id="remaining_time" name="remaining_time">
											
											<input type="hidden" id="submission_type" name="submission_type" value="SUCCESS">
											
										
    </form>
</div>




<audio src="../clockaudio.mpeg" id="audio_data"></audio>



        
        <div id ="WarningModal1" >
            <div id="message" class="text-center">
                <h2 id="content" ><b class="text-danger">Warning : </b> <br>Please Go Back To Full Screen Mode Or Submit You Exam </h2> <br>
                <input type="hidden" id="data" >
                <button type="button" class="btn btn-warning" onclick="SubmitExam()">Submit Exam</button>
                  <button type="button" class="btn btn-warning" onclick="StartTest()">Go Back To Full Screen</button>
            </div>
        </div>
          <div id ="WarningModal2" style="display:none" >
            <div id="message" class="text-center">
                <h2 id="content" >Are You Sure You Want To Submit Exam </h2> <br>
                <input type="hidden" id="data" >
                <button type="button" class="btn btn-warning" onclick="SubmitExam1()">Submit Exam</button>
                  <button type="button" class="btn btn-warning" onclick="CanelTest()">Canel</button>
            </div>
        </div>
        
        
        
        <input type="hidden"  id="count_data" value="<?php echo $no_exit_fullscreen; ?>">
        </div>




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
        <script src="../assets/js/modern.min.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        

	<script>
	
	
	
// 	 window.addEventListener("beforeunload", function (e) {
 
//       // *********** perform database operation here
//       // before closing the browser ************** //
    
//       $.ajax({
//             url:'UpdateExamStatus.php',
//             type:'post',
//             success:function(data){
                
//             }
//         })
//       // added the delay otherwise database operation will not work
//       for (var i = 0; i < 5000000000; i++) { }

       

//       return undefined;
//     });

	
	
	
		function SubmitModel(){
	    document.querySelector('#WarningModal2').style.display="block";
	}
	
	function CanelTest(){
	    document.querySelector('#WarningModal2').style.display="none";
	        $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
        	if(IsFullScreenCurrently()) {
        	}
        	else {
        	    
        	 	var exam_id = document.querySelector('#exam_id').value;
        	 	var count =document.querySelector('#count_data').value;
        	 	if(count > 1){
        	 	   
        	 	 $.ajax({
        		     url:'Warning.php',
        		     type:'post',
        		     data:{
        		         count:count,
        		         exam_id:exam_id
        		     },
        		     success:function(data){
        		      //   if(data == 1){
        		          document.querySelector('#WarningModal1').style.display="block";
        		           
        		            document.querySelector('#count_data').value = count-1;
        		          //  document.querySelector('#count_msg').innerHTML = '<b>Warning :Your are not allowed to exit the fullscreen mode while given the exam.</b>';
        		      //   }
        		         
        		         
        		     }
        		     
                	})
        	 	}else if(count <= 1){
        	 	     document.querySelector('#submission_type').value="AUTO_OUT_SUBMISSION";
        	 	      document.quiz.submit(); 
        	 	}
        	 	
        	}
        }); 
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	  function FetchImage(values,qno){
	       var y = document.querySelector('#total-tab').value;
        for(var i=0;i<y;i++){
          
        if(document.querySelector('#subject-data'+i).className.includes("active")){
            var out  = document.querySelector('#subject-data'+i).innerText;
        }
    }
         var out = out.split(/\s/).join('');
        
        if(values == "English"){
            document.querySelector('#english'+out+qno).style.display="block";
            document.querySelector('#hindi'+out+qno).style.display="none";
        }else if(values == "Hindi"){
             document.querySelector('#english'+out+qno).style.display="none";
            document.querySelector('#hindi'+out+qno).style.display="block"; 
        }
        
    }
	
	
	
	
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

    // document.querySelector('.nav-item').addEventListener('change',()=>{
    //     alert("suraj ram");
    //     // if(document.querySelector('.nav-item').classList.contains('active')){
    //     //   document.querySelector('.qlink').classList.contains('active').style.backgroundColor  = "blue";
    //     // document.querySelector('.qlink').classList.contains('active').style.color = "whitesmoke"; 
    //     // }
    // })
    
    
    
    function ActiveCurrent(id,type){
       var CountSection = <?php echo $Count_Section; ?>;
    
      /// code if exam is section exam
        
        
        var ActiveSection = '' ;
        if(type == -10){
        for(var i=0;i<CountSection;i++){
            
            if(document.querySelector('#subject-data'+i).className.includes("active")){
                var  ActiveSection = document.querySelector('#subject-data'+i).innerHTML;  
                 var ActiveSection = ActiveSection.replaceAll(' ','');
              
            }
            
        }
        }else{
            var   ActiveSection = document.querySelector('#subject-data'+type).innerHTML; 
             var ActiveSection = ActiveSection.replaceAll(' ','');
        }
        
       
     
      
     
       document.getElementById('pills-sub1q'+ActiveSection+id+'-tab').style.backgroundColor  = "blue";
            document.getElementById('pills-sub1q'+ActiveSection+id+'-tab').style.color = "whitesmoke"; 
    }
    



	

	
	
	    function ClearOptionQuestion(id,type){
	        
	        var sec = "<?php  echo $Section; ?>";
	        if(sec == ""){
	           if(type == 1){
	           for(var i=1;i<5;i++){
	               document.querySelector('#option'+i+id).checked = false;
	           }
	           }else if(type ==2){
	                for(var i=1;i<3;i++){
	               document.querySelector('#true'+i+id).checked =false;
	           }
	           }
	        }   
	        if(sec != ''){
	            
	            var len = <?php echo $Count_Section; ?>
	            
	             for(var i=0;i<len;i++){
            
            if(document.querySelector('#subject-data'+i).className.includes("active")){
                var  ActiveSection = document.querySelector('#subject-data'+i).innerHTML; 
                 var ActiveSection = ActiveSection.replaceAll(' ','');
              
            }
        
        }
        
    
	            
	              if(type == 1){
	           for(var i=1;i<5;i++){
	               document.querySelector('#option'+ActiveSection+i+id).checked =false;
	           }
	           }else if(type ==2){
	                for(var i=1;i<3;i++){
	               document.querySelector('#true'+ActiveSection+i+id).checked =false;
	           }
	           }
	        }
	        
	        
	    }
	
		function SubmitExam1(){
		     document.quiz.submit();
		     
		}
		
	
	
	
	
	
		function SubmitExam(){
		    document.querySelector('#submission_type').value="OUT_SUBMISSION";
		     document.quiz.submit();
		     
		}
		


       	
        		 /* Get into full screen */
        function GoInFullscreen(element) {
        	if(element.requestFullscreen)
        		element.requestFullscreen();
        	else if(element.mozRequestFullScreen)
        		element.mozRequestFullScreen();
        	else if(element.webkitRequestFullscreen)
        		element.webkitRequestFullscreen();
        	else if(element.msRequestFullscreen)
        		element.msRequestFullscreen();
        }
        
        /* Get out of full screen */
        function GoOutFullscreen() {
        	if(document.exitFullscreen)
        		document.exitFullscreen();
        	else if(document.mozCancelFullScreen)
        		document.mozCancelFullScreen();
        	else if(document.webkitExitFullscreen)
        		document.webkitExitFullscreen();
        	else if(document.msExitFullscreen)
        		document.msExitFullscreen();
        }
        
        /* Is currently in full screen or not */
        function IsFullScreenCurrently() {
        	var full_screen_element = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || null;
        	
        	// If no element is in full-screen
        	if(full_screen_element === null)
        		return false;
        	else
        		return true;
        }
        
        $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
        	if(IsFullScreenCurrently()) {
        	    
        	      document.querySelector('#submit_btn').setAttribute( "onClick", "SubmitModel();" );
        	}
        	else {
        	      document.querySelector('#submit_btn').setAttribute( "onClick", "" );
        	  document.querySelector('#submit_btn').type="submit";
        	       document.querySelector('#WarningModal1').style.display="block";
        	    
        	 	var exam_id = document.querySelector('#exam_id').value;
        	 	var count =document.querySelector('#count_data').value;
        	 	if(count > 1){
        	 	
        	 	 $.ajax({
        		     url:'Warning.php',
        		     type:'post',
        		     data:{
        		         count:count,
        		         exam_id:exam_id
        		     },
        		     success:function(data){
        		 
        		          
        		           
        		            document.querySelector('#count_data').value = count-1;
        		       
        		         
        		         
        		     }
        		     
                	})
        	 	}else if(count <= 1){
        	 	      document.querySelector('#submission_type').value="AUTO_OUT_SUBMISSION";
        	 	      document.quiz.submit(); 
        	 	    
        	 	}
        	 	
        	}
        }); 
		
		
		
		
		
		function StartTest(){
		    if(IsFullScreenCurrently()){
        		GoOutFullscreen();
        	
        		
        	
		    }
        	else{
        		GoInFullscreen($("#mybody").get(0));
        		document.querySelector('#WarningModal1').style.display="none";
        		document.querySelector('#mainbody').style.display="block";
        		document.querySelector('#instr').style.display="none";
        	}
		}
		
		
		
		
		
		
		function Warning(){
		   
		      // var count = document.querySelector('#times').innerHTML;
		      var  count = document.querySelector('#data').value;
		        document.querySelector('#WarningModal').style.display="none";
		       if(count <= 0){
		           document.quiz.submit();
		       }
		}
		

		

			function ClearAnswer(qno){
				    
				    for(var i=1;i<=4;i++){
				        var x = document.querySelector('#option'+i+qno);
				        if(x.className == ""){
				        if(x.checked == true){
				            // document.querySelector('#radio'+qno).style.display="block";
				            x.className="1";
				        }
				        }
				        else if(x.className == 1){
				            x.checked=false;
				            x.className="";
				        }
				    }
				}

		
//   function checkForm(form) // Submit button clicked
//   {
//     form.submit_button.disabled = true;
//     form.submit_button.value = "Please wait...";
//     return true;
//   }
		
		
		
		
                var pre=1;
                var flag=0;
                var type_val;
                var pre_arr = [];
                var flag_arr = [];
                var type_val_arr =[];
                var section_change_pre =1;
                var section_change_type_val ;
                var section_previous_active;
                var Counting = [];
              
              history.pushState(null, document.title, location.href);
                window.addEventListener('popstate', function (event)
                {
                  history.pushState(null, document.title, location.href);
                });
                
         window.onload = () =>{
           
             
             <?php
             
             if(!empty($Section)){
                  $sec=explode('/', $Section);
                $i=0;
            foreach($sec as $out) {
                                                             
            if(!empty($out)){
                 $main_out =str_replace(' ', '', $out);
                ?>
                pre_arr[<?php echo $i ?>] = 1;
                flag_arr[<?php echo $i; ?>] = 0;
                type_val_arr[<?php echo $i; ?>] = document.getElementById("typevalue<?php echo $main_out; ?>").value;
                Counting[<?php echo $i; ?>] = 0;
                
              
                <?php
                
                $i++;
            }}
                
                
             }else{
             
             
             ?>
            var type_val_first_question = document.getElementById("typevalue").value;
            // alert(type_val_first_question);
       
          type_val = type_val_first_question;
          <?php } ?>
          
        }
               
 <?php 
 
 if(empty($Section)){ ?>
 

               
function next(qno,type){


/// code if exam is not a section exam    

if(type_val == 0){
  
    var y = document.getElementById("fill"+pre);
    if(y.value != ''){
      document.getElementById('pills-sub1q'+pre+'-tab').style.backgroundColor = "rgb(65, 148, 65)"; 
        document.getElementById('pills-sub1q'+pre+'-tab').style.color = "whitesmoke"; 
    }
    else{
      document.getElementById('pills-sub1q'+pre+'-tab').style.backgroundColor  = "rgb(159, 17, 15)"; 
        document.getElementById('pills-sub1q'+pre+'-tab').style.color = "whitesmoke"; 
    }
    
  
    
    
    
    
    
    
}else if (type_val ==2){
     for(var i=1;i<=2;i++){
        var x = document.getElementById("true"+i+pre);
        
        if(x.checked === true){
            flag=1;
            break;
        }
        else{
            flag=0;
        }
      
    }
    if(flag == 1){
        document.getElementById('pills-sub1q'+pre+'-tab').style.backgroundColor  = "rgb(65, 148, 65)";
        document.getElementById('pills-sub1q'+pre+'-tab').style.color = "whitesmoke"; 
        
    }
    else{
        document.getElementById('pills-sub1q'+pre+'-tab').style.backgroundColor  = "rgb(159, 17, 15)";
        document.getElementById('pills-sub1q'+pre+'-tab').style.color = "whitesmoke"; 
    }
    
}
else{

 for(var i=1;i<=4;i++){
        var x = document.getElementById("option"+i+pre);
        
        if(x.checked === true){
            flag=1;
            break;
        }
        else{
            flag=0;
        }
      
    }
    if(flag == 1){
        document.getElementById('pills-sub1q'+pre+'-tab').style.backgroundColor  = "rgb(65, 148, 65)";
        document.getElementById('pills-sub1q'+pre+'-tab').style.color = "whitesmoke"; 
    }
    else{
        document.getElementById('pills-sub1q'+pre+'-tab').style.backgroundColor  = "rgb(159, 17, 15)";
        document.getElementById('pills-sub1q'+pre+'-tab').style.color = "whitesmoke"; 
    }
}
  
    pre=qno;
  type_val = type;
    
 
        
        
    

}

<?php }else if(!empty($Section)){ ?>


function sectionquestion(qno,type,ActiveData){
     var CountSection = <?php echo $Count_Section; ?>;
    
      /// code if exam is section exam
        
        if(ActiveData == -10){
        var ActiveSection = '' ;
        for(var i=0;i<CountSection;i++){
            
            if(document.querySelector('#subject-data'+i).className.includes("active")){
                var  ActiveSection = document.querySelector('#subject-data'+i).innerHTML;  
                 var ActiveSection = ActiveSection.replaceAll(' ','');
                var ActiveData = i;
               
            }
            
        }
        
        }else{
            var  ActiveSection = document.querySelector('#subject-data'+ActiveData).innerHTML; 
             var ActiveSection = ActiveSection.replaceAll(' ','');
        }
     
           
    
        if(type_val_arr[ActiveData] == 0){
  
        var y = document.getElementById("fill"+ActiveSection+pre_arr[ActiveData]);
        if(y.value != ''){
          document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.backgroundColor = "rgb(65, 148, 65)"; 
           document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.borderRadius = "50%";
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.color = "whitesmoke"; 
        }
        else{
          document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.backgroundColor  = "rgb(159, 17, 15)"; 
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.color = "whitesmoke"; 
        }
        
      
        
        
        
        
        
        
    }else if (type_val_arr[ActiveData] ==2){
         for(var i=1;i<=2;i++){
            var x = document.getElementById("true"+ActiveSection+i+pre_arr[ActiveData]);
            
            if(x.checked === true){
                flag=1;
                break;
            }
            else{
                flag=0;
            }
          
        }
        if(flag == 1){
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.backgroundColor  = "rgb(65, 148, 65)";
             document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.borderRadius = "50%";
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.color = "whitesmoke"; 
            
        }
        else{
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.backgroundColor  = "rgb(159, 17, 15)";
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.color = "whitesmoke"; 
        }
        
    }
    else{
    
     for(var i=1;i<=4;i++){
            var x = document.getElementById("option"+ActiveSection+i+pre_arr[ActiveData]);
            
            if(x.checked === true){
                flag=1;
                break;
            }
            else{
                flag=0;
            }
          
        }
        if(flag == 1){
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.backgroundColor  = "rgb(65, 148, 65)";
             document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.borderRadius = "50%";
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.color = "whitesmoke"; 
        }
        else{
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.backgroundColor  = "rgb(159, 17, 15)";
            document.getElementById('pills-sub1q'+ActiveSection+pre_arr[ActiveData]+'-tab').style.color = "whitesmoke"; 
        }
    }
        
      
      
      
    
         section_previous_active = ActiveData;
        Counting[ActiveData] = Counting[ActiveData]+1;
      pre_arr[ActiveData]=qno;
      type_val_arr[ActiveData] = type;
}

function checking(){
   
    var CountSection = <?php echo $Count_Section; ?>;
    for(var i=0;i<CountSection;i++){
        if(Counting[i] != ""){
            sectionquestion( pre_arr[section_previous_active],type_val_arr[section_previous_active],section_previous_active);
            ActiveCurrent(pre_arr[section_previous_active],section_previous_active);
        }
    }
    
   
    
}


<?php } ?>







function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}








</script>

<script type="text/javascript">



if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    
   window.onload = () => {
    
         document.quiz.submit();
     }
} 



var max_time = <?php 



date_default_timezone_set('Asia/Kolkata');


$sql = "select * from tbl_examinations where exam_id='$exam_id'";
$result = $conn->query($sql);
$arr = $result->fetch_assoc();

$exam_time = date("H:i:s",strtotime($arr['edate']));
$duration = $arr["duration"];

$endTime = strtotime(date("H:i:s", strtotime($arr['edate'])+($duration*60)));

$current_time = strtotime(date("H:i:s"));


if($restriction_check == "Non Restricted"){
    echo $duration;
}else if($restriction_check == "Restricted"){
$mins = (int)(($endTime - $current_time) / 60);
echo $mins;
}



?>;
var c_seconds  = 0;
var total_seconds =60*max_time;
max_time = parseInt(total_seconds/60);
c_seconds = parseInt(total_seconds%60);
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + 'Min';

var total_time_minute = max_time+c_seconds/60;


document.getElementById('remaining_time').value=total_time_minute;

function Maininit(){


document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min';
document.getElementById('remaining_time').value=total_time_minute;

setTimeout("CheckTime()",900);
}
function CheckTime(){
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min' ;
document.getElementById('remaining_time').value=total_time_minute;
if(total_seconds <= 0){
    document.querySelector('#submission_type').value="AUTO_SUBMISSION";
setTimeout('document.quiz.submit()',1);

var audio =  document.getElementById('audio_data');
audio.autoplay = true;
audio.pause();
audio.currentTime = 0;
}
else
{
if(total_seconds < 60 && total_seconds > 0 ){
        var audio =  document.getElementById('audio_data');
        audio.autoplay = true;
        audio.play();
     
     }
    total_seconds = total_seconds -1;
    max_time = parseInt(total_seconds/60);
    c_seconds = parseInt(total_seconds%60);
    total_time_minute = max_time+c_seconds/60;
    setTimeout("CheckTime()",900);
}

}
Maininit();


// stop refresh

            
            var ctrlKeyDown = false;

$(document).ready(function(){    
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);
});

function keydown(e) { 

    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        // Pressing F5 or Ctrl+R
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        // Pressing  only Ctrl
        ctrlKeyDown = true;
    }
};

function keyup(e){
    // Key up Ctrl
    if ((e.which || e.keyCode) == 17) 
        ctrlKeyDown = false;
};
  


</script>

</body>
</html>