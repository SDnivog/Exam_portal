<?php include 'includes/check_user.php'; 
include 'includes/fetch_records.php';
include '../database/config.php';
?>
<!DOCTYPE html>
<html>
    
<head>
        
        <title>Kendel | Admin Dashboard</title>
        
        <?php include 'header.php'; ?>
                    <ul class="menu accordion-menu" >
                        <li class=""><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Streams</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Classes</p></a></li>
                        <!--<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                         <!--<li><a href="liveclass.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Live Class</p></a></li>-->
                        <li ><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!--<li ><a href="assignment.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Assignments</p></a></li>-->
                        <!--<li ><a href="material.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Notes</p></p></a></li>-->
                        <li ><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <!--<li ><a href="doubts.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Doubts</p></a></li>-->
                        <li ><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
                        
                       


                    </ul>
                </div>
            </div>
            <div class="page-inner" >
            <div class="content"></div>
                <div class="page-title">
                    <h3>Admin Dashboard</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="./index">Home</a></li>
                            <li class="active">Admin Dashboard</li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                           <a href="./departments.php">
                                <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?php
                                        //  echo number_format($departments); 
                                         $sql = "select * from tbl_departments where user_id='$login_user_id'";
                                         $result = $conn->query($sql);
                                         $count = $result->num_rows;
                                         echo $count;
                                     ?> </p>
                                        <span class="info-box-title">STREAMS</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-folder"></i>
                                    </div>
                                </div>
                            </div>
                           </a>
                        </div>
                        
                        
                        <div class="col-lg-3 col-md-6">
                           <a href="./students.php">
                                <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?php 
                                        // echo number_format($students); 
                                        // $sql = "select * from tbl_users where teacher_id='$login_user_id' and role='student'";
                                        //  $result = $conn->query($sql);
                                        //  $count = $result->num_rows;
                                        //  echo $count;
                                        
                                        $sql = "select DISTINCT student_id from tbl_account where teacher_id='$login_user_id'";
                                        $result = $conn->query($sql);
                                        
                                        $count = $result->num_rows;
                                        
                                        echo $count;
                                     
                                     
                                        ?></p>
                                        <span class="info-box-title">STUDENTS</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-user"></i>
                                    </div>
     
                                </div>
                            </div>
                           </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="./examinations.php">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter"><?php 
                                        // echo number_format($examination); 
                                        $sql = "select * from tbl_examinations where user_id='$login_user_id'";
                                        $result = $conn->query($sql);
                                        $count = $result->num_rows;
                                        echo $count;
                                        ?></span></p>
                                        <span class="info-box-title">QUIZ/EXAMS</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-book-open"></i>
                                    </div>

                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                           <!--<a href="./subject.php">-->
                                <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?php 
                                        // echo number_format($subjects); 
                                        // $sql = "select * from tbl_subjects where user_id='$login_user_id'";
                                        // $result = $conn->query($sql);
                                        // $count = $result->num_rows;
                                        echo "5";
                                        ?></p>
                                        <span class="info-box-title">ASSIGNMENTS</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-docs"></i>
                                    </div>
                                </div>
                            </div>
                           <!--</a>-->
                        </div>
						<div class="col-lg-3 col-md-6">
                           <a href="./categories.php">
                                <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?php 
                                        // echo number_format($categories); 
                                        $sql = "select * from tbl_categories where user_id='$login_user_id'";
                                        $result = $conn->query($sql);
                                        $count = $result->num_rows;
                                        echo $count;
                                        
                                        ?></p>
                                        <span class="info-box-title">CLASSES<?php echo "$fp $pp"; ?></span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-tag"></i>
                                    </div>
                                </div>
                            </div>
                           </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?php 
                                        // echo number_format($notice); 
                                        $sql = "select * from tbl_notice where user_id='$login_user_id'";
                                        $result = $conn->query($sql);
                                        $count = $result->num_rows;
                                        echo $count;
                                        
                                        ?></p>
                                        <span class="info-box-title">NOTICE</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-list"></i>
                                    </div>
     
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p><span class="counter"><?php
                                        //  echo number_format($questions);
                                        // $sql = "select * from tbl_questions where user_id='$login_user_id'";
                                        // $result = $conn->query($sql);
                                        // $count = $result->num_rows;
                                        echo "5";
                                         ?></span></p>
                                        <span class="info-box-title">LIVE CLASSES</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-question"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panel-white">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                        <p class="counter"><?php
                                        //  echo number_format($banned_students); 
                                        $sql = "select * from tbl_users where teacher_id='$login_user_id' and role='student' and acc_stat ='0'";
                                        $result = $conn->query($sql);
                                        $count = $result->num_rows;
                                        echo $count;
                                         ?></p>
                                        <span class="info-box-title">BANNED STUDENTS</span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i class="icon-lock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="visitors-chart">
                                            <div class="panel-body">
                                            <div id="chartContainer"  style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
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
		<!--<script src="js/examstatus.js"></script>-->
		 <script>
		 

		 
		 
		 
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1", 
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "Piechart Presentation of students assessments in FAIL and PASS"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 14,
		indexLabel: "{label} - {y}",
		dataPoints: [
            { y: <?php 
                  
                    $sql1 = "select * from tbl_account where teacher_id='$login_user_id'";
                    $result1= $conn->query($sql1);
                    $count=0;
                 
                    while($row = $result1->fetch_assoc()){
                        $stu_id = $row['student_id'];
                        $sql = "select * from tbl_assessment_records where student_id = '$stu_id' and status='PASS'";
                        $result = $conn->query($sql);
                      
                        if($result->num_rows>0){
                            $count++;
                        }
    
                       
                    }
                    
                
                    
                    echo $count;
                    
                  
                  
                    
                    ?>, label: "Student Passing Exams" },
            { y: <?php 
         
                    $sql1 = "select * from tbl_account where teacher_id='$login_user_id'";
                    $result1= $conn->query($sql1);
                    $count1=0;
                    while($row = $result1->fetch_assoc()){
                        $stu_id = $row['student_id'];
                        $sql2 = "select * from tbl_assessment_records where student_id = '$stu_id' and status='FAIL'";
                        $result2 = $conn->query($sql2);
                        if($result->num_rows>0){
                            $count1++;
                        }
    
                    }
                    echo $count1;
            
            
            
            ?>, label: "Student Failing Exams" }

		]
	}]
});
chart.render();

}
</script>
        
    </body>


</html>