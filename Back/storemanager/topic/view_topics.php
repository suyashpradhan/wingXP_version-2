<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();   
$get_topic="select * from topic";
$result = $conn->query($get_topic);
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

<body>
   <nav>
        <ul class="nav__main">
            <li class="logo-list"><a href="index.php" style="text-decoration:none;color:#fff;"> SPACEDTIMES </a></li>
            <li><a href="?q=logout" class="logout-link">Logout</a></li>
        </ul>
    </nav>
<div class="page-description-header">
        <div class="page-container">
            <h1 class="page-description-text">View/Update Topic Detail</h1>
        </div>
    </div>
    <div class="page-container">
        <table id="page-table">
            <tr>
                <th>Sno</th>
                <th>Club Id</th>
                <th>Topic Name</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
            <?php   $count=0; 
   $rows=mysqli_num_rows($result);   
   if($rows>0)
   {
   while($r=mysqli_fetch_array($result))
   {  $count++;
   ?>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $count; ?>
                        </td>
                        <td>
                            <?php echo $r['club_id']; ?>
                        </td>
                        <td>
                            <?php echo $r['topic_name']; ?>
                        </td>
                        <td>
                            <?php echo $r['start_date']; ?>
                        </td>
                        <td>
                            <?php echo $r['end_date']; ?>
                        </td>
                        <td>
                            <?php echo $r['status']; ?>
                        </td>                       
                        <td><a href="update_topic.php?id=<?php echo $r['topic_id']; ?>" class="view_faculty_detail">
                                Update</td>
                    </tr>
                </tbody>
                <?php } }
       else
         { 
            echo "<tbody><tr><td colspan='6'>No Record Found</td></tr></tbody>";
         }
 ?>
                        
                    </table>
        <a href="#" class="home_link">Home</a>
    </div>
 

<!--copyright starts-->
  <div class="footer ">
            <div class="footerInner">
                <h1>&copy; 2018. All the respective rights reserved. SPACEDTIMES  </h1>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
</body>

</html><!--copyright ends--> 


</body>
</html>