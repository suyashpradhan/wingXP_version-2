<?php 
include_once "../assets/Users.php";
$database = new Database();
session_start();
$inst_id = $_SESSION['inst_id'];
$Userid = $_SESSION['Userid'];
$conn = $database->getConnection();
if(isset($_POST['coord_post'])){$coord_post = mysqli_real_escape_string($conn,$_POST['coord_post']);}else{$coord_post='';}
if(isset($_POST['pres_post'])){$pres_post = mysqli_real_escape_string($conn,$_POST['pres_post']);}else{$pres_post='';}
if(isset($_POST['bearer_post'])){$bearer_post = mysqli_real_escape_string($conn,$_POST['bearer_post']);}else{$bearer_post='';}
if(isset($_POST['status'])){$status = mysqli_real_escape_string($conn,$_POST['status']);}else{$status='0';}
   
    if(isset($_POST['action']) and $_POST['action']=='publish'){
        $club_id_select=$_POST['club_id'];
        $add_club="UPDATE inst_club_assign SET coord_post='$coord_post',pres_post='$pres_post',
        bearer_post='$bearer_post',status='$status' where club_id = '$club_id_select' and institute_id='$inst_id'";
    if ($conn->query($add_club))
    {
     echo "success";
    }
    else{
        echo "Error ! Not deployed";                                
         }
    }
        else if(isset($_POST['action']) and $_POST['action']=='update'){
            $club_id_select=$_POST['id'];
            $club_update = "UPDATE  inst_club_assign SET coord_post='$coord_post',pres_post='$pres_post',bearer_post='$bearer_post',status='$status
             where club_id= '$club_id_select' and institute_id='$inst_id'";             
             if ($conn->query($club_update))
             {
              echo "success";
             }
             else{
                 echo "Error ! Not Updated";                                
                  }
        }
        $conn->close();
        