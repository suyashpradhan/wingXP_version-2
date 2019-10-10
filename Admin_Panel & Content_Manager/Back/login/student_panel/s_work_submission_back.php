<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$club_id = $_POST['club_id'];
$sid = $_POST['sid'];
$s_w_id = $_POST['sample_work_id'];
$inst_id = $_POST['inst_id'];
function ren_save($id = "work"){
    $target_dir = "../assets/work_submission/";
    $f = $target_dir.basename($_FILES[$id]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir . $file);  
    return $file;                                     
}
        
               //File upload 
                $i=ren_save();                     
                            //Data Upload
                            $sql = "INSERT INTO sample_work_submission  (club_id,student_id,inst_id,sample_work_id,file)
                            VALUES ('$club_id','$sid','$inst_id','$s_w_id','$i');";                   
                            $sql .= "SELECT LAST_INSERT_ID()";  
                            if ($conn->multi_query($sql))
                            {       
                                do {
                                    
                                            if ($result = $conn->store_result()) 
                                            {
                                                while ($row = $result->fetch_row()) 
                                                {               
                                                $var = (string) $row[0];
                                                }
                                                
                                                $subm_id = "subm_".$var."";
                                                $sqli = "UPDATE  sample_work_submission SET submission_id = '$subm_id' where sno= $var";         
                                                $conn->query($sqli);
                                                echo "success";
                                                $result->free();
                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            }
                            else{
                                echo "Data Not Saved";
                                
                            }      
       
    



$conn->close();