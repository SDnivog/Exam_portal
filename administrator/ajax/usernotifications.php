<?php
include '../../database/config.php';

extract($_POST);


if(isset($_POST['mainid'])){
   
    $sql = "select * from tbl_users where role='$mainid' and acc_stat=0";

    $result = $conn->query($sql);
    $output ='';
    $i=1;
   
    while($arr = $result->fetch_assoc()){
 
     $output .= '<tr onclick="openpayment('.$i.')">
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
                        '</div></div>
                </div>
            </div>
        </td>
        <td class="text-center">'. $arr['email'].'</td>
        <td class="text-center">'. $arr['phone'].'</td>
        <td class="text-center">'. $arr['address'].'</td>
        <td class="text-center">';
           
            if($arr['acc_stat'] ==1){
                $output .= '<div class="badge badge-success">Active</div>';
            }
            else{
                $output .= '<div class="badge badge-danger">Inactive</div>';
            }
            
       $output .= '
       
       <td class="text-center">'. $arr['company_name'].'</td>
       </td>
      
    </tr>';

    $i++;

   


  

}


echo $output;



    }


    if(isset($maindata)){
        $sql = "select * from tbl_users where acc_stat = 0 and role='Admin'";

        $result = $conn->query($sql);

        echo $result->num_rows;

    }










?>

