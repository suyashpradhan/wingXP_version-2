
<?php
session_start();
//$_SESSION['club_id']="club_app";
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $vid_up = "SELECT description_line,description, duration, learning, vendor_id, school_price,mrp_price,class_applicable_for,subscription_level from live_course where course_id= '$id'";
    $result = $conn->query($vid_up);

    while($row = $result->fetch_array())
    {    
     $description_line = $row['description_line'];
     $description = $row['description'];
     $duration =$row['duration'];
     $learning = $row['learning'];
     $vendor_id =$row['vendor_id'];
     $price =$row['mrp_price'];
     $class = explode(",",$row['class_applicable_for']);
     $sub = $row['subscription_level'];
     $school_price =$row['school_price'];
    
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
    <link rel="stylesheet" href="http://www.testune.com/spacedtimes/club_coordinator/main.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
</head>

<body>

    <div class="navigationBar">
        <div class="logoBox">
            <h1 class="logoBox-header">SPACETIMES
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
    <div class="page">
        <div class="course-section">
            <div class="course__input">
            <form id="fileUploadForm" enctype="multipart/form-data" >
                <input type="text" value="<?php if(isset($description_line)){echo $description_line;}else{}?>" name="course" id="" placeholder="Course Name" class="course__field">
            </div>
            <a href="#" class="change-course">Change Course</a>
        </div>
        <div class="description__section">
            <div class="first-section">
                <h4 style="color: #000">First Section
                </h4>
            </div>
            <div class="second-section">
                <textarea name="editor1" class="description_textarea"><?php if(isset($description)){echo $description;}else{}?></textarea>
            </div>
        </div>
        <div class="text-section">
        <div class="inner_text" style="">
        
        <div class='row '>
                <div class=''>
                <h1 class="">Class Applicable for: </h1>
                </div>
                <div class=''>
                    <input type="checkbox" name="class[]" value='6' <?php if(isset($class)){echo (in_array("6",$class)) ? 'checked="checked"' : '';}else{}?> class="demo_check secondary secondary"> <br>
                    <label for='class1'>Class 6</label>
                </div>
                <div class=''>
                    <input type="checkbox" name="class[]"  value="7"  <?php if(isset($class)){echo (in_array("7",$class)) ? 'checked="checked"' : '';}else{}?>  class="demo_check secondary"> <br>
                    <label for='class2'>Class 7</label>
                </div>
                <div class=''>
                    <input type="checkbox" name="class[]"  value='8'  <?php if(isset($class)){echo (in_array("8",$class)) ? 'checked="checked"' : '';}else{}?>  class="demo_check secondary"> <br>
                    <label for='class3'>Class 8</label>
                </div>
                <div class=''>
                    <input type="checkbox" name="class[]"  value='9'  <?php if(isset($class)){echo (in_array("9",$class)) ? 'checked="checked"' : '';}else{}?>  class="demo_check secondary"> <br>
                    <label for='class3'>Class 9</label>
                </div>
                <div class=''>
                    <input type="checkbox" name="class[]"  value='10'  <?php if(isset($class)){echo (in_array("10",$class)) ? 'checked="checked"' : '';}else{}?>  class="demo_check secondary"> <br>
                    <label for='class3'>Class 10</label>
                </div>
                <div class=''>
                    <input type="checkbox" name="class[]"  value='11'  <?php if(isset($class)){echo (in_array("11",$class)) ? 'checked="checked"' : '';}else{}?>  class="demo_check secondary"> <br>
                    <label for='class3'>Class 11</label>
                </div>
                <div class=''>
                    <input type="checkbox" name="class[]"  value='12'  <?php if(isset($class)){echo (in_array("12",$class)) ? 'checked="checked"' : '';}else{}?>  class="demo_check secondary"> <br>
                    <label for='class3'>Class 12</label>
                </div>
                </div> </div>
                <div class="inner_text-sub" style="">
                <div class=''>
                <h1 class="">Subscription Level </h1>
                </div>
                <div class='inner_text-sub'>                
                <input type="radio" name="sub" value="silver"  id="" class=""  <?php if(isset($sub)){echo ($sub=='silver') ? 'checked="checked"' : '';}else{}?>>
                <label for='sub'>Silver</label>
                </div>
                <div class='inner_text-sub'>
                <input type="radio" name="sub" value="gold"  id="" class="" <?php if(isset($sub)){echo ($sub=='gold') ? 'checked="checked"' : '';}else{}?>>
                <label for='sub'>Gold</label>
                </div>
                <div class='inner_text-sub'>
                <input type="radio" name="sub" value="platinum"  id="" class="" <?php if(isset($sub)){echo ($sub=='platinum') ? 'checked="checked"' : '';}else{}?>>
                <label for='sub'>Platinum</label>
                </div>
            </div>
            </div><br>
        <div class="duration">
            <input type="text" value="<?php if(isset($duration)){echo $duration;}else{}?>"  name="duration" id="duration" placeholder="Duration" class="duration_field">
        </div>
        <div class="select-section">
            <h5>What Will I Get?
            </h5>
            <div class="second-section">
                <textarea name="editor2" class="description_textarea"><?php if(isset($learning)){echo $learning;}else{}?></textarea>
            </div>
        
        </div>
        <div class="text-section">
            
            <div class="vendor_wrapper">
            
            <select id="vendor" name="vendor" class="vendor__select">
                <?php 
                    $v=$conn->query("select vendor_id,vendor_name from vendor where 1");
                    $vs=mysqli_num_rows($v);
                    if($vs > '0'){ 
                        while($v1=mysqli_fetch_array($v)){
                                  if(isset($vendor_id) && $vendor_id== $v1[0]){?>
                        <option value='<?php echo $v1[0]; ?>' selected><?php echo $v1[1]; ?></option> 
                   <?php   }  else{?>
                       <option value='<?php echo $v1[0]; ?>'><?php echo $v1[1]; ?></option>
                 <?php  }
                    ?>
                             <?php }
                    }
                     else { ?>
                         <option  disabled="disabled" selected>No Vendors</option>   
                    <?php } $conn->close();?>
                </select>               
            <div class="inner_text" style="margin:10px">
            <input type="text" value="<?php if(isset($price)){echo $price;}else{}?>" name="mrp_price" id="price" placeholder="MRP Price" class="price_field">
            </div>
            <div class="inner_text" style="margin:10px">
            <input type="text" value="<?php if(isset($price)){echo $school_price;}else{}?>" name="school_price" id="school_price" placeholder="School Price" class="price_field">
            </div>
        </div>
            
        </div>
        <div class="upload-wrapper">
            <button type="button" class="upload__btn" data-toggle="modal" data-target="#exampleModal">
                UPLOAD FILE <i class="fas fa-cloud-upload-alt"></i>
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Your File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                                <label for="">Upload Primary Image</label>
                                <input type="file" name="primary" id="primary"><br><br>                                 
                                <label for="">Upload Secondary Image</label>
                                <input type="file" name="secondary" id="secondary"><br><br>                                
                                <label for="">Upload Icon</label><br>
                                <input type="file" name="icon" id="icon">              
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="deploy-wrapper">
        <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>"> 
            <input type="hidden" name="action" <?php if(isset($id)){echo 'value="update"';}else{echo 'value="publish"';}?>>
            <button name="submit" value="submit" id="submit" type="submit" onclick="ajaxbackend()" class="p__btn">Publish</button>
        </div>              <p id="msg"></p>
        </form>
    </div></div>
    <div class="footer ">
        <div class="footerInner ">
            <h1>TESTUNE TECHNOLOGY PVT LTD</h1>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"  crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
       crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
       crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
       crossorigin="anonymous"></script>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    for (instance in CKEDITOR.instances) { CKEDITOR.instances[instance].updateElement(); }
    var course= $('#course').val(); 
    var duration= $('#duration').val(); 
    var editor2= $('#editor2').val(); 
    var editor1= $('#editor1').val(); 
    var price= $('#price').val(); 
    var school_price= $('#school_price').val(); 
    var vendor= $('#vendor').val(); 
          
           if(course == '' || duration == '' ||  editor1 == '' || editor2 == '' || price == '' || vendor == '' || school_price == '' || vals == '')
                  {
		        alert('Please make sure all fields are filled.');
                event.preventDefault();
		  } else {
            if($('[name=sub]:checked').length){
                        event.preventDefault();
                        var form = $('#fileUploadForm')[0];
                    var data = new FormData(form);
                    data.append("class", vals);    
                    $("#sub").prop("disabled", true);
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "course_back.php",
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
                        }else if(data=='updated')
                        {
                            alert('Updated Successfully !');
                            $("#submit").html('Updated');
                        }
                        $("#submit").css({'background-color':'#2abfd4'});                                                
                        },
                        error: function (e) {           
                            console.log(e);
                        }
                    });
                    }
                    else{alert('Choose Subscription');
                                event.preventDefault();
                }}}
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