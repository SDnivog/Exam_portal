<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';

$sec_name = $_GET['sec_name'];
if (isset($_GET['eid'])) {
include '../database/config.php';
$exam_id = mysqli_real_escape_string($conn, $_GET['eid']);	

$sql = "SELECT * FROM tbl_examinations WHERE exam_id = '$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $exam_name =$row['exam_name'];
    }
} else {
header("location:./index");	
}

}else{
header("location:./index");	
}
?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Trando | Add Questions</title>
      <!--<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>-->
    <!--            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>-->
        <style>
            img{
              display: block;
              max-width: 100%;
            }
            .preview {
              overflow: hidden;
              width: 100%; 
              height: auto;
              margin: 10px; margin-bottom: 25px;padding:10px;overflow:hidden;
              /*border: 1px solid red;*/
            
            
            }
            .modal-lg{
              max-width: 1000px !important;
            }
            
            
            
            
            
        </style>
          
    
      <?php include'header.php';?>
        <ul class="menu accordion-menu">
                        <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Streams</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Classes</p></a></li>
                        <li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!--<li><a href="questions_bank.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Question Bank</p></a></li>-->
                        <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
             
                    </ul>
                   
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                                       <div class="row">
                                           <div class="col-md-10"> <h3>Add Questions - <?php echo "$exam_name"; ?></h3></div>
                                           <div class="col-md-2"><a href="./view-questions.php?eid=<?php echo $exam_id;?>" class="btn btn-success">View Questions <span class="glyphicon glyphicon-eye-open"></span></a></div>
                                       </div>

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
                                                <li role="presentation" class="active"><a href="#tab5" role="tab" data-toggle="tab">Add Your Question</a></li>
                                                
                                            </ul>

                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active fade in" id="tab5">
                                                <form id="new_question" action="pages/add_question2.php?sec_name=<?php echo $sec_name; ?>" method="POST" enctype="multipart/form-data">
										
                                            <!-- Image Section ADDED by Govind  -->	
                                            <div class="form-row">
												<div class="col-lg-12 form-group">
                                                <label for="exampleInputEmail1">Question</label>
                                                <input type="text" class="form-control" placeholder="Enter question" name="question"  autocomplete="off">
                                                </div>
                                                </div>
                                         <div class="form-row">
                                               <div class="col-md-4 form-group">
                                            <label for="exampleInputEmail1">QUESTION TYPE</label>
										    <select class="form-control" name="question_type" id="question_type" onchange="check_question_type(this.value)" required>
                                            <option value="STQ" selected>Single Type Question</option>
                                            <option value="MTQ" >Multiple Type Question</option>
                                            <option value="TQ" >True/False Question</option>
                                            <option value="FQ" >Fill Blanks Question</option>
												</select></div>
                                            <div class="col-md-4 form-group">
                                                <label for="pmarks">Positive Marks</label>
                                                <input type="number" value="4" name="pmarks" placeholder="Enter Positive  Marks" autocomplete="off" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="nmarks">Negative  Marks</label>
                                                <input type="number" value="-1" name="nmarks" placeholder="Enter Negative Marks" autocomplete="off" class="form-control" required>
                                            </div>
                                         </div>
                            
                                             <div class="form-row" style=" margin-bottom: 25px;padding:10px;overflow:hidden;">
                            
                                                <div class="form-group col-md-6">
                                                    <label for="img">Select English Language Image</label>
                                                  <input type="file" name="Image" placeholder="Select Image" autocomplete="off" id="question_input" onchange="previewimg(event,0)">
                                                    
                                                    
                                                </div>
                                                <div class="col-md-6" >
                                                    <div class="preview">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                

												</div>
												<div class="form-row" style=" margin-bottom: 25px;padding:10px;overflow:hidden;">
                            
                                                <div class="form-group col-md-6">
                                                    <label for="img">Select Hindi Language Image</label>
                                                  <input type="file" name="Image_hindi" placeholder="Select Image" autocomplete="off" id="question_input" >
                                                    
                                                    
                                                </div>
                                                <div class="col-md-6" >
                                                    <div class="preview">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                

												</div>
												
											<div class="form-row">
                            
												<div class="col-lg-12" id="mstq">
                                      <table class="table table-bordered"  >
                                        <thead>
                                            <tr>
                                                <th width="100">Option No.</th>
                                                <th>Option</th>
                                                <th  width="100" >Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" >1</th>
                                                <td>
												<div class="form-row">
												<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Option 1</label>
                                                <input type="text" value="A" class="form-control" placeholder="Enter option 1" name="opt1" id="optval1"  autocomplete="off" onfocusin="disableinput(1)" onfocusout = "undisabledinput(1)">
                                                </div>
                                                	<div class="form-group col-lg-1">
                                                <h2 class="text-center">Or</h2>
                                               
                                                </div>
                                                	<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Select Image</label>
                                                   <input type="file" name="Image1" placeholder="Select Image" autocomplete="off" id="optimg1" class="image1 form-control" required onchange="previewimg(event,1)" disabled>
                                           
                                                </div>
                                                <div class="form-group col-lg-3 previewimg1" style="overflow:auto;height:auto">
                                                      
                                                </div>
                                                </div>
												</td>
                                               <td>
                                                    <label class="container1">
                                                    <input type="radio" name="answer" id="option1" value="option1" required>
                                                    </label>
                                                </td>
                            
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>
                                                    	<div class="form-row">
												<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Option 2</label>
                                               <input type="text" value="B" class="form-control" placeholder="Enter option 2" name="opt2" id="optval2" required autocomplete="off" onfocusin="disableinput(2)" onfocusout = "undisabledinput(2)">
                                                </div>
                                                	<div class="form-group col-lg-1">
                                                <h2 class="text-center">Or</h2>
                                               
                                                </div>
                                                	<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Select Image</label>
                                                <input type="file" name="Image2" placeholder="Select Image" autocomplete="off" id="optimg2" class="image2 form-control" required onchange="previewimg(event,2)" disabled>
                                             
                                                </div>
                                                 <div class="form-group col-lg-3 previewimg2" style="height:auto">
                                                
                                                </div>
                                                </div>
											
												</td>
                                               <td>
                                                    <label class="container1">
                                                    <input type="radio" name="answer" id="option2" value="option2" required>
                                                    </label>
                                                </td>
                
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>
                                                    	<div class="form-row">
												<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Option 3</label>
                                               <input type="text" value="C" class="form-control" placeholder="Enter option 3" name="opt3" id="optval3" required autocomplete="off" onfocusin="disableinput(3)" onfocusout = "undisabledinput(3)">
                                                </div>
                                                	<div class="form-group col-lg-1">
                                                <h2 class="text-center">Or</h2>
                                               
                                                </div>
                                                	<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Select Image</label>
                                                <input type="file" name="Image3" placeholder="Select Image" autocomplete="off" id="optimg3" class="image3 form-control" required onchange="previewimg(event,3)" disabled>
                                                </div>
                                                 <div class="form-group col-lg-3 previewimg3" style="overflow:auto;height:auto">
                                                
                                                </div>
                                                </div>
											
												</td>
                                                <td>
                                                    <label class="container1">
                                                    <input type="radio" name="answer" id="option3" value="option3" required>
                                                    </label>
                                                </td>
                                
                                            </tr>
											
											<tr>
                                                <th scope="row">4</th>
                                                <td>
                                                    	<div class="form-row">
												<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Option 4</label>
                                               <input type="text" value="D" class="form-control" placeholder="Enter option 4" name="opt4" id="optval4" required autocomplete="off" onfocusin="disableinput(4)" onfocusout = "undisabledinput(4)">
                                                </div>
                                                	<div class="form-group col-lg-1">
                                                <h2 class="text-center">Or</h2>
                                               
                                                </div>
                                                	<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Select Image</label>
                                                <input type="file" name="Image4"  placeholder="Select Image" autocomplete="off" id="optimg4" class="image4 form-control" required onchange="previewimg(event,4)" disabled>
                                               
                                                </div>
                                                 <div class="form-group col-lg-3 previewimg4" style="overflow:auto;height:auto">
                                                
                                                </div>
                                                </div>
											
												</td>
                                               <td >
                                                    <label class="container1">
                                                    <input type="radio" name="answer" id="option4" value="option4" required>
                                                    </label>
                                                </td>
                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                    </div>
                                    	<input type="hidden" name="exam_id" value="<?php echo "$exam_id"; ?>">
									  <input type="hidden" id="data" name="data">
                                 
									 <button type="submit" class="btn btn-primary">Submit</button>
												

												
												</form>
                                                       
                                                </div>
            <!--                                    <div role="tabpanel" class="tab-pane fade" id="tab6">-->
            <!--                             <form action="pages/add_question2.php?type=fib" method="POST" enctype="multipart/form-data">-->
										 

												<!--<div class="form-group">-->
            <!--                                    <label for="exampleInputEmail1">Question</label>-->
            <!--                                    <input type="text" class="form-control" placeholder="Enter question" name="question"  autocomplete="off">-->
            <!--                                    </div>-->
                                               
            <!--                                 <div class="form-row">-->
                            
            <!--                                    <div class="form-group col-md-6">-->
            <!--                                        <label for="image">Select Image</label>-->
            <!--                                      <input type="file" name="Image" placeholder="Select Image" autocomplete="off" class="image">-->
                                                    
                                                    
            <!--                                    </div>-->
            <!--                                    <div class="col-md-6" >-->
                                                    
            <!--                                        <div class="preview">-->
                                                        
            <!--                                        </div>-->
                                                    
            <!--                                    </div>-->
                                                

												<!--</div>-->
												<!--<div class="form-group">-->
            <!--                                    <label for="exampleInputEmail1">Answer</label>-->
            <!--                                    <input type="text" class="form-control" placeholder="Enter answer" name="answer" required autocomplete="off">-->
            <!--                                    </div>-->
            <!--                                    <div class="form-group">-->
            <!--                                        <label for="pmarks">Positive Marks</label>-->
            <!--                                        <input type="number" value="4" name="pmarks" placeholder="Enter Positive  Marks" autocomplete="off" class="form-control" required>-->
            <!--                                    </div>-->
            <!--                                    <div class="form-group">-->
            <!--                                        <label for="nmarks">Negative  Marks</label>-->
            <!--                                        <input type="number" value="-1" name="nmarks" placeholder="Enter Negative Marks" autocomplete="off" class="form-control" required>-->
            <!--                                    </div>-->
            <!--                           <input type="hidden" id="data1" name="data1">-->
            <!--                            <button type="submit" class="btn btn-primary">Submit</button>-->
            <!--                           </form>-->
            <!--                                    </div>-->

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
        
		<script>

    function check_question_type(data){
  
        if(data == "STQ"){
            document.getElementById('mstq').innerHTML='<div><table class="table table-bordered"  ><thead> <tr><th width="100">Option No.</th> <th>Option</th><th  width="100" >Answer</th></tr></thead><tbody><tr><th scope="row" >1</th><td><div class="form-row"><div class="form-group col-lg-4"><label for="exampleInputEmail1">Option 1</label><input type="text" value="A" class="form-control" placeholder="Enter option 1" name="opt1" id="optval1"  autocomplete="off" onfocusin="disableinput(1)" onfocusout = "undisabledinput(1)"></div>    <div class="form-group col-lg-1"><h2 class="text-center">Or</h2></div>    <div class="form-group col-lg-4"><label for="exampleInputEmail1">Select Image</label>   <input type="file" name="Image1" placeholder="Select Image" autocomplete="off" id="optimg1" class="image1 form-control" required onchange="previewimg(event,1)"disabled ><!--<input type="file" class="form-control"  name="Image1" id="optimg1" required autocomplete="off" onchange="previewimg(1)">--></div><div class="form-group col-lg-3 previewimg1" style="overflow:auto;height:auto">      </div></div></td><td ><label class="container1"><input type="radio" name="answer" id="option1" value="option1" required></label></td></tr><tr><th scope="row">2</th><td><div class="form-row"><div class="form-group col-lg-4"><label for="exampleInputEmail1">Option 2</label><input type="text" value="B" class="form-control" placeholder="Enter option 2" name="opt2" id="optval2" required autocomplete="off" onfocusin="disableinput(2)" onfocusout = "undisabledinput(2)"></div><div class="form-group col-lg-1"><h2 class="text-center">Or</h2></div><div class="form-group col-lg-4"><label for="exampleInputEmail1">Select Image</label><input type="file" name="Image2" placeholder="Select Image" autocomplete="off" id="optimg2" class="image2 form-control" required onchange="previewimg(event,2)" disabled></div><div class="form-group col-lg-3 previewimg2" style="height:auto"></div></div></td><td ><label class="container1"><input type="radio" name="answer" id="option2" value="option2" required></label></td></tr><tr><th scope="row">3</th><td><div class="form-row"><div class="form-group col-lg-4"><label for="exampleInputEmail1">Option 3</label><input type="text" value="C" class="form-control" placeholder="Enter option 3" name="opt3" id="optval3" required autocomplete="off" onfocusin="disableinput(3)" onfocusout = "undisabledinput(3)"></div><div class="form-group col-lg-1"><h2 class="text-center">Or</h2></div><div class="form-group col-lg-4"><label for="exampleInputEmail1">Select Image</label><input type="file" name="Image3" placeholder="Select Image" autocomplete="off" id="optimg3" class="image3 form-control" required onchange="previewimg(event,3)" disabled></div><div class="form-group col-lg-3 previewimg3" style="overflow:auto;height:auto"></div></div></td><td ><label class="container1"><input type="radio" name="answer" id="option3" value="option3" required></label></td></tr><tr><th scope="row">4</th><td><div class="form-row"><div class="form-group col-lg-4"><label for="exampleInputEmail1">Option 4</label><input type="text" value="D" class="form-control" placeholder="Enter option 4" name="opt4" id="optval4" required autocomplete="off" onfocusin="disableinput(4)" onfocusout = "undisabledinput(4)"></div><div class="form-group col-lg-1"><h2 class="text-center">Or</h2></div><div class="form-group col-lg-4"><label for="exampleInputEmail1">Select Image</label><input type="file" name="Image4"  placeholder="Select Image" autocomplete="off" id="optimg4" class="image4 form-control" required onchange="previewimg(event,4)" disabled></div><div class="form-group col-lg-3 previewimg4" style="overflow:auto;height:auto"></div></div></td><td ><label class="container1"><input type="radio" name="answer" id="option4" value="option4" required></label></td></tr></tbody></table></div>'

        } else if(data == "MTQ"){
            document.getElementById('mstq').innerHTML='<div><table class="table table-bordered"  ><thead> <tr><th width="100">Option No.</th> <th>Option</th><th  width="100" >Answer</th></tr></thead><tbody><tr><th scope="row" >1</th><td><div class="form-row"><div class="form-group col-lg-4"><label for="exampleInputEmail1">Option 1</label><input type="text" value="A" class="form-control" placeholder="Enter option 1" name="opt1" id="optval1"  autocomplete="off" onfocusin="disableinput(1)" onfocusout = "undisabledinput(1)"></div>    <div class="form-group col-lg-1"><h2 class="text-center">Or</h2></div>    <div class="form-group col-lg-4"><label for="exampleInputEmail1">Select Image</label>   <input type="file" name="Image1" placeholder="Select Image" autocomplete="off" id="optimg1" class="image1 form-control" required onchange="previewimg(event,1)" disabled><!--<input type="file" class="form-control"  name="Image1" id="optimg1" required autocomplete="off" onchange="previewimg(event,1)" disabled>--></div><div class="form-group col-lg-3 previewimg1" style="overflow:auto;height:auto">      </div></div></td><td ><label class="container1"><input type="checkbox" name="check1" id="option1" value="option1" ></label></td></tr><tr><th scope="row">2</th><td><div class="form-row"><div class="form-group col-lg-4"><label for="exampleInputEmail1">Option 2</label><input type="text" value="B" class="form-control" placeholder="Enter option 2" name="opt2" id="optval2" required autocomplete="off" onfocusin="disableinput(2)" onfocusout = "undisabledinput(2)"></div><div class="form-group col-lg-1"><h2 class="text-center">Or</h2></div><div class="form-group col-lg-4"><label for="exampleInputEmail1">Select Image</label><input type="file" name="Image2" placeholder="Select Image" autocomplete="off" id="optimg2" class="image2 form-control" required onchange="previewimg(event,2)" disabled></div><div class="form-group col-lg-3 previewimg2" style="height:auto"></div></div></td><td ><label class="container1"><input type="checkbox" name="check2" id="option2" value="option2"></label></td></tr><tr><th scope="row">3</th><td><div class="form-row"><div class="form-group col-lg-4"><label for="exampleInputEmail1">Option 3</label><input type="text" value="C" class="form-control" placeholder="Enter option 3" name="opt3" id="optval3" required autocomplete="off" onfocusin="disableinput(3)" onfocusout = "undisabledinput(3)"></div><div class="form-group col-lg-1"><h2 class="text-center">Or</h2></div><div class="form-group col-lg-4"><label for="exampleInputEmail1">Select Image</label><input type="file" name="Image3" placeholder="Select Image" autocomplete="off" id="optimg3" class="image3 form-control" required onchange="previewimg(event,3)" disabled></div><div class="form-group col-lg-3 previewimg3" style="overflow:auto;height:auto"></div></div></td><td ><label class="container1"><input type="checkbox" name="check3" id="option3" value="option3" ></label></td></tr><tr><th scope="row">4</th><td><div class="form-row"><div class="form-group col-lg-4"><label for="exampleInputEmail1">Option 4</label><input type="text" value="D" class="form-control" placeholder="Enter option 4" name="opt4" id="optval4" required autocomplete="off" onfocusin="disableinput(4)" onfocusout = "undisabledinput(4)"></div><div class="form-group col-lg-1"><h2 class="text-center">Or</h2></div><div class="form-group col-lg-4"><label for="exampleInputEmail1">Select Image</label><input type="file" name="Image4"  placeholder="Select Image" autocomplete="off" id="optimg4" class="image4 form-control" required onchange="previewimg(event,4)" disabled></div><div class="form-group col-lg-3 previewimg4" style="overflow:auto;height:auto"></div></div></td><td ><label class="container1"><input type="checkbox" name="check4" id="option4" value="option4"></label></td></tr></tbody></table></div>'

        } else if(data == "FQ"){
            
                document.getElementById('mstq').innerHTML='<div><div class="form-group"><label for="fill">Answer</label><input type="text" class="form-control" placeholder="Enter answer" name="answer" required autocomplete="off"> </div></div><p><b>Note :</b>If you want to assign a range value answer eg.12-13 or 12.4-13.9<p>';
              
        }
        else if(data == "TQ"){
            
                document.getElementById('mstq').innerHTML='<div><div class="form-group"><label for="tfq">Answer</label><input type="radio"  name="answer" value="option1" required >True <input type="radio"  name="answer" value="option2" required >False</div></div>';
              
            
        }

    }





function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}


// Start snipping Tool

     const form = document.getElementById("new_question");
const fileInput = document.getElementById("question_input");

window.addEventListener('paste', e => {
  fileInput.files = e.clipboardData.files;
  previewimg(e,0)
});




function disableinput(x){
    document.getElementById('optimg'+x).disabled =true;
}
function undisabledinput(x){
    if(document.getElementById('optval'+x).value == ''){
    document.getElementById('optimg'+x).disabled =false;
    }
}




function previewimg(e,x){
    if(x != 0){
    if(document.getElementById('optimg'+x).value == ""){
        document.getElementById("optval"+x).disabled = false;
    }
    else{
      document.getElementById("optval"+x).disabled = true; 
    }
    }
    if(x != 0){
        var imagename = document.getElementById('optimg'+x).files[0];
        var formdata = new FormData();
        formdata.append('file',imagename);
    }else{
        var imagename = document.getElementById('question_input').files[0];
        var formdata = new FormData();
        formdata.append('file',imagename);
    }
        $.ajax({
            url:"upload.php",
            type:"POST",
            data:formdata,
            contentType:false,
            cache:false,
            processData:false,
            beforeSend:function(){
                if(x != 0){
          $('.previewimage'+x).html("<label>Image Uploading.....</label>");
                }else{
                    $('.preview').html("<label>Image Uploading.....</label>");
                }

        },
            success:function(data){
                if(x != 0){
                    $('.previewimg'+x).html(data);
                }else{
                $('.preview').html(data);
                }
                
            },
        });
      
        

}
















</script>
    </body>

</html>