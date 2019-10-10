<?php 
session_start();
$club_id = $_SESSION['club_id'];
$inst_id = $_SESSION['inst_id'];
$Userid = $_SESSION['Userid'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$course=mysqli_real_escape_string($conn,$_POST['title']);
$editor1=mysqli_real_escape_string($conn,$_POST['editor1']);
$editor2=mysqli_real_escape_string($conn,$_POST['editor2']);
$editor3=mysqli_real_escape_string($conn,$_POST['editor3']);
$classes=mysqli_real_escape_string($conn,$_POST['classes']);
$price=mysqli_real_escape_string($conn,$_POST['mrp_price']);
$school_price=mysqli_real_escape_string($conn,$_POST['school_price']);
$start=mysqli_real_escape_string($conn,$_POST['start']);
$end=mysqli_real_escape_string($conn,$_POST['end']);
$topic=mysqli_real_escape_string($conn,$_POST['topic']);
$duration=mysqli_real_escape_string($conn,$_POST['duration']);
$vendor=mysqli_real_escape_string($conn,$_POST['vendor']);
$date=mysqli_real_escape_string($conn,$_POST['date']);
$class=mysqli_real_escape_string($conn,$_POST['class']);
$sub=mysqli_real_escape_string($conn,$_POST['sub']);
function ren_save($id = 'fileToUpload'){
    $target_dir = "../assets/workshop/";
    $f = basename($_FILES[$id]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir.$file);  
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
                            $workshop_id=mysqli_real_escape_string($conn,$_POST['id']);     
                            $work_up = "SELECT primary_image,secondary_image,course_icon from school__workshop where workshop_id = '$workshop_id'; ";                               
                            $work_up .= "UPDATE  school__workshop SET title = '$course', description_line='$editor1',class_applicable_for='$class',subscription_level='$sub',
                            no_of_classes='$classes',school_price='$school_price',mrp_price='$price',learning='$editor3',topic_id='$topic',";
                            if ($_FILES['primary']['name']==''){}else{ $work_up .= "primary_image='$p',";}
                            if ($_FILES['secondary']['name']==''){}else{ $work_up .= "secondary_image='$s',";}
                            if ($_FILES['icon']['name']==''){}else{ $work_up .= "course_icon='$i',";}
                            $work_up .= "prerequisites='$editor3',vendor_id='$vendor',club_id='$club_id',start_time='$start',
                            end_time='$end',date='$date',duration='$duration',inst_id='$inst_id',cc_id='$Userid' where workshop_id= '$workshop_id'";
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
                                            if(!unlink('../assets/workshop/'.$var)){}else{}                                
                                        }
                                        if($_FILES['secondary']['name']!==''){ 
                                            $var = (string) $row[1];    
                                            error_reporting(0); 
                                            if(!unlink('../assets/workshop/'.$var)){}else{}                                
                                        }
                                        if($_FILES['icon']['name']!==''){ 
                                            $var = (string) $row[2];
                                            error_reporting(0); 
                                            if(!unlink('../assets/workshop/'.$var)){}else{}                                
                                        }                                       
                                            else{}                             
                                    }    
                                    echo 'updated';                       
                                }  
                        }
                        while ($conn->next_result());
                }
                else{               
                    echo 'update failed !';             
                }
                            }

    else if ($_POST['action']=='publish')
    {  
        
        $check="SELECT * FROM school__workshop WHERE title = '$course'";
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
                            $sql = "INSERT INTO school__workshop  (title,description_line,no_of_classes,mrp_price,school_price,learning,class_applicable_for,subscription_level,topic_id,";
                            if ($_FILES['primary']['name']==''){}else{ $sql .= "primary_image,";}
                            if ($_FILES['secondary']['name']==''){}else{ $sql .= "secondary_image,";}
                            if ($_FILES['icon']['name']==''){}else{ $sql .= "course_icon,";}
                             $sql .= "prerequisites,vendor_id,club_id,start_time,end_time,date,duration,inst_id,cc_id) VALUES ('$course','$editor1','$classes','$price','$school_price','$editor2','$class','$sub','$topic',";
                             if ($_FILES['primary']['name']==''){}else{ $sql .= "'$p',";}
                             if ($_FILES['secondary']['name']==''){}else{ $sql .= "'$s',";}
                             if ($_FILES['icon']['name']==''){}else{ $sql .= "'$i',";} 
                             $sql .= "'$editor3','$vendor','$club_id','$start','$end','$date','$duration','$inst_id','$Userid');";
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
                                                
                                                $workshop_id = "sc_work_".$var."";
                                                $sqli = "UPDATE  school__workshop SET workshop_id = '$workshop_id' where sno= $var";         
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







