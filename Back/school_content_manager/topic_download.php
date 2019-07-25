<?php
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    $test_up = "SELECT title, link, from school__topic_download where sno= '$id'";
    $result = $conn->query($test_up);
    while($row = $result->fetch_array())
    {
     $title =$row['title'];
     $link =$row['link'];
    }
}
else{
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/main.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body >
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
    <div class="content">
        <h1 class="ribbon">Topic Downloads</h1>
        <form action="" id="form">
        <div class="input-group">              
                    <?php 
                    if(isset($_SESSION['topic_id'])){$v=$conn->query("select topic_name from school__topic where topic_id= '$_SESSION[topic_id]'");
                    while($row = $v->fetch_array())
                    {$topic=$row['topic_name'];}
                    if(isset($topic)){echo '<h1 style="color:#777;">Topic: '.$topic.'</h1>';}
                    else{echo '<h1 style="color:red;">Please Create a Topic Before Adding Content !</h1>';}}
                    else{echo '<h1 style="color:red;">Please Choose a Topic Before Adding Content !</h1>';}
                    ?>            
        </div>
            <div class="index-wrap">
                <div class="input-group">
                    <input type="text" value="<?php if(isset($title)){echo $title;}else{}?>" name="title" id="title" placeholder="Enter Title Here" />
                </div><br>
                <div class="input-group">
                    <input type="text" value="<?php if(isset($link)){echo $link;}else{}?>" name="link" id="link" placeholder="Download Link" />
                </div><br>
            <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>"> 
            <input type="hidden" name="action" <?php if(isset($id)){echo 'value="update"';}else{echo 'value="publish"';}?>>
            <button name="submit" id="submit" value="submit" type="submit" onclick="ajaxbackend()" class="p__btn">Publish</button>
        </form>
        </div>
    <div class="footer">
        <div class="footerInner">
            <h1>SPACEDTIMES</h1>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css " integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg "
        crossorigin="anonymous ">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script language="javascript">
    function ajaxbackend(){
    var title= $('#title').val(); 
    var link= $('#link').val();     
    if(link == '' ||  title == '')
                  {
		        alert('Please make sure all fields are filled.');
                event.preventDefault();

		            } else {
                        event.preventDefault();            
                        var form = $('#form')[0];           
                    var data = new FormData(form);           
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "topic_download_back.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {     
                            console.log(data);                          
                            if (data=='success')
                        {alert('Published Successfully !');
                        location.reload(true); 
                        }else if(data=='exists')
                        {alert('Already Exists !');}
                        else if(data=='updated')
                        {
                            alert('Updated Successfully !');
                            $("#submit").html('Updated');
                            $("#submit").css({'background-color':'#2abfd4'});
                            location.reload(true);
                        }                                                                        
                        },
                        error: function (e) {           
                            console.log(e);
                        }
                    });
                    
                    }}
        </script>
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