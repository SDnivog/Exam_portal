 <?php 

include '../database/config.php';
include '../database/config_class.php';
include '../includes/uniques.php';
include 'includes/check_user.php';

extract($_POST);
session_start();




    
      
         $live_id =$_GET['id'];
         $class_id =$_GET['class_id'];
         $stream =$_GET['stream'];
        
      
    date_default_timezone_set("Asia/Kolkata");
  
    
    $date = date("Y-m-d");
    
    
   
   if(!empty($edatetime)){
        $sql = "update live_class set title='$etitle',description='$edescription',platform='$eplatform',link='$elink',class_time='$edatetime',edit_date='$date' where live_id='$live_id'";
   }else{
        $sql = "update live_class set title='$etitle',description='$edescription',platform='$eplatform',link='$elink',edit_date='$date'  where live_id='$live_id'";
   }
   
   
   
    
    
     
   
        $result = $conn1->query($sql);
        
        if($result){
            
           
            $_SESSION['type']="success";
            $_SESSION['msg'] ="Live Class  ".$etitle." Edited Successfully";
            header('location:./liveclass.php?class_id='.$class_id.'&stream='.$stream.'');
        }
        else{
            $_SESSION['type']="danger";
            $_SESSION['msg'] ="There is some Error while Editing";
            header('location:./liveclass.php?class_id='.$class_id.'&stream='.$stream.'');
        }
        

    
    
    








     
    
     
     
     
     
     ?>   