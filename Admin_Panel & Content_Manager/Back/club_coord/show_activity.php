<style>
    table{border-collapse: collapse;
        }
    td,th{
        border: 1px solid #ddd;
        padding: 8px;
        
    }
    tr:nth-child(even){background-color: #f2f2f2;}
    tr:hover {background-color: #ddd;}
    th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #ce1f36 !important;
    color: white;
    
}
</style>
<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$id=$_GET['id'];
if(isset($_SESSION['club_id'])){
    $club_id= $_SESSION["club_id"];
    $topic_id= $_SESSION["topic_id"];
    $flag=(preg_match('(school_club_)',$club_id)? 1:0);
}
else{
    echo 'No Club';
    die;
    }
switch ($id) {
    case 'article':
        $table= ($flag == 0 ? 'article':'school__article');
        $pending= 'select article_id as "ID",name as "Title",date_added as "Posted on" from '.$table.' where article_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and article_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select article_id as "ID",name as "Title",date_added as "Posted on" from '.$table.' where article_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select article_id as "ID",name as "Title",date_added as "Posted on" from '.$table.' where article_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
        break;
    case 'course':
        $table= ($flag == 0 ? 'live_course':'school__live_course');
        $pending= 'select course_id as "ID",description_line as "Title",date_added as "Posted on" from '.$table.' where course_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and course_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select course_id as "ID",description_line as "Title",date_added as "Posted on" from '.$table.' where course_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select course_id as "ID",description_line as "Title",date_added as "Posted on" from '.$table.' where course_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
        break;
    case 'ebook':
        $table= ($flag == 0 ? 'ebook':'school__ebook');
        $pending= 'select book_id as "ID",name as "Title",date_added as "Posted on" from '.$table.' where book_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and book_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select book_id as "ID",name as "Title",date_added as "Posted on" from '.$table.' where book_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select book_id as "ID",name as "Title",date_added as "Posted on" from '.$table.' where book_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
        break;
    case 'online_test':
        $table= ($flag == 0 ? 'online_test':'school__online_test');
        $pending= 'select test_id as "ID",test_name as "Title",date_added as "Posted on" from '.$table.' where test_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and test_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select test_id as "ID",test_name as "Title",date_added as "Posted on" from '.$table.' where test_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select test_id as "ID",test_name as "Title",date_added as "Posted on" from '.$table.' where test_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
        break;
    case 'video':
        $table= ($flag == 0 ? 'video':'school__video');
        $pending= 'select video_id as "ID",title as "Title",date_added as "Posted on" from '.$table.' where video_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and video_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select video_id as "ID",title as "Title",date_added as "Posted on" from '.$table.' where video_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select video_id as "ID",title as "Title",date_added as "Posted on" from '.$table.' where video_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
        break;
    case 'webinar':
        $table= ($flag == 0 ? 'webinar':'school__webinar');
        $pending= 'select webinar_id as "ID",title as "Title",date_added as "Posted on",date as "Scheduled On" from '.$table.' where webinar_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and webinar_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select webinar_id as "ID",title as "Title",date_added as "Posted on",date as "Scheduled On" from '.$table.' where webinar_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select webinar_id as "ID",title as "Title",date_added as "Posted on",date as "Scheduled On" from '.$table.' where webinar_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
        break;
    case 'workshop':
        $table= ($flag == 0 ? 'workshop':'school__workshop');
        $pending= 'select workshop_id as "ID",title as "Title",date_added as "Posted on",date as "Scheduled On" from '.$table.' where workshop_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and workshop_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select workshop_id as "ID",title as "Title",date_added as "Posted on",date as "Scheduled On" from '.$table.' where workshop_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select workshop_id as "ID",title as "Title",date_added as "Posted on",date as "Scheduled On" from '.$table.' where workshop_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
        break;
    case 'quiz':
        $table= ($flag == 0 ? 'quiz':'school__quiz');
        $pending= 'select quiz_id as "ID",quiz_title as "Title",date_added as "Posted on" from '.$table.' where quiz_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and quiz_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select quiz_id as "ID",quiz_title as "Title",date_added as "Posted on" from '.$table.' where quiz_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select quiz_id as "ID",quiz_title as "Title",date_added as "Posted on" from '.$table.' where quiz_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
         break;
    case 'learning_video':
         $table= ($flag == 0 ? 'learning_video':'school__learning_video');
        $pending= 'select video_id as "ID",title as "Title",date_added as "Posted on" from '.$table.' where video_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and video_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select video_id as "ID",title as "Title",date_added as "Posted on" from '.$table.' where video_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select video_id as "ID",title as "Title",date_added as "Posted on" from '.$table.' where video_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
          break;
    case 'sample_work':
         $table= ($flag == 0 ? 'sample_work':'school__sample_work');
        $pending= 'select sample_work_id as "ID",title as "Title",date_added as "Posted on",media_type as "Content" from '.$table.' where sample_work_id not in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and sample_work_id not in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $deployed='select sample_work_id as "ID",title as "Title",date_added as "Posted on",media_type as "Content" from '.$table.' where sample_work_id in (select activity_id from deployment_control where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id = "'.$_SESSION['topic_id'].'" and status="1"';
        $restricted='select sample_work_id as "ID",title as "Title",date_added as "Posted on",media_type as "Content" from '.$table.' where sample_work_id in (SELECT activity_id from activity_restrict where club_id="'.$_SESSION['club_id'].'"
        and institute_id="'.$_SESSION['inst_id'].'") and topic_id ="'.$_SESSION['topic_id'].'" and status="1"';
          break;
    default:
        echo 'error';
}
function create_table($conn,$action,$id){
    $result = $conn->query($action);

    if (mysqli_num_rows($result)>0){
        echo("<table><tbody>");
            while ($fieldinfo=mysqli_fetch_field($result)){
                    echo '<th>'.$fieldinfo->name.'</th>';
                }
        echo '<th>Action</th>';
            while ($row = mysqli_fetch_assoc($result)){    
                echo '<tr>';$flag=0;
                foreach($row as $key => $field) {
                    if($flag==0){
                        echo '<td>' . strip_tags($field) . '</td>';
                        $flag++;
                        $act_id=$field;
                    }
                    else{
                    echo '<td>' . strip_tags($field) . '</td>';
                    }  
                }
        echo '<td><a href="'.$id.'.php?id='.$act_id.'">View</td></tr></tbody>';
    }
    echo("</table>");
    }
    else{
    echo '<table><tbody><th>No Activities</th></tbody></table>';
    }
} 

?>
<link rel="stylesheet" href="main.css" />
<div class="row">
      <div class="container">
        <div class="tabset">
          <!-- Tab 1 -->
          <input type="radio" name="tabset" id="tab1" checked />
          <label for="tab1">Pending</label>
          <!-- Tab 2 -->
          <input type="radio" name="tabset" id="tab2" />
          <label for="tab2">Deployed</label>
          <!-- Tab 3 -->
          <input type="radio" name="tabset" id="tab3" />
          <label for="tab3">Restricted</label>

          <div class="tab-panels">
            <section id="" class="tab-panel"><h1><?php create_table($conn,$pending,$id);?></h1></section>
            <section id="" class="tab-panel"><h1><?php create_table($conn,$deployed,$id);?></h1></section>
            <section id="" class="tab-panel"><h1><?php create_table($conn,$restricted,$id);?></h1></section>
          </div>
        </div>
      </div>
    </div>