<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
	$login_user_id = $_SESSION['id'];
	$myfname = $_SESSION['first_name'];
	$mylname = $_SESSION['last_name'];
	$mygender = $_SESSION['gender'];
	$mydob = $_SESSION['dob'];
	$myaddress = $_SESSION['address'];
	$myemail = $_SESSION['email'];
	$myphone = $_SESSION['phone'];
	$mydepartment = $_SESSION['department'];
	$myrole = $_SESSION['role'];
	$myavatar = $_SESSION['avatar'];
		$myid = $_SESSION['myid'];
	$mycategory = $_SESSION['mycategory'];
	$plan =	$_SESSION['plan'];
	if ($myrole == "admin") {
		
	}else{
	header("location:./index?rp=9135");	
	}
}else{
	header("location:./index?rp=9422");
}

?>