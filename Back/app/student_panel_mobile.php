<?php 
error_reporting(0);
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$username=$_POST['user'];
$club_id=$_POST['club'];
$flag=(preg_match('(school_club_)',$club_id)? 1:0); 
$get_inst="select institute_id from inst_user where username='$username'";
$get_inst_res = $conn->query($get_inst);
$row = $get_inst_res->fetch_array();
$inst_id =$row['institute_id'];
$query12="select * from inst_user where username='$username'";
$student_d=$conn->query($query12);
$row12 = $student_d->fetch_array();

$clb_name_q = ($flag == 0 ? "select club_name,features from clubs where club_id= '$club_id'" :  "select club_name from school__clubs where club_id= '$club_id'");
$club_q='select clubs.club_id, clubs.club_name from clubs inner join inst_club_assign on
clubs.club_id = inst_club_assign.club_id where inst_club_assign.status=1
and clubs.status=1 and inst_club_assign.institute_id="'.$inst_id.'"  UNION
select school__clubs.club_id, school__clubs.club_name from school__clubs where 
school__clubs.status="1" and school__clubs.inst_id="'.$inst_id.'" group by club_name';
$club_result = $conn->query($club_q);
$i=0;
while($clb[$i] = mysqli_fetch_row($club_result))
{ 
    $data[] = [id=>$clb[0][0],name=>$clb[0][1]];
}
$tp_detail='select topic_name,topic_desc from topic where club_id="'.$club_id.'" 
and end_date > CURRENT_DATE() order by end_date asc limit 1';
$topic_result = $conn->query($tp_detail);
$row = mysqli_fetch_array($topic_result);
$data_topic=array(name=>$row['topic_name'],description=>$row['topic_desc']);
$articles= ($flag == 0 ? 'SELECT icon,name,link,featured from article where 
topic_id = (select topic_id from topic where club_id="'.$club_id.'" and 
status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) 
and club_id="'.$club_id.'" and status =1 order by date_added DESC ':
'SELECT icon,name,link,featured from school__article where topic_id = 
(select topic_id from school__topic where club_id="'.$club_id.'" and 
status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1)
 and club_id="'.$club_id.'" and status =1 order by date_added DESC');  
$videos= ($flag == 0 ? 'SELECT title, description_line,link,duration from video where topic_id = (select topic_id from topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id = "'.$club_id.'" and status =1 order by date_added DESC  ':
'SELECT title, description_line,link,duration from school__video where topic_id = (select topic_id from school__topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id = "'.$club_id.'" and status ="1" order by date_added DESC  ');
$q= ($flag == 0 ? 'SELECT quiz_title,link from quiz where topic_id = (select topic_id from topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id = "'.$club_id.'" and status =1 order by date_added DESC  ':
'SELECT quiz_title,link from school__quiz where topic_id = (select topic_id from school__topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id = "'.$club_id.'" and status ="1" order by date_added DESC  ');
$learning_videos= ($flag == 0 ? 'SELECT learning,link,duration from learning_video where topic_id = (select topic_id from topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id = "'.$club_id.'" and status ="1" order by date_added DESC  ' :
'SELECT learning,link,duration from school__learning_video where topic_id = (select topic_id from school__topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id = "'.$club_id.'" and status ="1" order by date_added DESC  ');
$up_webinar = ($flag == 0 ? 'SELECT title,speaker,speaker_desc,speaker_img,description,date,start_time,end_time,learning,link,webinar_id from webinar where topic_id = (select topic_id from topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id="'.$club_id.'" and status = "1" order by date DESC  ':
'SELECT title,speaker,speaker_desc,speaker_img,description,date,start_time,end_time,learning,link,webinar_id from school__webinar where topic_id = (select topic_id from school__topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id="'.$club_id.'" and status = "1" order by date DESC  ');
$get_club_q=($flag == 0 ? "SELECT message from clubs where club_id = '$club_id'" :
  "SELECT message from school__clubs where club_id = '$club_id'");
$get_theme_q = ($flag == 0 ? "SELECT topic_name from topic where club_id = '$club_id' and status='1' and end_date > CURRENT_DATE() order by end_date asc limit 4" :
"SELECT topic_name from school__topic where club_id = '$club_id' and status='1' and end_date > CURRENT_DATE() order by end_date asc limit 4");
$s_work_q=  ($flag == 0 ? 'SELECT sample_work_id, title, description_line,link,image,media_type,duration,last_date,pdf from sample_work where topic_id = (select topic_id from topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id = "'.$club_id.'" and status ="1" order by date_added ASC ':
'SELECT sample_work_id, title, description_line,link,image,media_type,duration,last_date,pdf from school__sample_work where topic_id = (select topic_id from school__topic where club_id="'.$club_id.'" and status=1 and end_date > CURRENT_DATE() order by end_date ASC LIMIT 1) and club_id = "'.$club_id.'" and status ="1" order by date_added ASC ');
$theme = $conn->query($get_theme_q);
$result3 = $conn->query($articles);
$result4 = $conn->query($videos);
$l_vid_result = $conn->query($learning_videos);
$result6 = $conn->query($up_webinar);
$club = $conn->query($get_club_q); 
$clb_name = $conn->query($clb_name_q);
$up_webinar_result = $conn->query($up_webinar);
$s_work_result = $conn->query($s_work_q);
$quiz_result = $conn->query($q);
//STUDENT DETAIL
$user_detail[]=[
    inst_id=>$row12['institute_id'],
    user_id=>$row12['user_id'],
    name=>$row12['name']
];
//ARTICLES
while($clb[0] = mysqli_fetch_row($result3))
    { 
        $data1[] = [icon=>'https://wingxp.com/login/assets/article/'.$clb[0][0],name=>$clb[0][1],link=>$clb[0][2],featured=>$clb[0][3]];
    }
//VIDEOS
while($clb[0] = mysqli_fetch_row($result4))
{ 
    $link = explode("/embed/", $clb[0][2]);
    $data_vid[] = [video_title=>strip_tags($clb[0][0]),video_desc=>trim(preg_replace('/\s+/', ' ', strip_tags($clb[0][1]))),video_duration=>$clb[0][3],video_thumbnail=>'https://img.youtube.com/vi/'.$link[1].'/hqdefault.jpg',video_key=>$link[1]];
}
//QUIZ
while($clb[0] = mysqli_fetch_row($quiz_result))
{ 
    
    $data_quiz[] = [quiz_title=>$clb[0][0],quiz_link=>$clb[0][1]];
}
//LEARNING VIDEOS
while($l_vid[0] = mysqli_fetch_row($l_vid_result))
        { 
            $link = explode("/embed/", $l_vid[0][1]);
            $data_learn_vid[] = [video_desc=>trim(preg_replace('/\s+/', ' ', strip_tags($l_vid[0][0]))),video_duration=>$l_vid[0][2],video_thumbnail=>'https://img.youtube.com/vi/'.$link[1].'/hqdefault.jpg',video_key=>$link[1]];   
        }
//XPLORE XPERIENCE MESSAGES
$row = $clb_name->fetch_array();
$features = explode(",",$row['features']);
//WEBINAR
$row = $up_webinar_result->fetch_array();
            $webinar[]= [
                webinar_title=>$row['title'],
                webinar_author_name=>$row['speaker'],
                webinar_author_pos=>$row['speaker_desc'],
                speaker_image=>'https://www.wingxp.com/login/assets/webinar/'.$row['speaker_img'],
                webinar_date=>$row['date'],
                author_description=>trim(preg_replace('/\s+/', ' ', strip_tags($row['description']))),
                webinar_start_time=>$row['start_time'],
                webinar_end_time=>$row['end_time'],
                webinar_desc=>trim(preg_replace('/\s+/', ' ', strip_tags($row['learning']))),
                webinar_link=>$row['link']

            ];          
//COORDINATOR DESK MESSAGES          
$row = $club->fetch_array();
$coord_message = $row['message']; 
//UPCOMING THEMES
while($main = mysqli_fetch_row($theme))
  { 
    $upcoming[]=$main[0];
} 
array_shift($upcoming);
//SAMPLE WORK/Activity
while($row = mysqli_fetch_row($s_work_result))
        { 
            $link = explode("/embed/", $row[3]);
            if($row[5]=='link')
                {
                    $image='https://img.youtube.com/vi/'.$link[1].'/hqdefault.jpg';
                }
                else{
                    $image='https://www.wingxp.com/login/assets/sample_work/'.$row[4];
                }
                
            $activity[]=[
                activity_id=>$row[0],
                activity_image=>$image,
                activity_name=>$row[1],
                activity_desc=>trim(preg_replace('/\s+/', ' ', strip_tags($row[2]))),
                activity_last_date=>$row[7],
                activity_duration=>$row[6],
                activity_type=>$row[5],
                video_link=>$link[1],
                pdf_link=>'https://www.wingxp.com/login/assets/sample_work/'.$row[8]

            ];
        }
//RETURN JSON 
$result.=json_encode(array(clubs=>$data,articles=>$data1,st_name=>$user_detail,theme=>$data_topic,videos=>$data_vid,learning_videos=>$data_learn_vid,xplore_message=>$features[0],xperience_message=>$features[1],xpress_message=>$features[2],webinar=>$webinar,coordinators_desk_message=>$coord_message,upcoming_themes=>$upcoming,activity=>$activity,quiz=>$data_quiz));
echo $result; 
       