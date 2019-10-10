<?php
session_start();
$_SESSION['inst_id']="INST_258";
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $flag=(preg_match('(school_club_)',$_SESSION['club_id'])? 1:0);
    $art_up = ($flag == 0 ? 'SELECT name,topic.topic_name, description,link,featured, mrp_price,school_price,class_applicable_for, article.icon as a,vendor_name,link,
    vendor_icon,activities.icon from article  INNER JOIN vendor ON 
    article.vendor_id =   vendor.vendor_id INNER JOIN topic ON 
    article.topic_id =   topic.topic_id  INNER JOIN activities ON activities.page_name LIKE "article.php" where article_id= "'.$id.'" and article.status="1"': 
    'SELECT name,school__topic.topic_name, description,link,featured, mrp_price,school_price,class_applicable_for, school__article.icon as a,vendor_name,link,
    vendor_icon,activities.icon from school__article  INNER JOIN vendor ON 
    school__article.vendor_id =   vendor.vendor_id INNER JOIN school__topic ON 
    school__article.topic_id =   school__topic.topic_id  INNER JOIN activities ON activities.page_name LIKE "article.php" where article_id= "'.$id.'" 
    and school__article.inst_id="'.$_SESSION['inst_id'].'"');
    $result = $conn->query($art_up);
    while($row = $result->fetch_array())
    {
     $art_name =$row['name'];
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
            <div class="banner--text">Article Details :</div>
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
        <div class="div-gap">
            <h1 class="desc-head">Article Is Applicable For Class</h1>
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
    <form id="fileUploadForm" action="dep.php" method="POST">
          <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>">
           <input type="hidden" name="type" id="type" value="article"/>
            <button class="p__btn" type="submit" >DEPLOY</button>
            <button class="p__btn" id="reject" type="submit" onclick="restrict();">RESTRICT</button>
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