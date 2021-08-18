<?php 

include '../database/config.php';
session_start();

$stu_id = htmlentities(mysqli_real_escape_string($conn,$_GET['sid'])) ;
$exam_id = htmlentities(mysqli_real_escape_string($conn,$_GET['eid'])) ;

$sql_checking = "select * from tbl_examinations where exam_id='$exam_id'";

$result_check = $conn->query($sql_checking);

$arr_check = $result_check->fetch_assoc();

if($arr_check['result_status'] == 0 and $arr_check['result_type'] == "manual"){
    header('location:unauthorised.php');
}









?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Kendel | My Results</title>
        
     <meta content="width=device-width, initial-scale=1" name="viewport"/>
           <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
         <meta name="description" content="Trando is providing online examination portal for the coachings, institute and schools. this is a plateform which provide well structured portal in very low cost" />
        <meta name="author" content="Trando Team" />
        <meta name="keywords" content="online-exam,test-series,trando exam,online series,exam,test,test series for exam,examination portal, exam portal which can work for me, trando " />

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
		<link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/images/icon.png" rel="icon">
        <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/snack.css" rel="stylesheet" type="text/css"/>
        <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      
           
<style>
        @media only screen and (max-width:800px){
            .mainrow{
                display: flex;
                flex-direction: column-reverse;
            }
            .mainrow .col-lg-5{

                margin:20px 0px 20px 0px;
            }
           
           
        }
        @media only screen and (max-width:1200px){
           
        .mainrow1{
                 display: flex;
                flex-direction: column-reverse;
            }
            }
        
        

            .tooltiper {
    /* margin-left: 200px; */
  position: relative;
  display: inline-block;
  /* border-bottom: 1px dotted black; */
}

.tooltiper .tooltiptexter {
  visibility: hidden;
  width: 160px;
  background-color: #fff;
  /*color: #fff;*/
  text-align: center;
  border-radius: 8px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  top: 150%;
  left: 50%;
  margin-left: -75px;
  box-shadow:1px 1px 6px -3px #333;
 
}
.tooltiper .tooltiptexter p{
    line-height:10px;
    font-weight:700;
    /*font-size:18px;*/
}

.tooltiper .tooltiptexter::after {
  content: "";
  position: absolute;
  bottom: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent #fff transparent;
}

.tooltiper:hover .tooltiptexter {
  visibility: visible;
}
    
</style>
                  
            </head>
            <body>
            <div class="page-inner">
                <div class="page-title" style="display:flex ;padding-left:50px;">
                    <h3 class="text-center">Responses</h3>
                   
                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
						<div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-white">
                                    <div class="panel-body">

                                          <?php
                                       

                                            if(isset($stu_id) and isset($exam_id)){
                                                
                                                
                                                $exam_sql = "select * from tbl_examinations where exam_id = '$exam_id'";
                                                $result_exam = $conn->query($exam_sql);
                                                $exam_row = $result_exam->fetch_assoc();
                                                if($exam_row['section_name'] != ""){
                                                    
                                                    
                                                      $sec=explode('/', $exam_row['section_name']);
                                                        $i=0;
                                                    foreach($sec as $out) {
                                                                                                     
                                                    if(!empty($out)){
                                                        
                                                        echo'<h1 class="text-center" >'.$out.'</h1>';
                                                    
                                                    
                                                    $sql = "select * from tbl_responses where stu_id='$stu_id' and exam_id='$exam_id'";

                                                    $result = $conn->query($sql);
                                                    $count = $result->num_rows;
                                                    $qno=1;
                                                
                                                  

                                                    while($row = $result->fetch_assoc()){
                                                       
                                                        $question_id = $row['question_id'];
                                                        $stu_response = $row['stu_response'];
                                                        $sql1 = "select * from tbl_questions where question_id = '$question_id' and exam_id='$exam_id' and sec_name='$out' order by id";

                                                        $result1 = $conn->query($sql1);
                                                        
                                                        if($result1->num_rows>0){

                                                        $arr = $result1->fetch_assoc();
                                                        
                                                        $answer = $arr['answer'];
                                                        $answer_val = $arr[$answer];
                                                        $type= $arr['type'];
                                                        $pmarks = $arr['pos_marks'];
                                                        $nmarks = $arr['neg_marks'];
                                                        $question_image = $arr['image'];
                                                        $question_type = $arr['question_type'];
                                                        $par_status=$arr['par_status'];

                                                        // if($qno <=10){

                                                        echo '<div style="padding:15px; box-shadow:1px 1px 6px grey;margin-top:10px" id="qno'.$qno.'">';
                                                        // }
                                                        // else{

                                                        // echo '<div style="padding:15px; box-shadow:1px 1px 6px grey;margin-top:10px ;display:none" id="qno'.$qno.'">';
                                                        //     }

                                                        $show_question = '
                                                        <div class="row mainrow">
                                                        
                                                        <div class="col-lg-11  col-md-11 col-sm-11">
                                                        <p style="color:white"> Q.'.$qno.' ) '.$arr['question'].' </p>
                                                        </div>
                                                         <div class="col-sm-1">
                                                         
                                          
											 <a   class="tooltiper" href="javascript:void(0);"> <span style="color:#fff;font-size:16px;" class="glyphicon glyphicon-question-sign">
											  <span class="tooltiptexter">
                                                  <p   style="color:#1b263b;">Positive Marks: '.$pmarks.'</p>
                                                 <p  style="color:#1b263b;">Negative Marks: '.$nmarks.'</p>
                                                 </span>
											 </a>
                                                       </div>
                                                        </div>
                                                        '; 

                                                        echo "<div class='text-white' style='background:#1b263b;padding:10px 0px 5px 15px;margin-bottom:10px;'>".$show_question."</div>";

                                                      
                                                      
                                                       $show_option = '<div class="container">
                                                        <div class="row mainrow1">
                                                        <div class="col-lg-5  " style="max-width:100%;overflow:auto;">
                                                        ';
                                                        if($question_type == "STQ"){
                                                        for($i=1;$i<=4;$i++){
                                                            $optval = "option".$i;
                                                              $check_image = explode('.',$arr['option'.$i]);
                                           
                                                        $ext = strtolower(end($check_image));
                                           
                                                        if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                               if($answer == $optval){
                                                     $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'" style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                               }else{
                                                                   $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'"  style="border:2px solid red; padding:2px;height:100px;max-width:200px;" > </p>';
                                                               }
                                                             }
                                                             else{
                                                       
                                                
                                                            if($answer == $optval){
                                                                $show_option .= '<p class="text-success">'.$i.' ) '.$arr['option'.$i].'</p> ';
                                                            }
                                                            else{
                                                                 $show_option .= '<p class="text-danger">'.$i.' ) '.$arr['option'.$i].'</p> ';
                                                            }
                                                            
                                                       
                                                          

                                                        }
                                                    }
                                                    $show_option .= '</div>
                                                    <div class="col-lg-7  p-3" style="max-width:100%;overflow:auto;" >';
                                                    if($question_image != ''){
                                                        // fetching image sof question in responses
                                                        $show_option .='<img src="../admin/pages/'.$question_image.'" style="max-width:100%">';
                                                    }
                                                   $show_option .='
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ';
                                                   
                                                    echo  $show_option;
                                                     $check_image = explode('.',$stu_response);
                                       
                                                    $ext = strtolower(end($check_image));
                                       
                                                    if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                          if($stu_response == $answer_val){
                                                 echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'" style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                          }else{
                                                              echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'" style="border:2px solid red;padding:2px;height:100px;max-width:200px;"> </p>'; 
                                                          }
                                                         }
                                                         else{
                                                           if($stu_response == $answer_val){
                                                        echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                    }
                                                    else{
                                                     echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-danger">'.$stu_response.'</p>';
                                                    }



                                                }
                                                        }
                                        else if($question_type == "FQ"){
                                                            //// fill bank questions 
                                                        
                                                    $show_option .= '<p class="text-success">'.$arr['answer'].'</p> ';
                                           
                                                    $show_option .= '</div>
                                                    <div class="col-lg-7  p-3" style="max-width:100%;overflow:auto;" >';
                                                    if($question_image != ''){
                                                        // fetching image sof question in responses
                                                        $show_option .='<img src="../admin/pages/'.$question_image.'" style="max-width:200px">';
                                                    }
                                                   $show_option .='
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ';
                                                   
                                                    echo  $show_option;
                                                         if(!empty($stu_response)){
                                                          $end_range = explode("-",$answer);
                                                               if($end_range[0] != "" and $end_range[1] != ""){
                                                                   if($stu_response>=$end_range[0] and $end_range[1]>=$stu_response){
                                                                           echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                                      }
                                                               
                                                               }else{
                                                                    if(strtolower($stu_response) == strtolower($answer)){
                                                                   echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                                  }
                                                               }
                                                        }             
                                       
                                                
                                                    //       if($stu_response == $answer){
                                                    //     echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                    // }
                                                    else{
                                                     echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-danger">'.$stu_response.'</p>';
                                                    }
                                            
                                                    }   
                                                    /// code for true and false question
                                                    
                                                    else if($question_type == "TQ"){
                                                        $arr_Answer = ['true','false'];
                                                        
                                                         for($i=1;$i<=2;$i++){
                                                             if($answer == "option".$i){
                                                                 $mainanswer = $arr_Answer[$i-1];
                                                             }
                                                            $optval = "option".$i;
                                                              $check_image = explode('.',$arr['option'.$i]);
                                           
                                                        $ext = strtolower(end($check_image));
                                           
                                                        if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                               if($answer == $optval){
                                                     $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'"  style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                               }else{
                                                                   $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'"  style="border:2px solid red; padding:2px;height:100px;max-width:200px;" > </p>';
                                                               }
                                                             }
                                                             else{
                                                       
                                                
                                                            if($answer == $optval){
                                                                $show_option .= '<p class="text-success">'.$i.' ) '.$arr_Answer[$i-1].'</p> ';
                                                            }
                                                            else{
                                                                 $show_option .= '<p class="text-danger">'.$i.' ) '.$arr_Answer[$i-1].'</p> ';
                                                            }
                                                            
                                                       
                                                          

                                                        }
                                                    }
                                                    $show_option .= '</div>
                                                    <div class="col-lg-7  p-3" style="max-width:100%;overflow:auto;" >';
                                                    if($question_image != ''){
                                                        // fetching image sof question in responses
                                                        $show_option .='<img src="../admin/pages/'.$question_image.'" style="max-width:200px;">';
                                                    }
                                                   $show_option .='
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ';
                                                   
                                                    echo  $show_option;
                                                     $check_image = explode('.',$stu_response);
                                       
                                                    $ext = strtolower(end($check_image));
                                       
                                                    if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                          if($stu_response == $answer_val){
                                                 echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'"  style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                          }else{
                                                              echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'" " style="border:2px solid red;padding:2px;height:100px;max-width:200px;"> </p>'; 
                                                          }
                                                         }
                                                         else{
                                                           if($stu_response == $mainanswer){
                                                        echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                    }
                                                    else{
                                                     echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-danger">'.$stu_response.'</p>';
                                                    }



                                                }
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                    }
                                                            
                                                            
                                                        else if($question_type == "MTQ"){
                                                            $data = ['0','0','0','0'];
                                                            $j=6;
                                                          
                                                            while($j<strlen($answer)){
                                                                
                                                                for($i=1;$i<=4;$i++){
                                                                    if($answer[$j] == $i){
                                                                        $data[$i-1] = $answer[$j];
                                                                    }
                                                                }
                                                              
                                                                $j=$j+7;
                                                            }
                                                                    
                                                            /// multiple type questions 
                                                            for($i=1;$i<=4;$i++){
                                                              


                                                                $optval = "option".$i;
                                                                  $check_image = explode('.',$arr['option'.$i]);
                                               
                                                            $ext = strtolower(end($check_image));
                                               
                                                            if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                                   if($answer == $optval){
                                                         $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'"   style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                                   }else{
                                                                       $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'" style="border:2px solid red; padding:2px;height:100px;max-width:200px;" > </p>';
                                                                   }
                                                                 }
                                                                 else{
                                                                   $maindata = "option".$data[$i-1]; 
                                                               
                                                                if($optval == $maindata){
                                                                    $show_option .= '<p class="text-success">'.$i.' ) '.$arr['option'.$i].'</p> ';
                                                                }
                                                                else{
                                                                     $show_option .= '<p class="text-danger">'.$i.' ) '.$arr['option'.$i].'</p> ';
                                                                }
                                                                
                                                           
                                                              
    
                                                            }
                                                        }


                                                        $show_option .= '</div>
                                                        <div class="col-lg-7  p-3" style="max-width:100%;overflow:auto;" >';
                                                        if($question_image != ''){
                                                            // fetching image sof question in responses
                                                            $show_option .='<img src="../admin/pages/'.$question_image.'" style="max-width:100%;">';
                                                        }
                                                       $show_option .='
                                                        </div>
                                                        </div>
                                                        </div>
                                                        ';
                                                       
                                                        echo  $show_option;
                                                         $check_image = explode('.',$stu_response);

                                                         $mul_response = $row['mul_response'];
                                           
                                                        $ext = strtolower(end($check_image));
                                           
                                                        if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                              if($stu_response == $answer_val or ((strpos($answer,$mul_response)  !== false) and $par_status ==1)){
                                                     echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'" style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                              }else{
                                                                  echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'"  style="border:2px solid red;padding:2px;height:100px;max-width:200px;"> </p>'; 
                                                              }
                                                             }
                                                             else{
                                                               if($mul_response == $answer or ((strpos($answer,$mul_response)  !== false) and $par_status ==1)){
                                                            echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                        }
                                                        else{
                                                         echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-danger">'.$stu_response.'</p>';
                                                        }




                                                        }
                                                         
                                                          
                                                          

                                                        }
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                  

                                                        echo '</div>';
                                                        $qno = $qno+1;
                                                    }
                                                

                                                    }


                                                    echo '<input type="hidden" id="total_question" value="'.$qno.'">';
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    }
                                                    }
                                                    
                                                    
                                                }else{

                                    

                                                    $sql = "select * from tbl_responses where stu_id='$stu_id' and exam_id='$exam_id'";

                                                    $result = $conn->query($sql);
                                                    $count = $result->num_rows;
                                                    $qno=1;
                                                
                                                   

                                                    while($row = $result->fetch_assoc()){
                                                       
                                                        $question_id = $row['question_id'];
                                                        $stu_response = $row['stu_response'];
                                                        $sql1 = "select * from tbl_questions where question_id = '$question_id' and exam_id='$exam_id' order by id";

                                                        $result1 = $conn->query($sql1);

                                                        $arr = $result1->fetch_assoc();
                                                        
                                                        $answer = $arr['answer'];
                                                        $answer_val = $arr[$answer];
                                                        $type= $arr['type'];
                                                        $pmarks = $arr['pos_marks'];
                                                        $nmarks = $arr['neg_marks'];
                                                        $question_image = $arr['image'];
                                                        $question_type = $arr['question_type'];
                                                        
                                                        $par_status = $arr['par_status'];

                                                        if($qno <=10){

                                                        echo '<div style="padding:15px; box-shadow:1px 1px 6px grey;margin-top:10px" id="qno'.$qno.'">';
                                                        }
                                                        else{

                                                        echo '<div style="padding:15px; box-shadow:1px 1px 6px grey;margin-top:10px ;display:none" id="qno'.$qno.'">';
                                                            }

                                                        $show_question = '
                                                        <div class="row mainrow">
                                                        <div class="col-lg-11  col-md-11 col-sm-11">
                                                        <p style="color:white"> Q.'.$qno.' ) '.$arr['question'].' </p>
                                                        </div>
                                                         <div class="col-sm-1">
                                                         
                                          
											 <a   class="tooltiper" href="javascript:void(0);"> <span style="color:#fff;font-size:16px;" class="glyphicon glyphicon-question-sign">
											  <span class="tooltiptexter">
                                                  <p   style="color:#1b263b;">Positive Marks: '.$pmarks.'</p>
                                                 <p  style="color:#1b263b;">Negative Marks: '.$nmarks.'</p>
                                                 </span>
											 </a>
                                                       </div>
                                                        </div>
                                                        '; 

                                                        echo "<div class='text-white' style='background:#1b263b;padding:10px 0px 5px 15px;margin-bottom:10px;'>".$show_question."</div>";

                                                        // if($type == "MC"){
                                                      
                                                       $show_option = '<div class="container">
                                                        <div class="row mainrow1">
                                                        <div class="col-lg-5  " style="max-width:100%;overflow:auto;">
                                                        ';
                                                        if($question_type == "STQ"){
                                                        for($i=1;$i<=4;$i++){
                                                            $optval = "option".$i;
                                                              $check_image = explode('.',$arr['option'.$i]);
                                           
                                                        $ext = strtolower(end($check_image));
                                           
                                                        if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                               if($answer == $optval){
                                                     $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'" style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                               }else{
                                                                   $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'"  style="border:2px solid red; padding:2px;height:100px;max-width:200px;" > </p>';
                                                               }
                                                             }
                                                             else{
                                                       
                                                
                                                            if($answer == $optval){
                                                                $show_option .= '<p class="text-success">'.$i.' ) '.$arr['option'.$i].'</p> ';
                                                            }
                                                            else{
                                                                 $show_option .= '<p class="text-danger">'.$i.' ) '.$arr['option'.$i].'</p> ';
                                                            }
                                                            
                                                       
                                                          

                                                        }
                                                    }
                                                    $show_option .= '</div>
                                                    <div class="col-lg-7  p-3" style="max-width:100%;overflow:auto;" >';
                                                    if($question_image != ''){
                                                        // fetching image sof question in responses
                                                        $show_option .='<img src="../admin/pages/'.$question_image.'" style="max-width:100%">';
                                                    }
                                                   $show_option .='
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ';
                                                   
                                                    echo  $show_option;
                                                     $check_image = explode('.',$stu_response);
                                       
                                                    $ext = strtolower(end($check_image));
                                       
                                                    if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                          if($stu_response == $answer_val){
                                                 echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'" style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                          }else{
                                                              echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'" style="border:2px solid red;padding:2px;height:100px;max-width:200px;"> </p>'; 
                                                          }
                                                         }
                                                         else{
                                                           if($stu_response == $answer_val){
                                                        echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                    }
                                                    else{
                                                     echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-danger">'.$stu_response.'</p>';
                                                    }



                                                }
                                                        }
                                        else if($question_type == "FQ"){
                                                            //// fill bank questions 
                                                        
                                                    $show_option .= '<p class="text-success">'.$arr['answer'].'</p> ';
                                           
                                                    $show_option .= '</div>
                                                    <div class="col-lg-7  p-3" style="max-width:100%;overflow:auto;" >';
                                                    if($question_image != ''){
                                                        // fetching image sof question in responses
                                                        $show_option .='<img src="../admin/pages/'.$question_image.'" style="max-width:200px">';
                                                    }
                                                   $show_option .='
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ';
                                                   
                                                    echo  $show_option;
                                                      if(!empty($stu_response)){
                                                          $end_range = explode("-",$answer);
                                                               if($end_range[0] != "" and $end_range[1] != ""){
                                                                   if($stu_response>=$end_range[0] and $end_range[1]>=$stu_response){
                                                                           echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                                      }
                                                               
                                                               }else{
                                                                    if(strtolower($stu_response) == strtolower($answer)){
                                                                   echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                                  }
                                                               }
                                                        }  
                                       
                                                
                                                    //       if($stu_response == $answer){
                                                    //     echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                    // }
                                                    else{
                                                     echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-danger">'.$stu_response.'</p>';
                                                    }
                                            
                                                    }   
                                                    /// code for true and false question
                                                    
                                                    else if($question_type == "TQ"){
                                                        $arr_Answer = ['true','false'];
                                                        
                                                         for($i=1;$i<=2;$i++){
                                                             if($answer == "option".$i){
                                                                 $mainanswer = $arr_Answer[$i-1];
                                                             }
                                                            $optval = "option".$i;
                                                              $check_image = explode('.',$arr['option'.$i]);
                                           
                                                        $ext = strtolower(end($check_image));
                                           
                                                        if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                               if($answer == $optval){
                                                     $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'"  style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                               }else{
                                                                   $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'"  style="border:2px solid red; padding:2px;height:100px;max-width:200px;" > </p>';
                                                               }
                                                             }
                                                             else{
                                                       
                                                
                                                            if($answer == $optval){
                                                                $show_option .= '<p class="text-success">'.$i.' ) '.$arr_Answer[$i-1].'</p> ';
                                                            }
                                                            else{
                                                                 $show_option .= '<p class="text-danger">'.$i.' ) '.$arr_Answer[$i-1].'</p> ';
                                                            }
                                                            
                                                       
                                                          

                                                        }
                                                    }
                                                    $show_option .= '</div>
                                                    <div class="col-lg-7  p-3" style="max-width:100%;overflow:auto;" >';
                                                    if($question_image != ''){
                                                        // fetching image sof question in responses
                                                        $show_option .='<img src="../admin/pages/'.$question_image.'" style="max-width:200px;">';
                                                    }
                                                   $show_option .='
                                                    </div>
                                                    </div>
                                                    </div>
                                                    ';
                                                   
                                                    echo  $show_option;
                                                     $check_image = explode('.',$stu_response);
                                       
                                                    $ext = strtolower(end($check_image));
                                       
                                                    if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                          if($stu_response == $answer_val){
                                                 echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'"  style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                          }else{
                                                              echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'" " style="border:2px solid red;padding:2px;height:100px;max-width:200px;"> </p>'; 
                                                          }
                                                         }
                                                         else{
                                                           if($stu_response == $mainanswer){
                                                        echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                    }
                                                    else{
                                                     echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-danger">'.$stu_response.'</p>';
                                                    }



                                                }
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                    }
                                                            
                                                            
                                                        else if($question_type == "MTQ"){
                                                            $data = ['0','0','0','0'];
                                                            $j=6;
                                                          
                                                            while($j<strlen($answer)){
                                                                
                                                                for($i=1;$i<=4;$i++){
                                                                    if($answer[$j] == $i){
                                                                        $data[$i-1] = $answer[$j];
                                                                    }
                                                                }
                                                              
                                                                $j=$j+7;
                                                            }
                                                                    
                                                            /// multiple type questions 
                                                            for($i=1;$i<=4;$i++){
                                                              


                                                                $optval = "option".$i;
                                                                  $check_image = explode('.',$arr['option'.$i]);
                                               
                                                            $ext = strtolower(end($check_image));
                                               
                                                            if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                                   if($answer == $optval){
                                                         $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'"   style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                                   }else{
                                                                       $show_option .= '<p class="">'.$i.' ) <img src = "../admin/pages/Upload/'.$arr["option".$i].'" style="border:2px solid red; padding:2px;height:100px;max-width:200px;" > </p>';
                                                                   }
                                                                 }
                                                                 else{
                                                                   $maindata = "option".$data[$i-1]; 
                                                               
                                                                if($optval == $maindata){
                                                                    $show_option .= '<p class="text-success">'.$i.' ) '.$arr['option'.$i].'</p> ';
                                                                }
                                                                else{
                                                                     $show_option .= '<p class="text-danger">'.$i.' ) '.$arr['option'.$i].'</p> ';
                                                                }
                                                                
                                                           
                                                              
    
                                                            }
                                                        }


                                                        $show_option .= '</div>
                                                        <div class="col-lg-7  p-3" style="max-width:100%;overflow:auto;" >';
                                                        if($question_image != ''){
                                                            // fetching image sof question in responses
                                                            $show_option .='<img src="../admin/pages/'.$question_image.'" style="max-width:100%;">';
                                                        }
                                                       $show_option .='
                                                        </div>
                                                        </div>
                                                        </div>
                                                        ';
                                                       
                                                        echo  $show_option;
                                                         $check_image = explode('.',$stu_response);

                                                         $mul_response = $row['mul_response'];
                                           
                                                        $ext = strtolower(end($check_image));
                                           
                                                        if($ext == "jpeg" or $ext == "jpg" or $ext == "png"){
                                                              if($stu_response == $answer_val or ((strpos($answer,$mul_response)  !== false) and $par_status ==1)){
                                                     echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'" style="border:2px solid green;padding:2px;height:100px;max-width:200px;"> </p>';
                                                              }else{
                                                                  echo '<p class="" style="font-size:16px">Your Response :<img src = "../admin/pages/Upload/'.$stu_response.'"  style="border:2px solid red;padding:2px;height:100px;max-width:200px;"> </p>'; 
                                                              }
                                                             }
                                                             else{
                                                               if($mul_response == $answer or ((strpos($answer,$mul_response)  !== false) and $par_status ==1)){
                                                            echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-success ">'.$stu_response.'</p>';
                                                        }
                                                        else{
                                                         echo '<div class="" style="font-size:16px">Your Response :</div> <p class="text-danger">'.$stu_response.'</p>';
                                                        }




                                                        }
                                                         
                                                          
                                                          

                                                        }
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                  

                                                        echo '</div>';
                                                        $qno = $qno+1;
                                                

                                                    }


                                                    echo '<input type="hidden" id="total_question" value="'.$qno.'">';
                                                    
                                                }



                                            }
                                           
                                            
                                            ?>
                                            
                                          
                                       
                                    </div>
                                </div>  
  
                            </div>
                        </div>


                        </div>
                    </div>
                </div>
                
            </div>
        </main>
		<?php if ($ms == "1") {
?> <div class="alert alert-success" id="snackbar"><?php echo "$description"; ?></div> <?php	
}else{
	
}
?>

        <div class="cd-overlay"></div>

        <script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="../assets/plugins/pace-master/pace.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="../assets/plugins/waves/waves.min.js"></script>
        <script src="../assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="../assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="../assets/plugins/moment/moment.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="../assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="../assets/js/modern.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
		<script src="../assets/plugins/select2/js/select2.min.js"></script>
		

		<script>
 
    function showresponses(show_val){
        var v = document.getElementById("total_question").value;

        for(var i=1;i<v;i++){
            if(show_val >= i){
                document.getElementById("qno"+i).style.display="block";
            }
            else{
                document.getElementById("qno"+i).style.display="none";
            }
        }
        
        if(show_val < v-1 ){
            document.getElementById("msg").innerHTML="<h3><b>Note:</b> Their Are More Response. Please Go On Top And Change The Show Response Value </h3>";
        }
        else if(show_val == "All"){
            document.getElementById("msg").innerHTML="";
            for(var i=1;i<v;i++){
                document.getElementById("qno"+i).style.display="block";
            }
        }
        else{
            document.getElementById("msg").innerHTML="";
        }
        
    }




function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>