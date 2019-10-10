<?php 
session_start();
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_POST['school_name'])){$school_name = mysqli_real_escape_string($conn,$_POST['school_name']);}else{$school_name = '';}
if(isset($_POST['phone'])){$phone = mysqli_real_escape_string($conn,$_POST['phone']);}else{$phone = '';}
if(isset($_POST['email'])){$email = mysqli_real_escape_string($conn,$_POST['email']);}else{$email = '';}
if(isset($_POST['name'])){$name = mysqli_real_escape_string($conn,$_POST['name']);}else{$name = '';}
if(isset($_POST['des'])){$des = mysqli_real_escape_string($conn,$_POST['des']);}else{$des = '';}
if(isset($_POST['mob_otp'])){$mob_otp = mysqli_real_escape_string($conn,$_POST['mob_otp']);}else{$mob_otp = '';}
    if(isset($_POST['phone'])){            
            
                $validate="INSERT into school__web_reg (name,phone,school_name) values ('$name','$phone','$school_name')";     
                if ($conn->query($validate)) {
                            $email_ids = 'contact@domain-education.com,abhishek1404@gmail.com,swapnil.ajmera@gmail.com'; 
                            $email_ids.='nkirandroid@gmail.com';
                            $subject = '"'.$school_name.'" Webinar Registration';
                            $message="<b>School Name:</b><br><br>$school_name <br><br><b>Name:</b><br><br>$name <br><br> <b>Phone No:</b>$phone <br><br> <b>Designation: </b>$des <br><br> <b>Email:</b>$email  <br><br>  has <b> Registered </b> through the website" ;
                            $header = "MIME-Version: 1.0" . "\r\n";
                            $header.= "Content-type:text/html;charset=iso-8859-1"."\r\n";
                            $header.= "From:contact@livecbse.com"; 
                            //mail($email_ids,$subject,$message,$header);    
                            echo 'success';                       
                }
            
            else{
            echo 'error';
            }
        }     
    

    $conn->close();














