<?php
date_default_timezone_set('Asia/Kolkata');
include '../database/config.php';

$exam_id= 'EX-047987';

$sql = "select * from tbl_examinations where exam_id='$exam_id'";
$result = $conn->query($sql);
$arr = $result->fetch_assoc();

$exam_time = date("H:i:s",strtotime($arr['edate']));
$duration = $arr["duration"];

$endTime = strtotime(date("H:i:s", strtotime($arr['edate'])+($duration*60)));

$current_time = strtotime(date("H:i:s"));

echo $exam_time;

echo $duration."<br>";
echo $endTime."<br>";
echo $current_time."<br>";




// echo $endTime-$current_time; 

 $start = strtotime('12:01:00');
      $end = strtotime('13:16:00');

    //   $hours = intval(($endTime - $current_time)/3600);
    //   echo $hours.' hours'; //in hours

      //If you want it in minutes, you can divide the difference by 60 instead
      $mins = (int)(($endTime - $current_time) / 60);
      echo $mins.' minutues'.'<br>';


  $start = strtotime('12:01:00');
      $end = strtotime('13:16:00');

      $hours = intval(($end - $start)/3600);
      echo $hours.' hours'; //in hours

      //If you want it in minutes, you can divide the difference by 60 instead
      $mins = (int)(($end - $start) / 60);
      echo $mins.' minutues'.'<br>';





?>