 <?php 

// include '../database/config.php';
include '../database/config_class.php';
include '../includes/uniques.php';
include 'includes/check_user.php';

extract($_POST);
session_start();




    
    $t_id = $_SESSION['myid'];
    $class_id =$_GET['class_id'];
    $stream = $_GET['stream'];
    $notes_id = "M-".rand(10,100)."-".rand(100,1000);
    $result=$conn1->query("select *from study_material");
    $row=$result->fetch_assoc();
    if($notes_id==$row['material_id']){
         $notes_id = "M-".rand(10,100)."-".rand(100,1000);
    }
    $file = $_FILES['file'];
    $filename = $file['name'];
    $des = 'classroom_study/'.$file['name'];
    $date = date("Y-m-d");
 
        $sql= "INSERT INTO study_material VALUES ('0','$notes_id','$t_id','$class_id','$stream','$title','$desc','$filetype','$filename','$link','1','$date','0000-00-00')";
   
        $result = $conn1->query($sql);
        
        if($result){
            if($file_type=='file'){
                 move_uploaded_file($_FILES['file']['tmp_name'],$des);
            }
            $_SESSION['type']="success";
            $_SESSION['msg'] ="Notes  Added Successfully";
            header('location:./material.php?cls_id='.$class_id.'&stream='.$stream.'');
        }
        else{
            $_SESSION['type']="danger";
            $_SESSION['msg'] ="There is some Error while Adding";
            header('location:./material.php?cls_id='.$class_id.'&stream='.$stream.'');
        }
        

    
    
     
     
     
     ?>   