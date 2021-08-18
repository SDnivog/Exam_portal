<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';


?>
<!DOCTYPE html>
<html>
<head>
        
        <title>Trando | Manage Streams</title>
        <style>
            
            .qpackage{
                width:100%;
                background:white;
                box-shadow:1px 1px 8px -4px #999;
                padding: 5px 10px 10px 10px;
                margin-bottom:25px;
            }
            .qpackage .head h3{
                font-size:24px;
            }
            #subject{
                text-decoration:none;
            }
            #subject:hover{
                text-decoration:none;
            }
            .qpackage .footer ul li{
         display:inline;
            }
            
            .responsive-table{
                width:100%;
                height:500px;
                overflow-y:auto;
            }
            .responsive-table1{
                width:100%;
            }
            .responsive-table1 li{
                  width:100%;
                box-shadow:0px 4px 0px 4px rgba(0,0,0,0.04);
                list-style:none;
                display:flex;
                align-items:center;
                justify-content:space-around;
                padding:30px;
                margin:10px 0px;
            }
            .responsive-table li{
                width:100%;
                box-shadow:0px 4px 0px 4px rgba(0,0,0,0.04);
                list-style:none;
                display:flex;
                align-items:center;
                justify-content:space-around;
                padding:30px;
                margin:10px 0px;
            }
            .responsive-table li:first-child{
                 background-color: #95A5A6;
            }
            
            .option{
                display:flex;
                flex-direction:row;
            }
            .col{
                width:16.66%;
            }
            .col img{
                width:100%;
            }
            .col1{
                width:33.32%;
            }
            .col1 img{
               width:100%; 
            }
           
   
            
        </style>
        </head>
            <?php include 'header.php'; ?>
                    <ul class="menu accordion-menu">
                        <li><a href="./index" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Streams</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Classes</p></a></li>
                        <!--<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>-->
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <li class="active"><a href="qbank.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Question Bank</p></a></li>
                        <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li>
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Question Bank</h3>
                </div>
               
                <div id="main-wrapper" >
                    <div class="row">
                        <div class="col-md-12">
                                <div class="panel panel-white">
                                        <div role="tabpanel">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#my" role="tab" data-toggle="tab">My Library</a></li>
                                                <li role="presentation"><a href="#live" role="tab" data-toggle="tab">Online Library</a></li>
                                            </ul>

                                            <div class="tab-content">
                                                <!--added question-->
                                                
                                                
                                                <div role="tabpanel" class="tab-pane active fade in" id="my">
                                                
                                                     <div class="container-fluid">
                                                         <div class="row">
                                                             <div class="container">
                                                                 <h3 style="text-align:center"> Your Add Questions</h3>
                                                                 <ul class="responsive-table1" id="addquestion">
                                                                     <li>
                                                                         <p>No Question Added</p>
                                                                     </li>
                                                                     <div id="buttonbtn" style="display:none">
                                                                         <button type="submit"> Create Exam</button>
                                                                         <button type="submit">Add To Existing Exam</button>
                                                                     </div>
                                                                 </ul>
                                                                 
                                                             </div>
                                                            
                                                            <div class="container">
                                                                  <ul class="responsive-table">
                                                                    <li class="table-header">
                                                                      <div class="col col-1">Sr No</div>
                                                                      <div class="col col-2">Question</div>
                                                                      <div class="col col-3">Question Image</div>
                                                                      <div class="col col-4">Options</div>
                                                                       <div class="col col-4">Answer</div>
                                                                       <div class="col col-4">Show Action</div>
                                                                       
                                                                    </li>
                                                                    <?php
                                                                        
                                                                        $sql = "select * from tbl_questions where user_id='$login_user_id'";
                                                                        $result = $conn->query($sql);
                                                                        $i=1;
                                                                        
                                                                        while($row = $result->fetch_assoc()){
                                                                    
                                                                    
                                                                    
                                                                    ?>
                                                                    <li class="table-row" id="questiondata<?php echo $i; ?>">
                                                                      <div class="col col-1"><?php echo $i; ?></div>
                                                                      <?php
                                                                      if(!empty($row['question']) and !empty($row['image'])){
                                                                      ?>
                                                                      
                                                                      <div class="col col-2" id="question<?php echo $i; ?>"><?php echo $row['question']; ?></div>
                                                                      <div class="col col-3"><?php 
                                                                      if(!empty($row['image'])){
                                                                          echo "<img src='pages/".$row['image']."' id='questionimage".$i."'>";
                                                                      }
                                                                      ?>
                                                                      
                                                                      </div>
                                                                      <?php }else {?>
                                                                      
                                                                       <div class="col1 col-2" id="question<?php echo $i; ?>"><?php echo $row['question']; ?></div>
                                                                      <div class="col1 col-3"><?php 
                                                                      if(!empty($row['image'])){
                                                                          echo "<img src='pages/".$row['image']."' id='questionimage".$i."'>";
                                                                      }
                                                                      ?>
                                                                      
                                                                      </div>
                                                                      
                                                                      <?php } ?>
                                                                      <div class="col col-4" id="option<?php echo$i; ?>"><?php 
                                                                      for($j=1;$j<=4;$j++){
                                                                          echo "<p id='options".$i."'>".$j.") ".$row['option'.$j]."</p>";
                                                                      }
                                                                      
                                                                      ?></div>
                                                                       <div class="col col-4" id="answer<?php echo $i; ?>"> <?php
                                                                       $x = $row['answer'];
                                                                       echo $row[$x]; ?></div>
                                                                       <div class="col col-4"><button type="button" onclick="AddQuestion(<?php echo $i; ?>)">Add</button></div>
                                                                    </li>
                                                                    <?php $i++;} ?>
                                                                   
                                                                  </ul>
                                                                </div>
                                                             
                                                            
                                                         </div>
                                                     </div>
                                                </div>
                                                
                                                
                                                <div role="tabpanel" class="tab-pane fade" id="live" >
                                                  <div class="container-fluid">
                                                         <div class="row">
                                                             <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjectof1">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Physics</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                                <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjectof2">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Chemistry</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                                <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjectof3">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Mathematic</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                                <div class="col-md-3 subjectlink mt-2 ">
                                                               <a href="" id="subjectof4">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Gk</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                               <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subjectof5">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>Social Science</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
                                                             </div>
                                                               <div class="col-md-3 subjectlink mt-2">
                                                               <a href="" id="subject">
                                                                 <div class="qpackage card text-center">
                                                                    <div class="head border-bottom">
                                                                        <h3>English</h3>
                                                                    </div>
                                                                    <div class="body" style="width:100%;overflow:hidden;">
                                                                         <img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg" style="width:100%;">
                                                                    </div>
                                                                     <div class="footer">
                                                                        <h4 class="float-left">Total Questions:45</h4>
                                                                    </div>
                                                                 </div>
                                                               </a>
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
      <div id="pageContent">
    
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

var count=0;

function AddQuestion(id){
    // var question = document.getElementById("question"+id).innerHTML;
    //  var questionimage = document.getElementById("questionimage"+id).innerHTML;
    //   var questionoption = document.getElementById("option"+id).innerHTML;
    //   var answer = document.getElementById("answer"+id).innerHTML;
      
      var question = document.getElementById("questiondata"+id).innerHTML;
      
     if(count == 0){
          document.getElementById('addquestion').innerHTML = '<li class="table-row">'+question+'</li>';
          
     }else{
         document.getElementById('addquestion').innerHTML += '<li class="table-row">'+question+'</li>'; 
     }
     
    //  document.getElementById('buttonbtn').style.display = "block";
      
      count++;
     
      
       
      
}







		
		
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>