<?php
     include("inst_head.php"); 
?>
      <div class="new-container">
                    <h1 class="update-form-header">Create Club Coordinator</h1>
                    <hr class="hr_under_one hr_new">
                    <div class="club-cb-section">
                        <div>
                        </div>
                        <div class="club-cb-section-sub">
                            <a href="add_creator.php" class="club-cb-link "><i class="fas fa-plus"></i>
                                Add New Club Coordinator Here</a>
                        </div>
                    </div>
	  
<?php 
       $r1=mysqli_query($db,"select * from inst_club_coordinator where institute_id='$uid'");
       while($g1=mysqli_fetch_array($r1))
       { ?>   	  
      <div class="club-cb-desc club-cb-effect">
        <ul class="club-cb-desc-list">
          <li><?php echo $g1['name']; ?></li>
          <li>Username : <?php echo $g1['username']; ?></li>
          <li>Password : <?php echo $g1['password']; ?></li>
          <li>Role : <?php echo $g1['role']; ?></li>
        </ul>
        <h1 class="club-cb-add">Club Registered For</h1>
        <a href="assign_coordinator_club.php?creator_id=<?php echo $g1[1]; ?>" class="club-cd-add-link teacher_login_form" data-toggle="modal" data-target="#modalIframe"><i class="fas fa-plus"></i> Add Club</a>
        <ul class="club-cb-desc-add-list">
         <?php
         $r8=mysqli_query($db,"select a.club_id,b.club_name,c.club_category_name from cc_club_assign a,clubs b,club_category c where a.club_coordinator_id='$g1[1]' and a.club_id=b.club_id and b.club_category_id=c.club_category_id");
         $subject=array();
         $count1=0;
          while($g=mysqli_fetch_array($r8))
          {
              echo  "<li>$g[1]".' '."$g[2] <p align='right' style='display:inline'> <i class='fas fa-times' style='cursor:pointer;' onclick='delete_assigned_subject(\"$g1[1]\",\"$g[0]\")'></i> </p></li>";
           }
	 ?> 
        </ul>
      </div>  <?php } ?>
    </div>
    <div class="modal fade" id="modalIframe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">

                    <div class="modal-body mb-0 p-0">

                        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                            <iframe class="embed-responsive-item" src="https://www.iclubs.in" allowfullscreen></iframe>
                        </div>

                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                    </div>

                </div>

            </div>
        </div>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
      integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
      crossorigin="anonymous"
    />
  </body>
</html>

<script type="text/javascript">
 function delete_assigned_subject(p,q)
  {
     var r = confirm("Do you confirm to unassign this Club from Club Coordinator");
     if(r == true) 
     {
                                           $.ajax({
						  type: 'POST',
						  url: 'delete_assigned_subject.php?creator_id='+p+'&club_id='+q,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){  
                                                          if(response == 'error')
                                                            { alert("Error in the system. Please try it later"); }
                                                          else { location.reload(); }                 
                                                    }
					       });
     } 
     else 
     {
     }
  }

function delete_creator(p)
  {
     var r = confirm("Do you confirm to delete Test Creator");
     if(r == true) 
     {
                                           $.ajax({
						  type: 'POST',
						  url: 'delete_test_creator.php?creator_id='+p,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){  
                                                          if(response == 'error')
                                                            { alert("Error in the system. Please try it later"); }
                                                          else { location.reload(); }                 
                                                    }
					       });
     } 
     else 
     {
     }
  }

function creator_update()
{
    location.reload();
}
</script>
