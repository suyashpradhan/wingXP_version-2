<?php 
session_start();
$club_id = $_SESSION['club_id'];
$inst_id = $_SESSION['inst_id'];
$Userid = $_SESSION['Userid'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_POST['link'])){$link=mysqli_real_escape_string($conn,$_POST['link']);}else{$link='';}
$title=mysqli_real_escape_string($conn,$_POST['title']);
$description_line=mysqli_real_escape_string($conn,$_POST['editor1']);
$duration=mysqli_real_escape_string($conn,$_POST['duration']);
$learning=mysqli_real_escape_string($conn,$_POST['editor2']);
$vendor_id=mysqli_real_escape_string($conn,$_POST['vendor']);
$price=mysqli_real_escape_string($conn,$_POST['mrp_price']);
$school_price=mysqli_real_escape_string($conn,$_POST['school_price']);
$class=mysqli_real_escape_string($conn,$_POST['class']);
$topic=mysqli_real_escape_string($conn,$_POST['topic']);
$sub=mysqli_real_escape_string($conn,$_POST['sub']);
function ren_save(){
    $target_dir = "../assets/video/";
    $f = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $file);  
    return $file;                                     
}




if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {             
        $f=ren_save();        
                $video_id=$_POST['id'];
                $vid_up = "SELECT video_file,link from school__video where video_id = '$video_id'; ";
                $vid_up .= "UPDATE  school__video SET title = '$title', description_line='$description_line',duration='$duration',learning='$learning',class_applicable_for='$class',subscription_level='$sub',topic_id='$topic',";
                if($_FILES['fileToUpload']['name']==''){}else{$vid_up .= "video_file='$f',link='',";}
                if($link ==''){}else{$vid_up .= "link='$link',video_file='',";}
                $vid_up .= "vendor_id='$vendor_id',school_price='$school_price',mrp_price='$price',
                club_id='$club_id',inst_id='$inst_id',cc_id='$Userid' where video_id= '$video_id'";
                if ($conn->multi_query($vid_up))
                {       
                    do {
                        
                                if ($result = $conn->store_result()){
                                    while ($row = $result->fetch_row()){               
                                        if($_FILES['fileToUpload']['name']!==''){
                                            $var = (string) $row[0];
                                            error_reporting(0); 
                                            if(!unlink('../assets/video/'.$var)){}else{}
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
        $check="SELECT * FROM school__video WHERE title = '$title'";
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
                     
                            //Data Upload
                            $sql = "INSERT INTO school__video  (title,description_line,duration,mrp_price,school_price,learning,vendor_id,
                            club_id,class_applicable_for,subscription_level,topic_id,inst_id,cc_id";
                            if($_FILES['fileToUpload']['name']==''){}else{$sql .= ",video_file";}
                            if($link==''){}else{$sql .= ",link";}
                            $sql .= ") VALUES ('$title','$description_line','$duration','$price','$school_price','$learning','$vendor_id',
                            '$club_id','$class','$sub','$topic','$inst_id','$Userid'";
                            if($_FILES['fileToUpload']['name']==''){}else{ $sql .= " ,'$f'";}
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
                                                
                                                $video_id = "vid_".$var."";
                                                $sqli = "UPDATE  school__video SET video_id = '$video_id' where sno= $var";         
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














