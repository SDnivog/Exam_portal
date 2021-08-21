<?php include 'includes/check_user.php'; 
include 'includes/fetch_records.php';
include '../database/config.php';


date_default_timezone_set("Asia/Calcutta");
$currentdatetime = date('Y-m-d H:i:s');
// echo $currentdatetime;
?>
<!DOCTYPE html>
<html>
    
<head>
        
        <title>Trando | Student Dashboard</title>
        
      <?php include 'header.php';?>
                    <ul class="menu accordion-menu">
                        <!--<li class="active"><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>-->
                        <!--<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                        <!--<li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>-->
                        <!--<li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>-->
                        <!--<li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>-->

                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Student Dashboard</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="./index">Home</a></li>
                            <li class="active">Student Dashboard</li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <!--live classes-->
                          <div class="col-lg-4 col-md-6">
                           <a href="./">
                                <div class="panel info-box panel-white" style="background:#32a852;">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter" style="color:#fff !important;">3 </span></p>
                                        <span class="info-box-title" style="color:#fff !important;">Live Classes</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-book-open" style="color:#fff !important;"></i>
                                    </div>

                                </div>
                            </div>
                           </a>
                        </div>
                        <!--live class end-->
                           <div class="col-lg-4 col-md-6">
                           <a href="./">
                                <div class="panel info-box panel-white" style="background:#4287f5;">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter" style="color:#fff !important;">3</span></p>
                                        <span class="info-box-title" style="color:#fff !important;">Assignments</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-book-open" style="color:#fff !important;"></i>
                                    </div>

                                </div>
                            </div>
                           </a>
                        </div>
                        <!--assignments-->
                           <div class="col-lg-4 col-md-6">
                           <a href="./notes.php">
                                <div class="panel info-box panel-white" style="background:#eb4034;">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter" style="color:#fff !important;">3 </span></p>
                                        <span class="info-box-title" style="color:#fff !important;">Notes</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-book-open" style="color:#fff !important;"></i>
                                    </div>

                                </div>
                            </div>
                           </a>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 ">
                            <a href="./examinations.php?e=upc" >
                                <div class="panel info-box" style="background:#32a852;">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter " style="color:#fff !important;"><?php 
                                        
                                        $sql2 = "select * from tbl_examinations where user_id='$login_stu_teacher_id' and edate >='$currentdatetime' ";
                                        $result2 = $conn->query($sql2);
                                        
                                         $count_up_exam = 0;
                                        
                                        if($result2->num_rows>0){
                                              while($row = $result2->fetch_assoc()) {
                                               
                                               if($row['add_class'] == "" and $row['category'] == $mycategory and $row['department'] == $mydepartment){
                                                $count_up_exam++;
											 
                                           }
                                           else if($row['add_class'] != '' and (strpos($row['add_class'],$mycategory)  !== false) or ($row['category'] == $mycategory and $row['department'] == $mydepartment)){
                                               
                                              
                                               $count_up_exam++;
                                               
                                           }
                                           }
                                        }
                                        

                                        echo $count_up_exam;
                                       
                                      
                                        ?></p>
                                        <span class="info-box-title " style="color:#fff !important;">UPCOMING EXAMS</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-user " style="color:#fff !important;"></i>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6">
                           <a href="./results.php">
                                <div class="panel info-box panel-white" style="background:#4287f5;">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter" style="color:#fff !important;">
                                        <?php
                                        
                                        $sql1 = "select * from tbl_examinations where user_id='$login_stu_teacher_id'";
                                        $result1 = $conn->query($sql1);
                                        
                                        $count_exam_given = 0;
                                        
                                     
                                         if($result1->num_rows>0){
                                              while($row = $result1->fetch_assoc()) {
                                               
                                               if($row['add_class'] == "" and $row['category'] == $mycategory and $row['department'] == $mydepartment){
                                                   $exam_id = $row['exam_id'];
                                                $sql = "select * from tbl_assessment_records where student_id='$stu_id' and exam_id='$exam_id'";
        
                                                $result = $conn->query($sql);
        
        
                                                if($result->num_rows>0){
                                                $count_exam_given++;
                                        
                                        }
											 
                                           }
                                           else if($row['add_class'] != '' and (strpos($row['add_class'],$mycategory)  !== false) or ($row['category'] == $mycategory and $row['department'] == $mydepartment)){
                                               
                                              
                                                 $exam_id = $row['exam_id'];
                                        $sql = "select * from tbl_assessment_records where student_id='$stu_id' and exam_id='$exam_id'";

                                        $result = $conn->query($sql);


                                        if($result->num_rows>0){
                                        $count_exam_given++;
                                        
                                        }
                                               
                                           }
                                           }
                                        }
                                        
                                      
                                    
                                        echo $count_exam_given;
                                        
                                       
                                        
                                         ?></span></p>
                                        <span class="info-box-title" style="color:#fff !important;">EXAM RESULT</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-book-open" style="color:#fff !important;"></i>
                                    </div>

                                </div>
                            </div>
                           </a>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                           <a href="./examinations.php?e=pe">
                                <div class="panel info-box " style="background:#eb4034;">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter" style="color:#fff !important;"><?php
                                        //  echo number_format($my_subjects);
                                         
                                        $sql = "select * from tbl_examinations where user_id='$login_stu_teacher_id' and edate <='$currentdatetime' ";

                                        $result = $conn->query($sql);
                                        
                                        $count_pass_exam = 0;
                                        
                                        if($result->num_rows>0){
                                              while($row = $result->fetch_assoc()) {
                                               
                                               if($row['add_class'] == "" and $row['category'] == $mycategory and $row['department'] == $mydepartment){
                                                $count_pass_exam++;
											 
                                           }
                                           else if($row['add_class'] != '' and (strpos($row['add_class'],$mycategory)  !== false) or ($row['category'] == $mycategory and $row['department'] == $mydepartment)){
                                               
                                              
                                               $count_pass_exam++;
                                               
                                           }
                                           }
                                        }
                                        

                                        echo $count_pass_exam;
                                         
                                         ?></p>
                                        <span class="info-box-title" style="color:#fff !important;">PAST EXAMS</span>
                                    </div>
                                    <div class="info-box-icon" style="color:#fff !important;">
                                        <i class="icon-docs" style="color:#fff !important;"></i>
                                    </div>
                                </div>
                           </a>
                            </div>
                        </div>
                        
                        	<!--<div class="col-lg-3 col-md-6">-->
                        	<!--     <a href="./examinations.php?e=ae">-->
                         <!--   <div class="panel info-box panel-white" style="background:#9ddfd3;">-->
                                <!--<div class="panel-body">-->
                                    <!--<div class="info-box-stats">-->
                                        <!--<p class="counter" style="color:#fff !important;">-->
                                        <?php

                                        // $sql1 = "select * from tbl_examinations where user_id='$login_stu_teacher_id' and category='$mycategory'";

                                        // $result1 = $conn->query($sql1);
                                        // $count=0;
                                        // while($arr1 = $result1->fetch_assoc()){

                                        // $exam_id=$arr1['exam_id'];

                                        // $sql = "select * from tbl_assessment_records where student_id='$stu_id'  and exam_id='$exam_id'";

                                        // $result = $conn->query($sql);
                                        // if($result->num_rows>0){
                                        //     $count=$count+$result->num_rows;
                                        // }
                                        // }

                                       


                                        // echo $count;
                                         
                                         
                                         ?>
                                         <!--</p>-->
                                        <!--<span class="info-box-title" style="color:#fff !important;">ATTENDED EXAMS</span>-->
                                    <!--</div>-->
                                    <!--<div class="info-box-icon">-->
                                    <!--    <i class="icon-check" style="color:#fff !important;"></i>-->
                                    <!--</div>-->
                                <!--</div>-->
                        <!--    </div>-->
                        <!--    </a>-->
                        <!--</div>-->
						
						                      <!--  <div class="col-lg-3 col-md-6">-->
                            <!--<div class="panel info-box panel-white" style="background:#757FAE;">-->
                            <!--    <div class="panel-body">-->
                            <!--        <div class="info-box-stats">-->
                            <!--            <p class="counter" style="color:#fff !important;">-->
                                        <?php 
                                    //     $sql1 = "select * from tbl_examinations where user_id='$login_stu_teacher_id' and category='$mycategory'";

                                    //     $result1 = $conn->query($sql1);
                                    //     $count =0 ;
                                    //   while($arr1 = $result1->fetch_assoc()){

                                    //     $exam_id=$arr1['exam_id'];

                                    //     $sql = "select * from tbl_assessment_records where student_id='$stu_id' and status='PASS' and exam_id='$exam_id'";

                                    //     $result = $conn->query($sql);
                                    //     if($result->num_rows>0){
                                    //         $count =$count+$result->num_rows;
                                    //     }
                                    //   }

                                    //     echo $count;
                                        
                                        
                                        ?>
                        <!--                </p>-->
                        <!--                <span class="info-box-title" style="color:#fff !important;"></span>-->
                        <!--            </div>-->
                        <!--            <div class="info-box-icon">-->
                        <!--                <i class="icon-like" style="color:#fff !important;"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-3 col-md-6">-->
                        <!--    <div class="panel info-box panel-white">-->
                        <!--        <div class="panel-body">-->
                        <!--            <div class="info-box-stats">-->
                        <!--                <p class="counter">-->
                                        <?php
                                        // // echo number_format($notice);
                                        // $sql = "select * from tbl_notice where user_id='$login_stu_teacher_id'";

                                        // $result = $conn->query($sql);

                                        // echo $result->num_rows;
                                            
                                        
                                        ?>
                        <!--                </p>-->
                        <!--                <span class="info-box-title">NOTICE</span>-->
                        <!--            </div>-->
                        <!--            <div class="info-box-icon">-->
                        <!--                <i class="icon-list"></i>-->
                        <!--            </div>-->
     
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-3 col-md-6">-->
                        <!--    <div class="panel info-box panel-white">-->
                        <!--        <div class="panel-body">-->
                        <!--            <div class="info-box-stats">-->
                        <!--                <p><span class="counter">-->
                                        <?php
                                        
                                    //     $sql = "select * from tbl_assessment_records where student_id='$stu_id' and status='FAIL'";

                                    //     $result = $conn->query($sql);
                                    //     $count=0;
                                        
                                    //   while($arr1 = $result->fetch_assoc()){
                                        
                                    //     $id = $arr1['exam_id'];
                                        
                                    //     $sql2 = "select * from tbl_examinations where exam_id='$id' and category='$mycategory' and user_id='$login_stu_teacher_id'";
                                        
                                    //     $result2 = $conn->query($sql2);
                                    //     if($result2->num_rows>0){
                                    //         $count=$count+$result2->num_rows;
                                    //     }
                                        
                                    //   }

                                    //     echo $count;
                                        
                                         
                                         
                                         ?>
                        <!--                 </span></p>-->
                        <!--                <span class="info-box-title">FAILED EXAMS</span>-->
                        <!--            </div>-->
                        <!--            <div class="info-box-icon">-->
                        <!--                <i class="icon-dislike"></i>-->
                        <!--            </div>-->

                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-lg-3 col-md-6">-->
                        <!--    <div class="panel info-box panel-white">-->
                        <!--        <div class="panel-body">-->
                        <!--            <div class="info-box-stats">-->
                        <!--                <p class="counter">-->
                                        <?php 
                                        // echo number_format($locked_exams); 
                                        // $sql = "select * from tbl_examinations where user_id='$$login_stu_teacher_id' and status='inactive'";

                                        // $result = $conn->query($sql);

                                        // echo $result->num_rows;   
                                        
                                        
                                        ?>
                        <!--                </p>-->
                        <!--                <span class="info-box-title">LOCKED EXAMS</span>-->
                        <!--            </div>-->
                        <!--            <div class="info-box-icon">-->
                        <!--                <i class="icon-lock"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
						
					
						
						                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Notice</h4>
                                </div>
                                <div class="panel-body">
                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                            <?php
							include '../database/config.php';
							include 'includes/check_user.php';
							$sql = "SELECT * FROM tbl_notice where user_id='$login_stu_teacher_id' and category='$mycategory' ORDER by id DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                           $tabno = 1;
                            while($row = $result->fetch_assoc()) {
                            print '
							<div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading'.$tabno.'">
                            <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$tabno.'" aria-expanded="false" aria-controls="collapse'.$tabno.'">
                            '.$row['title'].'
                            </a>
                            </h4>
                            </div>
                            <div id="collapse'.$tabno.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$tabno.'">
                            <div class="panel-body">
                            '.$row['description'].'
							<hr><i class="fa fa-calendar"></i> '.$row['post_date'].' | <i class="fa fa-refresh"></i> '.$row['last_update'].'
                            </div>
                            </div>
                            </div>';
					       $tabno++;
                             }
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
        </main>

        <div class="cd-overlay"></div>
        
        
        <script>

            
        </script>
	
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