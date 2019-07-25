<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$db = $database->getConnection();
$_SESSION['Userid']='INST_258';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous" />

</head>
<body>
    <div class="page-container__new">
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="#"><img src="../Student_Dashboard Version 2/assets/images/logo.png" alt="logo" /></a>
                    <h6>clubs</h6>
                </div>
            </div>
            <div class="side-nav-wrapper">
                <ul class="side-nav_list">
                    <li>
                        <i class="fas fa-graduation-cap side-icons fa-fw"></i>
                        <a href="#" class="side-nav_links"> Clubs Management </a>
                    </li>
                    <li>
                        <i class="fas fa-user side-icons fa-fw"></i>
                        <a href="#" class="side-nav_links"> Users Management </a>
                    </li>
                    <i class="fas fa-cog side-icons fa-fw"></i>
                    <a href="#" class="side-nav_links">Settings</a>
                    </li>

                </ul>
            </div>

            <div class="footer-wrap">
                <h1 class="copy-text">
                    Copyright &copy; iClubs 2018 .All rights reserved
                </h1>
                <a href="#">Privacy Policy</a> <span>|</span> <a href="#">Feedback</a>
            </div>
        </div>
        <div class="main-content" style="min-height: 100vh;">
            <div class="right_topNav">
                <div class="inner-topNav">
                    <div class="row no-gutters ">
                        <div class="col-6">
                            <div class="icon-wrap">
                                <h1 class="topNav_first">
                                    ST. XAVIER'S HIGH SCHOOL <span> DASHBOARD </span>
                                </h1>
                                <i class="fas fa-home nav-icons fa-fw"></i>
                                <i class="fas fa-bell nav-icons fa-fw"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon-wrap">
                                <h1 class="topNav_first_name">
                                    Ankush Aggarwal | School Coordinator
                                </h1>
                                <img src="assets/images/user (1).png" alt="" height="40px" />
                                <i class="fas fa-bars fa-fw side-icons nav-icons menu"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new-container">
                <div class="select-new-wrap">
                    <div class="new_select">
                    <select name="class_man" id="school_class" onchange="get_batch()">
                  <option value="">Choose Class</option>
                                <?php 
                    $q='select class_id,class from inst_class where institute_id= "'.$_SESSION['Userid'].'"';
                    $v=$db->query($q);                 
                    $vs=mysqli_num_rows($v);
                    if($vs >0){ 
                        while($v1=mysqli_fetch_array($v)){?>
                        <option value='<?php echo $v1[0]; ?>'><?php echo $v1[1]; ?></option> 
                      <?php }
                    }
                     else { ?>
                         <option  disabled="disabled" selected>No Classes</option>   
                    <?php } ?>
                </select>
                    </div>
                    <div class="new_select">
                    <select name="batch" id="batch" onchange="get_users();">
                  <option>Select Batch</option>                  
                </select>
                    </div>
                </div>
                <div id="table">

                </div>
                </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
    <script src="assets/js/script.js"></script>
</body>
<script>
      $(document).ready( $('#class').change());
      $(document).ready( $('#class_imp').change());
      function get_batch(){
      var class_v= $('#school_class').val();
    $.ajax({
						  type: 'GET',
						  url: 'get_batch.php?class='+class_v,
						  data: '',
						  success: function(response){                                         
                            $('#batch').html(response);  
                            $(document).ready( $('#batch').change());                          
						  } 
					       });
    }
    function get_users(){
      var batch= $('#batch').val();
    $.ajax({
						  type: 'GET',
						  url: 'get_users.php?batch='+batch,
						  data: '',
						  success: function(response){                                         
						    $('#table').html(response);                            
						  } 
					       });
    }
    </script>
</html>