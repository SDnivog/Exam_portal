<?php
session_start();

date_default_timezone_set('Asia/Kolkata');
include '../database/config.php';

$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] 
                === 'on' ? "https" : "http") . "://" . 
          $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; 
  
$_SESSION['exam_out_url'] = $link;

$email = $_SESSION['email'];
$stu_id =    $_SESSION['id'];
$myname = $_SESSION['username'];


$exam_id = $_GET['eid'];


// code if exam is over

date_default_timezone_set('Asia/Kolkata');

$sql = "select * from tbl_examinations where exam_id='$exam_id' and status='Active'";
$result = $conn->query($sql);
$arr = $result->fetch_assoc();

$exam_time = date("H:i:s",strtotime($arr['edate']));
$duration = $arr["duration"];

$endTime = strtotime(date("H:i:s", strtotime($arr['edate'])+($duration*60)));

$current_time = strtotime(date("H:i:s"));


$exam_date = date("Y-m-d",strtotime($arr['edate']));
$current_date = date("Y-m-d");


$mins = (int)(($endTime - $current_time) / 60);



if($current_date >= $exam_date){
    if($mins <= 0){
      header('location:timeover.php');
    }
    else if(!isset($_SESSION['id']) and !isset($_SESSION['email'])){
    
    $sql_active = "select * from tbl_examinations where exam_id='$exam_id' and status='Active'";
    $result_check = $conn->query($sql_active);
    if($result_check->num_rows>0){
            $arr = $result_check->fetch_assoc();
            $today_date = date("Y-m-d");
            
            if($today_date >= date("Y-m-d",strtotime($arr['edate']))){
                $today_time = date("H:i:s",strtotime(date("Y-m-d H:i:s")));
                if($today_time >= date("H:i:s",strtotime($arr['edate']))){
                    header('location:details.php?eid='.$exam_id.'');
                }else{
                    $_SESSION['data'] = "time";
                    header('location:message.php?eid='.$exam_id.''); 
                }
            
               
            }else {
                  $_SESSION['data'] = "date";
                  header('location:message.php?eid='.$exam_id.''); 
            }
            
         
    }else {
          $_SESSION['data'] = "noactive";
          header('location:message.php?eid='.$exam_id.'');
    }
    

}
}
else{
    header('location:timeover.php'); 
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
    $next_retake = date('m/d/Y', strtotime($today_date. ' + '.$reexam.' days'));
	
	$no_exit_fullscreen = $row['no_exit'];
	$today_date = date('m/d/Y');
	$restriction_check= $row['Restrict_time'];
    }
} 







?>


<!DOCTYPE html>
<html>
    
<head>
        
    
        <title>Kendel | Examination</title>
        
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
        
        @media screen and (max-width:1200px){
            .mainrow{
                /*display: flex;*/
                /*flex-direction: column-reverse;*/
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
.logo-box{
    /*background:lightgreen;*/
    width:180px;
    padding:15px;
}
.timer_test{
    color:#333;
    font-size:18px;
}
        
        
        

#WarningModal1{
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
#WarningModal1 h2{
    color:#1b2631;
  
    font-size:22px;
    line-height:1.5;
}
#WarningModal1 #message{
    padding:10px;
    position:absolute;
    top:30%;
    left:50%;
    transform:translate(-50%,0%);
    background:white;
    /*height:200px;*/
}
@media only screen and (max-width:900px){
       #WarningModal1 #message{
    padding:10px;
    position:absolute;
    width:100%;
    top:20%;
    left:50%;
    transform:translate(-50%,0%);
    background:white;
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
	<body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?> id="mybody"  class="page-header-fixed page-horizontal-bar " >
	    <button type="button" id="Start" onclick="StartTest()">Start Exam</button>
     <div id="mainbody" style="display:none">
        <main class="page-content content-wrap container">
               <div class="page-inner">
             
                <div class="page-title">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-md-6"><a class="logo-text text-dark"><span><img src="../logo.png" style="width:160px;"></span></a></div>
                         <div class="col-md-6 timer_test text-center" id="quiz-time-left"></div>
                         
                    </div>
                   
               
                </div> <br>
                    
                    <h3 class="text-center">Examination</h3>
                    <h2 class="text-center"><?php echo $exam_name; ?></h2>
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
										
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id'";
                                            $result = $conn->query($sql);
                                             $row_count = $result->num_rows;

                                            if ($result->num_rows > 0) {
                                            $qno = 1;
                                         
                                          
                                            while($row = $result->fetch_assoc()) {
                                                $qsid = $row['question_id'];
                                                $qs = $row['question'];
                                                $question_type =$row['question_type'];
												$Pmark = $row['pos_marks'];
												$Nmark =$row['neg_marks'];
												$type = $row['type'];
												$op1 = $row['option1'];
												$op2 = $row['option2'];
												$op3 = $row['option3'];
												$op4 = $row['option4'];
												$ans = $row['answer'];
                                                $Image = $row['image'];//Added by Govind
												$enan = $row[$ans];
												
                                           
                                           
                                
                                           
                                           	if ($qno%2 != 0) {
                                               
                                            print '<div class="row">
                                              
                                                <div class="col-md-6">
                                            <div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">';
                                            
                                             print '
                                            	<div class="row" style="display:flex;margin-top:20px">
                                            	
                                                     <div class="col-1" style="margin-right:10px">
                                                    <p style="font-size:22px;margin-top:4px"><b>'.$qno.'.</b> </p></div>';
                                                    
                                                 
                                                    print '
                                                     <div class="col-11">';
                                                     
                                                     if(!empty($qs)){
                                                    print '<p style="font-size:20px;margin-top:4px">'.$qs.'</p>';
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
                                            <img src="../admin/pages/'.$Image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }
                                           print ' </div>';
                                                 print' <div class="col-lg-12">';
                                                 
                                             if($question_type == "STQ"){
                                                 print '
                                              
                                                 <div class="radiobtn" id="radiobtn'.$qno.'" style="display:flex">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                               
                                              
                             print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input class="" type="radio" id="clearradio'.$i.$qno.'"onclick="ClearAnswer('.$qno.')" name="an'.$qno.'"  class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';

                                                }
                                                  print '</div>';
                                            
                                             }
                                                 
                                           
                                                     
                                          
                                            // code for checkbox 
                                              if($question_type == "MTQ"){
                                            print' <div class="checkbtn" id="checkbtn'.$qno.'" style="display:flex">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                $arr = ['A','B','C','D'];
                                              
                                               
                                                print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="checkbox" name="an'.$i.$qno.'"  class="form-control" value='.$row['option'.$i].'> '.  $row['option'.$i].'</p></label>';

                                                
                                              }
                                            
                                                print '</div>';
                                             }
                                                 
                                           
                                                     
                                        
                                            // code for fill
                                               if($question_type == "FQ"){
                                             print' <div class="fillbtn" id="fillbtn'.$qno.'">
                                                 ';
                                                 
                                     print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input style="max-width:100%" type="text" name="an'.$qno.'" placeholder="Enter Answer"  class=" active"  > </p></label>';
                                       print '</div>';
                                            }
                                                
                                            
                                             
                                                 
                                           
                                                     
                                          
                                              if($question_type=="TQ"){
                                            /// code for true or false
                                            print' <div class="truebtn" id="truebtn'.$qno.'"  style="display:flex">
                                                 ';
                                                   
                                            for($i=1;$i<=2;$i++){ 

                                                $arr = ['true','false'];
                                                $mainarr = ['A','B'];
                                                
                                              
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio" name="an'.$qno.'"  class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                }
                                                             
                                            print '</div>';
                                            
                                             }
                                                 
                                           
                                        
                                            
                                                 

                                            print '</div> </div>';

                                           
                                             
                                             print '<hr>';



                                            
                                              
										    print'
                                             </div></div>
											';		
											}else{
                                                print '<div class="col-md-6">
                                            <div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">';
                                            
                                             print '
                                            	<div class="row"  style="display:flex;margin-top:20px;">
                                                    <div class="col-1" style="margin-right:10px">
                                                    <p style="font-size:20px;margin-top:4px"><b>'.$qno.'.</b> </p></div>';
                                                    
                                                 
                                                    print '
                                                     <div class="col-11">';
                                                      
                                                     if(!empty($qs)){
                                                    print '<p style="font-size:20px;margin-top:4px">'.$qs.'</p>';
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
                                            <img src="../admin/pages/'.$Image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }

                                           print'</div>';

                                                   print '<div class="col-lg-2">
                                                   <input type="hidden" name="question_type'.$qno.'" value="single" id="question_type'.$qno.'">';
                                                   
                                         if($question_type == "STQ"){
                                                 print '
                                              
                                                 <div class="radiobtn" id="radiobtn'.$qno.'" style="display:flex">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                               
                                              
                                                 print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input  class="" type="radio" id="clearradio'.$i.$qno.'" onclick="ClearAnswer('.$qno.')" name="an'.$qno.'"  class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';

                                                }
                                                               
                                            print '</div>';
                                            
                                             }
                                                 
                                           
                                      
                                            // code for checkbox 
                                              if($question_type == "MTQ"){
                                            print' <div class="checkbtn" id="checkbtn'.$qno.'" style="display:flex">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                $arr = ['A','B','C','D'];
                                              
                                               
                                                print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="checkbox" name="an'.$i.$qno.'"  class="form-control" value='.$row['option'.$i].'> '.  $row['option'.$i].'</p></label>';

                                                
                                              }
                                                         
                                            print '</div>';
                                             }
                                                 
                                           
                                        
                                            // code for fill
                                               if($question_type == "FQ"){
                                             print' <div class="fillbtn" id="fillbtn'.$qno.'" style="display:flex">
                                                 ';
                                                 
                                     print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input style="max-width:100%" type="text" name="an'.$qno.'" placeholder="Enter Answer"  class=" active"  > </p></label>';
                                      print '</div>';
                                            }
                                                
                                            
                                             
                                                 
                                           
                                                     
                                           
                                              if($question_type=="TQ"){
                                            /// code for true or false
                                            print' <div class="truebtn" id="truebtn'.$qno.'" style="display:flex" >
                                                 ';
                                                   
                                            for($i=1;$i<=2;$i++){ 

                                                $arr = ['true','false'];
                                                $mainarr = ['A','B'];
                                                
                                              
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio" name="an'.$qno.'"  class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                }
                                                   print '</div>';
                                            
                                             }
                                                 
                                           
                                                     
                                         
                                            
                                                 

                                            print '</div> </div>';
                                          
                                            
                                            print '<hr>';
                                           
                                                
										    print'
                                                 </div></div></div>
                                                ';
											
                                            }
                                          
                                           

                                            
                                          
                                            $qno = $qno + 1;	
                                            

											
                                            }
                                             print '<input type="hidden" name="tq" value="'.$total_question.'"">
											<input type="hidden" name="eid" id="exam_id" value="'.$exam_id.'">
											<input type="hidden" name="pm" value="'.$passmark.'">
											<input type="hidden" name="ri" value="'.$recid.'">';
                                          
                                                  
                                          
                                   
                                            
                                            } else {
 
                                            }
                                            
                                             
                                            
                           
                                            
											
											?>
                                          
                                          
                                          
                                           
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
    <div id ="WarningModal1" >
            <div id="message" class="text-center">
                <h2 id="content" ><b class="text-danger">Warning : </b> <br>Please Go Back To Full Screen Mode Or Submit You Exam</h2> <br>
                <input type="hidden" id="data" >
                <button type="button" class="btn btn-warning" onclick="SubmitExam()">Submit Exam</button>
                  <button type="button" class="btn btn-warning" onclick="StartTest()">Go Back TO Full Screen</button>
            </div>
    </div>

   <input type="hidden"  id="count_data" value="<?php echo $no_exit_fullscreen; ?>">
        <div class="cd-overlay"></div>
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
		
			function ClearAnswer(qno){
				    
				    for(var i=1;i<=4;i++){
				        var x = document.querySelector('#clearradio'+i+qno);
				        if(x.className == ""){
				        if(x.checked == true){
				        
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
		
	
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}








</script>

<script type="text/javascript">

  		
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
        	 	if(count>1){
        	 	 $.ajax({
        		     url:'Warning.php',
        		     type:'post',
        		     data:{
        		         count:count,
        		         exam_id:exam_id
        		     },
        		     success:function(data){
        		      //   if(data >= 2){
        		      //      document.quiz.submit(); 
        		      //   }else{
        		            document.querySelector('#WarningModal1').style.display="block";
        		            document.querySelector('#count_data').value = count-1;
        		            document.querySelector('#count_msg').innerHTML = '<b>Warning :Your are not allowed to exit fullscreen mode while giving test.</b>';
        		      //   }
        		         
        		         
        		     }
        		     
                	})
        	 	}else if(count <=1){
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
if(total_seconds <=0){
setTimeout('document.quiz.submit()',1);
var audio =  document.getElementById('audio_data');
        audio.autoplay = true;
         audio.pause();
         audio.currentTime = 0;
    
    } else
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









