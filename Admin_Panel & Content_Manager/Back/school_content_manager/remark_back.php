<?php 
include_once "../assets/Users.php";
$database = new Database();
session_start();
$cc_id=$_SESSION['Userid'];
$conn = $database->getConnection();
if(isset($_GET['id'])){$id = mysqli_real_escape_string($conn,$_GET['id']);}else{echo 'FATAL ERROR';}
if(isset($_GET['remark'])){$remark = mysqli_real_escape_string($conn,$_GET['remark']);}else{echo 'FATAL ERROR';}
if(isset($_GET['featured'])){$f = mysqli_real_escape_string($conn,$_GET['featured']);}else{$f=0;}
$check="SELECT * FROM submission_feedback WHERE submission_id = '$id'";
        $result1 = $conn->query($check);
        $num_rows = mysqli_num_rows($result1);    
        if ($num_rows>=1) 
        {        
            $submit_remark = "UPDATE sample_work_submission SET featured='$f' where submission_id='$id';
            UPDATE submission_feedback SET remark='$remark',cc_id = '$cc_id' where submission_id='$id'; ";
            
         }     
        else {
            $submit_remark = "UPDATE sample_work_submission SET featured='$f' where submission_id='$id';
            INSERT INTO submission_feedback (remark,submission_id,cc_id) values ('$remark','$id','$cc_id'); ";
            
            
        }
        $result=$conn->multi_query($submit_remark);
        if($result=='1'){echo 'updated';}
        else{echo 'error';}


