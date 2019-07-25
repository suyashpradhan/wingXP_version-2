<?php 
session_start();
$club_id = $_SESSION['club_id'];
$inst_id = $_SESSION['inst_id'];
$Userid = $_SESSION['cc_id'];
$topic_id=$_SESSION['tp_id'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$title = mysqli_real_escape_string($conn,$_POST['title']);
$link = mysqli_real_escape_string($conn,$_POST['link']);

if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    { 
    
                $id = mysqli_real_escape_string($conn,$_POST['id']);
                $down_up = "UPDATE  school__topic_download SET title = '$title', link='$link' where sno= '$id'";
                $conn->query($down_up);
                echo "updated";        
     }

    else if ($_POST['action']=='publish')
    {   
         
                            
                            $sql = "INSERT INTO school__topic_download  (title,link,topic_id,inst_id,cc_id)
                             VALUES ('$title','$link','$inst_id','$Userid');";
                            $sql .= "SELECT LAST_INSERT_ID()"; 
                            
                            if ($conn->query($sql))
                            {echo "success";
                            }
                            else{
                                echo 'error';                                
                            }

       
       
    }
} 


$conn->close();














