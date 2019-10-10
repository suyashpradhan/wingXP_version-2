<?php
include_once "../../assets/Users2.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
if(isset($_POST['name'])){$name = mysqli_real_escape_string($conn,$_POST['name']);}else{$name = '';}
if(isset($_POST['phone'])){$phone = mysqli_real_escape_string($conn,$_POST['phone']);}else{$phone = '';}
if(isset($_POST['class'])){$class = mysqli_real_escape_string($conn,$_POST['class']);}else{$class = '';}
if(isset($_POST['email'])){$email = mysqli_real_escape_string($conn,$_POST['email']);}else{$email = '';}
if(isset($_POST['country'])){$country = mysqli_real_escape_string($conn,$_POST['country']);}else{$country = '';}
if(isset($_POST['password'])){$password = mysqli_real_escape_string($conn,$_POST['password']);}else{$password = '';}
if(isset($_POST['mob_otp'])){$mob_otp = mysqli_real_escape_string($conn,$_POST['mob_otp']);}else{$mob_otp = '';}
if(isset($_POST['login'])){
    $q="select * from app_user where mobile='$phone' and password='$password'";
    $result=$conn->query($q);
    if($result->num_rows > 0){
        echo 'success';
    }
    else{
        echo 'error';
    }
}
else{
$check=$conn->query("select * from app_user where mobile ='$phone'");
$present=$check->num_rows;
if($present!==0){
    echo 'present';
    die;
}
else if(isset($_POST['action']) and $_POST['action']=='verify'){
        if(isset($_POST['mob_otp'])){      
            $sess_otp=$_SESSION['otp'];
            if($sess_otp==$_POST['mob_otp']){
                
            $validate=$conn->query("select * from enquiry where otp='$sess_otp'");
            $present=$validate->num_rows;
            if($present>0){
            //SIGNUP
            
            $sql = "INSERT INTO app_user (name, mobile, class_applied, country,password,status) VALUES ('$name','$phone','$class','$country','$password','1');";
            $sql .= "SELECT LAST_INSERT_ID()"; 
            $sql2="UPDATE enquiry set status=1 where otp='$mob_otp'";
            $conn->query($sql2);                
            if ($conn->multi_query($sql)) {
                //echo 1;
                do {
                    if ($result = $conn->store_result()) {
                        while ($row = $result->fetch_row()) {
                            $var = (string) $row[0];
                        }
                        $user_id = "ST_".$var."";
                        $sqli = "UPDATE app_user SET user_id = '$user_id' where sno= $var";
                        
                        if($conn->query($sqli)){
                            echo 'verified';                      
                        }
                        else{
                            echo 'error';
                        }
                    }
                } while ($conn->next_result());
            }
        }
                
            //SIGNUP
            }
            else{
            echo 'notverified';
            }
            }
            else{
                echo 'nootp';
            }
        }
    
    else if(isset($_POST['action']) and $_POST['action']=='get_otp')
    { 
$key = "124046AH1JdQvqo658c7bdff";
$send_id = "OLCBSE";
$otp=rand(1000, 9999);
$_SESSION['otp']=$otp;
$message = "Your OTP for LiveCBSE Registration is :".$otp;
$route = "route=4";
$data = array(
'authkey' => $key,
'mobiles' => $phone,
'message' => $message,
'sender' => $send_id,
'route' => $route
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
$save_data="insert into enquiry (name,phone,class,country,otp) values ('$name','$phone','$class','$country','$otp');";
$save_data .= "SELECT LAST_INSERT_ID()"; 
if ($conn->multi_query($save_data))
                            {       
                                do {
                                    
                                            if ($result = $conn->store_result()) 
                                            {
                                                while ($row = $result->fetch_row()) 
                                                {               
                                                $var = (string) $row[0];
                                                }
                                                
                                                $enquiry_id = "enq_".$var."";
                                                $sqli = "UPDATE  enquiry SET enquiry_id = '$enquiry_id' where sno= $var";         
                                                $conn->query($sqli);
                                                $result->free();
                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            }
echo 'success'; 
}
curl_close($ch);
    }
    
}