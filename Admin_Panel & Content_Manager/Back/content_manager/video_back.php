<?php 
session_start();
//$club_id = $_SESSION['club_id'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_POST['link'])){$link=mysqli_real_escape_string($conn,$_POST['link']);}else{$link='';}
if(isset($_POST['title'])){$title=mysqli_real_escape_string($conn,$_POST['title']);}else{$title='';}
if(isset($_POST['editor1'])){$description_line=mysqli_real_escape_string($conn,$_POST['editor1']);}else{$description_line='';}
if(isset($_POST['duration'])){$duration=mysqli_real_escape_string($conn,$_POST['duration']);}else{$duration='';}
if(isset($_POST['editor2'])){$learning=mysqli_real_escape_string($conn,$_POST['editor2']);}else{$learning='';}
if(isset($_POST['vendor'])){$vendor_id=mysqli_real_escape_string($conn,$_POST['vendor']);}else{$vendor_id='';}
if(isset($_POST['mrp_price'])){$price=mysqli_real_escape_string($conn,$_POST['mrp_price']);}else{$price='';}
function ren_save(){
    $target_dir = "../../assets/video/";
    $f = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $file);  
    return $file;                                     
}
function tag($id){
    global $conn;
    if(empty($_POST['tags'][0])){
        return 1;
    }
    $d_q="DELETE from tag_assign where activity_id='$id'";
    if($conn->query($d_q)){
        
    }
    else{
        return 0;
    }
    
    foreach($_POST['tags'] as $value){
        $q='INSERT INTO tag_assign (topic_id,activity_id,type,tag_id) VALUES ("'.$_SESSION['topic_id'].'","'.$id.'","video","'.$value.'");'; 
        if($conn->query($q))
                            {      
                             $res=1;   
                            } 
                            else{
                                $res=0;
                            }
    }
    return $res;
}




if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {             
        $f=ren_save();        
                $video_id=$_POST['id'];
                $vid_up = "SELECT video_file,link from video where video_id = '$video_id'; ";
                $vid_up .= "UPDATE  video SET title = '$title', description_line='$description_line',duration='$duration',learning='$learning',";
                if($_FILES['fileToUpload']['name']==''){}else{$vid_up .= "video_file='$f',link='',";}
                if($link ==''){}else{$vid_up .= "link='$link',video_file='',";}
                $vid_up .= "vendor_id='$vendor_id',mrp_price='$price',club_id='".$_SESSION['club_id']."' where video_id= '$video_id'";
                if ($conn->multi_query($vid_up))
                {       
                    do {
                        
                                if ($result = $conn->store_result()){
                                    while ($row = $result->fetch_row()){               
                                        if($_FILES['fileToUpload']['name']!==''){
                                            $var = (string) $row[0];
                                            //error_reporting(0); 
                                            if(!unlink('../../assets/video/'.$var)){}else{}
                                        }
                                    }                                     
                                          
                                }                                 
                           }
                        while ($conn->next_result());
                        if(tag($_POST['id'])){
                            echo 'updated';          
                        }
                        else{
                            echo 'error';                            
                        }
                }
                else{               
                    echo 'error';             
                }
        
     }


    else if ($_POST['action']=='publish')
    {  
        //check for existing vendor
        $check="SELECT * FROM video WHERE title = '$title'";
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
                            $sql = "INSERT INTO video  (title,description_line,duration,mrp_price,learning,vendor_id,club_id,topic_id";
                            if($_FILES['fileToUpload']['name']==''){}else{$sql .= ",video_file";}
                            if($link==''){}else{$sql .= ",link";}
                            $sql .= ") VALUES ('$title','$description_line','$duration','$price','$learning','$vendor_id','".$_SESSION['club_id']."','".$_SESSION['topic_id']."'";
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
                                                $sqli = "UPDATE  video SET video_id = '$video_id' where sno= $var";         
                                                $conn->query($sqli);
                                                if(tag($video_id)){

                                                }
                                                else{
                                                    echo 'error';
                                                    die;
                                                }
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














