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
    
    
   
   if($efiletype == "file"){
        $file = $_FILES['efile'];
        $filename = $file['name'];
        $des = 'classroom_study/'.$file['name'];
        $sql = "update study_material set topic='$etitle',description='$edescription',file_type='$efiletype',source='$filename',edit_date='$date' where material_id='$live_id'";
   }else{
        $sql = "update study_material set topic='$etitle',description='$edescription',file_type='$efiletype',link='$elink',edit_date='$date'  where material_id='$live_id'";
   }
   
   
   
    
    
     
   
        $result = $conn1->query($sql);
        
        if($result){
            
           
            $_SESSION['type']="success";
            $_SESSION['msg'] ="study Material ".$etitle." Edited Successfully";
            header('location:./material.php?cls_id='.$class_id.'&stream='.$stream.'');
        }
        else{
            $_SESSION['type']="danger";
            $_SESSION['msg'] ="There is some Error while Editing";
            header('location:./material.php?cls_id='.$class_id.'&stream='.$stream.'');
        }
        

    
    
    








     
    
     
     
     
     
     ?>   