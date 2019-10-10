<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $topic = "SELECT topic_name,topic_desc,start_date,end_date,status from topic where topic_id= '$id'";
    $result = $conn->query($topic);
    while($row = $result->fetch_array())
    {
     $topic_name =$row['topic_name'];
     $topic_desc =$row['topic_desc'];
     $start_date =$row['start_date'];
     $end_date =$row['end_date'];
     $status =$row['status'];
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin Panel - SpacedTimes</title>
<!--style sheet-->
<script language="javascript" src="http://www.iclubs.in/fancybox/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" media="screen" href="../main.css"/>
<script type="text/javascript" src="http://www.iclubs.in/fancybox/jquery.min.js"></script>
<script type="text/javascript" src="http://www.iclubs.in/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="http://www.iclubs.in/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.iclubs.in/fancybox/jquery.fancybox-1.3.4.css" />
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<link rel="stylesheet" href="http://www.testune.com/spacedtimes/fancybox/jquery-ui.css" />
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>var $j = jQuery.noConflict(true);</script>
  <script>
  $j( function() {
    dateFormat: "yy-mm-dd"
    $j( "#start,#end" ).datepicker({
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
            <h1 class="page-description-text">UPDATE TOPIC</h1> <p id="msg"></p>
        </div>
    </div>
    <div class="page-middle-wrapper">
        <form action="" class="page-form" id="topic_form">              
        <input value="<?php if(isset($topic_name)){echo $topic_name;}else{}?>" type="text" name="topic_name" id="topic_name" placeholder="Topic Name" class="form-field"
                required="true"><br><input  type="hidden" name="action" value="update"><input  type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>">
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Topic Description" class="form-textarea" required="true"><?php if(isset($topic_desc)){echo $topic_desc;}else{}?></textarea><br>
            <input type="text" value="<?php if(isset($start_date)){echo $start_date;}else{}?>" type="text" name="start" id="start" required="true" placeholder="Start Date" class="form-field" autocomplete="off"><br>
            <input type="text" value="<?php if(isset($end_date)){echo $end_date;}else{}?>" type="text" name="end" id="end" required="true" placeholder="End Date" class="form-field" autocomplete="off"><br>
            <input type="radio" name="status" value="1" <?php if(isset($status)){if($status==1){echo 'checked';}else{}}else{} ?>>Activate
            <input type="radio" name="status" value="0" <?php if(isset($status)){if($status==0){echo 'checked';}else{}}else{} ?>> Deactivate<br>
            <input type="button" name="submit" value="SUBMIT" id="sub" name="sub" onclick="check_form()" class="submit__btn ">
            
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

function fetch_clubs(){
    var club_category_id= $('#club_category_id').val();

    $.ajax({
						  type: 'POST',
						  url: 'get_club.php?club_category_id='+club_category_id,
						  data: '',
						  beforeSend: function() { 
							},
						  success: function(response){
						     $('#clubs').html(response);
						  } 
					       });
}

function check_form()
   {
           var club_name= $('#topic_name').val();    
            var desc= $('#desc').val(); 
             if(club_name === '' || desc === '' )
                  {
		        alert('Please make sure all fields are filled.');
		  }
             else
		 {          
                           add_topic();
                 } 
   }

function add_topic(){
    event.preventDefault();
    var form = $('#topic_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "topic_back.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
       success: function (data) {
            console.log(data);
            if(data=='updated'){
           alert("Topic Updated !");
           location.reload();
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
            <div class="footerInner">
                <h1>&copy; 2018. All the respective rights reserved. SPACEDTIMES  </h1>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
</body>

</html>