<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $vid_up = "SELECT online_test.test_name, online_test.test_creator, online_test.duration, online_test.test_type, topic.topic_name,
    online_test.school_price,online_test.mrp_price,online_test.class_applicable_for,online_test.test_data,vendor.vendor_name,vendor.vendor_icon,activities.icon from online_test 
    INNER JOIN vendor ON 
    online_test.vendor_id =   vendor.vendor_id INNER JOIN topic ON 
    online_test.topic_id =   topic.topic_id  INNER JOIN activities ON
     activities.page_name LIKE 'online_test.php' where test_id= '$id'";
    $result = $conn->query($vid_up);

    while($row = $result->fetch_array())
    {
     $test_name =$row['test_name'];
     $topic =$row['topic_name'];
     $test_creator = $row['test_creator'];
     $duration =$row['duration'];
     $test_type = $row['test_type'];
     $price =$row['mrp_price'];
     $school_price =$row['school_price'];
     $vendor=$row['vendor_name'];
     $ven_icon = $row['vendor_icon'];
     $act_icon = $row['icon'];
     $test_data =$row['test_data'];
     $class = explode(",",$row['class_applicable_for']);    
    }
}
else{
    echo "<script>alert('No Test Selected, Please go back and select a Test to view it...')</script>";
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
    <link rel="stylesheet" href="main.css">
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
            <div class="banner--text">Online Test Details :</div>
        </div>
    </div>
    <div class="page-container">
        <div class="div-gap">
            <div class="title-wrap">
                <h1 class="title-head">Test
                </h1>
                <img src="../assets/vendor/<?php if(isset($ven_icon)){echo $ven_icon;}else{}?>" alt="" class="img-main">
                <img src="../assets/activity/<?php if(isset($act_icon)){echo $act_icon;}else{}?>" alt="" class="img-main">
            </div>
        </div>
        <div class="div-gap">
            <div class="desc-wrap">
                <h1 class="desc-head"><?php if(isset($test_name)){echo $test_name;}else{}?></h1>
                <div class="float-wrap">
                    <h1 class="desc-text" style="float:left;margin-left: 15px;">Test Creator : <?php if(isset($test_creator)){echo $test_creator;}else{}?></h1>
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
                <?php if(isset($test_data)){echo $test_data;}else{}?>
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
            <h1 class="test-header">Start Test</h1>
            <i class="fas fa-play secondary-icons"></i>
        </div>
        <div class="div-gap">
            <div class="last-wrap">
                <h1 class="last-text">Vendor :<?php if(isset($vendor)){echo $vendor;}else{}?></h1>
                    <h1 class="last-text">Topic :<?php if(isset($topic)){echo $topic;}else{}?></h1>
                <h1 class="last-text">Price : Rs <?php if(isset($price)){echo $price;}else{}?></h1>
            </div>
        </div>
    </div>
                <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>">
                <input type="hidden" name="type" value="online_test">
                <button class="p__btn" type="submit" onclick="deploy()">DEPLOY</button>
    </form>
    <div class="footer">
        <div class="footerInner">
            <h1>SPACEDTIMES</h1>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css " integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg "
        crossorigin="anonymous ">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
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
</body>

</html>