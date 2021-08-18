<?php
include '../../database/config.php';
include '../../database/config_class.php';
include '../includes/check_user.php';


$id = $_GET['assign_id'];
$c_id = $_GET['class_id'];
$stream = $_GET['stream'];


$sql = "delete from add_assignment where t_id='$login_user_id' and assign_id='$id'";

$result = $conn1->query($sql);

header('location:../assignment.php?class_id='.$c_id.'&stream='.$stream.'');










?>