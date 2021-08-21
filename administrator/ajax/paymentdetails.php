<?php
include '../../database/config.php';

extract($_POST);


if(isset($user_data)){
   
  $sql = "select * from tbl_users where user_id='$user_data'";
  $result = $conn->query($sql);
  $arr = $result->fetch_assoc();
  
  


$form = '
<h4 class="text-center text-primary">Payment Details</h4>
<form action="" method="post"style="width:50%; margin:0px 100px ;" enctype="multipart/form-data">

<div class="row">
<div class="col-lg-9 col-md-9 col-xl-9" >

<div class="form-group">
<label for="" class="">Admin Id :</label>
<input type="text" class="form-control" value='.$user_data.' readonly >

</div>
<div class="form-group">
<label for="" class="">Admin Name :</label>
<input type="text" class="form-control" value='.$arr['first_name'].$arr['last_name'].' readonly name="fname">

</div>
<div class="form-group">
<label for="" class="">Admin Email :</label>
<input type="text" class="form-control" value='.$arr['email'].' readonly name="email">

</div>
<div class="form-group">
<label for="" class="">Admin Phone :</label>
<input type="text" class="form-control" value='.$arr['phone'].' readonly name="phone">

</div>
<div class="form-group">
<label for="" class="">Admin Bank :</label>
<input type="text" class="form-control"  placeholder="Bank Name" name="bname" name="id" required autocomplete="off">

</div>
<div class="form-group">
<label for="" class="">Payment UTR No :</label>
<input type="text" class="form-control"  placeholder="Paymeny UTR No" name="utr" name="id" required autocomplete="off">

</div>
<div class="form-group">
<label for="" class="">Payment Amount :</label>
<input type="text" class="form-control"  placeholder="Paymeny Amount" name="amount" name="id" required autocomplete="off">

</div>

</div>
<div class="col-lg-3 col-md-3 ">
<div class="form-group">
<label for="" class="">Payment Receipt :</label>
<input type="file" class="btn btn-primary"  placeholder="Paymeny Amount" name="file" id="image" onchange="previewimg()" name="id" required autocomplete="off">

</div>



<div class="preimg">


</div>


</div>

<button class="btn btn-primary" name="button">Make Active</button>
</div>

</form>




';


echo $form;
}




?>