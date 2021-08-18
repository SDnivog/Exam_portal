<?php 
// include 'includes/check_user.php'; 
include 'includes/fetch_records.php';
include '../database/config.php';
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    $stu_id = $_SESSION['id'];
    $login_teacher_id = $_SESSION['login_student_teacher_id'];

    $sql = "select * from tbl_users where user_id='$login_teacher_id'";

    $result = $conn->query($sql);
    $arr = $result->fetch_assoc();
    $tfname = $arr['first_name'];
    $tlname = $arr['last_name'];
}else{
    header('location:../index');
}
    
?>
<!DOCTYPE html>
<html>
    
<head>
        
        <title>Kendel | Student Dashboard</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
           <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
         <meta name="description" content="Trando is providing online examination portal for the coachings, institute and schools. this is a plateform which provide well structured portal in very low cost" />
        <meta name="author" content="Trando Team" />
        <meta name="keywords" content="online-exam,test-series,trando exam,online series,exam,test,test series for exam,examination portal, exam portal which can work for me, trando " />

 <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
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
        <link href="../assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
		<link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/images/icon.png" rel="icon">
        <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/snack.css" rel="stylesheet" type="text/css"/>
        <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        <style>
.Modal{
    position:fixed;
    top:0%;
    left:0%;
    z-index:999;
    display:none;
    width:100%;
    height:100%

    
}
.Modal1{
    position:relative;
    display:flex;
    justify-content:center;
    align-items:center;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
}

.Modal form{
    position:relative;
    width:30%;
    background:white;
    padding:50px;
    border-radius:10px;

}

.Modal form h4{
    text-align:center;
}



@media screen and (max-width:1000px){
    .Modal form{
    width:80%;
}
}
        
        
        
        
        </style>
        
    </head>
    <body class="page-header-fixed">
        <div class="overlay"></div>
        <main class="page-content content-wrap">
            <div class="navbar">
                <div class="navbar-inner">
                   
                    <div class="logo-box" style="display:flex;">
                        <a href="AddClass.php" class="logo-text" ><span><img src="../logo.png" alt=""  width="100"></span></a>
                         <a href="logout.php" class="logo-text" style="font-size:16px;">
                                        <span><i class="fa fa-sign-out m-r-xs"></i></span>
                                    </a>
                    </div>

                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-right">
                                <!--<li style="cursor:pointer;">-->
                                <!--    <a onclick="AddNewClass()">-->
                                <!--        <span style="font-size:30px;">+</span>-->
                                <!--    </a>-->
                                <!--</li>-->

                               
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
         
           
            <div class="page-inner">
                <div class="page-title">
                    <ul style="list-style:none;margin-top:-25px;padding:20px 20px 20px 0px;">
                        <li style="float:left;font-weight:700;"><h3>All Classes</h3></li>
                     <li style="cursor:pointer;float:right;">
                                    <a onclick="AddNewClass()">
                                        <span style="font-size:30px;font-weight:700;">+</span>
                                        
                                    </a>
                                </li>
                                
                    </ul>
                </div>
                <div id="main-wrapper">
                    <div class="row">
 
                        <?php

                    $sql1 = "select * from tbl_account where student_id='$stu_id' and acc_status=1 ";
                    $result1= $conn->query($sql1);

                    while($arr1 = $result1->fetch_assoc()){

                        $teacher_id = $arr1['teacher_id'];

                        $sql2 = "select * from tbl_users where user_id='$teacher_id' and role='admin'";
                        $result2= $conn->query($sql2);
                        $arr2 = $result2->fetch_assoc();

                    ?>

                        <div class="col-lg-3 col-md-6" >
                            <a style="height:300px;line-height:10px" href="includes/check_user.php?teacher_code=<?php echo $teacher_id; ?>&category=<?php echo $arr1['category']; ?>&department=<?php echo $arr1['department']; ?>">
                                <div class="panel info-box panel-white" style="height:auto;border-radius:5px;background:#5796b5">
                                <div class="panel-body">
                                    <div class="info-box-stats">
                                       <p style="color:#fff;font-weight:bold;font-size:23px"><?php echo $arr1['department']; ?></p>
                                        <span style="font-size:17px;margin-top:20px;color:#fff" class="info-box-title"><?php echo $arr1['category']; ?></span>
                                        
                                        <span style="font-size:14px;margin-top:16px;color:#fff" class="info-box-title"><?php echo $arr2['first_name']." ".$arr2['last_name']; ?></span>
                                    </div>
                                    <div class="info-box-icon">
                                        <i style="color:white" class="fa fa-book "></i>
                                    </div>
     
                                </div>
                            </div>
                            </a>
                        </div>
                        
					<?php } ?>
					
					
                    </div>
               
            </div>
        </main>



        <div class="Modal">
    <div class="Modal1">
    <form action="pages/add-classes.php" method="post" enctype="multipart/form-data">
        <h4>Add A New Class</h4>
        <div class="form-group">
            <label for="exampleInputEmail1">Teacher Code</label>
            <input type="text" class="form-control"  name="teacherid" id="teacherid" onchange="Teacherid(this.value)" placeholder="Enter Teacher Code" required autocomplete="off">
            <p id="msg" style="background:red;color:white;margin-top:5px;"></p>
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">Select Department</label>
        <select class="form-control" name="department" required  id="department" onchange="Department(this.value)">
		        <option value="" selected disabled>-Select Department</option>
		</select>
        </div>
        <div class="form-group">
        <label for="exampleInputEmail1">Select Category</label>
        <select class="form-control" name="category" required id="category">
		<option value="" selected disabled>-Select Category</option>
	
		</select>
        </div>
                                       
        <button type="submit" class="btn btn-primary" >Submit</button>
        <button type="submit" class="btn btn-warning" onclick="Close()">Close</button>
    </form>
    
    
    
    </div>
    </div>

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
        
        	document.addEventListener("contextmenu", function(e){
                    e.preventDefault();
                }, false);
                
                
                	
            	$(document).keydown(function (event) {
                if (event.keyCode == 123  || event.keyCode == 120 || event.keyCode == 121 || event.keyCode == 122) {
                    return false;
                }
                else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
                    return false;
                }
            });
                
                
                
            
            //fetching department and msg for teacher id is correct or not
        function Teacherid(id){
            $.ajax({
                url:'FetchData.php',
                type:'post',
                data:{
                    id:id
                },
                success:function(data){
                    if(data == "no"){
                        $('#msg').html("Teacher Does Not Exist");
                    }
                    else if(data="success"){
                        $('#msg').html("");
                        FetchDepartment(id);
                    }
                }
            })
        }

        function FetchDepartment(teacherid){
            $.ajax({
                url:'FetchData.php',
                type:'post',
                data:{
                    teacherid:teacherid
                },
                success:function(data){
                    $('#department').html(data);
                    // Department(teacherid)
                }
            })
        }


        function Department(department_name){
            var teacher_id = document.querySelector('#teacherid').value;
            $.ajax({
                url:'FetchData.php',
                type:'post',
                data:{
                    department_name:department_name,
                    teacher_id:teacher_id
                },
                success:function(data){
                    $('#category').html(data);
                }
            })

        }



        function AddNewClass(){
            var x = document.querySelector('.Modal');
            if(x.style.display != "block"){
                x.style.display="block";
            }
            else{
                x.style.display="none";
            }
        }

        function Close(){
            document.querySelector('.Modal').style.display="none";
        }
        
        
        
        
        
        
        
        </script>

        
    </body>


</html>