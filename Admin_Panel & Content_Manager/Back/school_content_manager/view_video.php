<?php
session_start();
//$_SESSION['uid']="a@a.com";
//$uid=$_SESSION['uid'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $vid_up = "SELECT title,link, description_line, duration, learning, vendor.vendor_id,class_applicable_for,mrp_price, school_price,topic.topic_name,
    video_file,vendor.vendor_name,vendor.vendor_icon,activities.icon from school__video
    INNER JOIN vendor ON 
    school__video.vendor_id =   vendor.vendor_id INNER JOIN topic ON 
    school__video.topic_id =   topic.topic_id INNER JOIN activities ON
     activities.page_name LIKE 'video.php' where video_id= '$id'";
    $result = $conn->query($vid_up);

    while($row = $result->fetch_array())
    {
     $title =$row['title'];
     $description_line = $row['description_line'];
     $duration =$row['duration'];
     $learning = $row['learning'];
     $vendor_id =$row['vendor_name'];
     $price =$row['mrp_price'];
     $topic =$row['topic_name'];
     $school_price =$row['school_price'];
     $video_file =$row['video_file'];
     $ven_icon = $row['vendor_icon'];
     $act_icon = $row['icon'];
     $link = $row['link'];
     $class = explode(",",$row['class_applicable_for']);
    }
}
else{
    echo "<script>alert('No Video Selected, Please go back and select a Video to view it...')</script>";
    die;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/main.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>


<body>
    <div class="navigationBar">
        <div class="logoBox">
            <h1 class="logoBox-header">SPACEDTIMES
        </div>
        <div class="menu-wrapper">
            <i class="fas fa-bars" onclick="openNav()"></i>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="button-wrapper">
                <a href="#">Logout</a>
            </div>
        </div>
    </div>
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
                    <h1 class="last-text">Topic : <?php if(isset($topic)){echo $topic;}else{}?></h1>
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
                    <h1 class="desc-text" style="float:right;margin-right: 15px;">Duration : <?php if(isset($duration)){
function minutes($duration){
$time = explode(':', $duration);
return ($time[0]*60) + ($time[1]);
}
echo ' '.minutes($duration).' ';}else{}
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
            <?php if(isset($video_file) and $video_file==''){echo '<iframe  src="';}?><?php  if(isset($video_file) and $video_file==''){ echo $link;} 
            if(isset($video_file) and $video_file==''){echo '" frameborder="0"
                            encrypted-media allowfullscreen allow="autoplay" ;></iframe>';}?>
                            <?php if(isset($link) and $link==''){echo '<video id="video1" class="local-video" controls>
                                <source src="../assets/video/';}?><?php  if(isset($link) and $link==''){echo $video_file;}?><?php
                                  if(isset($link) and $link==''){echo '" width="400" type="video/mp4" controls>   
                            </video>';}?>            </div>
        </div>
        <div class="div-gap">
            <div class="last-wrap">
                <h1 class="last-text">Vendor : <?php if(isset($vendor_id)){echo $vendor_id;}else{}?></h1>
                <h1 class="last-text">Price : Rs <?php if(isset($price)){echo $price;}else{}?></h1>
            </div>
        </div>
    </div>
    <form method="post">
    <input type="hidden" name="id" id="id" value="<?php if(isset($id)){echo $id;}else{}?>">
           <input type="hidden" id="type" name="type" value="video">
            <button class="p__btn" type="submit" onclick="deploy()">APPROVE</button>
            <button class="p__btn"  type="submit" onclick="archive()">ARCHIVE</button>
    </form>  
           <div class="footer">
        <div class="footerInner">
            <h1>SPACEDTIMES</h1>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css " integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg "
        crossorigin="anonymous ">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    
<script language="javascript">
    function deploy(){
        event.preventDefault();
        var id= $('#id').val();
        var type= $('#type').val();
        $.ajax({
    type: "GET",
    enctype: 'multipart/form-data',
    url: "approve.php?id="+id+"&type="+type,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (data) { 
        alert(data);
    },
    error: function (e) {
        console.log(e);       
    }
});
    }

    function archive(){
        event.preventDefault();
        var id= $('#id').val();
        var type= $('#type').val();
        $.ajax({
    type: "GET",
    enctype: 'multipart/form-data',
    url: "approve.php?id="+id+"&type="+type+"&archive=1",
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (data) { 
        alert(data);
    },
    error: function (e) {
        console.log(e);       
    }
});
    }
    </script>   
</body>

</html>