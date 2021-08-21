<?php 
include '../admin/includes/check_user.php'; 
include '../admin/includes/check_reply.php';
include '../database/config.php';
?>

<?php $exam_Id = $_GET['exam_id']; ?>
<?php $user_Id = $_GET['user_id']; ?>

<?php

if(!isset($exam_Id) && !isset($user_Id)){
    header('Location:../admin/examinations.php');
}

?>
<?php $Company = $_SESSION['company_name']; ?>
<?php

require('vendor/autoload.php');

$res = mysqli_query($conn, "select * from  tbl_examinations where exam_id='$exam_Id'
and user_id='$user_Id'");
if(mysqli_num_rows($res)>0){

    while($row=mysqli_fetch_assoc($res)){
        $duration = $row['duration'];
        $category = $row['category'];
        $subject = $row['subject'];
        $exam_name = $row['exam_name'];
        $date = $row['date'];
        $cutoff_marks = $row['cutoff_marks'];
    }
}  

$res = mysqli_query($conn, "select * from  tbl_departments where user_id='$user_Id'");
if(mysqli_num_rows($res)>0){

    while($row=mysqli_fetch_assoc($res)){
        $department = $row['name'];
    }
} 


$res = mysqli_query($conn, "select * from tbl_questions where exam_id='$exam_Id'
and user_id='$user_Id'");
if($total=mysqli_num_rows($res)>0){
    echo $total;
}

$res = mysqli_query($conn, "select * from tbl_questions where exam_id='$exam_Id'
and user_id='$user_Id'");
if(mysqli_num_rows($res)>0){

    
    $html ='<head>';

    $html .= '<style>
    h4,p{
        font-weight: bold;
        text-align: center;
    }
    #one li{
        border: 1px solid #000;
        margin-right: 10px;
    }
  
    #two li{
        font-size: 13px;
        font-weight: bold;
    }
    #three li{
        font-size: 15px;
        font-weight: 500;
    }
    .question{
        margin-bottom: 35px;
        border-bottom: 1px dotted grey;
    }
    .question h3{
        font-size: 18px;
    }


</style>';
    $html .='</head>';
    $html .='<body>';
    $html .='<div class="container">
    <div class="row mt-2">
        
        <div class="col-md-7" style="max-height: 60px;border: 1px solid #000;">
        <img src="http://trando.in/img/logo.png" alt="" style="width:100%; max-height: 60px;margin-left:250px;"> 
            <p>(Academic Session : 2021 - 2022)</p>
        </div>
        <div class="col-md-2 ml-1" style="border: 1px solid #000;text-align: center;max-height: 60px;float: right;">
           <ul style="list-style-type: none;font-size: 11px;font-weight: bold;" id="one">
               <li>'.$category.'</li>
               <li>MINOR TEST #01 </li>
               <li style="background-color: #000;color: #fff;">'.$date.'</li>
           </ul>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <h4 style="border:1px solid #000;text-align: center; background-color: #000;color: #fff;" class="py-1">'.$category.' : TEST SERIES </h4>
            

        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="margin-left: 280px;">
            <h4 style="border:1px solid #000;border-radius:10px; text-align: center;" class="py-1">Test Type : Unit Test # 01</h4>

        </div>
    </div>

   


</div>';

$html .=' <div class="container">
<div class="row mt-2">
    <div class="col-md-8">
        <ol id="two">
           
            <li>Do not open this Test Booklet until you are asked to do so.</li>
            <li>Read carefully the Instructions on the Back Cover of this Test Booklet.</li>

        </ol>
    </div>
    <div class="col-md-4" style="border: 1px solid #000; max-height: 50px;">
        <table>
            <tr>
                <th>Paper : &nbsp;&nbsp; </th>
                <th>'.$subject.'</th>
            </tr>
        </table>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-11 ml-5" style="border: 1px solid #000; border-radius: 10px;">
        <ol style="text-align: justify;" id="three">
            <li> Immediately fill in the form number on this page of the
                Test Booklet with Blue/Black Ball Point Pen. Use of pencil
                is strictly prohibited.</li>
            <li>The candidates should not write their Form Number
                anywhere else (except in the specified space) on the Test
                Booklet/Answer Sheet.</li>
            <li>The test is of '.$duration.' mins duration.</li>
            <li>The Test Booklet consists of '.$total.' questions. The maximum
                marks are 360.</li>
            <li>One Fourth mark will be deducted for indicated incorrect
                response of each question. No deduction from the total
                score will be made if no response is indicated for an item
                in the Answer Sheet.</li>
            <li>Use Blue/Black Ball Point Pen only for writting
                particulars/marking responses on Side–1 and Side–2 of the
                Answer Sheet. Use of pencil is strictly prohibited.</li>
            <li>No candidate is allowed to carry any textual material,
                printed or written, bits of papers, mobile phone any
                electronic device etc, except the Identity Card inside the
                examination hall/room.</li>
            <li>Rough work is to be done on the space provided for this
                purpose in the Test Booklet only.</li>
            <li>On completion of the test, the candidate must hand over
                the Answer Sheet to the invigilator on duty in the Room/
                Hall. However, the candidate are allowed to take away
                this Test Booklet with them.</li>   
            <li>Do not fold or make any stray marks on the Answer Sheet.</li>     
           
        </ol>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <table class="table ">
            <thead>
              <tr>
                <th >Name of the Candidate (in Capitals) : </th>
                <td>________________________________________________________________________</td>

               
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Roll No : </th>
                  <td>________________________________________________________________________</td>

             
              </tr>
              <tr>
                <th scope="row">Centre of Examination (in Capitals) : </th>
                  <td>________________________________________________________________________</td>

               
              </tr>
              <tr>
                <th>Candidate’s Signature : </th>
                  <td>________________________________________________________________________</td>

              </tr>
              <tr>
                  <th>Invigilator’s Signature : </th>
                  <td>________________________________________________________________________</td>
              </tr>
            </tbody>
          </table>
    </div>
</div>

</div>

<div class="container">
<div class="row">
    <div class="col-md-12">
        <h4 style="border:1px solid #000;text-align: center; background-color: #000;color: #fff;" class="py-1">Your Target is to secure Good Rank in '.$department.' 2021</h4>
    </div>
</div>
</div> <hr>';

$html .='<div class="container mt-2">
<div class="row">
    <div class="col-md-12">
        <h4 style="text-align: center; " class="py-1">'.$Company.'</h4>

        <h5 style="border:1px solid #000;text-align: center; background-color: #000;color: #fff;" class="py-1">TOPIC : '.$subject.'.</h5>
    </div>
</div>
</div>';

$html .='<div class="container" style="padding: 30px 20px;">
<div class="row">';
$sno =0;
while($row=mysqli_fetch_assoc($res)){
    $Image = $row['image'];
    $sno++;
    $html .='<div class="col-md-6 border-right px-3">
    <main class="question">
        <p style="font-size:15px;"><strong>Q. '.$sno.' </strong>'.$row['question'].'</p>
        <img src="../admin/pages/'.$Image.'" alt="Image is here" style="width: 100%;max-height:250px; "> <br><br>
       <label for="checkbox" style="margin-right: 5px;">  <input type="checkbox" style="20px;" > <span style="font-size:20px;"> '.$row['option1'].' </span>  </label> 
       <label for="checkbox" style="margin-right: 5px;">  <input type="checkbox"> <span style="font-size:12px;"> '.$row['option2'].' </span> </label> 
       <label for="checkbox" style="margin-right: 5px;">  <input type="checkbox"> <span style="font-size:12px;"> '.$row['option3'].' </span> </label> 
       <label for="checkbox" style="margin-right: 5px;">  <input type="checkbox">  <span style="font-size:12px;"> '.$row['option4'].' </span> </label> 
     </main>
</div>';
}

$html .='</div>
</div><hr>';
$html .='<div class="container">
<div class="row">
    <div class="col-md-12">
        <h4 style="border:1px solid #000;text-align: center; background-color: #000;color: #fff;" class="py-1">Use this page for rough work </h4>
    </div>
</div>
</div> <hr>';
$html .='<body>';

}
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = time().'.pdf';
$mpdf->output($file,'I');




?>