<?php 
include_once "../assets/Users.php";
$database = new Database();
session_start();
$inst_id=$_SESSION['inst_id'];
$Userid = $_SESSION['Userid'];
$conn = $database->getConnection();
if(isset($_GET['checked_dep'])){$checked_dep = mysqli_real_escape_string($conn,$_GET['checked_dep']);}else{$checked_dep = '';}
if(isset($_GET['unchecked_dep'])){$unchecked_dep = mysqli_real_escape_string($conn,$_GET['unchecked_dep']);}else{$unchecked_dep = '';}
if(isset($_GET['checked_hold'])){$checked_hold = mysqli_real_escape_string($conn,$_GET['checked_hold']);}else{$checked_hold = '';}
if(isset($_GET['unchecked_hold'])){$unchecked_hold = mysqli_real_escape_string($conn,$_GET['unchecked_hold']);}else{$unchecked_hold = '';}
    function update($box,$status,$inst_id,$conn){
        $box_exp = explode(',', $box);
        foreach($box_exp as $club){
        $add_club="update inst_club_assign set status='$status' where institute_id='$inst_id' and club_id='$club'";
        $result = $conn->query($add_club);
        
    }
    return $result;
}
    $result1 = update($checked_dep,'1',$inst_id,$conn);
    $result2 = update($unchecked_dep,'',$inst_id,$conn);
    $result3 = update($checked_hold,'1',$inst_id,$conn);
    $result4 = update($unchecked_hold,'',$inst_id,$conn);
    if ($result1 and $result2 and $result3 and $result4)
                            {                    
                                echo "success";                                                
                            }
                            else{
                                echo "Error ! Not deployed";                                
                            }
                     
        $conn->close();
        