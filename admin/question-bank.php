<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';

?>
<!DOCTYPE html>
<html>
    
<head>
        
    
        <title>Trando | View Exam</title>
        
       
       <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Online Examination System" />
        <meta name="keywords" content="Online Examination System" />

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/images/icon.png" rel="icon">
        <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/snack.css" rel="stylesheet" type="text/css"/>
        <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        <style>
        
        @media screen and (max-width:1200px){
            .mainrow{
                display: flex;
                flex-direction: column-reverse;
            }
            .mainrow .col-lg-4{

                margin:20px 0px 20px 0px;
            }
        }
        
          /* The container */
.container1 {
  display: block;
  /* position: absolute; */
  padding: 15px;
  padding-top:1px;
  padding-right:11px;
  cursor: pointer;
  font-size: 22px;
  /* background-color:blue; */
  /* border-radius:50%; */
}
.container1 input{
    cursor: pointer;
    position: absolute;
}
        
        </style>
        
    </head>
    
   
    
	<body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?>   class="page-header-fixed page-horizontal-bar" >
        <div class="overlay"></div>
        <div class="menu-wrap">
            <nav class="profile-menu">
                <div class="profile">
				<?php 
				if ($myavatar == NULL) {
				print' <img width="60" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
				}else{
				echo '<img src="data:image/jpeg;base64,'.base64_encode($myavatar).'" width="60" alt="'.$myfname.'"/>';	
				}
						
				?>
				<span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></span></div>
                <div class="profile-menu-list">
                    <a href="profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
                    <a href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a>
                </div>
            </nav>
            <button class="close-button" id="close-button">Close Menu</button>
        </div>
        <form class="search-form" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control search-input" placeholder="Search student..." required>
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
            </div>
        </form>
        <main class="page-content content-wrap container">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="./" class="logo-text"><span><img src="../logo.png" alt=""  width="100"></span></a>
                    </div>
                    <div class="search-button">
					
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                    </div>
                    <div class="topmenu-outer">
                        <div class="top-menu">
						 <ul class="nav navbar-nav navbar-left">
                          <li>		
 

                            </ul>
                            <ul class="nav navbar-nav navbar-right">
							
                                <li>	
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name"><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><i class="fa fa-angle-down"></i></span>
										<?php 
						                if ($myavatar == NULL) {
						                print' <img class="img-circle avatar"  width="40" height="40" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
						                }else{
						                echo '<img width="40" height="40" src="data:image/jpeg;base64,'.base64_encode($myavatar).'" class="img-circle avatar"  alt="'.$myfname.'"/>';	
						                }
						
						                ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <li role="presentation"><a href="profile.php"><i class="fa fa-user"></i>Profile</a></li>
                                        <li role="presentation"><a href="logout.php"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="logout.php" class="log-out waves-effect waves-button waves-classic">
                                        <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                                    </a>
                                </li>
                                <li>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="horizontal-bar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    <div class="sidebar-header">
                        <div class="sidebar-profile">
                            <a href="javascript:void(0);" id="profile-menu-link">
                                <div class="sidebar-profile-image">
								<?php 
						        if ($myavatar == NULL) {
						        print' <img class="img-circle img-responsive" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
						        }else{
						        echo '<img src="data:image/jpeg;base64,'.base64_encode($myavatar).'" class="img-circle img-responsive"  alt="'.$myfname.'"/>';	
						        }
						
						        ?>
                       
                                </div>
                                <div class="sidebar-profile-details">
                                    <span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><br><small>Trando Administrator</small></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <ul class="menu accordion-menu">
                        <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Streams</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Classes</p></a></li>
                        <li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <li><a href="questions.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Questions</p></a></li>
                        <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
                        <li><a href="question-bank.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Question Bank</p></a></li>


                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>View Examination</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="./">Home</a></li>
                            <li><a href="examinations.php">Examinations</a></li>
                            <li class="active"><?php echo "$exam_name"; ?></li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <div class="tabs-below" role="tabpanel">
                                       
                                            <div class="tab-content">
                                            <?php 
                                            

                                            $sql2 = "select * from tbl_examinations where user_id='$login_user_id'";

                                            $result2 = $conn->query($sql2);


                                            while($row2 = $result2->fetch_assoc()){

                                                $exam_id=$row2['exam_id'];


											
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' order by question_no";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            while($row = $result->fetch_assoc()) {
												$qs = $row['question'];
												$type = $row['type'];
												$op1 = $row['option1'];
												$op2 = $row['option2'];
												$op3 = $row['option3'];
                                                $op4 = $row['option4'];
                                                $answer = $row['answer'];
                                                $Image = $row['image'];
                                                $pmarks = $row['pos_marks'];
                                                $nmarks = $row['neg_marks'];
                                                
                                            if ($type == "FB") {
											if ($qno == "1") {
											print '
											<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
											<div class="row">
											<div class="col-lg-10">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
                                             </div>
                                             <div class="col-lg-2">
                                             <p class="text-success">Positive Marks : '.$pmarks.'</p>
                                             <p class="text-danger">Negative Marks : '.$nmarks.'</p>
                                             </div>
                                             </div>
                                             ';
                                             if(!empty($Image)){
                                             print '<img src="pages/'.$Image.'" style="max-width:100%; ">';
                                             }
                                              
                                             print '
                                           
											 <p><input type="text" name="'.$qno.'"  class="form-control" placeholder="Enter your answer">
											 <hr>';
											 
										    
										    $sql1 = "select * from tbl_assessment_records where exam_id='$exam_id'";
										    
										    $result1 = $conn->query($sql1);
										    
										    if($result1->num_rows>0){
										        
										    }else{
										    
										    	 
								            print '<a  class="btn btn-twitter m-b-xs"href="edit-question.php?id='.$row['question_id'].'"><i class="fa fa-pencil"></i></a>
											 <a';?> onclick = "return confirm('Drop this question ?')" <?php print 'class="btn btn-youtube m-b-xs"href="pages/drop_question.php?id='.$row['question_id'].'&eid='.$exam_id.'"><i class="fa fa-trash-o"></i></a>';
											 
                                            	
										        
										    }
										    
										    print '</div>';
											
											}else{
                                                print '
                                                <div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
                                                	<div class="row">
											<div class="col-lg-10">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
                                             </div>
                                             <div class="col-lg-2">
                                                 <p class="text-success">Positive Marks : '.$pmarks.'</p>
                                                 <p class="text-danger">Negative Marks : '.$nmarks.'</p>
                                                 </div>
                                                 </div>
                                                ';
                                                 if(!empty($Image)){
                                                 print '     <img src="pages/'.$Image.' " style="max-width:100%; ">';
                                                 }
                                                 print '
                                                 <p><input type="text" name="'.$qno.'"  class="form-control" placeholder="Enter your answer">
                                                 <hr>';
                                                 
                                                    $sql1 = "select * from tbl_assessment_records where exam_id='$exam_id'";
										    
										    $result1 = $conn->query($sql1);
										    
										    if($result1->num_rows>0){
										        
										    }else{
                                           print'    <a  class="btn btn-twitter m-b-xs"href="edit-question.php?id='.$row['question_id'].'"><i class="fa fa-pencil"></i></a>
                                                 <a';?> onclick = "return confirm('Drop this question ?')" <?php print 'class="btn btn-youtube m-b-xs"href="pages/drop_question.php?id='.$row['question_id'].'&eid='.$exam_id.'"><i class="fa fa-trash-o"></i></a>';
                                                 }
                                                 print '
                                                 </div>
                                                ';		
											}

											$qno = $qno + 1;	
											}else{
											
											if ($qno == "1") {
                                            
                                                
											print '
                                            <div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
                                            	<div class="row">
											<div class="col-lg-10">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
                                             </div>
                                             <div class="col-lg-2">
                                                 <p class="text-success">Positive Marks : '.$pmarks.'</p>
                                                 <p class="text-danger">Negative Marks : '.$nmarks.'</p>
                                                 </div>
                                                 </div>
                                            
                                             ';
                                             
                                             
                                            
                                            print'
                                                    <div class="row mainrow">
                                                   <div class="col-lg-8">';
                                              
                                            for($i=1;$i<=4;$i++){ 
                                             
                                            $check_image = explode('.',$row['option'.$i]);
                                           
                                            $ext = strtolower(end($check_image));
                                           
                                             if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                 	print  '<label class="container1"><p><input type="radio" name="'.$qno.'"  class="form-control" value='.$row['option'.$i].'> <img src = "pages/Upload/'.$row["option".$i].'" style=" max-height:100px;max-width:200px"></p></label>';
                                             }
                                             else{

                                                 print '<label class="container1"><p><input type="radio" name="'.$qno.'"  class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';
                                             }
                                             }
                                                 
                                           
                                                     
                                                print ' </div>';

                                             print'<div class="col-lg-4">';
                                             if(!empty($Image)){
                                                print'
                                            <img src="pages/'.$Image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }
                                             print '</div> </div><hr>';
                                             
                                             
                                                $sql1 = "select * from tbl_assessment_records where exam_id='$exam_id'";
										    
										    $result1 = $conn->query($sql1);
										    
										    if($result1->num_rows>0){
										        
										    }else{
                                             
                                             print' 
                                          
											 <a';?> onclick = "return confirm('Drop this question ?')" <?php print 'class="btn btn-youtube m-b-xs"href="pages/drop_question.php?id='.$row['question_id'].'&eid='.$exam_id.'"><i class="fa fa-trash-o"></i></a>';
										    }
										    print'
                                             </div>
											';		
											}else{
                                                print '
                                                <div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
                                                	<div class="row">
											<div class="col-lg-10">
                                             <p><b>'.$qno.'.</b> '.$qs.'</p>
                                             </div>
                                             <div class="col-lg-2">
                                                 <p class="text-success">Positive Marks : '.$pmarks.'</p>
                                                 <p class="text-danger">Negative Marks : '.$nmarks.'</p>
                                                 </div>
                                                 </div>
                                              ';
                                               print'
                                                    <div class="row mainrow">
                                                   <div class="col-lg-8">';
                                              
                                            for($i=1;$i<=4;$i++){ 
                                             
                                            $check_image = explode('.',$row['option'.$i]);
                                           
                                            $ext = strtolower(end($check_image));
                                           
                                             if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                 	print  '<label class="container1"><p><input type="radio" name="'.$qno.'"  class="form-control" value='.$row['option'.$i].'> <img src = "pages/Upload/'.$row["option".$i].'" style="max-width:200px;max-height:100px"></p></label>';
                                             }
                                             else{
                                                 print '<label class="container1"><p><input type="radio" name="'.$qno.'"  class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';
                                             }
                                             }
                                                 
                                           
                                                     
                                                print ' </div>';

                                                    print'<div class="col-lg-4">';
                                             if(!empty($Image)){

                                                print'
                                            <img src="pages/'.$Image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }
                                             print '</div> </div><hr>';
                                                $sql1 = "select * from tbl_assessment_records where exam_id='$exam_id'";
										    
										    $result1 = $conn->query($sql1);
										    
										    if($result1->num_rows>0){
										        
										    }else{
                                                print'
                                                 
                                                 <a';?> onclick = "return confirm('Drop this question ?')" <?php print 'class="btn btn-youtube m-b-xs"href="pages/drop_question.php?id='.$row['question_id'].'&eid='.$exam_id.'"><i class="fa fa-trash-o"></i></a>';
										    }
										    print'
                                                 </div>
                                                ';
											
											}

											$qno = $qno + 1;	

											
											}

                                            }
                                            } else {
 
                                            }
                                        }
											
											?>

                                            </div>
                 
											
                                            <ul class="nav nav-tabs" role="tablist">
											<?php 
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            while($row = $result->fetch_assoc()) {
											if ($qno == "1") {
											print '<li role="presentation" class="active"><a href="#tab'.$qno.'" role="tab" data-toggle="tab">Q'.$qno.'</a></li>';	
											}else{
											print '<li role="presentation"><a href="#tab'.$qno.'" role="tab" data-toggle="tab">Q'.$qno.'</a></li>';		
											}

											$qno = $qno + 1;
                                            }
                                            } else {
 
                                            }
											
											?>
                      
                                            </ul>
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
        <script src="../assets/js/modern.min.js"></script>
        
				<script>
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>