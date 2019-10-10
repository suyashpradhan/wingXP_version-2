<?php
session_start();
$inst_id = $_SESSION['Userid'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){    
    $id = $_GET['id'];
    
} 
else{}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
    <link rel="stylesheet" href="main.css">

    <style>
        body::after {
            content: "";
            display: block;
            height: 60px;
        }
    </style>
</head>

<body>
    <div class="navbar navbar-shadow" style="height: 110px;">
        <div class="newnavigationBar">
            <a href="inst_dashboard.php">
                <img src="../Student_Dashboard Version 2/assets/images/logo.png" alt="" style="margin:10px;height: 90px;"></a>
            <div class="menu-wrapper">
                <a href=" ?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
            </div>
        </div>
    </div>    
    <div class="form-new" style="background-color: #981a35;display: block;">    
        <h1 style="color:white;"> Update iClubs</h1>
        <?php 
             $get_club = "select clubs.club_id,club_name from clubs where status = '1' and club_category_id!='CCI_8' and club_id in (select club_id from inst_club_assign where institute_id='$inst_id')";
                $result = $conn->query($get_club);
                    $i=0;
                                    while($clb[$i] = mysqli_fetch_row($result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($flag==0){if(isset($id) and $club[$i][$j]==$id){echo $check='selected';}else{$check ='';} echo '<a href="updateiclub.php?id='.$club[$i][$j].'"'.$check.'>';
                                                $flag++;}
                                            else{echo $club[$i][$j].'</a><br>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
    }
?>
        
    </div>

    <div class="form-new" style="background-color: #981a35;display: block;">    
    <h1 style="color:white;"> Update School Clubs</h1>
        <?php 
             $get_club = "select club_id,club_name from school__clubs where club_category_id='CCI_8' and inst_id='$inst_id'";
                $result = $conn->query($get_club);
                    $i=0;
                                    while($clb[$i] = mysqli_fetch_row($result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($flag==0){if(isset($id) and $club[$i][$j]==$id){echo $check='selected';}else{$check ='';} echo '<a href="school_club.php?id='.$club[$i][$j].'"'.$check.'>';
                                                $flag++;}
                                            else{echo $club[$i][$j].'</a><br>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
    }
?>
        
    </div>
    <div class="form-new" style="background-color: #981a35;display: block;">    
    <h1 style="color:white;"> Update Topic</h1>
        <?php 
             $get_club = "select topic_id,topic_name from school__topic where inst_id='$inst_id'";
                $result = $conn->query($get_club);
                    $i=0;
                                    while($clb[$i] = mysqli_fetch_row($result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($flag==0){if(isset($id) and $club[$i][$j]==$id){echo $check='selected';}else{$check ='';} echo '<a href="add_topic.php?id='.$club[$i][$j].'"'.$check.'>';
                                                $flag++;}
                                            else{echo $club[$i][$j].'</a><br>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
    }
?>
        
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