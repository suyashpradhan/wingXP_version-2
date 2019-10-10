<?php
include_once "../assets/Users.php";
$database = new Database();
$db = $database->getConnection();
$b_q='select batch_id,batch_name from inst_batch where class_id="'.$_GET['class'].'"';
$result=$db->query($b_q);
$vs=mysqli_num_rows($result);
                    if($vs >0){ 
                        while($v1=mysqli_fetch_array($result)){
                            echo '<option value='.$v1[0].'>'.$v1[1].'</option>';
                       }
                    }
                     else { 
                         echo '<option  disabled="disabled" selected>No Batch</option>'; 
                    }

