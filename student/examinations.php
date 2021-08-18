<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';

if(isset($_GET['e'])){
    $examrep=$_GET['e'];
}

?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Kendel | My Examinations</title>
        
       <?php include 'header.php';?>
       <!--<ul class="menu accordion-menu">-->
       <!--                 <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>-->
       <!--                 <li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
       <!--                 <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>-->
       <!--                 <li class="active"><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>-->
       <!--                 <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>-->

       <!--             </ul>-->
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>My Examinations</h3>
                      <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="./index">Home</a></li>
                            <li class="active"><?php echo "Exams"; ?></li>
                        </ol>
                    </div>
<?php 
date_default_timezone_set("Asia/Calcutta");
$currentdatetime=date("Y-m-d H:i:s");
// $currentdate=date("Y-m-d");
?>

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
										   if($examrep=="upc"){
										   $sql = "SELECT * FROM tbl_examinations WHERE user_id='$login_stu_teacher_id' and edate >= '$currentdatetime'   ORDER BY edate desc";
                                           $result = $conn->query($sql);
										   }
										   else if($examrep=="pe"){
										   $sql = "SELECT * FROM tbl_examinations WHERE user_id='$login_stu_teacher_id' and edate < '$currentdatetime'  ORDER BY edate desc";
                                           $result = $conn->query($sql);
										   }
										 
                                           if ($result->num_rows > 0) {
										print '
										<table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
											
												<th>Deadline</th>
												 <th>Schedual</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>Sr.No</th>
                                                <th>Name</th>
										
												<th>Deadline</th>
												 <th>Schedual</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                              
                                            </tr>
                                        </tfoot>
                                        <tbody>';
                                        $sno=1;
     
                                           while($row = $result->fetch_assoc()) {
                                               
                                               if($row['add_class'] == "" and $row['category'] == $mycategory and $row['department'] == $mydepartment){
                                                
											   $status = $row['status'];
											   if ($status == "Active") {
											   $st = '<p class="text-success">ACTIVE</p>';
											   $stl = '<a class="btn btn-success" href="take-assessment.php?id='.$row['exam_id'].'">Take Assessment</a>';
											   }else{
											   $st = '<p class="text-danger">INACTIVE</p>'; 
                                               $stl = '<a class="btn btn-danger disabled" href="#">Take Assessment</a>';											   
											   }
                                          print '
										       <tr>
										        <td>'.$sno.'</td>
                                                <td>'.$row['exam_name'].'</td>
										
                                                <td>'.$row['date'].'</td>
                                                <td>'.$row['edate'].'</td>
                                                <td>'.$st.'</td>
                                                <td>'.$stl.'</td>
          
                                            </tr>';
                                            $sno++;
                                           }
                                           else if($row['add_class'] != '' and (strpos($row['add_class'],$mycategory)  !== false) or ($row['category'] == $mycategory and $row['department'] == $mydepartment)){
                                               
                                               $status = $row['status'];
											   if ($status == "Active") {
											   $st = '<p class="text-success">ACTIVE</p>';
											   $stl = '<a class="btn btn-success" href="take-assessment.php?id='.$row['exam_id'].'">Take Assessment</a>';
											   }else{
											   $st = '<p class="text-danger">INACTIVE</p>'; 
                                               $stl = '<a class="btn btn-danger disabled" href="#">Take Assessment</a>';											   
											   }
                                          print '
										       <tr>
										       <td>'.$sno.'</td>
                                                <td>'.$row['exam_name'].'</td>
											
                                                <td>'.$row['date'].'</td>
                                                  <td>'.$row['edate'].'</td>
                                                <td>'.$st.'</td>
                                                <td>'.$stl.'</td>
          
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
		

		<script>
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>