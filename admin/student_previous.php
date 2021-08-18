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
                        <li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>
                        <li class="active"><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!--<li><a href="questions_bank.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Question Bank</p></a></li>-->
                        <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
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
                                                <?php 
                                               
                                                $sql5 = "select * from tbl_categories where user_id='$login_user_id'";
                                                $result5 = $conn->query($sql5);
                                               
                                                $i=2;
                                                if($result5->num_rows>0){
                                                while($row_categories5 = $result5->fetch_assoc()){
                                                   
                                                ?>

                                                <li role="presentation" class="<?php if($i==2){ echo "active"; } ?>"><a href="#tab<?php echo $i; ?>" role="tab" data-toggle="tab"><?php echo $row_categories5['name']; ?></a></li>
                                                <?php $i++;
                                                    
                                                } 
                                                    
                                                }
                                                ?>
                                               
                                               
                                                <li role="presentation"><a href="#tab1" role="tab" data-toggle="tab">Add Students</a></li>										
												<li role="presentation"><a href="#tab0" role="tab" data-toggle="tab">Add Multiple Students</a></li>
						

                                            </ul>
                                    <div class="tab-content">
                                           
                                            <?php
                                             $sql6 = "select * from tbl_categories where user_id='$login_user_id'";
                                             $result6 = $conn->query($sql6);
                                             $i=2;
                                           
                                                while($row_categories6 = $result6->fetch_assoc()){
                                                    $category = $row_categories6['name'];
                                            
                                            ?> 
                                                <div role="tabpanel" class="tab-pane <?php if($i==2){ echo "active fade in"; } ?>" id="tab<?php echo $i; ?>">
                                           <div class="table-responsive">
										   <?php
										   include '../database/config.php';
										   
										   $sql_test = "select * from tbl_account where teacher_id = '$login_user_id' and category ='$category'";
										   
										   $result_test = $conn->query($sql_test);
										   
										   
									if ($result_test->num_rows > 0) {
										print '
										<table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
												<th>Gender</th>
											
                                                <th>Status</th>
                                                <th>Date of Birth</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
												<th>Gender</th>
											
                                                <th>Status</th>
                                                <th>Date of Birth</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>';
                                        $sno=1;
                                       
     
                                           while($row1 = $result_test->fetch_assoc()) {
                                               $stu_id = $row1['student_id'];
                                                $sql = "SELECT * FROM tbl_users WHERE user_id='$stu_id' order by first_name";
                                                $result = $conn->query($sql);
                                                $row = $result->fetch_assoc();
											   
											   $status = $row['acc_stat'];
											   if ($status == "1") {
											   $st = '<p class="text-success">ACTIVE</p>';
											   $stl = '<a href="pages/make_sd_in.php?id='.$row['user_id'].'">Make Inactive</a>';
											   }else{
											   $st = '<p class="text-danger">INACTIVE</p>'; 
                                               $stl = '<a href="pages/make_sd_ac.php?id='.$row['user_id'].'">Make Active</a>';											   
											   }
                                          print '
										       <tr>
										       	<td>'.$sno.'</td>
                                                <td>'.$row['first_name'].' '.$row['last_name'].'</td>
												<td>'.$row['gender'].'</td>
                                              
                                                <td>'.$st.'</td>
												<td>'.$row['dob'].'</td>
                                                <td><div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    Select Action
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>'.$stl.'</li>
													<li><a href="edit-student.php?sid='.$row['user_id'].'">Edit Student</a></li>
													<li><a href="view-student.php?sid='.$row['user_id'].'">View Student</a></li>
                                                    <li><a'; ?> onclick = "return confirm('Drop <?php echo $row['first_name']; ?> ?')" <?php print ' href="pages/drop_sd.php?id='.$row['user_id'].'">Drop Student</a></li>
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

<form method="post" action="excel/student.php">
     <input type="submit" name="export" class="btn btn-success" style="float: right;" value="Download all Students" />
    </form>

                 
   </div>
                                 
                                                       
                                                </div>
                                                <?php $i++;
                                                } 
                                                ?>
                                                <div role="tabpanel" class="tab-pane fade" id="tab1">
                                         <form action="pages/add_student.php" method="POST">
										<div class="form-group">
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input type="text" class="form-control" placeholder="Enter first name" name="fname" required autocomplete="off">
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputEmail1">Last Name</label>
                                            <input type="text" class="form-control" placeholder="Enter last name" name="lname" required autocomplete="off">
                                        </div>
										<div class="form-group">
										  <label for="exampleInputEmail1">Male</label>
                                            <input type="radio"  name="gender" value="Male" required>
                                            <label for="exampleInputEmail1">Female</label>
                                            <input type="radio" name="gender" value="Female" required>
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputEmail1">Email Address</label>
                                            <input type="email" class="form-control" placeholder="Enter email address" name="email" required autocomplete="off">
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputEmail1">Phone</label>
                                            <input type="text" class="form-control" placeholder="Enter phone" name="phone" required autocomplete="off">
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputEmail1">Select Stream</label>
                                            <select class="form-control" name="department" onchange="FetchCategory(this.value)" required>
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
										
										<div class="form-group">
                                            <label for="exampleInputEmail1">Select Class</label>
                                            <select class="form-control" name="category" id="categroy" required>
											<option value="" selected disabled>-Select Class-</option>
											
											</select>
                                        </div>
										
									<div class="form-group">
                                    <label >Date of Birth</label>
                                    <input type="text" class="form-control date-picker" name="dob" required autocomplete="off" placeholder="Select date of birth">
                                    </div>
									
									<div class="form-group">
                                            <label for="exampleInputEmail1">Address</label>
                                            <textarea style="resize: none;" rows="4" class="form-control" placeholder="Enter address" name="address" required autocomplete="off"></textarea>
                                     </div>


                                        <button type="submit" class="btn btn-primary">Submit</button>
                                       </form>
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                
                                                  <div role="tabpanel" class="tab-pane fade" id="tab0">
                                         <form action="pages/add_multiple_student.php" method="POST" enctype="multipart/form-data">
                                             <a href="Upload/image.png" target="_blank">Click Here To View Excel Format Of Student</a>
										<div class="form-group">
                                            <label for="exampleInputEmail1">Updoad File</label>
                                            <input type="file" class="form-control"  name="excelfile" required autocomplete="off" multiple>
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
        
		<?php if ($ms == "1") {?>
		<div class="alert alert-success" id="snackbar"><?php echo "$description"; ?></div> 
		<?php	}else{
		    
		}
?>

        <div class="cd-overlay"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
		
		
function myFunction(){
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
		
		
		
		
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







</script>
    </body>

</html>