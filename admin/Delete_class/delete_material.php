<?php
include '../../database/config.php';
include '../../database/config_class.php';
include '../includes/check_user.php';


$id = $_GET['material_id'];
$c_id = $_GET['class_id'];
$stream = $_GET['stream'];


$sql = "delete from study_material where teacher_id='$login_user_id' and material_id='$id'";

$result = $conn1->query($sql);

header('location:../material.php?cls_id='.$c_id.'&stream='.$stream.'');










?>