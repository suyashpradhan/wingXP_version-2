<?php 
session_start();
$club_id = $_SESSION['club_id'];
$inst_id = $_SESSION['inst_id'];
$Userid = $_SESSION['Userid'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$quiz_title=mysqli_real_escape_string($conn,$_POST['title']);
$quiz_details=mysqli_real_escape_string($conn,$_POST['editor1']);
$no_of_questions=mysqli_real_escape_string($conn,$_POST['ques']);
$quiz_creator=mysqli_real_escape_string($conn,$_POST['author']);
$price=mysqli_real_escape_string($conn,$_POST['mrp_price']);
$school_price=mysqli_real_escape_string($conn,$_POST['school_price']);
$vendor=mysqli_real_escape_string($conn,$_POST['vendor']);
$class=mysqli_real_escape_string($conn,$_POST['class']);
$sub=mysqli_real_escape_string($conn,$_POST['sub']);
$topic=mysqli_real_escape_string($conn,$_POST['topic']);
$link=mysqli_real_escape_string($conn,$_POST['link']);
if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {     
                $quiz_id=mysqli_real_escape_string($conn,$_POST['id']);
                $test_up = "UPDATE  school__quiz SET quiz_title = '$quiz_title', quiz_details='$quiz_details',
                no_of_questions='$no_of_questions',quiz_creator='$quiz_creator',school_price='$school_price',
                mrp_price='$price',club_id='$club_id',class_applicable_for='$class',subscription_level='$sub',
                vendor_id='$vendor',link='$link',topic_id='$topic',inst_id='$inst_id',cc_id='$Userid' where quiz_id= '$quiz_id'";
                $conn->query($test_up);
                echo "updated";        
     }
    else if ($_POST['action']=='publish')
    {   $check="SELECT * FROM school__quiz WHERE quiz_title = '$quiz_title'";
        $result1 = $conn->query($check);
        $num_rows = mysqli_num_rows($result1);    
        if ($num_rows>=1) 
        {        
        echo "exists";        
         }     
        else 
        {                     
                            $sql = "INSERT INTO school__quiz  (quiz_title,quiz_details,no_of_questions,quiz_creator,mrp_price,
                            school_price,club_id,class_applicable_for,subscription_level,vendor_id,link,topic_id,inst_id,cc_id)
                             VALUES ('$quiz_title','$quiz_details','$no_of_questions','$quiz_creator','$price','$school_price',
                             '$club_id','$class','$sub','$vendor','$link','$topic','$inst_id','$Userid');";
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
                                                $quiz_id = "sc_quiz_".$var."";
                                                $sqli = "UPDATE  school__quiz SET quiz_id = '$quiz_id' where sno= $var";         
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














