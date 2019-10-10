
<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $art_up = "SELECT webinar.title,webinar.speaker,webinar.description,webinar.duration,webinar.learning,webinar.date,
    webinar.time,vendor.vendor_name,webinar.class_applicable_for,webinar.mrp_price,webinar.school_price,webinar.start_time,webinar.end_time, vendor.vendor_icon,activities.icon
     from webinar INNER JOIN vendor ON 
    webinar.vendor_id =   vendor.vendor_id  INNER JOIN activities ON
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
     $time =$row['time'];
     $start =$row['start_time'];
     $end =$row['end_time'];
     $vendor_id = $row['vendor_name'];
     $price =$row['mrp_price'];
     $school_price =$row['school_price'];
     $class = explode(",",$row['class_applicable_for']);
     $ven_icon = $row['vendor_icon'];
     $act_icon = $row['icon'];
     
  
    }
}
else{

}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://www.testune.com/spacedtimes/club_coordinator/main.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
</head>

<body>

    <div class="navigationBar">
        <div class="logoBox">
            <h1 class="logoBox-header">SPACETIMES
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
    <div class="page">
    <div class="course-section">
            <div class="course__input">
                <h2>Webinar</h2>
            </div>
            <img src="../../assets/vendor/<?php if(isset($ven_icon)){echo $ven_icon;}else{}?>" style="height:100px;width:100px;">
        </div>
        <img src="../../assets/activity/<?php if(isset($act_icon)){echo $act_icon;}else{}?>" style="height:100px;width:100px; margin-top:-80px;">
        <div class="course-section">
            <div class="course__input">
            <h1 style="font-size:24px;color:#777;margin-top: 5px;"><?php if(isset($title)){echo $title;}else{}?>  </h1>
            </div>

        </div>
        <div class="description__section">
            <!--  <div class="first-section">
                <h4 style="color: #000">First Section
                </h4>
            </div> -->
            <div class="second-section">
                <p><?php if(isset($description)){echo $description;}else{}?></p>
            </div>
        </div>
        <div class="text-section">
            <div class="inner_text" style="margin:10px">
            <h1>Speaker : <?php if(isset($speaker)){echo $speaker;}else{}?></h1>
            </div>
            <div class="inner_text-sub">
            <h1>Duration :<?php
function minutes($duration){
$time = explode(':', $duration);
return ($time[0]*60) + ($time[1]);
}
echo ' '.minutes($duration).' ';
?>Mins</h1>
            </div>
        </div>
        <div class="text-section">            
            <div class="inner_text-sub">
            <div class="inner_text-sub">
            <?php if(isset($end)){echo date('g:i A',strtotime($end));}else{}?>
            </div>
            <?php if(isset($start)){echo date('g:i A',strtotime($start)).' TO&nbsp;';}else{}?>
            </div>            
        </div>
        <div class="select-section">
            <h5>What Will I Get?</h5>
            <div class="second-section">
            <p class="section-para"><?php if(isset($learning)){echo $learning;}else{}?></p>
            </div>
        </div>
        <div class="text-section">
            <div class="inner_text" style="margin:10px">
                <h1><?php if(isset($date)){echo $date;}else{}?></h1>
            </div>
            
        </div>
        <div class="vendor_wrapper">
        <h5>Vendor: <?php if(isset($vendor_id)){echo $vendor_id;}else{}?></h5>
        </div>
        <div class="vendor_wrapper">
        <h5> Applicable for : <?php if(!empty($class) && isset($class) ){foreach($class as $key => $val){echo ' Class '.$val;}} else{}?></h5>
        </div>
        <div class="price-wrapper">
        <h1 style="font-size:24px;color:#777;margin-top: 5px;">Price : Rs <?php if(isset($price)){echo $price;}else{}?></h1>
        </div>
        <div class="deploy-wrapper">
            <form id="fileUploadForm" action="../deployment_control/dep.php" method="POST">
                <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>">
                    <input type="hidden" name="type" value="webinar">
                    <button class="p__btn" type="submit" onclick="deploy()">DEPLOY</button>
                </form>
        </div>
    </div>
    <div class="footer ">
        <div class="footerInner ">
            <h1>TESTUNE TECHNOLOGY PVT LTD</h1>
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
        <script language="javascript">
    function deploy(){
        $.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: "../deployment_control/dep.php",
    data: {price:<?php if(isset($price)){echo $price;}else{}?>},
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (data) {        
        console.log(data);
        $("#sub").prop("disabled", false);
    },
    error: function (e) {
        $("#result").text(e.responseText);
        document.getElementById('msg').innerHTML = 'Rename File or upload smaller file!';
        $("#sub").prop("disabled", false);
    }
});
    }
    </script>    
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script>
        CKEDITOR.replace('editor2');
    </script>
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