<link rel="stylesheet" href="assets/css/main.css" />
<script type="text/javascript" src="fancybox/jquery.min.js"></script>
<script src="fancybox/jquery-ui.js" type="text/javascript"></script>
<link rel="stylesheet" href="fancybox/jquery-ui.css" />
<script language='javascript'>
$(function() {
$("#start_date").datepicker({ dateFormat: 'dd-mm-yy' });
});
$(function() {
$("#end_date").datepicker({ dateFormat: 'dd-mm-yy' });
});
</script>
<?php
session_start();
if(isset($_GET['creator_id']))
{
   $creator_id=$_GET['creator_id'];
}
include("assets/php/database.php");
include("assets/php/class.acl.php"); 
$database = new Database();
$db = $database->getConnection();
include_once "class_admin.php";
include_once "assets/Users.php";
$user = new User($db);
$uid = $_SESSION['Userid'];
       $r1=mysqli_query($db,"select role from inst_club_coordinator where club_coordinator_id='$creator_id'");
       $g1=mysqli_fetch_array($r1);
       $role= $g1['role'];    
?>    

  <div class="new-container">
                <div class="batch-card assign_card batch-card_2">
                    <h1 class="update-form-header">Assign Club</h1>
                    <hr class="hr_under_one hr_new">
          <form action="" method="post" id="fileUploadForm" enctype="multipart/form-data" class="assign-form">
            <input type="hidden" id="creator_id" name="creator_id" value="<?php echo $creator_id; ?>" />

             <select id="club_category" name="club_category" class="diff-fields"  onchange="get_club()" >
                <option disabled selected>Select Club Category</option>     
              <?php  
                      if($role == 'coordinator')
                       { 
                     $r3=mysqli_query($db,"select a.club_name,b.club_id,a.club_category_id from clubs a, inst_club_assign b where a.club_id=b.club_id and b.institute_id='$uid' group by a.club_category_id");  
                                   while($g3=mysqli_fetch_array($r3))
                                   {
                                       $club_category_id=$g3['club_category_id'];
                                       $r4=mysqli_query($db,"select club_category_name from club_category where club_category_id='$club_category_id'");
                                       $g4=mysqli_fetch_array($r4);
                                    ?>
                                     <option value="<?php echo $club_category_id; ?>"><?php echo $g4[0]; ?></option>
                         <?php } } 
                        else
                            {
                                  echo "<option value='CCI_8'>School Club</option>";       
                            }
?>   
            </select>

  <!-- <div class="table-wrapper" id="subject_section"> </div> </div> -->
  <input  type="submit" id="sub" name="sub" value="Assign Club" class="update__btn-new assign-btn" />
          </form>
        </div>
      </div>
    </div>

<?php
    if(isset($_POST['sub']))
     {
         $creator_id=$_POST['creator_id'];
          if(!empty($_POST['subjects']))
          {
           // Loop to store and display values of individual checked checkbox.
           foreach($_POST['subjects'] as $selected)
             {
                $r4=mysqli_query($db,"insert into cc_club_assign values('','$creator_id','$selected')");
                if($r4)
                 {
                      echo $selected. "-Club Added";
                 }
                else
                 {
                    echo "<script language='javascript'>alert('Error in the system. Please try it later');</script>";
                 }
              }
           }
     }
 ?>

<script language='javascript'>
  function get_class()
   {
       var course_id=$('#course').val();
                                             $.ajax({
						  type: 'POST',
						  url: 'get_class_array.php?course_id='+course_id,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){   
						     $('#class').html(response);
						  }
					       });
   }

   function get_club()
   {   
       var club_category_id=$('#club_category').val();
       var creator_id=$('#creator_id').val();
                                            $.ajax({
						  type: 'POST',
						  url: 'get_club_array.php?club_category_id='+club_category_id+'&creator_id='+creator_id,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){   
						     $('#subject_section').html(response);
						  }
					       });
   }
</script>
