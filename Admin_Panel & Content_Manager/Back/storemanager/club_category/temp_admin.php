<!--THIS IS TEMPORARY FILE TO SIMULATE ADMIN PANEL-->
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
</head>
<body>
<!--top starts-->
<div id="top">
  <div class="container clearfix">
    <div class="grid_12">
      <p>Welcome to SpacedTimes!</p>
      <p class="call">Admin Name <span class="color">    </span></p>
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
      <h1>View/Update Clubs Category</h1>
    </div>
  </div>
</div>
<!--section for intro text and button ends--> 

<!--section for features starts-->
<div class="section colored">
  <div class="container clearfix"> 
 
	<div class="table_wrapper table_red">
        <table cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th>Sno</th>
              <th>Club Id</th>
              <th>Club Name</th>
              <th>Description</th>
              <th>Date and Time </th>
           </tr>
          </thead>
		            <tbody>
            <tr>
              <td>1</td> 
              <td>inst_5</td>
              <td>Technology</td>
              <td>Technology</td>
              <td></td>
              <td><a href="update_club_category_detail.php?id=club_1" class="view_faculty_detail"> Update</td>
            </tr>
       	  </tbody>
	          <tbody>
            <tr>
              <td>2</td> 
              <td>inst_6</td>
              <td>Language</td>
              <td>Language</td>
              <td></td>
              <td><a href="update_club_category_detail.php?id=club_2" class="view_faculty_detail"> View</td>
            </tr>
       	  </tbody>
	          <tbody>
            <tr>
              <td>3</td> 
              <td>inst_7</td>
              <td>Smarter Mind</td>
              <td>Smarter Mind</td>
              <td></td>
              <td><a href="update_club_detail.php?id=inst_7" class="view_faculty_detail"> View</td>
            </tr>
       	  </tbody>
	          <tbody>
            <tr>
              <td>4</td> 
              <td>inst_8</td>
              <td>Miscellaneous</td>
              <td>Miscellaneous</td>
              <td></td>
              <td><a href="update_club_detail.php?id=inst_8" class="view_faculty_detail"> Add</td>
            </tr>
       	  </tbody>
	        </table>
      </div>
    <!--features starts-->
  </div>
</div>
<!--section for features ends--> 
 

<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <!--button wrapper here-->
      <a href="index.php" class="button button-orange"> <span>Click Here! to go home screen</span> </a>
    </div>
  </div>
</div> 

 

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