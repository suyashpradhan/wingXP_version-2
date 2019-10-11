
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin Panel - CBSE 360</title>
<!--style sheet-->
<script language="javascript" src="../fancybox/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" media="screen" href="main.css"/>
<script type="text/javascript" src="../fancybox/jquery.min.js"></script>
<script type="text/javascript" src="../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" />
<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<link rel="stylesheet" href="https://www.testune.com/spacedtimes/fancybox/jquery-ui.css" />
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script>var $j = jQuery.noConflict(true);</script>
  <script>
  $j( function() {
    dateFormat: "yy-mm-dd"
    $j( "#datepicker,#start,#end" ).datepicker({
  dateFormat: "yy-mm-dd"
});
  });
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


<div class="navbar navbar-shadow" style="height:70px;margin: 0">
        <div class="newnavigationBar_2">
            <a href="index.php" style=" text-decoration:none;">
                <span style="color: #17a2b8 !important; font-weight:1000; font-size: 32px;margin: 0;padding: 0 20px; text-decoration:none;">CBSE 360</span>
                <div class="menu-wrapper">
                    <a href="?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
                </div>
         </div>
    </div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous" />
<div class="page-description-header">
        <div class="page-container">
            <h1 class="page-description-text">Assign Clubs to Classes</h1>
        </div>
    </div>
    <div class="page-container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active"  data-toggle="tab" href="#academic" role="tab">Academic</a>
  </li>
  <li class="nav-item" role="tab" >
    <a class="nav-link"  data-toggle="tab" href="#co-curricular" role="tab">Co-Curricular</a>
  </li>
</ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="academic" role="tabpanel">
                <h1 class="tab-header-common"> Academic Clubs</h1>
                    <div class="partition-wrap-header">
                        <h1 class="partition-head">Clubs</h1>
                        <h1 class="partition-head">Class</h1>
                    </div>
                    <form action="#" method="POST">
                        <div class="partition-wrap">
                            <div>
                            <input type="checkbox" name="" id="">
                                <h1 class="partition-head-sub">CBSE</h1>
                            </div>
                            <div>
                                <ul class="partition-list">
                                    <li> <span>Class 6</span> <input type="checkbox" name="" id=""></li>
                                    <li> <span>Class 7</span> <input type="checkbox" name="" id=""></li>
                                    <li> <span>Class 8</span> <input type="checkbox" name="" id=""></li>
                                    <li> <span>Class 9</span> <input type="checkbox" name="" id=""></li>
                                    <li> <span>Class 10</span> <input type="checkbox" name="" id=""></li>
                                    <li> <span>Class 11</span> <input type="checkbox" name="" id=""></li>
                                    <li> <span>Class 12</span> <input type="checkbox" name="" id=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <div class="tab-pane fade" id="co-curricular" role="tabpanel">
                    <h1 class="tab-header-common">Co-Curricular Clubs</h1>
                    <div class="partition-wrap-header">
                    <h1 class="partition-head">Clubs</h1>
                    <h1 class="partition-head">Class</h1>
                </div>
                <div class="partition-wrap">
                    <div>
                        <h1 class="partition-head-sub">Krita Club</h1>
                    </div>
                        <div>
                        <ul class="partition-list">
                            <li> <span>Class 6</span> <input type="checkbox" name="" id=""></li>
                            <li> <span>Class 7</span> <input type="checkbox" name="" id=""></li>
                            <li> <span>Class 8</span> <input type="checkbox" name="" id=""></li>
                            <li> <span>Class 9</span> <input type="checkbox" name="" id=""></li>
                            <li> <span>Class 10</span> <input type="checkbox" name="" id=""></li>
                            <li> <span>Class 11</span> <input type="checkbox" name="" id=""></li>
                            <li> <span>Class 12</span> <input type="checkbox" name="" id=""></li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
        <button class="btn btn-primary" style="margin:15px auto;display:block;">Submit</button>
    </div>
</div>
    <div class="footer" style=" position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px; 
    background:#000;">
        <div class="left-footer" style="padding: 15px; padding: 15px 0;
        font-size: 20px;
        color: #fff;
        float: none;
        text-align: center;">
            © Copyright – iCLUBS 2018
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
        
    </div>
      </div>
   </div>
</body>
</html>