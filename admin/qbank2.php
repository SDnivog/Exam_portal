<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';

if(!empty($_GET['page'])){
$page= trim($_GET['page']);
  if(file_exists($page)){
    include($page);
  }else{
   include('404.php');
  }
}
else{
  echo "This anchor tage has no url";
}
?>
<!DOCTYPE html>
<html>
<head>
        
        <title>Trando | Manage Streams</title>
        <style>
            
            .qpackage{
                width:100%;
                background:white;
                box-shadow:1px 1px 8px -4px #999;
                padding: 5px 10px 10px 10px;
                margin-bottom:25px;
            }
            .qpackage .head h3{
                font-size:24px;
            }
            #subject{
                text-decoration:none;
            }
            #subject:hover{
                text-decoration:none;
            }
            .qpackage .footer ul li{
         display:inline;
            }
            
            
        </style>
            <?php include 'header.php'; ?>
                    <ul class="menu accordion-menu">
                        <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Streams</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Classes</p></a></li>
                        <!--<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <li class="active"><a href="qbank.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Question Bank</p></a></li>
                        <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Question Bank</h3>
                </div>
               
                <div id="main-wrapper" >
                    <div class="row">
                        <div class="col-md-12">
                                <div class="panel panel-white">
                                        <div role="tabpanel">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#my" role="tab" data-toggle="tab">My Library</a></li>
                                                <li role="presentation"><a href="#live" role="tab" data-toggle="tab">Online Library</a></li>
                                            </ul>

                                            <div class="tab-content">
                                                
                                                <div role="tabpanel" class="tab-pane active fade in" id="my">
                                                     <div class="container-fluid">
                                                         <div class="row">
                                                             <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjecton1" onclick="addState(this.id)">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Physics</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                                <div class="col-md-3 subjectlink mt-2">
                                                               <a href=""  id="subjecton2">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Chemistry</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                                <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjecton3">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Mathematic</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                                <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjecton4">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Gk</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                         </div>
                                                     </div>
                                                </div>
                                                
                                                
                                                <div role="tabpanel" class="tab-pane fade" id="live" >
                                                  <div class="container-fluid">
                                                         <div class="row">
                                                             <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjectof1">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Physics</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                                <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjectof2">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Chemistry</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                                <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjectof3">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Mathematic</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                                <div class="col-md-3 subjectlink mt-2 ">
                                                               <a href="" id="subjectof4">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Gk</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                               <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjectof5">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Social Science</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                               <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subject">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>English</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
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
      <div id="pageContent">
    
</div>

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
        
		<script>
// 		function addState() { 
//             let stateObj = { id: "100" }; 
              
//             window.history.pushState(stateObj, 
//                      "Page 2", "https://kendel.in/exam/admin/index"); 
//         } 
		
// 		$(document).on('click','.subjectlink' function(){
// 		    e.preventDefault();
//              var pageURL=$(this).attr('href');

//               history.pushState(null, '', pageURL);
              
//               $.ajax({    
//                  type: "GET",
//                  url: "https://kendel.in/exam/admin/index", 
//                  data:{page:pageURL},        
//                  dataType: "html",
//                  success: function(data){
//                  $('#pageContent').html(data);
//                  }
//              });
		    
// 		});
		
		
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>