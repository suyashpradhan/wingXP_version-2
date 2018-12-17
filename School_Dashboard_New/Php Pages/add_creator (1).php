<link rel="stylesheet" href="assets/css/main.css" />
<script type="text/javascript" src="fancybox/jquery.min.js"></script>
<script src="fancybox/jquery-ui.js" type="text/javascript"></script>
<link rel="stylesheet" href="fancybox/jquery-ui.css" />
<script language='javascript'>
$(function() {
$("#start_date").datepicker({ dateFormat: 'dd-mm-yy',  minDate: 0 });
});
$(function() {
$("#end_date").datepicker({ dateFormat: 'dd-mm-yy',  minDate: 0 });
});
</script>
<?php
session_start();
include("assets/php/database.php"); 
$database = new Database();
$db = $database->getConnection();
include("assets/php/class.acl.php");
include_once "class_admin.php";
include_once "assets/Users.php";
$user = new User($db);
$uid = $_SESSION['Userid'];
if($_SERVER["REQUEST_METHOD"] == "POST")
{ 
  $form = array();
  foreach($_POST as $key=>$value) {
	  $form[$key] = $value;
   }
    $institute_operation=new institute_operation($db);
    $run_query=$institute_operation->add_test_creator($form);
	 if($run_query)
	 { 
           // $batch_name=$form['batch_name'];
        ?>
	      <script language='javascript'>
                   // window.parent.batch_add('<?php echo $batch_name; ?>','<?php  echo $run_query ?>'); 
                  alert('Creator Added');
                 window.history.back();
              </script> 
<?php	 }
	 else
	 {
	     echo "<script language='javascript'>alert('Error in the system. Please try it later.');</script>";
	 }	 
}
?>

      <div class="new-container">
                <div class="batch-card batch-card_2" style="margin-top: 30px">
                    <h1 class="update-form-header">Add New Club Coordinator Account</h1>
                    <hr class="hr_under_one hr_new">
          <form action="" method="post" id="fileUploadForm" enctype="multipart/form-data" class="coordinator-form">
             <input type="hidden" name="institute_id" id="institute_id" required value="<?php echo $uid; ?>"   class="diff-fields"/> 
            <input
              type="text"
              name="name"
              id="name"
              placeholder="Club Coordinator Name"
              required
              class="diff-fields"
            />

            <input
              type="email"
              name="email"
              required
              id="email"
              placeholder="Email Id"
              class="diff-fields"
            />

            <input
              type="text"
              name="phone"
              required
              id="phone"
              placeholder="Phone Number"
              class="diff-fields"
            />

            <input
              type="text"
              name="username"
              required
              id="username"
              placeholder="Username"
              class="diff-fields"
            />
            <input
              type="text"
              name="password"
              required
              id="password"
              placeholder="Password"
              class="diff-fields"
            />
            <textarea
              name="address"
              required
              id="address"
              placeholder="Address"
              class="diff-fields-textarea"
            ></textarea>

             <textarea
              name="detail"
              required
              id="detail"
              placeholder="Detail"
              class="diff-fields-textarea"
            ></textarea>

            <select
              name="role"
              required
              id="role"
              placeholder="Role"
              class="diff-fields"
            >
              <option selected disabled>Select Role</option>
              <option value="coordinator">Club Coordinator</option>
              <option value="president">President</option>
              <option value="bearer">Bearer</option>
            </select>
            <input type="hidden" name="status" id="status" value="Enabled" />
          
            <input
              type="submit"
              id="sub"
              name="sub"
              value="Add Creator"
              class="update__btn-new"
            />
          </form>
        </div>
      </div>
    </div>
     