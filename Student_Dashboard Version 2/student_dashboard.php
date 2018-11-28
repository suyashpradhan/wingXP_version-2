<?php
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
/*
$user_id=$_SESSION['Userid'];

$user = new User($conn);
$uid = $_SESSION['Userid'];
if(!$user->get_session())
{
   header("location:../../index.php");
}
if(isset($_GET['q']))
{ 
        if($_GET['q'] == "logout")
  	{
		$user->user_logout();
		header("location:../../index.php");
	}
}

$query12="select * from inst_user where user_id='$user_id'";
$student_d=$conn->query($query12);
$row12 = $student_d->fetch_array();
*/
if(isset($_GET['id'])){
    $club_id= $_GET['id'];
    }
    else{
        if(isset($_POST['club_id']))
        {
            $club_id= $_POST['club_id'];
        }
        else
        {
            $club_id= "CI_14";
        }
    }
    $flag=(preg_match('(school_club_)',$club_id)? 1:0);    
    $inst_id = $row12['institute_id']='INST_258';

$clb_name_q = ($flag == 0 ? "select club_name from clubs where club_id= '$club_id'" :  "select club_name from school__clubs where club_id= '$club_id'");
$clb_name = $conn->query($clb_name_q);
while($row = $clb_name->fetch_array())
{
 $club_name =$row['club_name'];
}
$get_theme_q = ($flag == 0 ? "SELECT topic_desc,topic_name,topic_id from topic where club_id = '$club_id' and status='1' and end_date > CURRENT_DATE() order by end_date asc limit 2" :
"SELECT topic_desc,topic_name,topic_id from school__topic where club_id = '$club_id' and status='1' and end_date > CURRENT_DATE() order by end_date asc limit 2");
$theme = $conn->query($get_theme_q);
$i=0;
while($row = $theme->fetch_array())
  {
   $themes[$i] =$row['topic_desc'];
   $themes[$i+2] =$row['topic_name'];
   $themes[$i+4] =$row['topic_id'];
   $i++;
  }
$get_club_q=($flag == 0 ? "SELECT clubs.club_name,inst_club_coordinator.detail
 from cc_club_assign INNER JOIN clubs ON clubs.club_id=cc_club_assign.club_id  INNER JOIN inst_club_coordinator
  ON inst_club_coordinator.club_coordinator_id = cc_club_assign.club_coordinator_id where clubs.club_id = '$club_id' AND  inst_club_coordinator.institute_id = '$inst_id'" :
   "SELECT school__clubs.club_name,inst_club_coordinator.detail
   from cc_club_assign INNER JOIN school__clubs ON school__clubs.club_id=cc_club_assign.club_id  INNER JOIN inst_club_coordinator
    ON inst_club_coordinator.club_coordinator_id = cc_club_assign.club_coordinator_id where school__clubs.club_id = '$club_id' AND  inst_club_coordinator.institute_id = '$inst_id'");

$videos= ($flag == 0 ? "SELECT video_id, title, date_added,description_line,learning,link,video_file,duration from video where topic_id = '$themes[4]' and club_id = '$club_id' and status ='1' order by date_added DESC LIMIT 5":
"SELECT video_id, title, date_added,description_line,learning,link,video_file,duration from school__video where topic_id = '$themes[4]' and club_id = '$club_id' and status ='1' order by date_added DESC LIMIT 5");
$learning_videos= ($flag == 0 ? "SELECT video_id, title, learning,link,video_file,duration from learning_video where topic_id = '$themes[4]' and club_id = '$club_id' and status ='1' order by date_added DESC LIMIT 2" :
"SELECT video_id, title, learning,link,video_file,duration from school__learning_video where topic_id = '$themes[4]' and club_id = '$club_id' and status ='1' order by date_added DESC LIMIT 2");
$s_work_q=  ($flag == 0 ? "SELECT sample_work_id, title, date_added,description_line,link,video_file,image,media_type,duration,last_date,pdf from sample_work where topic_id = '$themes[4]' and club_id = '$club_id' and status ='1' order by date_added ASC LIMIT 2":
"SELECT sample_work_id, title, date_added,description_line,link,video_file,image,media_type,duration,last_date,pdf from school__sample_work where topic_id = '$themes[4]' and club_id = '$club_id' and status ='1' order by date_added ASC LIMIT 2");
$articles= ($flag == 0 ? "SELECT icon,description,author,date_added,name,link from article where topic_id = '$themes[4]' and club_id='$club_id' and status ='1' and featured != '1' order by date_added DESC LIMIT 5":
"SELECT icon,description,author,date_added,name,link from school__article where topic_id = '$themes[4]' and club_id='$club_id' and status ='1' and featured != '1' order by date_added DESC LIMIT 5");
$feat_articles=  ($flag == 0 ? "SELECT icon,description,author,date_added,name,link from article where topic_id = '$themes[4]' and club_id='$club_id' and status ='1' and featured = '1' order by date_added DESC LIMIT 1":
"SELECT icon,description,author,date_added,name,link from school__article where topic_id = '$themes[4]' and club_id='$club_id' and status ='1' and featured = '1' order by date_added DESC LIMIT 1");
$up_workshop = ($flag == 0 ? "SELECT course_icon,date,title,description_line,workshop_id from workshop where topic_id = '$themes[4]' and club_id='$club_id' order by date_added DESC LIMIT 2":
"SELECT course_icon,date,title,description_line,workshop_id from school__workshop where topic_id = '$themes[4]' and club_id='$club_id' order by date_added DESC LIMIT 2"); 
$up_webinar = ($flag == 0 ? "SELECT title,speaker,speaker_desc,speaker_img,description,date,start_time,end_time,learning,link,webinar_id from webinar where topic_id = '$themes[4]' and club_id='$club_id' and status = '1' order by date DESC LIMIT 1":
"SELECT title,speaker,speaker_desc,speaker_img,description,date,start_time,end_time,learning,link,webinar_id from school__webinar where topic_id = '$themes[4]' and club_id='$club_id' and status = '1' order by date DESC LIMIT 1");
$q = ($flag == 0 ? "SELECT link from quiz where topic_id = '$themes[4]' and club_id='$club_id' and status = '1' order by date_added DESC LIMIT 2":
"SELECT link from school__quiz where topic_id = '$themes[4]' and club_id='$club_id' and status = '1' order by date_added DESC LIMIT 2");
$club_q= " select clubs.club_id, clubs.club_name from clubs inner join school__iclub_assign on 
clubs.club_id =school__iclub_assign.club_id where school__iclub_assign.status='1' and school__iclub_assign.inst_id='$inst_id' UNION ALL
select club_id, club_name from school__clubs where status='1' and inst_id='$inst_id'";
$club_result = $conn->query($club_q);
$l_vid_result = $conn->query($learning_videos);
$club = $conn->query($get_club_q); 
$result4 = $conn->query($videos);
$result3 = $conn->query($articles);
$result5 = $conn->query($up_workshop);
$result6 = $conn->query($up_webinar);
$result7 = $conn->query($q);
$s_work_result = $conn->query($s_work_q);
$feat_art_result = $conn->query($feat_articles);
while($row = $feat_art_result->fetch_array())
  {
   $feat_icon =$row['icon'];
   $feat_desc = $row['description'];   
   $feat_name = $row['name']; 
   $feat_link = $row['link']; 
  }
/*$i=0;
        while($clb[$i] = mysqli_fetch_row($club_result))
        { $j=0;      
            foreach($clb[$i] as $c ){
                $club_list[$i][$j]=$c;                
                $j++;
            }
            $i++;     
        }*/
        
while($row = $club->fetch_array())
  {
   $club_name =$row['club_name'];
   $detail = $row['detail'];   
  }
$i=0;
while($vid[$i] = mysqli_fetch_row($result4))
        { $j=0;      
            foreach($vid[$i] as $v ){
                $video[$i][$j]=$v;
                $j++;
            }
            $i++;     
        }
$i=0;
while($l_vid[$i] = mysqli_fetch_row($l_vid_result))
        { $j=0;      
            foreach($l_vid[$i] as $lv ){
                $learning_video[$i][$j]=$lv;
                $j++;
            }
            $i++;     
        }
$i=0;
while($s_vid[$i] = mysqli_fetch_row($s_work_result))
        { $j=0;      
            foreach($s_vid[$i] as $sv ){
                $sample_work[$i][$j]=$sv;
                $j++;
            }
            $i++;     
        }
$i=0;
while($work[$i] = mysqli_fetch_row($result5))
        { $j=0;      
            foreach($work[$i] as $wrk ){
                $workshop[$i][$j]=$wrk;
                $j++;
            }
            $i++;     
        }
        $up_webinar_result = $conn->query($up_webinar);
        while($row = $up_webinar_result->fetch_array())
          {
           $web_title =$row['title'];
           $web_speaker = $row['speaker'];   
           $web_speaker_desc = $row['speaker_desc'];
           $web_speaker_img = $row['speaker_img']; 
           $web_description = $row['description'];
           $web_date = $row['date'];
           $web_start_time = $row['start_time'];  
           $web_end_time = $row['end_time']; 
           $web_learning = $row['learning'];
           $web_link = $row['link']; 
           $webinar_id = $row['webinar_id'];
          }
$i=0;
while($art[$i] = mysqli_fetch_row($result3))
        { $j=0;      
            foreach($art[$i] as $a ){
                $article[$i][$j]=$a;
                $j++;
            }
            $i++;     
        }
        $i=0;
        while($qui[$i] = mysqli_fetch_row($result7))
                { $j=0;      
                    foreach($qui[$i] as $qu ){
                        $quiz_link[$i][$j]=$qu;
                        $j++;
                    }
                    $i++;     
                }
                function get_video_id ($vid_link){
                    $temp_link = $vid_link;
                    $video_id = explode("/embed/", $temp_link); 
                    return $video_id[1];
                }
                function video_duration($duration){
                    $temp=getdate(strtotime($duration));
                    if($temp['hours']>0){
                        $form='H:i:s';
                    }
                    else{
                        $form='i:s';
                    } 
                    echo date("$form",strtotime($duration));
                }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <style>
        .owl-dots {
            display: none;
        }
    </style>
</head>

<body>
<div class="name-wrap">
        <div class="name-row-new">
            <div class="name-row-text">
                <h1><?php echo $row12['name']; ?></h1>
            </div>
            <div class="name-row-button">
                <a href="?q=logout" class="name-row-button">Logout</a>
            </div>
            <div class="menu-div">
                <nav class="sidebar-nav">
                    <ul>
                        <li>
                            <a href="#"><i class="fas fa-bars menu-bar"></i></a>
                            <ul class="navbar-dropdown">
                                <li>
                                    <a href="./my_upload.php?id=club_web">My Uploads</a>
                                </li>                                
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>    
    <header class="navbar-shadow" style="background-color: #fff;">
        <nav id='cssmenu'>
            <div class="logo"><a href="index.html">
                    <img src="assets/images/logo.png" alt="" height="60px">
                </a></div>
            <div id="head-mobile"></div>
            <div class="cl-button"></div>
            <ul style="border: 1px solid #a2a2a2;
            background-color: #f4f4f4;
            box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
            border-radius: 5px;
            color: #000">
                <h1 class="club-head-text" style="color: #34495e;text-align: left;padding: 10px;font-size: 24px;">Welcome
                    To <?php if(isset($club_name)){echo $club_name;}else{}?></h1>
                <li><a href='#'>Home</a></li>
                <li><a href='#'>My Profile</a></li>
                <li><a href='#'>Dashboard</a></li>
                <li><a href='#'>FAQ's</a></li>
                <li><a href='#'>Change Club</a>
                    <ul>
                        <form action="#" method="POST" >
                                        <?php $i=0;
                                    while($clb[$i] = mysqli_fetch_row($club_result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club_lst[$i][$j]=$c;
                                            if($flag==0){echo '<li><a id="'.$club_lst[$i][$j].'" href="?id='.$club_lst[$i][$j].'" target="_self"  >';$flag++;}
                                            else{echo $club_lst[$i][$j].'</a></li>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
                                    }?>
    </form>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>    
        <div class="navbar">
            <div class="nav-main">
                <div class="nav-first">
                    <img src="assets/images/logo.png" alt="" class="logo-img">
                </div>
                <div class="nav-second">
                    <nav class="navbar">
                        <ul class="nav" style="display: block;">
                            <h1 class="club-st-text">Club</h1>
                            <li><?php if(isset($club_name)){echo $club_name;}else{}?><i class="fas fa-angle-down"></i>
                    
                                    <ul class="dropdown">
                                    <form action="#" method="POST" style="padding: 2px 15px; font-size:15px; margin:10px 0px;">
                                        <?php $i=0;
                                    while($clb2[$i] = $clb[$i])
                                    { $j=$flag=0;      
                                        foreach($clb2[$i] as $c ){                                            
                                            $club_lst[$i][$j]=$c;
                                            if($flag==0){echo '<li><a class="dropdown-link" id="'.$club_lst[$i][$j].'" href="?id='.$club_lst[$i][$j].'" target="_self"  >';$flag++;}
                                            else{echo $club_lst[$i][$j].'</a></li>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
                                    }?>
                                </form>
                                    </ul>
                                 </li>
                          </ul>
                    </nav>                                
                </div>
            </div>
            </div>
        <div class="page-lay-new">
        <div class="theme-div">
            <h1 class="theme-text">Theme Of The Month</h1>
            <h1 class="topic-wrap"><?php if(isset($themes[2])){echo $themes[2];}else{}?></h1>
            <p class="topic-description"><?php if(isset($themes[0])){echo $themes[0];}else{}?></p>
        </div>
            <div class="td-container tdc-row">
                <div class="td_block_wrap td_block_big_grid_3 td_uid_19_5bcab222a8ccb_rand td-grid-style-1 td-hover-1 td-big-grids td-pb-border-top td_block_template_1"
                    data-td-block-uid="td_uid_19_5bcab222a8ccb">
                    <div id="td_uid_19_5bcab222a8ccb" class="td_block_inner">
                        <div class="td-big-grid-wrapper">
                            <div class="td_module_mx5 td-animation-stack td-big-grid-post-0 td-big-grid-post td-big-thumb">
                                <div class="td-module-thumb" style="background-repeat:no-repeat;
                                background-size:cover;background-position: center;background-image:url(../../../assets/article/<?php if(isset($article[0][0])){echo $article[0][0];}else{}?>);">
                                    <a href="<?php if(isset($article[0][5])){echo $article[0][5];}else{}?>" target="_blank"
                                        rel="bookmark" class="td-image-wrap"></a></div>
                                <div class="td-meta-info-container">
                                    <div class="td-meta-align">
                                        <div class="td-big-grid-meta">
                                            <a href="" class="td-post-category"><?php if(isset($themes[2])){echo $themes[2];}else{}?></a>
                                            <h3 class="entry-title td-module-title"><?php if(isset($article[0][4])){echo mb_strimwidth(strip_tags($article[0][4]), 0, 50, "...");}else{}  ?></a></h3>
                                        </div>
                                        <div class="td-module-meta-info"><span class="td-post-date"><time class="entry-date updated td-module-date"
                                                    datetime="2017-03-22T05:58:41+00:00"><?php if(isset($article[0][3])){echo date(' M d, Y',strtotime($article[0][3]));}else{} ?></time></span> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="td-big-grid-scroll">
                                <div class="td_module_mx11 td-animation-stack td-big-grid-post-1 td-big-grid-post td-medium-thumb">
                                    <div class="td-module-thumb"
                                    style="background-repeat:no-repeat;background-position: center;background-size:cover;background-image:url(../../../assets/article/<?php if(isset($article[1][0])){echo $article[1][0];}else{}?>);">
                                    <a href="<?php if(isset($article[1][5])){echo $article[1][5];}else{}?>" target="_blank"
                                            rel="bookmark" class="td-image-wrap"></a></div>
                                    <div class="td-meta-info-container">
                                        <div class="td-meta-align">
                                            <div class="td-big-grid-meta">
                                                <a href="" class="td-post-category"><?php if(isset($themes[2])){echo $themes[2];}else{}?></a>
                                                <h3 class="entry-title td-module-title"><?php if(isset($article[1][4])){echo mb_strimwidth(strip_tags($article[1][4]), 0, 50, "...");}else{}  ?></a></h3>
                                            </div>
                                            <div class="td-module-meta-info">
                                                <span class="td-post-date"><time
                                                        class="entry-date updated td-module-date" datetime="2017-03-22T05:58:41+00:00"><?php if(isset($article[1][3])){echo date(' M d, Y',strtotime($article[1][3]));}else{} ?></time></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="td_module_mx6 td-animation-stack td-big-grid-post-2 td-big-grid-post td-small-thumb">
                                <div class="td-module-thumb"
                                    style="background-repeat:no-repeat;background-position: center;background-size:cover;background-image:
                                    url(../../../assets/article/<?php if(isset($article[2][0])){echo $article[2][0];}else{}?>);">
                                    <a href="<?php if(isset($article[2][5])){echo $article[2][5];}else{}?>" target="_blank"
                                            rel="bookmark" class="td-image-wrap"></a></div>
                                    <div class="td-meta-info-container">
                                        <div class="td-meta-align">
                                            <div class="td-big-grid-meta">
                                                <a href="" class="td-post-category"><?php if(isset($themes[2])){echo $themes[2];}else{}?></a>
                                                <h3 class="entry-title td-module-title"><?php if(isset($article[2][4])){echo mb_strimwidth(strip_tags($article[2][4]), 0, 50, "...");}else{}  ?></a></h3>
                                            </div>
                                            <div class="td-module-meta-info">
                                                 <span class="td-post-date"><time class="entry-date updated td-module-date"
                                                        datetime="2017-03-22T05:58:41+00:00"><?php if(isset($article[2][3])){echo date(' M d, Y',strtotime($article[2][3]));}else{} ?></time></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="td_module_mx6 td-animation-stack td-big-grid-post-3 td-big-grid-post td-small-thumb">
                                <div class="td-module-thumb"
                                    style="background-repeat:no-repeat;background-position: center;background-size:cover;background-image:
                                    url(../../../assets/article/<?php if(isset($article[3][0])){echo $article[3][0];}else{}?>);">
                                    <a href="<?php if(isset($article[3][5])){echo $article[3][5];}else{}?>" target="_blank"
                                            rel="bookmark" class="td-image-wrap"></a></div>
                                    <div class="td-meta-info-container">
                                        <div class="td-meta-align">
                                            <div class="td-big-grid-meta">
                                                <a href="" class="td-post-category"><?php if(isset($themes[2])){echo $themes[2];}else{}?></a>
                                                <h3 class="entry-title td-module-title"><?php if(isset($article[3][4])){echo mb_strimwidth(strip_tags($article[3][4]), 0, 50, "...");}else{}  ?></a></h3>
                                            </div>
                                            <div class="td-module-meta-info">
                                                <span class="td-post-date"><time class="entry-date updated td-module-date"
                                                        datetime="2017-03-22T05:58:41+00:00"><?php if(isset($article[3][3])){echo date(' M d, Y',strtotime($article[3][3]));}else{} ?></time></span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="xplore-section left-right-gap">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                        <div class="td-block-title-wrap">
                            <h4 class="block-title td-block-title" style="border-bottom: 2px solid #2abfd4;"><span
                                    class="
                            td-pulldown-size"
                                    >XPLORE</span></h4>
                    </div>
                    <p class="
                                    row-para">
                                    An age appropriate, curated content platform introducing students to a
                                    range
                                    of topics relevant
                                    in
                                    today’s world</p>
                                    <div class="verticalCarousel">
                                        <ul class="verticalCarouselGroup vc_list">
                                            <div class="inner-row-sections">
                                                <div class="row-image">
                                                    <img src="<?php if($video[0][6]==''){echo 'https://img.youtube.com/vi/'.get_video_id($video[0][5]).'/mqdefault.jpg';}else{echo '../../assets/images/A1.jpg';} ?>">
                                                    <div class="video-icon ">
                                                        <a href="#" data-toggle="modal" data-target="#videoModal1"
                                                            data-theVideo="<?php if($video[0][6]==''){echo $video[0][5];}else{echo $video[0][6];} ?>">
                                                            <span class="icon-play">
                                                                ▶&nbsp;<?php if(isset($video[0][7])){video_duration($video[0][7]);}else{} ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h1 class="row-text-head"><?php if(isset($video[0][1])){echo $video[0][1];}else{} ?></h1>
                                                    <h1 class="row-text-date"><?php if(isset($video[0][2])){echo date(' M d Y',strtotime($video[0][2]));}else{} ?></h1>
                                                    <p class="row-text-para"><?php if(isset($video[0][4])){echo mb_strimwidth(strip_tags($video[0][4]), 0, 150, "...");}else{}  ?></p>
                                                </div>
                                            </div>
                                            <div class="inner-row-sections ">
                                                <div class="row-image">
                                                    <img src="<?php if($video[1][6]==''){echo 'https://img.youtube.com/vi/'.get_video_id($video[1][5]).'/mqdefault.jpg';}else{echo 'assets/images/pexels-photo-1148820.jpeg';} ?>">
                                                    <div class="video-icon">
                                                        <a href="#" data-toggle="modal" data-target="#videoModal2" data-theVideo="<?php if($video[1][6]==''){echo $video[1][5];}else{echo $video[1][6];} ?>">
                                                            <span class="icon-play">
                                                                ▶&nbsp;<?php if(isset($video[1][7])){video_duration($video[1][7]);}else{} ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h1 class="row-text-head"><?php if(isset($video[1][1])){echo $video[1][1];}else{} ?></h1>
                                                    <h1 class="row-text-date"><?php if(isset($video[1][2])){echo date(' M d Y',strtotime($video[1][2]));}else{} ?></h1>
                                                    <p class="row-text-para"><?php if(isset($video[1][4])){echo mb_strimwidth(strip_tags($video[1][4]), 0, 150, "...");}else{}  ?></p>
                                                </div>
                                            </div>
                                            <div class="inner-row-sections">
                                                <div class="row-image">
                                                    <img src="<?php if($video[2][6]==''){echo 'https://img.youtube.com/vi/'.get_video_id($video[2][5]).'/mqdefault.jpg';}else{echo 'assets/images/pexels-photo-221185.jpeg';} ?>">
                                                    <div class="video-icon">
                                                    <a href="#" data-toggle="modal" data-target="#videoModal3" data-theVideo="<?php if($video[2][6]==''){echo $video[2][5];}else{echo $video[2][6];} ?>">
                                                            <span class="icon-play">
                                                                ▶&nbsp;<?php if(isset($video[2][7])){video_duration($video[2][7]);}else{} ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h1 class="row-text-head"><?php if(isset($video[2][1])){echo $video[2][1];}else{} ?></h1>
                                                    <h1 class="row-text-date"><?php if(isset($video[2][2])){echo date(' M d Y',strtotime($video[2][2]));}else{} ?></h1>
                                                    <p class="row-text-para"><?php if(isset($video[2][4])){echo mb_strimwidth(strip_tags($video[2][4]), 0, 150, "...");}else{}?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="inner-row-sections">
                                                <div class="row-image">
                                                    <img src="<?php if($video[3][6]==''){echo 'https://img.youtube.com/vi/'.get_video_id($video[3][5]).'/mqdefault.jpg';}else{echo '../../assets/images/internet_things_iot-100745968-large.jpg';} ?>">
                                                    <div class="video-icon">
                                                    <a href="#" data-toggle="modal" data-target="#videoModal4" data-theVideo="<?php if($video[3][6]==''){echo $video[3][5];}else{echo $video[3][6];} ?>">
                                                            <span class="icon-play">
                                                                ▶&nbsp;<?php if(isset($video[3][7])){video_duration($video[3][7]);}else{} ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h1 class="row-text-head"><?php if(isset($video[3][1])){echo $video[3][1];}else{} ?></h1>
                                                    <h1 class="row-text-date"><?php if(isset($video[3][2])){echo date(' M d Y',strtotime($video[3][2]));}else{} ?></h1>
                                                    <p class="row-text-para"><?php if(isset($video[3][4])){echo mb_strimwidth(strip_tags($video[3][4]), 0, 150, "...");}else{}?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="inner-row-sections">
                                                <div class="row-image">
                                                <img src="<?php if($video[4][6]==''){echo 'https://img.youtube.com/vi/'.get_video_id($video[4][5]).'/mqdefault.jpg';}else{echo '../../assets/images/internet_things_iot-100745968-large.jpg';} ?>">
                                                    <div class="video-icon">
                                                    <a href="#" data-toggle="modal" data-target="#videoModal5" data-theVideo="<?php if($video[4][6]==''){echo $video[4][5];}else{echo $video[4][6];} ?>">
                                                            <span class="icon-play">
                                                                ▶&nbsp;<?php if(isset($video[4][7])){video_duration($video[4][7]);}else{} ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div>                                                    
                                                    <h1 class="row-text-head"><?php if(isset($video[4][1])){echo $video[4][1];}else{} ?></h1>
                                                    <h1 class="row-text-date"><?php if(isset($video[4][2])){echo date(' M d Y',strtotime($video[4][2]));}else{} ?></h1>
                                                    <p class="row-text-para"><?php if(isset($video[4][4])){echo mb_strimwidth(strip_tags($video[4][4]), 0, 150, "...");}else{}?>
                                                    </p>
                                                </div>
                                            </div>
                                        </ul>
                                        <div class="verticalCarouselHeader">
                                            <button type="button" role="presentation" class="vc_goDown"><span
                                                    aria-label="Previous"><i class="fas fa-angle-down"></i></span></button><button
                                                type="button" role="presentation" class="vc_goUp"><span aria-label="Next"><i
                                                        class="fas fa-angle-up"></i></span>
                                            </button>
                                        </div>
                                    </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 top-bottom-gap">
                            <div class="td-block-title-wrap">
                                <h4 class="block-title td-block-title" style="border-bottom: 2px solid #000"><span
                                        class="td-pulldown-size" style="margin-right: 0px;background-color: #000;">FEATURED
                                        ARTICLE</span>
                                </h4>
                            </div>
                            <div class="main-article-div">
                                <a href="<?php if(isset($feat_link)){echo $feat_link;}else{}?>">
                                    <img src="../../../assets/article/<?php if(isset($feat_icon)){echo $feat_icon;}else{}?>" alt="">
                                </a>
                            </div>
                            <div style="background-color: #2abfd4;color: #fff;height: 350px; padding: 10px;border-radius: 2px;">
                                <h1 class="row-text-head"><?php if(isset($feat_name)){echo $feat_name;}else{}?></h1>
                                    <p class="row-text-para" style="color:#fff;word-break:break-all;"><?php if(isset($feat_desc)){echo mb_strimwidth(strip_tags($feat_desc), 0, 260, "...");}else{}  ?></p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xperience-section left-right-gap">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                            <div class="td-block-title-wrap">
                                <h4 class="block-title td-block-title" style="border-bottom:  2px solid #ffc000 "><span
                                        class="td-pulldown-size" style="margin-right: 0px;background-color:#ffc000;">XPERIENCE</span></h4>
                            </div>
                            <p class="row-para"> Online live courses, workshops, webinars and projects run by
                                experts
                                to
                                give
                                students a headstart in learning a topic</p>
                            <div class="row-new-grid">
                                <div class="inner-one-xper">
                                    <div class="__one">
                                        <div class="video-row" style="<?php if($learning_video[0][4]==''){echo 'background-image: url(https://img.youtube.com/vi/'.get_video_id($learning_video[0][3]).'/mqdefault.jpg);background-size: contain;';}else{echo 'background-image: url(../../assets/images/internet_things_iot-100745968-large.jpg);background-size: contain;';} ?>">
                                        
                                            <div class="play-row">
                                            <a href="#" data-toggle="modal" data-target="#learningVideoModal1" data-theVideo="<?php if($learning_video[0][4]==''){echo $learning_video[0][3];}else{echo $learning_video[0][4];} ?>">               
                                                <i class="fas fa-play play-new"></i>
                                            </a>
                                            </div>
                                            <div class="date-row">
                                                <span class="date-wrap">
                                                <?php if(isset($learning_video[0][5])){video_duration($learning_video[0][5]);}else{} ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="row-text-para_2"><?php if(isset($learning_video[0][2])){echo mb_strimwidth(strip_tags($learning_video[0][2]), 0, 140, "...");}else{}?></p>
                                </div>
                                <div class="inner-one-xper">
                                    <div class="__one">
                                    <div class="video-row" style="<?php if($learning_video[1][4]==''){echo 'background-image: url(https://img.youtube.com/vi/'.get_video_id($learning_video[1][3]).'/mqdefault.jpg);background-size: contain;';}else{echo 'background-image: url(../../assets/images/internet_things_iot-100745968-large.jpg);background-size: contain;';} ?>">
                                        
                                        <div class="play-row">
                                        <a href="#" data-toggle="modal" data-target="#learningVideoModal2" data-theVideo="<?php if($learning_video[1][4]==''){echo $learning_video[1][3];}else{echo $learning_video[1][4];} ?>">               
                                            <i class="fas fa-play play-new"></i>
                                        </a>
                                        </div>
                                        <div class="date-row">
                                            <span class="date-wrap">
                                            <?php if(isset($learning_video[1][5])){video_duration($learning_video[1][5]);}else{} ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <p class="row-text-para_2"><?php if(isset($learning_video[1][2])){echo mb_strimwidth(strip_tags($learning_video[1][2]), 0, 140, "...");}else{}?></p>
                            </div>
                            </div>
                            <div class="webinar-details-row">
                                <div class="inner-details">
                                    <h1 class="inner-details-head">Webinar</h1>
                                    <h1 class="inner-details-sub-head"><?php if(isset($web_title)){echo $web_title;}else{}?></h1>
                                </div>
                                <div class="inner-webinar-info">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="webinar-speaker">
                                                <div class="speaker-image">
                                                    <img src="../../../assets/webinar/<?php if(isset($web_speaker_img)){echo $web_speaker_img;}else{}?>" alt="">
                                                </div>
                                                <div class="speaker-desc">
                                                    <h1><?php if(isset($web_speaker)){echo $web_speaker;}else{}?></h1>
                                                    <span><?php if(isset($web_speaker_desc)){echo mb_strimwidth(strip_tags($web_speaker_desc), 0, 100, "...");}else{}?></span>
                                                </div>
                                                <div class="webinar-desc">
                                                    <p><?php if(isset($web_description)){echo mb_strimwidth(strip_tags($web_description), 0, 150, "...");}else{}?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="webinar-date">
                                                <h1 class="webinar-one"><?php if(isset($web_date)){echo date('M',strtotime($web_date));}else{} ?></h1>
                                                <h1 class="webinar-two"><?php if(isset($web_date)){echo date('d',strtotime($web_date));}else{} ?></h1>
                                                <h1 class="webinar-three"><?php if(isset($web_start_time)){echo date('h A',strtotime($web_start_time));}else{} ?>
                                                     - <?php if(isset($web_end_time)){echo date('h A',strtotime($web_end_time));}else{} ?></h1>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="webinar-attend">
                                                <h1 class="webinar-attend-one">Who Should Attend</h1>
                                                <p class="webinar-attend-two"><?php if(isset($web_learning)){echo mb_strimwidth(strip_tags($web_learning), 0, 200, "...");}else{}?></p>
                                                <button class="webinar-attend-btn"> <a href="<?php if(isset($web_link)){echo $web_link;}else{}?>">I am interested</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 top-bottom-gap">
                            <div class="td-block-title-wrap">
                                <h4 class="block-title td-block-title" style="border-bottom: 2px solid #000"><span
                                        class="td-pulldown-size" style="margin-right: 0px;background-color: #000;">MESSAGE</span>
                                </h4>
                            </div>
                            <div style="background-color: #ffc000;padding: 10px;height: 695px">
                            <h1 class="row-second-head">From The Coordinator's Desk</h1>
                            <p class="row-second-para"><?php if(isset($detail)){echo $detail;}else{}?></p>
                            <div class="next-wrap">
                                <h1 class="next-head">Next Theme:</h1>
                                <p class="next-topic"><?php if(isset($themes[1])){echo $themes[1];}else{}?></p>
                            </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="xpress-section left-right-gap">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                            <div class="td-block-title-wrap">
                                <h4 class="block-title td-block-title" style="border-bottom: 2px solid #0a6bb4"><span
                                        class="td-pulldown-size" style="margin-right: 0px;background-color: #0a6bb4">XPRESS</span></h4>
                            </div>
                            <p class="row-para"> Inter-school platform to showcase student creations allowing
                                them
                                to
                                learn
                                with their peers
                            </p>
                            <div class="webinar-details-row" >
                                <div class="inner-details">
                                    <h1 class="inner-details-head">Activity</h1>
                                    <h1 class="inner-details-sub-head"><?php if(isset($sample_work[0][1])){echo $sample_work[0][1];}else{}?></h1>
                                </div>
                                <div class="row-new-grid_2">
                                    <div class="inner-one-xpress">
                                        <div class="__one_2" style="background-color: #000;">
                                            <div class="video-row_2" style="<?php if(isset($sample_work[0][4]) && $sample_work[0][7]=='link')
                                            {echo 'background-image: url(https://img.youtube.com/vi/'.get_video_id($sample_work[0][4]).'/mqdefault.jpg);
                                            background-size: cover;background-repeat:no-repeat;';}else if (isset($sample_work[0][6]) && $sample_work[0][7]=='image')
                                            {echo 'background-image: url(../../../assets/sample_work/'.$sample_work[0][6].');background-size: cover;background-repeat:no-repeat;';} ?>">
                                                <div class="play-row">
                                                <a href="#" data-toggle="modal" data-target="#sampleworkmodal1" data-theVideo="<?php if(isset($sample_work[0][4]) && $sample_work[0][7]=='link'){echo $sample_work[0][4];}else{} ?>">               
                                                <i class="fas fa-play play-new"></i>
                                                </a>
                                                </div>
                                                <div class="date-row">
                                                    <span class="date-wrap" style="background: #777;">
                                                    <?php if(isset($sample_work[0][8])){video_duration($sample_work[0][8]);}else{} ?>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-new-inner" style="background-color: #fff;height:150px;margin-top: 20px;">
                                        <div class="row-new-inner-desc">
                                            <p><?php if(isset($sample_work[0][3])){echo mb_strimwidth(strip_tags($sample_work[0][3]), 0, 140, "...");}else{}?></p>
                                            
                                            <button class="upload-button" data-toggle="modal" data-target="#sampleworkupload1">UPLOAD</button>
                                            
                                        <h1 class="last-text">Last Day Of Upload: <?php if(isset($sample_work[0][9])){echo date(' M d Y',strtotime($sample_work[0][9]));}else{} ?></h1>
                                            </div>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="webinar-details-row" style="height:auto">
                                <div class="inner-details">
                                    <h1 class="inner-details-head">Activity</h1>
                                    <h1 class="inner-details-sub-head"><?php if(isset($sample_work[1][1])){echo $sample_work[1][1];}else{}?></h1>
                                        </div>
                                <div class="row-new-grid_2">
                                    <div class="inner-one-xpress">
                                        <div class="__one_2" style="background-color: #000;">
                                            <div class="video-row_2" style="<?php if(isset($sample_work[1][4]) && $sample_work[1][7]=='link')
                                            {echo 'background-image: url(https://img.youtube.com/vi/'.get_video_id($sample_work[1][4]).'/mqdefault.jpg);
                                            background-size: cover;background-repeat:no-repeat;';}else if (isset($sample_work[1][6]) && $sample_work[1][7]=='image')
                                            {echo 'background-image: url(../../../assets/sample_work/'.$sample_work[1][6].');background-size: cover;background-repeat:no-repeat;';} ?>">
                                                <div class="play-row">
                                                <a href="#" data-toggle="modal" data-target="#sampleworkmodal2" data-theVideo="<?php if(isset($sample_work[1][4]) && $sample_work[1][7]=='link'){echo $sample_work[1][4];}else{} ?>">               
                                                <i class="fas fa-play play-new"></i>
                                                </a>
                                                </div>
                                                <div class="date-row">
                                                    <span class="date-wrap" style="background: #777;">
                                                    <?php if(isset($sample_work[1][8])){video_duration($sample_work[1][8]);}else{} ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-new-inner" style="background-color: #fff;height: 150px;margin-top: 20px;">
                                        <div class="row-new-inner-desc">
                                        <p><?php if(isset($sample_work[1][3])){echo mb_strimwidth(strip_tags($sample_work[1][3]), 0, 140, "...");}else{}?></p>
                                        
                                            <button class="upload-button" data-toggle="modal" data-target="#sampleworkupload2">UPLOAD</button>
                                            
                                        <h1 class="last-text">Last Day Of Upload : <?php if(isset($sample_work[1][9])){echo date(' M d Y',strtotime($sample_work[1][9]));}else{} ?></h1>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 top-bottom-gap">
                            <div class="td-block-title-wrap">
                                <h4 class="block-title td-block-title" style="border-bottom: 2px solid #000"><span
                                        class="td-pulldown-size" style="margin-right: 0px;background-color: #000;">PIN
                                        BOARD</span>
                                </h4>
                            </div>
                            <div style="background-color: #0a6bb4;padding: 10px;height: 570px;">
                            <h1 class="row-second-head_2">Wall Of Fame</h1>
                            <div class="pin-image">
                                <img src="assets/images/Internet-of-Things-examples.gif" alt="">
                            </div>
                            <h1 class="pin-text-head">Graphic Design Project
                                3D Bottle –
                                using Illustrator.
                                by Raghvendra Grade 8 C
                            </h1>
                        </div>
                            
                        </div>
                    </div>
                </div>
                <div class="quiz-section left-right-gap">
                    <h1 class="row-head-4">Test Your Knowledge</h1>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <?php if(isset($quiz_link[0][0])){echo $quiz_link[0][0];}else{}?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <?php if(isset($quiz_link[1][0])){echo $quiz_link[1][0];}else{}?>
                        </div>
                    </div>
                </div>
                
                <br><br>
            </div>
        </div>
        
            <div class="footer" style="background-color:#000">
                <div class="page-lay-new">
                    <div class="left-footer">
                        &copy; Copyright – iCLUBS 2018
                    </div>
                    <div class="right-footer">
                        <ul class="footer-inner">
                            <li>About</li>
                            <li>Contact</li>
                            <li>Domain</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--VIDEO MODALS-->
        <!--MODAL1-->
    <div class="modal fade" id="videoModal1" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($video[0][1])){echo $video[0][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000" id="yt-player">
                    <div>
                    <?php if($video[0][6]==''){echo '<iframe width="100%" height="650px" src="';}?><?php  if($video[0][6]==''){ } if($video[0][6]==''){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if($video[0][5]==''){echo '<video id="video1" class="local-video" controls>
                                <source src="../../../assets/video/';}?><?php  if($video[0][5]==''){echo $video[0][6];}?><?php  if($video[0][5]==''){echo '" type="video/mp4" autoplay>   
                            </video>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL2-->
    <div class="modal fade" id="videoModal2" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($video[1][1])){echo $video[1][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000">
                    <div>
                    <?php if($video[1][6]==''){echo '<iframe width="100%" height="650px" src="';}?><?php  if($video[1][6]==''){ } if($video[1][6]==''){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if($video[1][5]==''){echo '<video id="video1" class="local-video" controls>
                                <source src="../../../assets/video/';}?><?php  if($video[1][5]==''){echo $video[1][6];}?><?php  if($video[1][5]==''){echo '" type="video/mp4" autoplay>   
                            </video>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL3-->
    <div class="modal fade" id="videoModal3" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($video[2][1])){echo $video[2][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000">
                    <div>
                    <?php if($video[2][6]==''){echo '<iframe width="100%" height="650px" src="';}?><?php  if($video[2][6]==''){ } if($video[2][6]==''){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if($video[2][5]==''){echo '<video id="video1" class="local-video" controls>
                                <source src="../../../assets/video/';}?><?php  if($video[2][5]==''){echo $video[2][6];}?><?php  if($video[2][5]==''){echo '" type="video/mp4" autoplay>   
                            </video>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL4-->
    <div class="modal fade" id="videoModal4" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($video[3][1])){echo $video[3][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000">
                    <div>
                    <?php if($video[3][6]==''){echo '<iframe width="100%" height="650px" src="';}?><?php  if($video[3][6]==''){ } if($video[3][6]==''){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if($video[3][5]==''){echo '<video id="video1" class="local-video" controls>
                                <source src="../../../assets/video/';}?><?php  if($video[3][5]==''){echo $video[3][6];}?><?php  if($video[3][5]==''){echo '" type="video/mp4" autoplay>   
                            </video>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL5-->
    <div class="modal fade" id="videoModal5" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($video[4][1])){echo $video[4][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000">
                    <div>
                    <?php if($video[4][6]==''){echo '<iframe width="100%" height="650px" src="';}?><?php  if($video[4][6]==''){ } if($video[4][6]==''){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if($video[4][5]==''){echo '<video id="video1" class="local-video" controls>
                                <source src="../../../assets/video/';}?><?php  if($video[4][5]==''){echo $video[4][6];}?><?php  if($video[4][5]==''){echo '" type="video/mp4" autoplay>   
                            </video>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF VIDEO MODALS-->
<!--LEARNING VIDEO MODALS-->
        <!--MODAL1-->
        <div class="modal fade" id="learningVideoModal1" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($learning_video[0][1])){echo $learning_video[0][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000" id="yt-player">
                    <div>
                    <?php if($learning_video[0][4]==''){echo '<iframe width="100%" height="650px" src="';}?><?php  if($learning_video[0][4]==''){ } if($learning_video[0][4]==''){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if($learning_video[0][3]==''){echo '<video id="video1" class="local-video" controls>
                                <source src="../../../assets/video/';}?><?php  if($learning_video[0][3]==''){echo $learning_video[0][4];}?><?php  if($learning_video[0][3]==''){echo '" type="video/mp4" autoplay>   
                            </video>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL2-->
    <div class="modal fade" id="learningVideoModal2" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($learning_video[1][1])){echo $learning_video[1][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000">
                    <div>
                    <?php if($learning_video[1][4]==''){echo '<iframe width="100%" height="650px" src="';}?><?php  if($learning_video[1][4]==''){ } if($learning_video[1][4]==''){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if($video[1][3]==''){echo '<video id="video1" class="local-video" controls>
                                <source src="../../../assets/video/';}?><?php  if($learning_video[1][3]==''){echo $learning_video[1][4];}?><?php  if($learning_video[1][3]==''){echo '" type="video/mp4" autoplay>   
                            </video>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF LEARNING VIDEO MODALS-->
    <!--SAMPLE WORK MODALS-->
        <!--MODAL1-->
        <div class="modal fade" id="sampleworkmodal1" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($sample_work[0][1])){echo $sample_work[0][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000" id="yt-player">
                    <div>
                    <?php if(isset($sample_work[0][4]) && $sample_work[0][7]=='link'){echo '<iframe width="100%" height="650px" src="';}?><?php if(isset($sample_work[0][4]) && $sample_work[0][7]=='link'){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if(isset($sample_work[0][5]) && $sample_work[0][7]=='video'){echo '<video id="video1" class="local-video" controls>
                                <source src="../../../assets/video/';}?><?php  if(isset($sample_work[0][5]) && $sample_work[0][7]=='video'){echo $sample_work[0][5];}?><?php  if(isset($sample_work[0][5]) && $sample_work[0][7]=='video'){echo '" type="video/mp4" autoplay>   
                            </video>';}
                            if(isset($sample_work[0][6]) && $sample_work[0][7]=='image'){echo '<img src="../../../assets/sample_work/'.$sample_work[0][6].'">';}
                            if(isset($sample_work[0][10]) && $sample_work[0][7]=='pdf'){echo '<div id="ebookfile1"></div>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL2-->
    <div class="modal fade" id="sampleworkmodal2" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($sample_work[1][1])){echo $sample_work[1][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000">
                    <div>
                    <?php if(isset($sample_work[1][4]) && $sample_work[1][7]=='link'){echo '<iframe width="100%" height="650px" src="';}?><?php if(isset($sample_work[1][4]) && $sample_work[1][7]=='link'){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if(isset($sample_work[1][5]) && $sample_work[1][7]=='video'){echo '<video id="video1" class="local-video" controls>
                                <source src="../../../assets/video/';}?><?php  if(isset($sample_work[1][5]) && $sample_work[1][7]=='video'){echo $sample_work[1][5];}?><?php  if(isset($sample_work[1][5]) && $sample_work[1][7]=='video'){echo '" type="video/mp4" autoplay>   
                            </video>';}
                            if(isset($sample_work[1][6]) && $sample_work[1][7]=='image'){echo '<img src="../../../assets/sample_work/'.$sample_work[1][6].'">';}
                            if(isset($sample_work[1][10]) && $sample_work[1][7]=='pdf'){echo '<div id="ebookfile2"></div>';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF SAMPLE WORK MODALS-->
    <!--SAMPLE WORK UPLOAD MODALS-->
        <!--MODAL1-->
        <div class="modal fade" id="sampleworkupload1" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($sample_work[0][1])){echo $sample_work[0][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000" id="yt-player">
                    <div><br>
                    <form action="" id="form1" enctype="multipart/form-data">
                        <input type="file" name="work"><br>
                        <input type="hidden" name="club_id" value="<?php if(isset($club_id)){echo $club_id;}else{}?>">
                        <input type="hidden" name="sid" value="<?php if(isset($user_id)){echo $user_id;}else{}?>">
                        <input type="hidden" name="inst_id" value="<?php if(isset($inst_id)){echo $inst_id;}else{}?>">
                        <input type="hidden" name="sample_work_id" value="<?php if(isset($sample_work[0][0])){echo $sample_work[0][0];}else{}?>">
                        <button class="upload-button" onclick="upload1()">UPLOAD</button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL2-->
    <div class="modal fade" id="sampleworkupload2" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel"><?php if(isset($sample_work[1][1])){echo $sample_work[1][1];}else{} ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0;background-color: #000">
                    <div><br>
                    <form action="" id="form2" enctype="multipart/form-data">
                    <input type="file" name="work"><br>
                    <input type="hidden" name="club_id" value="<?php if(isset($club_id)){echo $club_id;}else{}?>">
                        <input type="hidden" name="sid" value="<?php if(isset($user_id)){echo $user_id;}else{}?>">
                        <input type="hidden" name="inst_id" value="<?php if(isset($inst_id)){echo $inst_id;}else{}?>">
                        <input type="hidden" name="sample_work_id" value="<?php if(isset($sample_work[1][0])){echo $sample_work[1][0];}else{}?>">
                        <button class="upload-button" onclick="upload2()">UPLOAD</button><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END OF SAMPLE WORK UPLOAD MODALS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/v_carousel.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.0.201604172/pdfobject.min.js"></script>
        <script>PDFObject.embed("../../../assets/sample_work/<?php if(isset($sample_work[0][10])){echo $sample_work[0][10];}else{}?>", "#ebookfile1");
        PDFObject.embed("../../../assets/sample_work/<?php if(isset($sample_work[1][10])){echo $sample_work[1][10];}else{}?>", "#ebookfile2");</script>
    <script language="javascript">
    function upload1(){
                    event.preventDefault();            
                    var form = $('#form1')[0];           
                    var data = new FormData(form);                                    
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "s_work_submission_back.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {   
                            console.log(data);                          
                            if (data=='success')
                        {alert('Published Successfully !');                        
                        }                                                                       
                        },
                        error: function (e) {           
                            console.log(e);
                        }
                    });
                    }
    function upload2(){
                    event.preventDefault();            
                    var form = $('#form2')[0];           
                    var data = new FormData(form);                                    
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "s_work_submission_back.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {   
                            console.log(data);                          
                            if (data=='success')
                        {alert('Published Successfully !');                        
                        }                                                                       
                        },
                        error: function (e) {           
                            console.log(e);
                        }
                    });
                    }
                    
        </script>
    <script>

        jQuery('#videoModal').on('hidden.bs.modal', function (e) {
            $('#videoModal iframe').attr('src', '');
        });


    </script>

</body>

</html>