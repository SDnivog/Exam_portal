<?php 

include '../../database/config.php';
include '../../includes/uniques.php';
include '../includes/check_user.php';

$output = '';

$connect = $conn;

if(isset($_POST["export"]))
{
 $query = "SELECT * FROM edm_gp where user_id='$login_user_id' ORDER BY grp ";

 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         
                         <th>Name</th>  
                         <th>Group Name</th>  
                         <th>Roll No</th>  
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>                
                         <td>'.$row["name"].'</td>  
                         <td>'.$row["grp"].'</td>  
                         <td>'.$row["roll"].'</td>  
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=EdmGroupName.xls');
  echo $output;
 }
}




?>

 <form method="post" action="export.php">
     <input type="submit" name="export" class="btn btn-success" value="Download" />
    </form>