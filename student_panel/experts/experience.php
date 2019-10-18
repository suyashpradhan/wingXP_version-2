<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>WingXP Expertise - Experience Detail</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/main.1.css">
    <link rel="stylesheet" href="../assets/css/main_blue.css">

    <style>
        .bounce {
            display: none !important;
        }
     
        ::placeholder {
			font-size: 16px;
			font-weight:500 !important;
        }
         .form-group {
            margin: 15px 0 !important;
        }
        .__btn {
			margin: 6px 0 0 0;
			width: 100%;
			height: 40px;
			font-weight:500;
		}
  
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light navbar__mobile-hide" id="navbar-hide" style="background-color:#006666;">
           <a class="navbar-brand" href="http://www.wingxp.com">
                <span
                    style="font-weight:500; font-size: 26px;margin: 0;padding: 0; color:#66cc33">wing<span style="color:#ffcc00; font-size: 26px;font-weight:500">xp<span></span></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto" style="color:#fff;">
                    <li class="nav-item active">
                        <a class="nav-link" href="https://www.wingxp.com" style="color:#66cc33;
                        font-size: 18px;
                        font-weight: 400;">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropbtn" href="#" style="color: #66cc33;
                            font-size: 18px;
                            font-weight: 400;">Expert</a>
                            <div class="dropdown-content">
                                <a href="https://www.wingxp.com/expertise/login.php">Login</a>
                                <a href="https://www.wingxp.com/expertise">Join Us</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropbtn" href="#" style="color: #66cc33;
                            font-size: 18px;
                            font-weight: 400;">School</a>
                            <div class="dropdown-content">
                                <a href="https://www.wingxp.com/login/register_now.php">Register Now</a>
                                <a href="https://www.wingxp.com/login">Login </a>
                            </div>
                        </div>
                    </li>
                     <li class="nav-item ">
                       <div class="dropdown">
                        <a class="nav-link" href="http://www.wingxp.com/login" style="color:#66cc33;
                        font-size: 18px;
                        font-weight: 400;">Student </a>
                           <div class="dropdown-content">
                           <a href="https://www.wingxp.com/login/student_login.php">Login</a>
                        </div>
                       </div>
                    </li>
                </ul>
            </div>
        </nav>

    <div class="limiter">
        <div class="container-login100_two">
            <div class="wrap-login100_two">
                <div class="top_nav">
                    <div class="top_nav-common top_nav-two">
                        <h1 class="top_nav-header nav_header-two">Personal Details</h1>
                    </div>
                    <div class="top_nav-common top_nav-one">
                        <h1 class="top_nav-header nav_header-one">Your Expression</h1>
                    </div>
                 </div>
                <h1 class="common-head">Select Your Area Of Expertise

                </h1>
                <form action="thankyou.php" method="POST" enctype="multipart/form-data">
                   <div class="form__card">
                    <div class="row ">
                        <div class="col-xs-6 col-md-4 col-lg-4">
                            <select class="form-control" name="exp" required="" style="border-radius:0px">
                                <option value="">Choose a Relevant Field</option>
                                <option value="Digital Design">Digital Design</option>
                                <option value="Tech Talk">Tech Talk</option>
                                <option value="Smarter Minds">Smarter Minds</option>
                                <option value="Digital Design">Environment</option>
                                <option value="Tech Talk">Coding</option>
                                <option value="Smarter Minds">Astronomy</option>
                                <option value="Digital Design">Language</option>
                                <option value="Tech Talk">Understanding News</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-xs-6 col-md-4 col-lg-4">
                            <input type="text" name="language" placeholder="Enter Your Specialisation" class="form-control" required=""  style="border: 1px solid #ccc;
                                                    padding: 5px 8px;
                                                    height: 40px;
                                                    border-radius: 0;
                                                    background-color: #fff;
                                                    color: black;">
                        </div>
                    </div>
                </div>                

                <h1 class="common-head">Connect With Field
                    <span>
                        <hr class="common-hr"></span>
                </h1>
                <div class="form__card">
                    <textarea name="connect" id="" placeholder="Write about your 'connect' with the Field (i.e whether you an author, content creator, teacher etc..) covering experience and exposure" class="
                        text-area_exam" required=""></textarea>
                </div>

                <h1 class="common-head"> Add supporting file ( Some pre-exiting files related to experience / exposure
                    i.e portfolio, resume etc. )
                    <span>
                        <hr class="common-hr"></span>
                </h1>
                <div class="form__card">
                    <div class="upload_new-wrap">
                        <input type="file" name="file1" class="form-control-file " >
                        <input type="file" name="file2" class="form-control-file ">
                        <input type="file" name="file3" class="form-control-file ">
                    </div>
                </div>
                <h1 class="common-head">Social Links
                        <span>
                            <hr class="common-hr"></span>
                    </h1>
                     <div class="form__card">
                    <div class="form-row">
                        <div class="col-md-6">
                            <input type="text" name="link1" class="form-control" placeholder="Linked In" style="border: 1px solid #ccc;
                                                    padding: 5px 8px;
                                                    height: 40px;
                                                    border-radius: 0;
                                                    background-color: #fff;
                                                    color: black;">
                            <input type="text" name="link2" class="form-control" placeholder="Facebook" style="border: 1px solid #ccc;
                                                    padding: 5px 8px;
                                                    height: 40px;
                                                    border-radius: 0;
                                                    background-color: #fff;
                                                    color: black;">

                        </div>
                        <div class="col-md-6">
                            <input type="text" name="link3" class="form-control" placeholder="Twitter" style="border: 1px solid #ccc;
                                                    padding: 5px 8px;
                                                    height: 40px;
                                                    border-radius: 0;
                                                    background-color: #fff;
                                                    color: black;">
                            <input type="text" name="link4" class="form-control" placeholder="Other Links" style="border: 1px solid #ccc;
                                                    padding: 5px 8px;
                                                    height: 40px;
                                                    border-radius: 0;
                                                    background-color: #fff;
                                                    color: black;">
                            <input type="hidden" value="" id="list_exp" name="list_exp">
                            <input type="hidden" value="exp_3" id="exp_id" name="exp_id">
                        </div>
                    </div>
                </div>
                     
                <button type="submit" class="submit-btn_new">Submit</button>
            </form></div>
        
        </div><br><br>
          <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #17a2b8;border-bottom: none">
                    <h5 class="mod-title" id="exampleModalLabel">Contact Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 30px;"><i class="fas fa-times-circle" style="margin-top: 15px;  color: #fff;"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                        <div class="row">
                           <form id="demo_detail" action="verify.php" method="POST" class="demo_new-wrap">
                                <div class="form-group">
                                        <select name="department" id="department" class="form-control">
                                            <option value="School">I am a School</option>  
                                            <option value="Individual">I am an Individual</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Name" required="required">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="sname" id="sname" placeholder="School Name" required="required">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="tel" name="phone" id="phone" placeholder="Phone" pattern="[1-9]{1}[0-9]{9}" title="Enter a valid 10 digit mobile number" required="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="submit-modal-btn">Get OTP</button>
                                </div>                                
                            </form>
                            
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>


<script>
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function () {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar-hide").style.top = "0";
            } else {
                document.getElementById("navbar-hide").style.top = "-60px";
            }
            prevScrollpos = currentScrollPos;
        }
      
        /* $(window).scroll(function () {
            if ($(window).scrollTop() > (window.innerHeight)) {
                $('#navbar-hide').hide();
            } else {
                $('#navbar-hide').show();
            }
        }); */
 </script>    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy " crossorigin="anonymous "></script>

</body></html>