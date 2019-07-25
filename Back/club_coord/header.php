<?php 
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$_SESSION['club_id']='club_21';
$_SESSION['inst_id']="INST_258";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Club Coordinator Panel- WingXP</title>
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">    
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
</head>
<body>

 <!-- <div class="navbar navbar-shadow" style="height: 110px;">
        <div class="newnavigationBar_2">
            <a href="index.php">
                <img src="http://www.iclubs.in/assets/images/logo.png" alt="" style="margin:10px;height: 90px;"></a>
            <div class="menu-wrapper">
                <a href="?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
            </div>
            <div class="menu-wrapper">
                <a href="deployed_activities.php" class="fancy-button bg-gradient2 logout-nav-link"><span>View Deployed Activities</span></a>
            </div>
        </div>
    </div> -->


 <div class="navbar navbar-shadow" style="height:70px;margin: 0">
        <div class="newnavigationBar_2">
            <a href="index.php">
                <span style="color: #17a2b8 !important; font-weight:1000; font-size: 32px;margin: 0;padding: 0 20px;text-decoration: none;">wingxp</span>
                <div class="menu-wrapper">
                    <a href="?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
                </div>
                <div class="menu-wrapper">
                    <a href="deployed_activities.php" class="fancy-button bg-gradient2 logout-nav-link"><span>View Deployed Activities</span></a>
                </div>
        </div>
    </div> 
