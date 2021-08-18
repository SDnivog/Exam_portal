<?php
include '../../database/config.php';

extract($_POST);


if(isset($_POST['mainid'])){
    
    $sql = "select * from tbl_users where role='$mainid'";

    $result = $conn->query($sql);
    $output ='';
    $i=1;
   
    while($arr = $result->fetch_assoc()){
 
     $output .= '<tr>
        <td class="text-center text-muted" id="'.$mainid.$i.'">'.$arr['user_id'].'</td>
        <td>
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left mr-3">
                        <div class="widget-content-left">
                            <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                        </div>
                    </div>
                    <div class="widget-content-left flex2">
                        <div class="widget-heading">'.$arr['first_name']." ".$arr['last_name'].




                        '</div>';

                        if($mainid == 'student'){
                            $teacher_id = $arr['teacher_id'];
                            $sql1 = "select * from tbl_users where user_id='$teacher_id'";
                            $result1=$conn->query($sql1);
                            $row = $result1->fetch_assoc();
                            $company = $row['company_name'];
                            $output .= '<div class="widget-subheading opacity-7">'. $company.'</div>';
                        }
                        else{
                            $output .= '<div class="widget-subheading opacity-7">'. $arr['company_name'].'</div>';
                        }

                        
                  $output .=  '</div>
                </div>
            </div>
        </td>
        <td class="text-center">'. $arr['address'].'</td>
        <td class="text-center">';
           
            if($arr['acc_stat'] ==1){
                $output .= '<div class="badge badge-success" onclick="Checkadminstatus('.$i.',0)" style="cursor:pointer">Active</div>';
            }
            else{
                $output .= '<div class="badge badge-danger" onclick="Checkadminstatus('.$i.',1)" style="cursor:pointer">Inactive</div>';
            }
            
       $output .= '</td>
        <td class="text-center">';

        if($mainid =="student"){
            $output .='<button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" onclick="details('.$i.',0)">Details</button>';
        }
        else{
            $output .='
            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" onclick="details('.$i.',1)">Details</button>';
        }
        $output .='
        </td>
    </tr>';

    $i++;

   


  

}


echo $output;

    }










?>