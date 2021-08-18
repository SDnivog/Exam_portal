<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

$exam_id = 'EX-'.get_rand_numbers(6).'';
$exam = ucwords(mysqli_real_escape_string($conn, $_POST['exam']));
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$attempts = mysqli_real_escape_string($conn, $_POST['attempts']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$terms = ucfirst(mysqli_real_escape_string($conn, $_POST['instructions']));
$tmarks = mysqli_real_escape_string($conn, $_POST['tmarks']);
$cmarks = mysqli_real_escape_string($conn, $_POST['cmarks']);
$exittime = mysqli_real_escape_string($conn, $_POST['exit']);
$result_type = mysqli_real_escape_string($conn, $_POST['result_type']);
$Restrict_time = mysqli_real_escape_string($conn, $_POST['Restrict_time']);
$edate = $_POST['edate'];


$sql = "SELECT * FROM tbl_examinations WHERE user_id = '$login_user_id' AND exam_name = '$exam' AND subject = '$subject' AND category = '$category'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../examinations.php?rp=1185");
    }
} else {

$sql = "INSERT INTO tbl_examinations (user_id,exam_id, category, subject, exam_name, date, duration,cutoff_marks,re_exam,result_type,terms,status,exam_type,edate,no_exit,Restrict_time)
VALUES ('$login_user_id','$exam_id', '$category', '$subject', '$exam', '$date', '$duration','$cmarks', '$attempts','$result_type', '$terms','Inactive','Normal','$edate',$exittime,'$Restrict_time')";

if ($conn->query($sql) === TRUE) {
    
    
    $sql1 = "select * from tbl_account where category='$category'";
    
    $result1 = $conn->query($sql1);
    
    while($row1 = $result1->fetch_assoc()){
        $id = $row1['student_id'];
        
        $sql2 = "select * from tbl_users where user_id='$id'";
        
        $result2 = $conn->query($sql2);
        
        $row2 = $result2->fetch_assoc();
        $stu_email = $row2['email'];
    
        $from = "examinfo@kendel.in";
        $to =   $stu_email;
        $subject = "Exam Details";
        $message = "Welcome $stu_first_name $stu_last_name !
       Your Teacher Has Created Exam which will be held on
        $edate
       
        "
        ;
        
        $headers = "From :".$from;
        
        mail($to,$subject,$message,$headers);
    
    
        }

header("location:../examinations.php?rp=2932");
} else {
header("location:../examinations.php?rp=7788");
}


}
$conn->close();
?>