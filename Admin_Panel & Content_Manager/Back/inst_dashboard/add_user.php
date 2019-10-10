<?php
include_once "../assets/Users.php";
$database = new Database();
$db = $database->getConnection();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="main.css"
    />
  </head>
  <body>
    <div class="main-content" style="background: none;">
      <div class="right_topNav">
        <div class="inner-topNav">
          <div class="row no-gutters ">
            <div class="col-6">
              <div class="icon-wrap">
                <h1 class="topNav_first">
                  ST. XAVIER'S HIGH SCHOOL <span> DASHBOARD </span>
                </h1>
                <i class="fas fa-home nav-icons fa-fw"></i>
                <i class="fas fa-bell nav-icons fa-fw"></i>
              </div>
            </div>
            <div class="col-6">
              <div class="icon-wrap">
                <h1 class="topNav_first_name">
                  Ankush Aggarwal | School Coordinator
                </h1>
                <img src="assets/images/user (1).png" alt="" height="40px" />
                <i class="fas fa-bars fa-fw side-icons nav-icons menu"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id='msg' style="background-color:red;color:white;margin-left:40%;    width: fit-content;
    padding: 20px;
    font-size: larger;display:none;">
      </div>
      <div class="form-wrap">
        <div class="tabs">
          <h3 class="tab-header">
            <a class="active" href="#signup-tab-content">Add A Student</a>
          </h3>
          <h3 class="tab-header"><a href="#login-tab-content">Import</a></h3>
        </div>

        <div class="tabs-content">
          <div id="signup-tab-content" class="active">
            <form action="" id="form_manual" enctype="multipart/form-data">
              <div class="tab-content-form">
                <input
                  type="text"
                  name="roll"
                  placeholder="Roll No"
                  class="tab-content-form_fields"
                />
                <input
                  type="text"
                  name="name"
                  placeholder="Name"
                  class="tab-content-form_fields"
                />
                <input
                  type="text"
                  name="phone"
                  placeholder="Phone"
                  class="tab-content-form_fields"
                />
                <input
                  type="text"
                  name="p_name"
                  placeholder="Parent Name"
                  class="tab-content-form_fields"
                />
                <input
                  type="text"
                  name="p_phone"
                  placeholder="Parent Phone"
                  class="tab-content-form_fields"
                />
                <input
                  type="email"
                  name="email"
                  placeholder="Email"
                  class="tab-content-form_fields"
                />
                <select name="class_man" id="school_class" onchange="get_batch()">
                  <option value="">Choose Class</option>
                                <?php 
                    $q='select class_id,class from inst_class where institute_id= "'.$_SESSION['Userid'].'"';
                    $v=$db->query($q);                 
                    $vs=mysqli_num_rows($v);
                    if($vs >0){ 
                        while($v1=mysqli_fetch_array($v)){?>
                        <option value='<?php echo $v1[0]; ?>'><?php echo $v1[1]; ?></option> 
                      <?php }
                    }
                     else { ?>
                         <option  disabled="disabled" selected>No Classes</option>   
                    <?php } ?>
                </select>
                <select name="batch" id="batch">
                  <option>Select Batch</option>                  
                </select>
              </div>
              <button class="tab-content-form_btn" type="button" onclick="save();">
                <span>Submit</span>
              </button>
            </form>
          </div>
          <div id="login-tab-content">
            <div class="tab-content">
              <h1 class="tab-content-import_header">Download Excel Template Here</h1>
              <a href="../assets/dataprocess/sample.xlsx"  download="template">Download</a>
              <h1 class="tab-content-import_header" style="margin-top:10px;">Upload Excel File Here</h1>
              <form action="" id="import" enctype="multipart/form-data">
              
              <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button class="tab-content-form_btn import_btn" type="button" onclick="import_fn();">
                  <span>Import</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer" style="background-color:#444">
      <div class="page-lay-new">
        <div class="left-footer" style="color:#ccc;">
          © Copyright – iCLUBS 2018
        </div>
      </div>
    </div>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
      integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
      crossorigin="anonymous"
    />
    <script
      src="https://code.jquery.com/jquery-3.3.1.js "
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous "
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js "
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
      crossorigin="anonymous "
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js "
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
      crossorigin="anonymous "
    ></script>
    <script src="script.js"></script>
    <script>
      $(document).ready( $('#class').change());
      $(document).ready( $('#class_imp').change());
      function get_batch(){
      var class_v= $('#school_class').val();
    $.ajax({
						  type: 'GET',
						  url: 'get_batch.php?class='+class_v,
						  data: '',
						  success: function(response){                                         
						    $('#batch').html(response);                            
						  } 
					       });
    }
    function get_batch_imp(){
      var class_v= $('#class_imp').val();
    $.ajax({
						  type: 'GET',
						  url: 'get_batch.php?class='+class_v,
						  data: '',
						  success: function(response){                                         
						    $('#batch_imp').html(response);                            
						  } 
					       });
    }
    function save(){
      var roll= $('#roll').val();
    var name= $('#name').val();
    var phone= $('#phone').val();
    var p_name= $('#p_name').val();
    var p_phone= $('#p_phone').val();
    var email= $('#email').val();
    var school_class= $('#school_class').val();
    var batch= $('#batch').val();
      if(roll == '' || name == '' || phone == '' || p_name == ''  || p_phone == '' || 
      email == '' || school_class == ''|| batch == '' )
                  {
		        alert('Please make sure all fields are filled.');
                event.preventDefault();
		  } 
      else {            
       event.preventDefault();            
       var form = $('#form_manual')[0];           
       var data = new FormData(form); 
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "add_user_back.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
			success: function(response){ 
        console.log(response);   
      if(response=='success'){
      $('#msg').html('Successfully Added');
      $('#msg').css('display','block');
      }                
      else if (response=='error'){
      $('#msg').html('Error in the System. Please try Later');
      $('#msg').css('display','block');
      }      
			} 
			});
      }

}

function import_fn(){  
    var school_class= $('#class_imp').val();
    var batch= $('#batch_imp').val();
      if(school_class == ''|| batch == '' )
                  {
		        alert('Please make sure all fields are filled.');
                event.preventDefault();
		  } 
      else {            
       event.preventDefault();            
       var form = $('#import')[0];           
       var data = new FormData(form); 
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "process.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
			success: function(response){ 
        console.log(response);   
      if(response=='success'){
        $('#msg').html('Successfully Imported');
      $('#msg').css('display','block');
      location.replace('inst_dashboard.php').delay(1000);
      }                
      else if (response=='error'){
        $('#msg').html('Error in the System. Please Try Later');
      $('#msg').css('display','block');
      }      
      else if (response=='invalid_format'){
      $('#msg').html('Invalid Format. Please use this format. <a href="http://www.wingxp.com/login/assets/dataprocess/sample.xlsx" target="_blank">Download</a>');
      $('#msg').css('display','block');
      } 
      else if (response=='update_error'){
      $('#msg').html('Please use Add a Student option to add manually or Contact Admin to Add using Excel');
      $('#msg').css('display','block');
      } 
			} 
			});
      }

}
    </script>
  </body>
</html>
