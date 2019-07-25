<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
if(isset($_POST['school_name'])){$school_name = mysqli_real_escape_string($conn,$_POST['school_name']);}else{$school_name = '';}
if(isset($_POST['school_no'])){$school_phone = mysqli_real_escape_string($conn,$_POST['school_no']);}else{$school_phone = '';}
if(isset($_POST['school_add'])){$school_add = mysqli_real_escape_string($conn,$_POST['school_add']);}else{$school_add = '';}
if(isset($_POST['school_email'])){$school_email = mysqli_real_escape_string($conn,$_POST['school_email']);}else{$school_email = '';}
if(isset($_POST['prin_name'])){$prin_name = mysqli_real_escape_string($conn,$_POST['prin_name']);}else{$prin_name = '';}
if(isset($_POST['prin_phone'])){$prin_phone = mysqli_real_escape_string($conn,$_POST['prin_phone']);}else{$prin_phone = '';}
if(isset($_POST['prin_email'])){$prin_email = mysqli_real_escape_string($conn,$_POST['prin_email']);}else{$prin_email = '';}
if(isset($_POST['mob_otp'])){$mob_otp = mysqli_real_escape_string($conn,$_POST['mob_otp']);}else{$mob_otp = '';}
if(isset($_POST['email_otp'])){$email_otp = mysqli_real_escape_string($conn,$_POST['email_otp']);}else{$email_otp = '';}
$check=$conn->query("select * from institution where email_id ='$school_email'");
$present=$check->num_rows;
if($present!==0){
    echo 'present';
    die;
}
else
{   
    if(isset($_POST['action']) and $_POST['action']=='verify'){
        if(isset($_POST['mob_otp'])){            
            $validate=$conn->query("select * from school__enquiry where otp='$mob_otp'");
            $present=$validate->num_rows;
            if($present>0){
            echo 'verified';
            }
            else{
            echo 'notverified';
            }
        }
    }
    else if(isset($_POST['action']) and $_POST['action']=='get_otp')
    { 
$key = "124046AH1JdQvqo658c7bdff";
$send_id = "OLCBSE";
$otp=rand(1000, 9999);
$otp_email=rand(1000, 9999);
$message = "Your OTP for iClubs Registration is :".$otp;
$route = "route=4";
$data = array(
'authkey' => $key,
'mobiles' => $school_phone,
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
$subject = "Here's your OTP for iClubs!";
$message="Dear School Leader,<br><br>
You are just a step away from creating your account on iClubs platform.<br><br>
We are sharing a verification code to verify your account details.
 The code is valid for 60 minutes and usable only once. This is to ensure that only you have access to your account.<br><br>
 Your OTP:".$otp_email."<br>
 Expires in: 60 minutes only<br><br>
 Best Regards, <br>
 Team iClubs<br><br>
 <a href='www.iclubs.in' target='_blank'><img alt='www.iclubs.in' src='http://www.iclubs.in/student_panel/new_design/assets/images/email_logo.png'
 style='outline: 0px;
 text-align: center;
 box-sizing: border-box;
 margin: 10px 0px 0px 30px;
 padding: 0px;
 font-family: Nunito,sans-serif;
 vertical-align: middle;
 border-style: none;
 height: 80px;
 display: block;
 color: rgb(33,37,41);
 font-size: 16px;'></a>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers.= "Content-type:text/html;charset=iso-8859-1"."\r\n";
$headers.= "From:contact@iclubs.in"; 
//mail($school_email,$subject,$message,$headers);
if(isset($_POST['school_no']))
{
$_SESSION['school_name']=$_POST['school_name'];
$_SESSION['school_no']=$_POST['school_no'];
$_SESSION['school_email']=$_POST['school_email'];
$_SESSION['otp']=$otp;
$validate="insert into school__enquiry (school_name,email,phone,address,principal_name,principal_email,
principal_phone,otp,otp_email) values ('$school_name','$school_email','$school_phone','$school_add','$prin_name',
'$prin_email','$prin_phone','$otp','$otp_email');";
$validate .= "SELECT LAST_INSERT_ID()";  
if ($conn->multi_query($validate))
                            {       
                                do {
                                    
                                            if ($result = $conn->store_result()) 
                                            {
                                                while ($row = $result->fetch_row()) 
                                                {               
                                                $var = (string) $row[0];
                                                }
                                                
                                                $enquiry_id = "enq_".$var."";
                                                $sqli = "UPDATE  school__enquiry SET enquiry_id = '$enquiry_id' where sno= $var";         
                                                $conn->query($sqli);
                                                $result->free();
                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            }
echo 'success'; } 
}
curl_close($ch);
    }
}
