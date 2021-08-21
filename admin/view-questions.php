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
header("location:./");	
}

}else{
header("location:./");	
}
?>
<!DOCTYPE html>
<html>
    
<head>
        
    
        <title>Kendel | View Exam</title>
        
       
       <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Online Examination System" />
        <meta name="keywords" content="Online Examination System" />

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
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

.Modal,.Modal3{
    position:fixed;
    top:0%;
    left:0%;
    z-index:999;
    display:none;
    width:100%;
    height:100%

    
}
.Modal1,.Modal4{
    position:relative;
    display:flex;
    justify-content:center;
    align-items:center;
    
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
}

.Modal form ,.Modal3 form{
    position:relative;
    
    width:30%;
    background:white;
    padding:50px;
    /* transform:translate(-50%,-50%); */
    border-radius:10px;

}

.Modal form h4,.Modal3 form h4{
    text-align:center;
}

.question_area{
    width:350px;
}

@media screen and (max-width:1000px){
    .Modal form, .Modal3 form{
    width:80%;
    overflow-y:auto;
  
}
.question_area{
    width:100%;
}

}
@media screen and (max-width:995px){

.question_area{
    width:280px;
}


}
@media screen and (max-width:595px){

.question_area{
    width:100%;
}

}


.switch-button {
  width: 200px;
  height: 30px;
  text-align: center;
  will-change: transform;
  z-index: 197 !important;
  cursor: pointer;
  transition: 0.3s ease all;
  border: 1px solid black;
}
.switch-button-case {
  display: inline-block;
  background: none;
  width: 49%;
  height: 100%;
  color: #333;
  position: relative;
  border: none;
  transition: 0.3s ease all;
  text-transform: uppercase;
  letter-spacing: 5px;
  padding-bottom: 1px;
}
.switch-button-case:hover {
  color: grey;
  cursor: pointer;
}
.switch-button-case:focus {
  outline: none;
}
.switch-button .active {
  color: #fff;
  background-color: #000;
  position: absolute;
  left: 0;
  top: 0;
  width: 50%;
  height: 100%;
  z-index: -1;
  transition: 0.3s ease-out all;
}
.switch-button .active-case {
  color: #fff;
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
                        <!--<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <!--<li><a href="liveclass.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Live Class</p></a></li>-->
                        <li class="active"><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!--<li ><a href="assignment.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Assignments</p></a></li>-->
                        <li ><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <!--<li ><a href="material.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Notes</p></p></a></li>-->
                        <!--<li><a href="doubts.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Doubts</p></a></li>-->
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
                                        <div  role="tabpanel" >
                                            
                                            <ul class="nav nav-tabs" role="tablist">
			
                                                <?php
                                                    $sql5 = "select * from tbl_examinations where user_id='$login_user_id' and exam_id='$exam_id'";
                                                    $result5= $conn->query($sql5);
                                                    while($row_sec = $result5->fetch_assoc() ){
                                                        $sec=explode('/', $row_sec['section_name']);
                                                        $i=0;
                                                           foreach($sec as $out) {
                                                             
                                                            if(!empty($out)){
                                                                
                                                                $main_out =str_replace(' ', '', $out);
                                                                echo '<li role="presentation" id="tab-name'.$i.'" class="';
                                                                if($i==0){echo "active";}  
                                                                echo '"><a href="#'.$main_out.'" role="tab" data-toggle="tab">'.$out.'</a></li>';
                                                                $i++;
                                                            }
                                             
                                                    
                                                }
                                                echo '<input type="hidden" value="'.$i.'" id="total-tab">';
                                                    }


                                                ?>									
												
						

                                            </ul>
                                              <div class="tab-content">
                                            <?php 
                                            
                                             $sql6 = "select * from tbl_examinations where user_id='$login_user_id' and exam_id='$exam_id'";
                                                $result6= $conn->query($sql6);
                                                    while($row_sec1 = $result6->fetch_assoc() ){
                                                        $sec1=explode('/', $row_sec1['section_name']);
                                                        $i=0;
                                                           foreach($sec1 as $out1) {
                                                if(!empty($out1)){
                                                         $main_out =str_replace(' ', '', $out1);
                                            ?>
                                       
                                          
                                                <div role="tabpanel" class="tab-pane  fade in <?php if($i==0){echo 'active';} ?>" id="<?php echo $main_out; ?>">
											<?php 
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' and sec_name='$out1' order by id";
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
                                                $hindi_image = $row['hindi_image'];
                                                $pmarks = $row['pos_marks'];
                                                $nmarks = $row['neg_marks'];
                                                $question_type = $row['question_type'];
                                                
                                                $bonus = $row['bonus'];
                                                
                                                $par_status = $row['par_status'];
                                                
                                                
											
											if ($qno%2 != 0) {
                                                if($count == 1){
                                                    print '<form method="post" action="pages/add-section-option.php?section_name='.$out1.'" >';
                                                }
                                                
                                            print '<div class="row  ">
                                              
                                                <div class="col-md-6  "><span id="'.$q_id.'"></span>
                                            <div role="tabpanel" class="tab-panel active fade in" id="tab'.$qno.'">';
                                             if($answer == ''){
                                            
                                            print '
                                                <button type="button" onclick="Open(this.id,'.$qno.')" id="single">Single</button>
                                                <button type="button" onclick="Open(this.id,'.$qno.')" id="multiple">Multiple</button>
                                                <button type="button" onclick="Open(this.id,'.$qno.')" id="fill">Fill</button>
                                                <button type="button" onclick="Open(this.id,'.$qno.')" id="true">True</button>
                                                ';
                                             }
                                             print '
                                            	<div class="row" style="display:flex;margin-top:20px">
                                            	
                                                     <div class="col-1" style="margin-right:10px">
                                                    <p style="font-size:22px;margin-top:4px"><b>'.$qno.'.</b> </p></div>';
                                                    
                                                 
                                                    print '
                                                     <div class="col-11">';
                                                     
                                                     if(!empty($qs)){
                                                    print '<p style="font-size:20px;margin-top:4px">'.$qs.'</p>';
                                                    print '<input type="hidden" name="question'.$main_out.$qno.'" value="'.$qs.'">';
                                                    }   else{
                                                        print'
                                                     <div class="form-group">
                                                        <input type="text" class="form-control question_area" placeholder="Enter Question"  name="question'.$main_out.$qno.'"  autocomplete="off">
                                                    </div>';
                                                    }
                                                    print '
                                                     
                                                    </div>
                                                </div>
                                            
                                             ';
                                             
//                                                                                           <div>
// <div class="switch-button"><span class="active"></span>
//   <button class="switch-button-case left active-case">English</button>
//   <button class="switch-button-case right">Hindi</button>
// </div>
// </div>
                                            
                                            print'
                                                    <div class="row mainrow">
                                                    <div class="col-lg-12">';
                                                   
                                             if(!empty($Image) and empty($hindi_image) ){
                                                print'
                                            <img src="pages/'.$Image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }else if(!empty($hindi_image) and empty($Image)){
                                                print'
                                            <img src="pages/'.$hindi_image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }else if (!empty($Image) and !empty($hindi_image)){
                                              print ' 
                                              

                                              <div>  <select onchange="FetchImage(this.value,'.$qno.')"  class="form-control" style="margin-bottom:10px">
                                                    <option value="English">English</option>
                                                    <option value="Hindi">Hindi</option>
                                                    </select></div>    
                                        
                                                    
                                                    
                                            ';
                                       
                                                   print'
                                            <img src="pages/'.$Image.' " id="english'.$main_out.$qno.'" style="max-width: 100%;overflow:auto;object-fit:contain">';
                                                print'
                                            <img src="pages/'.$hindi_image.' "  id="hindi'.$main_out.$qno.'" style="max-width: 100%;overflow:auto;object-fit:contain;display:none">';
                                           }
                                           print ' </div>';
                                                 print' <div class="col-lg-12">   <input type="hidden" name="question_type'.$qno.'" value="single" id="question_type'.$main_out.$qno.'">';
                                                 
                                           
                                                 print '
                                              
                                                 <div class="radiobtn" id="radiobtn'.$main_out.$qno.'" style="';
                                                 
                                                 if($answer != ''  and $question_type == "STQ"){
                                                     print "display:flex";
                                                 }
                                                  else if( $answer == "" and $question_type == "STQ"){
                                                    print "display:flex";                                                             
                                                 }
                                                 else if( $answer == "" and $question_type == ""){
                                                    print "display:flex";                                                             
                                                 }else{
                                                     print "display:none"; 
                                                 }

                                                 print '">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                $arr = ['A','B','C','D'];
                                                if($question_type == "STQ"){
                                             
                                                if( $answer =="option".$i){
                                             print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input  type="radio"   class="form-control active" value='.$row['option'.$i].' checked="checked"> '.$row['option'.$i].'</p></label>';
                                                }else{
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio"   class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';

                                                }
                                                }
                                                else{
                                        print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input class="" type="radio" id="clearradio'.$i.$qno.'" name="answerradio'.$qno.'"   class="form-control" value='.$row['option'.$i].' onclick="ClearAnswer('.$qno.')"> '.$row['option'.$i].'</p></label>';

                                                }
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            // code for checkbox 
                                            print' <div class="checkbtn" id="checkbtn'.$main_out.$qno.'" style="';
                                            
                                            if($answer != '' and $question_type == "MTQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                                 
                                            
                                            print '">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                $arr = ['A','B','C','D'];
                                                if($question_type == "MTQ"){
                                               
                                                
                                            if(strpos($answer,'option'.$i)  !== false){
                                                      print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="checkbox"   class="form-control active" value='.$row['option'.$i].' checked="checked"> '.$row['option'.$i].'</p></label>';
                                               
                                                }
                                                 else{
                                                     
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="checkbox"   class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';

                                                }
                                                
                                                }
                                                else{
                                                    print '<label class="container1"  style="display:flex;margin:30px 0px;"><p><input type="checkbox" name="answercheckbox'.$i.$qno.'"  class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';

                                                }
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            // code for fill
                                            
                                         
                                            
                                             print' <div class="fillbtn" id="fillbtn'.$main_out.$qno.'" style="';
                                                 if($answer != '' and $question_type == "FQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                             print '">
                                                 ';
                                                   
                                            if($question_type == "FQ"){
                                                 print '<label class="container1 " style="margin:30px 0px;"><p> '.$answer.'</p></label>';
                                            }else{  
                                     print '<label class="container1 " style="margin:30px 0px;"><p><input type="text" style="width:90%" name="answerfill'.$qno.'" placeholder="Enter Answer"  class="form-control active" > </p></label><p><b>Note :</b>If you want to assign a range value answer eg.12-13 or 12.4-13.9<p>';
                                            }
                                            
                                             
                                                 
                                           
                                                     
                                            print '</div>';
                                            
                                            /// code for true or false
                                            print' <div class="truebtn" id="truebtn'.$main_out.$qno.'" style="';
                                            
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
                                                $mainarr = ['A','B'];
                                                
                                                if($question_type=="TQ"){
                                             
                                                if($mainarr[$i-1] == $row[$answer]){
                                                 print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio"  class="form-control active" value='.$arr[$i-1].' checked="checked"> '.$arr[$i-1].'</p></label>';
                                                }
                                                 else{
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio"   class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                }
                                                }
                                                else{
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio" name="answertrue'.$qno.'"  class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                }
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            
                                                 

                                            print '</div> </div><button type="button" id="update'.$qno.'" class=" btn btn-success" onclick="Update('.$qno.')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';

                                            print '<a  href="delete_question.php?question_id='.$q_id.'&exam_id='.$exam_id.'&sec_name=section" style="color:white"><button type="button"  class="delete btn btn-danger" > <i class="fa fa-trash-o"></i></button></a>';
                                            
                                            
                                            if(!empty($Image) and !empty($hindi_image)){
                                              print '<a  href="delete_question_image.php?question_id='.$q_id.'&exam_id='.$exam_id.'&sec_name=section&type=english" style="color:white"><button type="button"  class="delete btn btn-warning"  >Remove English Image</button></a>';
                                              print '<a  href="delete_question_image.php?question_id='.$q_id.'&exam_id='.$exam_id.'&sec_name=section&type=hindi" style="color:white"><button type="button"  class="delete btn btn-warning"  >Remove Hindi Image</button></a>';
                                            }
                                            
                                            
                                            
                                            else if(!empty($Image)){
                                            print '<a  href="delete_question_image.php?question_id='.$q_id.'&exam_id='.$exam_id.'&sec_name=section&type=normal" style="color:white"><button type="button"  class="delete btn btn-warning"  >Remove Image</button></a>';
                                            }
                                            
                                            if($question_type == "MTQ" and $par_status== 0){
                                                print '<a class="btn btn-primary" type="submit" href="pages/partial.php?question_id='.$q_id.'&exam_id='.$exam_id.'&data=par">Partial Marks</a>';
                                            }else if($question_type == "MTQ" and $par_status== 1){
                                                 print '<a class="btn btn-primary" type="submit" href="pages/partial.php?question_id='.$q_id.'&exam_id='.$exam_id.'&data=nopar">Remove Partial Marks</a>';
                                            }
                                            
                                            $sql_checking = "select * from tbl_assessment_records where exam_id='$exam_id'";
                                            $result_checking = $conn->query($sql_checking);
                                            if($result_checking->num_rows>0){
                                             if($bonus == 0){
                                             print '<a href="pages/bonus-question.php?question_id='.$q_id.'&page=3&exam_id='.$exam_id.'" class="btn btn-info">Bonus Question</a>';
                                            }else{
                                               print '<a href="pages/nobonus-question.php?question_id='.$q_id.'&page=3&exam_id='.$exam_id.'" class="btn btn-info">Remove Bonus</a>'; 
                                            }
                                            }
                                             print '<hr>';

                                             
                                             print '<input type="hidden" name="question_id'.$qno.'"  id="question_id'.$out1.$qno.'" value="'.$q_id.'" >';
                                              
										    print'
                                             </div></div>
											';		
											}else{
                                                print '<div class="col-md-6"><span id="'.$q_id.'"></span>
                                            <div role="tabpanel" class="tab-panel active fade in" id="tab'.$qno.'">';
                                             if($answer == ''){
                                            
                                            print '
                                                <button type="button" onclick="Open(this.id,'.$qno.')" id="single">Single</button>
                                                <button type="button" onclick="Open(this.id,'.$qno.',)" id="multiple">Multiple</button>
                                                <button type="button" onclick="Open(this.id,'.$qno.')" id="fill">Fill</button>
                                                <button type="button" onclick="Open(this.id,'.$qno.')" id="true">True</button> <br>
                                                ';
                                             }
                                             print '
                                            	<div class="row"  style="display:flex;margin:20px 0px;">
                                                    <div class="col-1" style="margin-right:10px">
                                                    <p style="font-size:20px;margin-top:4px"><b>'.$qno.'.</b> </p></div>';
                                                    
                                                 
                                                    print '
                                                     <div class="col-11">';
                                                     if(!empty($qs)){
                                                    print '<p style="font-size:20px;margin-top:4px">'.$qs.'</p>';
                                                    print '<input type="hidden" name="question'.$main_out.$qno.'" value="'.$qs.'">';
                                                    }  else{
                                                        print'
                                                     <div class="form-group">
                                                        <input type="text"  class="form-control question_area" placeholder="Enter Question"  name="question'.$main_out.$qno.'"  autocomplete="off">
                                                    </div>';
                                                    }
                                                    print '
                                                     
                                                    </div>
                                                </div>
                                            
                                             ';
                                            
                                               print'
                                                    <div class="row mainrow">';
                                                    print'<div class="col-lg-12">';
                                             if(!empty($Image) and empty($hindi_image)){
                                                print'
                                            <img src="pages/'.$Image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }else if(!empty($hindi_image) and empty($Image)){
                                                print'
                                            <img src="pages/'.$hindi_image.' " style="max-width: 100%;overflow:auto;object-fit:contain">';
                                           }else if (!empty($Image) and !empty($hindi_image)){
                                               print' <div><select onchange="FetchImage(this.value,'.$qno.')"  class="form-control" style="margin-bottom:10px">
                                                    <option value="English">English</option>
                                                    <option value="Hindi">Hindi</option>
                                                    </select></div>';
                                                   print'
                                            <img src="pages/'.$Image.' " id="english'.$main_out.$qno.'" style="max-width: 100%;overflow:auto;object-fit:contain">';
                                                print'
                                            <img src="pages/'.$hindi_image.' " id="hindi'.$main_out.$qno.'" style="max-width: 100%;overflow:auto;object-fit:contain;display:none">';
                                           }

                                           print'</div>';

                                                   print '<div class="col-lg-12">
                                                   <input type="hidden" name="question_type'.$qno.'" value="single" id="question_type'.$main_out.$qno.'">';
                                                   
                                          print '
                                              
                                                 <div class="radiobtn" id="radiobtn'.$main_out.$qno.'" style="';
                                                 
                                                 if($answer != '' and $question_type == "STQ"){
                                                     print "display:flex";
                                                 } else if( $answer == "" and $question_type == "STQ"){
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

                                                $arr = ['A','B','C','D'];
                                                if($question_type == "STQ"){
                                             
                                                if($answer=="option".$i){
                                                 print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input  type="radio"   class="form-control active" value='.$row['option'.$i].' checked="checked"> '.$row['option'.$i].'</p></label>';
                                                }else{
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio"   class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';

                                                }
                                                }
                                                else{
                                                  print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input class="" type="radio" id="clearradio'.$i.$qno.'" name="answerradio'.$qno.'"   class="form-control" value='.$row['option'.$i].' onclick="ClearAnswer('.$qno.')"> '.$row['option'.$i].'</p></label>';

                                                }
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            // code for checkbox 
                                            print' <div class="checkbtn" id="checkbtn'.$main_out.$qno.'" style="';
                                            
                                            if($answer != '' and $question_type == "MTQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                                 
                                            
                                            print '">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                $arr = ['A','B','C','D'];
                                                if($question_type == "MTQ"){
                                               
                                                
                                            if(strpos($answer,'option'.$i)  !== false){
                                                      print '<label class="container1" style=" display:flex;margin:30px 0px;"><p><input type="checkbox"   class="form-control active" value='.$row['option'.$i].' checked="checked"> '.$row['option'.$i].'</p></label>';
                                               
                                                }
                                                 else{
                                                     
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="checkbox"   class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';

                                                }
                                                
                                                }
                                                else{
                                                    print '<label class="container1" style="display:flex; margin:30px 0px;"><p><input type="checkbox" name="answercheckbox'.$i.$qno.'"  class="form-control" value='.$row['option'.$i].'> '.$row['option'.$i].'</p></label>';

                                                }
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                            // code for fill
                                            
                                             print' <div class="fillbtn" id="fillbtn'.$main_out.$qno.'" style="';
                                                 if($answer != '' and $question_type == "FQ"){
                                                     print "display:flex";
                                                 }
                                                 else{
                                                     print "display:none"; 
                                                 }
                                             print '">
                                                 ';
                                                   
                                            if($question_type == "FQ"){
                                                 print '<label class="container1 " style="margin:30px 0px;"><p> '.$answer.'</p></label>';
                                            }else{  
                                     print '<label class="container1 " style="margin:30px 0px;"><p><input type="text" style="width:90%" name="answerfill'.$qno.'" placeholder="Enter Answer"  class="form-control active"  > </p></label><p><b>Note :</b>If you want to assign a range value answer eg.12-13 or 12.4-13.9<p>';
                                            }
                                            
                                             
                                                 
                                           
                                                     
                                            print '</div>';
                                            
                                            /// code for true or false
                                            print' <div class="truebtn" id="truebtn'.$main_out.$qno.'" style="';
                                            
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
                                                $mainarr = ['A','B'];
                                                
                                                if($question_type=="TQ"){
                                             
                                                if($mainarr[$i-1] == $row[$answer]){
                                                 print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio"  class="form-control active" value='.$arr[$i-1].' checked="checked"> '.$arr[$i-1].'</p></label>';
                                                }
                                                 else{
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio"   class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                }
                                                }
                                                else{
                                                    print '<label class="container1" style="display:flex;margin:30px 0px;"><p><input type="radio" name="answertrue'.$qno.'"  class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                }
                                            
                                             }
                                                 
                                           
                                                     
                                            print '</div>';
                                                
                                           print '</div> </div>';
                                             
                                           print '<button type="button" id="update'.$qno.'" class="btn btn-success" onclick="Update('.$qno.')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                                         

                                           print '<a href="delete_question.php?question_id='.$q_id.'&exam_id='.$exam_id.'&sec_name=section" style="color:white"><button type="button" class="delete btn btn-danger" > <i class="fa fa-trash-o"></i></button></a>';
                                           if(!empty($Image) and !empty($hindi_image)){
                                              print '<a  href="delete_question_image.php?question_id='.$q_id.'&exam_id='.$exam_id.'&sec_name=section&type=english" style="color:white"><button type="button"  class="delete btn btn-warning"  >Remove English Image</button></a>';
                                              print '<a  href="delete_question_image.php?question_id='.$q_id.'&exam_id='.$exam_id.'&sec_name=section&type=hindi" style="color:white"><button type="button"  class="delete btn btn-warning"  >Remove Hindi Image</button></a>';
                                            }
                                            else if(!empty($Image)){
                                            print '<a href="delete_question_image.php?question_id='.$q_id.'&exam_id='.$exam_id.'&sec_name=section&type=normal" style="color:white"><button type="button"  class="delete btn btn-warning" >Remove Image</button></a>';
                                              }
                                                if($question_type == "MTQ" and $par_status== 0){
                                                print '<a class="btn btn-primary" type="submit" href="pages/partial.php?question_id='.$q_id.'&exam_id='.$exam_id.'&data=par">Partial Marks</a>';
                                            }else if($question_type == "MTQ" and $par_status== 1){
                                                 print '<a class="btn btn-primary" type="submit" href="pages/partial.php?question_id='.$q_id.'&exam_id='.$exam_id.'&data=nopar">Remove Partial Marks</a>';
                                            }
                                            
                                          $sql_checking = "select * from tbl_assessment_records where exam_id='$exam_id'";
                                            $result_checking = $conn->query($sql_checking);
                                            if($result_checking->num_rows>0){
                                             if($bonus == 0){
                                             print '<a href="pages/bonus-question.php?question_id='.$q_id.'&page=3&exam_id='.$exam_id.'" class="btn btn-info">Bonus Question</a>';
                                            }else{
                                               print '<a href="pages/nobonus-question.php?question_id='.$q_id.'&page=3&exam_id='.$exam_id.'" class="btn btn-info">Remove Bonus</a>'; 
                                            }
                                            }
                                            print '<hr>';
                                             print '<input type="hidden" name="question_id'.$qno.'" id="question_id'.$out1.$qno.'" value="'.$q_id.'" >';
                                                
										    print'
                                                 </div></div></div>
                                                ';
											
                                            }
                                            print '<input type="hidden" name="total_question" value="'.$row_count.'" >';
                                            print '<input type="hidden" id="exam_id" name="exam_id" value="'.$exam_id.'" >';
                                            if($count == 30){
                                                print '<input type="hidden"  name="btndata" value="'.$qno.'">';
                                                 $count=0;
                                                print '
                                              <div class="container-fluid text-center py-5" style="padding:30px 20px;border-bottom:2px solid #333;border-top:1px solid #333;margin-bottom:20px;">  <button type="submit" class="btn btn-primary">Save</button></div>
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

                                            //   print ' <button type="button" class="btn btn-primary" onclick="OpenModal()">Add New Question</button>';
                                             

                                            if($row_count%30 != 0){
                                                print '
                                                <button type="submit" class="btn btn-primary">Save</button></form>';
                                            }
                                            
                                           

                                            }
                                         else {
 
                                            }
											
											?>
                                            <button type="button" class="btn btn-primary" onclick="OpenModal()">Add New Question</button>
                                         
                                            <a href="./questions.php?eid=<?php echo $exam_id;?>&sec_name=<?php echo $out1; ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add Questions </a>
                                            </div>
                                            
                                             <?php 
                                                    
                                                    $i++;
                                                } }
                                              
                                             ?>
                                              
                                             <?php
                                             
                                              } ?>
										
                                            </div>
                                            
                                         
                                        </div>
                                    </div>
                                </div>  
                    </div>
                </div>
                
            </div>
        </main>
     


        <div class="Modal3" style="display:none">
            <div class="Modal4"><form id="UpdateForm" action="pages/update-instance-questions.php" method="post" enctype="multipart/form-data"><h4>Update  Question </h4><div class="form-group"><label for="exampleInputEmail1">Question No :</label><input type="number" class="form-control"  name="qno" id="qno"  required autocomplete="off" disabled></div><div class="form-group"><label for="exampleInputEmail1">Question :</label><input type="text" class="form-control"  name="question"  placeholder="Enter Question"  autocomplete="off"></div><div class="form-group"><label for="exampleInputEmail1">Upload English File</label><input type="file" class="form-control"  name="ModalImage"  autocomplete="off"></div>
            <div class="form-group"><label for="exampleInputEmail1">Upload Hindi File</label><input type="file" class="form-control"  name="ModalImagehindi"  autocomplete="off"></div>
            
            
            <div class="form-group">
                <label for="exampleInputEmail1">Positive Marks</label>
                <input type="number" value=""  class="form-control" placeholder="Enter Positive Marks For Per Question" name="pmarks" id="pmarks" autocomplete="off">
                </div><div class="form-group">  <label for="exampleInputEmail1">Negative Marks</label>
                <input type="number" value=""  class="form-control" placeholder="Enter Negative Marks For Per Question" name="nmarks" id="nmarks" autocomplete="off"></div>
            <div class="form-group">
            <select class="form-control" name="question_data" onchange="Checking(this.value)">
                <option selected value="">Select Answer Type</option>
                <option value="STQ">Single Answer Type </option>
                <option value="MTQ">Multiple Answer Type</option>
                <option value="FQ">Fill Answer Type</option>
                <option value="TQ">True/False Answer Type</option></select>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    
              
               
                <div class="radiobtn" id="radiobtn" style="display:none" >
                <?php                                   
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                $arr = ['A','B','C','D']; ?>
                                               
                                           
                                                    <label class="container1"><p><input type="radio" name="radio"  class="form-control" value='<?php echo $arr[$i-1]; ?>'> <?php echo $arr[$i-1]; ?></p></label>

                                             <?php    
                                            
                                             } ?>
                                                 
                                           
                                                     
                                            </div>
                                          
                                            <div class="checkbtn" id="checkbtn" style="display:none" >
                                        <?php 
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                $arr = ['A','B','C','D'];
                                                ?>
                                               
                                                <label class="container1"><p><input type="checkbox" name="checkbox<?php echo $i; ?>"  class="form-control" value='<?php echo $arr[$i-1]; ?>'> <?php echo $arr[$i-1] ?></p></label>

                                                <?php 
                                            
                                             }
                                             ?>
                                                 
                                           
                                                     
                                            </div>
                                          
                                            
                                              <div class="fillbtn" id="fillbtn" style="display:none" >
                                              
                                                   
                                            
                                     <label class="container1 mb-2 p-2" style="margin-bottom:20px"><p><input type="text" style="max-width:82%" name="fill" placeholder="Enter Answer"  class="form-control active"></p></label>
                                            
                                               
                                            </div>
                                            
                                              <div class="truebtn" id="truebtn" style="display:none" >
                                            <?php 
                                                   
                                            for($i=1;$i<=2;$i++){ 

                                                $arr = ['true','false'];
                                                $mainarr = ['A','B'];
                                                
                                             ?>
                                                    <label class="container1"><p><input type="radio" name="true"  class="form-control" value='<?php echo $arr[$i-1]; ?>'> <?php echo $arr[$i-1]?></p></label>

                                                <?php 
                                            
                                             }
                                               ?>  
                                           
                                                     
                                            </div>
                                            
                                            
                                            
                    
                    
                    
                    </div>
                    
                    
                </div>
                <button type="submit" class="btn btn-primary" >Submit</button><button type="button" class="btn btn-warning" onclick="UpdateClose()">Close</button></form>  </div>
            
            
            
            
            
            
            
        </div>

    
    <div class="Modal">
    <div class="Modal1">
    <form id="more_question" action="" method="post" enctype="multipart/form-data">
        <h4>Add A New Question</h4>
          <div class="form-group">
           
            <input id="exam_type_check" type="checkbox" class="form-control"  onclick="FetchExamType()">Do You Have Excel File
        </div>
       
        
        <div class="form-group" id="data">
            <label for="exampleInputEmail1">Upload Bulk Images(single or copy paste)</label>
            <input id="more_img" type="file" class="form-control"  name="ModalImage[]" required autocomplete="off" multiple>
        </div>
        
       
        <div class="form-group" id="data1">
            <label for="exampleInputEmail1">Upload Bulk Hindi  Images(single or copy paste)</label><input id="more_img" type="file" class="form-control"  name="ModalImageHindi[]"  autocomplete="off" multiple>
        </div>
       
        <button type="submit" class="btn btn-primary" >Submit</button>
        <button type="button" class="btn btn-warning" onclick="Close()">Close</button>
    </form>
    
    
    
    </div>
    </div>


<script>
    
    function FetchExamType(){
        var x = document.querySelector('#exam_type_check');
        if(x.checked == true){
            document.querySelector('#data').innerHTML = '<div class="form-group"><label for="exampleInputEmail1">Upload Excel</label><input type="file" class="form-control"  name="excelfile" required autocomplete="off"><br><a href="image.png" target="_blank">Check The Excel Format</a></div>';
            
             document.querySelector('#data1').innerHTML=' ';
            var y = document.querySelector('#total-tab').value;
                for(var i=0;i<y;i++){
                  
                if(document.querySelector('#tab-name'+i).className == "active"){
                    var exam_id = "<?php echo $exam_id; ?>";
                    var sec_name  = document.querySelector('#tab-name'+i).innerText;
                    var url = "pages/add_Excel.php?exam_id="+exam_id+"&sec_name="+sec_name;
                    document.querySelector('#more_question').setAttribute('action',url);
                    
                }
                }
        }else{
             document.querySelector('#data').innerHTML=' <label for="exampleInputEmail1">Upload Bulk Images(single or copy paste)</label><input id="more_img" type="file" class="form-control"  name="ModalImage[]" required autocomplete="off" multiple>';
             
             document.querySelector('#data1').innerHTML=' <label for="exampleInputEmail1">Upload Bulk Hindi  Images(single or copy paste)</label><input id="more_img" type="file" class="form-control"  name="ModalImageHindi[]" required autocomplete="off" multiple>';
             
         
              var y = document.querySelector('#total-tab').value;
                for(var i=0;i<y;i++){
                  
                if(document.querySelector('#tab-name'+i).className == "active"){
                    var exam_id = "<?php echo $exam_id; ?>";
                    var sec_name  = document.querySelector('#tab-name'+i).innerText;
                    var url = "pages/add-instance-questions.php?exam_id="+exam_id+"&sec_name="+sec_name;
                    document.querySelector('#more_question').setAttribute('action',url);
                    
                }
                }
             
        }
    }
    
    
    
    function FetchImage(values,qno){
         var y = document.querySelector('#total-tab').value;
        for(var i=0;i<y;i++){
          
        if(document.querySelector('#tab-name'+i).className == "active"){
            var out  = document.querySelector('#tab-name'+i).innerText;
        }
    }
         var out = out.split(/\s/).join('');
        if(values == "English"){
            document.querySelector('#english'+out+qno).style.display="block";
            document.querySelector('#hindi'+out+qno).style.display="none";
        }else if(values == "Hindi"){
             document.querySelector('#english'+out+qno).style.display="none";
            document.querySelector('#hindi'+out+qno).style.display="block"; 
        }
        
    }
    
    
  
            
    
    
</script>


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
				
				
				
				function data(){
				    alert("suraj ram");
				}
				
			     const form = document.getElementById("more_question");
const fileInput = document.getElementById("more_img");

window.addEventListener('paste', e => {
  fileInput.files = e.clipboardData.files;
});


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
     var y = document.querySelector('#total-tab').value;

    for(var i=0;i<y;i++){
      
    if(document.querySelector('#tab-name'+i).className == "active"){
            var out  = document.querySelector('#tab-name'+i).innerText;
    }
    }
    
    var out = out.split(/\s/).join('');
    
    
 
	if(val == "single"){
	  document.querySelector('#radiobtn'+out+id).style.display="flex";
	   document.querySelector('#checkbtn'+out+id).style.display="none";
	   document.querySelector('#fillbtn'+out+id).style.display="none";
	    document.querySelector('#truebtn'+out+id).style.display="none";
	    
	}else if(val == "multiple"){
	      document.querySelector('#radiobtn'+out+id).style.display="none";
	   document.querySelector('#checkbtn'+out+id).style.display="flex";
	   document.querySelector('#fillbtn'+out+id).style.display="none";
	    document.querySelector('#truebtn'+out+id).style.display="none";
	    
	    
	}else if(val == "fill"){
	      document.querySelector('#radiobtn'+out+id).style.display="none";
	   document.querySelector('#checkbtn'+out+id).style.display="none";
	   document.querySelector('#fillbtn'+out+id).style.display="flex";
	    document.querySelector('#truebtn'+out+id).style.display="none";
	    
	}else if(val == "true"){
	      document.querySelector('#radiobtn'+out+id).style.display="none";
	   document.querySelector('#checkbtn'+out+id).style.display="none";
	   document.querySelector('#fillbtn'+out+id).style.display="none";
	    document.querySelector('#truebtn'+out+id).style.display="flex";
	    
	}			   
				   
	document.querySelector('#question_type'+out+id).value=val;		    
				    
				    
				   
}



/// close add question modal 
function Close(){
document.querySelector('.Modal').style.display="none";
}
// open add question modal 
function OpenModal(){
     var y = document.querySelector('#total-tab').value;
    for(var i=0;i<y;i++){
      
    if(document.querySelector('#tab-name'+i).className == "active"){
        var exam_id = "<?php echo $exam_id; ?>";
        var sec_name  = document.querySelector('#tab-name'+i).innerText;
        var url = "pages/add-instance-questions.php?exam_id="+exam_id+"&sec_name="+sec_name;
        document.querySelector('#more_question').setAttribute('action',url);
           document.querySelector('.Modal').style.display="block";
    }
    }
 
   
}

// close update window

function CloseUpdate(Maindata){
    document.getElementById('file').innerHTML="";
    document.querySelector('#update'+Maindata).style.display="block";

}

function UpdateClose(){
    document.querySelector('.Modal3').style.display="none";
    // document.querySelector('.Modal3').innerHTML='';
}

/// uodate instance question
function Update(Maindata){
    var y = document.querySelector('#total-tab').value;
        for(var i=0;i<y;i++){
          
        if(document.querySelector('#tab-name'+i).className == "active"){
            var out  = document.querySelector('#tab-name'+i).innerText;
        }
    }
   
    var question_id = document.getElementById('question_id'+out+Maindata).value;
    var files = document.querySelector('.Modal3');
    var BtnTitle = document.querySelector('#update'+Maindata);
    var exam_id = document.getElementById('exam_id').value;
    
    document.querySelector('.Modal3').style.display="block";
    
    document.querySelector('#qno').value = Maindata;
    
      FetchMarks(exam_id,question_id);
    var url = 'pages/update-instance-questions.php?question_id='+question_id+'&exam_id='+exam_id+'&sec_name=section';
    
    document.querySelector('#UpdateForm').setAttribute("action", url);
    

    


}


/// fetch marks 
function FetchMarks(exam_id,question_id){
    $.ajax({
        url:'ajax/FetchMarks.php',
        type:'post',
        data:{
            exam_id:exam_id,
            question_id:question_id
        },
        success:function(data){
        
            var user = JSON.parse(data);
            $('#pmarks').val(user.pos_marks);
            $('#nmarks').val(user.neg_marks);
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



// function ActiveExam(){
//     alert("yesdsdsd");
// }


'use strict';

var switchButton 			= document.querySelector('.switch-button');
var switchBtnRight 			= document.querySelector('.switch-button-case.right');
var switchBtnLeft 			= document.querySelector('.switch-button-case.left');
var activeSwitch 			= document.querySelector('.active');

function switchLeft(){
	switchBtnRight.classList.remove('active-case');
	switchBtnLeft.classList.add('active-case');
	activeSwitch.style.left = '0%';
}

function switchRight(){
	switchBtnRight.classList.add('active-case');
	switchBtnLeft.classList.remove('active-case');
	activeSwitch.style.left = '50%';
}

switchBtnLeft.addEventListener('click', function(){
	switchLeft();
}, false);

switchBtnRight.addEventListener('click', function(){
	switchRight();
}, false);




function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}


</script>
    </body>

</html>