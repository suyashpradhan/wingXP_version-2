<?php 
session_start();
$club_id = $_SESSION['club_id'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$title=mysqli_real_escape_string($conn,$_POST['course']);
$speaker=mysqli_real_escape_string($conn,$_POST['speaker']);
$description=mysqli_real_escape_string($conn,$_POST['editor1']);
$duration=mysqli_real_escape_string($conn,$_POST['duration']);
$start=mysqli_real_escape_string($conn,$_POST['start']);
$end=mysqli_real_escape_string($conn,$_POST['end']);
$topic=mysqli_real_escape_string($conn,$_POST['topic']);
$learning=mysqli_real_escape_string($conn,$_POST['editor2']);
$speaker_desc=mysqli_real_escape_string($conn,$_POST['speaker_desc']);
$vendor_id=mysqli_real_escape_string($conn,$_POST['vendor']);
$date=mysqli_real_escape_string($conn,$_POST['date']);
$price=mysqli_real_escape_string($conn,$_POST['mrp_price']);
$school_price=mysqli_real_escape_string($conn,$_POST['school_price']);
$class=mysqli_real_escape_string($conn,$_POST['class']);
$sub=mysqli_real_escape_string($conn,$_POST['sub']);
if(isset($_POST['link'])){$link=mysqli_real_escape_string($conn,$_POST['link']);}else{$link='';}
function ren_save($id = 'icon'){
    $target_dir = "../../assets/webinar/";
    $f = $target_dir . basename($_FILES[$id]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir . $file);  
    return $file;                                     
}
if(isset($_FILES['icon'])){$web_img = ren_save('icon');}else{$web_img='';}
if(isset($_FILES['spk_img'])){$spk_img = ren_save('spk_img');}else{$spk_img='';}
if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {  
     
                $webinar_id=$_POST['id'];                                   
                $web_up = "UPDATE  webinar SET title = '$title', speaker = '$speaker',
                description='$description',duration='$duration',learning='$learning',
                vendor_id='$vendor_id',school_price='$school_price',mrp_price='$price',
                date='$date',class_applicable_for='$class',subscription_level='$sub',
                club_id='$club_id',end_time='$end',start_time='$start',topic_id='$topic',
                speaker_desc='$speaker_desc',image='$web_img',speaker_img='$spk_img',
                link='$link'
                 where webinar_id= '$webinar_id'";
                $conn->query($web_up);
                echo "updated";
        
     }


    else if ($_POST['action']=='publish') 
      {           
        $check="SELECT * FROM webinar WHERE title = '$title'";        
        $result1 = $conn->query($check);
        $num_rows = mysqli_num_rows($result1);
    
        if ($num_rows>=1) 
        {        
        echo "exists";        
         } 
    
        else 
        {
                                //File upload
                           
                            //Data Upload
                            $sql = "INSERT INTO webinar  (title,description,duration,mrp_price,
                            school_price,learning,vendor_id,date, speaker,class_applicable_for,
                            subscription_level,club_id,start_time,end_time,topic_id,image,speaker_img,speaker_desc,link) VALUES 
                            ('$title','$description','$duration','$price','$school_price',
                            '$learning','$vendor_id','$date','$speaker','$class','$sub',
                            '$club_id','$start','$end','$topic','$web_img','$spk_img','$speaker_desc','$link');";
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
                                                
                                                $webinar_id = "web_".$var."";
                                                $sqli = "UPDATE  webinar SET webinar_id = '$webinar_id' where sno= $var";         
                                                $conn->query($sqli);
                                                echo "success";
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















