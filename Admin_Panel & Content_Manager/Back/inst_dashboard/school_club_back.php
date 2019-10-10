<?php 
include_once "../assets/Users.php";
$database = new Database();
session_start();
$inst_id = $_SESSION['Userid'];

$club_cat='CCI_8';
$conn = $database->getConnection();
if(isset($_POST['class'])){$class = mysqli_real_escape_string($conn,$_POST['class']);}else{$class = '';}
if(isset($_POST['gender'])){$gender = mysqli_real_escape_string($conn,$_POST['gender']);}else{$gender = '';}
if(isset($_POST['status'])){$status = mysqli_real_escape_string($conn,$_POST['status']);}else{$status = '';}
if(isset($_POST['message'])){$message = mysqli_real_escape_string($conn,$_POST['message']);}else{$message = '';}
$from =date('Y-m-d',strtotime(mysqli_real_escape_string($conn,$_POST['from'])));
$to=date('Y-m-d',strtotime(mysqli_real_escape_string($conn,$_POST['to'])));
$club_name = mysqli_real_escape_string($conn,$_POST['club_name']);
$club_desc = mysqli_real_escape_string($conn,$_POST['club_desc']);
$pres_post = mysqli_real_escape_string($conn,$_POST['pres_post']);
$pres_name = mysqli_real_escape_string($conn,$_POST['pres_name']);
$bearer_post = mysqli_real_escape_string($conn,$_POST['bearer_post']);
$bearer_name = mysqli_real_escape_string($conn,$_POST['bearer_name']);

   
    if(isset($_POST['action']) and $_POST['action']=='publish'){
        $add_club="insert into school__clubs (club_name,club_description,club_category_id,
        pres_post,pres_name,bearer_post,bearer_name, class, gender, 
        from_date, to_date, inst_id,status,message)
    values ('$club_name','$club_desc','$club_cat','$pres_post',
    '$pres_name','$bearer_post','$bearer_name','$class','$gender','$from','$to','$inst_id','$status','$message');";
    $add_club .= "SELECT LAST_INSERT_ID()";
    if ($conn->multi_query($add_club))
                            {       
                                do {
                                    
                                            if ($result = $conn->store_result()) 
                                            {
                                                while ($row = $result->fetch_row()) 
                                                {               
                                                $var = (string) $row[0];
                                                }                                                
                                                $club_id = "school_club_".$var."";
                                                $up_id = "UPDATE  school__clubs SET club_id = '$club_id' where sno= $var";         
                                                $conn->query($up_id);
                                                echo "success";
                                                $result->free();
                                                $q='select * from cc_club_assign where inst_id="'.$_SESSION['Userid'].'" and club_id="'.$_POST['id'].'" and club_coordinator_id="'.$_POST['pres_post'].'"';
                                                $result=$conn->query($q);
                                                if($result->num_rows>0){
                                                }
                                                else{
                                                    $q='insert into cc_club_assign set club_coordinator_id="'.$_POST['pres_post'].'", inst_id="'.$_SESSION['Userid'].'", club_id="'.$club_id.'"';
                                                    $conn->query($q);   
                                                }
                                                $q='select * from cc_club_assign where inst_id="'.$_SESSION['Userid'].'" and club_id="'.$_POST['id'].'" and club_coordinator_id="'.$_POST['bearer_post'].'"';
                                                $result=$conn->query($q);
                                                if($result->num_rows>0){
                                                }
                                                else{
                                                    $q='insert into cc_club_assign set club_coordinator_id="'.$_POST['bearer_post'].'", inst_id="'.$_SESSION['Userid'].'", club_id="'.$club_id.'"';
                                                    $conn->query($q);   
                                                }
                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            }
                            else{
                                echo "Error ! Not deployed";                                
                            }
                        }
        else if(isset($_POST['action']) and $_POST['action']=='update'){
            $club_id_select=$_POST['id'];
            $club_update = "UPDATE  school__clubs SET club_name = '$club_name', club_description='$club_desc',club_category_id='$club_cat',
            pres_post='$pres_post',pres_name='$pres_name',bearer_post='$bearer_post',
            bearer_name='$bearer_name',class='$class',gender='$gender',from_date='$from',to_date='$to',status='$status',message='$message' where club_id= '$club_id_select'";
            $q='select * from cc_club_assign where inst_id="'.$_SESSION['Userid'].'" and club_id="'.$_POST['id'].'" and club_coordinator_id="'.$_POST['pres_post'].'"';
            $result=$conn->query($q);
            if($result->num_rows>0){
            }
            else{
                $q='insert into cc_club_assign set club_coordinator_id="'.$_POST['pres_post'].'", inst_id="'.$_SESSION['Userid'].'", club_id="'.$_POST['id'].'"';
                $conn->query($q);   
            }
            $q='select * from cc_club_assign where inst_id="'.$_SESSION['Userid'].'" and club_id="'.$_POST['id'].'" and club_coordinator_id="'.$_POST['bearer_post'].'"';
            $result=$conn->query($q);
            if($result->num_rows>0){
            }
            else{
                $q='insert into cc_club_assign set club_coordinator_id="'.$_POST['bearer_post'].'", inst_id="'.$_SESSION['Userid'].'", club_id="'.$_POST['id'].'"';
                $conn->query($q);   
            }
            if($conn->query($club_update)){
                echo 'updated';
            }
            else{
                echo 'error';
            }

        }
        $conn->close();
        