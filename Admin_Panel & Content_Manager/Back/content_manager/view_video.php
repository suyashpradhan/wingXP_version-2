<?php
include_once "header.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $vid_up = "SELECT video.title, video.description_line, video.duration, topic.topic_name,video.learning, video.vendor_id,video.class_applicable_for,video.mrp_price, video.school_price,
    video.video_file,video.link,vendor.vendor_name,vendor.vendor_icon,activities.icon from video
    INNER JOIN vendor ON 
    video.vendor_id =   vendor.vendor_id  INNER JOIN topic ON 
    video.topic_id =   topic.topic_id  INNER JOIN activities ON
     activities.page_name LIKE 'video.php' where video_id= '$id'";
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
     $link =$row['link'];
     $video_file =$row['video_file'];
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
                <h1 class="title-head">Video
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
    
        <!-- <div class="div-gap">
            <h1 class="desc-head">Webinar Is Applicable For Class</h1>
            <div class="class-wrap">
            <?php if(!empty($class) && isset($class) ){foreach($class as $key => $val){if($val!==''){echo '<div class="card-class-main effect">
                    <h1 class="class-head">Class '.$val.'</h1>
                    <input type="hidden" name="class'.$val.'" value="'.$val.'">
                </div>';}else{echo '<div class="card-class-main effect">
                    <h1 class="class-head">No Class</h1>
                </div>';}}} else{}?>
            </div>
        </div> -->
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
                
        
	<?php include("footer.php"); ?>	
</body>
</html>