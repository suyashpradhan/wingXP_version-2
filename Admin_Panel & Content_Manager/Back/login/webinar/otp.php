<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
if(isset($_POST['school_name'])){$school_name = mysqli_real_escape_string($conn,$_POST['school_name']);}else{$school_name = '';}
if(isset($_POST['phone'])){$phone = mysqli_real_escape_string($conn,$_POST['phone']);}else{$phone = '';}
if(isset($_POST['email'])){$email = mysqli_real_escape_string($conn,$_POST['email']);}else{$email = '';}
if(isset($_POST['name'])){$name = mysqli_real_escape_string($conn,$_POST['name']);}else{$name = '';}
if(isset($_POST['des'])){$des = mysqli_real_escape_string($conn,$_POST['des']);}else{$des = '';}
if(isset($_POST['mob_otp'])){$mob_otp = mysqli_real_escape_string($conn,$_POST['mob_otp']);}else{$mob_otp = '';}
if(isset($_POST['action']) and $_POST['action']=='verify'){
    if(isset($_POST['mob_otp'])){            
        $validate=$conn->query("select * from school__web_reg where otp='$mob_otp'");
        $present=$validate->num_rows;
        if($present>0){
        echo 'verified';
        }
        else{
        echo 'notverified';
        }
    }
}
if(isset($_POST['action']) and $_POST['action']=='get_otp'){
$check=$conn->query('select datetime from school__web_reg where phone="'.$phone.'"');
$present=$check->num_rows;
if($present!==0){
    $row=$check->fetch_array();
    $prev = strtotime(date("Y-m-d", strtotime("-15 days")));
    if(strtotime($row['datetime'])>$prev){
        echo 'present';
    }
else{  
    
    if(isset($_POST['action']) and $_POST['action']=='get_otp')
    { 
$key = "124046AH1JdQvqo658c7bdff";
$send_id = "OLCBSE";
$otp=rand(1000, 9999);
$message = "Your OTP for iClubs Registration is :".$otp;
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
else if(isset($_POST['phone']))
{
$validate="insert into school__web_reg (school_name,email,phone,designation,name,otp) values ('$school_name','$email','$phone','$des','$name','$otp');";
if($conn->query($validate)){
    echo 'success';
}

 } 
curl_close($ch);
    }
}
}
else{
    if(isset($_POST['action']) and $_POST['action']=='get_otp')
    { 
$key = "124046AH1JdQvqo658c7bdff";
$send_id = "OLCBSE";
$otp=rand(1000, 9999);
$message = "Your OTP for iClubs Registration is :".$otp;
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
else if(isset($_POST['phone']))
{
$validate="insert into school__web_reg (school_name,email,phone,designation,name,otp) values ('$school_name','$email',$phone,'$des','$name','$otp');";
if($conn->query($validate)){
    echo 'success';
}

 } 
curl_close($ch);
    }
}}

