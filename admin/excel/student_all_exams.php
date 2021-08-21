<?php 

include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

?>

<?php

$studentid = $_GET['student_id'];

?>

     <?php                                          


$output = '';

$connect = $conn;

if(isset($_POST["export"]))
{
 $query = "SELECT * FROM tbl_assessment_records where  student_id ='$studentid' ";

 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Student Id </th>
                         <th>Exam Name</th>  
                         <th>Date</th>  
                         <th>Score</th>
                         <th>Status</th>
                       
                           
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>                
                         <td>'.$row["student_id"].'</td>  
                         <td>'.$row["exam_name"].'</td>  
                         <td>'.$row["date"].'</td> 
                         <td>'.$row["score"].'</td> 
                         <td>'.$row["status"].'</td> 
                          
     
                          
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename='.$studentid.'_student_performance.xls');
  echo $output;
 }
}




?>