<?php

include '../database/config.php';

session_start();
if(isset($_GET['eid'])){
    $exam_id = $_GET['eid'];
    $sql = "select * from tbl_examinations where exam_id='$exam_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $data = $_SESSION['data'];
    
}

?>
<html>
    <head>
        <title>Kendel | Exam</title>
        <style>
            .body_start{
                position:absolute;
                left:48%;
                transform:translate(-50%,0%);
                top:35%;
                /*height:250px;*/
                /*display:flex*/
            }
            .body_start p{
                margin:15px;
                font-size:30px;
                color:#1b263b;
            }
            .body_start1 {
                display:flex;
                justify-content:center;
                position:relative;
            }
            .body_start1 p{
                margin-right:10px;
                height:80px;
                width:80px;
                background-color:green;
                color:#fff;
                display:flex;
                justify-content:center;
                align-items:center;
                border-radius:50%;
                font-size:24px;
                font-weight:700;
            }
        </style>
    </head>
    <body>
        <?php if(isset($_SESSION['data']) and $_SESSION['data'] == "noactive"){ ?>
        <div class="body_start">
            <div style="text-align:center">
                <p style="color:green;font-size:45px">Sorry Geek!!!</p>
                <p  id="noactive">This Exam Is Not Active</p>
             <p style="color:green;font-size:18px">Please Contact to Your Teacher</p>
            </div>
        </div>
        <?php } 
        else if(isset($_SESSION['data']) and $_SESSION['data']=="date"  or $_SESSION['data']=="time")
        {?>
        <div class=" body_start" id="time" style="text-align:center">
             <input type="hidden" id="exam_id" value="<?php echo $exam_id ?>">
            <h1>Time Remaining To Start Exam </h1>
        <div class="body_start1">
             <p id="days"></p>
         <p id="hours"></p>
         <p id="min"></p>
         <p id="sec"></p>
        </div>
        </div>
        <?php }else { ?>
            <p>$404 Error Found </p>
            <?php } ?>
        <script>
            
    // code for fetching how much time is remaining
	   
    
   window.onload = function(){
     
       
       
       
      var countDownDate = new Date("<?php echo $row['edate']; ?>").getTime();
     
      var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        // alert(distance);
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Display the result in the element with id="demo"
        document.getElementById("days").innerHTML = days+ " D";
        document.getElementById("hours").innerHTML = hours+ " H";
        document.getElementById("min").innerHTML = minutes+ " M" ;
        document.getElementById("sec").innerHTML = seconds + " S";
        // If the count down is finished, write some text
        if (distance < 0) {
          var exam_id = document.querySelector('#exam_id').value;
          window.open('http://kendel.trando.co/outexam/details.php?eid='+exam_id,target="_parent");
            clearInterval(x);
        }
        },1000);
        
        
        
        
        }
          
            
            
            
            
            
        </script>
      
    </body>
</html>