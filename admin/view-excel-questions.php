<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
if (isset($_GET['eid'])) {
include '../database/config.php';
$exam_id = mysqli_real_escape_string($conn, $_GET['eid']);	

$sql = "SELECT * FROM tbl_examinations WHERE exam_id = '$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $exam_name =$row['exam_name'];
    }
} else {
header("location:./index");	
}

}else{
header("location:./index");	
}
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

.Modal,.Modal3,.Modal5{
    position:fixed;
    top:0%;
    left:0%;
    z-index:999;
    display:none;
    width:100%;
    height:100%

    
}
.Modal1,.Modal4,.Modal6{
    position:relative;
    display:flex;
    justify-content:center;
    align-items:center;
    
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
}

.Modal form ,.Modal3 form ,.Modal5 form{
    position:relative;
    
    width:30%;
    background:white;
    padding:50px;
    /* transform:translate(-50%,-50%); */
    border-radius:10px;

}

.Modal form h4,.Modal3 form h4,.Modal5 form h4{
    text-align:center;
}



@media screen and (max-width:1000px){
    .Modal form,.Modal3 form,.Modal5 form{
  
    width:80%;
  
}


}





/*.radiobtn,.checkbtn,.truebtn{*/
/*    display:flex;*/
/*}*/









        
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
                        <a href="./index" class="logo-text"><span><img src="../logo.png" alt=""  width="100"></span></a>
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
                       <!--<li><a href="questions_bank.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Question Bank</p></a></li>-->
                        <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>


                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>View Examination</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="./index">Home</a></li>
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
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' order by question_no";
                                            $result = $conn->query($sql);
                                            $row_count = $result->num_rows;
                                          

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            $count=1;
                                            while($row = $result->fetch_assoc()) {
                                                $qs = $row['question'];
                                                $q_id = $row['question_id'];
												$type = $row['type'];
                                                $answer = $row['answer'];
                                                $Image = $row['image'];
                                                $pmarks = $row['pos_marks'];
                                                $nmarks = $row['neg_marks'];
                                                $question_type = $row['question_type'];
                                                
                                                $bonus = $row['bonus'];
                                                
                                                
											
											if ($qno%2 != 0) {
                                                // if($count == 1){
                                                //     print '<form method="post" action="pages/add-instance-option.php">';
                                                // }
                                                
                                            print '<div class="row">
                                              
                                                <div class="col-lg-6">
                                            <div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">';
                                          
                                             print '
                                            	<div class="row" style="display:flex;margin-top:20px">
                                            	
                                                     <div class="col-1" style="margin-right:10px">
                                                    <p style="font-size:22px;margin-top:4px"><b>'.$qno.'.</b> </p></div>';
                                                    
                                                 
                                                    print '
                                                     <div class="col-11">';
                                                     
                                                     if(!empty($qs)){
                                                    print '<p style="font-size:20px;margin-top:4px">'.$qs.'</p>';
                                                    }   else{
                                                        print'
                                                     <div class="form-group">
                                                        <input type="text" style="width:250px" class="form-control" placeholder="Enter Question"  name="question'.$qno.'"  autocomplete="off">
                                                    </div>';
                                                    }
                                                    print '
                                                     
                                                    </div>
                                                </div>
                                            
                                             ';
                                             
                                             
                                            
                                            print'
                                                    <div class="row mainrow">
                                                    <div class="col-lg-12">';
                                             if(!empty($Image)){
                                                print'
                                            <img src="pages/'.$Image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }
                                           print ' </div>';
                                                 print' <div class="col-lg-12">   <input type="hidden" name="question_type'.$qno.'" value="single" id="question_type'.$qno.'">';
                                                 
                                           
                                                 print '
                                              
                                                 <div class="radiobtn" id="radiobtn'.$qno.'" style="';
                                                 
                                                 if($answer != '' and $question_type == "STQ"){
                                                     print "display:flex";
                                                 }
                                                 else if($answer == "" and $question_type == ""){
                                                    print "display:flex";                                                             
                                                 }else{
                                                     print "display:none"; 
                                                 }

                                                 print '">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                           
                                                if($question_type == "STQ"){
                                             
                                                if($row['option'.$i] == $row[$answer]){
                                             print '<label class="container1"><p><input type="radio"   class="form-control active" value='.$row["option".$i].' checked="checked">'.$row["option".$i].'</p></label>';
                                                }else{
                                         print '<label class="container1"><p><input type="radio"   class="form-control" value='.$row["option".$i].'> '.$row["option".$i].'</p></label>';

                                                }
                                                }
                                                else{
                                                    print '<label class="container1"><p><input class="" type="radio" id="clearradio'.$i.$qno.'" name="answerradio'.$qno.'"  onclick="ClearAnswer('.$qno.')" class="form-control" value='.$row["option".$i].'> '.$row["option".$i].'</p></label>';

                                                }
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            // code for checkbox 
                                            print' <div class="checkbtn" id="checkbtn'.$qno.'" style="';
                                            
                                            if($answer != '' and $question_type == "MTQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                                 
                                            
                                            print '">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                               
                                                if($question_type == "MTQ"){
                                               
                                                
                                            if(strpos($answer,'option'.$i)  !== false){
                                                      print '<label class="container1"><p><input type="checkbox"   class="form-control active" value='.$row["option".$i].' checked="checked"> '.$row["option".$i].'</p></label>';
                                               
                                                }
                                                 else{
                                                     
                                                    print '<label class="container1"><p><input type="checkbox"   class="form-control" value='.$row["option".$i].'> '.$row["option".$i].'</p></label>';

                                                }
                                                
                                                }
                                                
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            // code for fill
                                            
                                             print' <div class="fillbtn" id="fillbtn'.$qno.'" style="';
                                                 if($answer != '' and $question_type == "FQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                             print '">
                                                 ';
                                                   
                                            if($question_type == "FQ"){
                                                 print '<label class="container1" style="display:flex;margin:20px 0px;"><p> '.$answer.'</p></label>';
                                            } 
                                            
                                             
                                                 
                                           
                                                     
                                            print '</div>';
                                            
                                            /// code for true or false
                                            print' <div class="truebtn" id="truebtn'.$qno.'" style="';
                                            
                                                if($answer != '' and $question_type == "TQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                            
                                            print '">
                                                 ';
                                                   
                                            for($i=1;$i<=2;$i++){ 

                                                $arr = ['true','false'];
                                                $mainarr = ['option1','option2'];
                                                
                                                if($question_type=="TQ"){
                                             
                                                if($mainarr[$i-1] == $row['answer']){
                                                 print '<label class="container1"><p><input type="radio"  class="form-control active" value='.$arr[$i-1].' checked="checked"> '.$arr[$i-1].'</p></label>';
                                                }
                                                 else{
                                                    print '<label class="container1"><p><input type="radio"   class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                }
                                                }
                                               
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            
                                                 

                                            print '</div> </div><button type="button" id="update'.$qno.'" class=" btn btn-success" onclick="Update('.$qno.')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';

                                            print '<a href="delete-excel-question.php?question_id='.$q_id.'&exam_id='.$exam_id.'" style="color:white"><button type="button"  class="delete btn btn-danger" > <i class="fa fa-trash-o"></i></button></a>';
                                            
                                            if(empty($Image)){
                                            
                                             print '<a onclick="Modals('.$qno.')"  style="color:white"><button type="button"  class="btn btn-warning" > Add Image</button></a>';
                                            }else{
                                                print '<a href="pages/delete_image.php?question_id='.$q_id.'&exam_id='.$exam_id.'"  style="color:white"><button type="button"  class="btn btn-warning" >Delete Image</button></a>';
                                            }
                                            
                                            if($bonus == 0){
                                             print '<a href="pages/bonus-question.php?question_id='.$q_id.'&page=3&exam_id='.$exam_id.'" class="btn btn-info">Bonus Question</a>';
                                            }else{
                                               print '<a href="pages/nobonus-question.php?question_id='.$q_id.'&page=3&exam_id='.$exam_id.'" class="btn btn-info">Remove Bonus</a>'; 
                                            }
                                             
                                             print '<hr>';



                                             
                                             print '<input type="hidden" name="question_id'.$qno.'"  id="question_id'.$qno.'" value="'.$q_id.'" >';
                                              
										    print'
                                             </div></div>
											';		
											}else{
                                                print '<div class="col-lg-6">
                                            <div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">';

                                             print '
                                            	<div class="row"  style="display:flex;margin:20px 0px;">
                                                    <div class="col-1" style="margin-right:10px">
                                                    <p style="font-size:20px;margin-top:4px"><b>'.$qno.'.</b> </p></div>';
                                                    
                                                 
                                                    print '
                                                     <div class="col-11">';
                                                     if(!empty($qs)){
                                                    print '<p style="font-size:20px;margin-top:4px">'.$qs.'</p>';
                                                    }  else{
                                                        print'
                                                     <div class="form-group">
                                                        <input type="text" style="width:250px" class="form-control" placeholder="Enter Question"  name="question'.$qno.'"  autocomplete="off">
                                                    </div>';
                                                    }
                                                    print '
                                                     
                                                    </div>
                                                </div>
                                            
                                             ';
                                            
                                               print'
                                                    <div class="row mainrow">';
                                                    print'<div class="col-lg-12">';
                                             if(!empty($Image)){

                                                print'
                                            <img src="pages/'.$Image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }

                                           print'</div>';

                                                   print '<div class="col-lg-2">
                                                   <input type="hidden" name="question_type'.$qno.'" value="single" id="question_type'.$qno.'">';
                                                   
                                          print '
                                              
                                                 <div class="radiobtn" id="radiobtn'.$qno.'" style="';
                                                 
                                                 if($answer != '' and $question_type == "STQ"){
                                                     print "display:flex";
                                                 }
                                                 else if($answer == "" and $question_type == ""){
                                                    print "display:flex";                                                             
                                                 }else{
                                                     print "display:none"; 
                                                 }
                                                 
                                                 
                                                 
                                                 print '">
                                                 ';
                                                   
                                          for($i=1;$i<=4;$i++){ 

                                           
                                                if($question_type == "STQ"){
                                             
                                                if($row['option'.$i] == $row[$answer]){
                                             print '<label class="container1"><p><input type="radio"   class="form-control active" value='.$row["option".$i].' checked="checked">'.$row["option".$i].'</p></label>';
                                                }else{
                                         print '<label class="container1"><p><input type="radio"   class="form-control" value='.$row["option".$i].'> '.$row["option".$i].'</p></label>';

                                                }
                                                }
                                                else{
                                                    print '<label class="container1"><p><input class="" onclick="ClearAnswer('.$qno.')" type="radio" id="clearradio'.$i.$qno.'" name="answerradio'.$qno.'"  class="form-control" value='.$row["option".$i].'> '.$row["option".$i].'</p></label>';

                                                }
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            // code for checkbox 
                                            print' <div class="checkbtn" id="checkbtn'.$qno.'" style="';
                                            
                                            if($answer != '' and $question_type == "MTQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                                 
                                            
                                            print '">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                 if($question_type == "MTQ"){
                                               
                                                
                                            if(strpos($answer,'option'.$i)  !== false){
                                                      print '<label class="container1"><p><input type="checkbox"   class="form-control active" value='.$row["option".$i].' checked="checked"> '.$row["option".$i].'</p></label>';
                                               
                                                }
                                                 else{
                                                     
                                                    print '<label class="container1"><p><input type="checkbox"   class="form-control" value='.$row["option".$i].'> '.$row["option".$i].'</p></label>';

                                                }
                                                
                                                }
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            // code for fill
                                            
                                             print' <div class="fillbtn" id="fillbtn'.$qno.'" style="';
                                                 if($answer != '' and $question_type == "FQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                             print '">
                                                 ';
                                                   
                                            if($question_type == "FQ"){
                                                 print '<label class="container1 "><p> '.$answer.'</p></label>';
                                            }
                                            
                                             
                                                 
                                           
                                                     
                                            print '</div>';
                                            
                                            /// code for true or false
                                            print' <div class="truebtn" id="truebtn'.$qno.'" style="';
                                            
                                                if($answer != '' and $question_type == "TQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                            
                                            print '">
                                                 ';
                                                   
                                            for($i=1;$i<=2;$i++){ 

                                                $arr = ['true','false'];
                                                $mainarr = ['option1','option2'];
                                                
                                                if($question_type=="TQ"){
                                             
                                                if($mainarr[$i-1] == $row['answer']){
                                                 print '<label class="container1"><p><input type="radio"  class="form-control active" value='.$arr[$i-1].' checked="checked"> '.$arr[$i-1].'</p></label>';
                                                }
                                                 else{
                                                    print '<label class="container1"><p><input type="radio"   class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                }
                                                }
                                               
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                                
                                           print '</div> </div>';
                                             
                                           print '<button type="button" id="update'.$qno.'" class="btn btn-success" onclick="Update('.$qno.')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';

                                           print '<a href="delete-excel-question.php?question_id='.$q_id.'&exam_id='.$exam_id.'" style="color:white"><button type="button" class="delete btn btn-danger" > <i class="fa fa-trash-o"></i></button></a>';
                                           
                                           if(empty($Image)){
                                            
                                             print '<a  style="color:white" onclick="Modals('.$qno.')"><button type="button"  class="btn btn-warning"  > Add Image</button></a>';
                                           }else{
                                                print '<a  href="pages/delete_image.php?question_id='.$q_id.'&exam_id='.$exam_id.'"  style="color:white"><button type="button"  class="btn btn-warning" >Delete Image</button></a>';
                                            }
                                            
                                            if($bonus == 0){
                                             print '<a href="pages/bonus-question.php?question_id='.$q_id.'&page=3&exam_id='.$exam_id.'" class="btn btn-info">Bonus Question</a>';
                                            }else{
                                               print '<a href="pages/nobonus-question.php?question_id='.$q_id.'&page=3&exam_id='.$exam_id.'" class="btn btn-info">Remove Bonus</a>'; 
                                            }
                                             
                                             
                                             
                                            print '<hr>';
                                             print '<input type="hidden" name="question_id'.$qno.'" id="question_id'.$qno.'" value="'.$q_id.'" >';
                                                
										    print'
                                                 </div></div></div>
                                                ';
											
                                            }
                                            print '<input type="hidden" name="total_question" value="'.$row_count.'" >';
                                            print '<input type="hidden" id="exam_id" name="exam_id" value="'.$exam_id.'" >';
                                            if($count == 10){
                                                 $count=0;
                                                print '
                                              <div class="-fluid text-center py-5" style="padding:30px 20px;border-bottom:2px solid #333;border-top:1px solid #333;margin-bottom:20px;">  <button type="submit" class="btn btn-primary">Save</button></div>
                                              <input type="hidden" name="btn'.($count+1).'" >
                                                </form>
                                                ';
                                               
                                            }

                                            
                                            $count++;
                                            $qno = $qno + 1;	
                                            

											
                                            }

                                            if($row_count%2 !=0){
                                                print '</div>';
                                            }

                                            //   print ' <button type="button" class="btn btn-primary" onclick="AddSingle()" >Add New Question</button>';
                                               print ' <button type="button" class="btn btn-primary" onclick="AddExcel()" >Add Excel </button>';
                                             

                                            // if($row_count%10 != 0){
                                            //     print '
                                            //     <button type="submit" class="btn btn-primary">Save</button></form>';
                                            // }
                                            
                                            

                                            }
                                         else {
 
                                            }
											
											?>

                                            </div>
                 
											
                                            
                                        </div>
                                    </div>
                                </div>  
                    </div>
                </div>
                
            </div>
        </main>


        <div class="Modal3" style="display:none">
            
            
            
            
            
        </div>


    <!--code for Add Image-->
    
    <div class="Modal">
    <div class="Modal1">
    <form id="myform" action="" method="post" enctype="multipart/form-data">
        <h4>Add A Image</h4>
        <div class="form-group">
            <label for="exampleInputEmail1">Question No</label>
            <input type="number" class="form-control"  id="question_no" required disabled autocomplete="off">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Upload File</label>
            <input type="file" class="form-control"  name="ModalImage" required autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" >Submit</button>
        <button type="button" class="btn btn-warning" onclick="Close()">Close</button>
    </form>
    
    
    
    </div>
    </div>


    <!--code add Single New question-->
    
     <div class="Modal5" style="display:none">
    <div class="Modal6">
    <form id="myform1"action="" method="post" enctype="multipart/form-data">
        <h4>Add Excel Questions</h4>
        <div class="form-group">
            <label for="exampleInputEmail1">Upload File</label>
            <input type="file" class="form-control"  name="excelfile" required autocomplete="off">
        </div>
    
        
       <a href="image.png" target="_blank">Check The Excel Format</a>  <br>  <br>
        <button type="submit" class="btn btn-primary" >Submit</button>
        <button type="button" class="btn btn-warning" onclick="Close1()">Close</button>
    </form>
    
    
    
    </div>
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
        <script src="../assets/js/modern.min.js"></script>
        
				<script>
				
				
					function ClearAnswer(qno){
				    
				    for(var i=1;i<=4;i++){
				        var x = document.querySelector('#clearradio'+i+qno);
				        if(x.className == ""){
				        if(x.checked == true){
				            // document.querySelector('#radio'+qno).style.display="block";
				            x.className="1";
				        }
				        }
				        else if(x.className == 1){
				            x.checked=false;
				            x.className="";
				        }
				    }
				}
				
				
function Open(val,id){
	if(val == "single"){
	  document.querySelector('#radiobtn'+id).style.display="flex";
	   document.querySelector('#checkbtn'+id).style.display="none";
	   document.querySelector('#fillbtn'+id).style.display="none";
	    document.querySelector('#truebtn'+id).style.display="none";
	    
	}else if(val == "multiple"){
	      document.querySelector('#radiobtn'+id).style.display="none";
	   document.querySelector('#checkbtn'+id).style.display="flex";
	   document.querySelector('#fillbtn'+id).style.display="none";
	    document.querySelector('#truebtn'+id).style.display="none";
	    
	    
	}else if(val == "fill"){
	      document.querySelector('#radiobtn'+id).style.display="none";
	   document.querySelector('#checkbtn'+id).style.display="none";
	   document.querySelector('#fillbtn'+id).style.display="flex";
	    document.querySelector('#truebtn'+id).style.display="none";
	    
	}else if(val == "true"){
	      document.querySelector('#radiobtn'+id).style.display="none";
	   document.querySelector('#checkbtn'+id).style.display="none";
	   document.querySelector('#fillbtn'+id).style.display="none";
	    document.querySelector('#truebtn'+id).style.display="flex";
	    
	}			   
				   
	document.querySelector('#question_type'+id).value=val;		    
				    
				    
				   
}





//// Add New Excel Questions 

function AddExcel(){
  
    var exam_id = document.getElementById('exam_id').value;
    
   document.querySelector('.Modal5').style.display="block"; 
   
   
    
    var url = 'pages/add_Excel.php?exam_id='+exam_id;
    
    document.querySelector('#myform1').setAttribute("action", url);
}



function Modals(qno){
    
     var question_id = document.getElementById('question_id'+qno).value;

    var exam_id = document.getElementById('exam_id').value;
    
   document.querySelector('.Modal').style.display="block"; 
   
     document.querySelector('#question_no').value = qno;
    
    var url = 'pages/add_image.php?question_id='+question_id+'&exam_id='+exam_id;
    
    document.querySelector('#myform').setAttribute("action", url);
}





/// close add question modal 
function Close(){
document.querySelector('.Modal').style.display="none";
}
/// close 
function Close1(){
document.querySelector('.Modal5').style.display="none";
}


// close update window

function CloseUpdate(Maindata){
    document.getElementById('file').innerHTML="";
    document.querySelector('#update'+Maindata).style.display="block";

}

function UpdateClose(){
    document.querySelector('.Modal3').style.display="none";
 
}

/// uodate instance question
function Update(Maindata){
   
    // var question_id = document.getElementById('question_id'+Maindata).value;
    // var files = document.querySelector('.Modal3');
    // var BtnTitle = document.querySelector('#update'+Maindata);
    // var exam_id = document.getElementById('exam_id').value;

    // document.querySelector('.Modal3').style.display="block";
    
    // document.querySelector('#qno').value = Maindata;
    
    // var url = 'pages/update-excel-questions.php?question_id='+question_id+'&exam_id='+exam_id;
    
    // document.querySelector('#UpdateForm').setAttribute("action", url);
    

      var question_id  = document.querySelector('#question_id'+Maindata).value;
      var datafile = "excel";
   $.ajax({
       url:'ajax/Question_data.php',
       type:'post',
       data:{
           question_id:question_id,
           datafile:datafile
       },
        // beforeSend:function(){
        //      document.querySelector('.Modal3').innerHTML='<div class="loading"><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow text-secondary" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow text-success" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow text-danger" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow text-warning" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow text-info" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow text-light" role="status"> <span class="visually-hidden">Loading...</span></div> <div class="spinner-grow text-dark" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        //      document.querySelector('.Modal3').style.display="block";      

        // },
       success:function(data){
           $('.Modal3').html(data);
            document.querySelector('.Modal3').style.display="block"; 
           
           
       }
   })


}


/// checking that answer is insert already or not 


function Checking(id){
    var x1 = document.querySelector('#radiobtn');
    var x2 = document.querySelector('#checkbtn');
    var x3 = document.querySelector('#fillbtn');
    var x4 = document.querySelector('#truebtn');
    
    if(id == "STQ"){
        x1.style.display="flex";
        x2.style.display="none";
        x3.style.display="none";
        x4.style.display="none";
       
       
      
    }
    else if(id== "MTQ"){
          x1.style.display="none";
        x2.style.display="flex";
        x3.style.display="none";
        x4.style.display="none";
      
      
    }
    else if (id== "FQ"){
          x1.style.display="none";
        x2.style.display="none";
        x3.style.display="flex";
        x4.style.display="none";
       
      
    } else if (id =="TQ"){
          x1.style.display="none";
        x2.style.display="none";
        x3.style.display="none";
        x4.style.display="flex";
       
       
    }
   
}






function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>