<?php 

include 'mainpage.php';

?>


<div class="app-main__outer mt-2" id="mainbody">
    <form action="" method="post">
        <div class="searchform ">
        <div class="form-group d-flex ml-4 mr-4">
            <input type="text" class="form-control" placeholder="Enter The Student Id">
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
                                                <th class="text-center">Student Id</th>
                                                <th>Name</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center"> Admin Status</th>
                                                <th class="text-center">Actions</th>
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
    var student = "student";
    $.ajax({
        url:'ajax/fetchalluser.php',
        type:'post',
        data:{
            mainid:student
        },
        success:function(data){
            $('.tablebody').html(data);
        }
    })
}



function Checkadminstatus(id,status){

    var student_id = document.getElementById("student"+id).innerHTML;
    $.ajax({
        url:'ajax/userstatus.php',
        type:'post',
        data:{
            id:student_id,
            status:status
        },
        success:function(data){
            fetchbody();
        }
    })
}



function details(id,whois){
    var admin_id =document.getElementById("student"+id).innerHTML;
    $.ajax({
        url:'ajax/fetchparticularstudent.php',
        type:'post',
        data:{
            data_id:admin_id,
            whois:whois
        },
        success:function(data){
            $('#mainbody').html(data);
        }
    })

}







    
</script>



                                    </body>
                                    </html>





