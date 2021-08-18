<?php
include '../../database/config.php';
extract($_POST);


if(isset($data_id) and isset($whois)){

        

    $sql ="select * from tbl_users where user_id='$data_id'";

    $result=$conn->query($sql);

   $row = $result->fetch_assoc();
        $fname = $row['first_name'];
        $lname = $row['last_name'];  
        $gender = $row['gender'];
        $address = $row['address'];
        $email = $row['email'];
        $phone = $row['phone'];
        $company = $row['company_name'];
        $image = $row['avatar'];
        $teacher_id = $row['teacher_id'];

        $sql1 = "select * from tbl_users  where user_id='$teacher_id'";

        $result1=$conn->query($sql1);

        $arr = $result1->fetch_assoc();



        $sql2 = "select * from  tbl_assessment_records where student_id='$data_id'";

        $result2=$conn->query($sql2);

          
$output ='<div class="app-main__inner">

                        <div class="row">
                            <div class="col-md-12 col-xl-12">

                            <div class="card bg-midnight-bloom text-white">
                                <div class="content">
                                    <h2 class="text-center" style="border-bottom:1px solid white">Student Details</h2>
                                    <div class="row">
                                    <div class="col-md-6 col-xl-6 text-center">
                                            <h4 >Student Id :  '.$data_id.' </h4>  
                                            <h4>Student Name : '.$fname." ".$lname.'</h4>
                                            <h4 class="">Gender :  '.$gender.' </h4> 
                                            <h4 class=""> Address :  '.$address.' </h4> 
                                            <h4 class="">Email :  '.$email.' </h4> 
                                            <h4 class="">Phone No :  '.$phone.' </h4> 
                                            <h4 class=""> Teacher Company Name :  '.$arr['company_name'].' </h4> 


                                    </div>
                                    <div class="col-md-6 col-xl-6">';
                                    if ($image == NULL) {
                                        $output .=' <img class="img-circle avatar"  width=60%" height="60%" style="padding:10px" src="../assets/images/'.$gender.'.png" alt="'.$fname.'">';
                                        }else{
                                        $output .='<img width="100%" height="100%" src="data:image/jpeg;base64,'.base64_encode($image).'" style="padding:10px" class="img-circle avatar"  alt="'.$fname.'"/>';	
                                        }
                                    
                                    
                                   $output .=' </div>
                                    
                                    </div>
                                 

                                </div>
                            </div>
                                
                          </div>   
                        

                        </div>
                        <br><br>
                    <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Teacher Id </div>
                                         
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>'.$teacher_id.'</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Teacher Name</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>'.$arr['first_name']." ".$arr['last_name'].'</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Exam Given</div>
                                        
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>'.$result2->num_rows.'</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                    </div>';




                        echo $output;
                  





    
}






?>