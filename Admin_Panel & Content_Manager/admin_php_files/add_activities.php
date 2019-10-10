<?php
     include("home_header.php");
?>


<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
    <table>
                                <tbody><tr>  
                                  <td style="padding: 0em 0em;">
					<section class="wrapper special popup ">
                                                     <header class="mb-3">
              <h2 class="text-grey " style=" line-height:1.25em;"><strong>NEW ACTIVITY</strong></h2>
              
              <p id="msg"></p>
						      </header>
							    <div class="content">
                                                                  <div class="container">
                                                                  
                                                                  <form class="col-md-offset-4 col-md-3 col-md-offset-4  " id="fileUploadForm" enctype="multipart/form-data">
                                                                                        <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                        
												<input type="text" placeholder="Activity Name" name="activity_name" id="activity_name" class="padding-popup radius03" required="true">
											</div>
                      
                      
                      
                     
                      
                       
										 	
                                                                                        
<div class="10u -1u" style="padding: 20px 0 0 20px;">
												<textarea type="text" placeholder="Description" style="margin-bottom:10px; min-height:100px;" name="desc" id="desc" class="padding-popup radius03" required="true"></textarea>
											</div> 



											
                      
										 	
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
           
                  add_image();
                 } 
   }

function add_image(){
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
        url: "activity_back.php",
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
  </div>
  </div>
</div>
<!--section for intro text and button ends--> 
<!--section for features starts-->
<div class="section colored">
  <div class="container clearfix"> 
     <!--features starts-->
     
</div> 

<br /> <br /> 

<?php
     include("admin_footer.php");
?>