<?php 
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
$type=$_POST['type'];
$id=$_POST['id'];
if(isset($_POST['class'])){$class = $_POST['class'];}else{$class = '';}
if(isset($_POST['gender'])){$gender = $_POST['gender'];}else{$gender = '';}
$from =date('Y-m-d',strtotime($_POST['from']));
$to=date('Y-m-d',strtotime($_POST['to']));
$student_price = $_POST['student_price'];
$flag=(preg_match('(school_club_)',$_SESSION['club_id'])? 1:0);
//$cc_id=$_SESSION['uid'];
$cc_id="cc_1";
switch ($type) {
    case 'article':    
        $sql=($flag == 0 ? "select mrp_price,school_price from article where article_id='$id'": 
        "select mrp_price,school_price from school__article where article_id='$id'");
        break;
    case 'online_test':  
    $sql=($flag == 0 ?"select mrp_price,school_price from online_test where test_id='$id'":     
    "select mrp_price,school_price from school__online_test where test_id='$id'");
        break;
    case 'ebook':        
    $sql=($flag == 0 ?"select mrp_price,school_price from ebook where book_id='$id'":
    "select mrp_price,school_price from school__ebook where book_id='$id'");
        break;
    case 'workshop':    
    $sql=($flag == 0 ?"select mrp_price,school_price from workshop where workshop_id='$id'":
    "select mrp_price,school_price from school__workshop where workshop_id='$id'");      
        break;
    case 'webinar':  
    $sql=($flag == 0 ?"select mrp_price,school_price from webinar where webinar_id='$id'":
    "select mrp_price,school_price from school__webinar where webinar_id='$id'");        
        break;        
    case 'video':  
    $sql=($flag == 0 ?"select mrp_price,school_price from video where video_id='$id'":
    "select mrp_price,school_price from school__video where video_id='$id'");        
        break;
    case 'live_course':  
    $sql=($flag == 0 ?"select mrp_price,school_price from live_course where course_id='$id'":
    "select mrp_price,school_price from school__live_course where course_id='$id'");        
        break; 
    case 'quiz':  
        $sql=($flag == 0 ?"select mrp_price,school_price from quiz where quiz_id='$id'":
        "select mrp_price,school_price from school__quiz where quiz_id='$id'");        
        break;   
    case 'learning_video':  
        $sql=($flag == 0 ?"select mrp_price,school_price from learning_video where video_id='$id'":
        "select mrp_price,school_price from school__learning_video where video_id='$id'");        
        break;
    case 'sample_work':  
        $sql=($flag == 0 ?"select mrp_price,school_price from sample_work where sample_work_id='$id'":
        "select mrp_price,school_price from school__sample_work where sample_work_id='$id'");        
        break;
    default:
        echo 'Please deploy again';
        
}
if(isset($_POST['id'])){
$result = $conn->query($sql);
    while($row = $result->fetch_array())
    {
     $price =$row['mrp_price'];
     $school_price =$row['school_price']; 
    }
}
else{

}    
    $dep='insert into deployment_control (activity_id,club_id, class, gender, from_date, to_date, student_price,club_coordinator_id,institute_id,mrp_price,school_price)
    values ("'.$id.'","'.$_SESSION['club_id'].'","'.$class.'","'.$gender.'","'.$from.'","'.$to.'","'.$student_price.'","'.$_SESSION['Userid'].'","'.$_SESSION['inst_id'].'","'.$price.'","'.$school_price.'");';
    $dep .= 'SELECT LAST_INSERT_ID()';
    $remove_rest_q='delete from activity_restrict where activity_id="'.$id.'" and institute_id="'.$_SESSION['inst_id'].'" and club_id="'.$_SESSION['club_id'].'"';
    $conn->query($remove_rest_q);
    if ($conn->multi_query($dep))
                            {       
                                do {
                                    
                                            if ($result = $conn->store_result()) 
                                            {
                                                while ($row = $result->fetch_row()) 
                                                {               
                                                $var = (string) $row[0];
                                                }
                                                
                                                $deploy_id = "dep_".$var."";
                                                $sqli = "UPDATE  deployment_control SET deploy_id = '$deploy_id' where sno= $var";         
                                                $conn->query($sqli);
                                                echo "success";
                                                $result->free();
                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            }
                            else{
                                echo "Error ! Not deployed";                                
                            }
        $conn->close();
        