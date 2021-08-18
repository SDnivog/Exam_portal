
<?php
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
include '../database/config.php';

$data = mysqli_real_escape_string($conn,$_POST['CategoryFetch']);


											$sql = "SELECT * FROM tbl_categories WHERE user_id='$login_user_id' and department='$data' and status = 'Active' ORDER BY name";
                                            $result = $conn->query($sql);
                                            $output = '<option value="" selected disabled>-Select Class-</option>';
                                            if ($result->num_rows > 0) {
    
                                            while($row = $result->fetch_assoc()) {
                                            $output .= '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                            }
                                            echo $output;
                                           } else {
                          
                                            }
                                             $conn->close();
											 ?>