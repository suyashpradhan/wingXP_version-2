<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testune";
$activity_id = $_GET['id'];
$conn = new mysqli($servername, $username, $password, $dbname);
$check="SELECT activity_name,page_name,activities_description,icon FROM activities WHERE activities_id = '$activity_id'";

$result = $conn->query($check);

    while($row = $result->fetch_array())
    {
     $page_name =$row['page_name'];
     $desc = $row['activities_description'];
     $icon =$row['icon'];
     $activity_name =$row['activity_name'];
    
    }


$conn->close();
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin Panel - SpacedTimes</title>
<!--style sheet-->
<script language="javascript" src="http://www.testune.com/spacedtimes/fancybox/ckeditor/ckeditor.js"></script>

<link rel="stylesheet" media="screen" href="http://www.testune.com/spacedtimes/store_manager/css/main.css"/>
<script type="text/javascript" src="http://www.testune.com/spacedtimes/fancybox/jquery.min.js"></script>
<script type="text/javascript" src="http://www.testune.com/spacedtimes/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="http://www.testune.com/spacedtimes/fancybox/jquery.fancybox-1.3.4.pack.js "></script>
<link rel="stylesheet" type="text/css" href="http://www.testune.com/spacedtimes/fancybox/jquery.fancybox-1.3.4.css" />
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<link rel="stylesheet" href="http://www.testune.com/spacedtimes/fancybox/jquery-ui.css" />
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>var $j = jQuery.noConflict(true);</script>
  <script>
  $j( function() {
    dateFormat: "yy-mm-dd"
    $j( "#datepicker" ).datepicker({
  dateFormat: "yy-mm-dd"
});
  } );
  </script>

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
<!DOCTYPE html>
<html lang="en">
<body>
   <nav>
        <ul class="nav__main">
            <li class="logo-list"><a href="index.php" style="text-decoration:none;color:#fff;"> SPACEDTIMES </a></li>
            <li><a href="?q=logout" class="logout-link">Logout</a></li>
        </ul>
    </nav>
 
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
    <table>
                                <tbody><tr>  
                                  <td style="padding: 0em 0em;">
					<section class="wrapper special popup ">
                                                     <header class="mb-3">
              <h2 class="text-grey " style=" line-height:1.25em;"><strong>UPDATE ACTIVITY</strong></h2>
              
              <p id="msg"></p>
						      </header>
							    <div class="content">
                                                                  <div class="container">
                                                                  
                                                                  <form class="col-md-offset-4 col-md-3 col-md-offset-4  " id="fileUploadForm" enctype="multipart/form-data">
                                                                                        <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                                                                                <input type="text" placeholder="Activity Name" value="<?php if(isset($activity_name)){echo $activity_name;}else{}?>" name="activity_name" id="activity_name" class="padding-popup radius03" required="true">
                                            </div>
                                            <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                                                                                <input type="text" placeholder="Page Name" value="<?php if(isset($page_name)){echo $page_name;}else{}?>" name="page_name" id="page_name" class="padding-popup radius03" required="true">
											</div>
                      
                                                                                       <div class="10u -1u" style="padding: 20px 0 0 20px;">
												<textarea type="text" placeholder="Description" style="margin-bottom:10px; min-height:100px;"name="desc" id="desc" class="padding-popup radius03" required="true"><?php if(isset($desc)){echo $desc;}else{}?></textarea>
											</div> 

                                                                                   

                                        <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        <img src="../assets/activity/<?php if(isset($icon)){echo $icon;}else{}?>" style="height:100px;width:100px;">
											</div>
                                            <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                            <label>Update Icon: </label><input id="icon" type="file" name="icon"><br /> 
                                            </div>    
											
                                                                 <input type="hidden" name="action" value="update">
                                             <input type="hidden" name="activity_id" value="<?php if(isset($activity_id)){echo $activity_id;}else{}?>">
											<div class="10u -1u" style="padding: 20px 0 0 20px; ">
												<input style="min-height:30px;" type="button" name="submit" value="SUBMIT" class="special-orange popup-big button-popup" id="sub" name="sub" onclick="check_form()" >  
                                            </div><br>
                                            
                                            
                                        </form>
										</div>  
                                      	 </div>
                 </section> </td></tr>
</tbody></table>
       

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script language="javascript">
$(function(){
$("#password").keyup(function(event){
    if(event.keyCode == 13){
        login();
    }
});
});
function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if(!emailReg.test(email)) {
    return false;
  } else {
    return true;
  }
}
function check_form()
   {
           var activity_name= $('#activity_name').val();    
           var desc= $('#desc').val(); 
            if(activity_name === '' || desc === '' )
                 {
		     alert('Please make sure all fields are filled.');
		 }
             else
		 {          
                     ajaxbackend();
                 } 
   }
function ajaxbackend(){
    //stop submit the form, we will post it manually.
    event.preventDefault();
    // Get form
    var form = $('#fileUploadForm')[0];
    // Create an FormData object 
    var data = new FormData(form);
    // If you want to add an extra field for the FormData
    data.append("action", "update");
    // disabled the submit button
    $("#sub").prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "activity_back.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            $("#result").text(data);
            document.getElementById('msg').innerHTML = data;
            $("#sub").prop("disabled", false);
        },
        error: function (e) {
            $("#result").text(e.responseText);
            document.getElementById('msg').innerHTML = 'Rename File or upload smaller file!';
            $("#sub").prop("disabled", false);
        }
 });
}
</script>

  <div class="footer ">
            <div class="footerInner ">
                <h1>&copy; 2018. All the respective rights reserved. SPACEDTIMES  </h1>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
</body>

</html>