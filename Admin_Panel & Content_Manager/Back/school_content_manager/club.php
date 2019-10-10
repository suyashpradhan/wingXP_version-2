<?php
session_start();
$_SESSION['inst_id']='INST_258';
$_SESSION['Userid']='kiran';
$inst_id = $_SESSION['inst_id'];
$Userid = $_SESSION['Userid'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();

if(isset($_GET['id'])){    
    $id = $_GET['id'];
    
} //}
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
    <link rel="stylesheet" href="../assets/css/main.css">

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
    
        <!--START-->
        <?php 
            //$deployed_iclubs = "club_id not in (select club_id from school__iclub_assign where inst_id='$inst_id' ) ";
             $get_club = "select clubs.club_id,club_name from clubs where status = '1' and club_category_id!='CCI_8' and club_id in (select club_id from inst_club_assign where institute_id='$inst_id' and status='')";
             //echo $get_club;   
             $result = $conn->query($get_club);
             if(mysqli_num_rows($result)==0){
            echo ('<div class="form-new" style="background-color: #981a35;display: block;">
            <h1 class="club-header-st">All assigned iClubs are Deployed</h1>
            <form id="assignclubsform">
            <div class="check-wrap"></div>');}
            else{
                echo ('<div class="form-new" style="background-color: #981a35;display: block;">
            <h1 class="club-header-st">Assigned and not Deployed</h1><span style="color:white;">Note: Check ☑ to deploy club</span>
            <form id="assignclubsform">
            <div class="check-wrap">');
            $i=0;
                                    while($clb[$i] = mysqli_fetch_row($result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($flag==0){echo '<div class="checkbox new-check">
                                                <label style="margin: 0">
                                                    <input type="checkbox" name="iclub_dep[]" value="'.$club[$i][$j].'"><span class="checkbox-material"><span class="check"></span></span><br>
                                                    <span>';
                                                $flag++;}
                                            else{echo $club[$i][$j].'</span>
                                                </label>
                                            </div>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
    } echo ('</div><button class="add-club-btn" onclick="dep_iclub()">Update</button>');}

                     
?><br>
    <h2 class="club-header-st">Deployed Iclubs</h2><span style="color:white;">Note: Uncheck ☐ to withhold club</span>
    <div class="check-wrap">
        
        <?php 
            //$deployed_iclubs = "club_id not in (select club_id from school__iclub_assign where inst_id='$inst_id' ) ";
             $get_club = "select  clubs.club_id,club_name from clubs where status='1' and club_category_id!='CCI_8' and club_id in (select club_id from inst_club_assign where institute_id='$inst_id' and status!='')";
                $result = $conn->query($get_club);
                    $i=0;
                                    while($clb[$i] = mysqli_fetch_row($result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($flag==0){echo '<div class="checkbox new-check">
                                                <label style="margin: 0">
                                                    <input type="checkbox" name="iclub_hold[]" checked value="'.$club[$i][$j].'"><span class="checkbox-material"><span class="check"></span></span><br>
                                                    <span>';
                                                $flag++;}
                                            else{echo $club[$i][$j].'</span>
                                                </label>
                                            </div>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
    }
?>
            
        </div></form>
        <button class="add-club-btn" onclick="dep_iclub()">Update</button>
        <br><br></div>
        <div class="form-new" style="background-color: #981a35;display: block;">
        <h1 class="club-header-st">All School Clubs</h1>
        <div class="check-wrap-sub">
        <?php 
             $get_club = "select club_id,club_name from school__clubs where club_category_id='CCI_8' and inst_id='$inst_id'";
                $result = $conn->query($get_club);
                    $i=0;
                                    while($clb[$i] = mysqli_fetch_row($result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($flag==0){echo '<div class="checkbox new-check">
                                                <label style="margin: 0">
                                                    <input type="checkbox" disabled name="schoolclub[]" value="'.$club[$i][$j].'" checked><span class="checkbox-material"><span class="check"></span></span><br>
                                                    <span>';
                                                $flag++;}
                                            else{echo $club[$i][$j].'</span>
                                                </label>
                                            </div>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
    }
?></div>
            
        
        
    
    
    
        <?php 
             $get_club = "select club_id,club_name from school__clubs where club_category_id='CCI_8' and status='1' and inst_id='$inst_id'";
                $result = $conn->query($get_club);
                if(mysqli_num_rows($result)==0){
                    echo ('<h1 class="club-header-st">No School Clubs have been Deployed</h1>
                    <div class="check-wrap-sub"></div>');}
                    else{
                        echo ('<h1 class="club-header-st">Deployed School Clubs</h1>
                        <div class="check-wrap-sub">');
                        $i=0;
                        while($clb[$i] = mysqli_fetch_row($result))
                        { $j=$flag=0;      
                            foreach($clb[$i] as $c ){                                            
                                $club[$i][$j]=$c;
                                if($flag==0){echo '<div class="checkbox new-check">
                                    <label style="margin: 0">
                                        <input type="checkbox" disabled name="schoolclub[]" value="'.$club[$i][$j].'" checked><span class="checkbox-material"><span class="check"></span></span><br>
                                        <span>';
                                    $flag++;}
                                else{echo $club[$i][$j].'</span>
                                    </label>
                                </div>';$flag--;}                
                                $j++;
                            }
                            $i++;     
}
                    

            
        
       echo '</div><button class="add-club-btn"><a href="update.php">Click here to Update School Clubs</a></button>';}
       ?>
    </div>
<!--END-->

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

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
function dep_iclub(){  
    var checkboxes = document.getElementsByName('iclub_dep[]');
    var vals = "";
    var vals2 = "";
    for (var i=0, n=checkboxes.length;i<n;i++) 
    {
        if (checkboxes[i].checked) 
        {
            vals += ","+checkboxes[i].value;
        }
        else{
            vals2 += ","+checkboxes[i].value;
        }
    }    
    if (vals) vals = vals.substring(1);
    if (vals2) vals2 = vals2.substring(1);

    var checkboxes1 = document.getElementsByName('iclub_hold[]');
    var vals3 = "";
    var vals4 = "";
    for (var i=0, n=checkboxes1.length;i<n;i++) 
    {
        if (checkboxes1[i].checked) 
        {
            vals3 += ","+checkboxes1[i].value;
        }
        else{
            vals4 += ","+checkboxes1[i].value;
        }
    }    
    if (vals3) vals3 = vals3.substring(1);
    if (vals4) vals4 = vals4.substring(1);
    //stop submit the form, we will post it manually.   
event.preventDefault();
// Get form
var form = $('#assignclubsform')[0];
// Create an FormData object 
var data = new FormData(form);
//data.append("iclub", vals);
$.ajax({
    type: "GET",
    enctype: 'multipart/form-data',
    url: "club_back.php?checked_dep="+vals+"&unchecked_dep="+vals2+"&checked_hold="+vals3+"&unchecked_hold="+vals4,
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (data) {       
        console.log(data);
                            if (data=='success')
                        {alert('Clubs Added Successfully !');
                            window.location.replace("./club.php");
                            $("#submit").css({'background-color':'#2abfd4'});
                        $("#submit").html(data); 
                        }
                        
                                               
                        },
    error: function (e) {           
                            console.log(e);
                        }
                    });}
</script>
</html>