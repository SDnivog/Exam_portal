<?php 

include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

$output = '';

$connect = $conn;

if(isset($_POST["export"]))
{
 $query = "SELECT * FROM tbl_users where teacher_id='$login_user_id' ORDER BY first_name ";

 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         
                         <th>First name</th>  
                         <th>Last name</th>
                         <th>Student Id</th>
                         <th>Teacher Id</th>  
                         <th>Gender</th>  
                         <th>Date of Birth</th>
                         <th>Email</th>
                         <th>Mobile No</th>
                         <th>Address</th>
                         <th>Department</th>
                         <th>Category</th>
                         <th>Registration Date</th>
                         <th>Attempt</th>  
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>                
                         <td>'.$row["first_name"].'</td>  
                         <td>'.$row["last_name"].'</td>  
                         <td>'.$row["user_id"].'</td> 
                         <td>'.$row["teacher_id"].'</td>  
                         <td>'.$row["gender"].'</td>  
                         <td>'.$row["dob"].'</td> 
                         <td>'.$row["email"].'</td>  
                         <td>'.$row["phone"].'</td>  
                         <td>'.$row["address"].'</td> 
                         <td>'.$row["department"].'</td>  
                         <td>'.$row["category"].'</td>  
                         <td>'.$row["register_date"].'</td>
                         <td>'.$row["no_attempt"].'</td>  
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Students.xls');
  echo $output;
 }
}




?>