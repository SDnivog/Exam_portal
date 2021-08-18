<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Trando | Manage Results</title>
        
        <?php include'header.php'; ?>
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
                    <h3>Manage Results</h3>

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
										   $sql = "SELECT * FROM tbl_examinations where user_id='$login_user_id'";
                                           $result = $conn->query($sql);

                                           if ($result->num_rows > 0) {
										print '
										<table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
												<th>Class</th>
											
                                                <th>Date</th>
                                                <th>Duration</th>
                                                <th>Total Marks</th>
<th>Cut-off</th>
												<th>RE Exam</th>
												<th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
												<th>Class</th>
											
                                                <th>Date</th>
                                                <th>Duration</th>
												<th>Total Marks</th>
<th>Cut-off</th>
												<th>RE Exam</th>
												<th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>';
                                        
                                        $sno=1;
     
                                           while($row = $result->fetch_assoc()) {
                                                $examid = $row['exam_id'];
                                               $sql2 = "select * from tbl_assessment_records where exam_id='$examid'";
                                               $result2 = $conn->query($sql2);
                                               if($result2->num_rows>0){
											   $status = $row['status'];
											   if ($status == "Active") {
											   $st = '<p class="text-success">ACTIVE</p>';
											   $stl = '<a href="pages/make_ex_in.php?id='.$row['exam_id'].'">Make Inactive</a>';
											   }else{
											   $st = '<p class="text-danger">INACTIVE</p>'; 
                                               $stl = '<a href="pages/make_ex_ac.php?id='.$row['exam_id'].'">Make Active</a>';											   
                                               }
                                              
                                               $sqltotal = "select * from tbl_questions where exam_id='$examid'
                                               and user_id='$login_user_id'";

                                               $runsql = $conn->query($sqltotal);
                                               $totalmarks = 0;
                                               while($arr = $runsql->fetch_assoc()){
                                                   $marks = $arr['pos_marks'];
                                                   $totalmarks += $marks;

                                               }



                                          print '
										       <tr>
										        <td>'.$sno.'</td>
                                                <td>'.$row['exam_name'].'</td>
												<td>'.$row['category'].'</td>
                                                <td>'.$row['date'].'</td>
												<td>'.$row['duration'].'<b> min.</b></td>
                                                <td>'.$totalmarks.'</td>
                                                <td>'.$row['cutoff_marks'].'</td>
												<td>'.$row['re_exam'].'<b> day(s)</b></td>
												<td>'.$st.'</td>
                                                <td><div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    Select Action
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">';
                                                    if($row['result_type']=="manual" and $row['result_status'] == 0){
                                                        print '<li><a href="update_result.php?exam_id='.$row['exam_id'].'">Show Result To Students</a></li>';
                                                    }
                                                    else if($row['result_type']=="manual" and $row['result_status'] == 1){
                                                        print '<li><a href="update_result.php?exam_id_hide='.$row['exam_id'].'">Hide Result From Students</a></li>';
                                                    }

												print '<li><a href="view-results.php?eid='.$row['exam_id'].'">View Results</a></li>
									                <li><a href="summary.php?eid='.$row['exam_id'].'">Short Summary</a></li>
									                <li><form method="post" action="excel/result.php?exam_id='.$row['exam_id'].'">
     <input type="submit" name="export" class="btn btn-success" style="" value="Download excel" />
    </form> </li>
													
                                                </ul>
                                            </div></td>
          
                                            </tr>';
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