<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$_SESSION['Userid']='INST_258';
$id=$_GET['id'];
if(isset($_GET['id'])){
    $club_id= $_GET['id'];
    $flag=(preg_match('(school_club_)',$club_id)? 1:0);
    $table=($flag==0 ? 'topic':'school__topic');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="main.css" />
    <link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"
    />
    <title>Lady Zubeida Quraishi English Primary And High School - School Dashboard</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous" />
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
            crossorigin="anonymous" />
         <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous "></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
            crossorigin="anonymous "></script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
            crossorigin="anonymous "></script>
            <style>
            .blurr{display:none;
            }
            </style>
  </head>
  <body style="background-color:#f0f0f0">
    <div class="page-container__new">
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="inst_dashboard.php">
                        wingxp</a>
                </div>
            </div>
            <div class="side-nav-wrapper">
                <ul class="side-nav_list">
                    <li>
                        <i class="fas fa-graduation-cap side-icons fa-fw"></i>
                        <a href="club.php" class="side-nav_links"> Clubs Management </a>
                    </li>
                    <li>
                        <i class="fas fa-user side-icons fa-fw"></i>
                        <a href="add_class1.php" class="side-nav_links"> Users Management </a>
                    </li>
                    <li>
                        <i class="fas fa-cog side-icons fa-fw"></i>
                        <a href="#" class="side-nav_links">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="footer-wrap">
                <h1 class="copy-text">
                    Copyright &copy; WingXP 2018 .All rights reserved
                </h1>
                <a href="#">Privacy Policy</a> <span>|</span> <a href="#">Feedback</a>
            </div>
        </div>
        <div class="main-content" style="min-height: 100vh;">
            <div class="right_topNav">
                <div class="inner-topNav">
                    <div class="row no-gutters ">
                        <div class="col-10">
                            <div class="icon-wrap">
                                <h1 class="topNav_first">
                                    Aditya Birla Public School <span> DASHBOARD </span>
                                </h1>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="icon-wrap">
                                <a href="?q=logout" class="btn_logout indigo wave">Logout</a>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new-container" style="background-color:#17a2b8;height:20%;width:40%;">
            <h1 class="header-text" style="margin-top:25%;margin-left:40%; color:#fff;">Message</h1>
            </div>
            <div class="new-container blurr" >
                <div class="row header-row">
                    <div class="col-4">
                        
                            <select id="topic" onchange="get_stats();">
                                <option value="" disabled>Select All Topic</option>
                                <?php 
                    $v=$conn->query("select topic_id,topic_name from ".$table." where club_id= '$club_id'");                    
                    $vs=mysqli_num_rows($v);
                    if($vs >0){ 
                        while($v1=mysqli_fetch_array($v)){?>
                        <option value='<?php echo $v1[0]; ?>' selected><?php echo $v1[1]; ?></option> 
                      <?php }
                    }
                     else { ?>
                         <option  disabled="disabled" selected>No Topics</option>   
                    <?php } ?>
                            </select>
                        
                    </div>
                </div>
                <div class="tabset">
                    <!-- Tab 1 -->
                    <input type="radio" name="tabset" id="tab1" checked>
                    <label for="tab1">Explore</label>
                    <!-- Tab 2 -->
                    <input type="radio" name="tabset" id="tab2">
                    <label for="tab2">Experience</label>
                    <!-- Tab 3 -->
                    <input type="radio" name="tabset" id="tab3">
                    <label for="tab3">Express</label>

                    <div class="tab-panels">
                        <section id="xplore" class="tab-panel">
                            <div class="two_half_new">
                                <div class="inner-clubs-div">                                    
                                    <div>
                                        <h1 class="inner-clubs_text">
                                            <span class="inner-clubs_text_span" id="t_a"> - </span> Articles
                                            <span class="inner_span">
                                                <i class="fas fa-plus club-inner_icons"></i>
                                            </span>
                                        </h1>
                                        <div class="li-body">
                                            <ul class="li-body_list">
                                                <li>Pending <span id="p_a">-</span></li>
                                                <li>Approved <span id="a_a">-</span></li>
                                                <li>Rejected <span id="r_a">-</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="inner-clubs_text">
                                            <span class="inner-clubs_text_span" id="t_v"> - </span> Video
                                            <span class="inner_span">
                                                <i class="fas fa-plus club-inner_icons"></i>
                                            </span>
                                        </h1>
                                        <div class="li-body">
                                            <ul class="li-body_list">
                                                <li>Pending <span id="p_v">-</span></li>
                                                <li>Approved <span id="a_v">-</span></li>
                                                <li>Rejected <span id="r_v">-</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="inner-clubs_text">
                                            <span class="inner-clubs_text_span" id="t_q"> - </span> Quiz
                                            <span class="inner_span">
                                                <i class="fas fa-plus club-inner_icons"></i>
                                            </span>
                                        </h1>
                                        <div class="li-body">
                                            <ul class="li-body_list">
                                                <li>Pending <span id="p_q">-</span></li>
                                                <li>Approved <span id="a_q">-</span></li>
                                                <li>Rejected <span id="r_q">-</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="inner-clubs_text">
                                            <span class="inner-clubs_text_span" id="t_e"> - </span> Ebooks
                                            <span class="inner_span">
                                                <i class="fas fa-plus club-inner_icons"></i>
                                            </span>
                                        </h1>
                                        <div class="li-body">
                                            <ul class="li-body_list">
                                                <li>Pending <span id="p_e">-</span></li>
                                                <li>Approved <span id="a_e">-</span></li>
                                                <li>Rejected <span id="r_e">-</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <h1 class="inner-clubs_text">
                                            <span class="inner-clubs_text_span" id="t_l"> - </span> Learning Video
                                            <span class="inner_span">
                                                <i class="fas fa-plus club-inner_icons"></i>
                                            </span>
                                        </h1>
                                        <div class="li-body">
                                            <ul class="li-body_list">
                                                <li>Pending <span id="p_l">-</span></li>
                                                <li>Approved <span id="a_l">-</span></li>
                                                <li>Rejected <span id="r_l">-</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="xperience" class="tab-panel">
                            <div id='web'>

                            </div>
                                <br><br>
                            <div class="two_half_new">
                              <div class="inner-clubs-div">
                                  <div>
                                        <h1 class="inner-clubs_text">
                                            <span class="inner-clubs_text_span" id="t_w"> - </span> Webinar
                                            <span class="inner_span">
                                                <i class="fas fa-plus club-inner_icons"></i>
                                            </span>
                                        </h1>
                                        <div class="li-body">
                                            <ul class="li-body_list">
                                                <li>Pending <span id="p_w">-</span></li>
                                                <li>Approved <span id="a_w">-</span></li>
                                                <li>Rejected <span id="r_w">-</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="inner-clubs_text">
                                            <span class="inner-clubs_text_span" id="t_wo"> - </span> Workshop
                                            <span class="inner_span">
                                                <i class="fas fa-plus club-inner_icons"></i>
                                            </span>
                                        </h1>
                                        <div class="li-body">
                                            <ul class="li-body_list">
                                                <li>Pending <span id="p_wo">-</span></li>
                                                <li>Approved <span id="a_wo">-</span></li>
                                                <li>Rejected <span id="r_wo">-</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="webinar-details-row_sub">
                                    <h1 class="webinar-details-row_sub--one">Registered: <span>45</span></h1>
                                    <h1 class="webinar-details-row_sub--two">Revenue <span>2500</span></h1>
                                </div>
                            
                        </section>
                        <section id="xpress" class="tab-panel">
                            <div class="inner-clubs-div">
                                <div>
                                    <h1 class="inner-clubs_text">
                                        <span class="inner-clubs_text_span" id="s"> - </span> Submitted
                                        <span class="inner_span">
                                            <i class="fas fa-filter club-inner_icons"></i>
                                            <i class="fas fa-plus club-inner_icons"></i>
                                        </span>
                                    </h1>                                    
                                </div>
                                <div>
                                    <h1 class="inner-clubs_text">
                                        <span class="inner-clubs_text_span" id="r"> - </span> Reviewed
                                        <span class="inner_span">
                                            <i class="fas fa-plus club-inner_icons"></i>
                                        </span>
                                    </h1>
                                    
                                </div>
                                <div>
                                    <h1 class="inner-clubs_text">
                                        <span class="inner-clubs_text_span" id="p"> - </span> Pending
                                        <span class="inner_span">
                                            <i class="fas fa-plus club-inner_icons"></i>
                                        </span>
                                    </h1>
                                    
                                </div>
                                <div>
                                    <h1 class="inner-clubs_text">
                                        <span class="inner-clubs_text_span" id="rj"> - </span> Rejected
                                        <span class="inner_span">
                                            <i class="fas fa-plus club-inner_icons"></i>
                                        </span>
                                    </h1>
                                    
                                </div>
                                <div>
                                    <h1 class="inner-clubs_text">
                                        <span class="inner-clubs_text_span" id="sh"> - </span> Showcased
                                        <span class="inner_span">
                                            <i class="fas fa-plus club-inner_icons"></i>
                                        </span>
                                    </h1>
                                    
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="club" value="<?php if(isset($club_id)){echo $club_id;}else{}?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
    <script src="assets/js/script.js"></script>
    <script>
         $(document).ready( $('#topic').change());
function get_stats(){
    get_web();
    var topic= $('#topic').val();
    var club= $('#club').val();
    $.ajax({
						  type: 'GET',
						  url: 'get_stats.php?club='+club+'&topic='+topic,
						  data: '',
						  success: function(response){ 
                            var res = JSON.parse(response);                                                              
						    $('#t_a').html(res[0][0]);
                            $('#t_e').html(res[0][1]);
                            $('#t_v').html(res[0][2]);
                            $('#t_w').html(res[0][3]);
                            $('#t_wo').html(res[0][4]);
                            $('#t_q').html(res[0][5]);
                            $('#t_l').html(res[0][6]);
                            
                            $('#p_a').html(res[1][0]);
                            $('#p_e').html(res[1][1]);
                            $('#p_v').html(res[1][2]);
                            $('#p_w').html(res[1][3]);
                            $('#p_wo').html(res[1][4]);
                            $('#p_q').html(res[1][5]);
                            $('#p_l').html(res[1][6]);

                            $('#a_a').html(res[2][0]);
                            $('#a_e').html(res[2][1]);
                            $('#a_v').html(res[2][2]);
                            $('#a_w').html(res[2][3]);
                            $('#a_wo').html(res[2][4]);
                            $('#a_q').html(res[2][5]);
                            $('#a_l').html(res[2][6]);

                            $('#r_a').html(res[3][0]);
                            $('#r_e').html(res[3][1]);
                            $('#r_v').html(res[3][2]);
                            $('#r_w').html(res[3][3]);
                            $('#r_wo').html(res[3][4]);
                            $('#r_q').html(res[3][5]);
                            $('#r_l').html(res[3][6]);

                            $('#s').html(res[4][0]);
                            $('#r').html(res[4][1]);
                            $('#p').html(res[4][2]);
                            $('#rj').html(res[4][3]);
                            $('#sh').html(res[4][4]);
						  } 
					       });
                           
}
function get_web(){
    var topic= $('#topic').val();
    var club= $('#club').val();
    $.ajax({
						  type: 'GET',
						  url: 'get_webinar_back.php?club='+club+'&topic='+topic,
						  data: '',
						  success: function(response){                                                  
						    $('#web').html(response);                            
						  } 
					       });

}
    </script>
</body>

</html>