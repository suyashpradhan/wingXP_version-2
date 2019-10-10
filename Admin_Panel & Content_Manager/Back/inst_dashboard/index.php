<?php
//include("inst_header.php"); 
include_once "../assets/Users.php";
$database = new Database();
$db = $database->getConnection();
session_start();
$_SESSION['sno_user']='258';//temp
$_SESSION['Userid']='INST_258';//temp
$get_inst_q='select institute_name from institution where institute_id="'.$_SESSION['Userid'].'"';
$name=$db->query($get_inst_q);
$row = $name->fetch_array();
$inst_name=$row['institute_name'];
//GET STAGE
$stage_q='select stage from school__stage where id="'.$_SESSION['sno_user'].'" order by datetime desc';
$stage=$db->query($stage_q);
while($stage_row=$stage->fetch_row()){
  $stages[]=$stage_row[0];
}

//GET WEBINAR
$scheduled_webinars='select date,time,duration,url,web_id from webinar_schedule where status="active" and CURRENT_TIMESTAMP()<cast(concat(date, " ", time) as datetime) and type="s2"';
$webinar_res=$db->query($scheduled_webinars);
$count=0;
while($row=$webinar_res->fetch_row()){  
  $count++;
  $web[$count][0]=$row[0];
  $web[$count][1]=$row[1];
  $web[$count][2]=$row[2];
  $web[$count][3]=$row[3];
  $web[$count][4]=$row[4];
}

$scheduled_webinars_4='select date,time,duration,url,web_id from webinar_schedule where status="active" and CURRENT_TIMESTAMP()<cast(concat(date, " ", time) as datetime) and type="s4"';
$webinar_res_4=$db->query($scheduled_webinars_4);
$count_2=0;
while($row_4=$webinar_res_4->fetch_row()){
  $count_2++;
  $web_2[$count_2][0]=$row_4[0];
  $web_2[$count_2][1]=$row_4[1];
  $web_2[$count_2][2]=$row_4[2];
  $web_2[$count_2][3]=$row_4[3];
  $web_2[$count_2][4]=$row_4[4];
}
$check_registration_s2='select * from webinar_attendance where id="'.$_SESSION['Userid'].'" and 
web_id in (select web_id from webinar_schedule where status="active" and DATE_ADD(NOW(), INTERVAL -1 HOUR)<cast(concat(date, " ", time) as datetime) and type="s2")';
$res=$db->query($check_registration_s2);
if($res->num_rows>0){
  $check_reg=true;
  $get_web_time='select *,cast(concat(date, " ", time) as datetime) as date_time from webinar_schedule where web_id in (select web_id from webinar_attendance
  where id="'.$_SESSION['Userid'].'") and web_id in (select web_id from webinar_schedule where status="active" and DATE_ADD(NOW(), INTERVAL -1 HOUR)<cast(concat(date, " ", time) as datetime) and type="s2")';
  $res=$db->query($get_web_time);
  while($row=$res->fetch_array()){
    $web_time[0]=date('M j, Y H:i:s',strtotime($row['date_time']));
    $web_link[0]=$row['url'];  
      
  }
}
else{
  $check_reg=false;
}

//GTCHECK stage 4 
$check_registration_s4='select * from webinar_attendance where id="'.$_SESSION['Userid'].'" and 
web_id in (select web_id from webinar_schedule where status="active" and DATE_ADD(NOW(), INTERVAL -1 HOUR)<cast(concat(date, " ", time) as datetime) and type="s4")';
$res=$db->query($check_registration_s4);
if($res->num_rows>0){

        $check_reg_4=true;

        $get_web_time='select *,cast(concat(date, " ", time) as datetime) as date_time from webinar_schedule where web_id in (select web_id from webinar_attendance
        where id="'.$_SESSION['Userid'].'") and web_id in (select web_id from webinar_schedule where status="active" and DATE_ADD(NOW(), INTERVAL -1 HOUR)<cast(concat(date, " ", time) as datetime) and type="s4")';
        $res=$db->query($get_web_time);
          while($row=$res->fetch_array()){
          $web_time[1]=date('M j, Y H:i:s',strtotime($row['date_time']));
          $web_link[1]=$row['url'];

          }
}
else{
$check_reg_4=false;
}




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
          <a href="inst_dashboard.php">
            wingxp</a>
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
          <li>
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
            <div class="col-10">
              <div class="icon-wrap">
                <h1 class="topNav_first">
                  <?php if(isset($inst_name)){echo $inst_name;}?> <span> DASHBOARD </span>
                </h1>
              </div>
            </div>
            <div class="col-2">
              <div class="icon-wrap">
                <a href="#" class="btn_logout indigo wave">Logout</a>
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="new-container">
        <!-- <div class="header-row">
          <h1 class="header-text"><span style="text-transform: lowercase;">wing</span>XP</h1>
          <hr class="hr_under_one">
        </div>
        <div class="sections">
          <div class="common">
            <div class="img-section">
              <img src="assets/images/design.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">DIGITAL DESIGN</h1>

              <div class="section-link-wrapper">
                <a href="#" class="section--link" data-toggle="modal" data-target="#exampleModalCenter-N1">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/tech.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">TECH TALK</h1>

              <div class="section-link-wrapper">
                <a href="#" class="section--link" data-toggle="modal" data-target="#exampleModalCenter-N2">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/creative.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">SMARTER MINDS</h1>

              <div class="section-link-wrapper">
                <a href="#" class="section--link" data-toggle="modal" data-target="#exampleModalCenter-N3">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/environment.jpg">
            </div>
            <div class="section-info">
              <h1 class="section--header">ENVIRONMENT</h1>

              <div class="section-link-wrapper">
                <a href="#" class="section--link" data-toggle="modal" data-target="#exampleModalCenter-N4">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/coding.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">CODING</h1>

              <div class="section-link-wrapper">
                <a href="#" class="section--link" data-toggle="modal" data-target="#exampleModalCenter-N5">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/astro.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">ASTRONOMY</h1>

              <div class="section-link-wrapper">
                <a href="#" class="section--link" data-toggle="modal" data-target="#exampleModalCenter-N6">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/english.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">ENGLISH EXPRESSION</h1>

              <div class="section-link-wrapper">
                <a href="#" class="section--link" data-toggle="modal" data-target="#exampleModalCenter-N7">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/news.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">UNDERSTANDING NEWS</h1>

              <div class="section-link-wrapper">
                <a href="#" class="section--link" data-toggle="modal" data-target="#exampleModalCenter-N8">Enter</a>
              </div>
            </div>
          </div>
        </div>


        <div class="header-row">
          <h1 class="header-text">School Clubs</h1>
          <hr class="hr_under_one">
        </div>
        <div class="info__new-wrap sub">
          <h1>No School have been created, click <a href="#" class="btn-text">here</a> to create one!</h1>
        </div>
        <div class="info__new-wrap sub">
          <h1>No Coordinator Created. Please create a Coordinator <a href="#" class="btn-text">here</a></h1>
        </div>
        <div class="sections">
          <div class="common">
            <div class="img-section">
              <img src="assets/images/school.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">SciFi</h1>
              <div class="section-link-wrapper">
                <a href="school_club_report.php?id=school_club_28" class="section--link">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/school.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">Mathemagic</h1>
              <div class="section-link-wrapper">
                <a href="school_club_report.php?id=school_club_29" class="section--link">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/school.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">Hist Story </h1>
              <div class="section-link-wrapper">
                <a href="school_club_report.php?id=school_club_30" class="section--link">Enter</a>
              </div>
            </div>
          </div>
          <div class="common">
            <div class="img-section">
              <img src="assets/images/school.png">
            </div>
            <div class="section-info">
              <h1 class="section--header">Jio Graphy</h1>
              <div class="section-link-wrapper">
                <a href="school_club_report.php?id=school_club_31" class="section--link">Enter</a>
              </div>
            </div>
          </div>
      </div>
       -->

        <div class="row_timeline">
          <div class="column column_1">
            <h1 class="column_head">School<br> Sign-up</h1>
          </div>
          <div id="t_l_s_2" class="column column_2" style="background-color:#<?php if(in_array('s1',$stages)){echo '11639d';}else{echo '696969';}?>">
            <h1 class="column_head-sub">Stage 1 <br>Onboarding Starts </h1>

          </div>
          <div id="t_l_s_3" class="column column_3" style="background-color:#<?php if(in_array('s2',$stages)){echo '11639d';}else{echo '696969';}?>">
            <h1 class="column_head-sub">Stage 2<br>
              Vision Syncing</h1>

          </div>
          <div id="t_l_s_4" class="column column_4" style="background-color:#<?php if(in_array('s3',$stages)){echo '11639d';}else{echo '696969';}?>">
            <h1 class="column_head-sub">Stage 3<br>
              Club Selection &<br>
              Launch Date</h1>

          </div>
          <div id="t_l_s_5" class="column column_5" style="background-color:#<?php if(in_array('s4',$stages)){echo '11639d';}else{echo '696969';}?>">
            <h1 class="column_head-sub">Stage 4<br>
              Club Managers
              Identification & Session</h1>

          </div>
          <div id="t_l_s_6" class="column column_6" style="background-color:#<?php if(in_array('s5',$stages)){echo '11639d';}else{echo '696969';}?>">
            <h1 class="column_head-sub">Stage 5<br>
              Create Student Logins <br>
              & Parent Communication</h1>
            </p>
          </div>
          <div id="t_l_s_7" class="column column_7" style="background-color:#<?php if(in_array('s6',$stages)){echo '11639d';}else{echo '696969';}?>">
            <h1 class="column_head_last">Clubs Roll out as <br>per
              the launch date</h1>
          </div>
        </div>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,900" rel="stylesheet">     
<div class="alert alert-danger" id="error-msg" style="display:none;" >
  <strong>Sorry !</strong> There is some error in the system Please contact Admin.
</div>
<div class="alert alert-danger" id="invalid-msg" style="display:none;" >
  <strong>Sorry !</strong> The data format is invalid please use add data into the Excel Template without modifying headers.
</div>
<div class="alert alert-danger" id="already-msg" style="display:none;" >
  <strong>Sorry !</strong> You have already added students, please contact admin to proceed further.
</div>
<div class="alert alert-success" id="notify-success" style="display:none;" >
  <strong>Success !</strong> We will verify your attendance and update your status soon. Please continue with the process after some time.
</div>
<div class="alert alert-success" id="all-complete" style="display:none;" >
  <strong>Success !</strong> You have completed all the steps our team will contact you soon !
</div>
<div class="container">
          <div class="row justify-content-center">
            <div class="col-md-12" id='s1' <?php if(isset($stages) and $stages[0]=='s0'){}else{echo 'style="display:none;"';} ?>>
              <div class="timeline_card">
                <h4><span>Stage One :</span> Onboarding Starts</h4>
                <div class="timeline_card-first">
                  <p>Greetings from WingXP!
                    Lets get you onboarded on
                    World's best Co-curricular
                    Platform.
                    To begin with please
                    complete the onbarding form
                    to have better future
                    engagements.</p>
                  <!-- <div class="timeline_button-wrapper">
                    <button class="pulse-button" data-toggle="modal" data-target="#exampleModalCenter">Proceed</button>
                  </div> -->
                </div>
              </div>
              <!--Onboarding Form start-->
              <div class="timeline_card">
            <span class="required">* Required Field</span>
            <h1 class="modal__header">Welcome to WingXP! Please fill the form and help us serve you better.</h1>
            <h1 class="modal__head-sub">School Owner </h1><i class="fas fa-info-circle info-icon info-tooltip">
                <span class="tooltiptext tooltip-right">For understanding the School's Vision. For expectation setting for this partnership</span>
            </i>
            <br>
        <form id="stage-1-form" action="index.php" method="POST">
            <div class="row">
              <div class="col-4">
                <label for="">Owner Name</label>
                <input type="text" name="owner_name" class="modal__fields" required autocomplete="none">
              </div>
              <div class="col-4">
                  <label for="">Owner Phone Number</label>
                <input type="text" name="owner_phone" class="modal__fields"  maxlength="10" required autocomplete="none">
              </div>
              <div class="col-4">
                  <label for="">Owner Email</label>
                <input type="email" name="owner_email" class="modal__fields" required autocomplete="none">
              </div>
            </div>
            <h1 class="modal__head-sub">Principal</h1><i class="fas fa-info-circle info-icon info-tooltip">
                <span class="tooltiptext tooltip-right">For overall monitoring and support. For Selection of clubs that will be offered to Students. For appointing a Master Co-ordinator to foresee Implementation and Service.</span>
            </i><br>
            <div class="row">
              <div class="col-4">
                  <label for="">Principal Name</label>
                <input type="text" name="principal_name" class="modal__fields" required autocomplete="none">
              </div>
              <div class="col-4">
                  <label for="">Principal Mobile No</label>
                <input type="text" maxlength="10" name="principal_phone" class="modal__fields" required autocomplete="none">
              </div>
              <div class="col-4">
                  <label for="">Principal Email Id</label>
                <input type="email" name="principal_email"  class="modal__fields" required autocomplete="none">
              </div>
            </div>
            <h1 class="modal__head-sub">Coordinator</h1><i class="fas fa-info-circle info-icon info-tooltip">
                <span class="tooltiptext tooltip-right">For overall execution of the program. For Co-ordination between School and WingXP. For Onboarding of Students on Platform and roll-out of Clubs.</span>
            </i>
            <div class="row">
              <div class="col-4">
                  <label for="">Coordinator Name</label>
                <input type="text" name="coordinator_name" class="modal__fields" required autocomplete="none">
              </div>
              <div class="col-4">
                  <label for="">Coordinator Mobile No</label>
                <input type="text" maxlength="10" name="coordinator_phone" class="modal__fields" required autocomplete="none">
              </div>
              <div class="col-4">
                  <label for="">Coordinator Email Id</label>
                <input type="email" name="coordinator_email" class="modal__fields" required autocomplete="none">
              </div>
            </div>
            
            <div class="row">
              <div class="col-3">
                  <label for="">Address</label>
                <textarea type="text" name="address2" class="modal__fields" required></textarea>
              </div>
              <div class="col-3">
                  <label for="">City</label>
                <input type="text" name="city" class="modal__fields" required >
              </div>
              <div class="col-3">
                  <label for="">State</label>
                <input type="text" name="state" class="modal__fields" required >
              </div>
              <div class="col-3">
                  <label for="">Pin code</label>
                <input type="number" name="pincode" class="modal__fields" required >
              </div>
              <div class="col-3">
                  <label for="">Select Board</label>
                <select name="board" name="board" class="modal__fields"  required autocomplete="none"> 
                   <option value="cbse">CBSE</option> 
                   <option value="icse">ICSE</option>
                   <option value="state">STATE</option>
                   </select>
              </div>
              <div class="col-3">
                  <label for="">Session 2018-19 End Date</label>

                <input type="date" name="sess_end_date" placeholder="Session 2018-19 End Date" class="modal__fields" required autocomplete="none">
              </div>
              <div class="col-3">
                  <label for="">Session 2018-19 Start Date</label>

                <input type="date" name="sess_start_date" class="modal__fields" required autocomplete="none">
              </div>

              <div class="col-3">
                  <label for="">Launch Date</label>
                  <select name="club_launch_date" class="modal__fields" required autocomplete="none"> 
                       <option value="2019-04-01">1<sup>st</sup> April</option> 
                       <option value="2019-05-01">1<sup>st</sup> May</option>
                       <option value="2019-06-01">1<sup>st</sup> June</option>
                   </select>
              </div>
              <div class="col-3">
                  <label for="">Current Student Count</label>
                <input type="number" name="student_count" placeholder="" class="modal__fields" required autocomplete="none">
              </div>
            </div>
            <button type="submit" class="save__btn">Save</button>
            </div>  
              <!--Onboarding Form end-->
        </form>
            </div>
          </div>
          
          <div class="row justify-content-center">
            <div class="col-md-12" id='s2' <?php if(isset($stages) and $stages[0]=='s1'){}else{echo 'style="display:none;"';} ?>>
              <div class="timeline_card">
                <h4><span>Stage Two :</span> Vision Syncing</h4>
                <div class="timeline_card-first">
                  <p>Management & Principal
                    Session.
                    Agreement.
                    Speak with WingXP Head -
                    what to expect from this
                    session.</p>
                    <div class="timeline_button-wrapper">
                        <!-- <button class="pulse-button" data-toggle="modal" data-toggle="modal" data-target="#exampleModalCenter-3">Already Attended ?</button> -->
                      <?php if(isset($check_reg) and $check_reg==false){?>
                        <!-- <button class="pulse-button" data-toggle="modal" data-target="#exampleModalCenter-3">Proceed</button> -->
                      <?php }
                      else{?>                  
                        <!-- <button class="pulse-button"><a href="#" id="web_countdown"></a></button> -->
                      <?php } ?>
                        
                      </div>
                </div>
              </div>
              <!--Vision Syncing Form Start-->
              <!--Vision Syncing-->
          <div class="timeline_card">
             <div class="timeline_card">
              <div class="timeline_cardHeader">
                  <h1>WORLD CLASS CO-CURRICULAR FRAMEWORK</h1>
              </div>
              <div class="timeline_cardHeaderSub">
                  <h1>Webinar For Educators</h1>
              </div>
              <div class="timeline__desciption">
                  <h1>Objective</h1>
                  <p>The challenge for educators today is to design and education framework that keep peace with new world order,empowering students with modern day tools & techniques of expression . Core academics is necessity,but it may not be all encompassing.
                    <br><br>
                    <span> Can Co-Curriculars bridge the gap? </span> 
                   <span> OR </span>
                    The boundaries of core Curriculum framework and Co-Curricular framework must be assessed,aligned and merged.
                  </p>
              </div>
              <div class="row timeline_row" style="margin: 0;">
                <div class="col-6">
                  <h1>AGENDA</h1>
                  <div class="row__grid">
                   <div class="row__grid_img">
                      <img src="assets/images/newspaper.png" alt="">
                   </div>
                    <ul class="row__grid_list">
                      <li>1.Introduction</li>
                      <li>2.New-Age Expressions & Untapped Potential of Co-curricular</li>
                      <li>3.Challenge for Schools & Students</li>
                      <li>4.Solution-Expert-led Co-curricular Clubs</li>
                      <li>5.Benefits for your School,Students & Teachers <br>
                      Followed by feedback and Q & A</li>
                    </ul>
                  </div>
                </div>
                <div class="col-6 new__col">
                    <h1>OBJECTIVE</h1>
                    <h2>A Webinar for School Leaders for</h2>
                    <ul class="row__grid_listNew">
                        <li>Vision Syncing and Expectation Setting</li>
                        <li>Understanding What comprises of World Class Co-Curricular framework?</li>
                        <li>A briefing on the Product and its features</li>
                        <li>4.Solution-Expert-led Co-curricular Clubs</li>
                        <li>Roles And Responsibilities of Wing XP and that of School Co-ordinator<br>
                        </li>
                        <li>Power of expression to the students</li>
                      </ul>
                </div>
              </div>
              <div class="row timeline_rowSub" style="margin: 0;">
                <div class="col-2">
                  <div class="first__inner-row">
                    <h1>who<br>should<br>attend?</h1>
                  </div>
                </div>
                <div class="col-5">
                  <div class="second__inner-row">
                      <h1>The Webinar is for WingXP Sign-up Schools:</h1>
                      <ul>
                        <li>School Management</li>
                        <li>School Coordinator</li>
                        <li>SPOC between School & WingXP</li>
                      </ul>
                  </div>
                </div>
                <div class="col-5">
                    <div class="third__inner-row">
                    <form id="stage-2-form">
                        
                         <?php if(isset($check_reg) and $check_reg==false){?>
                          <select name="web_id" id="web_schedule">                    
                          <?php while($count>0){?>
                            <option data-time-start="<?php $start_time=date('h A',strtotime($web[$count][1]));echo $start_time;?>"
                             data-time-end="<?php $end_time=date_format(date_add(date_create($web[$count][1]), date_interval_create_from_date_string(''.$web[$count][2].' hours')),'h A');echo $end_time; ?>" 
                             value="<?php  echo $web[$count][4]; ?>"><?php echo date('d M Y',strtotime($web[$count][0])); ?></option>
                          <?php $count--;} ?>
                        </select>
                         <h2 class="pl-3" style="display:flex;"><span id="web_start_time_span"><?php if(isset($start_time)){echo $start_time;}?></span><span style="margin:0em 5px 0em 5px;">-</span><span id="web_end_time_span"><?php if(isset($end_time)){echo $end_time;} ?></span></h2>
                         <button type="submit">REGISTER NOW</button>
                      <?php }
                      else{?>                                
                         <h1><span id="web_att_msg" style="font-size: 1.2rem">A link will appear below and <br> your session will start in</span></h1>
                  <a href="#" id="web_countdown" style="width: 250px !important;margin: .5rem auto">Click Here To Attend</a>
                  <a href="#" style="width: 250px !important;margin: .5rem auto" data-toggle="modal" data-target="#exampleModalCenter-3">Already Attended ?</a>
                      <?php } ?>
                      </form>
                    </div>
                </div>
            </div>
        </div>
      </div>

          </div>
              <!--Vision Syncing Form End-->
            </div>
            <div class="col-md-12" id='s3' <?php if(isset($stages) and $stages[0]=='s2'){}else{echo 'style="display:none;"';} ?>>
              <div class="timeline_card">
                <h4><span>Stage Three :</span> Club Selection &
                  Launch Date</h4>
                <div class="timeline_card-first">
                  <p>Form to be filled by the
                    school's Appointed Club
                    Admin.<br>
                    We will guide you to
                    select which clubs are
                    suitable for your school
                    (already covered in
                    previous stage - vision
                    syncing).</p>
                  <div class="timeline_button-wrapper">
                    <!-- <button class="pulse-button" data-toggle="modal" data-target="#exampleModalCenter-2">Proceed</button> -->
                  </div>
                </div>
              </div>
              <!--Club Selection-->
          <div class="timeline_card">
            <span class="required">* Required Field</span>
            <h1 class="modal__header">Please select the clubs to chose from WingXP iclubs and mention the
              existing
              clubs
              you would like to take online on WingXP Platform.</h1>
            <h1 class="modal__header">Please select from the below mentioned 8 WingXP iclubs. *</h1>
            <form id="stage-3-form">
            <div class="row justify-content-center">            
              <div class="col-4">
                <div class="col_image ">
                  <img src="http://wingxp.com/assets/c_images/design-min.png" alt="">
                  <div class="col_check">
                    <input type="checkbox" name="clubs[]" value="club_18" class="check-click">
                    <span>1. Digital Design</span>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="col_image">
                  <img src="http://wingxp.com/assets/c_images/tech-min.png" alt="">
                  <div class="col_check">
                    <input type="checkbox" name="clubs[]" value="club_21" class="check-click">
                    <span>2. Tech Talk</span>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="col_image">
                  <img src="http://wingxp.com/assets/c_images/creative-min.png" alt="">
                  <div class="col_check">
                    <input type="checkbox" name="clubs[]" value="club_21" class="check-click">
                    <span>3. Smarter Minds</span>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="col_image">
                  <img src="http://wingxp.com/assets/c_images/environment-min.jpg" alt="">
                  <div class="col_check">
                    <input type="checkbox" name="clubs[]" value="club_21" class="check-click">
                    <span>4. Environment</span>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="col_image">
                  <img src="http://wingxp.com/assets/c_images/coding-min.png" alt="">
                  <div class="col_check">
                    <input type="checkbox" name="clubs[]" value="club_21" class="check-click">
                    <span>5. Coding</span>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="col_image">
                  <img src="http://wingxp.com/assets/c_images/astro-min.png" alt="">
                  <div class="col_check">
                    <input type="checkbox" name="clubs[]" value="club_21" class="check-click">
                    <span>6. Astronomy</span>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="col_image">
                  <img src="http://wingxp.com/assets/c_images/english-min.png" alt="">
                  <div class="col_check">
                    <input type="checkbox" name="clubs[]" value="club_21" class="check-click">
                    <span>7. English Expression</span>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="col_image">
                  <img src="http://wingxp.com/assets/c_images/news-min.png" alt="">
                  <div class="col_check">
                    <input type="checkbox" name="clubs[]" value="club_21" class="check-click">
                    <span>8. Understanding News</span>
                  </div>
                </div>
              </div>
            </div>
            <button class="save__btn" type="submit">Save</button>
            </form>
          </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-12" id='s4' <?php if(isset($stages) and $stages[0]=='s3'){}else{echo 'style="display:none;"';} ?>>
              <div class="timeline_card">
                <h4><span>Stage Four :</span> Club Managers
                  Identification & Session</h4>
                <div class="timeline_card-first">
                  <p>Identification form.
                    Club Managers Session.</p>                    
                </div>
              </div>
              <!--Club Managers Form Start-->
               <!--Club Managers-->
              
             <div class="timeline_card">
              
              <div class="row timeline_rowSub" style="margin: 0;">
                <div class="col-2">
                  <div class="first__inner-row">
                    <h1>who<br>should<br>attend?</h1>
                  </div>
                </div>
                <div class="col-5">
                  <div class="second__inner-row">
                      <h1>The Webinar is for WingXP Sign-up Schools:</h1>
                      <ul>
                        <li>School Management</li>
                        <li>School Coordinator</li>
                        <li>SPOC between School & WingXP</li>
                      </ul>
                  </div>
                </div>
                <div class="col-5">
                    <div class="third__inner-row">
                    <form id="stage-4-form">
                         <?php if(isset($check_reg_4) and $check_reg_4==false){?>
                          <select name="web_id" id="web_schedule">                         
                          <?php while($count_2>0){?>
                            <option data-time-start="<?php $start_time=date('h A',strtotime($web_2[$count_2][1]));echo $start_time;?>"
                             data-time-end="<?php $end_time=date_format(date_add(date_create($web_2[$count_2][1]), date_interval_create_from_date_string(''.$web_2[$count_2][2].' hours')),'h A');echo $end_time; ?>" 
                             value="<?php  echo $web_2[$count_2][4]; ?>"><?php echo date('d M Y',strtotime($web_2[$count_2][0])); ?></option>
                          <?php $count_2--;} ?>
                        </select>
                         <h2 class="pl-3" style="display:flex;"><span id="web_start_time_span"><?php if(isset($start_time)){echo $start_time;}?></span><span style="margin:0em 5px 0em 5px;">-</span><span id="web_end_time_span"><?php if(isset($end_time)){echo $end_time;} ?></span></h2>
                          <button type="submit">REGISTER NOW</button>
                      <?php }
                      else{?>      
                          <h1><span id="web_att_msg_2" style="font-size: 1.2rem">A link will appear below and <br> your session will start in</span></h1>
                  <a href="#" id="web_countdown_2" style="width: 250px !important;margin: .5rem auto">Click Here To Attend</a>
                  <a href="#" style="width: 250px !important;margin: .5rem auto" data-toggle="modal" data-target="#exampleModalCenter-3">Already Attended ?</a>
                      <?php } ?>
                      </form>
                    </div>
                </div>
                </div>
            </div>
              <!-- Club Managers Form End-->
            </div>
            <div class="col-md-12" id='s5' <?php if(isset($stages) and $stages[0]=='s4'){}else{echo 'style="display:none;"';} ?>>
              <div class="timeline_card">
                <h4><span>Stage Five :</span> Create Student Logins
                  &<br>
                  Parent Communication</h4>
                <div class="timeline_card-first">

                  <p>School to upload the student
                    information by logging in the
                    school dashboard.<br>
                    Welcome note
                    Launch Date
                    link with complete information
                    on what to expect etc...</p>
                  <div class="timeline_button-wrapper">
                    <!-- <button class="pulse-button">Proceed</button> -->
                  </div>
                </div>
              </div>
              <!-- Student Account Creation Starts -->
      <div class="form-wrap">
        <div class="tabs">
          <h3 class="tab-header">
            <a href="#signup-tab-content">Add A Student</a>
          </h3>
          <h3 class="tab-header"><a class="active" href="#login-tab-content">Import</a></h3>
        </div>

        <div class="tabs-content">
          <div id="signup-tab-content">
            <form action="" id="form_manual" enctype="multipart/form-data">
              <div class="tab-content-form">
                <input
                  type="text"
                  name="roll"
                  placeholder="Roll No"
                  class="tab-content-form_fields"
                />
                <input
                  type="text"
                  name="name"
                  placeholder="Name"
                  class="tab-content-form_fields"
                />
                <input
                  type="text"
                  name="phone"
                  placeholder="Phone"
                  class="tab-content-form_fields"
                />
                <input
                  type="text"
                  name="p_name"
                  placeholder="Parent Name"
                  class="tab-content-form_fields"
                />
                <input
                  type="text"
                  name="p_phone"
                  placeholder="Parent Phone"
                  class="tab-content-form_fields"
                />
                <input
                  type="email"
                  name="email"
                  placeholder="Email"
                  class="tab-content-form_fields"
                />
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
                <select name="batch" id="batch">
                  <option>Select Batch</option>                  
                </select>
              </div>
              <button class="tab-content-form_btn" type="button" onclick="save();">
                <span>Submit</span>
              </button>
            </form>
          </div>
          <div id="login-tab-content" class="active">
            <div class="tab-content">
              <h1 class="tab-content-import_header">Download Excel Template Here</h1>
              <a href="../assets/dataprocess/sample.xlsx"  download="template">Download</a>
              <h1 class="tab-content-import_header" style="margin-top:10px;">Upload Excel File Here</h1>
              <form action="" id="import" enctype="multipart/form-data">
              
              <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button class="tab-content-form_btn import_btn" type="button" onclick="import_fn();">
                  <span>Import</span>
                </button>
              </form>
            </div>
        </div>
      </div>  
              <!-- Student Account Creation Ends -->
            </div>
          </div>

        </div>
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
  <script src="script.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script>
    $('#web_schedule').change(function(){
      var start = $('option:selected', this).attr('data-time-start');
      var end = $('option:selected', this).attr('data-time-end');
      $('#web_start_time_span').text(start);
      $('#web_end_time_span').text(end);
    });
    $('form').submit(function(event) {
      event.preventDefault();
    var $form = $(this);
    var id = $form.attr('id');
    var stage = id.split("-");
   proceed(id,stage[1]);
});

    function proceed(form,stage){  
      event.preventDefault();
      var form = $('#'+form)[0];
      var data = new FormData(form);
      $.ajax({
          type: "POST",
          enctype: 'multipart/form-data',
          url: "stage.php?stage="+stage,
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          timeout: 600000,
          success: function (data) { 
            console.log(data);
            if(data=='success'){
              $('#s'+stage).hide();                          
            var next_stage=parseInt(stage)+1;
            $('#t_l_s_'+next_stage).css("background-color", "#11639d");
            $('#s'+next_stage).show();
            }
            else if(data=='pending'){
              location.reload();
              window.scrollTo(0,0);
            }
            else if(data=='error'){
              alert('Error, Please Contact Admin');
            }
            
          },
          error: function (e) {           
            console.log(e);
          }
      });
    }
    function notify(event,institute_id,institute_name){
      $.ajax({
          type: "GET",
          url: "stage.php?event="+event+'&institute_id='+institute_id+'&institute_name='+institute_name,
          success: function (data) { 
            console.log(data);
            if(data=='success'){
            $('.close-stage-jquery').click();
            $('#notify-success').show();
            }
            else if(data=='error'){
              $('#error-webinar').show();
            }            
          },
          error: function (e) {           
            console.log(e);
          }
      });
    }

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
						  } 
					       });
    }
    function get_batch_imp(){
      var class_v= $('#class_imp').val();
    $.ajax({
						  type: 'GET',
						  url: 'get_batch.php?class='+class_v,
						  data: '',
						  success: function(response){                                         
						    $('#batch_imp').html(response);                            
						  } 
					       });
    }
    function save(){
      var roll= $('#roll').val();
    var name= $('#name').val();
    var phone= $('#phone').val();
    var p_name= $('#p_name').val();
    var p_phone= $('#p_phone').val();
    var email= $('#email').val();
    var school_class= $('#school_class').val();
    var batch= $('#batch').val();
      if(roll == '' || name == '' || phone == '' || p_name == ''  || p_phone == '' || 
      email == '' || school_class == ''|| batch == '' )
                  {
		        alert('Please make sure all fields are filled.');
                event.preventDefault();
		  } 
      else {            
       event.preventDefault();            
       var form = $('#form_manual')[0];           
       var data = new FormData(form); 
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "add_user_back.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
			success: function(response){ 
        console.log(response);   
      if(response=='success'){
              $('#s4').hide();     
            $('#t_l_s_5').css("background-color", "#11639d");
            $('#s5').show();
      }                
      else if (response=='error'){

      }      
			} 
			});
      }

}

function import_fn(){  
    var school_class= $('#class_imp').val();
    var batch= $('#batch_imp').val();
      if(school_class == ''|| batch == '' )
                  {
		        alert('Please make sure all fields are filled.');
                event.preventDefault();
		  } 
      else {            
       event.preventDefault();            
       var form = $('#import')[0];           
       var data = new FormData(form); 
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "process.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
			success: function(response){ 
        console.log(response);   
      if(response=='success'){ 
            $('#s5').hide();     
            $('#t_l_s_6').css("background-color", "#11639d");
            //$('#s6').show(); NOT PRESENT
            $('#all-complete').show();
      }                
      else if (response=='error'){    
           $('#error-msg').show();
      }      
      else if (response=='invalid_format'){
        $('#invalid-msg').show();
      } 
      else if (response=='update_error'){
        $('#already-msg').show();
      } 
			} 
			});
      }

}
    
    </script>
    <!--Vision Form Modal-->
  <div class="modal fade " id="exampleModalCenter-3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Vision Syncing</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h1 class="modal__header" style="margin:10px 0;">
        Have you already attended a Webinar on Vision Syncing ? If yes Please Notify us</h1>   
        <button class="save__btn" onclick="notify('stage-2','<?php echo $_SESSION['Userid'];?>','<?php echo $inst_name; ?>')">Notify Us</button>           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-stage-jquery" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade close-stage-jquery" id="exampleModalCenter-4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Club Manager Identification & Session</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        Have you already attended a Webinar for Club Management ? If yes Please Notify us</h1>   
        <button class="save__btn" onclick="notify('stage-4','<?php echo $_SESSION['Userid'];?>','<?php echo $inst_name; ?>')">Notify Us</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-stage-jquery" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    var timestamp='';
  <?php if(isset($web_time[0]) and $check_reg==true ){echo ' timestamp="'.$web_time[0].'";';}?>
  <?php if(isset($web_time[1]) and $check_reg_4==true){echo ' timestamp="'.$web_time[1].'";';}?>
 // alert(timestamp);
    // Set the date we're counting down to
var countDownDate = new Date(timestamp).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    if(document.getElementById("web_countdown")){
      document.getElementById("web_countdown").innerHTML = "Click here to attend";
      document.getElementById("web_countdown").href = "<?php if(isset($web_link[0])){echo "//$web_link[0]";}?>";
      $('#web_att_msg').text('Click the link to attend');
    }
    if(document.getElementById("web_countdown_2")){
      document.getElementById("web_countdown_2").innerHTML = "Click here to attend";
      document.getElementById("web_countdown_2").href = "<?php if(isset($web_link[1])){echo "//$web_link[1]";}?>";
      $('#web_att_msg_2').text('Click the link to attend');
    }    
  }
  else{

    if(document.getElementById("web_countdown")){
      document.getElementById("web_countdown").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    }

    if(document.getElementById("web_countdown_2")){
      document.getElementById("web_countdown_2").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    }

  }
}, 1000);
  </script>
     <!--Onboarding Form Modal
   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">WingXP School Onboarding Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span class="required">* Required Field</span>
          <h1 class="modal__header">Welcome to WingXP! Please fill the form and help us serve you better.</h1>
          <h1 class="modal__head-sub">School Owner</h1>
          <p class="modal__para">Why? For a healthy beginning we would like to know you and your team better. So what
            happens next..
            A. Warm Welcome : We would like to extend a warm welcome on behalf of team WingXP
            B. School's Vision : We would like to understand the School's Vision and sync with WingXP's Vision to
            establish a transparent and healthy long lasting relationship.
            C. Expectation Setting: To understand the expectations from WingXP and agree on what to expect in return?
          </p>
          <form id='stage-1-form'>
          <div class="row">          
            <div class="col-6">              
              <input type="text" name="prin_name" placeholder="Owner Name" class="modal__fields">
            </div>
            <div class="col-6">
              <input type="text" name="prin_phone" placeholder="Owner Mobile No" class="modal__fields">
            </div>
            <div class="col-6">
              <input type="text" name="prin_email" placeholder="Owner Email Id" class="modal__fields">
            </div>
            <div class="col-6">
              <input type="time" name="call_at" placeholder="Preferred time to call" class="modal__fields">
            </div>
            <button class="save__btn" name="stage-1" onclick="proceed(1);">Save</button>          
          </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary close-stage-jquery" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>-->

  <!--Club Selection Modal
  <div class="modal fade" id="exampleModalCenter-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">WingXP - CLUB SELECTION FORM</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="stage-3-form">
        <div class="modal-body">
          <h1 class="modal__header">Please select the clubs to chose from WingXP iclubs and mention the existing clubs
            you would like to take online on WingXP Platform.</h1>      
          <h1 class="modal__header">Please select from the below mentioned 8 WingXP iclubs. *</h1>
          <div class="row justify-content-center">
            <div class="col-4">
              <div class="col_image ">
                <img src="http://wingxp.com/assets/c_images/design-min.png" alt="">
                <input type="checkbox" name="clubs[]" value="club_18" class="check-click">
                <span>1. Digital Design</span><br>
                <input type="date" name="club_18">
              </div>
            </div>
            <div class="col-4">
              <div class="col_image">
                <img src="http://wingxp.com/assets/c_images/tech-min.png" alt="">
                <input type="checkbox" name="clubs[]" value="club_21">
                <span>2. Tech Talk</span><br>
                <input type="date" name="club_21">
              </div>
            </div>
            <div class="col-4">
              <div class="col_image">
                <img src="http://wingxp.com/assets/c_images/creative-min.png" alt="">
                <input type="checkbox" name="clubs[]" value="club_22">
                <span>3. Smarter Minds</span><br>
                <input type="date" name="club_22">

              </div>
            </div>
            <div class="col-4">
              <div class="col_image">
                <img src="http://wingxp.com/assets/c_images/environment-min.jpg" alt="">
                <input type="checkbox" name="clubs[]" value="club_23">
                <span>4. Environment</span><br>
                <input type="date" name="club_23">
              </div>
            </div>
            <div class="col-4">
              <div class="col_image">
                <img src="http://wingxp.com/assets/c_images/coding-min.png" alt="">
                <input type="checkbox" name="clubs[]" value="club_24">
                <span>5. Coding</span><br>
                <input type="date" name="club_24">
              </div>
            </div>
            <div class="col-4">
              <div class="col_image">
                <img src="http://wingxp.com/assets/c_images/astro-min.png" alt="">
                <input type="checkbox" name="clubs[]" value="club_25">
                <span>6. Astronomy</span><br>
                <input type="date" name="club_25">
              </div>
            </div>
            <div class="col-4">
              <div class="col_image">
                <img src="http://wingxp.com/assets/c_images/english-min.png" alt="">
                <input type="checkbox" name="clubs[]" value="club_26">
                <span>7. English Expression</span><br>
                <input type="date" name="club_26">
              </div>
            </div>
            <div class="col-4">
              <div class="col_image">
                <img src="http://wingxp.com/assets/c_images/news-min.png" alt="">
                <input type="checkbox" name="clubs[]" value="club_27">
                <span>8. Understanding News</span><br>
                <input type="date" name="club_27">
              </div>
            </div>
          </div>        
          <button class="save__btn" name="stage-3" onclick="proceed(3)">Save</button>          
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-stage-jquery" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>-->
</body>

</html>