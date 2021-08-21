<?php
include '../../database/config.php';
include '../../database/config_class.php';
include '../includes/check_user.php';


$id = $_GET['live_id'];
$c_id = $_GET['class_id'];
$stream = $_GET['stream'];


$sql = "delete from live_class where teacher_id='$login_user_id' and live_id='$id'";

$result = $conn1->query($sql);

header('location:../liveclass.php?class_id='.$c_id.'&stream='.$stream.'');










?>