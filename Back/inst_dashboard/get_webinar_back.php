<?php 
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
        if($_GET['topic'] and $_GET['club']){
            $topic_id=$_GET['topic'];
            $club_id=$_GET['club'];
            $flag=(preg_match('(school_club_)',$club_id)? 1:0);
        }
$up_webinar = ($flag == 0 ? 'SELECT title,speaker,speaker_desc,speaker_img,description,date,start_time,end_time,learning,link,webinar_id from webinar where topic_id = "'.$topic_id.'" and club_id="'.$club_id.'" and status = "1" order by date DESC LIMIT 1':
'SELECT title,speaker,speaker_desc,speaker_img,description,date,start_time,end_time,learning,link,webinar_id from school__webinar where topic_id = "'.$topic_id.'" and club_id="'.$club_id.'" and inst_id="'.$_SESSION['inst_id'].'" and status = "1" order by date DESC LIMIT 1');
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
          if(isset($web_title) and $web_title!==''){
              echo ('
          <div class="webinar-details-row">
                                <div class="inner-details">
                                    <h1 class="inner-details-head">Webinar</h1>
                                    <h1 class="inner-details-sub-head">'.$web_title.'</h1>
                                </div>
                                <div class="inner-webinar-info">
                                    <div class="row ">
                                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                                            <div class="webinar-speaker">
                                                <div class="speaker-image">
                                                    <img src="assets/images/'.$web_speaker_img.'" alt="">
                                                </div>
                                                <div class="speaker-desc">
                                                    <h1>'.$web_speaker.'</h1>
                                                    <span>'.mb_strimwidth(strip_tags($web_speaker_desc), 0, 100, "...").'</span>
                                                </div>
                                                <div class="webinar-desc">
                                                    <p>'.mb_strimwidth(strip_tags($web_description), 0, 150, "...").'</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                                            <div class="webinar-date">
                                                <h1 class="webinar-one">'.date('M',strtotime($web_date)).'</h1>
                                                <h1 class="webinar-two">'.date('d',strtotime($web_date)).'</h1>
                                                <h1 class="webinar-three">'.date('h A',strtotime($web_start_time)).' - '.date('h A',strtotime($web_end_time)).'</h1>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <div class="webinar-attend">
                                                <h1 class="webinar-attend-one">Who Should Attend</h1>
                                                <p class="webinar-attend-two">'.mb_strimwidth(strip_tags($web_learning), 0, 200, "...").'</p>
                                                <button class="webinar-attend-btn"> 
                                                    <a href="'.$web_link.'">
                                                    I Am Interested </a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div></div>');}
                                else{}
?>