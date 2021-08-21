<?php
session_start();



if(isset($_SESSION['success_color']) and isset($_SESSION['success_msg'])){
$header = '
<p class="text-center  '.$_SESSION['success_color'].' message">'.$_SESSION['success_msg'].'</p>  
<a style="color:#fff;" href="./index" class="logo-name text-lg text-center">Abhyaas</a>
<p style="color:#fff;" class="text-center m-t-md">Please login into your account.</p>';
}
else{
    $header = '<a href="./index" style="color:#fff;" class="logo-name text-lg text-center">Abhyaas </a>
    <p  style="color:#fff;"class="text-center m-t-md">Please login into your account.</p>';
}

$form = ' <form class="m-t-md" action="pages/authentication.php" method="POST">
<div class="form-group">
    <input type="text" class="form-control" placeholder="Email or Registration No."  autocomplete="off" name="user" required>
</div>
<div class="form-group">
    <input type="password" class="form-control" placeholder="Enter your password" name="login" required>
</div>
<button type="submit" class="btn btn-success btn-block">Login</button>
 <a style="color:#fff;" href="./reset/forgot" class="display-block text-center m-t-md text-sm text-white ">Forgot Password?</a> 

<div class="text-center">
<a href="plancard.php" class="btn btn-info text-center m-t-md text-sm"> CREATE CLASS</a>
<a href="joinclass.php" class="btn btn-primary text-center m-t-md text-sm">JOIN CLASS</a>

</div>

</form>';


include 'mainpages.php';



?>