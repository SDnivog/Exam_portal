<?php include 'mainpage.php'; 


if(isset($_POST['button']) and isset($_FILES['file'])){

    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bname = $_POST['bname'];  
    $utr = $_POST['utr'];
    $amount = $_POST['amount'];
    $file = $_FILES['file'];
    $filename = $file['name'];
    $des = "upload/".$filename;

    if(!empty($id) and !empty($fname) and !empty($email) and !empty($phone) and !empty($bname) and !empty($utr) and !empty($amount)){


    $sql1 ="select * from tbl_payment where admin_id='$id' and utr='$utr' and amount='$amount'";

    $result1=$conn->query($sql1);

    if($result1->num_row>0){

    }else{

    $sql = "insert into tbl_payment values('0','$id','$fname','$email','$phone','$bname','$utr','$amount','$des')";

    $result = $conn->query($sql);
        if($result){
          move_uploaded_file($file['tmp_name'],$des);
            $sql2 = "update tbl_users set acc_stat=1 where user_id='$id'";
            $result2=$conn->query($sql2);
        }


    }
}




}





?>


<div class="app-main__outer mt-2" id="mainbody">
    <form action="" method="post">
        <div class="searchform ">
        <div class="form-group d-flex ml-4 mr-4">
            <input type="text" class="form-control" placeholder="Enter The Admin Id">
            <button class="btn btn-dark" type="button">Search</button>
        </div>
   
        </div>
    </form>

    <div class="maincontainer m-2 bg-white">
        <div class="tables m-4">
    <div class="table-responsive">
     <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Admin Id</th>
                                                <th class="text-center">Admin Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center"> Admin Status</th>
                                                <th class="text-center">Company Name</th>
                                                

                                            </tr>
                                            </thead>
                                           
                                            <tbody class="tablebody">
                                           
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    </div>






</div>


<script>
fetchbody();

function fetchbody(){
    var admin = "admin";
    $.ajax({
        url:'ajax/usernotifications.php',
        type:'post',
        data:{
            mainid:admin
        },
        success:function(data){
            $('.tablebody').html(data);
        }
    })
}

function openpayment(id){
    var x = document.getElementById("admin"+id).innerHTML;
    $.ajax({
        url:'ajax/paymentdetails.php',
        type:'post',
        data:{
            user_data:x
        },
        success:function(data){
            $('#mainbody').css("background","white")
            $('#mainbody').html(data);
        }
    })
}


function previewimg(){
    var imagename = document.getElementById('image').files[0];
      var formdata = new FormData();
        formdata.append('file',imagename);
       
        $.ajax({
            url:"upload.php",
            type:"POST",
            data:formdata,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
            $('.preimg').html(data);
        
            },
        });
      
        

}




</script>