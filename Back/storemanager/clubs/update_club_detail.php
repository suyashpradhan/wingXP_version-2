<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testune";
$club_id = $_GET['id'];
$conn = new mysqli($servername, $username, $password, $dbname);
$check="SELECT club_name,club_description FROM clubs WHERE club_id = '$club_id'";

$result = $conn->query($check);

    while($row = $result->fetch_array())
    {
     $name =$row['club_name'];
     $desc = $row['club_description'];
    
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

<!--header ends--> <!--section for intro text and button starts-->
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
    <table>
                                <tbody><tr>  
                                  <td style="padding: 0em 0em;">
					<section class="wrapper special popup ">
                                                     <header class="mb-3">
              <h2 class="text-grey " style=" line-height:1.25em;"><strong>NEW CLUB</strong></h2>
              
              <p id="msg"></p>
						      </header>
							    <div class="content">
                                                                  <div class="container">
                                                                  
                                                                  <form class="col-md-offset-4 col-md-3 col-md-offset-4  " id="fileUploadForm" enctype="multipart/form-data">
                                                                                        <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="text" placeholder="Club Name" value="<?php if(isset($name)){echo $name;unset($name);}else{echo 'No data';} ?>" name="club_name" id="club_name" class="padding-popup radius03" required="true">
											</div>
                      
                      
                      
                     
                      
                       
										 	
                                                                                        
<div class="10u -1u" style="padding: 20px 0 0 20px;">
												<textarea type="text" placeholder="Description"  style="margin-bottom:10px; min-height:100px;" name="desc" id="desc" class="padding-popup radius03" required="true"><?php if(isset($desc)){echo $desc;unset($desc);}else{echo 'No data';} ?></textarea>
											</div> 



											
                      
										 	
											<div class="10u -1u" style="padding: 20px 0 0 20px; ">
												<input style="min-height:30px;" type="button" name="submit" value="SUBMIT" class="special-orange popup-big button-popup" id="sub" name="sub" onclick="check_form()" >  
                                            </div><br>
                                            
                                            <input type="hidden" name="action" value="update"> 
                                            <input type="hidden" name="club_id" value="<?php echo $club_id;?>"> 

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





function check_form()
   {
           var club_name= $('#club_name').val();    

     var desc= $('#desc').val(); 
                
	    
    
	  
          
           if(club_name === '' || desc === '' )
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
        url: "club_back.php",
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
 

</body>
</html>