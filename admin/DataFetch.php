<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';

extract($_POST);

if(isset($id) and isset($qno)){
    $data = '';
    
    if($id === "STQ"){
  
        $data .= '  <div class="radiobtn" id="radiobtn'.$qno.'" style="display:flex">';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                $arr = ['A','B','C','D'];
                                    
                                                    $data .=  '<label class="container1"><p><input type="radio" name="answerradio'.$qno.'"  class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                
                                            
                                             }
                                                 
                                           
                                                     
        $data .= '</div>';
    }
    else if($id == "MTQ"){
                                            // code for checkbox 
                                            $data .= ' <div class="checkbtn" id="checkbtn'.$qno.'"  style="display:flex">
                                                 ';
                                                   
                                            for($i=1;$i<=4;$i++){ 

                                                $arr = ['A','B','C','D'];
                                             
                                               
                                                
                                          
                                                    $data .= '<label class="container1"><p><input type="checkbox" name="answercheckbox'.$i.$qno.'"  class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                
                                            
                                             }
                                                 
                                           
                                                     
                                            $data .= '</div>';
                                            
    }else if($id == "FQ"){
                                            // code for fill
                                            
                                             $data .= ' <div class="fillbtn" id="fillbtn'.$qno.'" style="display:flex">
                                                 ';
                                                   
                                                
                                     $data .= '<label class="container1"><p><input type="text" name="answerfill'.$qno.'" placeholder="Enter Answer"  class="form-control active" value='.$arr[$i-1].' > '.$arr[$i-1].'</p></label>';
                                            
                                                
                                            
                                             
                                                 
                                           
                                                     
                                            $data .=  '</div>';
    }
    else if ($id == "TQ"){
                                            
                                            /// code for true or false
                                            $data .= ' <div class="truebtn" id="truebtn'.$qno.'" style="display:flex">
                                                 ';
                                                   
                                            for($i=1;$i<=2;$i++){ 

                                                $arr = ['true','false'];
                                                $mainarr = ['A','B'];
                                                
                                                $data .=  '<label class="container1"><p><input type="radio" name="answertrue'.$qno.'"  class="form-control" value='.$arr[$i-1].'> '.$arr[$i-1].'</p></label>';

                                                
                                            
                                             }
                                                 
                                           
                                                     
                                            $data .= '</div>';
    }
        
        
        
        
        
    
    
    echo $data;
}



?>