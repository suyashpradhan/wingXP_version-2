
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
    <div class="page-description-header">
        <div class="page-container">
            <h1 class="page-description-text">NEW ACTIVITY</h1><p id="msg"></p>
        </div>
    </div>
    <div class="page-middle-wrapper">
        <form action="#" class="page-form" id="fileUploadForm" enctype="multipart/form-data">
            <input type="text" name="activity_name" id="activity_name" placeholder="Activity Name" class="form-field" required="true"><br>  <input type="hidden" name="action" value="add">
            <textarea  name="desc" id="desc" cols="30" rows="10" placeholder="Activity Description" class="form-textarea" required="true"></textarea><br>
             <input type="text" name="page_name" id="page_name" placeholder="Page Name" class="form-field" required="true"> <br />  
             <label>Choose Icon: </label><input id="icon" type="file" name="icon"><br /> 
             
              <input type="hidden" name="activity_id" value="<?php if(isset($id)){echo $id;}else{}?>">
            <input type="button" name="submit" value="SUBMIT" id="sub" name="sub" onclick="check_form()" class="submit__btn">
            
        </form>
    </div>
       
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
                    add_image();
                 } 
   }

function add_image(){
    //stop submit the form, we will post it manually.
    event.preventDefault();
    // Get form
    var form = $('#fileUploadForm')[0];
     // Create an FormData object 
    var data = new FormData(form);
     // If you want to add an extra field for the FormData
    data.append("action", "add");
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
            console.log(data);
            if(data=='success'){               
            alert('Activity Added Successfully');
            location.reload(true); 
            }
            if(data=='exists')
            {
                alert('Activity Name Already Exists');  
            }           
        },
        error: function (e) {
            console.log(e);
            alert('Error ! Check console for error !');
        }
});
}
</script>
  </div>
  </div>
</div>
<!--section for intro text and button ends--> 
<!--section for features starts-->
<div class="section colored">
<div class="container clearfix"> 
     <!--features starts-->    
</div> 
<br /> <br /> 
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