<?php

include 'mainpage.php';

extract($_POST);

session_start();

$username =  $_SESSION['super_admin'];
if(isset($buttonpass)){
 
    if($pass == $cpass){
        $passwords = md5(mysqli_real_escape_string($conn,$pass));
        $sql = "update superadmin set password='$passwords' where username='$username'";

        $result=$conn->query($sql);
        if($result){
            $msg = "Password Updated Successfully";
            $color = 'bg-success';
        }
        else{
            $msg = "Something Went Wrong";
            $color = 'bg-danger';
        }
    }
    else{
        $msg= "Password Does Not Matched";
        $color = 'bg-danger';
    }


}


if(isset($buttoncreate)){
    $supernew = mysqli_real_escape_string($conn,$supernew);
    $character = mysqli_real_escape_string($conn,$character);
    

$sql2 = "select * from superadmin where username='$supernew'";

$result2 = $conn->query($sql2);

if($result2->num_rows>0){
$msg1 = "Super Admin Created Already";
$color1 = "bg-danger";
 
}
else{
       if($pass1 == $cpass1){
           $password = md5(mysqli_real_escape_string($conn,$pass1));
    $sql1 = "insert into superadmin values('0','$supernew','$password','$character')";
    $result1= $conn->query($sql1);
    if($result1){
        $msg1="Super Admin Created Successfully";
        $color1 = "bg-success";
    }
    else{
        $msg1 ="Password Does Not Matched";
        $color1 = "bg-danger";  
    }
    }
}









}






?>


<div class="app-main__outer mt-2" id="mainbody">
<div class="app-main__inner bg-white">
                        <div class="row">
                            <div class="col-md-6 col-xl-6">

                                <div class="msg text-center <?php echo $color; ?> p-2"><?php echo $msg; ?>
                                </div>



                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" style="width:50%;margin:0px auto">
<h4 class="text-center text-primary">Password Change</h4>
<div class="form-group">
<label for="" class="">Change Password :</label> 
<input type="password" class="form-control"  name="pass" placeholder="Change Password" required>

</div>
<div class="form-group">
<label for="" class="">Confirm Password :</label> 
<input type="password" class="form-control"  name="cpass" placeholder="Confirm Password" required>

</div>




<button class="btn btn-primary" name="buttonpass">Change</button>


</form> 
                            </div>
                            <div class="col-md-6 col-xl-6">

                            <div class="msg1 text-center <?php echo $color1; ?> p-2"><?php echo $msg1; ?>
                                </div>
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" style="width:50%;margin:0px auto">
<h4 class="text-center text-primary">Add New Super Admin</h4>
<div class="form-group">
<label for="" class="">New Super Admin Name :</label>
<input type="text" class="form-control"   name="supernew" placeholder="Super Admin Name" autocomplete="off" required>

</div>
<div class="form-group">
<label for="" class="">Password :</label>
<input type="password" class="form-control"  name="pass1" placeholder="Password" autocomplete="off" required>

</div>
<div class="form-group">
<label for="" class="">Confirm Password :</label> 
<input type="password" class="form-control"  name="cpass1" placeholder="Confirm Password" autocomplete="off" required>

</div>
<select class="form-control mb-4" required name="character">
<option value="" disabled selected>Select Super Admin Type</option>
<option value="mainsuperamdin">Main Super Admin</option>
<option value="normalsuperadmin">Normal Super Admin</option>
</select>

<button class="btn btn-primary" name="buttoncreate">Create</button>


</form></div>

</div>



<script>








</script>