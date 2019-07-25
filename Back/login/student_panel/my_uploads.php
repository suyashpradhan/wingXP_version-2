<?php
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['q']))
{ 
        if($_GET['q'] == "logout")
  	{
		$user->user_logout();
		header("location:../../index.php");
	}
}
if(isset($_GET['user']) and $_GET['user']=='guest'){
    $user_id='ST_279_1';//ST_279_1
    $_SESSION['Userid']=$user_id;
}
else
{
    $user_id=$_SESSION['Userid'];
    $uid = $_SESSION['Userid'];
    if(!isset($_SESSION['Userid']))
    {
        header("location:../../index.php");
    } 
}
$query12="select * from inst_user where user_id='$user_id'";
$student_d=$conn->query($query12);
$row12 = $student_d->fetch_array();
if(isset($_GET['id'])){    
    $temp_id= $_GET['id'];
    $flag=(preg_match('(school_club_)',$temp_id)? 1:0);
    $check_sub_q = ($flag == 0 ? "select club_id,features from clubs where club_id in
         (select club_id from inst_club_assign where institute_id in 
         (select institute_id from inst_user where user_id='$user_id') and club_id='$temp_id' and status='1') and status='1' limit 1":
          "select club_id from school__clubs where club_id='$temp_id' and inst_id in (select institute_id from inst_user where user_id='$user_id') and status='1' limit 1");
         $check_sub_q_res = $conn->query($check_sub_q);
         $exists = $check_sub_q_res->num_rows;         
         if($exists>0){
             $club_id=$temp_id;
         }        
         else{
             echo"<script>alert('You have not Subscribed/Activated this Club<br>');window.history.back();</script>";
             die;
         }
    }
    else{
        $def_club_q = "select club_id from clubs where club_id in
         (select club_id from inst_club_assign where institute_id in 
         (select institute_id from inst_user where user_id='$user_id') and status='1') and status='1' limit 1";
        $def_club_res = $conn->query($def_club_q);
        $row = $def_club_res->fetch_array();
        $club_id =$row['club_id'];        
    }
    $flag=(preg_match('(school_club_)',$club_id)? 1:0);    
    $get_inst="select institute_id from inst_user where user_id='$user_id'";
    $get_inst_res = $conn->query($get_inst);
    $row = $get_inst_res->fetch_array();
    $inst_id =$row['institute_id']; 

$clb_name_q = ($flag == 0 ? "select club_name,features from clubs where club_id= '$club_id'" :  "select club_name from school__clubs where club_id= '$club_id'");
$clb_name = $conn->query($clb_name_q);
while($row = $clb_name->fetch_array())
{
 $club_name =$row['club_name'];
 $features = explode(",",$row['features']);
}
$club_q= 'select clubs.club_id, clubs.club_name from clubs inner join inst_club_assign on 
clubs.club_id =inst_club_assign.club_id where inst_club_assign.status="1" and clubs.status="1" and inst_club_assign.institute_id="'.$inst_id.'" UNION ALL
select club_id, club_name from school__clubs where status="1" and inst_id="'.$inst_id.'"';
$club_result = $conn->query($club_q);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Dashboard- IClubs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <style>
        .owl-dots {
            display: none;
        }
    </style>
</head>

<body>
<div class="name-wrap ">
        <div class="name-row-new">
        <div class="logo-row">
                    <!-- <img src="assets/images/logo_1.png" alt="" height="30px" class="logo-img"> -->
                    <a href="#" class="logo-row-text" style="color:#000066;"> wingxp </a>
                </div>
            <div class="name-row-text">
              <h1><?php echo $row12['name']; ?></h1>
            </div>
            <div class="name-row-button">
                <?php if(isset($_GET['user'])){
                    echo '<a href="" data-target="#guest_modal" data-toggle="modal">Logout</a>';
                }else{
                    echo '<a href="?q=logout">Logout</a>';
                }?>
            </div>
            <div class="menu-div">
                <nav class="sidebar-nav">
                    <ul>
                        <li>
                            <a href="#"><i class="fas fa-bars menu-bar"></i></a>
                            <ul class="navbar-dropdown">
                                <li>
                                    <a href="./student_dashboard_final.php">Dashboard</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>  
    <header class="navbar-shadow" style="background-color: #fff;">
        <nav id='cssmenu'>
            <div id="head-mobile"></div>
            <div class="cl-button"></div>
            <ul style="border: 1px solid #a2a2a2;
            background-color: #f4f4f4;
            box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
            border-radius: 5px;
            color: #000">
                <h1 class="club-head-text" style="color: #34495e;text-align: left;padding: 10px;font-size: 24px;">Welcome
                    To <?php if(isset($club_name)){echo $club_name;}else{}?></h1>
                <li><a href='#'>Home</a></li>
                <li><a href='#'>My Profile</a></li>
                <li><a href='#'>Dashboard</a></li>
                <li><a href='#'>FAQ's</a></li>
                <li><a href='#'>Change Club</a>
                    <ul>
                        <form action="#" method="POST" >
                                        <?php $i=0;
                                    while($clb[$i] = mysqli_fetch_row($club_result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club_lst[$i][$j]=$c;
                                            if($flag==0){echo '<li><a id="'.$club_lst[$i][$j].'" href="?id='.$club_lst[$i][$j].'" target="_self"  >';$flag++;}
                                            else{echo $club_lst[$i][$j].'</a></li>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
                                    }?>
    </form>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>    
        
            
        <div class="page-lay-new">
            <div class="theme-div left-right-gap">
           <div class="theme-wrap">
            <h1 class="theme-text "></h1>
                    <nav class="navbar">
                        <ul class="nav" style="display: block;">
                            <li> <span class="club-st-text">Club</span> <?php if(isset($club_name)){echo $club_name;}else{}?><i class="fas fa-angle-down"></i>
                                <ul class="dropdown">
                                    <form action="#" method="POST" style="padding: 2px 15px; font-size:15px; margin:10px 0px;">
                                        <?php $i=0;
                                    while($clb2[$i] = $clb[$i])
                                    { $j=$flag=0;      
                                        foreach($clb2[$i] as $c ){                                            
                                            $club_lst[$i][$j]=$c;
                                            if($flag==0){echo '<li><a class="dropdown-link" id="'.$club_lst[$i][$j].'" href="?id='.$club_lst[$i][$j].'" target="_self"  >';$flag++;}
                                            else{echo $club_lst[$i][$j].'</a></li>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
                                    }?>
                                </form>
                                    </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        
    <?php 
$sid=$_SESSION['Userid'];
$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
$my_uploads = "CALL `show_uploads`('$sid','$club_id')";
$result = $conn->query($my_uploads);
if (mysqli_num_rows($result)>0){ 
echo("<div class='page-lay-new'><table class='table table-hover table-bordered upload-table'>
<thead style='background-color: #981a35;color: #fff;'>
                    <tr>
                        <th scope='col'>Sample Work Name</th>
                        <th scope='col'>Date and Time</th>
                        <th scope='col'>File</th>
                        <th scope='col'>Remark</th>
                    </tr>
                </thead>");
while ($row = mysqli_fetch_assoc($result)) {    
    echo '<tbody><tr>';
    $flag=0;
    foreach($row as $key => $field) {
        if($flag<2)
        {echo '<td>' . strip_tags($field) . '</td>';$flag++;}
        else{echo '<td><a href="../../../assets/work_submission/' . strip_tags($field) . '" >View</a></td>';$flag=0;}
        
        }
    echo '</tr></tbody>';
    }
}
echo("</tbody></table></div>");
$conn->close();
?>
    <div class="footer" style="background-color:#444">
                <div class="page-lay-new">
                    <div class="left-footer" style="color:#ccc;">
                        @Copyright – WingXP 2018
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!--GUEST MESSAGE-->
    <div class="modal fade" id="guest_modal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header" style="background: #1b7ceb;border-bottom: none;">
                    <h5 class="mod-title" id="exampleModalLabel">Wish you register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle close-button"></i></span>
                    </button>
                </div >
                <div class="modal-body" style="padding: 0;">
                    <div style="    display: flex;
    justify-content: space-around;
    margin: 30px 0px 30px 0px;"><br>
                    <div class="name-row-button">
                        <a href="http://wingxp.com/school_registration.php" >Sign Up</a>
                    </div>
                    <div class="name-row-button">
                        <a href="http://wingxp.com/" >Home</a>
                    </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--GUEST MESSAGE-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/v_carousel.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>