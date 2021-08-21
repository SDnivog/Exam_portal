 <?php 

include '../database/config.php';
include '../database/config_class.php';
include '../includes/uniques.php';
include 'includes/check_user.php';

extract($_POST);
session_start();




    
         $t_id = $_SESSION['myid'];
         $class_id =$_GET['class_id'];
         $stream = $_GET['stream'];
         $assign_id = "A-".rand(10,100)."-".rand(100,1000);
    $result=$conn1->query("select *from add_assignment");
    $row=$result->fetch_assoc();
    if($notes_id==$row['assign_id']){
         $assign_id = "M-".rand(10,100)."-".rand(100,1000);
    }
    date_default_timezone_set("Asia/Kolkata");
    $file = $_FILES['file'];
    $filename = $file['name'];
    $des = 'classroom_data/'.$file['name'];
    
    $date = date("Y-m-d");
    
    
   
    
    
        $sql= "INSERT INTO add_assignment VALUES ('0','$assign_id','$t_id','$class_id','$stream','$title','$desc','$file_type','$filename','$links','$assignto','$marks','$duetime','$datetime','1','$date')";
   
        $result = $conn1->query($sql);
        
        if($result){
            
            if($file_type=='file'){
                 move_uploaded_file($_FILES['file']['tmp_name'],$des);
            }
            $_SESSION['type']="success";
            $_SESSION['msg'] ="Assignment ".$title." Added Successfully";
            header('location:./assignment.php?class_id='.$class_id.'&stream='.$stream.'');
        }
        else{
            $_SESSION['type']="danger";
            $_SESSION['msg'] ="There is some Error while Adding";
            header('location:./assignment.php?class_id='.$class_id.'&stream='.$stream.'');
        }
        

    
    
    








    //      $title =  $_POST['title'];
    //      $desc = $_POST['desc'];
    //      $type_url_file =  $_POST['duetime'];
       
        
    
    //     $assignto =$_POST['assignto'];
    //     $marks =  $_POST['marks'];
    //     $due_yes_or_no =  $_POST['duetime1'];
       
    //     $due_datetime = "";
    //     $filename = "";
    //     $link = "";
    //     $file = "";
         
    //      if($type_url_file == "file"){
    //         $file = $_FILES['file']['name']; 
         
    //      }else if($type_url_file == "link"){
    //         $link =  $_POST['links']; 
          
    //           $filename = date("mjYHis")."_".$file;        
    //             $path = 'classroom_data/'.basename($filename);
                
               
    //      }
         
    //      if($due_yes_or_no == "due"){
    //           $due_datetime = $_POST['datetime'];
    //      }
         
         
          
    
     
 
    

    
         
    //      $sql = "INSERT INTO add_assignment(assign_id,t_id,class_id,stream,title,desc,type_url_file,file,link,assignto,marks,due_yes_or_no,due_datetime,status)
    //      VALUES('$assign_id','$login_user_id','$class_id','$stream','$title','$desc','$type_url_file','$filename','$link','$assignto','$marks','$due_yes_or_no','$due_datetime','1') ";
        
    //     $x =$conn->query($sql);
    //     if ($x) {
    //         if(!empty($filename)){
    //             move_uploaded_file($_FILES['file']['tmp_name'],$path);  
    //         }

    //       echo "success";
            
          

    //     }else{
    //       echo "failed";
    //     }
    //  echo"wdewgyi";
     
    
     
     
     
     
     ?>   