<?php 

include '../database/config.php';
include '../database/config_class.php';
include '../includes/uniques.php';
include 'includes/check_user.php';

include('zoom_api/config.php');
include('zoom_api/api.php');

// extract($_POST);
session_start();

         $class_id =$_GET['class_id'];
         $stream = $_GET['stream'];
         $title = $_POST['title'];
         $description = $_POST['description'];
         $platform = $_POST['platform'];
         $link = $_POST['link'];
         $datetime = $_POST['datetime'];
         $live_id = "LC-".rand(10,100)."-".rand(100,1000);
         date_default_timezone_set("Asia/Kolkata");
         $date = date("Y-m-d");
    
    

$arr['topic']=$title;
$arr['start_date']=$datetime;
$arr['duration']=$link;
$arr['password']=$description;
$arr['type']='2';
$result1=createMeeting($arr);
if(isset($result1->id)){
    $join_url = $result1->join_url;
// 	echo "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
// 	echo "Password: ".$result->password."<br/>";
// 	echo "Start Time: ".$result->start_time."<br/>";
// 	echo "Duration: ".$result->duration."<br/>";


$sql= "INSERT INTO live_class (live_id,teacher_id,class_id,department,title,description,platform,link,join_link,class_time,post_date,status) VALUES ('$live_id','$login_user_id','$class_id','$stream','$title','$description','$platform','$link','$join_url','$datetime','$date','1')";
   
        $result = $conn1->query($sql);
        
        if($result){
            
           
            $_SESSION['type']="success";
            $_SESSION['msg'] ="Live ".$title." has been scheduled Successfully";
            header('location:./liveclass.php?class_id='.$class_id.'&stream='.$stream.'');
        }
        else{
            $_SESSION['type']="danger";
            $_SESSION['msg'] ="There is some Error while Adding";
            header('location:./liveclass.php?class_id='.$class_id.'&stream='.$stream.'');
        }

}else{
	echo '<pre>';
	print_r($result1);
}
   
        
        

    
    
    








     
    
     
     
     
     
     ?>   