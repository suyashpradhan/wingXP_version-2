<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
$id=$_POST['id'];
$type=$_POST['type'];
$flag=(preg_match('(school_club_)',$_SESSION['club_id'])? 1:0);
if(isset($_POST['reason'])){
    echo $_POST['reason'];
    $reason = mysqli_real_escape_string($conn,$_POST['reason']);
    $restrict_q='insert into activity_restrict (institute_id,cc_id,activity_id,reason,club_id) values 
    ("'.$_SESSION['inst_id'].'","'.$_SESSION['Userid'].'","'.$id.'","'.$reason.'","'.$_SESSION['club_id'].'")';
    $result=$conn->query($restrict_q);
    $remove_dep_q='delete from deployment_control where activity_id="'.$id.'" and institute_id="'.$_SESSION['inst_id'].'" and club_id="'.$_SESSION['club_id'].'"';
    $conn->query($remove_dep_q);
    if($result){
        echo '<script>alert("Success");window.history.back();</script>';
    }
    else{
        echo '<script>alert("Error");window.history.back();</script>';
    }
}
else{
switch ($type) {
    case 'article':    
        $sql=($flag == 0 ? "select mrp_price,school_price from article where article_id='$id'": 
        "select mrp_price,school_price from school__article where article_id='$id'");
        break;
    case 'online_test':  
    $sql=($flag == 0 ?"select mrp_price,school_price from online_test where test_id='$id'":     
    "select mrp_price,school_price from school__online_test where test_id='$id'");
        break;
    case 'ebook':        
    $sql=($flag == 0 ?"select mrp_price,school_price from ebook where book_id='$id'":
    "select mrp_price,school_price from school__ebook where book_id='$id'");
        break;
    case 'workshop':    
    $sql=($flag == 0 ?"select mrp_price,school_price from workshop where workshop_id='$id'":
    "select mrp_price,school_price from school__workshop where workshop_id='$id'");      
        break;
    case 'webinar':  
    $sql=($flag == 0 ?"select mrp_price,school_price from webinar where webinar_id='$id'":
    "select mrp_price,school_price from school__webinar where webinar_id='$id'");        
        break;        
    case 'video':  
    $sql=($flag == 0 ?"select mrp_price,school_price from video where video_id='$id'":
    "select mrp_price,school_price from school__video where video_id='$id'");        
        break;
    case 'live_course':  
    $sql=($flag == 0 ?"select mrp_price,school_price from live_course where course_id='$id'":
    "select mrp_price,school_price from school__live_course where course_id='$id'");        
        break; 
    case 'quiz':  
        $sql=($flag == 0 ?"select mrp_price,school_price from quiz where quiz_id='$id'":
        "select mrp_price,school_price from school__quiz where quiz_id='$id'");        
        break;   
    case 'learning_video':  
        $sql=($flag == 0 ?"select mrp_price,school_price from learning_video where video_id='$id'":
        "select mrp_price,school_price from school__learning_video where video_id='$id'");        
        break;
    case 'sample_work':  
        $sql=($flag == 0 ?"select mrp_price,school_price from sample_work where sample_work_id='$id'":
        "select mrp_price,school_price from school__sample_work where sample_work_id='$id'");        
        break;
    default:
        echo 'Please deploy again';
        
}
if(isset($_POST['id'])){
$result = $conn->query($sql);
    while($row = $result->fetch_array())
    {
     $price =$row['mrp_price'];
     $school_price =$row['school_price']; 
    }
}
else{

}
}
$conn->close();

?>   
    
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
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
    <h1 class="header-main">Deployment Controls</h1><br>
    <form id="dep_form">
    <div class="body__wrapper">
        <div class="my-container">
            <h1 class="body-header">Class</h1>
            <div class="first-half-wrapper">
                <h1 class="first-half__header">Primary</h1>
                <input type="checkbox" id="primary" class="first-half__check primary_master">
            </div>
            <div class='row '>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]"  value='1' class="demo_check primary" <?php if(isset($_POST['class1'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class1'>Class 1</label>
                </div>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]"  value="2" class="demo_check primary" <?php if(isset($_POST['class2'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class2'>Class 2</label>
                </div>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]"  value='3' class="demo_check primary" <?php if(isset($_POST['class3'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class3'>Class 3</label>
                </div>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]"  value='4' class="demo_check primary" <?php if(isset($_POST['class4'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class4'>Class 4</label>
                </div>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]"  value='5' class="demo_check primary" <?php if(isset($_POST['class5'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class5'>Class 5</label>
                </div>
            </div><br>
            <div class="first-half-wrapper">
                <h1 class="first-half__header">Secondary</h1>
                <input type="checkbox"  id="secondary" class="first-half__check secondary_master">
            </div>
            <div class='row '>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]" value='6' class="demo_check secondary secondary" <?php if(isset($_POST['class6'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class1'>Class 6</label>
                </div>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]"  value="7" class="demo_check secondary" <?php if(isset($_POST['class7'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class2'>Class 7</label>
                </div>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]"  value='8' class="demo_check secondary" <?php if(isset($_POST['class8'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class3'>Class 8</label>
                </div>
            </div><br>
            <div class="first-half-wrapper">
                <h1 class="first-half__header">Senior Secondary</h1>
                <input type="checkbox"  id="sen_secondary" class="first-half__check sen_secondary_master">
            </div>
            <div class='row '>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]" value='9' class="demo_check sen_secondary" <?php if(isset($_POST['class9'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class1'>Class 9</label>
                </div>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]"  value='10' class="demo_check sen_secondary" <?php if(isset($_POST['class10'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class2'>Class 10</label>
                </div>
            </div><br>
            <div class="first-half-wrapper">
                <h1 class="first-half__header">Senior</h1>
                <input type="checkbox"  id="senior" class="first-half__check senior_master" >
            </div>
            <div class='row '>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]" value='11' class="demo_check senior" <?php if(isset($_POST['class11'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class1'>Class 11</label>
                </div>
                <div class='col-sm-1'>
                    <input type="checkbox" name="class[]"  value='12' class="demo_check senior" <?php if(isset($_POST['class12'])){echo 'checked="checked"';}else{}?>> <br>
                    <label for='class2'>Class 12</label>
                </div>
            </div><br>
            <h1 class="body-header">Gender</h1>
            <div class="first-half-wrapper">
                <h1 class="first-header">Boy</h1>
                <input type="radio" name="gender" value="m"  id="gender" class="first-radio">
                <h1 class="first-header">Girl</h1>
                <input type="radio" name="gender" id="gender"  value="f" class="first-radio">
            </div><br>
            <h1 class="body-header">Open Time</h1>
            <h1 class="row-header">Weekly</h1>
            <div class="row justify-content-start main-row" style="margin-left:50px;">               
                <div class="col-3">
                    <input type="text" name="from" class="datepicker" id="from" value="" placeholder="From" required>
                </div>
                <div class="col-3">
                    <input type="text" name="to" class="datepicker" id="to" value="" placeholder="To" required>
                </div>
            </div>                
            <br>
            <div class="student_price">
                <h1 class="body-header">Price</h1>
                <div class="row justify-content-center">
                    <div class="col-4">
                        <h1 class="price-head">MRP</h1>
                        <h1 class="price-sub">₹ <?php if(isset($price)){echo $price;}else{}?></h1>
                    </div>
                    <div class="col-4">
                        <h1 class="price-head">School Offer</h1>
                        <h1 class="price-sub">₹ <?php if(isset($school_price)){echo $school_price;}else{}?></h1>
                    </div>
                    <div class="col-4">
                        <h1 class="price-head">Student Price</h1>
                        <input type="number" name="student_price" id="price" class="price__input" placeholder="Price" required>
                    </div>
                </div>
            </div>
            <div class="button-wrap">
            <input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
                    <input type="hidden" name="type" value="<?php echo $_POST['type'];?>">
                <button class="submit__btn" onclick="ajaxbackend()"><span id="buttonaction">Submit</span></button>
            </div>
        </div>
    </div>
    </form>
    </div>
    <div class="footer ">
        <div class="footerInner ">
            <h1>&copy; SPACEDTIMES</h1>
        </div>
    </div>
    
    <script>
        var primary_master = $('.primary_master');
        var secondary_master = $('.secondary_master');
        var sen_secondary_master = $('.sen_secondary_master');
        var senior_master = $('.senior_master');
        var primary = $('.primary');
        var secondary = $('.secondary');
        var sen_secondary = $('.sen_secondary');
        var senior = $('.senior');
        primary_master.on('change', function(){
        primary.prop('checked',this.checked);
        });
        secondary_master.on('change', function(){
            secondary.prop('checked',this.checked);
        });
        sen_secondary_master.on('change', function(){
            sen_secondary.prop('checked',this.checked);
        });
        senior_master.on('change', function(){
            senior.prop('checked',this.checked);
        });

    </script>
    <script language="javascript">



function ajaxbackend(){  
       //for checkboxes
       var checkboxes = document.getElementsByName('class[]');
    var vals = "";
    for (var i=0, n=checkboxes.length;i<n;i++) 
    {
        if (checkboxes[i].checked) 
        {
            vals += ","+checkboxes[i].value;
        }
    }
    if (vals) vals = vals.substring(1);
    var start =  $('#from').val();
    var end =  $('#to').val(); 
    var end =  $('#to').val(); 
    var price =  $('#price').val(); 
    
    if (start === '' || end === '' ||  price ===''){alert ("fill necessary fields !");}
    else {
//stop submit the form, we will post it manually.   
event.preventDefault();
// Get form
var form = $('#dep_form')[0];
// Create an FormData object 
var data = new FormData(form);
// If you want to add an extra field for the FormData
data.append("class", vals);
// disabled the submit button
$("#sub").prop("disabled", true);
$.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: "dep_back.php",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (data) {       
        console.log(data);
                            if (data=='success')
                        {alert('Published Successfully !');
                            //window.location.replace("http://http://www.testune.com/spacedtimes/club_coordinator/index.php");
                            window.history.back();
                        }
                        $("#submit").css({'background-color':'#2abfd4'});
                        $("#submit").html(data);                        
                        },
                        error: function (e) {           
                            console.log(e);
                        }
                    });}}
</script>
    <link rel="stylesheet " href="https://use.fontawesome.com/releases/v5.0.10/css/all.css " integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg "
        crossorigin="anonymous ">
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    <script>
        $(function () {
            $(".datepicker").datepicker();
        });
    </script>
</body>

</html>