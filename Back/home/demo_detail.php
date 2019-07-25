<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_POST['sname'])){$school_name = mysqli_real_escape_string($conn,$_POST['sname']);}else{$school_name = '';}
if(isset($_POST['phone'])){$phone = mysqli_real_escape_string($conn,$_POST['phone']);}else{$phone = '';}
if(isset($_POST['email'])){$email = mysqli_real_escape_string($conn,$_POST['email']);}else{$email = '';}
if(isset($_POST['name'])){$name = mysqli_real_escape_string($conn,$_POST['name']);}else{$name = '';}
if(isset($_POST['des'])){$des = mysqli_real_escape_string($conn,$_POST['des']);}else{$des = '';}
if(isset($_POST['c_name'])){$c_name = mysqli_real_escape_string($conn,$_POST['c_name']);}else{$c_name = '';}
if(isset($_POST['c_sname'])){$c_sname = mysqli_real_escape_string($conn,$_POST['c_sname']);}else{$c_sname = '';}
if(isset($_POST['msg'])){$msg = mysqli_real_escape_string($conn,$_POST['msg']);}else{$msg = '';}
if(isset($_POST['c_phone'])){$c_phone = mysqli_real_escape_string($conn,$_POST['c_phone']);}else{$c_phone = '';}
if(isset($_POST['mob_otp'])){$mob_otp = mysqli_real_escape_string($conn,$_POST['mob_otp']);}else{$mob_otp = '';}
    if(isset($_GET['action']) and $_GET['action']=='demo'){            
            
                $validate="INSERT INTO demo_user  (name,email,type,phone) VALUES ('$name','$school_name','demo','$phone') ";     
                if ($conn->query($validate)) {
                            $email_ids = 'contact@domain-education.com,abhishek1404@gmail.com,swapnil.ajmera@gmail.com'; 
                            $email_ids.='nkirandroid@gmail.com';
                            $subject = '"'.$name.'" from "'.$school_name.'" viewed Sample Demo ';
                            $message="<b>School Name:</b><br><br>$school_name <br><br><b>Name:</b><br><br>$name <br><br> <b>Phone No:</b>$phone <br><br> <b>Designation: </b>$des <br><br> <b>Email:</b>$email  <br><br>  has <b> Registered </b> through the website" ;
                            $header = "MIME-Version: 1.0" . "\r\n";
                            $header.= "Content-type:text/html;charset=iso-8859-1"."\r\n";
                            $header.= "From:contact@wingxp.com"; 
                            //mail($email_ids,$subject,$message,$header);    
                            echo 'success';                       
                }
            
            else{
            echo 'error';
            }
        } 
        if(isset($_GET['action']) and $_GET['action']=='contact'){            
            
            $validate="INSERT into demo_user (name,phone,email,message,type) values ('$c_name','$c_phone','$c_sname','$msg','contact')"; 
            //echo $validate;    
            if ($conn->query($validate)) {
                        $email_ids = 'contact@domain-education.com,abhishek1404@gmail.com,swapnil.ajmera@gmail.com'; 
                        $email_ids.='nkirandroid@gmail.com';
                        $subject = '"'.$c_name.'" from "'.$c_sname.'" filled Contact Form ';
                        $message="<b>School Name:</b><br><br>$c_sname <br><br><b>Name:</b><br><br>$c_name <br><br> <b>Phone No:</b>$c_phone <br><br> <b>Message: </b>$msg <br><br> " ;
                        $header = "MIME-Version: 1.0" . "\r\n";
                        $header.= "Content-type:text/html;charset=iso-8859-1"."\r\n";
                        $header.= "From:contact@wingxp.com"; 
                        //mail($email_ids,$subject,$message,$header);    
                        echo 'success';                       
            }
        
        else{
        echo 'error';
        }
    }
    
    
    if(isset($_POST['action']) and $_POST['action']=='verify'){
        if(isset($_GET['mob_otp'])){    
            $mob_otp=$_GET['mob_otp'];        
            $validate="select * from demo_user where otp='$mob_otp'";
            $result=$conn->query($validate);
            
            $present=$result->num_rows;
            if($present>0){
            echo 'verified';
            }
            else{
            echo 'notverified';
            }
        }
    }

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
$validate="insert into demo_user (name,phone,email,type,otp) values ('$name','$phone','$school_name','demo','$otp');";
if($conn->query($validate)){
    echo 'success';
}

 } 
curl_close($ch);
    }



    

    $conn->close();














