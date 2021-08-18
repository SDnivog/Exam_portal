<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trando || Plans</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap" rel="stylesheet">
</head>
<style>
      .heading{
        font-family: Arial, Helvetica, sans-serif;
    }

.plan{
    background-color: whitesmoke;
    box-shadow: 0px 0px 3px grey;
    box-sizing: border-box;
    padding: 20px;
    /* height:500px; */
    transition: all 0.5s;
    /* position: relative; */
}
.plan:hover{
    box-shadow: 0px 0px 10px #7a6fbe;
     /*transform: scaleZ(1.1); */
}
input{
    border: none;
    padding: 7px 20px;
    background-color: #7a6fbe;
    color: #ffffff;
}
input:hover{
 background-color: #7a6fbf;
}
input:focus{
    outline: none;
}
.head{
    padding: 10px 12px;
    background-color: #099c77;
    color: white;
}
.head h2{
    font-size: 25px;
}
.plan ul li:first-child{
    padding: 10px ;
    /*background-color: #d6d6d6;*/
    font-size: 20px;
    color: #099c77;
    font-weight: 600;
    font-family: 'Roboto Slab', serif;
}
.plan ul li{
padding: 10px;
border-bottom: 1px solid #d7d7d7;
text-align: center;
color: #333;
font-family: 'Roboto Slab', serif;
font-weight: 600;
font-size: 18px;
}
.plan ul li:last-child{
    padding: 10px ;
    /*background-color: #d6d6d6;*/
    font-size: 20px;
    color: #099c77;
    font-weight: 600;
    font-family: 'Roboto Slab', serif;
}
</style>
<body>
<section class="plans">
   
    <div class="container mt-5 pt-5 ">
        <h1 class="text-center heading">Choose a plan of your choice</h1>
        <hr>
        <div class="row">
            <?php
            include 'database/config.php';
            $sql = "select * from tbl_plan";
            
            $result = $conn->query($sql);
            
            
            while($row = $result->fetch_assoc()) { 
            
        
            ?>
            
            
            <div class="col-md-4 mt-2 ">
              <div class="plan">

                        <h2 class="text-center"><?php  if($row['plan_name'] == "Free"){
                        
                        echo "TRY FOR FREE";
                        }else{
                            echo "PRO";
                        }
                        ?></h2>
                       
            
                    <ul class="list-unstyled ">
                        <li class="text-center"><?php echo $row['plan_name']; ?></li>
                         <li class="text-center">
                             <?php  if($row['plan_name'] == "Free"){
                        
                        echo "Get 15 Coins On Refer";
                        }else{
                            echo $row['plan_name'];
                        }
                        ?>
                             </li>
                       
                        
                        <li><a href="createclass.php?plan=<?php echo $row['plan_code']; ?>"><input type="submit" class="" value="Continue" id="demo0"></a></li>
                    </ul>
                    
              </div>
            </div>
            
            <?php } ?>
            
           
          
            
              
              
              
        </div>
          
    </div>
    


</section>

</body>
</html>