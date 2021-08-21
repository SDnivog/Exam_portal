<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';
include '../database/config_class.php';
?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>Kendel | Create Assignment</title>
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

.assignment-form .titleinput{
    border:none;
    border-bottom:2px solid #999;
    padding-top:25px !important;
    padding-bottom:20px !important;
    background:#f1f4f9;
    /*color:#000 !important;*/
    
}
.assignment-form .titleinput:focus{
    border:none;
    border-bottom:2px solid #999;
    padding-top:25px !important;
    padding-bottom:20px !important;
    background:#e9edf2;
    /*color:#74767d;*/
}
.assignment-form select{
    border:none;
    border-bottom:2px solid #999;
    background:#f1f4f9;
    
}
.assignment-form select:focus{
    border:none;
    border-bottom:2px solid #999;
    background:#e9edf2;

}
.assignment-form input{
    border:none;
    border-bottom:2px solid #999;
    background:#f1f4f9;
    
}
.assignment-form input:focus{
    border:none;
    border-bottom:2px solid #999;
    background:#e9edf2;

}
.assignment-form textarea{
    border:none;
    border-bottom:2px solid #999;
    padding-top:20px !important;
    /*padding-bottom:15px !important;*/
    background:#f1f4f9;
    /*color:#000 !important;*/
    
}
.assignment-form textarea:focus{
    border:none;
    border-bottom:2px solid #999;
    padding-top:20px !important;
    /*padding-bottom:15px !important;*/
    background:#e9edf2;
    /*color:#74767d;*/
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
                        <li ><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!--<li class="active"><a href="assignment.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Assignments</p></a></li>-->
                        <!--<li ><a href="material.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Notes</p></p></a></li>-->
                        <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <!--<li><a href="doubts.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Doubts</p></a></li>-->
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
        

                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3 >Create Assignment</h3>

                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
					<!--your code-->
					  <a class="btn btn-warning " type="submit" href="CreateAssignment.php">View Assignments</a>
                                <div class="panel panel-white " style="margin-top:10px;">
                                    <div class="panel-body">
                   <form class="assignment-form" action="" method="POST" enctype="multipart">
                       <div class="form-row">
                       <div class="col-md-12 form-group">
                           <input type="text" class="form-control titleinput" placeholder="Assignment Title" name="title" required/>
                       </div>
                       </div>
                       <div class="form-row">
                       <div class="col-md-12 form-group">
                           <textarea type="text" col="" name="desc" row="5" class="form-control" placeholder="Assignment Description" name="title" required> </textarea>
                       </div>
                       </div>
                       <div class="form-row">
                             <div class="form-group col-md-2">
                            <select  name="duetime" class="form-control" onchange="fetchtype(this.value);"/>
                                <option value="file" selected>File</option>
                                <option value="link" >Link</option>
                            </select>
                         </div>
                        
                         <div class="file form-group col-md-3" >
                              <input type="file" class="form-control" name="file" required/>
                         </div>
                           <div class="link form-group col-md-3" style="display:none;">
                               <input type="text" class="form-control" placeholder="Link of Assignment" name="link" required/>
                         </div>
                  
                   <div class=" form-group col-md-2" >
                              <select  name="assinstream" class="form-control" required/>
                                <option value=""  disabled selected>Stream </option>
                                <option value="all">CSE</option>
                                <option value="stuname1" >ECE</option>
                                <option value="stuname2" >CHE</option>
                                <option value="stuname3" >IPE</option>
                            </select>
                         </div>
                  
                         <div class="form-group col-md-2">
                            <select  name="assignto" class="form-control" required/>
                                <option value=""  disabled selected>Assign To </option>
                                <option value="all">All Students</option>
                                <option value="stuname1" >Ram</option>
                                <option value="stuname2" >Rahim</option>
                                <option value="stuname3" >Baba</option>
                            </select>
                         </div>
                          <div class="form-group col-md-1">
                           <input type="number" class="form-control" placeholder="Marks/Points" name="marks" required/>
                       </div>
                        <div class="form-group col-md-2">
                            <select  name="duetime" class="form-control" onchange="fetchdate(this.value);"/>
                                <option value="nodue">No Due Date</option>
                                <option value="due" >Due Date time</option>
                            </select>
                         </div>
                           <div class="dateform form-group col-md-2" style="display:none;">
                           <input type="datetime-local" class="form-control" placeholder="Due Date and Time" name="datetime"/>
                       </div>
                      
                       </div>
                       <br><br><br>
                        <div class=" col-lg-12">
                           <Button type="submit" class="btn btn-success">Assign The Assignment</button>
                       </div>
                       </form>
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
		function fetchdate(myval){
		   var x = document.querySelector('.dateform');
		   if(myval=="nodue"){
		       x.style.display="none";
		   }else if(myval=="due"){
		       x.style.display="block";
		   }
		}
		
		
			function fetchtype(myval){
		   var x = document.querySelector('.file');
		   var y = document.querySelector('.link');
		   if(myval=="file"){
		       x.style.display="block";
		       y.style.display="none";
		   }else if(myval=="link"){
		         x.style.display="none";
		       y.style.display="block";
		   }
		}
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