<?php 
include_once "../assets/Users.php";
session_start();
$database = new Database();
$db = $database->getConnection();
$inst_id=$_SESSION['inst_id']='INST_258';
if(isset($_GET['id'])){
    $club_id=$_GET['id'];
}else{
    $def_club_q = "select club_id from clubs where club_id in
         (select club_id from inst_club_assign where institute_id ='$inst_id' and status='1') and status='1' limit 1";
        $def_club_res = $db->query($def_club_q);
        $row = $def_club_res->fetch_array();
        $club_id =$row['club_id'];   
}
$flag=(preg_match('(school_club_)',$club_id)? 1:0);
$get_club_q = ($flag == 0 ? "select club_name from clubs where club_id= '$club_id'" :  "select club_name from school__clubs where club_id= '$club_id'");
 
$club = $db->query($get_club_q); while($row = $club->fetch_array())
 {
  $club_name =$row['club_name'];
 }
    $flag=(preg_match('(school_club_)',$club_id)? 1:0);
    $check_sub_q = 'select clubs.club_id, clubs.club_name from clubs inner join inst_club_assign on 
    clubs.club_id =inst_club_assign.club_id where inst_club_assign.status="1" and clubs.status="1" and inst_club_assign.institute_id="'.$inst_id.'" UNION ALL
    select school__clubs.club_id, school__clubs.club_name from school__clubs inner join inst_club_assign on 
    school__clubs.club_id =inst_club_assign.club_id where inst_club_assign.status="1" and school__clubs.status="1" and school__clubs.inst_id="'.$inst_id.'"';
    
    $club_result = $db->query($check_sub_q);
          ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>School Content Manager - WingXP</title>
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script> $( function() {  $( "#datepicker" ).datepicker({  dateFormat: "yy-mm-dd"});  } );  </script>
    </pre>
</head>

<body>

    <div class="navbar navbar-shadow" style="height: 110px;">
        <div class="newnavigationBar_2">
            <a href="index.php">
                <img src="http://www.iclubs.in/assets/images/logo.png" alt="" style="margin:10px;height: 90px;"></a>
            <div class="menu-wrapper">
                <a href="?q=logout" class="fancy-button bg-gradient2 logout-nav-link"><span>Logout</span></a>
            </div>
            <div class="menu-wrapper">
                <a href="student_uploads.php" class="fancy-button bg-gradient2 logout-nav-link"><span>Student Uploads</span></a>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="main.css">
    <div class="page-lay-new">
        <div class="theme-div left-right-gap">
            <div class="theme-wrap">
                <nav class="navbar">
                    <ul class="nav" style="display: block;">
                        <li> <span class="club-st-text">Club</span> <?php if(isset($club_name)){echo $club_name;}else{}?> <i class="fas fa-angle-down"></i>
                            <ul class="dropdown">
                                <form action="#" method="POST" style="padding: 2px 15px; font-size:15px; margin:10px 0px;">
                                <?php $i=0;
                                    while($clb[$i] = mysqli_fetch_row($club_result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
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
$my_uploads = "select sample_work.title,file,inst_user.name as st_name,inst_club_coordinator.name as cc_name,submission_feedback.remark,featured,sample_work_submission.submission_id from sample_work_submission 
INNER JOIN sample_work ON sample_work_submission.sample_work_id = sample_work.sample_work_id left join inst_user on sample_work_submission.student_id = inst_user.user_id left join submission_feedback on 
submission_feedback.submission_id = sample_work_submission.submission_id left join inst_club_coordinator on inst_club_coordinator.club_coordinator_id = submission_feedback.cc_id where 
inst_user.institute_id = '$inst_id' and sample_work_submission.club_id='$club_id' order by sample_work.sample_work_id";
$result = $db->query($my_uploads);
if (mysqli_num_rows($result)>0){ 
echo("<div class='page-lay-new'><table class='table table-hover table-bordered upload-table'>
<thead style='background-color: #981a35;color: #fff;'>
                    <tr>
                        <th scope='col'>Sample Work Name</th>
                        <th scope='col'>File</th>
                        <th scope='col'>Submitted By</th>
                        <th scope='col'>Remarked by</th>
                        <th scope='col'>Remark</th>                        
                        <th scope='col'>Featured</th>
                        <th scope='col'>Action</th>
                    </tr>
                </thead>");
while ($row = mysqli_fetch_assoc($result)) {    
    echo '<tbody><tr>';
    $flag=0;
    foreach($row as $key => $field) {
        if($key=='title'){ echo '<td>' . strip_tags($field) . '</td>';}
        if($key=='st_name'){ echo '<td>' . strip_tags($field) . '</td>';}
        if($key=='cc_name'){ echo '<td>' . strip_tags($field) . '</td>';}
        if($key=='file'){echo '<td><a href="../../../assets/work_submission/' . strip_tags($field) . '" >View</a></td>';}
        if($key=='remark'){ echo '<td><input id="'.$row['submission_id'].'" style="width: -webkit-fill-available;" type="text" value="' . strip_tags($field) . '"></td>';}
        if($key=='featured'){if($field=='1'){$check='checked';}else{$check='';} echo '<td><input type="checkbox" id="f'.$row['submission_id'].'" value="1"'.$check.'></td>';}
        if($key=='submission_id'){echo '<td><a href="#" onclick="remark('.strip_tags($field).')">Update</a></td>';}
        }$flag++;
    echo '</tr></tbody>';
    }
}
echo("</tbody></table></div>");
$db->close();
?> 
        <div class="footer" style=" position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px; 
    background:#000;">
            <div class="left-footer" style="padding: 15px; padding: 15px 0;
        font-size: 20px;
        color: #fff;
        float: none;
        text-align: center;">
                &copy; Copyright – WingXP 2018
            </div>
        </div>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
            crossorigin="anonymous">

        <!--  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script> -->
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

        <script>
            CKEDITOR.replace('editor1');
        </script>
        <script>
            CKEDITOR.replace('editor2');
        </script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
            crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
            crossorigin="anonymous "></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
            crossorigin="anonymous "></script>
        <script>
            function remark(id) {
                event.preventDefault();
                var remark = $(id).val();
                var check = 'f' + id.id;
                var f = document.getElementById(check).checked;
                if (f == true) {
                    var feat = 1;
                } else {
                    feat = 0;
                }
                $.ajax({
                    type: "GET",
                    enctype: 'multipart/form-data',
                    url: "remark_back.php?id=" + id.id + "&remark=" + remark + "&featured=" + feat,
                    data: '',
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function (data) {
                        console.log(data);
                        if (data == 'updated') {
                            alert('Updated');
                            location.reload();
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }
        </script>