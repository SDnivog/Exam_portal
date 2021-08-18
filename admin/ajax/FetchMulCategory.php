	<?php
											include '../../database/config.php';
											include '../includes/check_user.php';
											extract($_POST);
											if(isset($val)){
											$sql = "SELECT * FROM tbl_categories WHERE user_id='$login_user_id' and  department = '$val'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                             $output = '';
                                            while($row = $result->fetch_assoc()) {
                                            $output .= '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                            }
                                            echo $output;
                                           } else {
                          
                                            }
											}
                                            
											 ?>
											 
											 
								