
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
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous" />
  <script>var $j = jQuery.noConflict(true);</script>
  <script>
  $j( function() {
    dateFormat: "yy-mm-dd"
    $j( "#datepicker,#start,#end" ).datepicker({
  dateFormat: "yy-mm-dd"
});
  });
  </script>
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
  <li class="nav-item" role="tab" aria-controls="co" aria-selected="true">
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

<form action="" method="POST">
    <div class="partition-wrap">
        <div>
            <input type="checkbox" name="clubs[]" checked="checked" value="club_20" class="check-click" readonly>
            <h1 class="partition-head-sub">History</h1>
        </div>
        <div>
            <ul class="partition-list">
                <li> <span>Class 6</span> <input type="checkbox" name="club_20[]" value="VI" ></li>
                <li> <span>Class 7</span> <input type="checkbox" name="club_20[]" value="VII"></li>
                <li> <span>Class 8</span> <input type="checkbox" name="club_20[]" value="VIII"></li>
                <li> <span>Class 9</span> <input type="checkbox" name="club_20[]" value="IX" ></li>
                <li> <span>Class 10</span> <input type="checkbox" name="club_20[]" value="X"></li>
                <li> <span>Class 11</span> <input type="checkbox" name="club_20[]" value="XI"></li>
                <li> <span>Class 12</span> <input type="checkbox" name="club_20[]" value="XII"></li>
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
                         <input type="checkbox" name="clubs[]" checked="checked" value="club_54" class="check-click" readonly>
                        <h1 class="partition-head-sub">Wix Club (Website w/o coding)</h1>
                    </div>
                        <div>
                        <ul class="partition-list">
                            <li> <span>Class 6</span> <input type="checkbox" name="club_54[]" value="VI"></li>
                            <li> <span>Class 7</span> <input type="checkbox" name="club_54[]" value="VII"></li>
                            <li> <span>Class 8</span> <input type="checkbox" name="club_54[]" value="VIII"></li>
                            <li> <span>Class 9</span> <input type="checkbox" name="club_54[]" value="IX"></li>
                            <li> <span>Class 10</span> <input type="checkbox" name="club_54[]" value="X"></li>
                            <li> <span>Class 11</span> <input type="checkbox" name="club_54[]" value="XI"></li>
                            <li> <span>Class 12</span> <input type="checkbox" name="club_54[]" value="XII"></li>
                        </ul>
                    </div>
                </div>
        </div>
   <button class="btn btn-primary" style="margin:15px auto;display:block;" name="sub" id="sub">Submit</button>
 </form>
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
            &copy; Copyright – CBSE360 2018
        </div>
    </div>    
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous "></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous "></script>
</body>
</html>





