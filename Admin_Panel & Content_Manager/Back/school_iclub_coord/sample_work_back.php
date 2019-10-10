<?php 
session_start();
$club_id = 'club_web';
$inst_id = 'inst_1';
//$club_id = $_SESSION['cid'];
//$inst_id = $_SESSION['inst_id'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$title = $_POST['title'];
$description_line = $_POST['editor1'];
$duration = $_POST['duration'];
$learning = $_POST['editor2'];
$vendor_id = $_POST['vendor'];
$price = $_POST['mrp_price'];
$date = $_POST['date'];
$school_price = $_POST['school_price'];
$class = $_POST['class'];
$topic = $_POST['topic'];
$media = $_POST['media'];
if(isset($_POST['link'])){$link=$_POST['link'];}else{$link='';}
$sub=$_POST['sub'];
function ren_save($id = 'fileToUpload'){
    $target_dir = "../assets/sample_work/";
    $f = $target_dir . basename($_FILES[$id]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir . $file);  
    return $file;                                     
}
if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {             
        $f=ren_save();
        $i=ren_save('icon'); 
        $p=ren_save('pdf');        
                $id=$_POST['id'];
                $vid_up = "SELECT video_file from school__sample_work where sample_work_id = '$id'; ";
                $vid_up .= "UPDATE  school__sample_work SET title = '$title',media_type='$media',
                 description_line='$description_line',duration='$duration',learning='$learning',
                 class_applicable_for='$class',subscription_level='$sub',topic_id='$topic',";
                if($_FILES['fileToUpload']['name']==''){}else{$vid_up .= "video_file='$f',";}
                if($link ==''){}else{$vid_up .= "link='$link',";}
                if($_FILES['icon']['name']==''){}else{$vid_up .= "image='$i',";}
                if($_FILES['pdf']['name']==''){}else{$vid_up .= "pdf='$p',";}
                $vid_up .= "vendor_id='$vendor_id',school_price='$school_price',mrp_price='$price',
                club_id='$club_id',last_date='$date',inst_id='$inst_id' where sample_work_id= '$id'";
                if ($conn->multi_query($vid_up))
                {       
                    do {
                        
                                if ($result = $conn->store_result()){
                                    while ($row = $result->fetch_row()){               
                                        if($_FILES['fileToUpload']['name']!==''){
                                            $var = (string) $row[0];
                                            error_reporting(0); 
                                            if(!unlink('../assets/sample_work/'.$var)){}else{}
                                        }
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
        //check for existing vendor
        $check="SELECT * FROM school__sample_work WHERE title = '$title'";
        $result1 = $conn->query($check);
        $num_rows = mysqli_num_rows($result1);
    
        if ($num_rows>=1) 
        {        
        echo "exists";        
         } 
    
        else 
        {
                                //File upload
                               
                                $f=ren_save();
                                $i=ren_save('icon');
                                $p=ren_save('pdf');
                     
                            //Data Upload
                            $sql = "INSERT INTO school__sample_work  (title,description_line,duration,mrp_price,school_price,
                            learning,vendor_id,club_id,class_applicable_for,subscription_level,topic_id,media_type,last_date,inst_id";
                            if($_FILES['fileToUpload']['name']==''){}else{$sql .= ",video_file";}
                            if($_FILES['icon']['name']==''){}else{$sql .= ",image";}
                            if($_FILES['pdf']['name']==''){}else{$sql .= ",pdf";}
                            if($link==''){}else{$sql .= ",link";}
                            $sql .= ") VALUES ('$title','$description_line','$duration','$price','$school_price',
                            '$learning','$vendor_id','$club_id','$class','$sub','$topic','$media','$date','$inst_id'";
                            if($_FILES['fileToUpload']['name']==''){}else{ $sql .= " ,'$f'";}
                            if($_FILES['icon']['name']==''){}else{ $sql .= " ,'$i'";}
                            if($_FILES['pdf']['name']==''){}else{ $sql .= " ,'$p'";}
                            if($link ==''){}else{ $sql .= " ,'$link'";}
                            $sql .= ");";
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
                                                
                                                $s_work_id = "s_work_".$var."";
                                                $sqli = "UPDATE  school__sample_work SET sample_work_id = '$s_work_id' where sno= $var";         
                                                $conn->query($sqli);
                                                echo 'success';
                                                $result->free();
                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            }
                            else{
                                
                            }

       }
       
    }
} 
$conn->close();














