<?php 

include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

$output = '';

$connect = $conn;

if(isset($_POST["export"]))
{
 $query = "SELECT * FROM tbl_examinations where user_id='$login_user_id'  ";

 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         
                         <th>Teacher Id</th>  
                         <th>Exam Id</th>  
                         <th>Category</th>
                         <th>Subject</th>
                         <th>Exam Name</th>
                         <th>Date</th>
                         <th>Duration</th>
                         <th>CutOff Marks</th>
                         <th>Re-Exam</th>
                         <th>Result Type</th>
                         <th>Result Status</th>
                         <th>Terms</th>
                         <th>Status</th>
                         <th>Exam Type</th>  
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>                
                         <td>'.$row["user_id"].'</td>  
                         <td>'.$row["exam_id"].'</td>  
                         <td>'.$row["category"].'</td>
                         <td>'.$row["subject"].'</td>  
                         <td>'.$row["exam_name"].'</td>  
                         <td>'.$row["date"].'</td> 
                         <td>'.$row["duration"].'</td>  
                         <td>'.$row["cutoff_marks"].'</td>  
                         <td>'.$row["re_exam"].'</td> 
                         <td>'.$row["result_type"].'</td>  
                         <td>'.$row["result_status"].'</td>  
                         <td>'.$row["terms"].'</td> 
                         <td>'.$row["status"].'</td>  
                         <td>'.$row["exam_tpe"].'</td>    
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=AllExams.xls');
  echo $output;
 }
}




?>