<?php 
session_start();
include 'database/config.php';

$user_id = $_GET['id'];


$sql = "select * from tbl_users where user_id='$user_id'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();


$plan_id = $row['plan'];


$sql1 = "select * from tbl_plan where plan_code='$plan_id'";

$result1 = $conn->query($sql1);

$row1 = $result1->fetch_assoc();












// if (!isset($_GET['plan'])) {
//   Redirect_to("plancard.php");
// }

 ?>
<!-- fetch products from database -->

<html>
  <head>
    <title> Kendel | Payment </title>
    <!--<link rel="stylesheet" type="text/css" href="../css/main.css">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" >
        <meta name="viewport" content="width=device-width,inital-scale=1.0">
        <!--<link rel="stylesheet" href="../../assets/style.css">-->
        <link rel="stylesheet" href="../../css/style.css">
        <!--<link rel="stylesheet" href="../../css/course_style.css">-->
<link rel = "icon" href ="../../img/icon.png"
type = "image/x-icon">
    <script src="https://kit.fontawesome.com/96ab48350d.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
    <style>
      .razorpay-payment-button {
        color: #ffffff !important;
        background-color: #7266ba;
        border-color: #7266ba;
        font-size: 14px;
        padding: 10px;
        float: right;
      }
    </style>
  </head>
  <body>
<div class="container py-5">
    <div class="row">
      <div class="col-lg-12 py-5 mt-3">     
 <h4>Your Payment Details</h4>

     <table class="table table-bordered">
  <tbody>
  <?php 
              
           
            include '../database/config.php';
           
            
            
           $Id = random_bytes('10'); 
         
            $razor_api_key = "rzp_live_QXofKx6un096to";
       ?>
  
     <th scope="row">Plan  Name</th>
      <td><?php echo $row1['plan_name']; ?></td>
    </tr>
    <tr>
      <th scope="row">Price</th>
      <td><?php echo  $row1['plan_amount']; ?></td>
    </tr>
     
  </tbody>
</table>
 

    <form action="ChangePaymentStatus.php" method="POST">
     <!-- Note that the amount is in paise = 50 INR -->
  
     
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?php echo $razor_api_key; ?>"
        data-amount="<?php echo ($row1['plan_amount'])*100; ?>"
        data-buttontext="Procced to pay"
        data-name="Kendel"
        data-description="<?php echo $row['plan_name'];?>"
        data-prefill.name="Kendel"
        data-prefill.email="example@gmail.com"
        data-theme.color="#37c22e"
    ></script>

    <input type="hidden" value = "<?php echo $user_id; ?>" name="user_id">
    <input type="hidden" value="<?php echo $row1['plan_code']; ?>" name="Plan">
    <input type="hidden" value="Hidden Element" name="hidden">
    
    
    
    </form>
 


   </div>
</div>
</div>  


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../../js/index.js"></script>
  </body>
</html>