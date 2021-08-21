<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';

?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Trando | Manage Classes</title>
        <style>
            #student_work{
                /*border:1px solid black;*/
                box-shadow:0px 0px 4px 4px rgba(0,0,0,0.1);
                padding:25px;
                background:white;
            }
        </style>
        
     <?php include'header.php'; ?>
     
                    <ul class="menu accordion-menu">
                        <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Streams</p></a></li>
                        <li class="active"><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Classes</p></a></li>
                        <!--<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                       <!--<li><a href="liveclass.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Live Class</p></a></li>-->
                        <li ><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!--<li ><a href="assignment.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Assignments</p></a></li>-->
                        <!--<li ><a href="material.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Notes</p></p></a></li>-->
                        <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <!--<li ><a href="doubts.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Doubts</p></a></li>-->
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>


                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Students Works</h3>



                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
						<div class="row">
                            <div class="col-md-12">

                               
                                       <div id="student_work">
                                           <div class="assign_details" style="margin-bottom:25px;">
                                               <h2 style="padding-left:2rem;">Subject Name</h2>
                                               <div style="display:flex;padding-left:2rem;">
                                                   <div style="border-right:2px solid black;text-align:center;padding:0px 20px">
                                                       0 <br> Turn in On Time
                                                   </div>
                                                    <div style="border-right:2px solid black;text-align:center;padding:0px 20px">
                                                       0 <br> Turn in With Late
                                                   </div>
                                                    <div style="text-align:center;padding:0px 20px">
                                                       0 <br> Missing
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="table-responsive">
                                            <table class="table">
                                                    <thead style="border-bottom:2px solid black">
                                                      <tr>
                                                        <th>Profile</th>
                                                        <th>Name</th>
                                                        <th>Marks</th>
                                                        <th>File Link</th>
                                                        <th>Submission</th>
                                                        <th>Assign Marks</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr class="success" >
                                                        <td >
                                                           <div style="display:flex;align-items:center;">
                                                            <img src="../assets/images/Male.png" style="width:50px;border-radius:50%;margin-top:-10px;"></img>
                                                            </div>
                                                        </td>
                                                        <td>Student Name</td>
                                                        <td>Marks</td>
                                                          <td>file URl</td>
                                                         <td>Submit date</td>
                                                           <td>
                                                                <form>
                                                               <div class="form-group" style="display:flex;">
                                                                   <input type="text" placeholder="Enter Marks"><button class="btn btn-primary" type="submit">Assign</button>
                                                               </div>
                                                               </form>
                                                           </td>
                                                         
                                                      
                                                     
                                                      </tr>      
                                                      <tr class="danger" >
                                                        <td >
                                                           <div style="display:flex;align-items:center;">
                                                            <img src="../assets/images/Male.png" style="width:50px;border-radius:50%;margin-top:-10px;"></img>
                                                            </div>
                                                        </td>
                                                        <td>Student Name</td>
                                                        <td>Marks</td>
                                                          <td>file URl</td>
                                                         <td>Submit date</td>
                                                           <td>
                                                                <form>
                                                               <div class="form-group" style="display:flex;">
                                                                   <input type="text" placeholder="Enter Marks"><button class="btn btn-primary" type="submit">Assign</button>
                                                               </div>
                                                               </form>
                                                           </td>
                                                         
                                                      
                                                     
                                                      </tr> 
                                                      <tr class="warning" >
                                                        <td >
                                                           <div style="display:flex;align-items:center;">
                                                            <img src="../assets/images/Male.png" style="width:50px;border-radius:50%;margin-top:-10px;"></img>
                                                            </div>
                                                        </td>
                                                        <td>Student Name</td>
                                                        <td>Marks</td>
                                                          <td>file URl</td>
                                                         <td>Submit date</td>
                                                           <td>
                                                               <form>
                                                               <div class="form-group" style="display:flex;">
                                                                   <input type="text" placeholder="Enter Marks"><button class="btn btn-primary" type="submit">Assign</button>
                                                               </div>
                                                               </form>
                                                           </td>
                                                         
                                                      
                                                     
                                                      </tr> 
                                                    </tbody>
                                                  </table>
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