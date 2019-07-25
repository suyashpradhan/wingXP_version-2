<?php 
session_start();
$club_id = $_SESSION['club_id'];
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
                $down_up = "UPDATE  topic_download SET title = '$title', link='$link' where sno= '$id'";
                $conn->query($down_up);
                echo "updated";        
     }

    else if ($_POST['action']=='publish')
    {   
         
                            
                            $sql = "INSERT INTO topic_download  (title,link,topic_id)
                             VALUES ('$title','$link','$topic_id');";
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














