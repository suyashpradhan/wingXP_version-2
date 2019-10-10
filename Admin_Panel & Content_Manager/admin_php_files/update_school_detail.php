<?php
include("home_header.php");    

$institute_id = $_GET['id'];
$check="SELECT institute_name, details,promoters, address, email_id, phone_no, password FROM school WHERE institute_id = '$institute_id'";

$result = $conn->query($check);

    while($row = $result->fetch_array())
    {
     $institute_name =$row['institute_name'];
     $details = $row['details'];
     $promoters =$row['promoters'];
     $address =$row['address'];
     $email_id =$row['email_id'];
     $phone_no =$row['phone_no'];
     $password =$row['password'];
    }
$conn->close();
?>
 

<!--header ends--> <!--section for intro text and button starts-->
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
    <table>
                                <tbody><tr>  
                                  <td style="padding: 0em 0em;">
					<section class="wrapper special popup ">
                                                     <header class="mb-4">
              <h2 class="text-grey " style=" line-height:1.25em;"><strong>NEW SCHOOL</strong></h2>
              
              <p id="msg"></p>
						      </header>
							    <div class="content">
                                                                  <div class="container">
                                                                  
                                                                  <form class="col-md-offset-4 col-md-3 col-md-offset-4  " id="fileUploadForm" enctype="multipart/form-data">
                                                                                        <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="text" placeholder="Name" value="<?php if(isset($institute_name)){echo $institute_name;unset($institute_name);}else{echo 'No data';} ?>" name="institute_name" id="institute_name" class="padding-popup radius03" required="true">
											</div>
                      <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="email" placeholder="Email Id" value="<?php if(isset($email_id)){echo $email_id;unset($email_id);}else{echo 'No data';} ?>" name="email" id="email" class="padding-popup radius03" required="true">
											</div>
                      <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="password" placeholder="password" value="<?php if(isset($password)){echo $password;unset($password);}else{echo 'No data';} ?>" name="password" id="password" class="padding-popup radius03" required="true">
											</div>
                      <div class="10u -1u" style="padding: 20px 0 0 20px; ">
												<textarea type="text" placeholder="Details" name="desc" id="desc" class="padding-popup radius03" style="margin-bottom:10px;" required="true"><?php if(isset($details)){echo $details;unset($details);}else{echo 'No data';} ?></textarea>
											</div>
                      <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="text" placeholder="Promoters" value="<?php if(isset($promoters)){echo $promoters;unset($promoters);}else{echo 'No data';} ?>" name="prom" id="prom" class="padding-popup radius03" required="true">
											</div>
                      
                      
                      
                      <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="text" placeholder="Phone No" value="<?php if(isset($phone_no)){echo $phone_no;unset($phone_no);}else{echo 'No data';} ?>" name="phone" id="phone" class="padding-popup radius03" required="true">
											</div>
                     
                      
                       
										 	
                                                                                       

<div class="10u -1u" style="padding: 20px 0 0 20px;">
												<textarea type="text" placeholder="Address" name="address" id="address" class="padding-popup radius03" style="margin-bottom:10px;" required=""><?php if(isset($address)){echo $address;unset($address);}else{echo 'No data';} ?></textarea>
											</div> 
                  
											
                                            <input type="hidden" name="action" value="update">
                                             <input type="hidden" name="institute_id" value="<?php echo $institute_id;?>">
										 	
											<div class="10u -1u" style="padding: 20px 0 0 20px; ">
												<input style="min-height:30px;" type="button" name="submit" value="SUBMIT" class="special-orange popup-big button-popup" id="sub" name="sub" onclick="check_form()" >  
                                            </div><br>
                                            
                                            
                                        </form>
										</div>  
                                      	 </div>
                 </section> </td></tr>
</tbody></table>
       

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script language="javascript">
$(function(){
$("#password").keyup(function(event){
    if(event.keyCode == 13){
        login();
    }
});
});
function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if(!emailReg.test(email)) {
    return false;
  } else {
    return true;
  }
}
function check_form()
   {
           var activity_name= $('#activity_name').val();    
           var desc= $('#desc').val(); 
              if(activity_name === '' || desc === '' )
                  {
		        alert('Please make sure all fields are filled.');
		  }
             else
		 {          
                     ajaxbackend();
                 } 
   }
function ajaxbackend(){
    //stop submit the form, we will post it manually.
    event.preventDefault();
    // Get form
    var form = $('#fileUploadForm')[0];
    // Create an FormData object 
    var data = new FormData(form);
    // If you want to add an extra field for the FormData
    data.append("CustomField", "This is some extra data, testing");
    // disabled the submit button
    $("#sub").prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "school_back.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            $("#result").text(data);
            document.getElementById('msg').innerHTML = data;
            $("#sub").prop("disabled", false);
        },
        error: function (e) {
            $("#result").text(e.responseText);
            document.getElementById('msg').innerHTML = 'Rename File or upload smaller file!';
            $("#sub").prop("disabled", false);
        }
});
}
</script>
<?php
    include("admin_footer.php"); 
?>