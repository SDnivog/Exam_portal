<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config_class.php';
session_start();
   date_default_timezone_set("Asia/Kolkata"); //You can chage time Zone As you wish
?>

<?php 
 $class_id = $_GET['class_id'];
 $stream = $_GET['stream'];

?>

<!DOCTYPE html>
<html>
   
<head>
        
        <title>Kendel | Manage Assignments</title>
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






.uploaded-file {
  margin-left: 20px;
  max-width: 340px;
  border: 1px solid #00000055;
  border-radius: 6px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

.uploaded-file img {
  width: 120px;
  border-radius: 6px 0 0 6px;
  border-right: 1px solid #00000055;
}

.uploaded-file .span-media-body {
  padding-left: 15px;
}

.item-box {
  padding: 15px 20px;

  background-color: #fff;
  max-width: 95%;

  border-radius: 4px;
  margin-bottom: 35px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
}

.item-box .profile-picture {
  height: 40px;
  width: 40px;
  margin-right: 18px;
  border-radius: 50%;
}

.item-box .top-menu {
  -webkit-box-flex: 1;
      -ms-flex: 1;
          flex: 1;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  /*margin-bottom: 15px;*/
}

.item-box .description {
  max-width: 650px;
  font-family: "Lato", sans-serif;
  font-size: 12px;
  line-height: 16px;
  letter-spacing: 0.02em;
  color: #1B263B;
}

.item-box .description p {
  margin-bottom: 25px;
}

.item-box hr {
  height: 1px;
  border: none;
  background-color: #1B263B88;
  width: calc(100% + 40px);
  margin-left: -20px;
}

.item-box .add-comment .profile-picture {
  height: 30px;
  width: 30px;
}

.item-box .add-comment .media-body {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

.item-box .add-comment .media-body .textarea-capsule {
  max-width: 630px;
  width: 100%;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  border: 1px solid #1B263B88;
  border-radius: 10px;
  padding: 5px 5px 5px 0;
}

.item-box .add-comment .media-body .textarea-capsule textarea {
  width: 100%;
  border: none;
  resize: none;
  border-radius: 10px;
  padding: 0 15px;
  font-size: 12px;
  font-family: "Lato", sans-serif;
  letter-spacing: 0.04em;
}

.item-box .add-comment .media-body .textarea-capsule textarea:focus, .item-box .add-comment .media-body .textarea-capsule textarea:active, .item-box .add-comment .media-body .textarea-capsule textarea:focus-visible {
  border: none;
  outline: none;
}

.item-box .add-comment .media-body .textarea-capsule button {
  border: none;
  outline: none;
  background-color: transparent;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  cursor: pointer;
}

.item-box .add-comment .media-body .textarea-capsule button img {
  width: 18px;
  height: 18px;
}

.item-box.new {
  display: block;
  -webkit-box-shadow: 0px 2px 20px rgba(54, 87, 151, 0.1);
          box-shadow: 0px 2px 20px rgba(54, 87, 151, 0.1);
}

.item-box.new #announce-box {
  -webkit-box-align: stretch;
      -ms-flex-align: stretch;
          align-items: stretch;
}

.item-box.new #announce-box .media-body {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}

.item-box.new #announce-box .media-body .action-div {
  width: 100%;
  display: none;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

.item-box.new #announce-box .media-body .action-div .dropdown-item {
  font-family: "Lato", sans-serif;
  font-weight: 500;
  font-size: 12px;
  letter-spacing: 0.02em;
  color: #1B263B;
}

.item-box.new #announce-box .media-body .action-div .btn {
  padding: 7px 12px;
  font-family: "Lato", sans-serif;
  font-weight: 700;
  font-size: 12px;
  text-align: center;
  letter-spacing: 0.02em;
  background: rgba(247, 248, 246, 0.7);
  border: 1px solid #838383aa;
}

.item-box.new #announce-box .media-body .action-div .btn img {
  display: inline-block;
}

.item-box.new #announce-box .media-body .action-div .btn:focus, .item-box.new #announce-box .media-body .action-div .btn:active {
  -webkit-box-shadow: none;
          box-shadow: none;
}

.item-box.new #announce-box .media-body .action-div .add-btn .btn .add-file-img-white {
  display: none;
}

.item-box.new #announce-box .media-body .action-div .add-btn .btn:hover, .item-box.new #announce-box .media-body .action-div .add-btn .btn:focus {
  background-color: #1B263B;
  color: #ffffff;
}

.item-box.new #announce-box .media-body .action-div .add-btn .btn:hover .add-file-img, .item-box.new #announce-box .media-body .action-div .add-btn .btn:focus .add-file-img {
  display: none;
}

.item-box.new #announce-box .media-body .action-div .add-btn .btn:hover .add-file-img-white, .item-box.new #announce-box .media-body .action-div .add-btn .btn:focus .add-file-img-white {
  display: inline-block;
}

.item-box.new #announce-box .media-body .action-div .add-btn .dropdown-item img {
  display: inline-block;
  margin-right: 10px;
}

.item-box.new #announce-box .media-body .action-div .btn-group .btn {
  background: #E5E5E5;
  border: none;
  color: #838383;
}

.item-box.new #announce-box .media-body .action-div .btn-group .btn.btn-focus {
  background-color: #1B263B;
  color: white;
}

.item-box.new #announce-box .media-body .action-div .btn-group .btn.btn-focus:nth-child(1)::after {
  background-color: #ffffff;
}

.item-box.new #announce-box .media-body .action-div .btn-group .btn:focus {
  -webkit-box-shadow: none;
          box-shadow: none;
}

.item-box.new #announce-box .media-body .action-div .btn-group .btn:nth-child(1) {
  position: relative;
  padding: 7px 7px 7px 12px;
}

.item-box.new #announce-box .media-body .action-div .btn-group .btn:nth-child(1)::after {
  content: '';
  display: block !important;
  position: absolute;
  right: 1px;
  top: 15%;
  height: 70%;
  width: 1px;
  background-color: #838383;
}

.item-box.new #announce-box .media-body .action-div .btn-group .btn:nth-child(2) {
  padding: 7px 12px 7px 7px;
}

.item-box.new #announce-box .media-body .action-div .cancel-btn {
  background-color: white;
  border: 1px solid #838383aa;
  color: #838383;
}

.item-box.new #announce-box .media-body textarea {
  width: 100%;
  resize: none;
  border: none;
  padding: 12px;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
}

.item-box.new #announce-box .media-body textarea::-webkit-input-placeholder {
  font-family: "Lato", sans-serif;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #838383;
}

.item-box.new #announce-box .media-body textarea:-ms-input-placeholder {
  font-family: "Lato", sans-serif;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #838383;
}

.item-box.new #announce-box .media-body textarea::-ms-input-placeholder {
  font-family: "Lato", sans-serif;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #838383;
}

.item-box.new #announce-box .media-body textarea::placeholder {
  font-family: "Lato", sans-serif;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #838383;
}

.item-box.new #announce-box .media-body textarea:focus, .item-box.new #announce-box .media-body textarea:active, .item-box.new #announce-box .media-body textarea:focus-visible {
  border: none;
  outline: none;
}

.item-box.new #announce-box.focused .action-div {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
}

.item-box.new #announce-box.focused img {
  display: none;
}

.item-box.new #announce-box.focused textarea {
  background-color: #F7F8F6;
  border-bottom: 1px solid #838383;
  border-radius: 4px;
  margin-bottom: 20px;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
}

.item-box.new #announce-box.focused textarea:focus, .item-box.new #announce-box.focused textarea:active, .item-box.new #announce-box.focused textarea:focus-visible {
  border-bottom: 1px solid #838383;
}

.item-icon {
  height: 36px;
  width: 36px;
  background: -webkit-gradient(linear, left top, left bottom, from(#1B263B), color-stop(158.33%, rgba(54, 87, 151, 0.8)));
  background: linear-gradient(180deg, #1B263B 0%, rgba(54, 87, 151, 0.8) 158.33%);
  border: 1px solid rgba(54, 87, 151, 0.8);
  border-radius: 50%;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  margin-right: 20px;
}

.item-icon img {
  position: relative;
  left: 1px;
  top: 1px;
  margin: 0;
  height: 16px;
  width: 16px;
}

.item-box.notes {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
  -webkit-box-shadow: 0px 2px 20px rgba(54, 87, 151, 0.1);
          box-shadow: 0px 2px 20px rgba(54, 87, 151, 0.1);
}

.item-box.notes .notes-main {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}

.item-box.notes a {
  font-family: "Lato", sans-serif;
  font-style: normal;
  font-weight: 500;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #1B263B;
}

.item-box.notes a:hover {
  text-decoration: none;
}

.flex1{
    display:flex;
    flex-direction: row;
    flex-wrap:wrap;
    align-items:center;
}


.posted-date{
    margin-right:15px;
    padding-top:5px;
}

.flex1 a {
  font-family: "Lato", sans-serif;
  font-style: normal;
  font-weight: 500;
  font-size: 14px;
  letter-spacing: 0.02em;
  color: #1B263B;
}

.flex1 a:hover {
  text-decoration: none;
}

.due-date{
    margin-left:50px;
    font-family: "Lato", sans-serif;
    font-style: normal;
    font-weight: 400;
    font-size: 12px;
    letter-spacing: 0.02em;
    color: #1B263B;
}

.span-height{
    border-right:2px solid #2B3D5E;
    height:60px 
}

.entry{
    position:absolute;
    right:10%;
    padding:10px;
}

.entry span{
    padding:10px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.number{
    font-family: "Lato", sans-serif;
    font-weight: 500;
    font-size: 34px;
    line-height: 41px;
    letter-spacing: 0.04em;
    color: #1B263B;
    margin-left:15px;
}

@media only screen and (max-width: 664px){

p{
font-size: 9px;
}

.item-box{
    padding: 8px;
}

.item-icon {
 height:25px;
 width:25px;
}

.item-icon img{
    height:12px;
}
  
.posted-date{
font-size:7px;  
margin-right:-2px;
}   

.flex1 a {
  font-weight: 400;
  font-size: 10px;
}
.flex1 p{
    font-size:8px;
}

.due-date{
    font-weight: 400;
    font-size: 9px;
    margin-bottom:10px;
}

.span-height{
    height:50px;
    margin-bottom:5px;
}

.entry span{
    padding-left:10px;
}

.number{
    font-weight: 400;
    font-size: 14px;
    line-height: 14px;
    letter-spacing: 0.02em;
    color: #1B263B;
    margin-left:5px;
}

.item-box hr {
    width: calc(88% + 40px);
    margin-left: 0px;
}

.uploaded-file img{
    width:85px;
}
    
}



.main{
   margin-top:20px;
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
                    <h3>Manage Live Class Schedule</h3>
<div><h4 style="font-weight:bold;" class="alert alert-<?php echo $_SESSION['type'];$_SESSION['type']=Null;?>"><?php echo $_SESSION['msg'];$_SESSION['msg']=Null;?></h4></div>
                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
					<!--your code-->
					  <button class="btn btn-warning mainbtn" style="margin-bottom:20px;" onclick="OpenCreate()">+ Create</button>
					  
                            <div class="alldata"> 
                            <?php
                            
                            $sql = "select * from live_class where teacher_id='$login_user_id' and class_id='$class_id' and department='$stream'";
                            
                            $result = $conn1->query($sql);
                            $srno=1;
                            
                            while($row = $result->fetch_assoc()){
                                
                          
                            
                            
                            ?>
                            
                            
                            
                    <div class="item-box">
                        <div class="top-menu">
                          
                            <div class="media">
                                <div class="notes-main flex1" onclick="Open(<?php echo $srno; ?>)">
                                    <div class="item-icon">
                                        <img src='images/writing.svg' alt="icon">
                                    </div>
                                    <a href="javascript:void(0)" id="t<?php echo $srno; ?>"><?php echo $row['title']; ?></a>
                                </div>
                            </div>
                            <div class="flex1">
                                <?php 
                                
                                if($row['edit_date'] == "0000-00-00"){
                            
                                ?>
                                <p class="posted-date" >Posted <?php  
                                $timestamp = strtotime($row['post_date']);  
                               
                                $DateTime = strftime("%B %d ",$timestamp);
                                
                                echo $DateTime;?></p>
                                
                                <?php } else { ?>
                                 <p class="posted-date" >Edited On <?php  
                                $timestamp = strtotime($row['edit_date']);  
                               
                                $DateTime = strftime("%B %d ",$timestamp);
                                
                                echo $DateTime;?></p>
                                <?php } ?>
                                
                            
                            <div class="dropdown">
                            <button   data-toggle="dropdown" style="display:flex; flex-direction:column: flex-wrap:wrap;background:none;outline:none;border:none" >
                                <img src="images/dots3.png">
                            </button>
                           <ul class="dropdown-menu">
                            <!--<li><a data-toggle="modal" data-target="#myModal" onclick="OpenModal(<?php echo $srno; ?>)">Edit</a> </li>-->
                            <li><a href="Delete_class/delete_liveclass.php?live_id=<?php echo $row['live_id']; ?>&class_id=<?php echo $class_id ?>&stream=<?php echo $stream; ?>">Delete</a></li>
                          
                          </ul>
                        </div>
                        </div>
                        </div>
                        <div style="
                        <?php 
                        
                        if($srno > 1){
                          echo "display:none";
                        }
                        
                        ?>
                        " id="main<?php echo $srno; ?>" class="main">
                            
                        <div style="margin-left:55px;">
                            <p id="c<?php echo $srno; ?>"> <?php 
                               $timestamp = strtotime($row['class_time']);  
                               $DateTime = strftime("%d %B,%Y  %H: %M %p",$timestamp);
                               echo "<b>Class Scheduled On :</b> ".$DateTime; 
                               ?>
                            </p>
                            <p id="p<?php echo $srno; ?>"><b>Joining Password :</b> <?php echo $row['description']; ?></p> 
                            <p id="p<?php echo $srno; ?>"><b>Class duration :</b> <?php echo $row['link']; ?>&nbsp;Min.</p>
                            <p id="p<?php echo $srno; ?>"> <a href="<?php echo $row['join_link']; ?>" class="btn btn-primary" target="_blank" id="l<?php echo $srno; ?>">Join Now !</a> </p>
                        
                        </div>
                     
                                
                                  
                        

                     

                    </div>
                     </div>  
                      <div id="M<?php echo $srno; ?>" style="display:none"><?php echo $row['live_id']; ?></div>
                  
                    
                    <?php  $srno++; } ?>
                    </div>
                    
                
                    
                    
                    
                     <div class="panel panel-white formpage" style="margin-top:10px;display:none">
                                    <div class="panel-body">
                                        <h2 class="text-center">Add Class Schedule </h2>
                   <form class="assignment-form" action="Insertliveclass.php?class_id=<?php echo $class_id; ?>&stream=<?php echo $stream; ?>" method="POST" enctype="multipart/form-data">
                       <div class="form-row">
                       <div class="col-md-12 form-group">
                           <input type="text" class="form-control titleinput" placeholder="Meeting Topic" name="title" required/>
                       </div>
                       </div>
                       <div class="form-row">
                       <div class="col-md-3 form-group">
                           <input type="password" class="form-control" placeholder="Meeting password" name="description" required/>
                        <!--<textarea type="text" col=""  name="description" row="5" class="form-control" placeholder="Class description (optional)"  required>  </textarea>-->
                       </div>
                       </div>
                        <div class="dateform form-group col-md-3" >
                           <input type="datetime-local" class="form-control" placeholder="Class Date and Time" name="datetime" required/>
                       </div>
                     <div class="form-group col-md-3">
                         <select name="platform" class="form-control" required>
                             <option value="zoom">Zoom</option>
                         </select>
                       </div>
                         
                       <div class="form-group col-md-3">
                           <input type="number" class="form-control" placeholder="Meeting duration (in min.)" name="link" required/>
                       </div>
                       
                          
                       <div class="form-group col-lg-12">
                           <button type="submit" class="btn btn-success " name="submit">Create Live Class</button>
                       </div>
                       </div>
                       
                       
                       </form>
                    </div>
                </div>
                    
                    
					
					<!--End Code  -->
					<!--<h1>Hello world<h1>-->
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


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Live Class Schedule Data</h4>
        </div>
        <div class="modal-body" style="background:white">
        <!--<h1>Since PHP 5.2.2 it is possible, to capture a website with PHP solely! ... Both are console tools that u can utilise from your web app to get the screenshot. ... Free, open source, scroll to bottom of page for links to documentation, ...</h1>-->
        
        
          <form  class="assignment-form" id="formdata" action="" method="POST" enctype="multipart/form-data">
                       <div class="form-row">
                       <div class="col-md-12 form-group">
                           <input type="text" class="form-control titleinput" placeholder="Class Schedule Title" name="etitle" id="title" required/>
                       </div>
                       </div>
                       <div class="form-row">
                       <div class="col-md-12 form-group">
                        <textarea type="text" col=""  name="edescription" row="5" class="form-control" id="description" placeholder="Class description (optional)"  required>  </textarea>
                       </div>
                       </div>
                     <div class="form-group col-md-12">
                         <select name="eplatform" class="form-control" required id="platform">
                             <option value="zoom">Zoom</option>
                             <option value="gmeet">Google Meet</option>
                             <option value="other">Other</option>
                         </select>
                       </div>
                         
                       <div class="form-group col-md-12">
                           <input type="text" class="form-control" placeholder="CLass Link" id="link" name="elink" required/>
                       </div>
                       
                           <div class="dateform form-group col-md-12">
                           <input type="datetime-local" class="form-control"  placeholder="Class Date and Time" name="edatetime"/>
                       </div>
                       <div class="form-group col-lg-12">
                           <button type="submit" class="btn btn-success " name="submit">Edit Live Class</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        
                           
                       </div>
                       
                       
                       
                       </form>
       
                       </div>
                         
         <button  type="button"   class="btn btn-danger"  style="opacity:0"></button>
        
        </div>
      
      </div>
      
    </div>
  <!--</div>-->


 
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
		
		
		function OpenModal(id){
		    
		    var title = document.querySelector('#t'+id).innerHTML;
		        var description = document.querySelector('#d'+id).innerHTML;
		    var link = document.querySelector('#l'+id).innerHTML;
		    var platform = document.querySelector('#p'+id).innerHTML;
		    
		    var live_id = document.querySelector('#M'+id).innerHTML;
		    
		    var url = "Editliveclass.php?id="+live_id+"&class_id="+"<?php echo $class_id ?>"+"&stream="+"<?php echo $stream ?>";
		    
		  
		    
		    if(platform == "Zoom"){
		        var x = ' <option value="zoom" selected>Zoom</option><option value="gmeet">Google Meet</option><option value="other">Other</option>';
		    }else if(platform == "gmeet"){
		        var x = ' <option value="zoom" >Zoom</option><option value="gmeet" selected>Google Meet</option><option value="other">Other</option>';
		    }else {
		        var x = ' <option value="zoom" >Zoom</option><option value="gmeet" >Google Meet</option><option value="other" selected>Other</option>';
		    }
		    
		    
		    document.querySelector('#title').value=  title;
		     
		      document.querySelector('#description').value=  description;
		      document.querySelector('#link').value=  link;
		       document.querySelector('#platform').innerHTML = x;
		       
		       document.querySelector('#formdata').setAttribute("action", url);
		     
		    
		    
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
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
		  // if(myval=="nodue"){
		  //     x.style.display="none";
		  // }else
		   if(myval=="due"){
		      // x.style.display="block";
		      x.innerHTML = '<input type="datetime-local" class="form-control" placeholder="Due Date and Time" name="datetime"/>';
		   }
		
		}
		
		
			function fetchtype(myval){
		  // var x = document.querySelector('.file');
		  // var y = document.querySelector('.link');
		  // if(myval=="file"){
		  //     x.style.display="block";
		  //     y.style.display="none";
		  // }else if(myval=="link"){
		  //       x.style.display="none";
		  //     y.style.display="block";
		  // }
		    var x = document.querySelector('.file');
		  if(myval == "link"){
		      x.innerHTML = '<input type="text" class="form-control" placeholder="Link of Assignment" name="links"/>';
		  }else if(myval == "file"){
		      x.innerHTML = '<input type="file" class="form-control" name="filename"/>';
		  }
		}
		
		
			function OpenCreate(){
		     var x = document.querySelector('.formpage');
		     var y = document.querySelector('.alldata');
		      var z = document.querySelector('.mainbtn');
		    if(x.style.display == "none"){
		       
		        x.style.display="block";
		        y.style.display="none";
		        z.innerHTML= "Close";
		        z.className="btn btn-danger mainbtn";
		    }else{
		        x.style.display="none";
		        y.style.display="block";
		        z.innerHTML= "+ Create";
		        z.className="btn btn-warning mainbtn";
		    }
		}
		
		
		function Open(id){
		    var x = document.querySelector('#main'+id);
		    if(x.style.display == "none"){
		       
		        x.style.display="block";
		    }else{
		        x.style.display="none";
		    }
		}
		
		
		
		
		
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