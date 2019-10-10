<?php
session_start();
include_once "header.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $art_up = 'SELECT name,topic.topic_name, description,link,featured, mrp_price,school_price,class_applicable_for, article.icon as a,vendor_name,link,
    vendor_icon,activities.icon from article  INNER JOIN vendor ON 
    article.vendor_id =   vendor.vendor_id INNER JOIN topic ON 
    article.topic_id =   topic.topic_id  INNER JOIN activities ON activities.page_name LIKE "article.php" where article_id= "'.$id.'"';
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
        $link = $row['link'];
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
            <div class="desc-wrap">
                <h1 class="desc-head"><?php if(isset($art_name)){echo $art_name;}else{}?>
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
            <p class="desc-head">Current  Article Image: </p> <br><img style="height:200px;" src="../assets/article/<?php if(isset($icon)){echo $icon;}else{}?>">         
        </div>
        
        <h1 class="desc-head">Article Url: <a href="<?php if(isset($link)){echo $link;}else{}?>" target="_blank">Link</a></h1>
        <h1 class="desc"><?php if(isset($feat) && $feat =='1'){echo 'Note: This is set as the Featured Article';}else{}?></h1>
            
        <div class="div-gap">
            <div class="last-wrap">
                <h1 class="last-text">Vendor : <?php if(isset($vendor_id)){echo $vendor_id;}else{}?></h1>
                    <h1 class="last-text">Topic : <?php if(isset($topic)){echo $topic;}else{}?></h1>
                <h1 class="last-text">Price : Rs <?php if(isset($price)){echo $price;}else{}?></h1>
            </div>
        </div>
    </div>
    
         
    <?php include("footer.php"); ?>   
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