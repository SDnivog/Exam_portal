<?php
include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';
$examid = mysqli_real_escape_string($conn, $_POST['exam_id']);
$question_id = 'QS-'.get_rand_numbers(6).'';
$question = mysqli_real_escape_string($conn, $_POST['question']);
$answer = mysqli_real_escape_string($conn, $_POST['answer']);
$pmarks = mysqli_real_escape_string($conn, $_POST['pmarks']);
$nmarks = mysqli_real_escape_string($conn, $_POST['nmarks']);
///Image Functionality added by Govind
$Image = mysqli_real_escape_string($conn, $_FILES['Image']['name']);



// echo $_FILES['Image']['name'];


if (isset($_GET['type'])) {
$question_type = $_GET['type'];	
if ($question_type == "mc") {	
$opt1 = mysqli_real_escape_string($conn, $_POST['opt1']);
if($opt1==""){
    $opt1=mysqli_real_escape_string($conn, $_FILES['Image1']['name']);
    $Target1 = "Upload/".basename($_FILES['Image1']['name']);
}
$opt2 = mysqli_real_escape_string($conn, $_POST['opt2']);
if($opt2==""){
    $opt2=mysqli_real_escape_string($conn, $_FILES['Image2']['name']);
    $Target2 = "Upload/".basename($_FILES['Image2']['name']);
}
$opt3 = mysqli_real_escape_string($conn, $_POST['opt3']);
if($opt3==""){
    $opt3=mysqli_real_escape_string($conn, $_FILES['Image3']['name']);
    $Target3 = "Upload/".basename($_FILES['Image3']['name']);
}
$opt4 = mysqli_real_escape_string($conn, $_POST['opt4']);
if($opt4==""){
    $opt4=mysqli_real_escape_string($conn, $_FILES['Image4']['name']);
    $Target4 = "Upload/".basename($_FILES['Image4']['name']);
}






$qtime = mysqli_real_escape_string($conn, $_POST['qtime']);




if(empty($Image)){
  $file = '';
}
else{
 $folderPath = 'Upload/';
 
        $filename = uniqid() . '.png';
        $file = $folderPath .$filename;
}
// $Target = "Upload/".basename($_FILES['Image']['name']);


$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question' AND image='$file'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
 header("location:../add-questions.php?rp=1185&eid=$examid");
    }
} else {
    

$sql = "INSERT INTO tbl_questions (user_id,question_id,bonus, exam_id, type, question,image,question_type ,option1, option2, option3, option4, answer,pos_marks,neg_marks,question_time,type_val)
VALUES ('$login_user_id','$question_id','0', '$examid', 'MC', '$question', '$file','STQ','$opt1', '$opt2', '$opt3', '$opt4', '$answer','$pmarks','$nmarks','0','1')";



if ($conn->query($sql) === TRUE) {

if(!empty($Image)){
move_uploaded_file($_FILES['Image']['tmp_name'],$file);
}
move_uploaded_file($_FILES["Image1"]["tmp_name"], $Target1);
move_uploaded_file($_FILES["Image2"]["tmp_name"], $Target2);
move_uploaded_file($_FILES["Image3"]["tmp_name"], $Target3);
move_uploaded_file($_FILES["Image4"]["tmp_name"], $Target4);
    
    
    header("location:../add-questions.php?rp=0357&eid=$examid");	
} else {
 header("location:../add-questions.php?rp=3903&eid=$examid");	
}

}


}else if($question_type == "fib") {
$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question' AND image='$file'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../add-questions.php?rp=1185&eid=$examid");
    }
} else {
      $folderPath = 'Upload/';
    $image_parts = explode(";base64,", $_POST['data1']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = uniqid() . '.png';
        $file = $folderPath .$filename;
    $sql = "INSERT INTO tbl_questions (user_id,question_id,bonus, exam_id, type, question,image, answer,pos_marks,neg_marks,question_time,type_val)
VALUES ('$login_user_id','$question_id','0', '$examid', 'FB', '$question', '$file','$answer','$pmarks','$nmarks','0','0')";


if ($conn->query($sql) === TRUE) {
    file_put_contents($file, $image_base64);
  header("location:../add-questions.php?rp=0357&eid=$examid");  	
} else {
 header("location:../add-questions.php?rp=3903&eid=$examid");
}


}


}else{
	
}
	
}else{
	
header("location:../");	
	
}


?>