<?php 

include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

$output = '';

$connect = $conn;

if(isset($_POST["export"]))
{
 $query = "SELECT * FROM tbl_subjects where user_id='$login_user_id' ORDER BY name ";

 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Subject Id</th>
                         <th>Subject name</th>  
                         <th>Subject Category</th>  
                         <th>Department</th>
                         <th>Registered date</th>  
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>                 <td>'.$row["subject_id"].'</td>  
                         <td>'.$row["name"].'</td>
                         <td>'.$row["department"].'</td>  
                         <td>'.$row["category"].'</td>  
                         <td>'.$row["date_registered"].'</td>  
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=AllSubjects.xls');
  echo $output;
 }
}




?>