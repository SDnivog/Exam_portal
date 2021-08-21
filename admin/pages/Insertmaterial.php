<?php

include '../../database/config_class.php';
include '../../database/config.php';
include '../includes/check_user.php';


$class_id = mysqli_real_escape_string($conn, $_GET['class_id']);
$stream = mysqli_real_escape_string($conn, $_GET['stream']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$desc = mysqli_real_escape_string($conn, $_POST['desc']);
$type_url_file = mysqli_real_escape_string($conn, $_POST['duetime']);
$file = mysqli_real_escape_string($conn, $_FILES['file']);
$link = mysqli_real_escape_string($conn, $_POST['link']);

if(!empty($class_id) and !empty($stream) and !empty($title) and !empty($desc) and !empty($type_url_file)){
    $material_id = "M-".rand(100,999)."-".rand(100,999)."-".rand(100,999);
    
    if()
    
    $sql = "INSERT INTO `study_material`(`material_id`, `teacher_id`, `class_id`, `department`, `topic`, `description`, `file`, `date`, `status`) VALUES ('$material_id','$login_user_id','$class_id','$stream','$title','$desc','$')"
    
    
    
    
    
}









?>