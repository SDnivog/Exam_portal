<!DOCTYPE html>
<?php include 'includes/check_reply.php'; ?>
<html>
    
<head>

 
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <!--<meta name="description" content=" Examination Portal" />-->
        <meta name="keywords" content=" Examination Portal, online quiz, online exam, Which exam Portal,exam portal For exam" />
       
<!-- Primary Meta Tags -->
       <title>Kendel Abhyas | Login</title>
<meta name="title" content="Quiz">
<meta name="title" content="Online Exam Portal">
<meta name="description" content="Kendel is an educational platform for students where students can acquire knowledge with fun and check their performance in with exam portal.">
<meta name="revisit-after" content="1 days">
<meta name="author" content="Kendel">
<!-- Open Graph / Facebook -->
<meta property="og:type" content="Kendel| Online exam Portal">
<meta property="og:url" content="https://kendel.in/exam/index">
<meta property="og:title" content="Examination Portal | Online exam Portal">
<meta property="og:description" content="Create Exam in seconds and assign to your Students, quick exam analytics">

<!-- Twitter -->
<meta property="twitter:card" content="Kendel| Online exam Portal">
<meta property="twitter:url" content="https://kendel.in/exam/index">
<meta property="twitter:title" content="Examination Portal | Online exam Portal">
<meta property="twitter:description" content="Create Exam in seconds and assign to your Students, quick exam analytics">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/images/icon.png" rel="icon">
        <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
         <link href="assets/css/snack.css" rel="stylesheet" type="text/css"/>
        <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        <style>
            .page-inner{
                 background-image:url('../Images/mainbg.png');
    background-repeat:no-repeat;
            }
        </style>
    </head>
     <body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?>  class="page-login">
        <main class="page-content">
           <div class="page-inner">
            <div class="container" style="width:100%;margin-top:20px"><img src="../Images/logof.png" alt="" align width="150"  style="float:left"> 
            <!--<img src="icon.png" alt="" style="float:right" width="80px" >--> <br/><br/>
            </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-4 center">
                            <div class="login-box">
                            <?php 
                            if(isset($header)){
                                echo $header;
                            } 
                            
                            if(isset($form)){
                                    echo $form;
                                }
                                
                                ?>
                               
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

        <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/js/modern.min.js"></script>
        		<script>
        		
        				function refershow(){
        		    var data = document.querySelector('#refer');
        		    if(data.style.display == "none"){
        		        data.style.display="block";
        		        document.querySelector('#refer_data').setAttribute("required","");
        		    }else{
        		        data.style.display="none";
        		        document.querySelector('#refer_data').removeAttribute("required");
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