<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$quiz_title=mysqli_real_escape_string($conn,$_POST['title']);
$quiz_details=mysqli_real_escape_string($conn,$_POST['editor1']);
$no_of_questions=mysqli_real_escape_string($conn,$_POST['ques']);
$quiz_creator=mysqli_real_escape_string($conn,$_POST['author']);
$price=mysqli_real_escape_string($conn,$_POST['mrp_price']);
$vendor=mysqli_real_escape_string($conn,$_POST['vendor']);
$link=mysqli_real_escape_string($conn,$_POST['link']);
$club_id=$_SESSION['club_id'];
$topic=$_SESSION['topic_id'];
if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {     
                $quiz_id=$_POST['id'];
                $test_up = "UPDATE  quiz SET quiz_title = '$quiz_title', quiz_details='$quiz_details',no_of_questions='$no_of_questions',quiz_creator='$quiz_creator',
                mrp_price='$price',club_id='$club_id',class_applicable_for='$class',subscription_level='$sub',
                vendor_id='$vendor',link='$link',topic_id='$topic' where quiz_id= '$quiz_id'";
                $conn->query($test_up);
                echo "updated";        
     }
    else if ($_POST['action']=='publish')
    {   $check="SELECT * FROM quiz WHERE quiz_title = '$quiz_title'";
        $result1 = $conn->query($check);
        $num_rows = mysqli_num_rows($result1);    
        if ($num_rows>=1) 
        {        
        echo "exists";        
         }     
        else 
        {                     
                            $sql = "INSERT INTO quiz  (quiz_title,quiz_details,no_of_questions,quiz_creator,mrp_price,club_id,vendor_id,link,topic_id) VALUES ('$quiz_title','$quiz_details','$no_of_questions','$quiz_creator','$price','$club_id','$vendor','$link','$topic');";
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
                                                $quiz_id = "quiz_".$var."";
                                                $sqli = "UPDATE  quiz SET quiz_id = '$quiz_id' where sno= $var";         
                                                $conn->query($sqli);
                                                echo "success";
                                                $result->free();                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            }
                            else{}
       }       
    }
} 
$conn->close();














