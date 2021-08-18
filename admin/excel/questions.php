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
 $query = "SELECT * FROM tbl_questions where user_id='$login_user_id' AND exam_id ='$examid' ";

 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         
                         <th>Teacher Id</th>  
                         <th>Question Id</th>  
                         <th>Question No</th>
                         <th>Exam Id</th>
                         <th>Question</th>
                         <th>Question Type</th>
                         <th>Option 1</th>
                         <th>Option 2</th>
                         <th>Option 3</th>
                         <th>Option 4</th>
                         <th>Answer</th>
                         <th>Positive Marks</th>
                         <th>Negative Marks</th>
                         <th>Question time</th>
                         <th>Type Value</th>  
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>                
                         <td>'.$row["user_id"].'</td>  
                         <td>'.$row["question_id"].'</td>  
                         <td>'.$row["question_no"].'</td> 
                         <td>'.$row["exam_id"].'</td>  
                         <td>'.$row["question"].'</td>  
                         <td>'.$row["question_type"].'</td> 
                         <td>'.$row["option1"].'</td>  
                         <td>'.$row["option2"].'</td>  
                         <td>'.$row["option3"].'</td> 
                         <td>'.$row["option4"].'</td>  
                         <td>'.$row["answer"].'</td>  
                         <td>'.$row["pos_marks"].'</td> 
                         <td>'.$row["neg_marks"].'</td>  
                         <td>'.$row["question_time"].'</td>
                         <td>'.$row["type_val"].'</td>  
                          
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Questions.xls');
  echo $output;
 }
}




?>