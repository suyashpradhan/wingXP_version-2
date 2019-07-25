<?php

include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$topic_name = mysqli_real_escape_string($conn,$_POST['topic_name']);
$topic_desc = mysqli_real_escape_string($conn,$_POST['desc']);
$start = $_POST['start'];
$end = $_POST['end'];
$status =$_POST['status'];
if(isset($_POST['action']))
{
    if ($_POST['action']=='update'){  
        $topic_id = $_POST['id'];
        $topic_up = "UPDATE  topic SET topic_name = '$topic_name', topic_desc='$topic_desc', start_date='$start', end_date='$end',status='$status' where topic_id= '$topic_id'";
        $conn->query($topic_up);
        echo "updated";
        
    }
    else if ($_POST['action']=='add'){
        $club_id=$_POST['clubs'];
        $check="SELECT * FROM topic WHERE topic_name = '$topic_name'";
    $result1 = $conn->query($check);
    $num_rows = mysqli_num_rows($result1);
    
    if ($num_rows>=1) {
        
        echo "exists";
        
    } 
    
    else {
       
       
        $sql = "INSERT INTO topic (club_id,topic_name, topic_desc,start_date,end_date,status)
    VALUES ('$club_id','$topic_name','$topic_desc','$start','$end','$status');";
     $sql .= "SELECT LAST_INSERT_ID()"; 
     if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                while ($row = $result->fetch_row()) {
                   
                    $var = (string) $row[0];
                }
                $topic_id = "tp_".$var."";
                $sqli = "UPDATE  topic SET topic_id = '$topic_id' where sno= $var";
             
                $conn->query($sqli);
                echo "success";
                $result->free();
                
            }
            
           
        } while ($conn->next_result());
    }
    }
} 

}
$conn->close();
