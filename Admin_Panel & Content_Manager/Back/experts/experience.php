<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_POST['email'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    if(isset($_POST['fname'])){$fname=mysqli_real_escape_string($conn,$_POST['fname']);}else{$fname='';}
    if(isset($_POST['lname'])){$lname=mysqli_real_escape_string($conn,$_POST['lname']);}else{$lname='';}
    if(isset($_POST['dob'])){$dob=mysqli_real_escape_string($conn,$_POST['dob']);}else{$dob='';}
    if(isset($_POST['gender'])){$gender=mysqli_real_escape_string($conn,$_POST['gender']);}else{$gender='';}
    if(isset($_POST['address'])){$address=mysqli_real_escape_string($conn,$_POST['address']);}else{$address='';}
    if(isset($_POST['country'])){$country=mysqli_real_escape_string($conn,$_POST['country']);}else{$country='';}
    if(isset($_POST['pincode'])){$pincode=mysqli_real_escape_string($conn,$_POST['pincode']);}else{$pincode='';}    
    if(isset($_POST['phone1'])){$phone1=mysqli_real_escape_string($conn,$_POST['phone1']);}else{$phone1='';}
    if(isset($_POST['phone2'])){$phone2=mysqli_real_escape_string($conn,$_POST['phone2']);}else{$phone2='';}
    if(isset($_POST['password'])){$password=mysqli_real_escape_string($conn,$_POST['password']);}else{$password='';}
    $check_exists='select * from expert where email="'.$email.'"';
    $result=$conn->query($check_exists);
    if($result->num_rows > 0){
        echo '<script>alert("This email is already Registered");window.history.back();</script>';
    }
    else{
        $target_dir = "../assets/expert/";
        $f = basename($_FILES['file']["name"]);
        $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
        $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
        move_uploaded_file($_FILES['file']["tmp_name"], $target_dir.$file);  
        $dob=date('Y-m-d', strtotime($dob));    
        $query="INSERT INTO expert (fname,lname,dob,gender,address,country,pincode,phone1,phone2,email,password,photo)
        VALUES ('$fname','$lname','$dob','$gender','$address','$country','$pincode','$phone1','$phone2','$email','$password','$file');
        SELECT LAST_INSERT_ID();";
        if ($conn->multi_query($query))
        {       
            do {
                
                        if ($result = $conn->store_result()) 
                        {
                            while ($row = $result->fetch_row()) 
                            {               
                            $var = (string) $row[0];
                            }
                            
                            $id = 'exp_'.$var;
                            $query='UPDATE expert SET exp_id="'.$id.'" where sno="'.$var.'"';
                            if($conn->query($query)){
                                //ALLOW FILLING THIS PAGE     
                            }
                            else{
                                echo '<script>alert("Error in the System, please try later");window.history.back();</script>';
                            }
                            $result->free();
                
                        }  
                }
                while ($conn->next_result());
        }
        else{
            echo '<script>alert("Enter Email Address");window.history.back();</script>';
            
        }
    
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="main.1.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top display-block" id="navbar-hide" style="background-color:#17a2b8; color:#fff;">
        <a class="navbar-brand" href="http://www.wingxp.com">
            <span style="color: #fff !important; font-weight:1000; font-size: 32px;margin: 0;padding: 0;">wingxp</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://www.wingxp.com">Login</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="http://iclubs.in/school_registration.php">Sign Up</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="limiter">
        <div class="container-login100_two">
            <div class="wrap-login100_two">
                <div class="top_nav">
                    <div class="top_nav-common top_nav-one">
                        <h1 class="top_nav-header nav_header-one">Personal Details</h1>
                    </div>
                    <div class="top_nav-common top_nav-two">
                        <h1 class="top_nav-header nav_header-two">Your Expression</h1>
                    </div>
                    <div class="top_nav-common top_nav-three">
                        <h1 class="top_nav-header nav_header-three">Account/Billing Info</h1>
                    </div>
                </div>
                <h1 class="common-head">Select Your Area Of Expertise
                    <span>
                        <hr class="common-hr"></span>
                </h1>
                <form action="thankyou.php" method="POST" enctype="multipart/form-data" >
                <div class="row no-gutters gap-row">
                    <div class="col-2">
                        <label class="pure-material-checkbox checkbox-main">
                            <input type="checkbox" id='a' onclick="check('a');">
                            <span>IBPS PO </span>
                        </label>
                    </div>
                    <div class="col-10" id='a_sub'>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Quantitative Aptitude" onclick="check('a');">
                            <span>
                                Quantitative Aptitude</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Reasoning" onclick="check('a');">
                            <span> Reasoning</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Computer Knowledge" onclick="check('a');">
                            <span> Computer Knowledge </span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="General Awareness" onclick="check('a');">
                            <span>General Awareness</span>
                        </label>

                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="English" onclick="check('a');">
                            <span>English</span>
                        </label>
                    </div>
                </div>
                <div class="row no-gutters gap-row">
                    <div class="col-2">
                        <label class="pure-material-checkbox checkbox-main">
                            <input type="checkbox" id="b" onclick="check('b');">
                            <span>IBPS Clerk </span>
                        </label>
                    </div>
                    <div class="col-10" id='b_sub'>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Numerical Ability" onclick="check('b');">
                            <span>Numerical Ability</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Reasoning" onclick="check('b');">
                            <span> Reasoning</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Computer Knowledge" onclick="check('b');">
                            <span> Computer Knowledge </span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="General Awareness" onclick="check('b');">
                            <span>General Awareness</span>
                        </label>

                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="English" onclick="check('b');">
                            <span>English</span>
                        </label>
                    </div>
                </div>
                <div class="row no-gutters gap-row">
                    <div class="col-2">
                        <label class="pure-material-checkbox checkbox-main">
                            <input type="checkbox" id='c' onclick="check('c');">
                            <span>SBI PO </span>
                        </label>
                    </div>
                    <div class="col-10" id='c_sub'>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Data Analysis and Interpretation" onclick="check('c');">
                            <span>
                                Data Analysis and Interpretation</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Reasoning" onclick="check('c');">
                            <span> Reasoning</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Computer Knowledge" onclick="check('c');">
                            <span> Computer Knowledge </span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Marketing / Computers" onclick="check('c');">
                            <span> Marketing / Computers</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Quantitative Aptitude (Prelims Only)" onclick="check('c');">
                            <span> Quantitative Aptitude (Prelims Only)</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="General Awareness" onclick="check('c');">
                            <span> General Awareness</span>
                        </label>
                    </div>
                </div>
                <div class="row no-gutters gap-row">
                    <div class="col-2">
                        <label class="pure-material-checkbox checkbox-main">
                            <input type="checkbox" id='d' onclick="check('d');">
                            <span>SBI Clerk </span>
                        </label>
                    </div>
                    <div class="col-10">
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Quantitative Aptitude" onclick="check('d');">
                            <span>
                                Quantitative Aptitude</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Reasoning" onclick="check('d');">
                            <span> Reasoning</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Marketing Aptitude / Computer Knowledge" onclick="check('d');">
                            <span> Marketing Aptitude / Computer Knowledge </span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="General Awareness" onclick="check('d');">
                            <span> General Awareness</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Quantitative Aptitude (Prelims Only)" onclick="check('d');">
                            <span> Quantitative Aptitude (Prelims Only)</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="English" onclick="check('d');">
                            <span> English</span>
                        </label>
                    </div>
                </div>
                <div class="row no-gutters gap-row">
                    <div class="col-2">
                        <label class="pure-material-checkbox checkbox-main">
                            <input type="checkbox" id='e' onclick="check('e');">
                            <span>IBPS RRB </span>
                        </label>
                    </div>
                    <div class="col-10">
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Numerical Ability" onclick="check('e');">
                            <span>Numerical Ability</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Reasoning" onclick="check('e');">
                            <span> Reasoning</span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="Computer Knowledge" onclick="check('e');">
                            <span> Computer Knowledge </span>
                        </label>
                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="General Awareness" onclick="check('e');">
                            <span>General Awareness</span>
                        </label>

                        <label class="pure-material-checkbox">
                            <input type="checkbox" name="exp[]" value="English" onclick="check('e');">
                            <span>English</span>
                        </label>
                    </div>
                </div>
                <h1 class="common-head">Connect With Field
                    <span>
                        <hr class="common-hr"></span>
                </h1>
                <textarea name="connect" id="" placeholder="Write about your 'connect' with the Field (i.e whether you an author, content creator, teacher etc..) covering experience and exposure"
                    class="
                    text-area_exam"></textarea>

                <h1 class="common-head"> Add supporting file ( Some pre-exiting files related to experience / exposure
                    i.e portfolio, resume etc. )
                    <span>
                        <hr class="common-hr"></span>
                </h1>
                <div class="upload_new-wrap">
                    <div class="upload-btn-wrapper">
                        <button class="upload_btn">Upload a file</button>
                        <input type="file" name="file1" />
                    </div>
                    <div class="upload-btn-wrapper">
                        <button class="upload_btn">Upload a file</button>
                        <input type="file" name="file2" />
                    </div>
                    <div class="upload-btn-wrapper">
                        <button class="upload_btn">Upload a file</button>
                        <input type="file" name="file3" />
                    </div>
                </div>
                <h1 class="common-head">Social Links
                        <span>
                            <hr class="common-hr"></span>
                    </h1>
                    <div class="form-row">
                        <div class="col-md-6">                            
                            <input type="text" name="link1" class="form-control" placeholder="Linked In">
                            <input type="text" name="link2" class="form-control" placeholder="Facebook">
                            <input type="text" name="link3" class="form-control" placeholder="Twitter">
                            <input type="text" name="link4" class="form-control" placeholder="Other Links">
                            <input type="hidden" value="" id="list_exp" name="list_exp">
                            <input type="hidden" value="<?php if(isset($id)){echo $id;}?>" id="exp_id" name="exp_id">
                        </div>                        
                    </div>
                <button type="submit" class="submit-btn_new">Submit</button>
            </div>
        </form>
        </div><br><br>
        <div style="max-width: 100%;background-color: #696969;">
            <div class="footer">
                <div class="footer-width">
                    <div class="left-footer" style="text-align: left;" id="lab_social_icon_footer">
                        <i id="social-lk" class="fab fa-linkedin fa-2x social"></i></a>
                        <i id="social-fb" class="fab fa-facebook-square fa-2x social"></i></a>
                        <i id="social-tw" class="fab fa-twitter-square fa-2x social"></i></a>
                    </div>
                    <div class="center-footer">
                        &copy; Copyright – WingXP 2019
                    </div>
                    <div class="right-footer">
                        <a href="#">Privacy Policy</a> <span style="color: #fff;">|</span> <a href="#">Terms Of Use</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
</body>
<script>
    function check(e){
        if($('#'+e).prop('checked')==true){
            
        }
        else{
            $('#'+e+'_sub :input').prop("checked",false);
        }
        var checkboxes = document.getElementsByName('exp[]');
    var vals = "";
    for (var i=0, n=checkboxes.length;i<n;i++) 
    {
        if (checkboxes[i].checked) 
        {
            vals += ","+checkboxes[i].value;
        }
    }
    if (vals) vals = vals.substring(1);
    var s = document.getElementById('list_exp');
            s.value = vals;

    }
    
    </script>

</html>