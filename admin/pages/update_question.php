<?php

include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

$examid = mysqli_real_escape_string($conn, $_POST['exam_id']);
$question_id = mysqli_real_escape_string($conn, $_POST['question_id']);
$question = mysqli_real_escape_string($conn, $_POST['question']);
$answer = mysqli_real_escape_string($conn, $_POST['answer']);
$pmarks = mysqli_real_escape_string($conn, $_POST['pmarks']);
$nmarks = mysqli_real_escape_string($conn, $_POST['nmarks']);
$question_type = mysqli_real_escape_string($conn, $_POST['question_type']);
$Image = mysqli_real_escape_string($conn, $_FILES['Image']['name']);
$check1 = mysqli_real_escape_string($conn, $_POST['check1']);
$check2 = mysqli_real_escape_string($conn, $_POST['check2']);
$check3 = mysqli_real_escape_string($conn, $_POST['check3']);
$check4 = mysqli_real_escape_string($conn, $_POST['check4']);





	
if ($question_type == "STQ") {	
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



    if($answer != ''){
    //   $sql = "update tbl_questions set question='$question',pos_marks='$pmarks',neg_marks='$nmarks',"
$sql = "INSERT INTO tbl_questions (user_id,question_id,question_no,exam_id, question, image,question_type, option1, option2, option3, option4, answer,pos_marks,neg_marks,question_time,type_val)
VALUES ('$login_user_id','$question_id','0','$examid', '$question', '$file','$question_type','$opt1', '$opt2', '$opt3', '$opt4', '$answer','$pmarks','$nmarks','$qtime','1')";
        
       
    }
    else{
        echo 'Please Enter answer';
        // $answer = '';
        // if($check1 != ""){
        //     $answer .= $check1;
        // }
        //  if($check2 != ""){
        //     $answer .= $check2;
        // }
        //  if($check3 != ""){
        //     $answer .= $check3;
        // }
        //  if($check4 != ""){
        //     $answer .= $check4;
        // }
       
        
        // if(!empty($Image)){
            

        //     $sql = "INSERT INTO tbl_questions (user_id,question_id,question_no,exam_id, question, image,question_type, option1, option2, option3, option4, answer,pos_marks,neg_marks,question_time,type_val)
        //     VALUES ('$login_user_id','$question_id','0','$examid', '$question', '$file','$question_type','$opt1', '$opt2', '$opt3', '$opt4', '$answer','$pmarks','$nmarks','$qtime','1')";
        //             }
        //             else{
        //                 $sql = "INSERT INTO tbl_questions (user_id,question_id,question_no,exam_id, question, image,question_type, option1, option2, option3, option4, answer,pos_marks,neg_marks,question_time,type_val)
        //     VALUES ('$login_user_id','$question_id','0','$examid', '$question', '','$question_type','$opt1', '$opt2', '$opt3', '$opt4', '$answer','$pmarks','$nmarks','$qtime','1')";
        //             }
    }


if ($conn->query($sql) === TRUE) {
    ///Image Functionality added by Govind
move_uploaded_file($_FILES['Image']['tmp_name'],$file);
move_uploaded_file($_FILES["Image1"]["tmp_name"], $Target1);
move_uploaded_file($_FILES["Image2"]["tmp_name"], $Target2);
move_uploaded_file($_FILES["Image3"]["tmp_name"], $Target3);
move_uploaded_file($_FILES["Image4"]["tmp_name"], $Target4);
    header("location:../questions.php?rp=0357&eid=$examid");	
} else {
 header("location:../questions.php?rp=3903&eid=$examid");	
}

}



else if($question_type == "FQ") {
    
     if(empty($Image)){
  $file = '';
}
else{
 $folderPath = 'Upload/';
 
        $filename = uniqid() . '.png';
        $file = $folderPath .$filename;
}

$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question' AND image='$file'";
$result = $conn->query($sql);

///Image Functionality added by Govind


if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../questions.php?rp=1185&eid=$examid");
    }
} else {

$sql = "INSERT INTO tbl_questions (user_id,question_id,question_no, exam_id, question,image ,question_type,answer,pos_marks,neg_marks,type_val)
VALUES ('$login_user_id','$question_id','0', '$examid', '$question','$file','$question_type','$answer','$pmarks','$nmarks','0')";

if ($conn->query($sql) === TRUE) {
    ///Image Functionality added by Govind
move_uploaded_file($_FILES['Image']['tmp_name'],$file);

  header("location:../questions.php?rp=0357&eid=$examid");  	
} else {
 header("location:../questions.php?rp=3903&eid=$examid");
}


}


}else if($question_type == "MTQ"){
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

$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question' AND image='$file'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
 header("location:../questions.php?rp=1185");
    }
} else {

    if($answer != ''){
        if(!empty($Image)){
            
        

$sql = "INSERT INTO tbl_questions (user_id,question_id,question_no,exam_id, question, image,question_type, option1, option2, option3, option4, answer,pos_marks,neg_marks,question_time,type_val)
VALUES ('$login_user_id','$question_id','0','$examid', '$question', '$file','$question_type','$opt1', '$opt2', '$opt3', '$opt4', '$answer','$pmarks','$nmarks','$qtime','1')";
        }
        else{
            $sql = "INSERT INTO tbl_questions (user_id,question_id,question_no,exam_id, question, image,question_type, option1, option2, option3, option4, answer,pos_marks,neg_marks,question_time,type_val)
VALUES ('$login_user_id','$question_id','0','$examid',  '$question', '','$question_type','$opt1', '$opt2', '$opt3', '$opt4', '$answer','$pmarks','$nmarks','$qtime','1')";
        }
    }
    else{
        $answer = '';
        if($check1 != ""){
            $answer .= $check1;
        }
         if($check2 != ""){
            $answer .= $check2;
        }
         if($check3 != ""){
            $answer .= $check3;
        }
         if($check4 != ""){
            $answer .= $check4;
        }
       
        
        if(!empty($Image)){
            

            $sql = "INSERT INTO tbl_questions (user_id,question_id,question_no,exam_id, question, image,question_type, option1, option2, option3, option4, answer,pos_marks,neg_marks,question_time,type_val)
            VALUES ('$login_user_id','$question_id','0','$examid', '$question', '$file','$question_type','$opt1', '$opt2', '$opt3', '$opt4', '$answer','$pmarks','$nmarks','$qtime','1')";
                    }
                    else{
                        $sql = "INSERT INTO tbl_questions (user_id,question_id,question_no,exam_id, question, image,question_type, option1, option2, option3, option4, answer,pos_marks,neg_marks,question_time,type_val)
            VALUES ('$login_user_id','$question_id','0','$examid', '$question', '','$question_type','$opt1', '$opt2', '$opt3', '$opt4', '$answer','$pmarks','$nmarks','$qtime','1')";
                    }
    }


if ($conn->query($sql) === TRUE) {
    ///Image Functionality added by Govind
move_uploaded_file($_FILES['Image']['tmp_name'],$file);
move_uploaded_file($_FILES["Image1"]["tmp_name"], $Target1);
move_uploaded_file($_FILES["Image2"]["tmp_name"], $Target2);
move_uploaded_file($_FILES["Image3"]["tmp_name"], $Target3);
move_uploaded_file($_FILES["Image4"]["tmp_name"], $Target4);
    header("location:../questions.php?rp=0357&eid=$examid");	
} else {
 header("location:../questions.php?rp=3903&eid=$examid");	
}

}

}else if($question_type == "TQ") {
    
     if(empty($Image)){
  $file = '';
}
else{
 $folderPath = 'Upload/';
 
        $filename = uniqid() . '.png';
        $file = $folderPath .$filename;
}

$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question' AND image='$file'";
$result = $conn->query($sql);

///Image Functionality added by Govind


if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../questions.php?rp=1185&eid=$examid");
    }
} else {

$sql = "INSERT INTO tbl_questions (user_id,question_id,question_no, exam_id, question,image ,question_type,answer,pos_marks,neg_marks,type_val)
VALUES ('$login_user_id','$question_id','0', '$examid', '$question','$file','$question_type','$answer','$pmarks','$nmarks','2')";

if ($conn->query($sql) === TRUE) {
    ///Image Functionality added by Govind
move_uploaded_file($_FILES['Image']['tmp_name'],$file);

  header("location:../questions.php?rp=0357&eid=$examid");  	
} else {
 header("location:../questions.php?rp=3903&eid=$examid");
}


}


}
	else {
	    echo 'there is error';
	}



?>






///// previous code 
// include '../../database/config.php';
// include '../../includes/uniques.php';
// $question_id = $_POST['question_id'];
// $question = mysqli_real_escape_string($conn, $_POST['question']);
// $answer = mysqli_real_escape_string($conn, $_POST['answer']);

// if (isset($_GET['type'])) {
// $question_type = $_GET['type'];	
// if ($question_type == "mc") {	
// $opt1 = mysqli_real_escape_string($conn, $_POST['opt1']);
// $opt2 = mysqli_real_escape_string($conn, $_POST['opt2']);
// $opt3 = mysqli_real_escape_string($conn, $_POST['opt3']);
// $opt4 = mysqli_real_escape_string($conn, $_POST['opt4']);


// $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question' AND question_id != '$question_id'";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {

//     while($row = $result->fetch_assoc()) {
//  header("location:../edit-question.php?rp=1185&id=$question_id");
//     }
// } else {

// $sql = "UPDATE tbl_questions SET question='$question', option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', answer='$answer' WHERE question_id='$question_id'";

// if ($conn->query($sql) === TRUE) {
//     header("location:../edit-question.php?rp=7823&id=$question_id");	
// } else {
//  header("location:../edit-question.php?rp=1298&id=$question_id");	
// }

// }


// }else if($question_type == "fib") {

// $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question' AND question_id != '$question_id'";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {

//     while($row = $result->fetch_assoc()) {
//  header("location:../edit-question.php?rp=1185&id=$question_id");
//     }
// } else {

// $sql = "UPDATE tbl_questions SET question='$question', answer='$answer' WHERE question_id='$question_id'";

// if ($conn->query($sql) === TRUE) {
//     header("location:../edit-question.php?rp=7823&id=$question_id");	
// } else {
//  header("location:../edit-question.php?rp=1298&id=$question_id");	
// }


// }


// }else{
	
// }
	
// }else{
	

	
// }


?>