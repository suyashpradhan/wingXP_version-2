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
if(isset($_SESSION['mob_otp']) and isset($_POST['mob_otp'])){
    if($_SESSION['mob_otp']==$_POST['mob_otp']){
        header('Location: http://www.wingxp.com/login/student_panel/new_design/student_dashboard_final.php?user=guest&id=club_21');
        header('Location: http://www.wingxp.com/login/student_panel/new_design/student_dashboard_final.php?user=guest&id=club_21');
    }
    else{
        echo '<script>alert("Incorrect OTP");</script>';
    }
}

    if(isset($_POST['phone']) )
{ 
$key = "124046AH1JdQvqo658c7bdff";
$send_id = "OLCBSE";
$otp=rand(1000, 9999);
$_SESSION['mob_otp']=$otp;
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
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <title>WingXP Home Page</title>
    <link rel="stylesheet" href="http://wingxp.com/main_blue.css">
    <link rel="icon" href="http://wingxp.com/favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="http://wingxp.com/owl.carousel.min.css">
    <link rel="stylesheet" href="http://wingxp.com/owl.theme.default.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id='navbar-hide' style="background-color:#17a2b8; color:#fff;">
       <a class="navbar-brand" href="http://www.wingxp.com"> 
      <span style="color: #fff !important; font-weight:1000; font-size: 26px;margin: 0;padding: 0;">wingxp</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://www.wingxp.com/login">Login</a>
                </li>
               <li class="nav-item">  <a class="nav-link" href="http://www.wingxp.com/login/school_registration.php">Sign Up</a>  </li>
            </ul>
        </div>
    </nav>
            
                    <div class="container" style="margin-top:10%;">
                          <div class="row">
                              <form id="demo_detail" action="verify.php" method="POST" class="demo_new-wrap">                          
                                  <div class="form-group">
                                      <input class="form-control" type="number" name="mob_otp" id="mob_otp" placeholder="Enter OTP" 
                                          required>
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" class="submit-modal-btn" >Verify</button>
                                  </div>                                
                              </form>
                              
                              </div>
                          </div>
