<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';
?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Kendel | Manage Examinations</title>
        <style>
.Modal{
    position:fixed;
    top:0%;
    left:0%;
    z-index:999;
    display:none;
    width:100%;
    height:100%

    
}
.Modal1{
    position:relative;
    display:flex;
    justify-content:center;
    align-items:center;
    
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
}

.Modal form{
    position:relative;
    
    width:30%;
    background:white;
    padding:50px;
    /* transform:translate(-50%,-50%); */
    border-radius:10px;

}

.Modal form h4{
    text-align:center;
}

.question_area{
    width:350px;
}

@media screen and (max-width:1000px){
    .Modal form{
    width:80%;
    overflow-y:auto;
  
}
.question_area{
    width:100%;
}

}
@media screen and (max-width:995px){

.question_area{
    width:280px;
}


}
@media screen and (max-width:595px){

.question_area{
    width:100%;
}

}


            
        </style>
   <?php include("header.php")?>
                    <ul class="menu accordion-menu">
                        <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Streams</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Classes</p></a></li>
                        <!--<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                           <!--<li><a href="liveclass.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Live Class</p></a></li>-->
                        <li class="active"><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!--<li ><a href="assignment.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Assignments</p></a></li>-->
                        <!--<li ><a href="material.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Notes</p></p></a></li>-->
                        <li ><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <!--<li ><a href="doubts.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Doubts</p></a></li>-->
                        
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
        

                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Manage Examinations</h3>



                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
						<div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <div role="tabpanel">
                                   
                                            <ul class="nav nav-tabs" role="tablist">
			
                                                <li role="presentation" class="active"><a href="#tab5" role="tab" data-toggle="tab">Examinations</a></li>
                                                <?php
                                                    // $sql5 = "select * from tbl_examinations where user_id='$login_user_id'";
                                                    // $result5= $conn->query($sql5);
                                                    // if($plan == "Free"){
                                                      
                                                    //     if($result5->num_rows>0){
                                                            
                                                    //     }
                                                    //     else{
                                                            
                                                    //         echo '<li role="presentation"><a href="#tab6" role="tab" data-toggle="tab">Add Exam</a></li>';
                                                    //     }

                                                    // }
                                                    // else{
                                                        echo '<li role="presentation"><a href="#tab6" role="tab" data-toggle="tab">Add Exam</a></li>';
                                             
                                                            // }

                                                ?>									
												
						

                                            </ul>
                                    
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active fade in" id="tab5">
                                           <div class="table-responsive">
										   <?php
										   include '../database/config.php';
										   $sql = "SELECT * FROM tbl_examinations  where  user_id='$login_user_id' ORDER BY edate desc ";
                                           $result = $conn->query($sql);
                                             $count_exam = $result->num_rows;

                                           if ($result->num_rows > 0) {
                                                print '<input type="hidden" id="total_questions" value="'.  $count_exam.'">';
										print '
										<table id="example" class="display table" style="width: 100%; cellspacing: 0;" >
                                        <thead>
                                            <tr>
                                                 <th>Sr.No</th>
                                                <th>Name</th>
                                                <th>Class</th>
												<th>Section Names</th>
													<th>Exam  Time</th>
												<th>Exam Type</th>
                                                <th>Deadline</th>
                                              
                                                <th>Download excel</th>
                                                <th>Download pdf</th>
                                                <th>Total Question</th>
                                                <th>Total Marks</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>Sr.No</th>
                                                <th>Name</th>
                                            	<th>Class</th>
												<th>Section Names</th>
												<th>Exam Time</th>
												<th>Exam Type</th>
                                                <th>Deadline</th>
                                               
                                                <th>Download excel</th>
                                                <th>Download Pdf</th>
                                                <th>Total Question</th>
                                                <th>Total Marks</th>
												<th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </tfoot>
                                        <tbody>';
                                       
                                        
                                        $sno =1;
                                      
     
                                           while($row = $result->fetch_assoc()) {
                                               $start_date = date("d/m/Y h:i:sa",strtotime($row['edate']));
                                               
											   $status = $row['status'];
											   $exam_url = $row['exam_url'];
											   if ($status == "Active") {
											   $st = '<p class="text-success ">ACTIVE</p>';
											   $stl = '<a href="pages/make_ex_in.php?id='.$row['exam_id'].'">Make Inactive</a>';
											   }else{
											   $st = '<p class="text-danger ">INACTIVE</p>'; 
                                               $stl = '<a href="pages/make_ex_ac.php?id='.$row['exam_id'].'">Make Active</a>';											   
                                               }
                                               $examid = $row['exam_id'];
                                               
                                               $sqltotal = "select * from tbl_questions where exam_id='$examid' and user_id='$login_user_id'";

                                               $runsql = $conn->query($sqltotal);
                                               $countquestion = $runsql->num_rows;
                                               $totalmarks = 0;
                                               while($arr = $runsql->fetch_assoc()){
                                                   $marks = $arr['pos_marks'];
                                                   $totalmarks += $marks;

                                               }
                                               

                                          print '
										       <tr>
										       <input type="hidden" id="maindata'.$sno.'" value="'.$row['exam_id'].'">
										        <td>'.$sno.'</td>
                                                <td>'.$row['exam_name'].'</td>
												<td>'.$row['category'].'</td>
												<td>'.$row['section_name'].'</td>
											    <td>'.$start_date.'</td>
                                                    <td>'.$row['Restrict_time'].'</td>
                                                <td>'.$row['date'].'</td>
                                               
                                                   
                                            <td> 
                                            
                                            <form method="post" action="excel/questions.php?exam_id='.$examid.'">
                                                 <input type="submit" name="export" class="btn btn-success " style="float: right;" value=" Excel" />
                                                </form>
                                                 </td>
                                               <td>
                                                <a href="../PDF/exam_que_pdf.php?exam_id='.$examid.'&&user_id='.$login_user_id.'" class="btn btn-success "> PDF</a>
                                               </td>
 
          
                                                <td>'.$countquestion.'</td>
                                                <td>'.$totalmarks.'</td>
												<td >'.$st.'</td>
                                                <td><div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    Select Action
                                                    <span class="caret"></span>
                                                </button>';
                                                

                                              
                                                $sql1 = "select * from tbl_assessment_records where exam_id='$examid'";
                                                
                                                $result1 = $conn->query($sql1);

                                               $sql2 = "select * from tbl_examinations where exam_id='$examid'";

                                               $result2 = $conn->query($sql2);

                                               $row3 = $result2->fetch_assoc();


                                               
                                                
                                                if(mysqli_num_rows($result1)>0){
                                                
                                                print '<ul class="dropdown-menu" role="menu">
                                                    <li>'.$stl.'</li>
                                                    	<li><a href="edit-exam.php?eid='.$row['exam_id'].'">Edit Exam</a></li>';
                                                       print'
                                                        <li><a href="view-questions.php?eid='.$row['exam_id'].'">Add/View Questions</a></li>';

                                                    // if($row3['exam_type'] == "Normal"){
                                                    //     print'
                                                    //     <li><a href="view-questions.php?eid='.$row['exam_id'].'">View Questions</a></li>
                                                    //   ';
                                                    // }else if($row3['exam_type'] == "excel"){
                                                    //       print'
                                                    //     <li><a href="view-excel-questions.php?eid='.$row['exam_id'].'">View Questions</a></li>';
                                                    // }
                                                    // else if($row3['exam_type'] == "Instance"){
                                                   
                                                    //     print'
                                                    //     <li><a href="view-instance-questions.php?eid='.$row['exam_id'].'">View Questions</a></li>';
                                                    // }
                                                    // else if($row3['exam_type'] == "Section Exam"){
                                                    //      print'
                                                    //     <li><a href="view-section-questions.php?eid='.$row['exam_id'].'">View Questions</a></li>';
                                                    // }
                                                   
                                                    // if($plan != "Free"){
                                                        print '
                                                    <li><a'; ?> onclick = "return confirm('Drop <?php echo $row['exam_name']; ?> ?')" <?php print ' href="pages/drop_ex.php?id='.$row['exam_id'].'">Drop Exam</a></li>';
                                                    // }
                                                    if(empty($exam_url)){
                                                    print ' <li><a href="generate_exam_url.php?eid='.$row['exam_id'].'">Generate Exam Url</a></li>';
                                                    print '<input type="hidden" id="exam_url'.$sno.'"  value="'.$exam_url.'">';
                                                    print '<input type="hidden" id="examids'.$sno.'"  value="'.$row['exam_id'].'">';
                                                    print ' <li><a  onclick="ShowTo('.$sno.')">Show To</a></li>';
                                                    }
                                                    else {
                                                          print '<input type="hidden" id="exam_url'.$sno.'"  value="'.$exam_url.'">';
                                                         print ' <li><a  onclick="Copydata('.$sno.')">Copy Url</a></li>'; 
                                                           print '<input type="hidden" id="examids'.$sno.'"  value="'.$row['exam_id'].'">';
                                                             print ' <li><a  onclick="ShowTo('.$sno.')">Show To</a></li>';
                                                    //   print '<div style="opacity:0">
                                                    //         <div id="div'.$sno.'">'.$exam_url.'</div>
                                                    //         </div>';
                                                    }
                                                    print '
                                                </ul>
                                            </div></td>
                                            </tr>';
                                                }else{
                                                    
                                            print'<ul class="dropdown-menu" role="menu">
                                                    <li>'.$stl.'</li>
													<li><a href="edit-exam.php?eid='.$row['exam_id'].'">Edit Exam</a></li>';
                                                         print'
                                                        <li><a href="view-questions.php?eid='.$row['exam_id'].'">Add/View Questions</a></li>';
                                                    
                                                    // if($row3['exam_type'] == "Normal"){
                                                    //     print'
                                                    //     <li><a href="view-questions.php?eid='.$row['exam_id'].'">View Questions</a></li>
                                                    //     <li><a href="questions.php?eid='.$row['exam_id'].'">Add Questions</a></li>';  
                                                    // }else if($row3['exam_type'] == "excel"){
                                                    //       print'
                                                    //     <li><a href="view-excel-questions.php?eid='.$row['exam_id'].'">View Questions</a></li>';
                                                    // }
                                                    // else if($row3['exam_type'] == "Instance"){
                                                    //     print'
                                                    //     <li><a href="view-instance-questions.php?eid='.$row['exam_id'].'">View Questions</a></li>';
                                                    // }else if($row3['exam_type'] == "Section Exam"){
                                                    //      print'
                                                    //     <li><a href="view-section-questions.php?eid='.$row['exam_id'].'">View Questions</a></li>';
                                                    // }
                                                   
                                                    // if($plan != "Free"){
                                                        print '
                                                    <li><a'; ?> onclick = "return confirm('Drop <?php echo $row['exam_name']; ?> ?')" <?php print ' href="pages/drop_ex.php?id='.$row['exam_id'].'">Drop Exam</a></li>';
                                                    // }
                                                    if(empty($exam_url)){
                                                    print ' <li><a href="generate_exam_url.php?eid='.$row['exam_id'].'">Generate Exam Url</a></li>';
                                                    print '<input type="hidden" id="exam_url'.$sno.'"  value="'.$exam_url.'">';
                                                      print '<input type="hidden" id="examids'.$sno.'"  value="'.$row['exam_id'].'">';
                                                    print ' <li><a  onclick="ShowTo('.$sno.')">Show To</a></li>';
                                                    }
                                                    else {
                                                        print '<input type="hidden" id="exam_url'.$sno.'"  value="'.$exam_url.'">';
                                                       print ' <li><a  onclick="Copydata('.$sno.')">Copy Url</a></li>'; 
                                                         print '<input type="hidden" id="examids'.$sno.'"  value="'.$row['exam_id'].'">';
                                                           print ' <li><a  onclick="ShowTo('.$sno.')">Show To</a></li>';
                                                    }
                                                    
                                                    print '
                                            </div></td>
                                       
                                            </tr>';
                                                }
                                            $sno++;
                                           }
										   
										   print '
									   </tbody>
                                       </table>  ';
                                            } else {
											print '
												<div class="alert alert-info" role="alert">
                                        Nothing was found in database.
                                    </div>';
    
                                           }
                                           $conn->close();
										   
										   ?>

                                        <form method="post" action="excel/exams.php">
                                             <input type="submit" name="export" class="btn btn-success" style="float: right;" value="Download all Exams" />
                                            </form> 
                 

                                    </div>
                                                       
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab6">
                                         <form action="pages/add_newexam.php" method="POST" id="formmy" enctype="multipart/form-data">
                                             <div class="form-row">
                                                 	<div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Exam Name</label>
                                            <input type="text" class="form-control" placeholder="Enter exam name" name="exam" required autocomplete="off">
                                        </div>
                   <!--                     <div class="form-group col-md-4">-->
                   <!--                             <label for="exampleInputEmail1">Exam Type</label>-->
                   <!--                                 <select class="form-control" name="Exam_type" required onchange="FetchExamType(this.value)">-->
        											<!--<option value="Normal" selected>Normal Exam</option>-->
        											<!--<option value="Section Exam" >Instant Exam</option>-->
                   <!--                                 <option value="Instance" >Excel/Image Exam</option>-->
                                                   
        											<!--</select>-->
                   <!--                     </div>-->
                   
                   
                                            <input type="hidden" name="Exam_type" value="Section Exam">
                                           <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Exam Start Time and Date</label>
                                            <input type="datetime-local"   class="form-control" placeholder="Enter Exam Date" name="edate" required autocomplete="off">
                                        </div>
                                             </div>
									 <div class="form-row">
									     <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Exam Duration (Minutes)</label>
                                            <input type="number" value="30" class="form-control" placeholder="Enter exam duration" name="duration" required autocomplete="off">
                                        </div>
                                        <div class="form-group col-md-4">
                                    <label >Deadline</label>
                                    <input type="text" class="form-control date-picker" name="date" required autocomplete="off" placeholder="Select deadline">
                                    </div>
									 <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Cut Off Marks</label>
                                            <input type="number" value="0" class="form-control" placeholder="Enter Cut Off Marks" name="cmarks" required autocomplete="off">
                                        </div>
									
									 </div>
						
									     <div class="form-row">
                                              <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Exit Time</label>
                                            <input type="number" min="0" value="5" class="form-control" placeholder="Enter No of exit full screen.." name="exit" required autocomplete="off">
                                        </div>
                                         <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Select Time Restriction</label>
                                            <select class="form-control" name="Restrict_time" required >
											<!--<option value="" selected disabled>-Select Time Restriction</option>-->
											<option value="Non Restricted" selected> Non Restricted</option>
											<option value="Restricted" >Restricted</option>
											
										
											
											</select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Retake exam in</label>
                                            <input type="number" min="1" value="7" class="form-control" placeholder="days.." name="attempts" required autocomplete="off">
                                        </div>
									    
									</div> 
                                      
									<div class="form-row">
									    
									    	<div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Select Department</label>
                                            <select class="form-control" name="department" required onchange="fetchcategory(this.value)">
											<option value="" selected disabled>-Select Department-</option>
											<?php
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_departments WHERE user_id='$login_user_id' and status = 'Active' ORDER BY name";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
    
                                            while($row = $result->fetch_assoc()) {
                                            print '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                            }
                                           } else {
                          
                                            }
                                             $conn->close();
											 ?>
											
											</select>
                                        </div>
           <!--                             	<div class="form-group col-md-4">-->
           <!--                                 <label for="exampleInputEmail1">Select Subject</label>-->
           <!--                                 <select class="form-control" name="subject" required id="subject">-->
											<!--<option value="" selected disabled>-Select subject</option>-->
		
											
											<!--</select>-->
           <!--                             </div>-->
           	<div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Select Class</label>
                                            <select class="form-control" name="category" required id="category">
											<option value="" selected disabled>-Select Class-</option>
										
											
											</select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Result Type</label>
                                            <select class="form-control" name="result_type" required>
											<option value="" selected disabled>-Select result type</option>
											
											<option value="manual">Manual</option>
                                            <option value="automation" >Automation</option>
											</select>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Positive Marks</label>
                                            <input type="number" value="4" class="form-control" placeholder="Enter Cut Off Marks" name="pmarks" required autocomplete="off">
                                        </div>
                                           <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1">Negative Marks</label>
                                            <input type="number" value="-1" class="form-control" placeholder="Enter Cut Off Marks" name="nmarks" required autocomplete="off">
                                        </div>
									    
									</div>
								
                                 
         <!--                           <div class=" form-row" id="insdata" style="display:none">-->
         <!--                                   <div class="form-group col-lg-3 pt-2">-->
         <!--                                   <button class="btn btn-primary btn-block" type="button" id="excel" onclick="UploadData(this.id)">Add Excel File</button>-->
         <!--                                   </div>-->
         <!--                                   <div class="form-group col-lg-3 pt-2">-->
         <!--                                   <button class="btn btn-success btn-block" type="button" id="files" onclick="UploadData(this.id)">Add Image Files</button>-->
         <!--                                   </div>-->
         <!--                                    <div class="form-group col-md-3">-->
         <!--                                   <label for="exampleInputEmail1">Positive Marks</label>-->
         <!--                                   <input type="number" value="4" onfocus="stopscroll(this);" class="form-control" placeholder="Enter Cut Off Marks" name="pmarks" required autocomplete="off">-->
         <!--                               </div>-->
         <!--                                  <div class="form-group col-md-3">-->
         <!--                                   <label for="exampleInputEmail1">Negative Marks</label>-->
         <!--                                   <input type="number" value="-1" class="form-control" placeholder="Enter Cut Off Marks" name="nmarks" required autocomplete="off">-->
         <!--                               </div>-->
         <!--                                       <div class="form-group col-lg-12 upload_excel">-->
                                           
         <!--                                   </div>-->
                                           
									    
									      
                                        
									    
									<!--</div>-->
                                            
                                
                                      <input type="hidden" name="datatype" id="finaldata">
                                 
                                    <div class="form-row">
                                        <div  id="inputdata"  >
                                        <div class="form-group col-md-12">
                                            <label>Add Section Names</label>
                                            <select multiple data-role="tagsinput" name="sec[]" class="form-control" required>
                                                <!--<option>Select section name</option>-->
                                                <!--<option>Physics</option>-->
                                                <!--<option>Checmistry</option> -->
                                                <!--<option>Maths</option>-->
                                                
                                            </select>
                                            </div>
                                             
                                        
                                        </div>
         <!--                               	<div class="form-row">-->
									    
									     
                                        
									    
									<!--</div>-->
                                    </div>
                                    
										<div class="form-row">
									
									
        									<div class="form-group col-lg-12 ">
                                                    <label for="exampleInputEmail1">Instructions For Student</label>
                                                    <textarea style="resize: none;" rows="5" class="form-control" placeholder="Enter Instructions For Student" name="instructions" autocomplete="off"></textarea>
                                             </div>
                                            
                                       
                                             
                    
                                     </div>
									<br><br>
                                   <div class="form-row">
                                       <div class="col-12 form-group">
                                             <button style="margin-left:20px;" type="submit" class="btn btn-primary">Submit</button>
                                       </div>
                                   </div>
                                           
                                     
                                       </form>
                                            
                                            
                                                
                                                
                                                
       

                                            </div>
                                        </div>
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


<div class="Modal">
    <div class="Modal1">
    <form id="more_question" action="" method="post" enctype="multipart/form-data">
        <h4>Add A New Question</h4>
        <div class="form-group">
            <label for="exampleInputEmail1">Your Exam</label>
            <input type="text" class="form-control" id="exam_id_for_show" disabled>
        </div>
         <div class="form-group">
            <label for="exampleInputEmail1">Select Class</label>
            <select class="form-control" name="class[]" multiple id="category_sel">
                <?php 
                	include '../database/config.php';
                $result = $conn-> query("SELECT *FROM tbl_categories where user_id='$login_user_id'and status='active'");
                while($row=$result->fetch_assoc()){
                ?>
              <option value="<?php echo $row['name']?>"><?php echo $row['name']?></option>
              <?php }?> 
                </select>
        </div>
        <button type="submit" name="showto" class="btn btn-primary" >Submit</button>
    <button type="button" class="btn btn-warning" onclick="Closemodal()">Close</button>
</form>
    
    
    </div>
    </div>


 
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
        <script src="../assets/plugins/summernote-master/summernote.min.js"></script>
        <script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="../assets/js/pages/form-elements.js"></script>
		

		<script>
$(document).ready(function(){
    
    $('form').on('focus', 'input[type=number]', function (e) {
  $(this).on('wheel.disableScroll', function (e) {
    e.preventDefault()
  })
})
$('form').on('blur', 'input[type=number]', function (e) {
  $(this).off('wheel.disableScroll')
})
    
})
		
		  // function FetchExamType(data){
                                                       
                                                   
    //                                                     if(data == "Instance"){
    //                                                         document.querySelector('#insdata').style.display="block";
    //                                                         document.querySelector('#inputdata').style.display="none";
    //                                                         document.querySelector('#formmy').setAttribute('action','pages/add_newexam1.php');
    //                                                     }else if(data == "Section Exam"){
    //                                                          document.querySelector('#inputdata').style.display="block";
    //                                                           document.querySelector('#insdata').style.display="none";
    //                                                           document.querySelector('#formmy').setAttribute('action','pages/add_newexam.php');
                                                          
    //                                                     }else{
    //                                                          document.querySelector('#inputdata').style.display="none";
    //                                                           document.querySelector('#insdata').style.display="none";
    //                                                           document.querySelector('#formmy').setAttribute('action','pages/add_newexam.php');
    //                                                     }
                                                       
                                                        
                                                        
    //                                                 }
		

		//// copy data
		
		

		function Copydata(data){
		 alert("Exam Url :"+document.querySelector("#exam_url"+data).value);
		}
		
		function ShowTo(showtodata){
            var exam_id = document.getElementById('examids'+showtodata).value;
             document.querySelector('#exam_id_for_show').value=exam_id;
            document.querySelector('.Modal').style.display="block"; 
         
            
            var url = "pages/add-showto.php?exam_id="+exam_id;
            
             document.querySelector('#more_question').setAttribute("action",url);
            
}
		function Closemodal(){
document.querySelector('.Modal').style.display="none";
}
         /// code is correct                                   
                                      


		function fetchcategory(maindata){
		    $.ajax({
		        url:'ajax/FetchSubject.php',
		        type:'post',
		        data:{
		            maindata:maindata
		        },
		        success:function(data){
		            $('#category').html(data);
		           
		        }
		    })
		}


    function UploadData(data){
       
        let x = document.querySelector('.upload_excel');
        let y = document.getElementById('finaldata');
         x.innerHTML='';
        y.value="excel";
        if(data == "excel"){
           

            if(x.innerHTML == ''){
                x.innerHTML = '<label for="exampleInputEmail1">Upload Excel</label><input type="file" class="form-control"  name="excelfile" required autocomplete="off"><br><a href="image.png" target="_blank">Check The Excel Format</a>';
               
            }
           

        
        }
        else   if(data == "files"){
            y.value="files";
          
            if(x.innerHTML == ''){

                x.innerHTML =' <label for="exampleInputEmail1">Exam All Questions</label><input type="file" class="form-control"  name="upload[]" required autocomplete="off" multiple>  ';
              
            }
           
           
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