<?php

include_once "../assets/Users.php";
$database = new Database();
session_start();
$inst_id = $_SESSION['inst_id'];
$Userid = $_SESSION['Userid'];
$club_id = $_SESSION['club_id'];
$conn = $database->getConnection();
$topic_name = mysqli_real_escape_string($conn,$_POST['topic_name']);
$topic_desc = mysqli_real_escape_string($conn,$_POST['desc']);
$from = date('Y-m-d',strtotime(mysqli_real_escape_string($conn,$_POST['from'])));
$to = date('Y-m-d',strtotime(mysqli_real_escape_string($conn,$_POST['to'])));
$status = mysqli_real_escape_string($conn,$_POST['status']);
$id=(isset($_POST['id'])? mysqli_real_escape_string($conn,$_POST['id']):0);
if(isset($_POST['action']))
{
    if ($_POST['action']=='update'){
        $topic_up = "UPDATE  school__topic SET topic_name = '$topic_name', topic_desc='$topic_desc', start_date='$from', 
        end_date='$to',status='$status',inst_id='$inst_id',cc_id='$Userid' where topic_id= '$id'";
        $conn->query($topic_up);
        echo "updated";        
    }
    else if ($_POST['action']=='add'){
        $club_id=$_POST['clubs'];
        $check="SELECT * FROM school__topic WHERE topic_name = '$topic_name' and club_id = '$club_id'";
    $result1 = $conn->query($check);
    $num_rows = mysqli_num_rows($result1);
    
    if ($num_rows>=1) {
        
        echo "exists";
        
    } 
    
    else {       
        $sql = "INSERT INTO school__topic (club_id,topic_name, topic_desc,end_date,start_date,status,inst_id,cc_id)
    VALUES ('$club_id','$topic_name','$topic_desc','$to','$from','$status','$inst_id','$Userid');";
     $sql .= "SELECT LAST_INSERT_ID()"; 
     if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                while ($row = $result->fetch_row()) {
                   
                    $var = (string) $row[0];
                }
                $topic_id = 'tp_'.$var;
                $sqli = "UPDATE  school__topic SET topic_id = '$topic_id' where sno= $var";
             
                $conn->query($sqli);
                echo "success";
                $result->free();
                
            }
            
           
        } while ($conn->next_result());
    }
    }
}
else {
} 

}
$conn->close();
