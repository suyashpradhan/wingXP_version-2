
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin Panel - SpacedTimes</title>
<!--style sheet-->
<script language="javascript" src="../fancybox/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" media="screen" href="main.css">
<script type="text/javascript" src="../fancybox/jquery.min.js"></script>
<script type="text/javascript" src="../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" />
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
<body style="background-color:#e2e2e2;">
   <nav>
        <ul class="nav__main">
            <li class="logo-list"><a href="index.php" style="text-decoration:none;color:#fff;"> SPACEDTIMES </a></li>
            <li><a href="?q=logout" class="logout-link">Logout</a></li>
        </ul>
    </nav>
 

<!--section for intro text and button starts-->
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <h1 style="text-align:center;font-size:26px;margin:20px 0;letter-spacing:1px;color:#265E96;">Add Club To Institute Id: </h1>
    </div>
  </div>
</div>
<!--section for intro text and button ends--> 
<div class="section colored">
  <div class="container clearfix">   
    <!--features starts-->
<div>
  <div> 
      <div class="table_wrapper table_red table-bordered">
      <form action="" method="post">
        <table cellpadding="0" cellspacing="0" style="margin:0 auto; width:50%;" id="page-table" >
          <thead>
            <tr>
                <th>Technology 12</th>
                <th>Testing </th>            
           </tr>
        </thead>
        <tbody>
           <tr>
                <td>
                    <table>
                      <tr><td> <input type='checkbox' name='course[]' id='CI_10' value='CI_10' /> Testing</td>                      </table>
                  </td>
                                  <td>
                    <table>
                      <tr><td> <input type='checkbox' name='course[]' id='CI_11' value='CI_11' /> Test</td>                      </table>
                  </td>
                   
               </tr>
                <tr>
                      <td colspan="3"><input type="submit" name="sub" id="sub" value="Add" class="demo_btn"/></td>
                </tr>    
         </tbody>
        </table>
</form>
      </div>
    <!--features starts-->
 </div>
</div>
        <!--spacer here-->
      <div class="spacer_30px"></div>
      <!--spacer ends-->
       </div>
    <!--features ends--> 
   </div>
</div>
<!--section for features ends--> 
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <!--button wrapper here-->
      <a href="index.php" class="home_link_2"> <span>Click Here To Go Back To Home Page</span> </a>
    </div>
  </div>
</div> 
<!--copyright starts-->
<div class="footer ">
        <div class="footerInner ">
            <h1>
                <i class="far fa-copyright "></i> SPACEDTIMES</h1>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
</body>

</html><!--copyright ends--> 
</body>
</html>

