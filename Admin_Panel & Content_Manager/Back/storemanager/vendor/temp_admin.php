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
    <h1>View/Update Vendor Detail</h1>
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
              <th>Vendor Id</th>
              <th>Vendor Name</th>
              <th>Vendor Icon</th>
              <th>Vendor Decription</th>
              <th>Formation Year</th>
              <th>Permanent Address </th>
              <th>Country</th>
              <th>Vendor Added Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td> 
              <td>inst_1</td>
              <td>wingXP</td>
              <td>wingXP_2018-04-04_25.jpg</td>
              <td></td>
              <td>2018</td> 
              <td>472-A
Talwandi</td>
              <td>in</td>
              <td>0000-00-00 00:00:00</td>
              <td><a href="update_vendor_detail.php?id=inst_1" class="view_faculty_detail">Update</td>
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