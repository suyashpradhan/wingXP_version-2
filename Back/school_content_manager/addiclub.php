<?php
session_start();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google+Sans:400|Roboto:400,400italic,500,500italic,700,700italic|Roboto+Mono:400,500,700|Material+Icons">
    <link rel="stylesheet" href="../inst_dashboard/main.css">

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
    <form id="addiclubform">
    <div class="form-new" style="background-color: #981a35;display: block;">
    
    <select id="clubs" name="club_id" class="club-select" onchange="get_detail()">
                <?php 
                    $get_club = "select  clubs.club_id,club_name from clubs where status='1' and club_id in (select club_id from inst_club_assign where institute_id='INST_258') and club_category_id!='CCI_8'";
                    //echo $get_club;
                        $result = $conn->query($get_club);
                            $i=0;
                                            while($clb[$i] = mysqli_fetch_row($result))
                                            { $j=$flag=0;      
                                                foreach($clb[$i] as $c ){                                            
                                                    $club[$i][$j]=$c;
                                                    if($flag==0){if(isset($id) and $club[$i][$j]==$id){echo $check='selected';}else{$check ='';} echo '<option value="'.$club[$i][$j].'"'.$check.'>';
                                                        $flag++;}
                                                    else{echo $club[$i][$j].'</option>';$flag--;}                
                                                    $j++;
                                                }
                                $i++;     
            }
        ?>
    </select>
        <div class="row">
            <div class="col-4">
                <h1 class="row-head-new">Coordinator</h1>
                <select name="coord_post" id="coord_post" class="row-fields" onchange="update()">
                    
                </select>
            </div>
            <div class="col-4">
                <h1 class="row-head-new">Club President</h1>
                <select name="pres_post" id="pres_post" class="row-fields" onchange="update()">
                </select>
            </div>
            <div class="col-4">
                <h1 class="row-head-new">Club Bearer</h1>
                <select name="bearer_post" id="bearer_post"  class="row-fields" onchange="update()">
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <input type="text" name="coord_name" id="coord_name"  placeholder="Contact" class="row-fields">
            </div>
            <div class="col-4">
                <input type="text" name="pres_name" id="pres_name"  placeholder="Contact" class="row-fields">
            </div>
            <div class="col-4">
                <input type="text" name="bearer_name" id="bearer_name"  placeholder="Contact" class="row-fields">
            </div>
        </div>
        <h1 class="row-head-new-two">Class Selection (Same as in Deploy Table)</h1>
        <div class="checkbox new-check" style="display: block;margin: 30px auto 0 auto;">
            <label style="margin: 0">
                <span>Auto Deploy</span> <input type="checkbox" name="auto_deploy"><span class="checkbox-material"><span class="check"></span></span>

            </label>
        </div>
        <h1 class="row-head-new-two">Status</h1>
          <div class="first-half-wrapper">
            <h1 class="row-head-new new-radio-text">Enabled</h1>
            <input 
              type="radio"
              name="status"
              value="1"
              id="status"
              class="first-radio"
            />
            <h1 class="row-head-new new-radio-text">Disabled</h1>
            <input 
              type="radio"
              name="status"
              id="status"
              value="0"
              class="first-radio"
            />
          </div>
        <div class="button-wrap">
                <input type="hidden" name="action" value="publish">
                <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>">
                <button class="submit__btn" id="submit" onclick="ajaxbackend()"><span id="buttonaction">Submit</span></button>
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

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
    $(document).ready( $('#clubs').change());
function get_detail(){
    var club= $('#clubs').val();
    $.ajax({
						  type: 'GET',
						  url: 'get_detail.php?action=main&club='+club,
						  data: '',
						  success: function(response){   
                              alert(response);               
                            var res = JSON.parse(response);                                                              
						    $('#coord_post').html(res[0][0]);
                            $('#pres_post').html(res[1][0]);
                            $('#bearer_post').html(res[2][0]);
                            update();
						  } 
					       });

}

function update(){
    var coord= $('#coord_post').val();
    var pres= $('#pres_post').val();
    var bear= $('#bearer_post').val();
    $.ajax({
						  type: 'GET',
						  url: 'get_detail.php?c='+coord+'&p='+pres+'&b='+bear,
						  data: '',
						  success: function(response){  
                            var res = JSON.parse(response);                                                 
						    $('#coord_name').val(res[0]);
                            $('#pres_name').val(res[1]);
                            $('#bearer_name').val(res[2]);
						  } 
					       });

}

function ajaxbackend(){      
    var coord_post = $('#coord_post').val(); 
    var coord_name = $('#coord_name').val();
    var pres_post = $('#pres_post').val();
    var pres_name = $('#pres_name').val();
    var bearer_post = $('#bearer_post').val();
    var bearer_name = $('#bearer_name').val();

    if (coord_post === '' || coord_name === '' ||  pres_post === '' ||  pres_name === '' ||  bearer_post === '' ||  bearer_name === '' )
      {alert ("Fill necessary fields !");
      event.preventDefault();}
    else {
//stop submit the form, we will post it manually.   
event.preventDefault();
// Get form
var form = $('#addiclubform')[0];
// Create an FormData object 
var data = new FormData(form);
$.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: "addiclub_back.php",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (data) {       
        console.log(data);
                            if (data=='success')
                        {alert('iClub Added Successfully !');
                            location.replace("./club.php");
                            $("#submit").css({'background-color':'#2abfd4'});
                        $("#submit").html(data); 
                        }
                        if (data=='updated')
                        {alert('iClub Updated Successfully !');
                            location.replace("./club.php");
                            $("#submit").css({'background-color':'#2abfd4'});
                        $("#submit").html(data); 
                        }
                                               
                        },
                        error: function (e) {           
                            console.log(e);
                        }
                    });}}
</script>
</html>