<?php
include_once "../../assets/Users.php";

$db = new Database();
$conn = $db->getConnection();
$club_id = $_GET['id'];
//CHANGE START
$check="SELECT club_category_id,club_name,club_description,status,features,image,launch_date FROM clubs WHERE club_id = '$club_id'";
$result = $conn->query($check);
while($row = $result->fetch_array())
    {
        $cat =$row['club_category_id'];
     $name =$row['club_name'];
     $desc = $row['club_description'];
     $image = $row['image'];
     $features = $row['features'];
     $launch_date = $row['launch_date'];
     $status = $row['status'];
    }
//CHANGE END
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
               <header class="mb-3">
              <h2 class="text-grey " style=" line-height:1.25em;"><strong>Update CLUB</strong></h2>
               <p id="msg"></p>
						      </header>
							    <div class="content">
                                        <div class="container">
                                          <form class="col-md-offset-4 col-md-3 col-md-offset-4  " id="fileUploadForm" enctype="multipart/form-data">
                                          <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                              <input type="text" placeholder="Club Category" value="<?php if(isset($cat)){echo $cat;unset($cat);}else{echo 'No data';} ?>" name="club_category_id" id="club_category_id" class="padding-popup radius03" required="true">
											</div>
                                            <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                              <input type="text" placeholder="Club Name" value="<?php if(isset($name)){echo $name;unset($name);}else{echo 'No data';} ?>" name="club_name" id="club_name" class="padding-popup radius03" required="true">
											</div>
                                            <div class="10u -1u" style="padding: 20px 0 0 20px;">
												<textarea type="text" placeholder="Description"  style="margin-bottom:10px; min-height:100px;" name="desc" id="desc" class="padding-popup radius03" required="true"><?php if(isset($desc)){echo $desc;unset($desc);}else{echo 'No data';} ?></textarea>
											</div> 
                                            <!--CHANGE START-->
                                            <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                            <img src="../assets/club/<?php if(isset($image)){echo $image;unset($image);}else{echo 'No data';} ?>" height="100px" width="100px">
											</div>
                                            <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                            Upload Image: <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
                                            <input name="fileToUpload" type="file" required="true" />
									 </div>
                                    
                                     <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                                                                     <input type="text" value="<?php if(isset($features)){echo $features;unset($features);}else{echo 'No data';} ?>" placeholder="Features" name="features" id="features" class="padding-popup radius03" required="true">
                                                                                     <label style="color:red"><p>*3 comma seperated features. Eg: Feature 1, Feature2, Feature3</p></label>
									 </div>
                                     <div class="10u -1u" style="padding: 20px 0 0 20px;">
                                          <input placeholder="Date of Formation" value="<?php if(isset($launch_date)){echo $launch_date;unset($launch_date);}else{echo 'No data';} ?>" type="text" name="datepicker" id="datepicker"  required="true">
									 </div>
                                     <label>Enabled</label>
            <input <?php if(isset($status) AND $status=='1'){echo 'checked';}else{} ?>
              type="radio"
              name="status"
              value="1"
              id="status"
              class=""
            />
            <label>Disabled</label>
                        <input <?php if(isset($status) AND $status=='0'){echo 'checked';}else{} ?>
              type="radio"
              name="status"
              id="status"
              value="0"
              class=""
            />
                                      <!--CHANGE END-->
                                            <div class="10u -1u" style="padding: 20px 0 0 20px; ">
												<input style="min-height:30px;" type="button" name="submit" value="SUBMIT" class="special-orange popup-big button-popup" id="sub" name="sub" onclick="check_form()" >  
                                            </div><br>
                                            
                                            <input type="hidden" name="action" value="update"> 
                                            <input type="hidden" name="club_id" value="<?php echo $club_id;?>"> 

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
           var club_name= $('#club_name').val();    
           var desc= $('#desc').val(); 
            if(club_name === '' || desc === '' )
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
            if(data=='updated')
            {   console.log(data);
                alert('Club Updated !');
                location.reload(true);
            }
        },
        error: function (e) {
            console.log(e);
            $("#result").text(e.responseText);
            $("#sub").prop("disabled", false);
         }
});
}
</script>
<script>
   
</script>

    </div>
  </div>
</div>
<!--section for intro text and button ends--> 
<!--section for features starts-->
 
 <?php include("admin_footer.php"); ?>

</body>
</html>