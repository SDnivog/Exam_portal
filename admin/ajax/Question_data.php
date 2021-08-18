<?php

include '../../database/config.php';

extract($_POST);

if(isset($question_id)){
    $sql ="select * from tbl_questions where question_id='$question_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    
    $output =' <div class="Modal4"><form id="UpdateForm" action="pages/update-single-questions.php?question_id='.$question_id.'&exam_id='.$row["exam_id"].'&datafile='.$datafile.'" method="post" enctype="multipart/form-data"><h4>Update  Question </h4>
            <div class="form-group"><label for="exampleInputEmail1">Question :</label>
            <input type="text" class="form-control" id="question" name="question"  placeholder="Enter Question" value="'.$row["question"].'"  autocomplete="off"></div>
            <div class="form-group"><label for="exampleInputEmail1">Upload File</label><input type="file" class="form-control"  name="ModalImage"  autocomplete="off"></div>
            <div class="form-group">
                <label for="exampleInputEmail1">Positive Marks</label>
                <input type="number" value="'.$row["pos_marks"].'"  class="form-control" placeholder="Enter Positive Marks For Per Question" name="pmarks" id="pmarks" autocomplete="off">
                </div><div class="form-group">  <label for="exampleInputEmail1">Negative Marks</label>
                <input type="number" value="'.$row["neg_marks"].'"  class="form-control" placeholder="Enter Negative Marks For Per Question" name="nmarks" id="nmarks" autocomplete="off"></div>
                <div class="row">
                <input type="hidden" name="question_data" value="'.$row['question_type'].'">
                <div class="col-lg-12">
                 ';
                
            
        if($row['question_type'] == "STQ"){
             $output .='<div class="radiobtn" id="radiobtn" >';
                         $answer = $row['answer'];                      
                for($i=1;$i<=4;$i++){ 
                      $check_image = explode('.',$row['option'.$i]);
                                           
                       $ext = strtolower(end($check_image));
                     
                        if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                           
                              if($row['option'.$i] == $row[$answer]){
                    $output .= '<label class="container1"><p><input type="radio" name="answer" checked class="form-control" value='.$row['option'.$i].'> <img src = "pages/Upload/'.$row["option".$i].'" style="max-width:200px;max-height:100px"></p></label>';
                        }else{
                                $output .= '<label class="container1"><p><input type="radio" name="answer" class="form-control" value='.$row['option'.$i].'> <img src = "pages/Upload/'.$row["option".$i].'" style="max-width:200px;max-height:100px"></p></label>';
                        }
                       }
                       
                  else{
                           if($row['option'.$i] == $row[$answer]){
                    $output .= '                        
                                <label class="container1"><p><input type="radio" checked name="answer"   class="form-control" value="option'.$i.'">'.$row["option".$i].'</p></label>';
                        }else{
                      
                 $output .= '                        
                                <label class="container1"><p><input type="radio" name="answer"   class="form-control" value="option'.$i.'">'.$row["option".$i].'</p></label>';
                        }
                    }
                                               
                     } 
                                                 
                $output .=  '</div>';
                
                    }
                   else  if ($row['question_type'] == "MTQ"){
                       $answer = $row['answer'];
                                          $output .= '<div class="checkbtn" id="checkbtn"  >';
                                            
                                     
                for($i=1;$i<=4;$i++){ 
                       $check_image = explode('.',$row['option'.$i]);
                                           
                       $ext = strtolower(end($check_image));
                       
                        if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                              if(strpos($answer,'option'.$i)  !== false){
                                $output .= '<label class="container1"><p><input type=checkbox name="checkbox'.$i.'" checked  class="form-control" value='.$row['option'.$i].'> <img src = "pages/Upload/'.$row["option".$i].'" style="max-width:200px;max-height:100px"></p></label>';
                            }
                          else{
                                      $output .= '<label class="container1"><p><input type=checkbox name="checkbox'.$i.'"  class="form-control" value='.$row['option'.$i].'> <img src = "pages/Upload/'.$row["option".$i].'" style="max-width:200px;max-height:100px"></p></label>';
                             }
                            
                        }else{
                       if(strpos($answer,'option'.$i)  !== false){ 
                                 $output .= '<label class="container1"><p><input type="checkbox" checked name="checkbox'.$i.'" id="checkbtn'.$i.'" class="form-control" value="option'.$i.'"> '.$row['option'.$i].'</p></label>';
                        }else{
                                 $output .= '<label class="container1"><p><input type="checkbox" name="checkbox'.$i.'" id="checkbtn'.$i.'" class="form-control" value="option'.$i.'"> '.$row['option'.$i].'</p></label>';
                        }
                                              
                                               
                 
                                    }
                                               
                                            
                        }
                                           
                                                 
                                           
                                                     
                       $output .= ' </div>';
                    }
                    
                else  if ($row['question_type'] == "FQ"){
                                          
                                        $output .='    
                                              <div class="fillbtn" id="fillbtn"  >'
                                              ;
                                              if($row['answer'] != ""){
                                               $output .=' <label class="container1 mb-2 p-2" style="margin-bottom:20px"><p><input type="text" name="answer" style="max-width:82%"  placeholder="Enter Answer" value="'.$row["answer"].'"  class="form-control active"></p></label></div>';
                                              }
                                              else{
                                                      $output .=' <label class="container1 mb-2 p-2" style="margin-bottom:20px"><p><input type="text" name="answer" style="max-width:82%"  placeholder="Enter Answer"  class="form-control active"></p></label></div>'; 
                                              }
                                            
                    }
                   else  if ($row['question_type'] == "TQ"){
                        
                    $output .= '<div class="truebtn" id="truebtn"  >';
                                        
                                                   
                                            for($i=1;$i<=2;$i++){ 

                                                $arr = ['true','false'];
                                            if($row['answer'] == "option".$i){
                                                
                                          
                                         $output .= '<label class="container1"><p><input type="radio" name="answer"  checked class="form-control" value="option'.$i.'">'.$arr[$i-1].'</p></label>';

                                            }else{
                                                 $output .= '<label class="container1"><p><input type="radio" name="answer"  class="form-control" value="option'.$i.'">'.$arr[$i-1].'</p></label>'; 
                                            }  
                                            
                                             }
                                               
                                           
                                                     
                                  $output .= '      </div>';
                                  
                    }
                                            
                                            
                                            
                    
                    $output .= '
                    
                    </div>
                    
                    
                </div>
                <button type="submit" class="btn btn-primary" >Submit</button><button type="button" class="btn btn-warning" onclick="UpdateClose()">Close</button></form>  </div>';
    
    
    
    echo $output;
    
}







?>