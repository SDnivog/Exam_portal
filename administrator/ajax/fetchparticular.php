
<?php

include '../../database/config.php';
extract($_POST);





if(isset($data_id) and isset($whois)){
    // function fetching for total department ,category.subject ,etc
    function check($val,$id){
        include '../../database/config.php';
        $sql1 = "select * from tbl_$val where user_id='$id'";
     
        $result1=$conn->query($sql1);
        $count = $result1->num_rows;
        return $count;
        
    }

    // function fetching how match student given exam

    function totalexamstudent($id){
        include '../../database/config.php';
        $sql = "select * from tbl_examinations where user_id='$id'";
        $result = $conn->query($sql);
        $count=0;

        while($row = $result->fetch_assoc()){
            $exam_id=$row['exam_id'];
            $sql1= "select * from tbl_assessment_records where exam_id='$exam_id'";
            $result1=$conn->query($sql1);
            while($row1 = $result1->fetch_assoc()){
                $count++;
            }


        }
        return $count;
        
    }

    //function fetching all the students 

    function checkstudent($id){
        include '../../database/config.php';
        $sql = "select * from tbl_users where teacher_id='$id'";
        $result=$conn->query($sql);
        return $result->num_rows;
    }



    //// function for fetching all departments ,category and  subject ,exam of admin



    function fetchtable($name,$id,$idval){
        include '../../database/config.php';
        if($name == "users"){
            $entity = "teacher_id";
        }else{
            $entity = "user_id";
        }

        $sql3 = "select * from tbl_$name where $entity='$id'";

        $result3 = $conn->query($sql3);

      
        
        $style = "display:none";
        $data_name = "name";
        $date = "date_registered";
        if($name == "departments"){
            $user_id = "department_id";
            $style = "display:block";

        }
        else if($name == "categories"){
            $user_id = "category_id";
            
        }
        else if($name=="subjects"){
            $user_id = "subject_id";
        }
        else if($name =="examinations"){
            $user_id = "exam_id";
            $data_name = "exam_name";
            $date = "date";
        }


        if($name == "users"){
            $user_id = "user_id";
            $value .=' <div class="table-responsive" id="data'.$idval.'" style="'.$style.'">
            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                   <thead>
                                                   <tr>
                                                        <th class="text-center">Student Id</th>
                                                       <th class="text-center">Student  Name</th>
                                                       <th class="text-center">Student  Email</th>
                                                       <th class="text-center">Department</th>
                                                       <th class="text-center">Category</th>
                                                       <th class="text-center"> Status</th>
                                                   </tr>
                                                   </thead>
                                                  
                                                   <tbody class="tablebody">';
            
        }else{

        $value .=' <div class="table-responsive" id="data'.$idval.'" style="'.$style.'">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                               <thead>
                                               <tr>
                                                    <th class="text-center">'.$name.' Id</th>
                                                   <th class="text-center">'.$name.' Name</th>
                                                   <th class="text-center">Registered Date</th>
                                                   <th class="text-center"> Status</th>
                                               </tr>
                                               </thead>
                                              
                                               <tbody class="tablebody">';
        }
  
        if($result3->num_rows>0){   
            $i=1;                           
                                            
        while($arr= $result3->fetch_assoc()){

            if($name == "users"){
                $value .='<tr>
                <td class="text-center text-muted">'.$arr[$user_id].'</td>
                <td>
                    <div class="widget-heading text-center">'.$arr['first_name'].$arr['last_name'].'</div>
                 
                </td>
                <td class="text-center">'. $arr['email'].'</td>
                <td class="text-center">'. $arr['department'].'</td>
                <td class="text-center">'. $arr['category'].'</td>
                <td class="text-center">';
                   
                    if($arr['acc_stat'] =="1"){
                        $value .= '<div class="badge badge-success" onclick="Checkadminstatus('.$i.',0)" style="cursor:pointer">Active</div>';
                    }
                    else{
                        $value .= '<div class="badge badge-danger" onclick="Checkadminstatus('.$i.',1)" style="cursor:pointer">Inactive</div>';
                    }
                    
               $value .= '</td>
                <td class="text-center">
                </td>
            </tr>';

            }else{


            $value .='<tr>
            <td class="text-center text-muted">'.$arr[$user_id].'</td>
            <td>
                <div class="widget-heading text-center">'.$arr[$data_name].'</div>
             
            </td>
            <td class="text-center">'. $arr[$date].'</td>
            <td class="text-center">';
               
                if($arr['status'] =="Active"){
                    $value .= '<div class="badge badge-success" onclick="Checkadminstatus('.$i.',0)" style="cursor:pointer">Active</div>';
                }
                else{
                    $value .= '<div class="badge badge-danger" onclick="Checkadminstatus('.$i.',1)" style="cursor:pointer">Inactive</div>';
                }
                
           $value .= '</td>
            <td class="text-center">
            </td>
        </tr>';
            }
                $i++;

        }

       
    }
    else{
        $value .= '<tr class="text-center"><td >
            <h4 class="text-center">No Record Found</h4>
            </td>
                </tr>
        ';
    }

    $value .=' </tbody>
    </table>
</div>';



    return $value;


    }





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

      
$output ='<div class="app-main__inner">

                        <div class="row">
                            <div class="col-md-12 col-xl-12">

                            <div class="card bg-midnight-bloom text-white">
                                <div class="content">
                                    <h2 class="text-center" style="border-bottom:1px solid white">Admin Details</h2>
                                    <div class="row">
                                    <div class="col-md-6 col-xl-6 text-center">
                                            <h4 >Admin Id :  '.$data_id.' </h4>  
                                            <h4>Admin Name : '.$fname." ".$lname.'</h4>
                                            <h4 class="">Gender :  '.$gender.' </h4> 
                                            <h4 class=""> Address :  '.$address.' </h4> 
                                            <h4 class="">Email :  '.$email.' </h4> 
                                            <h4 class="">Phone No :  '.$phone.' </h4> 
                                            <h4 class="">Company Name :  '.$company.' </h4> 


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
                                            <div class="widget-heading">Total Department</div>
                                            <div class="widget-subheading">
                                                Last default Days Department Create By Admin 
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>'.
                                        check("departments",$data_id).'</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Category</div>
                                            <div class="widget-subheading">Last 10 Days category Created By Admin</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>'.check("categories",$data_id).'</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Subject</div>
                                            <div class="widget-subheading">Last 10 Days Subjects Created By Amdin</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>'.check("subjects",$data_id).'</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                    </div>                 
                       
                    <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Exam </div>
                                                <div class="widget-subheading">Last 10 Days Exam Created By Admin</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-warning">'.
                                                  
                                                check("examinations",$data_id)
                                               .'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Student</div>
                                                <div class="widget-subheading">Last 10 Days Student</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-success">'.
                                               
                                                checkstudent($data_id)


                                               .' </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                            <div class="widget-heading">Total Studetnt Given Exam</div>
                                                <div class="widget-subheading">Last 10 Days student Given Exam</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-danger">
                                            '.totalexamstudent($id).'
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                  

                <div class="row" style="margin-bottom:100px;">
                    <div class="col-md-12 col-xl-12 bg-white">
                        <div class="maincontent">
                            <div class="mt-2">
                                <ul class="d-flex">
                                    <li class="bg-white text-dark" id="link1" onclick="show(1)">Departments</li>
                                    <li id="link2" onclick="show(2)">Categories</li>
                                    <li id="link3" onclick="show(3)">Sujects</li>
                                    <li id="link4" onclick="show(4)">Exams</li>
                                    <li id="link5" onclick="show(5)">Students</li>
                                <ul>
                            </div>
                            <div class="content mb-4">
                            '.fetchtable("departments",$data_id,'1').'
                            '.fetchtable("categories",$data_id,'2').'
                            '.fetchtable("subjects",$data_id,'3').'
                            '.fetchtable("examinations",$data_id,'4').'
                            '.fetchtable("users",$data_id,'5').'
                            </div>

                  
                        </div>
                    
                    
                    </div>
                </div>
            
    </div>';

echo $output;

}






?>