<?php 
include '../../database/config.php';
extract($_POST);
if(isset($mainid)){


                                            $sql = "select * from tbl_users where role='admin'";

                                            $result = $conn->query($sql);
                                          
                                    
                                            $alldata = array();
                                          
                                            while($arr = $result->fetch_assoc()){
                                                $user_id = $arr['user_id'];
                                                $sql1 = "select * from tbl_examinations where user_id='$user_id'";
                                                $result2 = $conn->query($sql1);
                                                $count = $result2->num_rows;
                                            
                                               $alldata[$user_id]=$count;
                                                arsort($alldata);
                                            }
                                            $i=1;
                                        
                                       
                                            foreach($alldata as $x => $x_value) {
                                                if($i>5){
                                                    break;
                                                }
                                                    
                                         
                                                $data_id = $x;
                                                $index_count = $x_value;
                                               

                                                if(!empty($data_id)){

                                                $sql3 = "select * from  tbl_users where user_id='$data_id'";

                                                $result3=$conn->query($sql3);

                                                $arr1 = $result3->fetch_assoc(); 
                                                
                                                $image = $arr1['avatar'];
                                                $gender = $arr1['gender'];
                                                
                                                $data ='
                                                  <tr >
                                                                <td class="text-center text-muted" id='.$mainid.$i.'>'.$arr1['user_id'].'</td>
                                                                <td>
                                                                    <div class="widget-content p-0">
                                                                        <div class="widget-content-wrapper">
                                                                            <div class="widget-content-left mr-3">
                                                                                <div class="widget-content-left">';
                                                                            if ($image == NULL) {
                                                                $data .=' <img class="rounded-circle"  width=40"" src="../assets/images/'.$gender.'.png" alt="'.$fname.'">';
                                                                }else{
                                                                $data .='<img class="rounded-circle" width="40"  src="data:image/jpeg;base64,'.base64_encode($image).'"   alt="'.$fname.'"/>';	
                                                                }
                                    
                                                                         $data.='
                                                                                </div>
                                                                            </div>
                                                                            <div class="widget-content-left flex2">
                                                                                <div class="widget-heading">'.$arr1['first_name']." ".$arr1['last_name'].'



                                                                        </div>
                                                                                <div class="widget-subheading opacity-7">'.$arr1['company_name'].'</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center" >'.$index_count.'</td>
                                                                <td class="text-center">'.$arr1['address'].'</td>
                                                                <td class="text-center">';
                                                                
                                                                    if($arr1['acc_stat'] ==1){
                                                                        $data .= '<div class="badge badge-success" style="cursor:pointer" onclick ="Checkadminstatus('.$i.',0,1)">Active</div>';
                                                                    }
                                                                    else{
                                                                        $data .= '<div class="badge badge-danger"  style="cursor:pointer"onclick ="Checkadminstatus('.$i.',1,1)">Inactive</div>';
                                                                    }
                                                                
                                                        $data .='</td>
                                                                <td class="text-center">
                                                                    <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm"  onclick ="details('.$i.',1)">Details</button>
                                                                </td>
                                                            </tr>';

                                                            echo $data;
                                                            $i++; 
                                       
                                                }
                                             

                                            }
                                           
                                        }







 if(isset($dataid)){
   
    $sql = "select * from tbl_users where role='student'";

    $result = $conn->query($sql);
 
    
    $alldata = array();
  
    while($arr = $result->fetch_assoc()){
        $user_id = $arr['user_id'];
        $sql1 = "select * from tbl_assessment_records where student_id='$user_id'";
        $result2 = $conn->query($sql1);
        $count = $result2->num_rows;
    
          $alldata[$user_id]=$count;
         arsort($alldata);
                                            }
                                            $i=1;
                                        
                                       
                                            foreach($alldata as $x => $x_value) {
                                                if($i>5){
                                                    break;
                                                }
                                                    
                                         
                                                $data_id = $x;
                                                $index_count = $x_value;
                                               
      

    if(!empty($data_id)){

        $sql3 = "select * from  tbl_users where user_id='$data_id'";

        $result3=$conn->query($sql3);

        $arr1 = $result3->fetch_assoc(); 
        $image = $arr1['avatar'];
        $gender = $arr1['gender'];
        
        
  $output ='    
     <tr>
        <td class="text-center text-muted" id="'.$dataid.$i.'">'.$arr1['user_id'].'</td>
        <td class="text-center text-muted">'.$arr1['teacher_id'].'</td>
        <td>
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left mr-3">
                        <div class="widget-content-left">';
                               if ($image == NULL) {
                                                                $output .=' <img class="rounded-circle"  width=40"" src="../assets/images/'.$gender.'.png" alt="'.$fname.'">';
                                                                }else{
                                                                $output .='<img class="rounded-circle" width="40"  src="data:image/jpeg;base64,'.base64_encode($image).'"   alt="'.$fname.'"/>';	
                                                                }
                       $output .= '</div>
                    </div>
                    <div class="widget-content-left flex2">
                        <div class="widget-heading">'.$arr1['first_name']." ".$arr1['last_name'].'




                        </div>
                        <div class="widget-subheading opacity-7">'.$arr1['company_name'].'</div>
                    </div>
                </div>
            </div>
        </td>
        <td class="text-center" id="totalexam<?php  echo $i;?>">'. $index_count.'</td>
        <td class="text-center">'. $arr1['address'].'</td>
        <td class="text-center">';


         
            if($arr1['acc_stat'] ==1){
              $output .= '<div class="badge badge-success" onclick="Checkadminstatus('.$i.',0,0)" style="cursor:pointer">Active</div>';
            }
            else{
                $output .= '<div class="badge badge-danger" onclick="Checkadminstatus('.$i.',1,0)" style="cursor:pointer">Inactive</div>';
            }
        $output .= '
        </td>
        <td class="text-center">
            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" onclick ="details('.$i.',0)">Details</button>
        </td>
    </tr>';
echo $output;

  $i++;
        }
    }
 










}





                                            ?>