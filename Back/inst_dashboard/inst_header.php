<?php 
include("assets/php/database.php"); 
include("assets/php/class.acl.php");
// include_once "class_admin.php";
$database = new Database();
$db = $database->getConnection();
$myACL = new ACL($db);
if ($myACL->hasPermission('access_admin') != true)
{
	//header("location: ../index.php");
}
include_once "assets/Users.php";
$user = new User($db);
$uid = $_SESSION['Userid'];
if(!$user->get_session())
{
    header("location:index.php");
}
if(isset($_GET['q']))
{ 
        if($_GET['q'] == "logout")
  	{
		$user->user_logout();
	   	header("location:index.php");
	}
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>School Dashboard Panel</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="main.css">
		<script type="text/javascript" src="fancybox/jquery.min.js"></script>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
                <script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
                <script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
                <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" />
                 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
               <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">   
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
   <script>    
     var $k = jQuery.noConflict(true);
     var $j = jQuery.noConflict(true);
</script>    
<script>                
$k(document).ready(function () {     
       $k(".datepicker").datepicker();  
	   });    
</script>
                <script type="text/javascript">
		$j(document).ready(function() {
				$("a.pop2").fancybox({
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});
		      	$j("a.pop").fancybox({
			           'type': 'iframe',
				   'autoScale': true,
				   'autoDimensions': true,
					//'title'	  : 'By domain E',
				   'fitToView' : true,
			     	 //  'width'	: 'auto',
			      //'height'	: 'auto',
				//  'overlayShow'	: true,
				//'transitionIn'	: 'elastic',
				//'transitionOut'	: 'elastic',
                                 'onComplete': function() {
                                 // $("#fancybox-wrap").css({'left':'700px','right':'auto'});
                                 }
			});
                       $j("a.view_comment").fancybox({
				    'type':'iframe',
			       'width' : 570,
                                'height':100,
                                'href':this.href,
                                'showCloseButton'   : true,
                                 'hideOnOverlayClick': false,
                                  'hideOnContentClick' :   false,
				});  
                        
                       $j("a.teacher_login_form").fancybox({
			        'type':'iframe',
				'width' :750,
                                'height':530,
                                'href':this.href,
                                'showCloseButton'   : true,
                                'hideOnOverlayClick': false,
                                'hideOnContentClick' :   false,
				});   
                    });                                     
</script>
       
             <!-- Page Wrapper -->
		<?php /*	<div id="page-wrapper" style="background-color:#fff;">

				<!-- Header -->
					<header id="header">
                                                   <div class="logoBox">
                                                             <a href="inst_dashboard.php"><img src="assets/images/logo.png" alt="" class="logo-img" style="margin:15px;height: 80px;padding: 3px"> 
                                                   </div>
						 
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="?q=logout" class="login_out" class="menuToggle"><span>Log Out</span></a>  
								</li>
							</ul>
						</nav>
					</header> */ ?>


    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
    <link rel="stylesheet" href="assets/css/main.css">
    <style>
        body::after {
            content: "";
            display: block;
            height: 60px;
        }
    </style>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  </head>
<body>

    <div class="navbar navbar-shadow" style="height: 110px;">
        <div class="newnavigationBar">
            <a href="inst_dashboard.php">
                <img src="assets/images/logo.png" alt="" style="margin:10px;height: 90px;"></a>
            <div class="menu-wrapper">
                <a href="?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
            </div>
        </div>
    </div>

<!-- <div class="navigationBar">
            <a href="inst_dashboard.php"><img src="assets/images/logo.png" alt="" class="logo-img" style="margin:15px;height: 80px;padding: 3px"></a>
        <div class="menu-wrapper" style="margin-right:30px;">
           <a href="?q=logout" class="logout">Logout</a>
        </div>
</div> -->