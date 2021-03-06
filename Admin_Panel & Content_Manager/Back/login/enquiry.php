<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/main.css">
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
				<h1 class="wrap-login-header">New User</h1>
				<h1 class="wrap-login-form-header">Create A New Account Here!</h1>


				<form action="#" id="enquiry" class="wrap-login__sc-form">
					<h1 class="inner_sc-form">School Details
						<span class="wrap-login_span">

						</span>
					</h1>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<div class="form-group">
								<input type="text" name="school_name" id="school_name" required="required" />
								<label for="input" class="control-label">School Name</label><i class="bar"></i>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
							<div class="form-group">
								<input type="text" name="school_add" id="school_add" required="required" />
								<label for="input" class="control-label">School Address</label><i class="bar"></i>
							</div>
						</div>
                    </div>
                    <div class="row">
											<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
												<div class="form-group">
													<input type="text" name="school_no" id="school_no"  required="required" />
													<label for="input" class="control-label">Enter School Phone Number</label><i class="bar"></i>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
												<div class="form-group">
													<input type="text" name="school_email" id="school_email" required="required" />
													<label for="input" class="control-label">Enter School Email Address</label><i class="bar"></i>
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
									<h5 class="modal-title" id="exampleModalLongTitle">hkjbnkj</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										
										<div class="row justify-content-center">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
												<div class="form-group">
													<input type="text" name="mob_otp" id="mob_otp" required="required" />
													<label for="input" class="control-label">Enter OTP Recieved On Phone</label><i class="bar"></i>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
												<div class="form-group">
													<input type="text" name="email_otp" id="email_otp" required="required" />
													<label for="input" class="control-label">Enter OTP Recieved On Email Address</label><i class="bar"></i>
												</div>
											</div>
										</div>
										<div class="verify-wrapper">
											<button class="__btn--verify" onclick="verify()" type="button">
												<input type="hidden" id="status" value="0">
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

					<h1 class="inner_sc-form">Principal Details
						<span class="wrap-login_span">

						</span>
					</h1>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<div class="form-group">
								<input type="text"  name="prin_name" id="prin_name" required="required" />
								<label for="input" class="control-label">Name</label><i class="bar"></i>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<div class="form-group">
								<input type="text" name="prin_phone" id="prin_phone" required="required" />
								<label for="input" class="control-label">Phone Number</label><i class="bar"></i>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<div class="form-group">
								<input type="text"  name="prin_email" id="prin_email" required="required" />
								<label for="input" class="control-label">Email Address</label><i class="bar"></i>
							</div>
						</div>
					</div>
					<p class="terms">
					<input type="checkbox" id="terms">
					By continuing you agree to our <a href="" data-toggle="modal" data-target="#exampleModalLong" class="terms-link">terms and conditions.</a></p>
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
    var school_name= $('#school_name').val(); 
    var school_no= $('#school_no').val(); 
	var school_email= $('#school_email').val();
	if(school_name == '' || school_no == '' || school_email == '')
    {
		alert('Please Enter School Name, Email and Mobile No for Verification.');
        event.preventDefault();
	} else {            
                    event.preventDefault();            
                    var form = $('#enquiry')[0];           
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
                        {   alert('OTP Sent on Email and Mobile ');
                            open(); 
                        }    
						else if (data=='present')
                        {   alert('Email Already Registered ');
                              
                        }                                                                                      
                        },
                        error: function (e) {    
							alert('Error in the system. Please try it later');       
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
                    var form = $('#enquiry')[0];           
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
	var school_name= $('#school_name').val(); 
    var school_no= $('#school_no').val(); 
	var school_email= $('#school_email').val();
	var mob_otp= $('#mob_otp').val();
	var email_otp= $('#email_otp').val();
	var school_add= $('#school_add').val();
	var prin_name= $('#prin_name').val();
	var prin_phone= $('#prin_phone').val();
	var prin_email= $('#prin_email').val();
	var terms = $('#terms').prop('checked');
	if(school_name == '' || school_no == '' || school_email == ''
	|| mob_otp == ''|| email_otp == ''|| school_add == ''
	|| prin_name == ''|| prin_phone == ''|| prin_email == '' || terms != true)
    {
		alert('Make sure you have filled all details, verified your contact and accepted our terms and conditions. ');
        event.preventDefault();
	} else {            
                    event.preventDefault();            
                    var form = $('#enquiry')[0];           
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
                        {   alert('Thank you for sharing the details. Our team will get back to you shortly.');
                            location.reload();
						}   
						if (data=='present')
                        {   alert('You already have registred using same email id');
                        }						                                                                                             
                        },
                        error: function (e) {    							       
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
    
			<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLongTitle">Terms & Condition</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
					<div class="page-lay-new">
							<h1 class="terms-head">Terms of Service</h1>
							<h1 class="terms-head_sub">
							  Welcome to iClubs - by Testune Technologies Pvt Ltd.
							</h1>
							<p class="terms-desc">
							  These terms govern your use of Testune Technology Pvt Ltd. - iClubs and
							  the products, features, apps, services, technologies and software that
							  we offer (the iClubs.in or Products), except where we expressly state
							  that separate Terms (and not these) apply.
							</p>
							<h1 class="term-topic">1. Our Services</h1>
							<p class="terms-desc_topic">
							  Iclubs is a platform where educationists and experts can create original
							  content or curate the same from other sources for the benefit of the
							  students who are a part of iclubs. The curated content should follow the
							  guidelines for non copyright infringement. We wish to provide meaningful
							  opportunities for kids to explore, experience and express themselves in
							  field/s of their choice, liking or competence. <br /><br />To help
							  advance this mission, we provide the products and curation services
							  described below to you: <br /><br />
							  Provide a personalised experience for the school & its students:<br /><br />
							  The experience on iClubs will spread from the Articles, Videos, Posts,
							  Events, and other content that you see in Explore/Experience/Express on
							  our platform respective to the iclub and iclub category. We use the data
							  we have - for example, about the articles and videos how the student
							  browses, the choices and settings from student & club coordinator, and
							  what you share and do on and off our services - to enhance user
							  experience.<br /><br />
							  Content on iclubs for students: There are 3 types of contents on iclubs
							</p>
							<ul class="terms_list">
							  <li>1. Content curated/created by iclubs.</li>
							  <li>
								2. Content curated and created by assigned members of the clubs of the
								respective schools.
							  </li>
							  <li>3. Content created by the students.</li>
							</ul>
							<p class="terms-desc_topic">
							  1. We completely understand different societies and regions may have
							  different set of values for their children. We believe The schools are
							  the best judges for understanding the appropriateness of the content.
							  Hence, school has complete authority to evaluate and then approve the
							  content before it appears on iclub platform for students. We will always
							  make best efforts to suggest contents we feel are well covered by
							  copyright and IPR and will be safe for schools to share. In case the
							  school authorities come across such content please inform us and we
							  would research and remove the content
							</p>
							<p class="terms-desc_topic">
							  2. The iclubs platform can also be used by the student to create and
							  manage their own clubs for students. There could be content sharing from
							  other websites it is the duty of the schools/content providers to
							  understand and before approving the content we recommend that schools to
							  understand whether the content is sharable or not. (For e.g. it is
							  understood that youtube content which has been labelled as shareable by
							  the uploader on youtube can be used by school to share with their
							  students). There may be content suggestions by iclubs content team for
							  particular iclubs.<br /><br />
							  To help schools make an informed judgement towards the appropriateness
							  of content we help them wrt guidelines around copyright and other laws
							  applicable to the region. The schools can approach us for further
							  clarifications from time to time.
							</p>
							<p class="terms-desc_topic">
							  3. Some assignments and projects might require students to upload their
							  projects in digital format on the website. The content created by
							  students is solely the property of the students. We may review the
							  content from time to time to check the appropriateness of the content.
							  We may also remove the content not following under the guidelines of
							  required project. This is expected to be done from school side. We may
							  review the project to help the student/s to connect to field experts and
							  enthusiasts. The project work can also be analyzed to improve the
							  quality of our communication wrt to achieving desired outputs.
							</p>
							<h1 class="term-topic">Building Community</h1>
							<p class="terms-desc_topic">
							  Stronger ties make better communities, and we believe that our services
							  are most useful when students/teachers/schools are connected to peer
							  groups and organisations that they care about. Our research team helps
							  you find and connect with people, experts from different fields,
							  educationalists, groups, businesses, organisations and others that
							  matter to school and students for driving the iClubs activities. We use
							  the data that we have to make suggestions for you and others - for
							  example, recommended workshops, webinars, courses for students; groups
							  to join, events to attend, Pages to follow, videos to watch, articles
							  and blogs to read, quizzes that can be taken by students.
							  <br /><br />Empower you to express yourself and communicate about what
							  matters to you: There are many ways to express student's or teacher's
							  talent on iClubs and to communicate with other students, parents and
							  whole school - for example, sharing undertaken projects and assignments,
							  photos, videos and articles on iClubs, creating events or groups, or
							  adding or downloading content to your profile. We have also developed,
							  and continue to explore, new ways for students to use technology, to
							  create and share more expressive and engaging content on iClubs.
							  <br /><br />Help you discover content, products and services that may
							  interest you: We showcase and help you discover content, products and
							  services that are offered by the many businesses and organisations that
							  use iClubs and iClubs Platform.
							  <strong
								>The mission of iclubs is to give students access to knowledge
								appropriate for their field of choice, interest. The preexisting free
								content on web is going to be used extensively to achieve our mission.
								We are facilitating the educationist in providing and presenting the
								digital content available online in a most effective and meaningful
								manner for the benefit of the students. Iclubs believes that schools
								always wish to provide the right exposure well within the laws to
								their students.As iclubs is free we are not making money on directly
								selling someone else's free content. Paid Content: Their can also be
								paid content which the iclub could be suggesting to the schools for
								using for their students. The fees/other financials with the
								respective content would be paid to the content provider. Iclub may
								charge a fee for this service from either the school or content
								provider or both or none. </strong
							  ><br /><br />This is an educational platform that we hope is safe and
							  suitable for all family users, though it's mainly intended for Ages 10+.
							  We take our responsibility to young learners very seriously.<br /><br />Pages
							  on iclubs portal are designed to be suitable for all ages with no
							  "problematic" content (no nudity, sexual material, violence, potentially
							  offensive language, political predisposition/orientation, propagation of
							  any kind of religious sentiments, or other potentially harmful
							  activities).<br /><br />
							  If you discover anything that you think may be inappropriate for young
							  readers, please alert us straight away and we will try to put it right
							  immediately. If we learn of content or conduct like this, we will take
							  appropriate action. Research ways to make our services better: We engage
							  in research and collaborate with others to improve our Products. One way
							  we do this is by analysing the data we have and understanding how people
							  use our Products.<br />
							  <br />Enable global access to our services:<br />
							  To operate our global service, we need to store and distribute content
							  and data in our data centres and systems around the world, including
							  outside your country of residence. This infrastructure may be operated
							  or controlled by Testune Technologies or its affiliates.
							</p>
							<h1 class="term-topic">2. Our Data Policy and your privacy choices</h1>
							<p class="terms-desc_topic">
							  To make iclubs and its services functional we must collect school,
							  students and school coordinator(in case opted for) data. We do not sell
							  the private content or efforts of the student's or school's data
							  gathered to any third party. <br /><br />
							  The collected data may be used to make the experience better for the
							  users:
							  <ul class="terms_list_topic">
								  <li> Usage of the iClubs platform
									  </li>
								  <li>
									   Device information with device attributes, Cookie data, Network and connections
					  
								  </li>
								  <li> Purchases: for example workshops, courses or any paid content & services
									</li>
									<li> Promote safety, integrity and security.
									  </li>
									<li> Research, innovate and to provide measurement, analytics for better services
									  </li>
									<li> And to Communicate with you.
									  </li>
								</ul>
							</p><br>
							In addition to Student's data we also collect Parents data:
							<ul class="terms_list_topic">
								<li>  To share the student's wish to attend Workshop, Webinar or Course on iclubs especially when it is paid.
					  
									</li>
								<li>
									 To collect valuable feedback from parents.
					  
								</li>
								<li> To give updates to the parents and sight to student's activities as we believe in transparency.
					  
								  </li>
								  <li> To share monthly newsletters.
					  
									</li>
								  <li> Most importantly authenticity of data.
					  
									</li>
							  </ul><br>
							  <p class="terms-desc_topic">
								<strong>
									Iclub may be using data provided by schools to promote their services like workshops,
									events, courses appropriate to the students. The schools would be given a chance to review
									the services and timing of the delivery of services
								</strong>
								<br><br>
								You must agree to the data policy in order to use iclubs portal. We also encourage you to review
					  the policy before sign-up.
							  </p>
							  <h1 class="term-topic">3. Schools commitments to iClubs and its community</h1>
							  <p class="terms-desc_topic">We provide these services to you and others to help advance our mission. In exchange, we need
								  you to make the following commitments:
								  </p><br>
								  <h1 class="term-topic">1. Who can use iClubs
									</h1>
									Only registered students of partnered schools can use iclubs.
									<ul class="terms_list_topic">
										<li> Use the same name as registered in school records.
					  
											</li>
										<li>
											 Provide accurate information about yourself.
					  
										</li>
										<li> Create only one account (your own) and use your dashboard for personal purposes.
										  </li>
										  <li> To share monthly newsletters.
											</li>
										  <li> Not share your password, give access to your iClubs account to others or transfer your
											  account to anyone else (without our permission)
											</li>
									  </ul><br>
									  <h1 class="term-topic">2. What you can share and do on iClubs</h1>
									  <p class="terms-desc_topic">
										  We want people to use iClubs to express themselves and to share content that is important to
										  them, but not at the expense of the safety and well-being of others or the integrity of our
										  community. You therefore agree not to engage in the conduct described below (or to facilitate or
										  support others in doing so):
									  </p>
									  <ul class="terms_list_topic">
										  <li >1. You may not use our Portal & Products to do or share anything:
					  
						
											  </li>
										  <li style="margin-left: 30px;">
											   That breaches Terms and Policies of iclubs.
					  
						
										  </li>
										  <li style="margin-left: 30px;"> That is unlawful, misleading, discriminatory or fraudulent.
					  
											</li>
											
											<li style="margin-left: 30px;"> That infringes or breaches someone else's rights.
					  
											  </li>
											  <li >2. You may not upload viruses or malicious code, or do anything that could disable,
												  overburden or impair the proper working or appearance of our Products.
						
												</li>
												<li >3. You may not access or collect data from our Products using automated means (without our
													prior permission) or attempt to access data that you do not have permission to access.
						
												  </li>
												  <li >4. We may remove the content if not appropriate to the classification or focus of the particular
													  activity within the clubs
						
													</li>
													<li >5. We may also disable your account if you repeatedly infringe other people's intellectual
														property rights.
														
						
													  </li>
										</ul>
										To help support our community, we encourage you to report content or conduct that you believe
					  breaches your rights (including intellectual property rights) or our terms and policies
					  <h1 class="term-topic">3. The permissions you give us
						</h1>
						We need certain permissions from the schools and students to provide our services:<br>
						<ul class="terms_list">
							<li>1. Permission to use content that is created by the schools or students: You own the content
								that you create and share on iClubs and the other related applications you use, and nothing
								in these Terms takes away the rights that you have to your own content. You are free to
								share your content with anyone else, wherever you want. To provide our services, however,
								we need you to give us some legal permissions to use this content</li>
							<li>
								2.Specifically, when you share, post or upload content that is covered by intellectual property
								rights (e.g. articles or photos or videos) on or in connection with our Products, you grant us
								a non-exclusive, transferable, sub-licensable, royalty-free and worldwide licence to host,
								use, distribute, modify, run, copy, publicly perform or display, translate and create derivative
								works of your content (consistent with your privacy and application settings).<br>
								You can end this licence at any time by deleting your content or account. However, if you
								wish to delete the account your posted content may be deleted. In addition, content that you
								delete may continue to appear if you have shared it with others and they have not deleted it.
								
							</li>
							<li>3. Permission to use your name, profile picture and information about your actions with ads
								and sponsored content: You give us permission to use your name and profile picture and
								information about actions that you have taken on iClubs next to or in connection with ads,
								offers and other sponsored content that we may display across our Products, with or without
								any compensation to you. For example, we may share you are interested in an advertised
								event or have endorsed a Page created by a brand that has paid us to display its ads on
								iclubs</li>
								<li>
									4. Permission to update software that you use or download: If you download or use our
									software, you give us permission to download and install upgrades, updates and additional
									features to improve, enhance and further develop it
								</li>
						  </ul>
						  <h1 class="term-topic">4. Limits on using our intellectual property
					  
							</h1>
							<p>
								If you use content covered by intellectual property rights that we have and make available in our
								Products (for example, images, designs, videos or sounds that we provide, which you add to
								content you create or share on iClubs), we retain all rights to that content (but not yours). You can
								only use our copyrights or trademarks (or any similar marks) with our prior written permission.
								
							</p>
								<h1 class="term-topic">5. Payment
					  
					  
								  </h1>
								  <p>
									  There can be cases where the school becomes the collection point for the services based on terms
									  and agreement for a particular service. In case of non compliance of the terms the service may be
									  discontinued with or without any intimation to the school.
									  
								  </p>
								  <h1 class="term-topic">6. Management of iClubs
					  
					  
									</h1>
									<p>
										Upon signing up for iClubs we recommend schools to assign coordinators for all iclubs schools has
					  opted for in order to have optimal guidance to the students and to manage the content. School
					  must assign at least one coordinator for engagement and approval of content.
					  The school would be assigning the coordinators and other volunteers for managing the clubs. The
					  students can also be given the charge of managing the clubs. The approval of content is to be
					  done by a person of legal age.
					  
										
									</p>
									<h1 class="term-topic">7. Distribution of Content
					  
					  
									  </h1>
									  <p>
										  School has complete authority of the content created/curated by the individual student or a teacher
					  to be published on iclub page(s) of the school. If the school wants to publish some content on the
					  open platform of iclub they may request us. In an endeavour to provide best of the creative works
					  by students of schools all over the world the schools may be requested to provide or participate in
					  some activities. It is solely the schools prerogative to choose to contribute the works of their
					  students on the open platform
										  
									  </p>
									  <h1 class="term-topic">8. Internal School Clubs
					  
					  
					  
										</h1>
										<p>
											The schools can use the software to create the clubs on the iclub platform for their exclusive use
					  and may choose not to share the content with other schools.
					  If the school wants to publish some content on the open platform of iclub they may request us. In
					  an endeavour to provide best of the creative works by students of schools all over the world the
					  schools may be requested to provide or participate in some activities. It is solely the schools
					  prerogative to choose to contribute the works of their students on the open platform
											
										</p>
										<h1 class="term-topic">9. Third party tie-ups
					  
					  
					  
					  
										  </h1>
										  <p>
											  In case school wish to place any third party workshop, webinar, course or an advertisement, school
											  may write to us.
											  <br><br>
											  <strong>
												  iClubs reserves the right whether to deploy the same in portal on not.
					  
											  </strong><br><br>
											  <strong>
												  Third party has to follow the same norms.
					  
											  </strong>
										  </p>
										  <h1 class="term-topic">4. Additional provisions
										  </h1>
										  <h1 class="term-topic">1. Updating our Terms
											</h1>
											<p class="terms-desc_topic">
												We work constantly to improve our services and develop new features to make our Products better
												for you and our community. As a result, we may need to update these Terms from time to time to
												accurately reflect our services and practices. Unless otherwise required by law, we will notify you
												before we make changes to these Terms and give you an opportunity to review them before they
												go into effect. Once any updated Terms are in effect, you will be bound by them if you continue to
												use our Products.
												We hope that you will continue using our Products, but if you do not agree to our updated Terms
												and no longer want to be a part of the iClubs, you can delete your account at any time.
											</p>
											<h1 class="term-topic">2. Account suspension or termination
											  </h1>
											  <p class="terms-desc_topic">We want iClubs to be a place where people feel welcome and safe to express themselves and
												  share their thoughts and ideas.
												  If we determine that you have breached our terms or policies, we may take action against your
												  account to protect our community and services, including by suspending access to your account or
												  disabling it. We may also suspend or disable your account if you create risk or legal exposure for
												  us or when we are permitted or required to do so by law. Where appropriate, we will notify you
												  about your account the next time you try to access it. You can learn more about what you can do if
												  your account has been disabled, by writing to us</p>
											  <h1 class="term-topic">3. Limits on liability
					  
												</h1>
												<p class="terms-desc_topic">We work hard to provide the best Products we can and to specify clear guidelines for everyone
													who uses them. Our Products, however, are provided "as is", and we make no guarantees that
													they will always be safe, secure or error-free, or that they will function without disruptions, delays or
													imperfections. To the extent permitted by law, we also DISCLAIM ALL WARRANTIES, WHETHER
													EXPRESS OR IMPLIED, INCLUDING THE IMPLIED WARRANTIES OF MERCHANTABILITY,
													FITNESS FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT. We do not control
													or direct what people and others do or say, and we are not responsible for their actions or conduct
													(whether online or offline) or any content that they share (including offensive, inappropriate,
													obscene, unlawful and other objectionable content).
													We cannot predict when issues may arise with our Products. Accordingly, our liability shall be
													limited to the fullest extent permitted by applicable law, and under no circumstances will we be
													liable to you for any lost profits, revenues, information or data, or consequential, special, indirect,
													exemplary, punitive or incidental damages arising out of or related to these Terms or our Products,
													even if we have been advised of the possibility of such damages.</p>
												<h1 class="term-topic">4. Disputes
					  
												  </h1>
												  <p class="terms-desc_topic">We try to provide clear rules so that we can limit or hopefully avoid disputes between you and us. If
													  a dispute does arise, however, it's useful to know up front where it can be resolved and what laws
													  will apply.
													  If you are a consumer, the laws of the country in which you reside will apply to any claim, cause of
													  action or dispute that you have against us, which arises out of or relates to these Terms or the
													  Testune Products ("claim"), and you may resolve your claim in any competent court in that country
													  that has jurisdiction over the claim. In all other cases, you agree that the claim must be resolved
													  exclusively in the Mumbai jurisdiction US District Court for the Northern District of California or a
													  state court located in San Mateo County, that you submit to the personal jurisdiction of either of
													  these courts for the purpose of litigating any such claim, and that the laws of the State of California
													  will govern these Terms and any claim, without regard to conflict of law provisions</p>
												  <h1 class="term-topic">5. Other
					  
													</h1>
													<p></p>
													<ul class="terms_list_topic">
														<li>1. As iclubs is a free portal for school and its students, the site may have advertisements. All
															advertisements are or will be very clearly labelled as "Sponsored links" or "Advertisement";
															there are absolutely no hidden or deceptive advertisements, links disguised as
															advertisements, or affiliate links (hidden or otherwise) anywhere on this site. Although we
															have no direct control over the advertisements, we monitor the sensitive categories of
															advertising that we consider inappropriate for young readers.
															
															</li>
														<li>
															2. These Terms make up the entire agreement between you and Testune, Inc. regarding your
															use of our Products. They supersede any prior agreements.
															
											  
														</li>
														<li>3. Some of the Products we offer are also governed by supplemental Terms.
					  
														  </li>
														  <li>4. If any portion of these Terms is found to be unenforceable, the remaining portion will remain
															  in full force and effect. If we fail to enforce any of these Terms, it will not be considered a
															  waiver. Any amendment to or waiver of these Terms must be made in writing and signed by
															  us.
															</li>
														  <li>5. You will not transfer any of your rights or obligations under these Terms to anyone else
															  without our consent.
															</li>
															<li>6. These Terms do not confer any third-party beneficiary rights. All of our rights and obligations
																under these Terms are freely assignable by us in connection with a merger, acquisition or
																sale of assets, or by operation of law or otherwise.
																</li>
															<li>7. You should know that we may need to change the username for your account in certain
																circumstances</li>
															<li>8. We always appreciate your feedback and other suggestions about our products and
																services. But you should know that we may use them without any restriction or obligation to
																compensate you, and we are under no obligation to keep them confidential</li>
															<li>9. We reserve all rights not expressly granted to you.</li>
															<li></li>
															<li></li>
													  </ul>
													  <br>
													  <h1 class="term-topic">5. Other Terms and Policies that may apply to Schools
														  
					  
														</h1>
														Points to be added:
														<ul class="terms_list_topic">
										<li>1. School wish to associate any course/workshop or paid event, they shall write to us
											</li>
										<li>
											2. School's Responsibilities
					  
										</li>
										<li style="margin-left: 30px;">a. Updation of Student Dat
										  </li>
										  <li style="margin-left: 30px;">b. Permission for interaction with students and parents
											</li>
										  <li style="margin-left: 30px;">c. Understanding 3rd Party products and services
											</li>
											<li>3. If we find that you are charging for iclubs - we will take strict actions</li>
									  </ul>
									  </div>  
						  </div>
			</div>
		</div>

</body>

</html>