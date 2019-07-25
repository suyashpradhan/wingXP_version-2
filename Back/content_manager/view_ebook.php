<?php
session_start();
include_once "header.php";
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
     $ebk_file =$row['name'];
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
    echo "<script>alert('No Ebook Selected, Please go back and select a Ebook to view it...')</script>";
    die;
}
$conn->close();
?>
    <div class="banner">
        <div class="page-container">
            <div class="banner--text">Download Details :</div>
        </div>
    </div>
    <div class="page-container">
        <div class="div-gap">
            <div class="title-wrap">
                <h1 class="title-head">Download
                </h1>
                <img src="../assets/vendor/<?php if(isset($ven_icon)){echo $ven_icon;}else{}?>" alt="" class="img-main">
                <img src="../assets/activity/<?php if(isset($act_icon)){echo $act_icon;}else{}?>" alt="" class="img-main">
            </div>
        </div>
        <div class="div-gap">
            <div class="desc-wrap">
                <h1 class="desc-head"><?php if(isset($title)){echo $title;}else{}?> </h1>
                <div style="overflow-x:auto;overflow-y: auto;max-height: 200px;">
                    <div class="desc-para"><?php if(isset($description)){echo $description;}else{}?>
                    </div>
                </div>
                <!-- <div class="float-wrap">
                    <h1 class="desc-text" style="float:left;margin-left: 15px;">Author : <?php if(isset($author)){echo $author;}else{}?></h1>
                    <h1 class="desc-text" style="float:right;margin-right: 15px;">Duration : <?php
function minutes($duration){
$time = explode(':', $duration);
return ($time[0]*60) + ($time[1]);
}
echo ' '.minutes($duration).' ';
?> Mins</h1>
                </div> -->

            </div>
        </div>
        <!--  <div class="div-gap">
            <div class="pre-wrap">
                <h1 class="desc-head">What Will I Get?</h1>
                <ul class="pre-list" style="overflow-x:auto;overflow-y: auto;max-height: 200px;">
                    <li>Naive Bayes is ____________ technique. </li>
                    <li>Regression</li>
                    <li>The cost function used in Naive Bayes is __________ .</li>
                    <li>Gradient Descent</li>
                    <li>Sum of Squared Errors</li>
                    <li>Classification</li>
                </ul>
            </div>
        </div> -->
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

        <div class="div-gap">
            <h1 class="desc-head"><?php if(isset($ebk_file)){echo $ebk_file;}else{}?></h1>
                <style>

#ebookfile{
    width:700px;
    height:500px;
}
</style>      
                <div id="ebookfile"></div>
        </div>
        <div class="div-gap">
            <div class="last-wrap">
                <h1 class="last-text">Vendor : <?php if(isset($vendor)){echo $vendor;}else{}?></h1>
                <h1 class="last-text">Price : Rs <?php if(isset($price)){echo $price;}else{}?></h1>
            </div>
        </div>
    </div>
    <?php include_once "footer.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.0.201604172/pdfobject.min.js"></script>
        <script>PDFObject.embed("../assets/ebook/<?php if(isset($ebook_file)){echo $ebook_file;}else{}?>", "#ebookfile");</script>
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
</body>

</html>