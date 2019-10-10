<?php
session_start();
$inst_id = $_SESSION['Userid']='INST_256';
include_once "../assets/Users.php";
$database = new Database();
$db = $database->getConnection();
if(isset($_GET['id'])){    
    $id = $_GET['id'];
    
} 
else{}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="main.css" />
    <link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"
    />
    <title>Sacred Heart Convent School - School Dashboard</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous" />
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
            crossorigin="anonymous" />
         <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous "></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
            crossorigin="anonymous "></script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
            crossorigin="anonymous "></script>
  </head>
  <body style="background-color:#f0f0f0">
    <div class="page-container__new">
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="inst_dashboard.php">
                        wingxp</a>
                </div>
            </div>
            <div class="side-nav-wrapper">
                <ul class="side-nav_list">
                    <li>
                        <i class="fas fa-graduation-cap side-icons fa-fw"></i>
                        <a href="club.php" class="side-nav_links"> Clubs Management </a>
                    </li>
                    <li>
                        <i class="fas fa-user side-icons fa-fw"></i>
                        <a href="add_class1.php" class="side-nav_links"> Users Management </a>
                    </li>
                    <li>
                        <i class="fas fa-cog side-icons fa-fw"></i>
                        <a href="#" class="side-nav_links">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="footer-wrap">
                <h1 class="copy-text">
                    Copyright &copy; WingXP 2018 .All rights reserved
                </h1>
                <a href="#">Privacy Policy</a> <span>|</span> <a href="#">Feedback</a>
            </div>
        </div>
        <div class="main-content" style="min-height: 100vh;">
            <div class="right_topNav">
                <div class="inner-topNav">
                    <div class="row no-gutters ">
                        <div class="col-10">
                            <div class="icon-wrap">
                                <h1 class="topNav_first">
                                    Sacred Heart Convent School <span> DASHBOARD </span>
                                </h1>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="icon-wrap">
                                <a href="?q=logout" class="btn_logout indigo wave">Logout</a>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="form-new" style="background-color: #17a2b8; display: block; margin: 40px auto;max-width:90% !important;">    
        
        <?php 
             $get_club = "select clubs.club_id,club_name from clubs where status = '1' and club_category_id!='CCI_8' and club_id in (select club_id from inst_club_assign where institute_id='$inst_id')";
                $result = $db->query($get_club);
                    $i=0;
                    if($result->num_rows<1)
                    {
                        echo '<h1 style="color:white;">No iClubs to Update</h1><div class="form-new_grid">';
                    }
                        else
                    { echo '<h1 style="color:white;"> Update iClubs</h1><div class="form-new_grid">';
                            while($clb[$i] = mysqli_fetch_row($result))
                        { $j=$flag=0;      
                            foreach($clb[$i] as $c ){                                            
                                $club[$i][$j]=$c;
                                if($flag==0){echo '<a href="addiclub.php?id='.$club[$i][$j].'">';
                                    $flag++;}
                                else{echo $club[$i][$j].'</a><br>';$flag--;}                
                                $j++;
                            }
                            $i++;     
                            }
                    }
?>
    </div>    </div>
    

   <div class="form-new" style="background-color: #17a2b8; display: block; margin: 40px auto;max-width:90% !important;"> 
   
        <?php 
             $get_club = "select club_id,club_name from school__clubs where club_category_id='CCI_8' and inst_id='$inst_id'";
                $result = $db->query($get_club);
                    $i=0;
                    if($result->num_rows<1)
                    {
                        echo '<h1 style="color:white;">No School Clubs to Update, Click <a href="school_club.php">here</a> to create one !</h1><div class="form-new_grid">';
                    }
                        else{ echo '<h1 style="color:white;"> Update School Clubs</h1><div class="form-new_grid">';
                                    while($clb[$i] = mysqli_fetch_row($result))
                                { $j=$flag=0;      
                                    foreach($clb[$i] as $c ){                                            
                                        $club[$i][$j]=$c;
                                        if($flag==0){echo '<a href="school_club.php?id='.$club[$i][$j].'">';
                                            $flag++;}
                                        else{echo $club[$i][$j].'</a><br>';$flag--;}                
                                        $j++;
                                    }
                                    $i++;     
                                    }
                                }
?>
   
</div>
</div>
    <div class="form-new" style="background-color: #17a2b8; display: block; margin: 40px auto;max-width: 90% !important;"> 
   
        <?php 
             $get_club = "select topic_id,topic_name from school__topic where inst_id='$inst_id'";
                $result = $db->query($get_club);
                    $i=0;
                    if($result->num_rows<1)
                    {
                        echo '<h1 style="color:white;">No Topics to Update, Click <a href="add_topic.php">here</a> to create one !</h1><div class="form-new_grid">';
                    }
                        else{
                                        echo '<h1 style="color:white;"> Update Topic</h1><div class="form-new_grid">';
                                    while($clb[$i] = mysqli_fetch_row($result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($flag==0){echo '<a href="add_topic.php?id='.$club[$i][$j].'">';
                                                $flag++;}
                                            else{echo $club[$i][$j].'</a><br>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
                                            }
                                        }
?>
        
</div>
</div>
</form>
    <div class="footer" style=" position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px; 
    background:#000;">
        <div class="left-footer" style="padding: 15px 0;
        font-size: 20px;
        color: #fff;
        float: none;
        text-align: center;">
            &copy; Copyright – iCLUBS 2018
        </div>
    </div>
</body>


</html>