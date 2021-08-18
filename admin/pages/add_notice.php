<?php 
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../database/config.php';
include '../includes/check_user.php'; 
include '../../includes/uniques.php';
$notice_id = 'NT-'.get_rand_numbers(8).'';
$post_date = date('d/m/Y h:i:s');
$title = ucwords(mysqli_real_escape_string($conn, $_POST['title']));
$description = mysqli_real_escape_string($conn, $_POST['description']);
$category = mysqli_real_escape_string($conn, $_POST['category']);

$sql = "INSERT INTO tbl_notice (user_id,notice_id, post_date, last_update, description, title,category)
VALUES ('$login_user_id','$notice_id', '$post_date', '$post_date', '$description', '$title','$category')";

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
        $message = "You Have Notice From Your Teacher 
        <b>$title</b>
        <small>$description</small>
       
        "
        ;
        
        $headers = "From :".$from;
        
        mail($to,$subject,$message,$headers);
    
    
        }
    
    
    
    
    
    
    header("location:../notice.php?rp=9174");
} else {
    header("location:../notice.php?rp=6389");
}

$conn->close();
?>
