<?php 
session_start();
include ("../../assets/Users.php");
$database = new Database();
$db = $database->getConnection();?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin Panel - SpacedTimes</title>
<!--style sheet-->

 
  
<link rel="stylesheet" media="screen" href="/storemanager/main.css"/>
<link rel="stylesheet" href="http://www.testune.com/spacedtimes/fancybox/jquery-ui.css" />
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script>var $j = jQuery.noConflict(true);</script>
<script>
  $j( function() {
    dateFormat: "yy-mm-dd"
    $j( "#datepicker,#start,#end" ).datepicker({
  dateFormat: "yy-mm-dd"
});
  });
  </script>  


</head>

<div class="navbar navbar-shadow" style="height:70px;margin: 0">
        <div class="newnavigationBar_2">
            <a href="index.php" style=" text-decoration:none;">
                <span style="color: #17a2b8 !important; font-weight:1000; font-size: 32px;margin: 0;padding: 0 20px; text-decoration:none;">wingxp</span>
                <div class="menu-wrapper">
                    <a href="?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
                </div>
         </div>
    </div>