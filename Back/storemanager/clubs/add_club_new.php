<?php
    
?>
<?php

?>
<link rel="stylesheet" href="main.css">
<link rel="stylesheet" href="http://www.testune.com/spacedtimes/fancybox/jquery-ui.css" />
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
    <table>
                                <tbody><tr>  
                                  <td style="padding: 0em 0em;">
					<section class="wrapper special popup ">
                                                     <header class="mb-3">
              <h2 class="text-grey " style=" line-height:1.25em;"><strong>NEW CLUB</strong></h2>
              
              <p id="msg"></p>
						      </header>
							    <div class="content">
                                                                  <div class="container">
                                                                  
                                                                  <form class="col-md-offset-4 col-md-3 col-md-offset-4  " id="fileUploadForm" enctype="multipart/form-data">
                                                                         <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                                                             <select  name="club_category_id" id="club_category_id" class="padding-popup radius03" required>
                                                                             <option value="club_tech" selected>web</option>
                                                                                  <?php /*
                                                                                         $check="SELECT * FROM club_category";
                                                                                         $result1 = $db->query($check);
                                                                                         $num_rows = mysqli_num_rows($result1);
                                                                                         if($num_rows == '0')
                                                                                         { echo "<option>No Category Found!! Please create and then Assign</option>"; }
                                                                                         else
                                                                                         {
                                                                                            echo "<option selected disabled>Select Club Category</option>";
                                                                                             while ($row = $result1->fetch_array()) {
                                                                                               echo "<option value='$row[1]'>$row[2]</option>";
                                                                                              } 
                                                                                         }*/ 
                                                                                  ?>                  
                                                                              </select>
									 </div>
                                     <div class="page-middle-wrapper">
        <form action="#" class="page-form" id="fileUploadForm" enctype="multipart/form-data">
            <select name="club_category_id" id="club_category_id" class="form-select">
                <option selected disabled>Select Club Category</option><option value='CCI_2'>Technology</option><option value='CCI_3'>Testing</option><option value='CCI_4'>Artificial Intelligence</option><option value='CCI_5'>Academic</option><option value='CCI_6'>Non Academic</option><option value='CCI_7'>testclub</option><option value='CCI_8'>School Clubs</option><option value='CCI_9'>Gaming</option>            </select><br>
            <input type="text" name="club_name" id="club_name" placeholder="Club Name" class="form-field" required="true"><br>
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Club Description" class="form-textarea"></textarea><br>  
              <textarea name="features" id="features" cols="30" rows="10" placeholder="Features" class="form-textarea"></textarea>
					   <label style="color:red"><p>*3 comma seperated features. Eg: Feature 1, Feature2, Feature3</p></label> <br>
					    <input placeholder="Date of Formation" type="text" name="datepicker" id="datepicker" class="form-field"  required="true"> 
                                            <input type="hidden" name="action" value="add">
              <br /> Upload Image: <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
                                            <input name="fileToUpload" type="file" required="true" />
            <input type="button" value="Submit" class="submit__btn" name="submit" id="sub" name="sub" onclick="check_form()">
        </form>
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

function check_form()
   {       var club_name= $('#club_name').val();    
            var desc= $('#desc').val();
            //CHANGE START
            
            var date= $('#datepicker').val();         
            var temp= $('#features').val();       
            var CC_ID=$('#club_category_id ').val();                
             if(club_name === '' || desc === '' || features === '' || date === '' || CC_ID ==='')
                  {
		        alert('Please make sure all fields are filled.');
		  }
          //CHANGE END
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
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "club_back.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data);
            if(data=='success'){               
            alert('Club Added Successfully');
            location.reload(true); 
            }
            if(data=='exists')
            {
                alert('Club Name Already Exists');  
            }           
        },
        error: function (e) {
            console.log(e);
            alert('Error ! Check console for error !');
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