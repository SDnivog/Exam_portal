<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';

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
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
     
    
                    <style>
            
            img{
              display: block;
              max-width: 100%;
            }
            .preview {
              overflow: hidden;
              width: 100%; 
              height: 200px;
              margin: 10px;
              /*border: 1px solid red;*/
            
            
            }
            .modal-lg{
              max-width: 1000px !important;
            }
                </style>
<?php include 'header.php'; ?>
                    <ul class="menu accordion-menu">
                        <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Stream</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Class</p></a></li>
                        <li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <li><a href="questions.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Questions</p></a></li>
                        <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
             
                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Add Questions - <?php echo "$exam_name"; ?></h3>



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
                                                <li role="presentation" class="active"><a href="#tab5" role="tab" data-toggle="tab">Multiple Choice</a></li>
                                                <li role="presentation"><a href="#tab6" role="tab" data-toggle="tab">Filling Blanks</a></li>
                                            </ul>
                                    
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active fade in" id="tab5">
                                                <form id="new_question" action="pages/add_question.php?type=mc" method="POST" enctype="multipart/form-data">
												<div class="form-group">
                                                <label for="exampleInputEmail1">Question</label>
                                                <input type="text" class="form-control" placeholder="Enter question" name="question" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                            <label for="pmarks">Positive Marks</label>
                                            <input type="number" value="4" name="pmarks" placeholder="Enter Positive  Marks" autocomplete="off" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nmarks">Negative  Marks</label>
                                            <input type="number" value="-1" name="nmarks" placeholder="Enter Negative Marks" autocomplete="off" class="form-control" required>
                                        </div>




                                        
                                                <div class="form-row">
                            
                                                <div class="form-group col-md-6">
                                                    <label for="img">Select Image</label>
                                                  <input type="file" name="Image" placeholder="Select Image" autocomplete="off" id="question_input" >
                                                    
                                                    
                                                </div>
                                                <div class="col-md-6" >
                                                    
                                                    <div class="preview">
                                                        
                                                    </div>
                                                    
                                                </div>
                                                

												</div>
												
                                      <table class="table table-bordered">
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
                                               <input type="text" value="A" class="form-control" placeholder="Enter option 1" name="opt1" id="optval1" required autocomplete="off" onfocusin="disableinput(1)" onfocusout = "undisabledinput(1)">
                                                </div>
                                                	<div class="form-group col-lg-1">
                                                <h2 class="text-center">Or</h2>
                                               
                                                </div>
                                                	<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Select Image</label>
                                                <input type="file" class="form-control"  name="Image1" id="optimg1" required autocomplete="off" onchange="previewimg(1)">
                                                </div>
                                                 <div class="form-group col-lg-3 previewimage1" style="overflow:auto;height:150px">
                                                
                                                </div>
                                                </div>
												</td>
                                                <td>
                                                    <label class="container1">
                                                    <input type="radio" name="answer" value="option1" required>
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
                                                <input type="file" class="form-control"  name="Image2" id="optimg2" required autocomplete="off" onchange="previewimg(2)">
                                                </div>
                                                 <div class="form-group col-lg-3 previewimage2" style="overflow:auto;height:150px">
                                                
                                                </div>
                                                </div>
												</td>
                                                <td>
                                                    <label class="container1">
                                                    <input type="radio" name="answer" value="option2" required>
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
                                                <input type="file" class="form-control"  name="Image3" id="optimg3" required autocomplete="off" onchange="previewimg(3)">
                                                </div>
                                                 <div class="form-group col-lg-3 previewimage3" style="overflow:auto;height:150px">
                                                
                                                </div>
                                                </div>
												</td>
                                                <td>
                                                    <label class="container1">
                                                    <input type="radio" name="answer" value="option3" required>
                                                    </label>
                                                </td>
                                
                                            </tr>
											
											<tr>
                                                <th scope="row">4</th>
                                                <td>
												   	<div class="form-row">
												<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Option 4</label>
                                               <input type="text" value="D" class="form-control" placeholder="Enter option 4" name="opt4" id="optval4" autocomplete="off" onfocusin="disableinput(4)" onfocusout = "undisabledinput(4)">
                                                </div>
                                                	<div class="form-group col-lg-1">
                                                <h2 class="text-center">Or</h2>
                                               
                                                </div>
                                                	<div class="form-group col-lg-4">
                                                <label for="exampleInputEmail1">Select Image</label>
                                                <input type="file" class="form-control"  name="Image4" id="optimg4" required autocomplete="off" onchange="previewimg(4)">
                                                </div>
                                                 <div class="form-group col-lg-3 previewimage4" style="overflow:auto;height:150px">
                                                
                                                </div>
                                                </div>
												</td>
                                               <td>
                                                    <label class="container1">
                                                    <input type="radio" name="answer" value="option4" required>
                                                    </label>
                                                </td>
                                
                                            </tr>
                                        </tbody>
                                    </table>
									<input type="hidden" name="exam_id" value="<?php echo "$exam_id"; ?>">
									  <input type="hidden" id="data" name="data">
									 <button type="submit" class="btn btn-primary">Submit</button>
												

												
												</form>
                                                       
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab6">
                                         <form action="pages/add_question.php?type=fib" method="POST" enctype="multipart/form-data">
												<div class="form-group">
                                                <label for="exampleInputEmail1">Question</label>
                                                <input type="text" class="form-control" placeholder="Enter question" name="question"  autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label for="pmarks">Positive Marks</label>
                                                    <input type="number" value="4" name="pmarks" placeholder="Enter Positive  Marks" autocomplete="off" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nmarks">Negative  Marks</label>
                                                    <input type="number" value="-1" name="nmarks" placeholder="Enter Negative Marks" autocomplete="off" class="form-control" required>
                                                </div>




                                                <div class="form-row">
                            
                                                <div class="form-group col-md-6">
                                                    <label for="img">Select Image</label>
                                                  <input type="file" name="Image" placeholder="Select Image" autocomplete="off"  >
                                                    
                                                    
                                                </div>
                                                <div class="col-md-6" >
                                                    
                                                    <div class="preview">
                                                        
                                                    </div>
                                                    
                                                </div>
												<div class="form-group">
                                                <label for="exampleInputEmail1">Answer</label>
                                                <input type="text" class="form-control" placeholder="Enter answer" name="answer" required autocomplete="off">
                                                </div>
                                         <input type="hidden" name="exam_id" value="<?php echo "$exam_id"; ?>">
                                         <input type="hidden" id="data1" name="data1">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                
            </div>
        </main>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Crop The Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
            <div class="row">
                <div class="col-md-6">
                    <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                </div>
                <div class="col-md-6">
                    <div class="preview"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="crop">Crop</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>
        
        
        
        
        
        
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
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

// Start snipping Tool

     const form = document.getElementById("new_question");
const fileInput = document.getElementById("question_input");

// fileInput.addEventListener('change', () => {
//   form.submit();
// });

window.addEventListener('paste', e => {
  fileInput.files = e.clipboardData.files;
});

// End snipping input

var $modal = $('#modal');
var image = document.getElementById('image');

var cropper;
  
$("body").on("change", ".image", function(e){
    var files = e.target.files;
    var done = function (url) {
      image.src = url;
      $modal.modal('show');
    };
    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
});

$modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
    aspectRatio:0,
    viewMode: 10,
    preview: '.preview'
    });
}).on('hidden.bs.modal', function () {
   cropper.destroy();
   cropper = null;
});

$("#crop").click(function(){
    canvas = cropper.getCroppedCanvas({
      width:500,
      height: 500,
    });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
         reader.readAsDataURL(blob); 
         reader.onloadend = function() {
            var base64data = reader.result;  
            document.getElementById('data').value = base64data;
              document.getElementById('data1').value = base64data;
            
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "cropupload.php",
                data: {image: base64data},
                success: function(data){
                    console.log(data);
                    $modal.modal('hide');
                     cropper = new Cropper(image, {
                        aspectRatio:0,
                        viewMode: 10,
                        preview: '.preview'
                        });
                        
                  
                    
                }
              });
         }
    });
})






function disableinput(x){
    document.getElementById('optimg'+x).disabled =true;
}
function undisabledinput(x){
    if(document.getElementById('optval'+x).value == ''){
    document.getElementById('optimg'+x).disabled =false;
    }
}


function previewimg(x){
    
    if(document.getElementById('optimg'+x).value == ""){
        document.getElementById("optval"+x).disabled = false;
    }
    else{
       document.getElementById("optval"+x).disabled = true; 
    }

    var imagename = document.getElementById('optimg'+x).files[0];
      var formdata = new FormData();
        formdata.append('file',imagename);
       
        $.ajax({
            url:"upload.php",
            type:"POST",
            data:formdata,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
            $('.previewimage'+x).html(data);
            },
        });
      
        

}













</script>
    </body>

</html>