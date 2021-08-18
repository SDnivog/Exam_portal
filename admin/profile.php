<?php include 'includes/check_user.php'; 
include 'includes/check_reply.php';
$qrcodetxt = 'ID:'.$myid.', NAME: '.$myfname.' '.$mylname.', GENDER: '.$mygender.', DEPARTMENT : Administration';
?>
<!DOCTYPE html>
<html>
    
<head>
        
        <title>Trando | Admin Profile</title>
        
     <?php include 'header.php';  ?>
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
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>


                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Admin Profile</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="./">Home</a></li>
                            <li class="active">Admin Profile</li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                      <div class="row">
                        <div class="col-md-12">
						<div class="row">
                            <div class="col-md-5">

                                <div class="panel panel-white">
                                    <div class="panel-body">
									<div class="col-md-6">
                                <?php 
						        if ($myavatar == NULL) {
						        print' <img class="img-responsive" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
						        }else{
						        echo '<img src="data:image/jpeg;base64,'.base64_encode($myavatar).'" class="img-responsive"  alt="'.$myfname.'"/>';	
						        }
						
						        ?></div>
								<div class="col-md-6">
						        <?php print '<img width="150" src="../assets/qrcode/qr_img.php?d='.$qrcodetxt.'">'; ?>
						        </div>
								
                                    </div>
									<table class="table">
									<form action="pages/update_profile.php" method="POST">
                                        <tbody>
                                        <tr>
                                                <th scope="row">1</th>
                                                <td>Teacher Code</td>
                                                <td>
												<input type="text" value="<?php echo "$login_user_id"; ?>" class="form-control" name="fname" disabled> 
												</td>
                                                
                                            </tr>
     
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>First Name</td>
                                                <td>
												<input type="text" value="<?php echo "$myfname"; ?>" class="form-control" name="fname" placeholder="Enter first name" required autocomplete="off"> 
												</td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Last Name</td>
                                                <td><input type="text" value="<?php echo"$mylname"; ?>" class="form-control" name="lname" placeholder="Enter last name" required autocomplete="off"> </td>
                                               
                                            </tr>
                                           
											<tr>
                                                <th scope="row">4</th>
                                                <td>Gender</td>
                                                <td>
												<select name="gender" required class="form-control">
												<option selected disbaled value="">-Select gender-</option>
												<option <?php if($mygender == "Male"){ print ' selected '; } ?> value="Male">Male</option>
												<option <?php if($mygender == "Female"){ print ' selected '; } ?>value="Female">Female</option>
												</select>
							                    </td>
                                               
                                            </tr>
											<tr>
                                                <th scope="row">5</th>
                                                <td>Date of birth</td>
                                                <td><input type="text" value="<?php echo "$mydob"; ?>"  class="form-control" name="dob" placeholder="mm/dd/YYYY" required autocomplete="off"> </td>
                                               
                                            </tr>

											<tr>
                                                <th scope="row">6</th>
                                                <td>Email Address</td>
                                                <td><input type="email" value="<?php echo "$myemail"; ?>"  class="form-control" name="email" placeholder="Enter email address" required autocomplete="off"> </td>
                                               
                                            </tr>
											<tr>
                                                <th scope="row">7</th>
                                                <td>Phone Number</td>
                                                <td><input type="text" value="<?php echo "$myphone"; ?>" class="form-control" name="phone" placeholder="Enter phone number" required autocomplete="off"> </td>
                                               
                                            </tr>
											<tr>
                                                <th scope="row"></th>
                                                <td colspan="2"><button type="submit" class="btn btn-primary">Save Changes</button></td>
                         
                                               
                                            </tr>
                                            </form>
                                        </tbody>
                                    </table>
                                </div>  
  
                            </div>
                             <div class="col-md-7">

                                <div class="panel panel-white">
                                    <div class="panel-body">
									<h3>Details Of Coins</h3>
									<?php
									
									$sql = "select * from tbl_users where user_id='$login_user_id'";
									
									$result = $conn->query($sql);
									
									$row = $result->fetch_assoc();
									
									$refer_code = $row['your_refer'];
									?>
			                            
			                           <div class="form-group">
			                               <label>Your Referal Code:</label>
			                               <input type="text" class="form-control" value="<?php echo $refer_code; ?>" disabled>
			                               
			                           </div>
			                           
			                           <h3>Total Coins : <?php echo $row['coins'];  ?></h3>
			                           
			                           <a href="plancard.php" class="btn btn-primary">Buy Coins</a>
			                           
			                           
			                           
									
                             </div></div></div>
							
							<div class="col-md-7">

                                <div class="panel panel-white">
                                    <div class="panel-body">
									<h3>Update display picture</h3>
			                    <form id="prof" action="pages/new_dp.php" method="POST" enctype="multipart/form-data">
								<div class="form-group">
                                <label for="exampleInputEmail1">Select image to upload</label>
                                <input type="file" id="snipped" name="image" accept="image/*" required autocomplete="off">
                                </div>
								<button type="submit" class="btn btn-primary">Upload</button>
								<?php 
						        if ($myavatar == NULL) {
						        
						        }else{
						        print '<a';?> onclick="return confirm('Delete image ?')" <?php print ' class="btn btn-danger" href="pages/drop_dp.php">Delete Image</a>'; 
						        }
						
						        ?>
								</form>
									
                             </div></div></div>
                             
                             
                             
							 
							 
							 	<div class="col-md-7">

                                <div class="panel panel-white">
                                    <div class="panel-body">
									<h3>Update login password</h3>
			                    <form action="pages/new_pw.php" method="POST">
								<div class="form-group">
                                <label for="exampleInputEmail1">Enter new password</label>
                                <input type="password" id="password" class="form-control" name="pass1" required placeholder="Enter new password">
                                </div>
								
								<div class="form-group">
                                <label for="exampleInputEmail1">Confirm new password</label>
                                <input type="password" id="confirm_password" class="form-control" name="pass2" required placeholder="Confirm new password">
                                </div>
								<button type="submit" class="btn btn-primary">Change Password</button>
								<script>
	                                        var password = document.getElementById("password")
                                           , confirm_password = document.getElementById("confirm_password");

                                           function validatePassword(){
                                            if(password.value != confirm_password.value) {
                                           confirm_password.setCustomValidity("Passwords Don't Match");
                                           } else {
                                           confirm_password.setCustomValidity('');
                                            }
                                               }

                                            password.onchange = validatePassword;
                                            confirm_password.onkeyup = validatePassword;
                                 </script>
								</form>
									
                             </div></div></div>
							
							
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
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

    const form = document.getElementById("prof");
const fileInput = document.getElementById("snipped");

fileInput.addEventListener('change', () => {
  form.submit();
});

window.addEventListener('paste', e => {
  fileInput.files = e.clipboardData.files;
});
</script>
        
    </body>


</html>