<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';
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
            /*verticatl Tab*/
/*.tabv {*/
/*  float: left;*/
/*  border: 1px solid #ccc;*/
/*  background-color: #f1f1f1;*/
/*  width: 30%;*/
/*  height: 300px;*/
/*}*/
/*.tabv button {*/
/*  display: block;*/
/*  background-color: inherit;*/
/*  color: black;*/
/*  padding: 22px 16px;*/
/*  width: 100%;*/
/*  border: none;*/
/*  outline: none;*/
/*  text-align: left;*/
/*  cursor: pointer;*/
/*  transition: 0.3s;*/
/*  font-size: 17px;*/
/*}*/

/*.tabv button:hover {*/
/*  background-color: #ddd;*/
/*}*/

/*.tabv button.active {*/
/*  background-color: #ccc;*/
/*}*/

/*.tabcontentv {*/
/*  float: left;*/
/*  padding: 0px 12px;*/
/*  border: 1px solid #ccc;*/
/*  width: 70%;*/
/*  border-left: none;*/
/*  height: 300px;*/
/*}*/

/* Mixins */
@mixin bg-gradient() {
 background: rgb(254,254,254);
background: -moz-radial-gradient(center, ellipse cover,  rgba(254,254,254,1) 0%, rgba(224,224,224,1) 100%);
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(254,254,254,1)), color-stop(100%,rgba(224,224,224,1)));
background: -webkit-radial-gradient(center, ellipse cover,  rgba(254,254,254,1) 0%,rgba(224,224,224,1) 100%);
background: -o-radial-gradient(center, ellipse cover,  rgba(254,254,254,1) 0%,rgba(224,224,224,1) 100%);
background: -ms-radial-gradient(center, ellipse cover,  rgba(254,254,254,1) 0%,rgba(224,224,224,1) 100%);
background: radial-gradient(ellipse at center,  rgba(254,254,254,1) 0%,rgba(224,224,224,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#e0e0e0',GradientType=1 );
}
@mixin tab-bg-gradient() {
background: rgb(96,0,38); /* Old browsers */
background: -moz-linear-gradient(top, rgba(96,0,38,1) 0%, rgba(198,9,67,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(96,0,38,1)), color-stop(100%,rgba(198,9,67,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(96,0,38,1) 0%,rgba(198,9,67,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(96,0,38,1) 0%,rgba(198,9,67,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(96,0,38,1) 0%,rgba(198,9,67,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(96,0,38,1) 0%,rgba(198,9,67,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#600026', endColorstr='#c60943',GradientType=0 ); /* IE6-9 */
}

@mixin tab-bg-gradient-active() {
background: rgb(76,0,30);
background: -moz-linear-gradient(top,  rgba(76,0,30,1) 0%, rgba(159,7,53,1) 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(76,0,30,1)), color-stop(100%,rgba(159,7,53,1)));
background: -webkit-linear-gradient(top,  rgba(76,0,30,1) 0%,rgba(159,7,53,1) 100%);
background: -o-linear-gradient(top,  rgba(76,0,30,1) 0%,rgba(159,7,53,1) 100%);
background: -ms-linear-gradient(top,  rgba(76,0,30,1) 0%,rgba(159,7,53,1) 100%);
background: linear-gradient(to bottom,  rgba(76,0,30,1) 0%,rgba(159,7,53,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c001e', endColorstr='#9f0735',GradientType=0 );
}

@mixin tab-bg-gradient-hover() {
background: rgb(174,0,70);
background: -moz-linear-gradient(top,  rgba(174,0,70,1) 0%, rgba(251,15,86,1) 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(174,0,70,1)), color-stop(100%,rgba(251,15,86,1)));
background: -webkit-linear-gradient(top,  rgba(174,0,70,1) 0%,rgba(251,15,86,1) 100%);
background: -o-linear-gradient(top,  rgba(174,0,70,1) 0%,rgba(251,15,86,1) 100%);
background: -ms-linear-gradient(top,  rgba(174,0,70,1) 0%,rgba(251,15,86,1) 100%);
background: linear-gradient(to bottom,  rgba(174,0,70,1) 0%,rgba(251,15,86,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ae0046', endColorstr='#fb0f56',GradientType=0 );
}

@mixin tabs-transition() {
 -ms-transition: all .3s ease;
 -webkit-transition: all .3s ease;
 transition: all .3s ease;
}


/* Vars */
$tab_text_color: white;
$tab_text_color_active: #dddddd;
$tab_text_color_hover: white;
$tab_container_bg: white;
$tabs_min_width: 175px;
$tabs_width: 100%;
$tab_container_width: 70%;
$tab_container_min_width: 10px;



body {
  /*background: #ccc;*/
  @include bg-gradient;
}
.tabs_wrapper {
  /*width: 85%;*/
  text-align: center;
  margin: 0 auto;
  background: transparent;
}

ul.tabs {
  display: inline-block;
  vertical-align: top;
  position: relative;
  z-index: 10;
	margin: 25px 0 0;
	padding: 0;
  width: $tabs_width;
  min-width: $tabs_min_width;
	list-style: none;
  @include tabs-transition;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.4);
  li {
	  margin: 0;
	  cursor: pointer;
	  padding: 0px 15px;
	  line-height: 31px;
	  color: $tab_text_color;
    text-align: left;
    font-weight: bold;
    background-color: #666;
    @include tab-bg-gradient;
    @include tabs-transition;
    &:hover {
      @include tab-bg-gradient-hover;
	    color: $tab_text_color_hover;
      @include tabs-transition;
    }
    &.active {
      @include tab-bg-gradient-active;
    	color: $tab_text_color_active;
      @include tabs-transition;
    }
  }
}

.tab_container {
  display: inline-block;
  vertical-align: top;
  position: relative;
  z-index: 20;
  /*left: -2%;*/
  width: $tab_container_width;
  min-width: $tab_container_min_width;
  text-align: left;
	background: $tab_container_bg;
  border-radius: 12px;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
}

.tab_content {
	padding: 20px;
  height: 100%;
  display: none;
}

.tab_drawer_heading { 
  display: none; 
}

@media screen and (max-width: 781px) {
	ul.tabs {
		display: none;
	}
  .tab_container {
    display: block;
    margin: 0 auto;
    /*width: 95%;*/
    border-top: none;
    border-radius: 0;
    box-shadow: 0px 0px 10px black;
  }
	.tab_drawer_heading {
		background-color: #ccc;
    @include tab-bg-gradient();
		color: #fff;
		margin: 0;
		padding: 5px 20px;
		display: block;
		cursor: pointer;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
    text-align: center;
    &:hover {
      background: #ccc;
      @include tab-bg-gradient-hover();
	    color: $tab_text_color_hover;
    }
	}
	.d_active {
		background: #fff;
    @include tab-bg-gradient-active;
	  color: $tab_text_color_active;
	}
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
                                                         
                                                         
                                                        <div class="row tabs_wrapper">
<ul class="col-md-3 tabs">
  <!--<li class="active" rel="tab1">Tab 1</li>-->
  <li class="active" rel="tab1">Physics</li>
  <li rel="tab2">Chemistry</li>
  <li rel="tab3">Mathmatics</li>
  <li rel="tab4">GK</li>
  
</ul>
<div class="col-md-9 tab_container">
  <h3 class="d_active tab_drawer_heading" rel="tab1">Physics</h3>
  <div id="tab1" class="tab_content">
  <h2>Physics</h2>
       <div class="row">
                                                             <div class="col-md-4  mt-2">
                                                               <a href="https://kendel.in/exam/admin/index" class="subjectlink" id="subjecton1" >
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Electrostatics</h3>
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
                                                                
                                                          <div class="col-md-4  mt-2">
                                                               <a href="https://kendel.in/exam/admin/index" class="subjectlink" id="subjecton1" >
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Current electricity</h3>
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
                                                                <div class="col-md-4  mt-2">
                                                               <a href="https://kendel.in/exam/admin/index" class="subjectlink" id="subjecton1" >
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Gravitation</h3>
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
  <!-- #tab1 -->
  <h3 class="tab_drawer_heading" rel="tab2">Chemistry</h3>
  <div id="tab2" class="tab_content">
  <h2>Chemistry</h2>
       <div class="row">
                                                             <div class="col-md-4  mt-2">
                                                               <a href="https://kendel.in/exam/admin/index" class="subjectlink" id="subjecton1" >
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
                                                                
                                                               
                                                              
                                                         </div>
  </div>
  <!-- #tab2 -->
  <h3 class="tab_drawer_heading" rel="tab3">Math</h3>
  <div id="tab3" class="tab_content">
  <h2>Math</h2>
      <div class="row">
                                                             <div class="col-md-3  mt-2">
                                                               <a href="https://kendel.in/exam/admin/index" class="subjectlink" id="subjecton1" >
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Circle</h3>
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
  <!-- #tab3 -->
  <h3 class="tab_drawer_heading" rel="tab4">GK</h3>
  <div id="tab4" class="tab_content">
  <h2>GK content</h2>
       <div class="row">
                                                             <div class="col-md-3  mt-2">
                                                               <a href="https://kendel.in/exam/admin/index" class="subjectlink" id="subjecton1" >
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Indian History</h3>
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
  <!-- #tab4 --> 
  
</div>
<!-- .tab_container -->
</div>                                     
                                                     
                                                     </div>
                                                </div>
                                                
                                                
                                                <div role="tabpanel" class="tab-pane fade" id="live" >
                                                  <div class="container-fluid">
                                                         <div class="row">
                                                            
                                                             
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
		
// 		$(document).on('click','.subjectlink' function(e){
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


    $(".tab_content").hide();
    $(".tab_content:first").show();

  /* if in tab mode */
    $("ul.tabs li").click(function() {
		
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();		
		
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

	  $(".tab_drawer_heading").removeClass("d_active");
	  $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
	  
 
    });
    $(".tab_container").css("min-height", function(){ 
      return $(".tabs").outerHeight() + 50;
    });
	/* if in drawer mode */
	$(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
	  
	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
	  
	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });
	
	
	

</script>
    </body>

</html>