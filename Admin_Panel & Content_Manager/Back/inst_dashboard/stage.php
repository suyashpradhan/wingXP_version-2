<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
function escape_data(){
    global $conn;
    foreach($_POST as $var => $val)
                {
                    $_POST[$var] = mysqli_real_escape_string($conn, $val);
                }
}
function send_sms(){
    $key = "124046AH1JdQvqo658c7bdff";
        $send_id = "WINGXP";
        $message = $_GET['institute_name']." with ID: ".$_GET['institute_id']." has notified attending ".$_GET['event'].", please click the link to mark attendance
        http://wingxp.com/login/storemanager/auto.php?event=".$_GET['event']."&id=".$_GET['institute_id']."&name=".urlencode($_GET['institute_name']);
        $route = "route=4";
        $data = array(
          'authkey' => $key,
        'mobiles' => '9137245036',
        'message' => $message,
        'sender' => $send_id,
        'route' => $route,
        );         
        $url="https://control.msg91.com/api/sendhttp.php";
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        if(curl_errno($ch))
        {
        echo 'error:' . curl_error($ch);
        }
        else{
          echo 'success';
        }  
        curl_close($ch);
}
 if(isset($_GET['stage'])){
     switch($_GET['stage']){
         case 1:
                escape_data();                                                   
                $q='UPDATE institution SET principal_name="'.$_POST['principal_name'].'",principal_phone="'.$_POST['principal_phone'].'",principal_email="'.$_POST['principal_email'].'",
                owner_name="'.$_POST['owner_name'].'",owner_phone="'.$_POST['owner_phone'].'",owner_email="'.$_POST['owner_email'].'",
                coordinator_name="'.$_POST['coordinator_name'].'",coordinator_phone="'.$_POST['coordinator_phone'].'",coordinator_email="'.$_POST['coordinator_email'].'",
                address2="'.$_POST['address2'].'",city="'.$_POST['city'].'",state="'.$_POST['state'].'",pincode="'.$_POST['pincode'].'",
                board="'.$_POST['board'].'",sess_start_date="'.$_POST['sess_start_date'].'",sess_end_date="'.$_POST['sess_end_date'].'",club_launch_date="'.$_POST['club_launch_date'].'",
                student_count="'.$_POST['student_count'].'" where institute_id="'.$_SESSION['Userid'].'"';
                $result=$conn->query($q);        
        break;
        case 2:
                $q='INSERT INTO webinar_attendance (web_id,id,type,status) VALUES ("'.$_POST['web_id'].'","'.$_SESSION['Userid'].'","school","0")';
                $result_0=$conn->query($q);
                $result=0;
                $response='pending';
        break;
        case 3:
                $q='select club_launch_date from institution where institute_id="'.$_SESSION['Userid'].'"';
                $res=$conn->query($q);
                $row=$res->fetch_array();
                foreach($_POST['clubs'] as $value){
                    $q='INSERT INTO inst_club_assign (institute_id,club_id,launch_date,status) values ("'.$_SESSION['Userid'].'","'.$value.'","'.$row['club_launch_date'].'","1")';
                    $result=$conn->query($q);  
                }
        break;
        case 4:
                $q='INSERT INTO webinar_attendance (web_id,id,type,status) VALUES ("'.$_POST['web_id'].'","'.$_SESSION['Userid'].'","school","0")';
                $result_0=$conn->query($q);
                $result=0;
                $response='pending';
        break;
        
     }
     if($result){
         $q='INSERT INTO school__stage (id,stage) values ("'.$_SESSION['sno_user'].'","s'.$_GET['stage'].'")';
         //echo $q;
            if($conn->query($q)){
                echo 'success';
            }
            else{
                echo 'error';
            }
     }
     else if($response=='pending'){
         echo 'pending';
     }

 }
 if(isset($_GET['event'])){
    switch($_GET['event']){
        case 'stage-2': send_sms();
        break;
        case 'stage-4': send_sms();
        break;
    }
        
 }