<?php 
$inst_id=$_SESSION['inst_id'];
$get_club_q='select clubs.club_id, clubs.club_name from clubs inner join inst_club_assign on 
clubs.club_id =inst_club_assign.club_id where inst_club_assign.status="1" and clubs.status="1" and inst_club_assign.institute_id="'.$inst_id.'" UNION ALL
select club_id, club_name from school__clubs where status="1" and inst_id="'.$inst_id.'"';
$club_result = $conn->query($club_q);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
    <link rel="stylesheet" href="../../student_panel/assets/css/main.css">
    <style>
		body::after {
				content: "";
				display: block;
				height: 60px;
			}
			ul li{
				list-style:outside;
			}
		</style>
</head>

<body style="background-color: #981a35;
  padding: 0;
  margin: 0;
  position: relative;overflow: auto; ">
	<div class="limiter">
		<div class="container-login100">			
			<div class="wrap-login100 p-t-55 p-b-55" style="padding: 0;">
				<h1 class="wrap-login-header">Webinar Registration</h1>
				<h1 class="wrap-login-form-header">Create a New account here <br> World Class Co-Curriculars</h1>


				<form action="#" id="webinar" class="wrap-login__sc-form">
					<h1 class="inner_sc-form">School Details
						<span class="wrap-login_span">

						</span>
					</h1>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<div class="form-group">
								<input type="text" name="name" id="name" required="required" />
								<label for="input" class="control-label">Participant Name</label><i class="bar"></i>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
							<div class="form-group">
								<input type="text" name="school_name" id="school_name" required="required" />
								<label for="input" class="control-label">School Name</label><i class="bar"></i>
							</div>
						</div>
                    </div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<div class="form-group">
								<input type="text" name="des" id="des" required="required" />
								<label for="input" class="control-label">Designation</label><i class="bar"></i>
							</div>
						</div>						
                    </div>
                    <div class="row">
											
											<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
												<div class="form-group">
													<input type="text" name="email" id="email" required="required"/>
													<label for="input" class="control-label">Enter Email Address</label><i class="bar"></i>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
												<div class="form-group">
													<input type="text" name="phone" id="phone"  required="required" />
													<label for="input" class="control-label">Enter Phone Number</label><i class="bar"></i>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
												<div class="verify-wrapper">
													<button class="__btn" onclick="get_otp()" type="button" >
														<i class="fas fa-external-link-square-alt"></i> <span>Send OTP</span>
													</button>
												</div>
											</div>
						</div>
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
					 aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle"></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										
										<div class="row justify-content-center">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
												<div class="form-group">
													<input type="text" name="mob_otp" id="mob_otp" value="1" required="required" />
													<label for="input" class="control-label">Enter OTP Recieved On Phone</label><i class="bar"></i>
												</div>
											</div>
										</div>
										<div class="verify-wrapper">
											<button class="__btn--verify" onclick="verify()" type="button">
												<input type="hidden" id="status" value="1">
												<span>Verify One Time Password</span>
											</button>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Save Changes</button>
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="sc-btn" onclick="add_school()"><span>Submit</span></button>
					<a href="/" class="back-link">Home <i class="fas fa-home"></i></a>

				</form>
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
	<script language='javascript'>
		function get_otp(){
    var name= $('#name').val(); 
    var school_no= $('#school_no').val(); 
	if(name == '' || school_no == '')
    {
		alert('Please Enter Your Name and Phone No for Verification.');
        event.preventDefault();
	} else {            
                    event.preventDefault();            
                    var form = $('#webinar')[0];           
                    var data = new FormData(form);  
					data.append("action", "get_otp");                               
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "otp.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {   
                            console.log(data);                          
                            if (data=='success')
                        {   alert('OTP Sent ');
                            open(); 
                        }    
						else if (data=='present')
                        {   alert('Already Registered ');
                              
                        }                                                                                      
                        },
                        error: function (e) {    
							alert('Error in the system. Please try later');       
                            console.log(e);
                        }
                    });}
                }
		function open(){
            $(document).ready(function () {					
						$('#exampleModalCenter').modal('show');		
                    });   
                } 
				function verify(){   
				            
                    event.preventDefault();            
                    var form = $('#webinar')[0];           
                    var data = new FormData(form);  
					data.append("action", "verify");                               
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "otp.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {   
                            console.log(data);                          
                            if (data=='verified')
                        {   alert('Verified !');
							var s= document.getElementById("status");
                            s.value=1;
                            $(document).ready(function () {					
						$('#exampleModalCenter').modal('hide');					
				});
                        }else if(data=='notverified')
                        {alert('Error in the system. Please try it later');}
                                                                                               
                        },
                        error: function (e) {           
                            console.log(e);
                        }
                    });
				}

				function add_school(){   
	var name= $('#name').val(); 
	var status= $('#status').val(); 
    var phone= $('#phone').val(); 
	var des= $('#des').val();
	var mob_otp= $('#mob_otp').val();
	var school_name= $('#school_name').val();
	if(school_name == '' || phone == '' || name == ''
	|| mob_otp == ''|| des == '' || status != 1)
    {
		alert('Make sure you have filled all details and verified your contact. ');
        event.preventDefault();
	} else {            
                    event.preventDefault();            
                    var form = $('#webinar')[0];           
                    var data = new FormData(form);  
					data.append("action", "add");                               
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "main_back.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {   
                            console.log(data);                          
                            if (data=='success')
                        {   alert('Thank you for registering. Our team will get back to you shortly.');
                            location.reload();
						}   
						if (data=='present')
                        {   alert('You already have registred using same email id');
                        }	
						if(data=='error'){
							alert('Error in System. Could not Verify your Contact.');
						}					                                                                                             
                        },
                        error: function (e) { 
							alert('Error in System. Could not Verify your Contact.')   							       
                            console.log(e);
                        }
                    });
                }
						}
				
		function hide_field() {
			var type = $('#login_type').val();
			if (type == 'school_login') {
				$('#username').hide();
			}
			else {
				$('#username').show();
			}
		}//Close Modal
				
    </script>
    
			

</body>

</html>