<?php 
session_start();
$club_id = 'club_web';
$inst_id = 'inst_1';
//$club_id = $_SESSION['cid'];
//$inst_id = $_SESSION['inst_id'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$test_name = $_POST['title'];
$test_data = $_POST['editor1'];
$duration = $_POST['duration'];
$test_creator = $_POST['author'];
$price = $_POST['mrp_price'];
$school_price = $_POST['school_price'];
$vendor = $_POST['vendor'];
$topic = $_POST['topic'];
$class = $_POST['class'];
$sub=$_POST['sub'];
if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    { 
    
                $test_id=$_POST['id'];
                $test_up = "UPDATE  school__online_test SET test_name = '$test_name', test_data='$test_data',duration='$duration',
                test_creator='$test_creator',school_price='$school_price',mrp_price='$price',club_id='$club_id',class_applicable_for='$class',
                subscription_level='$sub',vendor_id='$vendor',topic_id='$topic',inst_id='$inst_id' where test_id= '$test_id'";

                $conn->query($test_up);
                echo "updated";
        
     }


    else if ($_POST['action']=='publish')
    {   $check="SELECT * FROM school__online_test WHERE test_name = '$test_name'";
        $result1 = $conn->query($check);
        $num_rows = mysqli_num_rows($result1);
    
        if ($num_rows>=1) 
        {        
        echo "exists";        
         } 
    
        else 
        {
         
                            
                            $sql = "INSERT INTO school__online_test  (test_name,test_data,duration,test_creator,mrp_price,
                            school_price,club_id,class_applicable_for,subscription_level,vendor_id,topic_id,inst_id)
                             VALUES ('$test_name','$test_data','$duration','$test_creator','$price','$school_price',
                             '$club_id','$class','$sub','$vendor','$topic','$inst_id');";
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
                                                
                                                $test_id = "test_".$var."";
                                                $sqli = "UPDATE  school__online_test     SET test_id = '$test_id' where sno= $var";         
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














