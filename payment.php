<?php

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap" rel="stylesheet">
</head>
<style>
.page{
    margin: 80px auto;
    height:auto;
    color:#099c77;
    padding:20px;
    background-color:whitesmoke;
    box-shadow: 0px 0px 8px grey;
}
.in{
border-radius: 0px;

}
.in:focus{
    box-shadow: none;
    border: 1px solid #099c77;
}
input[type=submit]{
    width: 100%;
    background-color: #099c77;
    border: none;
    padding: 6px 20px;
    color: white;
    font-weight: bold;
}
input[type=submit]:hover{
    box-shadow: 0px 0px 6px grey;
}
</style>
<body>

<div class="container page">

<div class="row">
    <div class="col-md-4 p-3 pb-4">
<img src="paymentbarcode.jpeg" alt="" style="width:100%">
    </div>
    <div class="col-md-4">
<h4 class="text-center text-weight-bold pt-5">TOTAL AMOUNT</h4>
<h3 class="text-center text-dark">&#x20B9; <?php

if($_SESSION['plan'] =="Basic"){
    $amount = 5*$_SESSION['no_attempt'];
    echo $amount;
}else if($_SESSION['plan'] =="Pro"){
    echo 4000;
}

?></h3>
<h4 class="text-center text-weight-bold" >TIME PERIOD </h4>
<h3 class="text-center text-dark"><?php
if($_SESSION['plan'] =="Basic"){
    $amount = "No Of Attempt ".$_SESSION['no_attempt'];
    echo $amount;
}else if($_SESSION['plan'] =="Pro"){
    echo "1 MONTH";
}

?>
</h3>
    </div>
    <div class="col-md-4 pt-5 p-4 ">
        <form action="pages/paymentdetails.php" method="POST" enctype="multipart/form-data">
            <h3 class="text-center py-2 text-uppercase text-weight-bold">Please fill this form After Payment</h3>
            <div class="form-group">
                <input type="file" name="recipt" id="recipt" class="form-control in" required>
            </div>
             <div class="form-group">
                 <input type="number" name="phone" id="phone" class="form-control in" placeholder="Payment Mobile No" required> 
            </div>
            <div class="form-group">
                <input type="text" name="reciptno" id="reciptno" class="form-control in" placeholder="transition id.." required>
            </div>
            <div class="form-group">
                 <input type="number" name="amount" id="amount" class="form-control in" placeholder="Amount" required> 
            </div>
            
            <div class="form-group">
                  <input type="submit" name="payment" id="payment" class="form-controm" value="Complete Payment">
            </div>
        </form>
    </div>
</div>
</div>


</body>
</html>