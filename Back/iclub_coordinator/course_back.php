<?php 

session_start();
$club_id = 'club_web'; 
//$club_id = $_SESSION['club_id'];
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();

$description_line = $_POST['title'];
$description = $_POST['editor1'];
$learning = $_POST['editor2'];
$price = $_POST['mrp_price'];
$school_price = $_POST['school_price'];
$vendor = $_POST['vendor'];
$topic = $_POST['topic'];
$duration = $_POST['duration'];       
$class = $_POST['class'];
$sub=$_POST['sub'];            
function ren_save($id = 'fileToUpload'){
    $target_dir = "../../assets/course/";
    $f =basename($_FILES[$id]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir . $file);  
    return $file;                                     
}

if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {                            //File update
                                    
                                   
                                    $p=ren_save('primary');
                                    $s=ren_save('secondary');
                                    $i=ren_save('icon');

                                                 
                             //Data update
                            $course_id=$_POST['id'];       
                            $work_up = "SELECT primary_image,secondary_image,course_icon from live_course where course_id = '$course_id'; ";                            
                            $work_up .= "UPDATE  live_course SET description_line = '$description_line', description='$description',school_price='$school_price',mrp_price='$price',duration='$duration',learning='$learning',class_applicable_for='$class',subscription_level='$sub',topic_id='$topic',";
                            if ($_FILES['primary']['name']==''){}else{ $work_up .= "primary_image='$p',";}
                            if ($_FILES['secondary']['name']==''){}else{ $work_up .= "secondary_image='$s',";}
                            if ($_FILES['icon']['name']==''){}else{ $work_up .= "course_icon='$i',";}
                            $work_up .= "vendor_id='$vendor',club_id='$club_id' where course_id= '$course_id'";
                            if ($conn->multi_query($work_up))
                {       
                    do {
                        
                                if ($result = $conn->store_result()) 
                                { 
                                    while ($row = $result->fetch_row()) 
                                    {       
                                    
                                            if($_FILES['primary']['name']!==''){ 
                                                $var = (string) $row[0];    
                                                error_reporting(0); 
                                                if(!unlink('../../assets/course/'.$var)){}else{}                                
                                            }
                                            if($_FILES['secondary']['name']!==''){ 
                                                $var = (string) $row[1];    
                                                error_reporting(0); 
                                                if(!unlink('../../assets/course/'.$var)){}else{}                                
                                            }
                                            if($_FILES['icon']['name']!==''){ 
                                                $var = (string) $row[2];
                                                error_reporting(0); 
                                                if(!unlink('../../assets/course/'.$var)){}else{}                                
                                            }                                       
                                                else{}                               
                                                                     
                                    }    
                                    echo 'updated';                       
                                }  
                               
                                
                        }
                        while ($conn->next_result());
                }else{}
                            }

    else if ($_POST['action']=='publish')
    {  
        
        $check="SELECT * FROM live_course WHERE description_line = '$description_line'";
        $result1 = $conn->query($check);
        $num_rows = mysqli_num_rows($result1);
    
        if ($num_rows>=1) 
        {        
        echo "exists";        
         } 
    
        else 
        {
                             //File upload
                             
                             $p=ren_save('primary');
                             $s=ren_save('secondary');
                             $i=ren_save('icon');
                            //Data Upload                             
                            $sql = "INSERT INTO live_course  (description_line,description,mrp_price,school_price,duration,learning,class_applicable_for,subscription_level,topic_id,";
                            if ($_FILES['primary']['name']==''){}else{ $sql .= "primary_image,";}
                            if ($_FILES['secondary']['name']==''){}else{ $sql .= "secondary_image,";}
                            if ($_FILES['icon']['name']==''){}else{ $sql .= "course_icon,";}
                             $sql .= "vendor_id,club_id) VALUES ('$description_line','$description','$price','$school_price','$duration','$learning','$class','$sub','$topic',";
                             if ($_FILES['primary']['name']==''){}else{ $sql .= "'$p',";}
                             if ($_FILES['secondary']['name']==''){}else{ $sql .= "'$s',";}
                             if ($_FILES['icon']['name']==''){}else{ $sql .= "'$i',";} 
                             $sql .= "'$vendor','$club_id');";
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
                                                
                                                $course_id = "course_".$var."";
                                                $sqli = "UPDATE  live_course SET course_id = '$course_id' where sno= $var";         
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

       }
       
    }
} 


$conn->close();







