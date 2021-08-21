<?php
include '../database/config.php';
$myusername = mysqli_real_escape_string($conn, $_POST['user']);
$mypassword = md5($_POST['login']);

$sql = "SELECT * FROM tbl_users WHERE user_id = '$myusername' AND login = '$mypassword' OR email = '$myusername' AND login = '$mypassword'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    session_start();
	$_SESSION['login'] = true;
	$_SESSION['id']=$row['user_id'];
	$_SESSION['login_student_teacher_id'] = $row['teacher_id'];
	$_SESSION['first_name'] = $row['first_name'];
	$_SESSION['last_name'] = $row['last_name'];
	$_SESSION['gender'] = $row['gender'];
	$_SESSION['dob'] = $row['dob'];
	$_SESSION['address'] = $row['address'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['phone'] = $row['phone'];
	$_SESSION['department'] = $row['department'];
	$_SESSION['role'] = $row['role'];
	$_SESSION['avatar'] = $row['avatar'];
	$_SESSION['myid'] = $row['user_id'];
	$_SESSION['mycategory'] = $row['category'];
	
	$tid = $row['teacher_id'];
	$_SESSION['plan'] = $row['plan'];


	$sqls = "SELECT * FROM tbl_users WHERE user_id = '$tid'";
	$results = $conn->query($sqls);
	$arr = $results->fetch_assoc();
	$_SESSION['company_name']=$arr['company_name'];
	$_SESSION['no_attempt'] = $row['no_attempt'];
	
	$no_attempt = $row['no_attempt'];
	
	 $user_id = $row['user_id'];
	 $email = $row['email'];

	
	
	$registered_date = $row['register_date'];



	
	
	$sql2 = "select * from tbl_users where user_id='$user_id'";
	$result2 =$conn->query($sql2);
	
	$arr2 = $result2->fetch_assoc();
	
	$accstat = $arr2['acc_stat'];



	if ($accstat == "0" ) {
	    
	 header("location:../index?rp=5732");
  
        
	}else if($accstat == "1" ){
		$location = strtolower($row['role']);
		if($location== "student"){
			header("location:../$location/AddClass.php");	
		}else if($location == "admin"){
			header("location:../$location/index");	
		}
	}

    }
} else {
    header("location:../index?rp=0912");
}
$conn->close();

?>