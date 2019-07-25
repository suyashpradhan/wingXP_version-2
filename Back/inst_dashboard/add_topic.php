<?php
session_start();
$inst_id = $_SESSION['Userid'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){    
    $id = $_GET['id'];   
    $get_topic = "select club_id,topic_id,topic_name,topic_desc,start_date,end_date,start_date,end_date,status from school__topic where topic_id='$id'"; 
    $result = $conn->query($get_topic);
    while($row = $result->fetch_array()){
        $club_id_tp=$row['club_id'];
        $topic_name=$row['topic_name'];
        $status=$row['status'];
        $topic_id=$row['topic_id'];
        $topic_desc=$row['topic_desc'];
        $start_date=$row['start_date'];
        $end_date=$row['end_date'];
    }   
    
}
else{}
//$_SESSION['inst_id];
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    <script>
        $(function () {
            $("#start,#end").datepicker();
        });
    </script>
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
    
    
    <?php $get_club = "SELECT club_id, club_name from school__clubs where inst_id= '$inst_id'";
    $result = $conn->query($get_club);
     $i=0;
     if($result->num_rows<1)
     {
         echo '<h1 style="color:white;">No School Clubs to create Topic for, Click <a href="school_club.php">here</a> to create a School Club First !</h1>';
     }
         else{ echo '<form id="topic_form"><h1 class="club-header-st">Topic</h1><select id="clubs" name="clubs" class="club-select" >';
             while($clb[$i] = mysqli_fetch_row($result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($flag==0){if(isset($club_id_tp) and $club[$i][$j] == $club_id_tp){echo $sel='selected';}else{$sel='';} echo '<option value="'.$club[$i][$j].'"'.$sel.'>';
                                                $flag++;}
                                            else{echo $club[$i][$j].'</option>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
                                    }}
                                ?>
    </select><br>
                <input value="<?php if(isset($topic_name)){echo $topic_name;}else{}?>" type="text" name="topic_name" id="topic_name" placeholder="Topic Name" class="row-fields"
                required="true"><br><input type="hidden" name="action" value="<?php if(isset($id)){echo 'update';}else{echo 'add';}?>">
                <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>">
            <textarea name="desc" id="desc" cols="70" rows="4" placeholder="Description" style="resize: none;padding: 1px;" required="true">
            <?php if(isset($topic_desc)){echo $topic_desc;}else{}?></textarea><br>
            <input value="<?php if(isset($start_date)){echo $start_date;}else{}?>" type="text" name="from" id="start" required="true" placeholder="Start Date" class="row-fields" autocomplete="off"><br>
            <input value="<?php if(isset($end_date)){echo $end_date;}else{}?>" type="text" name="to" id="end" required="true" placeholder="End Date" class="row-fields" autocomplete="off"><br>
            <input <?php if(isset($status) and $status=1){echo 'checked';}else{}?> type="radio" name="status" value="1" >Activate
            <input <?php if(isset($status) and $status =0){echo 'checked';}else{}?> type="radio" name="status" value="0"> Deactivate<br>
            <input type="button" name="submit" value="SUBMIT" id="sub" name="sub" onclick="check_form()" class="submit__btn">
            
       </form>
    </div>

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
    <script>
    
        function fetch_clubs(){
    $.ajax({
			type: 'POST',
			url: 'get_club.php',
			data: '',
			beforeSend: function() { 
			},
			success: function(response){
			$('#clubs').html(response);
			} 
			});
}
function check_form()
   {
           var club_name= $('#topic_name').val();    
            var desc= $('#desc').val(); 
            var start= $('#start').val(); 
            var end= $('#end').val(); 
             if(start === '' || end === '' || club_name === '' || desc === '' )
                  {
		        alert('Please make sure all fields are filled.');
		  }
             else
		 {          
                           add_topic();
                 } 
   }

function add_topic(){
    event.preventDefault();
    var form = $('#topic_form')[0];
    var data = new FormData(form);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "topic_back.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
       success: function (data) {
            console.log(data);
            if(data=='success'){
           alert("Topic Added !");
           location.reload();
            }            
            if(data=='exists'){
           alert("Topic Already Exists !");
           location.reload();
            }
            if(data=='updated'){
           alert("Topic Updated !");
           location.reload();
            }
        },
        error: function (e) {
            console.log(e);
            alert('Error ! Check console for error !');
        }
});
}
        </script>

</html>