<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_POST['exp_id'])){
    if(isset($_POST['list_exp'])){$exp=mysqli_real_escape_string($conn,$_POST['list_exp']);}else{$exp='';}
    if(isset($_POST['connect'])){$connect=mysqli_real_escape_string($conn,$_POST['connect']);}else{$connect='';}
    if(isset($_POST['link1'])){$link1=mysqli_real_escape_string($conn,$_POST['link1']);}else{$link1='';}
    if(isset($_POST['link2'])){$link2=mysqli_real_escape_string($conn,$_POST['link2']);}else{$link2='';}
    if(isset($_POST['link3'])){$link3=mysqli_real_escape_string($conn,$_POST['link3']);}else{$link3='';}
    if(isset($_POST['link4'])){$link4=mysqli_real_escape_string($conn,$_POST['link4']);}else{$link4='';}
    if(isset($_POST['exp_id'])){$exp_id=mysqli_real_escape_string($conn,$_POST['exp_id']);}else{$exp_id='';}
        function save($id){
            $target_dir = "../assets/expert/files/";
            $f = basename($_FILES[$id]["name"]);
            $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
            $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
            move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir.$file);
            return $file;
        }      
        $f1=save('file1');$f2=save('file2');$f3=save('file3');
        $query="UPDATE expert SET expertise='$exp',connect_desc='$connect',link1='$link1',
        link2='$link2',link3='$link3',link4='$link4',file1='$f1',file2='$f2',file3='$f3' where exp_id='$exp_id'";
        if($conn->query($query)){
            //THANK YOU
        }
        else{
            echo '<script>alert("Error in the System, please try later");</script>';
        } 
}
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="main.1.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top display-block" id="navbar-hide" style="background-color:#17a2b8; color:#fff;">
        <a class="navbar-brand" href="http://www.wingxp.com">
            <span style="color: #fff !important; font-weight:1000; font-size: 32px;margin: 0;padding: 0;">wingxp</span></a>
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
                    <a class="nav-link" href="http://www.wingxp.com">Login</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="http://iclubs.in/school_registration.php">Sign Up</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="limiter">
        <div class="container-login100_two">
            <div class="wrap-login100_two">
                <div class="top_nav">
                    <div class="top_nav-common top_nav-one">
                        <h1 class="top_nav-header nav_header-one">Personal Details</h1>
                    </div>
                    <div class="top_nav-common top_nav-two">
                        <h1 class="top_nav-header nav_header-two">Your Expression</h1>
                    </div>
                    <div class="top_nav-common top_nav-three">
                        <h1 class="top_nav-header nav_header-three">Account/Billing Info</h1>
                    </div>
                </div>
                <h1 class="common-head">Thank You for your Expression. This is just data we need more form you !
                    <span>
                        <hr class="common-hr"></span>
                </h1>
                <button class="submit-btn_new" ><a href="http://wingxp.com" style="color:#fff;">Home</a></button>
        </div><br><br>
        <div style="max-width: 100%;background-color: #696969;">
            <div class="footer">
                <div class="footer-width">
                    <div class="left-footer" style="text-align: left;" id="lab_social_icon_footer">
                        <i id="social-lk" class="fab fa-linkedin fa-2x social"></i></a>
                        <i id="social-fb" class="fab fa-facebook-square fa-2x social"></i></a>
                        <i id="social-tw" class="fab fa-twitter-square fa-2x social"></i></a>
                    </div>
                    <div class="center-footer">
                        &copy; Copyright – WingXP 2019
                    </div>
                    <div class="right-footer">
                        <a href="#">Privacy Policy</a> <span style="color: #fff;">|</span> <a href="#">Terms Of Use</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
</body>
<script>
    function check(e){
        if($('#'+e).prop('checked')==true){
            
        }
        else{
            $('#'+e+'_sub :input').prop("checked",false);
        }
        
    }
    </script>

</html>