
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin Panel - SpacedTimes</title>
<!--style sheet-->
<script language="javascript" src="http://www.testune.com/spacedtimes/fancybox/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" media="screen" href="http://www.testune.com/spacedtimes/store_manager/css/style.css"/>
<link rel="stylesheet" media="screen" href="http://www.testune.com/spacedtimes/store_manager/css/navigation.css"/>
<link href="http://www.testune.com/spacedtimes/faculty/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://www.testune.com/spacedtimes/fancybox/jquery.min.js"></script>
<script type="text/javascript" src="http://www.testune.com/spacedtimes/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="http://www.testune.com/spacedtimes/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.testune.com/spacedtimes/fancybox/jquery.fancybox-1.3.4.css" />
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script src="http://www.testune.com/spacedtimes/fancybox/jquery-ui.js" type="text/javascript"></script>
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

 <style>
                       select {
	-moz-transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
	-webkit-transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
	-ms-transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
	transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
	border: 1px solid #00897B;
	display: block;
	text-decoration: none;
	width: 100%;
	outline: 0;
	font-size: 15px;
	border-radius: 5px;
	padding: 5px;
	margin-top: 10px;
}

input[type="text"],
input[type="password"],
input[type="email"],
textarea {
	-moz-transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
	-webkit-transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
	-ms-transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
	transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
	-moz-appearance: none;
	-webkit-appearance: none;
	-ms-appearance: none;
	appearance: none;
	color: black;
	display: block;
	text-decoration: none;
	width: 100%;
	outline: 0;
	border: 1px solid #00897B;
	font-size: 15px;
	margin-top: 10px;
}
 </style>  <script type="text/javascript">
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
</head>
<body>
<!--top starts-->
<div id="top">
  <div class="container clearfix">
    <div class="grid_12">
      <p>Welcome to SpacedTimes!</p>
      <p class="call">Admin Name <span class="color">Abhi    </span></p>
    </div>
  </div>
</div>
<!--top ends--> 
<!--header starts-->
<div id="header">
  <div class="container  header_inner clearfix">
    <div class="grid_12"> 
        <!--logo here--> 
         <h1 class="logoBox-header"><a href="index.php" style="color: #ffb400;">SPACED<span>TIMES</span></a></h1> 
       <!--menu / navigation starts-->
      <ul class="sf-menu">
         <li class="login_link"> 
           <!--login_wrapper starts-->
          <div class="login_wrapper"> <a href="?q=logout" class="login_out"><span>Log Out</span></a>
            </div>
          <!--login_wrapper ends--> 
         </li>
      </ul>
      <!--menu ends-->
       <div class="clear"></div>
    </div>
  </div>
</div>
<!--header ends--> <!--section for intro text and button starts-->
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
    <table>
                                <tbody><tr>  
                                  <td style="padding: 0em 0em;">
					<section class="wrapper special popup ">
                                                     <header class="mb-4">
              <h2 class="text-grey " style=" line-height:1.25em;"><strong>NEW SCHOOL</strong></h2>
              
              <p id="msg"></p>
						      </header>
							    <div class="content">
                                                                  <div class="container">
                                                                  
                                                                  <form class="col-md-offset-4 col-md-3 col-md-offset-4  " id="fileUploadForm" enctype="multipart/form-data">
                                                                                        <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="text" placeholder="Name" name="institute_name" id="institute_name" class="padding-popup radius03" required="true">
											</div>
                      <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="email" placeholder="Email Id" name="email" id="email" class="padding-popup radius03" required="true">
											</div>
                      <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="password" placeholder="password" name="password" id="password" class="padding-popup radius03" required="true">
											</div>
                      <div class="10u -1u" style="padding: 20px 0 0 20px; ">
												<textarea type="text" placeholder="Details" name="desc" id="desc" class="padding-popup radius03" style="margin-bottom:10px;" required="true"></textarea>
											</div>
                      <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="text" placeholder="Promoters" name="prom" id="prom" class="padding-popup radius03" required="true">
											</div>
                      
                      
                      
                      <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="text" placeholder="Phone No" name="phone" id="phone" class="padding-popup radius03" required="true">
											</div>
                     
                      
                       
										 	
                                                                                       

<div class="10u -1u" style="padding: 20px 0 0 20px;">
												<textarea type="text" placeholder="Address" name="address" id="address" class="padding-popup radius03" style="margin-bottom:10px;" required=""></textarea>
											</div> 
                  
											
                      <input type="hidden" name="action" value="add">

										 	
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
           var institute_name= $('#institute_name').val();    
	   
     var country= $('#country').val(); 
     var qual= $('#qual').val(); 
     var dob= $('#datepicker').val(); 

	   var phone= $('#phone').val();  
     var phone2= $('#phone2').val(); 
     var address= $('#address').val(); 
     var exp= $('#exp').val(); 
      
	   var email= $('#email').val();    
     var secemail= $('#secemail').val(); 
	  
          
           if(institute_name === '' || address === '' )
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
    data.append("CustomField", "This is some extra data, testing");

    // disabled the submit button
    $("#sub").prop("disabled", true);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "school_back.php",
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
<script>
   
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
<!--copyright starts-->
<div id="copyright">
  <div class="container clearfix"> 
      <!--copyright text and general links-->
    <div class="grid_12">
     Copyright 2018. All the respective rights reserved. SpacedTimes
     </div>
     <div class="clear"></div>
  </div>
</div><!--copyright ends--> 
</body>
</html>