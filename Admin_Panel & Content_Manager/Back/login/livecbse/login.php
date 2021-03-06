<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <section class="navigation">
        <div class="nav-container">
            <div class="brand">
                <a href="#">
                    <img alt="" height="40px" src="../../dist/assets/images/livecbse_logo.png" />
                </a>
            </div>
            <nav>
                <div class="nav-mobile">
                    <a href="#!" id="nav-toggle"><span></span></a>
                </div>
                <ul class="nav-list">
                    <li>
                        <a href="#!">Physics</a>
                        <ul class="nav-dropdown">
                            <li>
                                <a href="#!">Chemistry</a>
                            </li>
                            <li>
                                <a href="#!">Mathematics</a>
                            </li>
                            <li>
                                <a href="#!">Biology</a>
                            </li>
                            <li>
                                <a href="#!">English</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    <div class="form__section">
        <div class="div-container" id="container">
            <div class="form-container sign-up-container">
                <form action="#" id="sign-up" class="__form">
                    <h1>Create Account</h1>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-inputs" />                    
                    <input type="text" maxlength="10" name="phone" id="phone" placeholder="Phone Number" class="form-inputs" />
                    <input type="password" name="password" id="password" placeholder="Password" class="form-inputs" />
                    <select name="class" id="class" class="form-select">
                        <option value="9">Class IX</option>
                        <option value="10">Class X</option>
                        <option value="11">Class XI</option>
                        <option value="12">Class XII</option>
                    </select>
                    <select name="country" id="country" class="form-select">
                        <option value="in" selected>India</option>
                        <option value="au">Australia </option>
                    </select>
                    <button class="sign_up" onclick="get_otp()">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="#" id="log-in" class="__form">
                    <h1>Sign in</h1>
                    <input type="text" name="phone" placeholder="Phone" class="form-inputs" />
                    <input type="password" name="password" placeholder="Password" class="form-inputs" />
                    <button class="sign_up" onclick="login()">Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, User!</h1>
                        <p>Enter your personal details and get started with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
        function login(){
            event.preventDefault();            
                    var form = $('#log-in')[0];           
                    var data = new FormData(form);  
		    data.append("login", "user");                   
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "auth.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {   
                            console.log(data);                          
                            if (data=='success')
                        {   
                            location.replace('index.html');	
                        }
                        else if(data=='error')
                        {
                            alert('Invalid Credentials');
                                                                                               
                        }
                        else{
                            window.scrollTo(0,0);
                            $('#system').show();
                        }},
                        error: function (e) {   
                            window.scrollTo(0,0);
                            $('#system').show();        
                            console.log(e);
                        }
                    });
        }
        function verify(){   
            var otp = $('#mob_otp').val(); 
		    event.preventDefault();            
                    var form = $('#sign-up')[0];           
                    var data = new FormData(form);  
		    data.append("action", "verify");        
            data.append("mob_otp",otp);                      
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "auth.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {   
                            console.log(data);                          
                            if (data=='verified')
                        {   
                            location.replace('index.html');	
                        }
                        else if(data=='notverified')
                        {
                            window.scrollTo(0,0);
                            $('#system').show();
                                                                                               
                        }
                        else{
                            window.scrollTo(0,0);
                            $('#system').show();
                        }},
                        error: function (e) {   
                            window.scrollTo(0,0);
                            $('#system').show();        
                            console.log(e);
                        }
                    });
				}

                function get_otp(){
    var name= $('#name').val(); 
    var phone= $('#phone').val(); 
	var class_sel= $('#class').val();
    var country= $('#country').val();
    var password= $('#password').val();
	if(name == '' || phone == '' || class_sel == '' || country == '' || password == '') 
       {
        alert('Fill all fields');
		window.scrollTo(0,0);
        $('#verification').show();
                event.preventDefault();
	} else {            
                    event.preventDefault();            
                    var form = $('#sign-up')[0];           
                    var data = new FormData(form);  
					data.append("action", "get_otp");                               
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "auth.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {   
                         console.log(data);                          
                       if (data=='success')
                        {   
                            open(); 
                        }    
			else if (data=='present')
                        {   window.scrollTo(0,0);
                        alert('Invalid / Already Present');
                            //$('#already').show();
                              
                        }                                                                                      
                        },
                        error: function (e) {    
                            window.scrollTo(0,0);
                            $('#system').show();    
                            console.log(e);
                        }
                    });}
                }
		function open(){
            $(document).ready(function () {					
						$('#otp-modal').modal('show');		
                    });   
                } 

    </script>
    <!-- The Modal -->
  <div class="modal" id="otp-modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Verification</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="container-fluid">
										
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
												<div class="form-group">
													<input type="text" name="mob_otp" id="mob_otp" required="required" />
													<label for="input" class="control-label">Enter OTP Received On Phone</label><i class="bar"></i>
                                                </div>
                                                <button class="sign_up" onclick="verify()" type="button">
												<input type="hidden" id="status" value="0">
												<span>Verify One Time Password</span>
											    </button>
											</div>
                                            
										</div>
											
									</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
</body>

</html>