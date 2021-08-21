<?php include 'includes/check_user.php'; 
include 'includes/fetch_records.php';

?>
<!DOCTYPE html>
<html>
    
<head>
        
        <title>Trando | Students</title>
        
       <?php include 'header.php';?>
                    <!--<ul class="menu accordion-menu">-->
                    <!--    <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>-->
                    <!--    <li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                    <!--    <li class="active"><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>-->
                    <!--    <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>-->
                    <!--    <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>-->

                    <!--</ul>-->
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Students In My Class</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="./index">Home</a></li>
                            <li class="active">Students In My Class</li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                            <div class="panel-body">
							<?php
							include '../database/config.php';
							
						
                            
                            $sql2 = "select * from tbl_account where teacher_id='$login_stu_teacher_id' and department = '$mydepartment' and category='$mycategory'";
                            
                            $result2 = $conn->query($sql2);
                            
                           

                            if ($result2->num_rows > 0) {
   
                             while($row = $result2->fetch_assoc()) {
                                 $id = $row['student_id'];
                                 $sql = "SELECT * FROM tbl_users WHERE user_id='$id'";
                                 $result = $conn->query($sql);
                                 $arr = $result->fetch_assoc();
								 $user_avatar = $arr['avatar'];
								 $user_gender = $arr['gender'];
                             print '
							<div class="search-item clearfix">
                            <div class="pull-left m-r-md">
							';
							 if ($user_avatar == NULL) {
						        print' <img class="img-circle" width="80" src="../assets/images/'.$user_gender.'.png" alt="'.$row['first_name'].'">';
						        }else{
						        echo '<img src="data:image/jpeg;base64,'.base64_encode($user_avatar).'" class="img-circle" width="80"  alt="'.$row['first_name'].'"/>';	
						        }
							print '	
                          
                            </div>
                            <h3 class="no-m m-t-xs"><a href="javascript:void(0);">'.$arr['first_name'].' '.$arr['last_name'].'</a></h3>
                            <p>'.$user_gender.'</p>
                           </div>';
                             }
                             }
                           
                            
                             
                             else {
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