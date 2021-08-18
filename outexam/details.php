<?php


if(isset($_GET['eid'])){
    $id = $_GET['eid'];
}







?>
<html>
    
    
    <head><title>Exam | Details</title></head>
    <style>
     
     .Form{
         position:absolute;
         top:50%;
         left:50%;
         transform:translate(-50%,-50%);
         background:white;
         /*box-shadow:4px 8px 8px 4px rgba(0,0,0,0.5);*/
         border:1px solid black;
         border-radius:10px;
         width:500px;
         font-family:Monospace;
        
     } 
     .Form h3{
         
         text-align:center;
         font-size:20px;
     }
     .Form form{
         display:flex;
         flex-direction:column;
         width:80%;
         margin:auto;
         margin-bottom:50px;
     }
     .Form form input{
         margin-top:30px;
         border:none;
         border-bottom:1px solid black;
         height:40px;
         outline:none;
         font-size:25px;
        
     }
     .Form form button{
         width:50%;
         margin:auto;
         margin-top:50px;
         height:40px;
         font-size:25px;
         background:#6600cc;
         color:white;
         border-radius:10px;
         border-color:#6600cc;
         outline:none;
         cursor:pointer;
     }
        
    .Form form a{
        text-align:center;
        text-decoration:none;
    }
        
           @media only screen and (max-width:800px){
                .Form{
         position:absolute;
         top:50%;
         left:50%;
         transform:translate(-50%,-50%);
         background:white;
         /*box-shadow:4px 8px 8px 4px rgba(0,0,0,0.5);*/
         border:1px solid black;
         border-radius:10px;
         width:90%;
         font-family:Monospace;
        
     } 
     .Form h3{
         
         text-align:center;
         font-size:20px;
     }
     .Form form{
         display:flex;
         flex-direction:column;
         width:80%;
         margin:auto;
         margin-bottom:50px;
     }
     .Form form input{
         margin-top:30px;
         border:none;
         border-bottom:1px solid black;
         height:40px;
         outline:none;
         font-size:25px;
     }
     .Form form button{
         width:50%;
         margin:auto;
         margin-top:50px;
         height:40px;
         font-size:25px;
         background:#6600cc;
         color:white;
         border-radius:10px;
         border-color:#6600cc;
         outline:none;
         cursor:pointer;
     }
        
    .Form form a{
        text-align:center;
        text-decoration:none;
    }
        }
        
        
    </style>
    <body>
       <div> <img src="../logo.png" style="width:150px;"></div>
        <div class="Form">
            <h3>Fill Form To Give The Exam</h3>
            <form action="check.php?eid=<?php echo $id; ?>" method="post">
                 <input type="text" name="name" id="input1" placeholder="Enter Your Name" autocomplete="off"  required onfocusin="Call1(1)" >
                <input type="email" name="email" id="input2" placeholder="Enter Your Email" autocomplete="off" required onfocusin="Call1(2)" >
                <input type="text" name="rollno" id="input3" placeholder="Enter Your Roll No" autocomplete="off"required onfocusin="Call1(3)">
             
                
                <button type="submit" >Submit</button><br>
                <p style="text-align:center">Give Your Current Active Email For Responses</p>
            <a href="/" target="_blank">Visit Kendel</a>
                
            </form>
            
            
            
            
            
        </div>
        
        
        <script>
            
           function Call1(num){
               for(var i=1;i<=3;i++){
                   if(i==num){
                       document.querySelector('#input'+num).style.borderBottom = "3px solid green";
                   }else{
                        document.querySelector('#input'+i).style.borderBottom = "1px solid black";
                   }
               }
           }
            
            
            
            
            
        </script>
        
        
    
        
        
    </body>
    
    
    
    
</html>