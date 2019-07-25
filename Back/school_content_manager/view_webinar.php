<?php
//$uid=$_SESSION['uid'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $art_up = "SELECT title,speaker_desc,speaker_img,image,link,speaker,description,duration,learning,school__webinar.date,topic.topic_name,
    time,vendor.vendor_name,class_applicable_for,mrp_price,school_price,start_time,end_time, vendor.vendor_icon,activities.icon
     from school__webinar INNER JOIN vendor ON 
    school__webinar.vendor_id =   vendor.vendor_id  INNER JOIN topic ON 
    school__webinar.topic_id =   topic.topic_id INNER JOIN activities ON
     activities.page_name LIKE 'webinar.php' where webinar_id= '$id'";
    $result = $conn->query($art_up);
    while($row = $result->fetch_array())
    {
     $title =$row['title'];
     $speaker = $row['speaker'];
     $description =$row['description'];
     $duration = $row['duration'];
     $learning =$row['learning'];
     $date=$row['date'];
     $topic=$row['topic_name'];
     $time =$row['time'];
     $start =$row['start_time'];
     $end =$row['end_time'];
     $vendor_id = $row['vendor_name'];
     $price =$row['mrp_price'];
     $school_price =$row['school_price'];
     $class = explode(",",$row['class_applicable_for']);
     $ven_icon = $row['vendor_icon'];
     $act_icon = $row['icon'];
     $speaker_img = $row['speaker_img'];
     $speaker_desc = $row['speaker_desc'];
     $image = $row['image'];
     $link = $row['link'];
    }
}
else{
    echo "<script>alert('No Webinar Selected, Please go back and select a webinar to view it...')</script>";
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
            <div class="banner--text">Your Webinar Details :</div>
        </div>
    </div>
    <div class="page-container">
        <div class="div-gap">
            <div class="title-wrap">
                <h1 class="title-head">Webinar
                </h1>
                <img src="../assets/vendor/<?php if(isset($ven_icon)){echo $ven_icon;}else{}?>" alt="" class="img-main">
                <img src="../assets/activity/<?php if(isset($act_icon)){echo $act_icon;}else{}?>" alt="" class="img-main">
                    <h1 class="last-text">Topic : <?php if(isset($topic)){echo $topic;}else{}?></h1>
            </div>
        </div>
        <div class="div-gap">
            <div class="desc-wrap">
                <h1 class="desc-head"><?php if(isset($title)){echo $title;}else{}?></h1>
                <div style="overflow-x:auto;overflow-y: auto;max-height: 200px;">
                    <div class="desc-para"><?php if(isset($description)){echo $description;}else{}?></div>
                </div>
                <div class="desc-detail-wrap">
                    <h1 class="desc-text">Speaker : <?php if(isset($speaker)){echo $speaker;}else{}?></h1>                    
                    <h1 class="desc-text">Duration : <?php if(isset($duration)){
                    function minutes($duration){
                    $time = explode(':', $duration);
                    return ($time[0]*60) + ($time[1]);
                    }
                    echo ' '.minutes($duration).' ';}else{}?> Mins</h1>
                    <h1 class="desc-text">Time : <?php if(isset($start)){echo date('g:i A',strtotime($start));}else{}?> To <?php if(isset($end)){echo date('g:i A',strtotime($end));}else{}?></h1>
                    <h1 class="desc-text">Date : <?php if(isset($date)){echo $date;}else{}?></h1>
                    <h1 class="desc-text">Speaker Description : <?php if(isset($speaker_desc)){echo $speaker_desc;}else{}?></h1>
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
        <div class="div-gap">
        <h1 class="desc-head"><?php if(isset($link)){echo '<a href="'.$link.'">Link</a>';}else{}?></h1>
            <div class="last-wrap">
                <h1 class="last-text"><img src="../assets/webinar/<?php if(isset($image)){echo $image;}else{}?>" style="height:100px;width:100px;"><br>Thumbnail </h1>
                <h1 class="last-text"><img src="../assets/webinar/<?php if(isset($speaker_img)){echo $speaker_img;}else{}?>" style="height:100px;width:100px;"><br>Speaker </h1>
            </div>
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
           <input type="hidden" id="type" name="type" value="webinar">
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