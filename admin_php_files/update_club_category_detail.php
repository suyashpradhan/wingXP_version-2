<?php
include("home_header.php"); 
$club_category_id = $_GET['id'];
$check="SELECT club_category_name,club_category_description FROM club_category WHERE club_category_id = '$club_category_id'";
$result = $db->query($check);
while($row = $result->fetch_array())
    {
     $name =$row['club_category_name'];
     $desc = $row['club_category_description'];
    }
$db->close();
?>
 
 
<!--header ends--> <!--section for intro text and button starts-->
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
    <table>
            <tbody><tr>  
              <td style="padding: 0em 0em;">
			 <section class="wrapper special popup ">
               <header class="mb-3">
              <h2 class="text-grey " style=" line-height:1.25em;"><strong>Update Club Category</strong></h2>
               <p id="msg"></p>
						      </header>
							    <div class="content">
                                        <div class="container">
                                          <form class="col-md-offset-4 col-md-3 col-md-offset-4  " id="fileUploadForm" enctype="multipart/form-data">
                                            <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                              <input type="text" placeholder="Club Category Name" value="<?php if(isset($name)){echo $name;unset($name);}else{echo 'No data';} ?>" name="club_category_name" id="club_category_name" class="padding-popup radius03" required="true">
											</div>
                                            <div class="10u -1u" style="padding: 20px 0 0 20px;">
												<textarea type="text" placeholder="Description"  style="margin-bottom:10px; min-height:100px;" name="desc" id="desc" class="padding-popup radius03" required="true"><?php if(isset($desc)){echo $desc;unset($desc);}else{echo 'No data';} ?></textarea>
											</div> 
                                            <div class="10u -1u" style="padding: 20px 0 0 20px; ">
												<input style="min-height:30px;" type="button" name="submit" value="SUBMIT" class="special-orange popup-big button-popup" id="sub" name="sub" onclick="check_form()" >  
                                            </div><br>
                                            
                                            <input type="hidden" name="action" value="update"> 
                                            <input type="hidden" name="club_category_id" value="<?php echo $club_category_id; ?>"> 

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


function check_form()
   {
           var club_category_name= $('#club_category_name').val();    
           var desc= $('#desc').val(); 
            if(club_category_name === '' || desc === '' )
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
    data.append("action", "update");
    // disabled the submit button
    $("#sub").prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "club_category_back.php",
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
 
 <?php include("admin_footer.php"); ?>

</body>
</html>