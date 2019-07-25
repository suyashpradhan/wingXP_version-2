
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Admin Panel - SpacedTimes</title>
<!--style sheet-->

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  
  <script>
  $( function() {
    dateFormat: "yy-mm-dd"
    $( "#datepicker,#start,#end" ).datepicker({
  dateFormat: "yy-mm-dd"
});
  });
  </script>
  
<script language="javascript" src="http://iclubs.in/assets/fancybox/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" media="screen" href="http://iclubs.in/assets/css/main.css"/>
<script type="text/javascript" src="http://iclubs.in/assets/fancybox/jquery.min.js"></script>
<script type="text/javascript" src="http://iclubs.in/assets/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="http://iclubs.in/assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="http://iclubs.in/assets/fancybox/jquery.fancybox-1.3.4.css" />
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<link rel="stylesheet" href="http://www.testune.com/spacedtimes/fancybox/jquery-ui.css" />
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  

<script type="text/javascript" src="">
		$(document).ready(function($j) {
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

 <div class="navbar navbar-shadow" style="height: 100px;margin: 0">
        <div class="newnavigationBar">
            <a href="index.php">
                <img src="images/logo.png" alt="" style="margin:10px;height: 70px;"></a>
            <div class="menu-wrapper">
                <a href=" ?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
            </div>
        </div>
    </div>


 <div class="page-description-header">
        <div class="page-container">
            <h1 class="page-description-text">View School Detail</h1>
        </div>
    </div>
    <div class="page-container">
     
      <div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <h1>Pending Schools</h1>
    </div>
  </div>
</div>
      <div class="table_wrapper table_red">
        <table cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th>Sno</th>
              <th>School Id</th>
              <th>School Name</th>              
              <th>Address </th>    
              <th>Action</th>          
            </tr>
          </thead>		            
	          
          <?php 
          
            
          while ($row=mysqli_fetch_row($result))
    {
      if($row[4]=='hold'){
        echo '<tbody><tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td><button onclick="action(\'pending\',\''.$row[1].'\')">Approve</button><button onclick="action(\'block\',\''.$row[1].'\')">Reject</button></tr></tbody>';
      }else{}
    }mysqli_data_seek($result,$row);
    ?>
           
           
	        </table>
      </div>
      <div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <h1>Approved Schools</h1>
    </div>
  </div>
</div>
      <div class="table_wrapper table_red">
        <table cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th>Sno</th>
              <th>School Id</th>
              <th>School Name</th>              
              <th>Address </th>    
              <th>Action</th>          
            </tr>
          </thead>		            
	          
          <?php 
          
            
          while ($row=mysqli_fetch_row($result))
    {
      if($row[4]=='true'){
    echo '<tbody><tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.
    $row[3].'</td><td><button onclick="action(\'approved\',\''.$row[1].'\')">Reject</button>
    <input type="text" placeholder="remark/reason" id="rej_'.$row[1].'"></tr></tbody>';
      }else{}
    }mysqli_data_seek($result,$row);
    ?>
           
           
	        </table>
      </div>
      <div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <h1>Rejected Schools</h1>
    </div>
  </div>
</div>
      <div class="table_wrapper table_red">
        <table cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th>Sno</th>
              <th>School Id</th>
              <th>School Name</th>              
              <th>Address </th>    
              <th>Action</th>          
            </tr>
          </thead>		            
	          
          <?php 
          
            
          while ($row=mysqli_fetch_row($result))
    {
      if($row[4]=='false'){
        echo '<tbody><tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td><button onclick="action(\'rejected\',\''.$row[1].'\')">Mark for Review</button></tr></tbody>';
      }else{}
    }mysqli_data_seek($result,$row);
    ?>
           
           
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script>
   function action(a,id){
    var remark= $('#rej_'+id).val();
    event.preventDefault();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: "action.php?id="+id+"&action="+a+"&remark="+remark,
        data:'',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data);
            if(data==1){alert('Updated');}
            if(data==0){alert('Error');}
        },
        error: function (e) {
            console.log(e);
        }
  

});
    
}
   </script>
</body>

 
</html>