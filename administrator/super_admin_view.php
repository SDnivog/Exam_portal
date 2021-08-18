<?php include 'mainpage.php';?>
                 <div class="app-main__outer">
                    <div class="app-main__inner" id="mainbodydata">
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <?php 
                                $admin =0;
                                $student=0;
                                $tendayadmin=0;
                                $tendaystudent=0;
                                  $tendayDate=Date('d-m-Y', strtotime('-10 days'));
                                 while($row = $result->fetch_assoc()){
                                     if($row['role'] == "admin"){
                                         $admin++;
                                     }
                                     if($row['role'] == "student"){
                                         $student++;
                                     }
                                     if($row['role'] =="admin" && $row['register_date'] >$tendaydate){
                                         $tendayadmin++;
                                     }else{
                                          if($row['role'] =="student" && $row['register_date'] >$tendaydate){
                                         $tendaystudent++;
                                     }
                                     }
                                    }
                                  
                                    
                                   
                                     
                                     ?>
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total teacher</div>
                                            <div class="widget-subheading">
                                                Last 10 Days Register Admin :<?php echo $tendayadmin; ?>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php 
                                               
                                             echo $admin;  
                                                     
                                            ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Student</div>
                                            <div class="widget-subheading">Last 10 Days Join Student : <?php echo $tendaystudent; ?></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $student; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Cost</div>
                                            <div class="widget-subheading">Last 10 Days Cost Earned</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>0</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>                 
                       
                    <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Exam </div>
                                                 <?php 
                                                    $sql = "select * from tbl_examinations";
                                                    $result = $conn->query($sql);
                                                  
                                                    ?>
                                                <div class="widget-subheading">Last 10 Days Conducted</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-warning">
                                                   <?php
                                                    echo $result->num_rows;
                                                    
                                                    
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Passed Student</div>
                                            
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-success">
                                                <?php
                                                    $sql ="select * from tbl_assessment_records where status ='PASS'";

                                                    $result= $conn->query($sql);

                                                    echo $result->num_rows;


                                                ?>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                            <div class="widget-heading">Total Fail Student</div>
                                            
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-danger">
                                                <?php
                                                    $sql ="select * from tbl_assessment_records where status ='FAIL'";

                                                    $result= $conn->query($sql);

                                                    echo $result->num_rows;


                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Income</div>
                                                <div class="widget-subheading">Expected totals</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-focus">$147</div>
                                            </div>
                                        </div>
                                        <div class="widget-progress-wrapper">
                                            <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                                            </div>
                                            <div class="progress-sub-label">
                                                <div class="sub-label-left">Expenses</div>
                                                <div class="sub-label-right">100%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Top 5 Teachers Who Conducted Most Exams
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <button class="active btn btn-focus">Last Week</button>
                                                <button class="btn btn-focus">All Month</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Teacher Id</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Total Exam Conducted</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center"> Admin Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="teacherdata">
                                           
                                           

                                           
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <br><br>


                                    
                                   
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Top 5 Students Who Given Most Exams
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <button class="active btn btn-focus">Last Week</button>
                                                <button class="btn btn-focus">All Month</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Student Id</th>
                                                <th class="text-center">Teacher Id</th>
                                                <th class="text-center">Name</th>
                                                
                                                <th class="text-center">Total Exam Given</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center"> Admin Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="studentdata">
                                           

                                           
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <br><br>


                                    
                                   
                                </div>
                            </div>
                        </div>
                      
                        </div>
                    </div>
                </div>
          
        </div>
    </div>
<script>
fetchbody();
fetchstudentbody();

function fetchbody(){
    var admin = "teacher";
    $.ajax({
        url:'ajax/fetchtopfiveteacher.php',
        type:'post',
        data:{
            mainid:admin
        },
        success:function(data){
            $('.teacherdata').html(data);
        }
    });
  

}
function fetchstudentbody(){
    var dataid = "student";
    $.ajax({
        url:'ajax/fetchtopfiveteacher.php',
        type:'post',
        data:{
            dataid:dataid
        },
        success:function(data){
            $('.studentdata').html(data);
        }
    });

}
function Checkadminstatus(id,status,whois){
        if(whois == 1){
            var candid = "teacher";
        }
        else{
            var candid = "student";
        }
        var admin_id = document.getElementById(candid+id).innerHTML
        $.ajax({
            url:'ajax/userstatus.php',
            type:'post',
            data:{
                id:admin_id,
                status:status
            },
            success:function(data){
                fetchbody();
                fetchstudentbody();
            }
        })



}

function details(id,whois){
    
    if(whois ==1){
        var candid = "teacher";
        var admin_id =document.getElementById(candid+id).innerHTML;
   
    $.ajax({
        url:'ajax/fetchparticular.php',
        type:'post',
        data:{
            data_id:admin_id,
            whois:whois
        },
        success:function(data){
            $('#mainbodydata').html(data);
        }
    })

}
    else{
        var candid = "student"; 
    
    var admin_id =document.getElementById(candid+id).innerHTML;
    $.ajax({
        url:'ajax/fetchparticularstudent.php',
        type:'post',
        data:{
            data_id:admin_id,
            whois:whois
        },
        success:function(data){
            $('#mainbodydata').html(data);
        }
    })


    }
}



function show(val){
    for(var i=1;i<=5;i++){
        if(val ==i){
            document.getElementById("data"+i).style.display="block";
            document.getElementById("link"+i).className = "text-dark bg-white";
        }
        else{
            document.getElementById("data"+i).style.display="none";
            document.getElementById("link"+i).className = "none";
        }
    }
    
}
   







</script>





</body>
</html>
