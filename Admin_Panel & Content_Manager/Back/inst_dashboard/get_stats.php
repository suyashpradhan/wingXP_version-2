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
        else{
            return 0;
            die;
        }

        $table= ($flag == 0 ? 'article':'school__article');
        $total= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'" UNION ALL ';
        $pending= 'select count(*) from '.$table.' where article_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and article_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $deployed='select count(*) from '.$table.' where article_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $restricted='select count(*) from '.$table.' where article_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" UNION ALL ';


        $table= ($flag == 0 ? 'ebook':'school__ebook');
        $total.= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'" UNION ALL ';
        $pending.= 'select count(*) from '.$table.' where book_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and book_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $deployed.='select count(*) from '.$table.' where book_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $restricted.='select count(*) from '.$table.' where book_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" UNION ALL ';


        $table= ($flag == 0 ? 'video':'school__video');
        $total.= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'" UNION ALL ';
        $pending.= 'select count(*) from '.$table.' where video_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and video_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $deployed.='select count(*) from '.$table.' where video_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $restricted.='select count(*) from '.$table.' where video_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" UNION ALL ';

        $table= ($flag == 0 ? 'webinar':'school__webinar');
        $total.= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'" UNION ALL ';
        $pending.= 'select count(*) from '.$table.' where webinar_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and webinar_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $deployed.='select count(*) from '.$table.' where webinar_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $restricted.='select count(*) from '.$table.' where webinar_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" UNION ALL ';

        $table= ($flag == 0 ? 'workshop':'school__workshop');
        $total.= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'" UNION ALL ';
        $pending.= 'select count(*) from '.$table.' where workshop_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and workshop_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $deployed.='select count(*) from '.$table.' where workshop_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $restricted.='select count(*) from '.$table.' where workshop_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" UNION ALL ';

        $table= ($flag == 0 ? 'quiz':'school__quiz');
        $total.= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'" UNION ALL ';
        $pending.= 'select count(*) from '.$table.' where quiz_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and quiz_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $deployed.='select count(*) from '.$table.' where quiz_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $restricted.='select count(*) from '.$table.' where quiz_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" UNION ALL ';

         $table= ($flag == 0 ? 'learning_video':'school__learning_video');
         $total.= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'" UNION ALL ';
        $pending.= 'select count(*) from '.$table.' where video_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and video_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $deployed.='select count(*) from '.$table.' where video_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $restricted.='select count(*) from '.$table.' where video_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" UNION ALL ';

         $table= ($flag == 0 ? 'sample_work':'school__sample_work');
         $total.= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'" UNION ALL ';
        $pending.= 'select count(*) from '.$table.' where sample_work_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and sample_work_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $deployed.='select count(*) from '.$table.' where sample_work_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $restricted.='select count(*) from '.$table.' where sample_work_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" UNION ALL ';

        $table= ($flag == 0 ? 'online_test':'school__online_test');
        $total.= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'" UNION ALL ';
        $pending.= 'select count(*) from '.$table.' where test_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and test_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $deployed.='select count(*) from '.$table.' where test_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1" UNION ALL ';
        $restricted.='select count(*) from '.$table.' where test_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" UNION ALL ';

        $table= ($flag == 0 ? 'live_course':'school__live_course');
        $total.= 'select count(*) from '.$table.' where club_id="'.$club_id.'" and topic_id="'.$topic_id.'"  ';
        $pending.= 'select count(*) from '.$table.' where course_id not in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and course_id not in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1"  ';
        $deployed.='select count(*) from '.$table.' where course_id in (select activity_id from deployment_control where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id = "'.$topic_id.'" and status="1"  ';
        $restricted.='select count(*) from '.$table.' where course_id in (SELECT activity_id from activity_restrict where club_id="'.$club_id.'"
        and institute_id="'.$_SESSION['Userid'].'") and topic_id ="'.$topic_id.'" and status="1" ';

        $submitted='select count(*) from sample_work_submission where 
	    sample_work_id in (select sample_work_id from sample_work where topic_id = "'.$topic_id.'") and inst_id= "'.$_SESSION['Userid'].'"';
        $reviewed='select count(*) from sample_work_submission where 
	    sample_work_id in (select sample_work_id from sample_work where topic_id = "'.$topic_id.'") 
	    and submission_id in (select submission_id from submission_feedback where 1) and inst_id="'.$_SESSION['Userid'].'"';
        $pending_work='select count(*) from sample_work_submission where 
	    sample_work_id in (select sample_work_id from sample_work where topic_id = "'.$topic_id.'") 
	    and submission_id not in (select submission_id from submission_feedback where 1) and inst_id="'.$_SESSION['Userid'].'"';
        $rejected='select count(*) from sample_work_submission where 
	    sample_work_id in (select sample_work_id from sample_work where topic_id = "'.$topic_id.'") 
	    and submission_id in (select submission_id from submission_feedback where 1) and inst_id="'.$_SESSION['Userid'].'" and featured = "0"';
        $showcased='select count(*) from sample_work_submission where 
	    sample_work_id in (select sample_work_id from sample_work where topic_id = "'.$topic_id.'") 
        and submission_id in (select submission_id from submission_feedback where 1) and inst_id="'.$_SESSION['Userid'].'" and featured = "1"';

        $total_res = $conn->query($total);    
     if ($total_res){
         $i=0;
        while( $row = mysqli_fetch_row($total_res)){           
            $response[0][$i]=$row[0];
            $i++;
        }        
     }
     else{  
    }

    $total_res = $conn->query($pending);    
     if ($total_res){
         $i=0;
        while( $row = mysqli_fetch_row($total_res)){           
            $response[1][$i]=$row[0];
            $i++;
        }        
     }
     else{    
    }

    $total_res = $conn->query($deployed);    
     if ($total_res){
         $i=0;
        while( $row = mysqli_fetch_row($total_res)){           
            $response[2][$i]=$row[0];
            $i++;
        }        
     }
     else{   
    }

    $total_res = $conn->query($restricted);    
     if ($total_res){
         $i=0;
        while( $row = mysqli_fetch_row($total_res)){           
            $response[3][$i]=$row[0];
            $i++;
        }        
     }
     else{  
    }

        $res = $conn->query($submitted);
        $row = mysqli_fetch_row($res);
        $response[4][0]=$row[0];
        $res = $conn->query($reviewed);
        $row = mysqli_fetch_row($res);
        $response[4][1]=$row[0];
        $res = $conn->query($pending_work);
        $row = mysqli_fetch_row($res);
        $response[4][2]=$row[0]; 
        $res = $conn->query($rejected);
        $row = mysqli_fetch_row($res);
        $response[4][3]=$row[0]; 
        $res = $conn->query($showcased);
        $row = mysqli_fetch_row($res);
        $response[4][4]=$row[0]; 
    
    echo json_encode($response);

?>