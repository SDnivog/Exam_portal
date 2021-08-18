<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Trando | Manage Students</title>
       <?php include'header.php'; ?>
                    <ul class="menu accordion-menu">
                        <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Streams</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Classes</p></a></li>
                        <!--<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                        <li class="active"><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <!--<li><a href="liveclass.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Live Class</p></a></li>-->
                        <li ><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!--<li ><a href="assignment.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Assignments</p></a></li>-->
                        <!--<li ><a href="material.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Notes</p></p></a></li>-->
                        <li ><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <!--<li><a href="doubts.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Doubts</p></a></li>-->
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>


                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Manage Students</h3>



                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
						<div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <div role="tabpanel">
                                   
                                            <ul class="nav nav-tabs" role="tablist">
			
                                                <li role="presentation" class="active"><a href="#tab5" role="tab" data-toggle="tab">Students</a></li>
                                               
                                                <li role="presentation"><a href="#tab6" role="tab" data-toggle="tab">Add Students</a></li>	
                                                <li role="presentation"><a href="#tab7" role="tab" data-toggle="tab">Add Multiple Students</a></li>

                                            </ul>
                                    
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active fade in" id="tab5">
                                           <div class="table-responsive">
										   <?php
										   include '../database/config.php';
										   $sql = "SELECT * FROM tbl_account WHERE teacher_id='$login_user_id'";
                                           $result = $conn->query($sql);

                                           if ($result->num_rows > 0) {
										print '
										<table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
												<th>Gender</th>
												<th>Class</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
												<th>Gender</th>
												<th>Class</th>
                                                <th>Status</th>
                                                 <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>';
                                        $sno=1;
     
                                           while($row1 = $result->fetch_assoc()) {
                                                $student_id = $row1['student_id'];
                                               
                                               $sql2 = "select * from tbl_users where user_id= '$student_id'";
                                               
                                               $result2 = $conn->query($sql2);
                                               
                                               $row = $result2->fetch_assoc();
											   
											   $status = $row1['acc_status'];
											   if ($status == "1") {
											   $st = '<p class="text-success">ACTIVE</p>';
											   $stl = '<a href="pages/make_sd_in.php?id='.$row1['student_id'].'&cl='.$row1['category'].'&dp='.$row1['department'].'&tc='.$row1['teacher_id'].'">Make Inactive</a>';
											   }else{
											   $st = '<p class="text-danger">INACTIVE</p>'; 
                                               $stl = '<a href="pages/make_sd_ac.php?id='.$row1['student_id'].'&cl='.$row1['category'].'&dp='.$row1['department'].'&tc='.$row1['teacher_id'].'">Make Active</a>';
											   }
                                          print '
										       <tr>
										       	<td>'.$sno.'</td>
                                                <td>'.$row['first_name'].' '.$row['last_name'].'</td>
												<td>'.$row['gender'].'</td>
                                                <td>'.$row1['category'].'</td>
                                                <td>'.$st.'</td>
                                                <td><div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    Select Action
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>'.$stl.'</li>
													<li><a href="edit-student.php?sid='.$row['user_id'].'">Edit Student</a></li>
													<li><a href="view-student.php?sid='.$row['user_id'].'">View Student</a></li>
                                                    <li><a'; ?> onclick = "return confirm('Drop <?php echo $row['first_name']; ?> ?')" <?php print ' href="pages/drop_sd.php?id='.$row1['student_id'].'&cl='.$row1['category'].'&dp='.$row1['department'].'&tc='.$row1['teacher_id'].'">Drop Student</a></li>
                                                </ul>
                                            </div></td>
          
                                            </tr>';
                                            $sno++;
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
                                                <div role="tabpanel" class="tab-pane fade" id="tab6">
                                         <form action="pages/add_student.php" method="POST">
                                             
                                             <div class="form-row">
                                                 <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input type="text" class="form-control" placeholder="Enter first name" name="fname" required autocomplete="off">
                                        </div>
										<div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Last Name</label>
                                            <input type="text" class="form-control" placeholder="Enter last name" name="lname" required autocomplete="off">
                                        </div>
                                        	<div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Phone</label>
                                            <input type="text" class="form-control" placeholder="Enter phone" name="phone" required autocomplete="off">
                                        </div>
                                                 
                                             </div>
                                             <div class="form-row">  
                                             	<div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Email Address</label>
                                            <input type="email" class="form-control" placeholder="Enter email address" name="email" required autocomplete="off">
                                        </div>
									
										<div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Select Streamt</label>
                                            <select class="form-control" name="department" onchange="FetchCategory(this.value)"  required>
											<option value="" selected disabled>-Select Stream-</option>
											<?php
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_departments WHERE user_id='$login_user_id' and status = 'Active' ORDER BY name";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
    
                                            while($row = $result->fetch_assoc()) {
                                            print '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                            }
                                           } else {
                          
                                            }
                                             $conn->close();
											 ?>
											
											</select>
                                        </div>
										
										<div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Select Class</label>
                                            <select class="form-control" name="category" id="categroy" required>
											<option value="" selected disabled>-Select Class-</option>
										
											
											</select>
                                        </div>
										
										</div>
										<div class="form-row">
										    
										    <div class="form-group col-md-12">
										        <label for="exampleInputEmail1">Your Gender</label> <br>
										  <label for="exampleInputEmail1">Male</label>
                                            <input type="radio"  name="gender" value="Male" required>
                                            <label for="exampleInputEmail1">Female</label>
                                            <input type="radio" name="gender" value="Female" required>
                                        </div>
										</div>
									
								


                                        <button type="submit" class="btn btn-primary">Submit</button>
                                       </form>
                                                </div>
                                                
                                                   <div role="tabpanel" class="tab-pane fade" id="tab7">
                                         <form action="pages/add_multiple_student.php" method="POST" enctype="multipart/form-data">
                                             <a href="Upload/image.png" target="_blank">Click Here To View Excel Format Of Student</a>
										<div class="form-group">
                                            <label for="exampleInputEmail1">Updoad File</label>
                                            <input type="file" class="form-control"  name="excelfile" required autocomplete="off">
                                        </div>
									
										
								


                                        <button type="submit" class="btn btn-primary">Submit</button>
                                       </form>
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                

                                            </div>
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
		function FetchCategory(CategoryFetch){
  
  $.ajax({
      url:'category-fetch.php',
      type:'post',
      data:{
          CategoryFetch:CategoryFetch
      },
      success:function(data){
         $('#categroy').html(data); 
      }
  })
  
  
  }
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>