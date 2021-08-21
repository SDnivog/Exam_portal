<?php 

include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

?>

<?php

$examid = $_GET['exam_id'];

?>

     <?php                                          


$output = '';

$connect = $conn;

if(isset($_POST["export"]))
{
 $query = "SELECT * FROM tbl_assessment_records where  exam_id ='$examid' ";

 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         
                         <th>Record Id</th>  
                         <th>Student Id</th>  
                         <th>Student Name</th>
                         <th>Exam Name</th>
                         <th>Exam Id</th>
                         <th>Score</th>
                         <th>Status</th>
                         <th>Date</th>
                           
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>                
                         <td>'.$row["record_id"].'</td>  
                         <td>'.$row["student_id"].'</td>  
                         <td>'.$row["student_name"].'</td> 
                         <td>'.$row["exam_name"].'</td>  
                         <td>'.$row["exam_id"].'</td>  
                         <td>'.$row["score"].'</td> 
                         <td>'.$row["status"].'</td> 
                         <td>'.$row["date"].'</td>  
     
                          
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Results.xls');
  echo $output;
 }
}




?>