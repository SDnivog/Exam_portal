<?php 
date_default_timezone_set('Africa/Dar_es_salaam');
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../includes/uniques.php';
include '../database/config.php';





if (isset($_SESSION['current_examid'])){


$exam_id = $_SESSION['current_examid'];	
$retake_status = $_SESSION['student_retake'];


if ($retake_status == "1") {
    
$sql = "DELETE FROM tbl_assessment_records WHERE student_id = '$stu_id' AND exam_id = '$exam_id'";

if ($conn->query($sql) === TRUE) {
    
        $sql1 = "delete from tbl_responses where stu_id= '$stu_id' and exam_id='$exam_id'";
        
        $result1 = $conn->query($sql1);
        
    
    
    

} else {

}	
}


$sql = "SELECT * FROM tbl_examinations WHERE exam_id = '$exam_id'  AND status = 'Active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $exam_name =$row['exam_name'];
	$subject = $row['subject'];
	$deadline = $row['date'];
	$duration = $row['duration'];
	$passmark = $row['passmark'];
	$reexam = $row['re_exam'];
	$terms = $row['terms'];
	$status = $row['status'];
	$today_date = date('Y/m/d');
	$exam_date = $row['edate'];
    $next_retake = date('m/d/Y', strtotime($today_date. ' + '.$reexam.' days'));
	
	$today_date = date('m/d/Y');
	$restriction_check = $row['Restrict_time'];
	
	$no_exit_fullscreen = $row['no_exit'];
    }
} else {
header("location:./index");	
}
}else{
header("location:./index");	
}



$sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$stu_id' and exam_id='$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        header("location:./take-assessment.php?id=$exam_id");
    }
} else {
$myname = "$myfname $mylname";
$recid = 'RS'.get_rand_numbers(14).'';

$sql = "INSERT INTO tbl_assessment_records (record_id, student_id, student_name, exam_name, exam_id, score, status, next_retake, date)
VALUES ('$recid', '$stu_id', '$myname', '$exam_name', '$exam_id', '0', 'FAIL', '$next_retake', '$today_date')";

if ($conn->query($sql) === TRUE) {

} else {

}

}

?>
<!DOCTYPE html>
<html>
    
<head>
        
    
        <title>Trando | Examination</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Online Examination Portal" />
        <meta name="keywords" content="Online Examination Portal" />
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
        
        @media only  screen and (max-width:1100px){
            .mainrow{
                display: flex;
                flex-direction: column-reverse;
            }
            .mainrow .col-lg-4{

                margin:20px 0px 20px 0px;
            }
            
        }
      
        
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

.tooltiper {
    /* margin-left: 200px; */
  position: relative;
  display: inline-block;
  /* border-bottom: 1px dotted black; */
}

.tooltiper .tooltiptexter {
  visibility: hidden;
  width: 150px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 10px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  top: 150%;
  left: 50%;
  margin-left: -73px;
}
.tooltiper .tooltiptexter p{
    line-height:10px;
}

.tooltiper .tooltiptexter::after {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent #555 transparent;
}

.tooltiper:hover .tooltiptexter {
  visibility: visible;
}
       
       

#WarningModal,#WarningModal1{
    position:fixed;
    top:0%;
    left:0%;
    background:rgba(0,0,0,0.6);
    height:100vh;
    width:100%;
    z-index:999;
    display:none;
    z-index:999;
    /*border:3px solid white;*/
    box-shadow:1px 1px 6px -3px #1b263b;
}
#WarningModal h2,#WarningModal1 h2{
    color:#1b2631;
  
    font-size:22px;
    line-height:1.5;
}
#WarningModal #message,#WarningModal1 #message{
    padding:10px;
    position:absolute;
    top:30%;
    left:50%;
    transform:translate(-50%,0%);
    background:white;
    /*height:200px;*/
}
  @media only screen and (max-width:900px){
        #WarningModal #message,#WarningModal1 #message{
    padding:10px;
    position:absolute;
    width:100%;
    top:20%;
    left:50%;
    transform:translate(-50%,0%);
    background:white;
    /*height:200px;*/
}
        }

#mybody:-webkit-full-screen {
	background-color: white;
	margin: 0;
	overflow-y:scroll;
}

#mybody:-moz-full-screen {
	background-color: white;
	margin: 0;
	overflow-y:scroll;
}

#mybody:-ms-fullscreen {
	background-color: white;
	margin: 0;
	overflow-y:scroll;
}

#mybody:fullscreen { 
	background-color: white;
	margin: 0;
	overflow-y:scroll;
}

#Start{
    
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    
    
}
#mybody{
    background:white;
}



        
        </style>


       






        
    </head>
	<body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?> id="mybody"   class="page-header-fixed page-horizontal-bar " >
	    <button type="button" id="Start" onclick="StartTest()">Start Exam</button>
	    <div id="mainbody" style="display:none;">
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

        <main class="page-content content-wrap container">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a class="logo-text text-dark" style="color:#333"><span><div class="text-dark" style="color:#333" id="quiz-time-left"></div></span></a>
                    </div>

                    <div class="topmenu-outer">
                        <div class="top-menu">
						 <ul class="nav navbar-nav navbar-left">


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
                                    <span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><br><small>OES Student</small></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- <ul class="menu accordion-menu">
                        <li><a  class="waves-effect waves-button"  onclick="submitexam(this.innerText)"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a class="waves-effect waves-button " file='' onclick="submitexam(this.innerText)"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>
                        <li><a  class="waves-effect waves-button" onclick="submitexam(this.innerText)"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a  class="waves-effect waves-button" onclick="submitexam(this.innerText)"><span class="menu-icon glyphicon glyphicon-book header"></span><p>Examinations</p></a></li>
                        <li><a  class="waves-effect waves-button" onclick="submitexam(this.innerText)"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>

                    </ul> -->
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3 class="text-center">Examination</h3>
                    <h2><?php echo $exam_id; ?></h2>
                </div>
              
                <h4 class="text-center text-danger" id="count_msg"></h4>
           
                <div id="main-wrapper">

                    <div class="row">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <div class="tabs-below" role="tabpanel">
                                       <form onsubmit="return checkForm(this);" action="pages/submit_assessment.php" method="POST" name="quiz" id="quiz_form" >
                                            <div class="tab-content">
                                          
											<?php 
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            while($row = $result->fetch_assoc()) {
                                                $qsid = $row['question_id'];
                                                $qs = $row['question'];
                                                $question_type =$row['question_type'];
												$pmarks = $row['pos_marks'];
												$nmarks =$row['neg_marks'];
												$type = $row['type'];
												$op1 = $row['option1'];
												$op2 = $row['option2'];
												$op3 = $row['option3'];
												$op4 = $row['option4'];
												$ans = $row['answer'];
                                                $Image = $row['image'];//Added by Govind
												$enan = $row[$ans];
        //                                     if ($type == "FB") {
                                                 
								// 			if ($qno == "1") {
								// 			     echo '<input type="hidden" value="0" id="typevalue">';
        //                                         $ans = '<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
        //                                         <div class="row mainrow">
        //                                         <div class = "col-sm-11">
        //                                         <p style="font-size:20px;margin-top:4px"><b style="font-size:22px;margin-top:4px">'.$qno.'.</b> '.$qs.'</p>
        //                                         </div>
        //                                         <div class="col-sm-1">
                                      
								// 			 <a   class="btn btn-success m-b-xs tooltiper" href="javascript:void(0);"> <span style="color:#fff;font-size:16px;" class=" glyphicon glyphicon-question-sign">
								// 			  <span class="tooltiptexter">
        //                                           <p class="text-White">Positive Marks : '.$pmarks.'</p>
        //                                          <p class="text-white">Negative Marks : '.$nmarks.'</p>
        //                                          </span>
								// 			 </a>
        //                                          </div></div>
                                                
        //                                         ';
        //                                         if(!empty($Image)){
        //                                             $ans .= '<img src="../admin/pages/'.$Image.' " style="max-width: 100%;">';
        //                                         }
        //                                         $ans .= ' <p><input type="text" name="an'.$qno.'"  class="form-control" style="max-width:90%;" placeholder="Enter your answer" autocomplete="off" id="fill'.$qno.'">
        //                                         <input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
        //                                         <input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
        //                                         </div>';
        //                                         echo $ans;
											
								// 			}else{
        //                                         $ans = '<div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
        //                                         <div class="row mainrow">
        //                                         <div class = "col-sm-11">
        //                                         <p style="font-size:20px;margin-top:4px"><b style="font-size:22px;margin-top:4px">'.$qno.'.</b> '.$qs.'</p>
        //                                         </div>
        //                                          <div class="col-sm-1">
                                      
								// 			 <a   class="btn btn-success m-b-xs tooltiper" href="javascript:void(0);"> <span style="color:#fff;font-size:16px;" class=" glyphicon glyphicon-question-sign">
								// 			  <span class="tooltiptexter">
        //                                           <p class="text-White">Positive Marks : '.$pmarks.'</p>
        //                                          <p class="text-white">Negative Marks : '.$nmarks.'</p>
        //                                          </span>
								// 			 </a>
        //                                          </div></div>
        //                                       ';
                                               
        //                                         if(!empty($Image)){
        //                                             $ans .= ' <img src="../admin/pages/'.$Image.' " style="max-width: 100%; ">';
        //                                         }
        //                                         $ans .= '  <p><input type="text" name="an'.$qno.'"  class="form-control" style="max-width:90%;" placeholder="Enter your answer" autocomplete="off" id="fill'.$qno.'">
        //                                         <input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
        //                                         <input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
        //                                         </div>';
        //                                         echo $ans;	
								// 			}

								// 			$qno = $qno + 1;	
								// 			}
								// 			else{
											
											if ($qno == "1") {
											    
											    if($question_type == "STQ"){
											        $q_value=1;
											    }else if($question_type=="MTQ"){
											        $q_value=1;
											    }else if ($question_type == "FQ"){
											        $q_value=0;
											    }else if($question_type == "TQ"){
											        $q_value=2;
											    }
                                               
                                              echo '<input type="hidden" value="'.$q_value.'" id="typevalue">';
                                            $ans = '	<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
                                            <div class="row mainrow">
                                                <div class = "col-sm-11">
                                                <p style="font-size:20px;margin-top:4px"><b style="font-size:22px;margin-top:4px">'.$qno.'.</b> '.$qs.'</p>
                                                </div>
                                                <div class="col-sm-1">
                                      
											 <a   class="btn btn-success m-b-xs tooltiper" href="javascript:void(0);"> <span style="color:#fff;font-size:16px;" class=" glyphicon glyphicon-question-sign">
											  <span class="tooltiptexter">
                                                  <p class="text-White">Positive Marks : '.$pmarks.'</p>
                                                 <p class="text-white">Negative Marks : '.$nmarks.'</p>
                                                 </span>
											 </a>
                                                 </div></div>
                                                    ';
                                                    
                                                    
                                                        
                                            $ans .='
                                                    <div class="row mainrow">
                                                   <div class="col-lg-8">';
                                                   if($question_type == "FQ"){
                                                $ans .= '<label class="container1"><input style="max-width:90%;" type="text" name="an'.$qno.'"  class="form-control" placeholder="Enter Your Answer" id="fill'.$qno.'"></label>';
                                                   }else if($question_type == "TQ"){
                                                       $arr = ['true','false'];
                                                       for($i=1;$i<=2;$i++){
                                                    $ans .= '<label class="container1"><p><input type="radio" name="an'.$qno.'"  class="form-control" value="'.$arr[$i-1].'" id="true'.$qno.'">'.$arr[$i-1].'</p></label>';
                                                       }
                                                   }else if($question_type == "STQ" or $question_type == "MTQ"){
                                                   
                                                   
                                              
                                            for($i=1;$i<=4;$i++){ 
                                             
                                            $check_image = explode('.',$row['option'.$i]);
                                           
                                            $ext = strtolower(end($check_image));
                                           
                                             if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                 if($question_type=="STQ"){
                                                     $ans .=  '<label class="container1"><p><input class="" type="radio"   onclick="ClearAnswer('.$qno.')" name="an'.$qno.'"  class="form-control" value="'.$row['option'.$i].'" id="option'.$i.$qno.'"><img src = "../admin/pages/Upload/'.$row["option".$i].'" style="max-width:200px;max-height:100px" id="option1'.$qno.'"></p></label>';
                                                 }else if($question_type="MTQ"){
                                                    $ans .=  '<label class="container1"><p><input type="checkbox" name="an'.$i.$qno.'"  class="form-control" value="'.$row["option".$i].'" id="option'.$i.$qno.'"><img src = "../admin/pages/Upload/'.$row["option".$i].'" style="max-width:200px;max-height:100px" id="option1'.$qno.'"></p></label>';
                                                }
                                             }
                                             else{
                                                 if($question_type=="STQ"){
                                                 $ans .= '<label class="container1"><p><input class="" type="radio" id="option'.$i.$qno.'"  onclick="ClearAnswer('.$qno.')"  name="an'.$qno.'"  class="form-control" value="'.$row['option'.$i].'" id="option'.$i.$qno.'">'.$row['option'.$i].'</p></label>';
                                                 }
                                                 else if($question_type="MTQ"){
                                                    $ans .= '<label class="container1"><p><input type="checkbox" name="an'.$i.$qno.'"  class="form-control" value="'.$row["option".$i].'" id="option'.$i.$qno.'">'.$row['option'.$i].'</p></label>';
                                                 }
                                             }
                                             }
											}
                                           
                                                     
                                              
                                           
                                               $ans .= '
                                              
                                               
                                                <input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
                                               <input type="hidden" name="ran'.$qno.'" value="'.base64_encode($enan).'">
                                               </div>
                                               <div class="col-lg-4">
                                               ';

                                               if(!empty($Image)){
                                                $ans .='
                                             
                                                <img src="../admin/pages/'.$Image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                               }

                                               $ans .='</div></div></div>';


                                               echo $ans;

											
											}else{
                                                $ans = '<div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
                                                <div class="row mainrow">
                                                <div class = "col-sm-11">
                                                <p style="font-size:20px;margin-top:4px"><b style="font-size:22px;margin-top:4px">'.$qno.'.</b> '.$qs.'</p>
                                                </div>
                                                <div class="col-sm-1">
                                   
                                          
											 <a   class="btn btn-success m-b-xs tooltiper" href="javascript:void(0);"> <span style="color:#fff;font-size:16px;" class=" glyphicon glyphicon-question-sign">
											  <span class="tooltiptexter">
                                                  <p class="text-White">Positive Marks : '.$pmarks.'</p>
                                                 <p class="text-white">Negative Marks : '.$nmarks.'</p>
                                                 </span>
											 </a>
                                                 </div></div>
                                               ';
                                               
                                               
                                                                 
                                            $ans .='
                                                    <div class="row mainrow">
                                                   <div class="col-lg-8">';
                                                     if($question_type == "FQ"){
                                                       $ans .= '<label class="container1"><input type="text" name="an'.$qno.'" style="max-width:90%;" class="form-control" placeholder="Enter Your Answer" id="fill'.$qno.'"></label>';
                                                   }else if($question_type == "TQ"){
                                                       $arr = ['true','false'];
                                                       for($i=1;$i<=2;$i++){
                                                        $ans .= '<label class="container1"><p><input type="radio" name="an'.$qno.'"  class="form-control" value="'.$arr[$i-1].'" id="true'.$i.$qno.'">'.$arr[$i-1].'</p></label>';
                                                       }
                                                   }else if($question_type == "STQ" or $question_type == "MTQ"){
                                              
                                            for($i=1;$i<=4;$i++){ 
                                             
                                            $check_image = explode('.',$row['option'.$i]);
                                           
                                            $ext = strtolower(end($check_image));
                                           
                                             if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){

                                                if($question_type=="STQ"){
                                                    $ans .=  '<label class="container1"><p><input  class="" type="radio"   onclick="ClearAnswer('.$qno.')" name="an'.$qno.'"  class="form-control" value="'.$row['option'.$i].'" id="option'.$i.$qno.'"> <img src = "../admin/pages/Upload/'.$row["option".$i].'" style="max-width:200px;max-height:100px" id="option1'.$qno.'"></p></label>';
                                                }else if($question_type="MTQ"){
                                                    $ans .=  '<label class="container1"><p><input type="checkbox" name="an'.$i.$qno.'"  class="form-control" value="'.$row["option".$i].'" id="option'.$i.$qno.'"> <img src = "../admin/pages/Upload/'.$row["option".$i].'" style="max-width:200px;max-height:100px" id="option1'.$qno.'"></p></label>';

                                                }

                                                 	
                                             }
                                             else{
                                                if($question_type=="STQ"){
                                                    $ans .= '<label class="container1"><p><input class="" type="radio"  onclick="ClearAnswer('.$qno.')"name="an'.$qno.'"  class="form-control" value="'.$row['option'.$i].'" id="option'.$i.$qno.'">'.$row['option'.$i].'</p></label>';
                                                    }
                                                    else if($question_type="MTQ"){
                                                        $ans .= '<label class="container1"><p><input type="checkbox" name="an'.$i.$qno.'"  class="form-control" value="'.$row["option".$i].'" id="option'.$i.$qno.'">'.$row['option'.$i].'</p></label>';
                                                    }
                                               
                                             }
                                             }
                                                   }
                                                 
                                           
                                                     
                                              
                                           
                                               $ans .= '
                                              
                                               
                                                <input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
                                               <input type="hidden" name="ran'.$qno.'" value="'.base64_encode($enan).'">
                                               </div>
                                               <div class="col-lg-4">
                                               ';
                                             
                                                

                                                         if(!empty($Image)){
                                                       $ans .= '
                                                        <img src="../admin/pages/'.$Image.' " style="max-width: 100%; overflow:auto;object-fit:contain">';
                                                   } 

                                                   $ans .= '</div></div></div>';

                                                   
    
                                                   echo $ans;
												
											}

											$qno = $qno + 1;	

											
								// 			}

                                            }
                                            } else {
 
                                            }
											
											?>
                                          

                                          
                                           
                                            </div>
                                            
                                            <div class="container">
                                            <ul class="nav nav-tabs" role="tablist">
                                           
											<?php 
                                            include '../database/config.php';
                                            
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id'";
                                            $result = $conn->query($sql);
                                           
                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                            $total_questions = 0;

                                            while($row = $result->fetch_assoc()) {
                                            $total_questions++;
                                            $type = $row['type_val'];
                                            
                                        
                                           
											if ($qno == "1") {
                                               
                                            print '<li role="presentation" class="active" id="qchg'.$qno.'"><a href="#tab'.$qno.'" role="tab" data-toggle="tab" onclick="nextquestion('.$qno.','.$type.')">'.$qno.'</a></li>';	
                                         

											}else{
                                             
                                            print '<li role="presentation" id="qchg'.$qno.'"><a href="#tab'.$qno.'" role="tab" data-toggle="tab" onclick="nextquestion('.$qno.','.$type.')">'.$qno.'</a></li>';
                                          
                                            }
                                            

											$qno = $qno + 1;
                                            }
                                            } else {
 
                                            }
											
											?>
                                           

                                            <input type="hidden" name="tq" value="<?php echo "$total_questions"; ?>">
											<input type="hidden" id="exam_id" name="eid" value="<?php echo "$exam_id"; ?>">
											<input type="hidden" name="pm" value="<?php echo "$passmark"; ?>">
											<input type="hidden" name="ri" value="<?php echo "$recid"; ?>">
											
                                            </ul>
                                            </div>
											

                                        </div>
								<br>
                                <input   class="btn btn-success" type="submit" id="button_click" value="Submit Assessment">
											</form>


                                        <h2>Instruction:</h2>
                                        <h4>1) Please Do Not Click any External link otherwise Your exam will be submited as much as you have done. </h4>
                                        <h4>2) Please Do not refresh the Page while You are giving exam otherwise your exam will be submitted and exam result will be 0 marks.</h4>
                                        <h4>Best Of Luck !!</h4>




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
<audio src="../clockaudio.mpeg" id="audio_data"></audio>
        <div class="cd-overlay"></div>
        
        <div id ="WarningModal1" >
            <div id="message" class="text-center">
                <h2 id="content" ><b class="text-danger">Warning : </b> <br>Please Go Back To Full SCreen Mode Or Submit You Exam </h2> <br>
                <input type="hidden" id="data" >
                <button type="button" class="btn btn-warning" onclick="SubmitExam()">Submit Exam</button>
                  <button type="button" class="btn btn-warning" onclick="StartTest()">Go Back TO Full Screen</button>
            </div>
        </div>
        
        
        <!--<div id ="WarningModal" >-->
        <!--    <div id="message" class="text-center">-->
        <!--        <h2 id="content" ><b class="text-danger">Warning : </b> <br> You are advised not to switch the Tab or minimize the window.You have Only <span id="times">2</span> chance to open a new Tab.After that your exam will be submitted automatically.</h2> <br>-->
        <!--        <input type="hidden" id="data" >-->
        <!--        <button type="button" class="btn btn-warning" onclick="Warning()">OK</button>-->
        <!--    </div>-->
        <!--</div>-->
        
        <input type="hidden"  id="count_data" value="<?php echo $no_exit_fullscreen; ?>">
        </div>
	
</div>

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
		
		
        		 /* Get into full screen */
        function GoInFullscreen(element) {
        	if(element.requestFullscreen)
        		element.requestFullscreen();
        	else if(element.mozRequestFullScreen)
        		element.mozRequestFullScreen();
        	else if(element.webkitRequestFullscreen)
        		element.webkitRequestFullscreen();
        	else if(element.msRequestFullscreen)
        		element.msRequestFullscreen();
        }
        
        /* Get out of full screen */
        function GoOutFullscreen() {
        	if(document.exitFullscreen)
        		document.exitFullscreen();
        	else if(document.mozCancelFullScreen)
        		document.mozCancelFullScreen();
        	else if(document.webkitExitFullscreen)
        		document.webkitExitFullscreen();
        	else if(document.msExitFullscreen)
        		document.msExitFullscreen();
        }
        
        /* Is currently in full screen or not */
        function IsFullScreenCurrently() {
        	var full_screen_element = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || null;
        	
        	// If no element is in full-screen
        	if(full_screen_element === null)
        		return false;
        	else
        		return true;
        }
        
        $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
        	if(IsFullScreenCurrently()) {
        	}
        	else {
        	    
        	 	var exam_id = document.querySelector('#exam_id').value;
        	 	var count =document.querySelector('#count_data').value;
        	 	if(count > 1){
        	 	   
        	 	 $.ajax({
        		     url:'Warning.php',
        		     type:'post',
        		     data:{
        		         count:count,
        		         exam_id:exam_id
        		     },
        		     success:function(data){
        		      //   if(data == 1){
        		          document.querySelector('#WarningModal1').style.display="block";
        		           
        		            document.querySelector('#count_data').value = count-1;
        		            document.querySelector('#count_msg').innerHTML = '<b>Warning :Your are not allowed to exit the fullscreen mode while given the exam.</b>';
        		      //   }
        		         
        		         
        		     }
        		     
                	})
        	 	}else if(count <= 1){
        	 	      document.quiz.submit(); 
        	 	}
        	 	
        	}
        }); 
		
		
		
		
		
		function StartTest(){
		    if(IsFullScreenCurrently()){
        		GoOutFullscreen();
        	
        		
        	
		    }
        	else{
        		GoInFullscreen($("#mybody").get(0));
        		document.querySelector('#WarningModal1').style.display="none";
        		document.querySelector('#mainbody').style.display="block";
        	}
		}
		
		
		
		function SubmitExam(){
		     document.quiz.submit();
		}
		
		
		
// count
		
// 	 document.addEventListener('visibilitychange',()=>{
//         // document.title = document.visibilityState;
//         // console.log(document.visibilityState);
//         // console.log(document.hidden);
//         if(document.visibilityState == "hidden"){
//             //code for submiting the exam automatically when student opens new tab
//          var count = document.querySelector('#times').innerHTML;
// 		 var exam_id = document.querySelector('#exam_id').value;
// // 		 alert(count+"/"+exam_id);
// 		 if(count >= 2){
// 		   $.ajax({
// 		     url:'Warning.php',
// 		     type:'post',
// 		     data:{
// 		         count:count,
// 		         exam_id:exam_id
// 		     },
// 		     success:function(data){
// 		         var maincount = count-1;
// 		         $('#times').html(maincount);
// 		          document.querySelector('#data').value=maincount;
// 		          document.querySelector('#WarningModal').style.display="block";
		         
		         
// 		     }
		     
//         	})
// 		 }else if(count<=1){
// 		    var maincount = count-1;
// 		      document.querySelector('#times').innerHTML =maincount;
// 		      document.querySelector('#data').value=maincount;
// 		     document.querySelector('#content').innerHTML= "Now Your Exam Will Automatically Submit and Your Result Will Decleared as Copied In Exam";
// 		      document.querySelector('#WarningModal').style.display="block";
		   
// 		 }
            
          
		         
		         
		
            
         
//         }
//     })
		
		

			function ClearAnswer(qno){
				    
				    for(var i=1;i<=4;i++){
				        var x = document.querySelector('#option'+i+qno);
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

		
  function checkForm(form) // Submit button clicked
  {
    form.button_click.disabled = true;
    form.button_click.value = "Please wait...";
    return true;
  }
		
		
		
		
                var pre=1;
                var flag=0;
                var type_val;
                
         window.onload = () =>{
            var type_val_first_question = document.getElementById("typevalue").value;
            // alert(type_val_first_question);
       
          type_val = type_val_first_question;
          
        }
                
                
function nextquestion(qno,type){
    
if(type_val == 0){
    var y = document.getElementById("fill"+pre);
    if(y.value != ''){
       document.getElementById('qchg'+pre).className = "bg-success";  
    }
    else{
       document.getElementById('qchg'+pre).className = "bg-danger"; 
    }
    
    
    
    
    
    
}else if (type_val ==2){
     for(var i=1;i<=2;i++){
        var x = document.getElementById("true"+i+pre);
        
        if(x.checked === true){
            flag=1;
            break;
        }
        else{
            flag=0;
        }
      
    }
    if(flag == 1){
        document.getElementById('qchg'+pre).className = "bg-success";
    }
    else{
        document.getElementById('qchg'+pre).className = "bg-danger";
    }
    
}
else{

 for(var i=1;i<=4;i++){
        var x = document.getElementById("option"+i+pre);
        
        if(x.checked === true){
            flag=1;
            break;
        }
        else{
            flag=0;
        }
      
    }
    if(flag == 1){
        document.getElementById('qchg'+pre).className = "bg-success";
    }
    else{
        document.getElementById('qchg'+pre).className = "bg-danger";
    }
}
  
    pre=qno;
   type_val = type;

}


//reseting the option which was checked by user


// function resetoption(question_no){
//     console.log(question_no);
//     for(var i=1;i<=4;i++){
//         document.getElementById("option"+i+question_no).checked =true;
    
//     }
// }









function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}








</script>

<script type="text/javascript">




//check for Navigation Timing API support
// if (window.performance) {
//   console.info("window.performance works fine on this browser");
// }
// console.info(performance.navigation.type);
if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    
   window.onload = () => {
    
         document.quiz.submit();
     }
} 



var max_time = <?php 



date_default_timezone_set('Asia/Kolkata');


$sql = "select * from tbl_examinations where exam_id='$exam_id'";
$result = $conn->query($sql);
$arr = $result->fetch_assoc();

$exam_time = date("H:i:s",strtotime($arr['edate']));
$duration = $arr["duration"];

$endTime = strtotime(date("H:i:s", strtotime($arr['edate'])+($duration*60)));

$current_time = strtotime(date("H:i:s"));


if($restriction_check == "Non Restricted"){
    echo $duration;
}else if($restriction_check == "Restricted"){
$mins = (int)(($endTime - $current_time) / 60);
echo $mins;
}



?>;
var c_seconds  = 0;
var total_seconds =60*max_time;
max_time = parseInt(total_seconds/60);
c_seconds = parseInt(total_seconds%60);
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + 'Min';
function init(){


document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min';
setTimeout("CheckTime()",999);
}
function CheckTime(){
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min' ;
if(total_seconds <= 0){
setTimeout('document.quiz.submit()',1);
var audio =  document.getElementById('audio_data');
audio.autoplay = true;
audio.pause();
audio.currentTime = 0;
}
else
{
if(total_seconds < 60 && total_seconds > 0 ){
        var audio =  document.getElementById('audio_data');
        audio.autoplay = true;
        audio.play();
     
     }
    total_seconds = total_seconds -1;
    max_time = parseInt(total_seconds/60);
    c_seconds = parseInt(total_seconds%60);
    setTimeout("CheckTime()",999);
}

}
init();






  


</script>
    </body>

</html>


