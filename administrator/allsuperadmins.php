<?php

include 'mainpage.php';
include '../database/config.php';

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
                                                <th class="text-center">Super Admin Id</th>
                                                <th class="text-center">Super UserName</th>
                                                <th class="text-center">Super Admin Category</th>
                                                <th class="text-center">Delete</th>
                                                
                                                

                                            </tr>
                                            </thead>
                                            <tbody class="tablebody">
                                           <?php 
                                           $sql = "select * from superadmin";
                                           $result = $conn->query($sql);
                                           
                                           while($row = $result->fetch_assoc()){
                                           
                                           ?>
                                            
                                           <tr>
                                           <td class="text-center"><?php echo $row['super_id']; ?></td>    
                                             <td class="text-center"><?php echo $row['username']; ?></td>       
                                                <td class="text-center"><?php echo $row['character_admin']; ?></td>    
                                                 <td class="text-center"><button class="btn btn-danger">Delete</button></td>   
                                               
                                           </tr>
                                           <?php
                                           }
                                           ?>
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
        url:'ajax/fetchallsuperadmin.php',
        type:'post',
        data:{
            mainid:admin
        },
        success:function(data){
            $('.tablebody').html(data);
        }
    })
} 
    
    
    
</script>

