<?php
include'../database/config.php';
session_start();
if(isset($_GET['verified'])){
    $email=$_GET['verified'];
    $result=$conn->query("select * from tbl_users where email='$email' and resetpass='1'");
    if($result->num_rows>0){
        echo 'This link has been expired';
    }
    else{
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel = "icon" href ="../img/icon.png"
type = "image/x-icon">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MTDJTKX');</script>
<!-- End Google Tag Manager -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@400;500;600;700;800;900&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style_form.css">
    <title>Set New Password | Kendel</title>
</head>
<style>
#close_button{
    font-size:28px;
    padding:2px;
    
}
#close_button:focus{
    outline:none;
    border:none;
}
#modal{
    box-shadow:2px 2px 8px -4px #666;
}
.full-window-cover{
    background-image:url('../../Images/mainbg.png');
    background-repeat:no-repeat;
}
</style>
<body>
    
        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MTDJTKX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    
    <nav class="navbar fixed-top">
        <a href="https://kendel.in/exam/index" class="navbar-brand"><img src="../../Images/logof.png" alt="codehutt"></a>
    </nav>

    <div class="full-window-cover">
        <div class="login-top">
            <!--<img class="d-none d-sm-block" src="../public/images/login-top.png">-->
            <!--<img class="d-block d-sm-none" src="../public/images/login-top-mobile.png">-->
        </div>

        <div class="login-form-capsule">
            <!--<img src="../public/images/login-boy.png">-->
            <div class="login-form">
                    <div id="modal" style="background-color:#fff;color:<?php echo $_SESSION['type'];?>;" class="alert shadow alert-dismissible fade <?php echo $_SESSION['status']; $_SESSION['status']=null; ?>" role="alert">
                    <?php
echo $_SESSION['msg'];
$_SESSION['msg']=null;

?>
  <button id="close_button" type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>  
                <h6>I had Checked You</h6>
                <h5>Create Your New Password</h5>
                <form  action="./resetpass.php" method="post">
                    <label for="password1">Enter New password</label>
                    <input type="text" name="pass1" id="Password">
                    <label for="password2">Confirm Password</label>
                    <input type="text" name="pass2" id="password">
                    <input type="hidden" name="email" value="<?php echo $email;?>">
                    <button type="submit" name="reset">
                        Set New Password
                    </button>
                </form>
            </div>
            <!--<img class="d-none d-sm-block" src="../public/images/login-character.png">-->
        </div>

    <div class="login-bottom">
            <!--<img class="d-none d-sm-block" src="../public/images/login-bottom.png">-->
            <!--<img class="d-block d-sm-none" src="../public/images/login-character.png">-->
            <!--<img class="d-block d-sm-none" src="../public/images/login-bottom-mobile.png">-->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>
</html>

<?php 
    }
}
?>