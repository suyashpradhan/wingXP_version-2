<?php
session_start();
$club_id=$_SESSION['club_id']="app";
include_once "../../assets/Users.php";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="http://www.testune.com/spacedtimes/content_manager/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"        crossorigin="anonymous"> 
<script type="text/javascript" src="http://www.testune.com/spacedtimes/fancybox/jquery.min.js"></script>
<script type="text/javascript" src="http://www.testune.com/spacedtimes/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="http://www.testune.com/spacedtimes/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.testune.com/spacedtimes/fancybox/jquery.fancybox-1.3.4.css" />
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script type="text/javascript">
		$(document).ready(function() {
				$("a.pop2").fancybox({
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});
			$("a.pop").fancybox({
			      'type': 'iframe',
				   'autoScale': true,
				'autoDimensions': true,
					//'title'	  : 'By domain E',
					'fitToView' : true,
				 //  'width'	: 'auto',
			      //'height'	: 'auto',
				//  'overlayShow'	: true,
				//'transitionIn'	: 'elastic',
				//'transitionOut'	: 'elastic'
			});
                        $("a.view_faculty_detail").fancybox({
				    'type':'iframe',
			       'width' :1200,
                                'height':800,
                                'href':this.href,
                                'showCloseButton'   : true,
                                 'hideOnOverlayClick': false,
                                  'hideOnContentClick' :   false,
				});
                             $("a.view_comment").fancybox({
				    'type':'iframe',
			       'width' : 570,
                                'height':100,
                                'href':this.href,
                                'showCloseButton'   : true,
                                 'hideOnOverlayClick': false,
                                  'hideOnContentClick' :   false,
				});     
                               $("a.preview").fancybox({
				    'type':'iframe',
			            'width' : 700,
                                   'height':700,
                                   'href':this.href,
                                   'showCloseButton'   : true,
                                   'hideOnOverlayClick': false,
                                  'hideOnContentClick' :   false,
				});     
			});
			</script>
      <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
   <div class="navigationBar">
        <div class="logoBox">
            <h1 class="logoBox-header"><a href="index.php" style="color:#fff; text-decoration:none">SPACEDTIMES</a></h1>
        </div>
        <div class="menu-wrapper">
            <i class="fas fa-bars" onclick="openNav()"></i>
        </div>
         <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="button-wrapper">
                <a href="?q=logout">Logout</a>
                <a href="?q=logout">Logout</a>
            </div>
        </div>
    </div>
<a href="test.php" class="pop"> </a>
  <input type="hidden" name="user_id" id="user_id" value="CMI_52" />
   <div class="full color" style="width:100%;height: 100%;">
        <div class="page">
            <div class="row">
                <div class="col-8">
                    <div class="vendor_wrapper">
                        <select class="vendor__select" style="margin:40px 10px;width:300px;" onchange="get_club()" id="club_category_id" name="club_category_id">
                            <option selected disabled>Select Club Category</option>
                                                                <option value="app">Testing</option>
                              
                        </select>
                        <select class="vendor__select" style="margin:20px 10px;width:300px;" id="club_id" name="club_id" onchange="get_activity_section()">
                            <option disabled selected>Select Club </option>
                            <option value="app" >Select Club </option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <h1 style="margin:45px 10px;font-size:26px;color:#363636;letter-spacing: 1px;">Hi  Ankush Aggarwal</h1>
                </div>
            </div>
        </div>
    </div>


    <div class="full color" style="width:100%;" >
        <div class="page " style="max-width:1200px ">
            <div class="font row ">
                <div class='col'>ACTIVITY</div>
            </div>
        </div>
        <div class="page full color" id="activity_section" style="max-width:1200px">
               <div class="card card-new">
                <h1>Select Club Category and Club Above To View The Content</h1>
              </div>
        </div>

        <div class="page">
            <div class="repo-wrapper">
                <button class="__btn">GO TO REPOSITORY</button>
            </div>
        </div>
    </div>

  <div class="footer">
        <div class="footerInner">
            <h1>SPACEDTIMES</h1>
        </div>
    </div>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"  crossorigin="anonymous">

<!--  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script> 

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

<script>
        CKEDITOR.replace('editor1');
    </script>
    <script>
        CKEDITOR.replace('editor2');
    </script>      <script>get_activity_section2("CCI_3","CI_11")</script> 
  

</body>
</html>

<script language='javascript'>
function get_activity_section()
{
   var club_category_id=$('#club_category_id').val();
   var club_id=$('#club_id').val();
                                      $.ajax({
						  type: 'POST',
						  url: 'get_activity_section.php?club_category_id='+club_category_id+'&club_id='+club_id,
						  data: '',
						  beforeSend: function() { 
							},
						  success: function(response){
						     $('#activity_section').html(response);
						  } 
					       });    
}

function get_activity_section2(p,q)
{  
  var club_category_id=p;
  var club_id=q;
                                        $.ajax({
						  type: 'POST',
						  url: 'get_activity_section.php?club_category_id='+club_category_id+'&club_id='+club_id,
						  data: '',
						  beforeSend: function() { 
							},
						  success: function(response){
						     $('#activity_section').html(response);
						  } 
					       });    
}

function get_club()
{
    var club_category_id=$('#club_category_id').val();
    var user_id=$('#user_id').val();
   
                                          $.ajax({
						  type: 'POST',
						  url: 'get_cmi_club.php?club_category_id='+club_category_id+'&user_id='+user_id,
						  data: '',
						  beforeSend: function() { 
							},
						  success: function(response){
						     $('#club_id').append(response);
						  } 
					       });
}
</script>
