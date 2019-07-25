
<?php
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['id'])){    
    $id = $_GET['id'];
    $q='select club_name,club_description,status,pres_post,pres_name,bearer_post,bearer_name,class,gender,from_date,to_date,message
    from school__clubs where club_id="'.$id.'"';
    $query = $conn->query($q); 
    $row=$query->fetch_array();
      $desc=$row['club_description'];
      $status=$row['status'];
      $gender=$row['gender'];
      $from_date=$row['from_date'];
      $name=$row['club_name'];
      $to_date=$row['to_date'];
      $message=$row['message'];
      $class = explode(",",$row['class']);

    
} 
else{
  
}
$get_club = 'SELECT club_coordinator_id ,name,phone_number from inst_club_coordinator where institute_id="'.$_SESSION['Userid'].'"';
$query = $conn->query($get_club); 
if($query->num_rows>0){
$flag=1;
}
else{
  $flag=0;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="main.css" />
    <link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"
    />
    <title>Aditya Birla Public School - School Dashboard</title>
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
            <a href="inst_dashboard.php" > 
            wingxp</a>
          </div>
          
        </div>
        <div class="side-nav-wrapper">
          <ul class="side-nav_list">
            <li>
              <i class="fas fa-graduation-cap side-icons fa-fw"></i>
              <a href="club.php" class="side-nav_links">Clubs Management </a>
            </li>
            <li>
              <i class="fas fa-user side-icons fa-fw"></i>
              <a href="add_class1.php" class="side-nav_links">Users Management </a>
            </li>
              <i class="fas fa-cog side-icons fa-fw"></i>
              <a href="#" class="side-nav_links">Settings</a>
            </li>                      
          </ul><br>
          <ul class="side-nav_list">            
            </li>              
              <a href="?q=logout" class="side-nav_links">Logout</a>
            </li>            
          </ul>
        </div>
       <div class="footer-wrap">
          <h1 class="copy-text">
            Copyright &copy; wingXP 2018 .All rights reserved
          </h1>
          <a href="#">Privacy Policy</a> <span>|</span> <a href="#">Feedback</a>
        </div>
      </div>
      <div class="main-content" style="min-height: 100vh;">
        <div class="right_topNav">
          <div class="inner-topNav">
            <div class="row no-gutters ">
              <div class="col-6">
                <div class="icon-wrap">
                  <h1 class="topNav_first">
                    Aditya Birla Public School <span> DASHBOARD </span>
                  </h1>
               
                </div>
              </div>
              
            </div>
          </div>
        </div>  <form id="school_club_form">
        <div class="form-new" <?php if(isset($flag) and $flag==0){echo 'style="background-color: #17a2b8; display: block;"';}else{echo 'style="background-color: #17a2b8; display: none;"';} ?>>
        <h1 class="row-head-new-two">No Coordinator Created. Please create a coordinator <a href='add_creator.php'>here</a></h1>
        </div>
        <div class="form-new" <?php if(isset($flag) and $flag==1){echo 'style="background-color: #17a2b8; display: block;"';}else{echo 'style="background-color: #17a2b8; display: none;"';} ?>>
    <input id="clubs" name="club_name" class="row-fields" placeholder="Club Name" value="<?php if(isset($name)){echo $name;}else{} ?>">
            <textarea name="club_desc" id="club_desc" cols="70" rows="4" placeholder="Description" style="resize: none;padding: 3px;"><?php if(isset($desc)){echo $desc;}else{} ?></textarea>
          <textarea name="message" id="message" cols="70" rows="4" placeholder="Coordinator's Message" style="resize: none;padding: 3px;"><?php if(isset($message)){echo $message;}else{} ?></textarea> 
         <div class="row">
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
                <input type="text" name="pres_name" id="pres_name" value=""  placeholder="Full Name" class="row-fields">
            </div>
            <div class="col-4">
                <input type="text" name="bearer_name" id="bearer_name" value=""  placeholder="Full Name" class="row-fields">
            </div>
        </div>
        <h1 class="row-head-new-two">Class Selection (Same as in Deploy Table)</h1>
        <form id="dep_form">
            <div class="body__wrapper">
        <div class="my-container">
           <div class="first-half-wrapper">
            <h1 class="row-head-new-two new-two">Primary</h1>
            <div class="checkbox new-check">
              <label style="margin: 0">
                Select All  <input
                  type="checkbox"
                  id="secondary"
                  class="first-half__check secondary_master"/><span
                  class="checkbox-material"
                  ><span class="check"></span> </span
              ></label>
            </div>
          </div>
          <div class="check-row">            
            <div class="checkbox new-check">
              <label style="margin: 0">
                <input                   type="checkbox"
                  name="class[]"
                  value="6"
                  class="demo_check secondary" <?php if(isset($class) and in_array('6',$class)){echo 'checked';}else{} ?>
                /><span class="checkbox-material"
                  ><span class="check"></span></span
                ><br />
                <span>Class 6</span>
              </label>
            </div>
            <div class="checkbox new-check">
              <label style="margin: 0">
                <input                   type="checkbox"
                  name="class[]"
                  value="7"
                  class="demo_check secondary" <?php if(isset($class) and in_array('7',$class)){echo 'checked';}else{} ?>
                /><span class="checkbox-material"
                  ><span class="check"></span></span
                ><br />
                <span>Class 7</span>
              </label>
            </div>
            <div class="checkbox new-check">
              <label style="margin: 0">
                <input                   type="checkbox"
                  name="class[]"
                  value="8"
                  class="demo_check secondary" <?php if(isset($class) and in_array('8',$class)){echo 'checked';}else{} ?>
                /><span class="checkbox-material"
                  ><span class="check"></span></span
                ><br />
                <span>Class 8</span>
              </label>
            </div>
          </div>
        </div>
          <br />

          <div class="first-half-wrapper">
            <h1 class="row-head-new-two new-two">Secondary</h1>
            <div class="checkbox new-check">
              <label style="margin: 0">
                Select All  <input
                  type="checkbox"
                  id="sen_secondary"
                  class="first-half__check sen_secondary_master"/><span
                  class="checkbox-material" 
                  ><span class="check"></span> </span
              ></label>
            </div>
          </div>
          <div class="check-row">
            <div class="checkbox new-check">
              <label style="margin: 0">
                <input                   type="checkbox"
                  name="class[]"
                  value="9"
                  class="demo_check sen_secondary" <?php if(isset($class) and in_array('9',$class)){echo 'checked';}else{} ?>
                /><span class="checkbox-material" 
                  ><span class="check"></span></span
                ><br />
                <span>Class 9</span>
              </label>
            </div>
            <div class="checkbox new-check">
              <label style="margin: 0">
                <input                   type="checkbox"
                  name="class[]"
                  value="10"
                  class="demo_check sen_secondary" <?php if(isset($class) and in_array('10',$class)){echo 'checked';}else{} ?>
                /><span class="checkbox-material"
                  ><span class="check"></span></span
                ><br />
                <span>Class 10</span>
              </label>
            </div>
          </div>
        </div>
          <div class="first-half-wrapper">
            <h1 class="row-head-new-two new-two">Senior Secondary</h1>
            <div class="checkbox new-check">
             Select All <label style="margin: 0">
                <input
                  type="checkbox"
                  id="senior"
                  class="first-half__check senior_master"/><span
                  class="checkbox-material"
                  ><span class="check"></span> </span
              ></label>
            </div>
          </div>
          <div class="check-row">
            <div class="checkbox new-check">
              <label style="margin: 0">
                <input                   type="checkbox"
                  name="class[]"
                  value="11"
                  class="demo_check senior" <?php if(isset($class) and in_array('11',$class)){echo 'checked';}else{} ?>
                /><span class="checkbox-material"
                  ><span class="check"></span></span
                ><br />
                <span>Class 11</span>
              </label>
            </div>
            <div class="checkbox new-check">
              <label style="margin: 0">
                <input                   type="checkbox"
                  name="class[]"
                  value="12" 
                  class="demo_check senior" <?php if(isset($class) and in_array('12',$class)){echo 'checked';}else{} ?>
                /><span class="checkbox-material"
                  ><span class="check"></span></span
                ><br />
                <span>Class 12</span>
              </label>
            </div>
          </div>

          <h1 class="row-head-new-two">Gender</h1>
          <div class="first-half-wrapper">
            <h1 class="row-head-new new-radio-text">Boy</h1>
            <input               type="radio"
              name="gender"
              value="m"
              id="gender"
              class="first-radio" <?php if(isset($gender) and $gender=='m'){echo 'checked';}else{} ?>
            />
            <h1 class="row-head-new new-radio-text">Girl</h1>
            <input               type="radio"
              name="gender"
              id="gender"
              value="f"
              class="first-radio" <?php if(isset($gender) and $gender=='f'){echo 'checked';}else{} ?>
            />
            <h1 class="row-head-new new-radio-text">Both</h1>
            <input               type="radio"
              name="gender"
              id="gender"
              value="b"
              class="first-radio" <?php if(isset($gender) and $gender=='b'){echo 'checked';}else{} ?>
            />
          </div>
          <br />
          <h1 class="row-head-new-two">Open Time</h1>
          <div class="weekly-row">
          <h1 class="row-head-new weekly-row-text">Weekly</h1>
              <input
                type="text"
                name="from"
                class="datepicker"
                id="from"
                placeholder="From DD/MM/YYYY"
                required=""
                autocomplete="off" value="<?php if(isset($from_date)){echo $from_date;}else{} ?>"
              />
            <span style="color:white">TO</span>
            <div class="col-5">
              <input
                type="text"
                name="to"
                class="datepicker"
                id="to"
                placeholder="To DD/MM/YYYY"
                required=""
                autocomplete="off" value="<?php if(isset($to_date)){echo $to_date;}else{} ?>"
              />
            </div>
          </div>
          <br />
          <h1 class="row-head-new-two">Status</h1>
          <div class="first-half-wrapper">
            <h1 class="row-head-new new-radio-text">Enabled</h1>
            <input               type="radio"
              name="status"
              value="1"
              id="status"
              class="first-radio" <?php if(isset($status) and $status==1){echo 'checked';}else{} ?>
            />
            <h1 class="row-head-new new-radio-text">Disabled</h1>
            <input               type="radio"
              name="status"
              id="status"
              value="0"
              class="first-radio" <?php if(isset($status) and $status==0){echo 'checked';}else{} ?>
            />
          </div>
          <br />
          <div class="button-wrap">
              <input type="hidden" name="action" <?php if(isset($id)){echo 'value="update"';}else{ echo 'value="publish"';} ?> />
              <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{} ?>" />
              <button class="submit__btn" id="submit" onclick="ajaxbackend()">
                <span id="buttonaction">Submit</span>
              </button>
            </div>
        </div>
        </div>
      </div>
    </div>
        </div>
    </div>
    </form>
    </div>
   
</body>
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

        $(document).ready( get_detail());
function get_detail(){
    $.ajax({
						  type: 'GET',
						  url: 'get_detail.php?action=main',
						  data: '',
						  success: function(response){                
                            var res = JSON.parse(response); 
                            $('#pres_post').html(res[0][0]);
                            $('#bearer_post').html(res[1][0]);
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
                console.log(response);
                            var res = JSON.parse(response);  
                            $('#pres_name').val(res[0]);
                            $('#bearer_name').val(res[1]);
						  } 
					       });

}

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
    var club_name =  $('#club_name').val();
    var club_desc =  $('#club_desc').val();
    var coord_post = $('#coord_post').val(); 
    var coord_name = $('#coord_name').val();
    var pres_post = $('#pres_post').val();
    var pres_name = $('#pres_name').val();
    var bearer_post = $('#bearer_post').val();
    var bearer_name = $('#bearer_name').val();

    if (start === '' || end === '' || club_name === '' ||  club_desc === '' ||  coord_post === '' ||
      coord_name === '' ||  pres_post === '' ||  pres_name === '' ||  bearer_post === '' ||  bearer_name === '' )
      {alert ("Fill necessary fields !");
      event.preventDefault();}
    else {
//stop submit the form, we will post it manually.   
event.preventDefault();
// Get form
var form = $('#school_club_form')[0];
// Create an FormData object 
var data = new FormData(form);
// If you want to add an extra field for the FormData
data.append("class", vals);
$.ajax({
    type: "POST",
    enctype: 'multipart/form-data',
    url: "school_club_back.php",
    data: data,
    processData: false,
    contentType: false,
    cache: false,
    timeout: 600000,
    success: function (data) {       
        console.log(data);
                            if (data=='success')
                        {alert('Club Created Successfully !');
                            window.location.replace("./club.php");
                            $("#submit").css({'background-color':'#2abfd4'});
                        $("#submit").html(data); 
                        }
                        if (data=='updated')
                        {alert('Club Updated Successfully !');
                            window.location.replace("./club.php");
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