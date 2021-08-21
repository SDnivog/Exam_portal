	<?php
											include '../../database/config.php';
											include '../includes/check_user.php';
											extract($_POST);
											if(isset($id)){
											    
											    
											$sql = "update tbl_examinations set status= 'ACTIVE' where user_id='$login_user_id' and exam_id='$id'";
                                            $result = $conn->query($sql);
                                            if($result){
                                            echo "1";
                                                
                                            }

                                            
											}
                                            
											 ?>