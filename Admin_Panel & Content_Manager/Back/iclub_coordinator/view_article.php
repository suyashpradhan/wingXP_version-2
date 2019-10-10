<?php
session_start();
include_once "header.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $art_up = "SELECT article.name,topic.topic_name, article.description, article.featured,  article.mrp_price,article.school_price,article.link,article.class_applicable_for, article.icon as a,vendor.vendor_name,article.link,
    vendor.vendor_icon,activities.icon from article  INNER JOIN vendor ON 
    article.vendor_id =   vendor.vendor_id INNER JOIN topic ON 
    article.topic_id =   topic.topic_id  INNER JOIN activities ON activities.page_name LIKE 'article.php' where article_id= '$id'";
    $result = $conn->query($art_up);
    while($row = $result->fetch_array())
    {
     $art_file =$row['name'];
     $description = $row['description'];
     $link =$row['link'];
     $price =$row['mrp_price'];
     $class = explode(",",$row['class_applicable_for']);
     $icon=$row['a'];
     $vendor_id = $row['vendor_name'];
     $ven_icon = $row['vendor_icon'];
     $act_icon = $row['icon'];    
     $topic = $row['topic_name'];   
     $feat = $row['featured'];  
    }
}
else{
    echo "<script>alert('No Article Selected, Please go back and select a Article to view it...')</script>";
    die;
}

?>
    <div class="banner">
        <div class="page-container">
            <div class="banner--text">Article Details :</div>
        </div>
    </div>
    <div class="page-container">
        <div class="div-gap">
            <div class="title-wrap">
                <h1 class="title-head">Article
                </h1>
                <img src="../assets/vendor/<?php if(isset($ven_icon)){echo $ven_icon;}else{}?>" alt="" class="img-main">
                <img src="../assets/activity/<?php if(isset($act_icon)){echo $act_icon;}else{}?>" alt="" class="img-main">
            </div>
        </div>
        <div class="div-gap">
            <div class="desc-wrap">
                <h1 class="desc-head"><?php if(isset($art_file)){echo $art_file;}else{}?>
                </h1>
                <div style="overflow-x:auto;overflow-y: auto;max-height: 200px;">
                    <div class="desc-para"><?php if(isset($description)){echo $description;}else{}?>

                    </div>
                </div>
                <div class="float-wrap">
                    <?php if(isset($author)){echo '<h1 class="desc-text" style="float:left;margin-left: 15px;">Author : '.$author.'</h1>';}else{}?>
                </div>

            </div>
        </div>
   
        <!-- <div class="div-gap">
            <h1 class="desc-head">Article Is Applicable For Class</h1>
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
            <div id="ebookfile"><p class="desc-head">Current  Article Image: </p> <br><img style="height:200px;" src="../assets/article/<?php if(isset($icon)){echo $icon;}else{}?>"></div>           
        </div>
        <div id="ebookfile">
        <h1 class="desc-head">Article Url: <a href="<?php if(isset($link)){echo $link;}else{}?>" target="_blank">Link</a></h1>
        <h1 class="desc"><?php if(isset($feat) && $feat =='1'){echo 'Note: This is set as the Featured Article';}else{}?></h1>
            </div>
        <div class="div-gap">
            <div class="last-wrap">
                <h1 class="last-text">Vendor : <?php if(isset($vendor_id)){echo $vendor_id;}else{}?></h1>
                    <h1 class="last-text">Topic : <?php if(isset($topic)){echo $topic;}else{}?></h1>
                <h1 class="last-text">Price : Rs <?php if(isset($price)){echo $price;}else{}?></h1>
            </div>
        </div>
    </div>
    <form method="post">
    <input type="hidden" name="id" id="id" value="<?php if(isset($id)){echo $id;}else{}?>">
           <input type="hidden" id="type" name="type" value="article">
            <button class="p__btn" type="submit" onclick="deploy()">APPROVE</button>
            <button class="p__btn"  type="submit" onclick="archive()">ARCHIVE</button>
    </form>
    <?php include("footer.php"); ?>   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css " integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg "
        crossorigin="anonymous ">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
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