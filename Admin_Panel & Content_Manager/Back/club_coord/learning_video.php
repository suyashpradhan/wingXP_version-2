<?php
include_once "header.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $flag=(preg_match('(school_club_)',$_SESSION['club_id'])? 1:0);
    $vid_up = ($flag == 0 ? 'SELECT title, description_line, duration, topic.topic_name,learning, class_applicable_for,mrp_price, school_price,
    video_file,link,vendor.vendor_name,vendor.vendor_icon,activities.icon from learning_video INNER JOIN vendor ON learning_video.vendor_id
     =   vendor.vendor_id  INNER JOIN topic ON learning_video.topic_id =   topic.topic_id  INNER JOIN activities ON activities.page_name LIKE 
     "learning_video.php" where video_id= "'.$id.'" and learning_video.status="1"':
     'SELECT title, description_line, duration, school__topic.topic_name,learning,class_applicable_for,mrp_price, school_price,
     video_file,vendor.vendor_name,vendor.vendor_icon,activities.icon from school__learning_video INNER JOIN vendor ON school__learning_video.vendor_id
      =   vendor.vendor_id  INNER JOIN school__topic ON school__learning_video.topic_id =   school__topic.topic_id  INNER JOIN activities ON 
      activities.page_name LIKE "learning_video.php" where video_id= "'.$id.'" and school__learning_video.inst_id="'.$_SESSION['inst_id'].'"');
    $result = $conn->query($vid_up);

    while($row = $result->fetch_array())
    {
     $title =$row['title'];
     $topic =$row['topic_name'];
     $description_line = $row['description_line'];
     $duration =$row['duration'];
     $learning = $row['learning'];
     $vendor_id =$row['vendor_name'];
     $price =$row['mrp_price'];
     $school_price =$row['school_price'];
     $video_file =$row['video_file'];
     $link =$row['link'];
     $ven_icon = $row['vendor_icon'];
     $act_icon = $row['icon'];
     $class = explode(",",$row['class_applicable_for']);
    }
}
else{
    echo "<script>alert('No Video Selected, Please go back and select a Video to view it...')</script>";
    die;
}
?>
 
    <div class="banner">
        <div class="page-container">
            <div class="banner--text">Video Details :</div>
        </div>
    </div>
    <div class="page-container">
        <div class="div-gap">
            <div class="title-wrap">
                <h1 class="title-head"><?php 
                                            $check='select reason from activity_restrict where activity_id="'.$id.'" and club_id = "'.$_SESSION['club_id'].'"
                                            and institute_id="'.$_SESSION['inst_id'].'" UNION select club_coordinator_id from deployment_control where activity_id="'.$id.'"
                                            and institute_id="'.$_SESSION['inst_id'].'" and club_id = "'.$_SESSION['club_id'].'"';
                                            $result1=$conn->query($check);
                                            if(mysqli_num_rows($result1)==0){
                                                echo $flag == 0 ? "Approved by iClubs Pending Deployment" : "Approved by School Pending Deployment" ;
                                            }
                                            else{
                                                $check='select club_coordinator_id from deployment_control where activity_id="'.$id.'"
                                                and institute_id="'.$_SESSION['inst_id'].'" and club_id = "'.$_SESSION['club_id'].'"';
                                                $result=$conn->query($check);
                                                if(mysqli_num_rows($result)==0){
                                                    $cc_name_q='select name from inst_club_coordinator where club_coordinator_id="'.$_SESSION['Userid'].'"';
                                                    $cc_name=$conn->query($cc_name_q);
                                                    $name=$cc_name->fetch_array();
                                                    $reason = $result1->fetch_array();
                                                    echo 'Restricted by : '.$name['name'].'<br>Reason: '.$reason['reason'];     
                                                }   
                                                
                                                else{
                                                    $name=$result->fetch_array();
                                                    $cc_name_q='select name from inst_club_coordinator where club_coordinator_id="'.$name['club_coordinator_id'].'"';
                                                    $cc_name=$conn->query($cc_name_q); 
                                                    $name=$cc_name->fetch_array();
                                                    echo 'Deployed by : '.$name['name'];                                               
                                                }
                                            }
                ?>
                </h1>
                <img src="../assets/vendor/<?php if(isset($ven_icon)){echo $ven_icon;}else{}?>" alt="" class="img-main">
                <img src="../assets/activity/<?php if(isset($act_icon)){echo $act_icon;}else{}?>" alt="" class="img-main">
            </div>
        </div>
        <div class="div-gap">
            <div class="desc-wrap">
                <h1 class="desc-head"><?php if(isset($title)){echo $title;}else{}?>
                </h1>
                <div style="overflow-x:auto;overflow-y: auto;max-height: 200px;">
                    <div class="desc-para"><?php if(isset($description_line)){echo $description_line;}else{}?></div>
                </div>
                <div class="float-wrap">
                    <h1 class="desc-text" style="float:right;margin-right: 15px;">Duration : <?php
function minutes($duration){
$time = explode(':', $duration);
return ($time[0]*60) + ($time[1]);
}
echo ' '.minutes($duration).' ';
?> Mins</h1>
                </div>

            </div>
        </div>
        <div class="div-gap">
            <div class="pre-wrap">
                <h1 class="desc-head">What Will I Get?</h1>
                <div class="pre-list" style="overflow-x:auto;overflow-y: auto;max-height: 200px;">
                <?php if(isset($learning)){echo $learning;}else{}?>
                </div>
            </div>
        </div>
    <form id="fileUploadForm" action="dep.php" method="POST">
        <div class="div-gap">
            <h1 class="desc-head">Webinar Is Applicable For Class</h1>
            <div class="class-wrap">
            <?php if(!empty($class) && isset($class) ){foreach($class as $key => $val){if($val!==''){echo '<div class="card-class-main effect">
                    <h1 class="class-head">Class '.$val.'</h1>
                    <input type="hidden" name="class'.$val.'" value="'.$val.'">
                </div>';}else{echo '<div class="card-class-main effect">
                    <h1 class="class-head">No Class</h1>
                </div>';}}} else{}?>
            </div>
        </div>
        <div class="test-section">
            <div class="card card-5">
            <?php if($link!=''){echo '<iframe  src="'.$link.'" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay"></iframe>';}
                            else if($link==''){echo '<video id="video1" class="local-video" controls>
                                <source src="../assets/video/'.$video_file.'" width="400" type="video/mp4" controls>   
                            </video>';}?>
                            </div>
        </div>
        <div class="div-gap">
            <div class="last-wrap">
                <h1 class="last-text">Vendor : <?php if(isset($vendor_id)){echo $vendor_id;}else{}?></h1>
                    <h1 class="last-text">Topic : <?php if(isset($topic)){echo $topic;}else{}?></h1>
                <h1 class="last-text">Price : Rs <?php if(isset($price)){echo $price;}else{}?></h1>
            </div>
        </div>
    </div>
                <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>">
                    <input type="hidden" name="type" value="learning_video">
                    <button class="p__btn" type="submit" onclick="deploy()">DEPLOY</button>
            <button class="p__btn" id="reject" type="submit" onclick="restrict();">RESTRICT</button>
            </form>
    <?php include("footer.php"); ?>
        <script>
            function restrict(){
                var reason = prompt('Please Enter a Reason', 'Not Age Suitable');
                if (reason != null) {                    
                $('<input>').attr({
                type: 'hidden',
                name: 'reason',
                value: reason
                }).appendTo('form');
                } else {
                    event.preventDefault();
                }
                
            }
            </script>
</body>
</html>