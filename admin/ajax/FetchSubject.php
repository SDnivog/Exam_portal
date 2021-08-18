	<?php
											include '../../database/config.php';
											include '../includes/check_user.php';
											extract($_POST);
											if(isset($maindata)){
											$sql = "SELECT * FROM tbl_categories WHERE user_id='$login_user_id' and  department = '$maindata' and status = 'Active' ORDER BY name";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                $output = '<option value="" selected disabled>Select Class</option>';
                                            while($row = $result->fetch_assoc()) {
                                            $output .= '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                            }
                                            echo $output;
                                           } else {
                          
                                            }
											}
                                            
											 ?>