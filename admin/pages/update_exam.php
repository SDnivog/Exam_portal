<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../database/config.php';
include '../../includes/uniques.php';
$exam_id = $_POST['examid'];
$exam = ucwords(mysqli_real_escape_string($conn, $_POST['exam']));
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$cutoff = mysqli_real_escape_string($conn, $_POST['passmark']);
$attempts = mysqli_real_escape_string($conn, $_POST['attempts']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$terms = ucfirst(mysqli_real_escape_string($conn, $_POST['instructions']));
$exam_date = mysqli_real_escape_string($conn, $_POST['edate']);
$Restrict_time = mysqli_real_escape_string($conn, $_POST['Restrict_time']);
$exit = mysqli_real_escape_string($conn, $_POST['exit']);
$sql = "SELECT * FROM tbl_examinations WHERE exam_name = '$exam' AND department = '$department' AND category = '$category' AND exam_id != '$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../examinations.php?rp=1185");
    }
} else {
    
 
    
    
if(empty($exam_date)){
$sql = "UPDATE tbl_examinations SET category = '$category', department = '$department', exam_name = '$exam', date = '$date', duration = '$duration',Restrict_time='$Restrict_time',no_exit='$exit' ,cutoff_marks = '$cutoff', re_exam = '$attempts', terms = '$terms' WHERE exam_id='$exam_id'";
}
else if(!empty($exam_date)){
$sql = "UPDATE tbl_examinations SET category = '$category', department = '$department',edate='$exam_date', exam_name = '$exam', date = '$date', duration = '$duration',Restrict_time='$Restrict_time',no_exit='$exit' ,cutoff_marks = '$cutoff', re_exam = '$attempts', terms = '$terms' WHERE exam_id='$exam_id'";
    
}
if ($conn->query($sql) === TRUE) {
     $sql1 = "select * from tbl_account where category='$category' and department='$department' and teacher_id='$login_user_id'";
    
    $result1 = $conn->query($sql1);
    
    if($result1->num_rows>0){
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
    
    }
    
    
    
    
    
    
header("location:../edit-exam.php?rp=7823&eid=$exam_id");
} else {
header("location:../edit-exam.php?rp=1298&eid=$exam_id");
}


}
$conn->close();
?>
