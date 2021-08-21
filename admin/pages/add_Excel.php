<?php 

include '../../database/config.php';
include '../includes/check_user.php';

$exam_id = $_GET['exam_id'];

$sec_name = $_GET['sec_name'];


if(isset($_FILES['excelfile']) and isset($_GET['exam_id']) and isset($_GET['sec_name'])){
   
    $file = $_FILES['excelfile'];

  

      if ( isset($_FILES['excelfile']['name']) and $_FILES['excelfile']['name'] != "" ) {
          $allowedExtensions = array("xls","xlsx");
  // Return the extension of the file
          $ext = pathinfo( $_FILES['excelfile']['name'] , PATHINFO_EXTENSION );
          if ( in_array ($ext, $allowedExtensions)){
              $isUploaded = $_FILES['excelfile']['tmp_name'];
              if ($isUploaded) {
                  include "PHPExcel/Classes/PHPExcel/IOFactory.php";
   
                  try {
                      $objPHPExcel = PHPExcel_IOFactory::load($isUploaded);
                  } catch (Exception $e) {
                      die ( 'Error loading file "' . pathinfo($isUploaded, PATHINFO_BASENAME ) . '": ' . $e->getMessage());
                  }
                  // An excel file may contains many sheets so you have to specify which one you need to read or work with.
                  $sheet = $objPHPExcel->getSheet(0);
                  // It returns the highest number of rows.
                  $total_rows = $sheet->getHighestRow();
                  // It returns the highest number of columns.
                  $highest_column = $sheet->getHighestColumn();

                
                
              
                  for ($row = 2 ; $row <= $total_rows; $row++) {
                      // Read a row of data into an array
                      $rowData = $sheet-> rangeToArray ('A' . $row . ':' . $highest_column . $row, NULL, TRUE, FALSE);
                      $sub_code = $rowData[0][0];
                      $sub_name = $rowData[0][1];
                      $sub_option1 = $rowData[0][2];
                      $sub_option2 = $rowData[0][3];
                      $sub_option3 = $rowData[0][4];
                      $sub_option4 = $rowData[0][5];
                      $answer = $rowData[0][6];
                      $pos_marks = $rowData[0][7];
                      $neg_marks = $rowData[0][8];
                      $question_id = 'QS-'.rand(100,999).rand(100,999).'';
                    
             
                    
                  
               


                      for($i=2;$i<=5;$i++){
                        if($answer == $rowData[0][$i]){
                            $data = $i-1;
                            $answer = "option".$data;
                        }

                      }
                    
                    
                    
                  
                  



                    if($sub_name != '' and $sub_code != ''){

                      $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' AND user_id = '$login_user_id' AND question='$sub_name'";
                      $result = $conn->query($sql);
                      
                      if ($result->num_rows > 0) {
                      header('location:../view-excel-questions.php?eid='.$exam_id.'&rp=1000');
                      } 
                      else{
                        
                        $sql = "INSERT INTO tbl_questions (user_id,question_id,bonus, exam_id, type,question ,question_type,option1,option2,option3,option4,answer,pos_marks,neg_marks,type_val,sec_name)
                        VALUES ('$login_user_id','$question_id','0', '$exam_id', 'MC', '$sub_name','STQ','$sub_option1','$sub_option2','$sub_option3','$sub_option4','$answer','$pos_marks','$neg_marks','1','$sec_name')";
                        
                        $result = $conn->query($sql);
                        if($result and $row == $total_rows){
                            header('location:../view-questions.php?eid='.$exam_id.'&rp=0357');
                        }
                      }
                    }
                
                }
             

                 
              
              } else {
                  echo '<span class="msg">File not uploaded!</span>';
              }
          } else {
              echo '<span class="msg">This type of file not allowed!</span>';
          }
      }
      else { echo '<span class="msg">Select an excel file first!</span>';
      }
      
      
      
       $sql_sec= "select * from tbl_assessment_records where exam_id='$exam_id'";
    
     $result_sec = $conn->query($sql_sec);
    
    if($result_sec->num_rows>0){
        $sql_up = "update tbl_examinations set status='Inactive' where exam_id='$exam_id'";
        
        $result_up = $conn->query($sql_up);
        
        if($result_up){
            header('location:../view-questions.php?eid='.$exam_id.'&rp=0357');	
        }else{
           header('location:../view-questions.php?eid='.$exam_id.'&rp=0357');	
        }
    }



}



?>