<?php 
session_start();
$club_id = 'club_web';
$inst_id = 'inst_1';
//$club_id = $_SESSION['cid'];
//$inst_id = $_SESSION['inst_id'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$title = $_POST['course'];
$speaker = $_POST['speaker'];
$description = $_POST['editor1'];
$duration = $_POST['duration'];
$start = $_POST['start'];
$end = $_POST['end'];
$link = $_POST['link'];
$topic = $_POST['topic'];
$learning = $_POST['editor2'];
$vendor_id = $_POST['vendor'];
$speaker_desc = $_POST['speaker_desc'];
$vendor_id = $_POST['vendor'];
$date = $_POST['date'];
$price = $_POST['mrp_price'];
$school_price = $_POST['school_price'];
$class = $_POST['class'];
$sub=$_POST['sub'];
function ren_save($id = 'icon'){
    $target_dir = "../assets/webinar/";
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
                $web_up = "UPDATE  school__webinar SET title = '$title', speaker = '$speaker',
                description='$description',duration='$duration',learning='$learning',
                vendor_id='$vendor_id',school_price='$school_price',mrp_price='$price',
                date='$date',class_applicable_for='$class',subscription_level='$sub',
                club_id='$club_id',end_time='$end',start_time='$start',topic_id='$topic',
                speaker_desc='$speaker_desc',image='$web_img',speaker_img='$spk_img',
                link='$link',inst_id='$inst_id'
                 where webinar_id= '$webinar_id'";
                $conn->query($web_up);
                echo "updated";
        
     }


    else if ($_POST['action']=='publish') 
      {           
        $check="SELECT * FROM school__webinar WHERE title = '$title'";        
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
                            $sql = "INSERT INTO school__webinar  (title,description,duration,mrp_price,
                            school_price,learning,vendor_id,date, speaker,class_applicable_for,
                            subscription_level,club_id,start_time,end_time,topic_id,image,speaker_img,speaker_desc,link,inst_id) VALUES 
                            ('$title','$description','$duration','$price','$school_price',
                            '$learning','$vendor_id','$date','$speaker','$class','$sub',
                            '$club_id','$start','$end','$topic','$web_img','$spk_img','$speaker_desc','$link','$inst_id');";
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
                                                $sqli = "UPDATE  school__webinar SET webinar_id = '$webinar_id' where sno= $var";         
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















