<?php 

include 'mainpage.php';

?>


<div class="app-main__outer mt-2" id="mainbody">
   

    <div class="maincontainer m-2 bg-white">
        
         <div class="row m-3 mt-2 m-auto">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">All Plan Details</div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Sr No</th>
                                                <th class="text-center">Plan Name</th>
                                                <th class="text-center">Plan Code</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Date</th>
                                             
                                            </tr>
                                            </thead>
                                            <tbody class="teacherdata">
                                                
                                                <?php
                                                
                                                $sql = "select * from tbl_plan";
                                                
                                                $result = $conn->query($sql);
                                                $i=1;
                                                while($row = $result->fetch_assoc()){
                                                
                                                ?>
                                                <tr>
                                                    <td  class="text-center"><?php  echo $i;?></td>
                                                    <td  class="text-center"><?php  echo $row['plan_name'];?></td>
                                                    <td  class="text-center"><?php  echo $row['plan_code'];?></td>
                                                    <td  class="text-center"><?php  echo $row['plan_amount'];?></td>
                                                    <td  class="text-center"><?php  echo $row['date'];?></td>
                                                    
                                                    
                                                    
                                                    
                                                </tr>
                                                
                                                
                                                
                                                    <?php 
                                                    $i++;
                                                } ?>
                                           

                                           
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <br><br>


                                    
                                   
                                </div>
                            </div>
                        </div>

        
        
        
        
        
        
        
        
        <div class="tables m-4">
    <div class="table-responsive">
        <div class="col-lg-8 m-auto">
         <form action="addpricecard.php" method="post">
             <h4 class="text-center">Add a New Plan</h4><br>
       
        <div class="form-group">
            <input type="text" class="form-control" name="plancode" placeholder="Enter Plan Code">
           
        </div>
   
            <div class="form-group ">
            <input type="text" class="form-control" name="planname" placeholder="Enter Plan Name">
          
        </div>
          <div class="form-group">
            <input type="text" class="form-control" name="planamount" placeholder="Enter Plan Amount">
        
        </div>
         
        
        
        <button class="btn btn-dark" type="submit">Add</button>
       
    </form>
    </div>
        
        
        
        
    
                                    </div>
                                    </div>
                                    </div>






</div>

<script>





    
</script>



</body>
</html>





