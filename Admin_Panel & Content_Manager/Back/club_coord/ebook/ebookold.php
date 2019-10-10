
<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $vid_up = "SELECT ebook.name, ebook.author, ebook.duration, 
    ebook.description, ebook.mrp_price,ebook.school_price,ebook.class_applicable_for,ebook.ebook_file,
    vendor.vendor_name,vendor.vendor_icon,activities.icon 
     from ebook INNER JOIN vendor ON    ebook.vendor_id 
     =   vendor.vendor_id  INNER JOIN activities ON
     activities.page_name LIKE 'ebook.php' where book_id= '$id'";
    $result = $conn->query($vid_up);

    while($row = $result->fetch_array())
    {
     $name =$row['name'];
     $author = $row['author'];
     $duration =$row['duration'];
     $description = $row['description'];
     $price =$row['mrp_price'];
     $school_price =$row['school_price'];
     $class = explode(",",$row['class_applicable_for']);
     $ven_icon = $row['vendor_icon'];
     $vendor = $row['vendor_name'];
     $act_icon = $row['icon'];
     $ebook_file =$row['ebook_file'];
     
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
   <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <!--ADDED BELOW-->
    <style>

    #ebookfile{
        width:700px;
        height:500px;
    }
    </style>
   <!--ADDED ABOVE--> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"        crossorigin="anonymous"> 
</head>
<body>
   <div class="navigationBar">
        <div class="logoBox">
            <h1 class="logoBox-header"><a href="index.php" style="color:#fff; text-decoration:none">SPACEDTIMES</a></h1>
        </div>
        <div class="menu-wrapper">
            <i class="fas fa-bars"></i>
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
                <h2>Ebook</h2>
            </div>
            <img src="../../assets/vendor/<?php if(isset($ven_icon)){echo $ven_icon;}else{}?>" style="height:100px;width:100px;">
        </div>
        <img src="../../assets/activity/<?php if(isset($act_icon)){echo $act_icon;}else{}?>" style="height:100px;width:100px; margin-top:-80px;">
        <div class="course-section">
            <div class="course__input">
            <h1 style="font-size:24px;color:#777;margin-top: 5px;"><?php if(isset($title)){echo $title;}else{}?>  </h1>
            </div>

        </div>
        <div class="text-section">
            <div class="inner_text">
            <h1>Duration :<?php
function minutes($duration){
$time = explode(':', $duration);
return ($time[0]*60) + ($time[1]);
}
echo ' '.minutes($duration).' ';
?>Mins</h1>
            </div>
            <div class="inner_text-sub">
                <h1>Author : <?php if(isset($author)){echo $author;}else{}?></h1>
            </div>
        </div>
        <div class="info-section">
            <h1 class="description-header">Book Description</h1>
            <p class="section-para"><?php if(isset($description)){echo $description;}else{}?></div>
        <div class="test-section">
            <h1 class="test-header"><?php if(isset($name)){echo $name;}else{}?></h1>
                <div id="ebookfile"></div>        
        </div>
        <div class="vendor_wrapper">
        <h5>Vendor: <?php if(isset($vendor)){echo $vendor;}else{}?></h5>
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
                    <input type="hidden" name="type" value="ebook">
                    <button class="p__btn" type="submit" onclick="deploy()">DEPLOY</button>
                </form>
        </div>
    </div>
 
  <div class="footer">
        <div class="footerInner">
            <h1>SPACEDTIMES</h1>
        </div>
    </div>

 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"  crossorigin="anonymous">
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
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

<script>
        CKEDITOR.replace('editor1');
    </script>
    <script>
        CKEDITOR.replace('editor2');
    </script>		
  <!--   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--ADDED BELOW-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.0.201604172/pdfobject.min.js"></script>
        <script>PDFObject.embed("../../assets/ebook/<?php if(isset($ebook_file)){echo $ebook_file;}else{}?>", "#ebookfile");</script>
 <!--ADDED ABOVE-->  
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