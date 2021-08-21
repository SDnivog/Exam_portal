<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true and !empty($_SESSION['id'])) {
	if(isset($_GET['teacher_code']) and isset($_GET['category'])){
		$_SESSION['login_stu_teacher_id']=$_GET['teacher_code'];
		$_SESSION['category']=$_GET['category'];
		$_SESSION['tdepartment'] = $_GET['department'];
		header("location:../index?rp=9122");	
		
	}
	$stu_id = $_SESSION['id'];
	$login_teacher_id = $_SESSION['login_student_teacher_id'];
	$myfname = $_SESSION['first_name'];
	$mylname = $_SESSION['last_name'];
	$mygender = $_SESSION['gender'];
	$mydob = $_SESSION['dob'];
	$myaddress = $_SESSION['address'];
	$myemail = $_SESSION['email'];
	$myphone = $_SESSION['phone'];
	$mydepartment = $_SESSION['tdepartment'];
	$myrole = $_SESSION['role'];
	$myavatar = $_SESSION['avatar'];

	$company_name = $_SESSION['company_name'];

	
	$login_stu_teacher_id=$_SESSION['login_stu_teacher_id'];
	$mycategory = $_SESSION['category'];

	if ($myrole == "student") {
		
	}else{
	header("location:../index");	
	}
}else{
	header("location:../index");
}









?>