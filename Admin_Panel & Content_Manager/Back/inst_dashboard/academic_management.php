<?php
     session_start();
     include("inst_header.php"); 
     $database = new Database();
    $conn = $database->getConnection();
     if(isset($_GET['course_code']))
      { $uid="inst_1"; //TEMPORARY
         $course=$_GET['course_code'];
         $r9 = $conn->query("select * from inst_course_assign where institute_id='$uid' and course_code='$course'");
         $num_row=mysqli_num_rows($r9);
          if($num_row == '0')
           {  
              echo "<script language='javascript'>window.location='inst_dashboard.php';</script>"; exit(); 
           }
         else
           {
              $_SESSION['course']=$_GET['course_code'];
              
              
           }  
    }   
?>

<div class="middleWrapper_Academic">
        <ul class="academic_list">
            <li>
                <a href="batch_management.php" class="academic_links">BATCH MANAGEMENT</a>
            </li>
            <li>
                <a href="make_test_creator.php" class="academic_links">CREATOR MANAGEMENT</a>
            </li>
            <li>
                <a href="display_management.php" class="academic_links">DISPLAY MANAGEMENT</a>
            </li>
            <li>
                <a href="test_store_management.php" class="academic_links">STORE MANAGEMENT</a>
            </li>
            <li>
                <a href="user_management.php" class="academic_links">USER MANAGEMENT</a>
            </li>
        </ul>
        <div class="academic_header">
            <h1 class="academic_header-text">Academic Management</h1>
            <a href="#" class="academic_header_link">ADD DELETE MODIFY BATCHES AND COURSES</a>
              <form action="#" method="post">
               <select name="" class="academic_course"  id="course" name="course" onchange="change_course()">
                   <?php $r=$conn->query("select a.course_name,b.course_code from gen_course a, inst_course_assign b where a.course_code=b.course_code and b.institute_id='$uid'");
      $course_num=mysqli_num_rows($r);
      if($course_num > '0')
      { 
        while($r1=mysqli_fetch_array($r))
       {  
          if(isset($_SESSION['course']) && ($_SESSION['course'] == $r1[1]))
            {  
              ?>
                <option value='<?php echo $r1[1]; ?>' selected><?php echo $r1[0]; ?></option>   
   <?php    }
           else { ?>
               <option value='<?php echo $r1[1]; ?>'><?php echo $r1[0]; ?></option> 
<?php }
           if(!isset($_SESSION['course']))
           { 
                $_SESSION['course']=$r1[1];
           }
         $course=$_SESSION['course'];
      ?>    
<?php }
      }
      else
      { ?>
          <option  disabled="disabled" selected>No Course Assigned</option>     
  <?php    }
 ?>
                </select></a>
         </div>
</div>

<div class="container">
        <div style="overflow-x:auto;overflow-y:auto">
            <table class="table table-hover academic_table table-bordered">
                 <thead class="thead-dark academic-table-header">
                    <tr>
                        <th scope="col">CLASS
                          <a href="add_class.php" class="pop">  <span style="float: right;font-size: 10px;text-align: center;margin:0;">+
                                <br> ADD
                            </span> </a>
                        </th>
                        <th scope="col">SUBJECTS
                           <a href="add_subject.php" class="pop"> <span style="float: right;font-size: 10px;text-align: center;margin: 0;padding: 0">+
                                <br> ADD
                            </span> </a>
                        </th>
                        <th scope="col">Topics
                          <a href="add_topic.php" class="pop">  <span style="float: right;font-size: 10px;text-align: center;margin: 0;padding: 0">+
                                <br> ADD
                            </span></a>
                        </th>
                        <th scope="col">Sub-Topics
                           <a href="add_sub_topic.php" class="pop"> <span style="float: right;font-size: 10px;text-align: center;margin: 0;padding: 0">+
                                <br> ADD
                            </span></a>
                        </th>
						  <th scope="col">Combination
                           <a href="add_combination.php" class="pop"> <span style="float: right;font-size: 10px;text-align: center;margin: 0;padding: 0">+
                                <br> ADD
                            </span></a>
                        </th> 
                    </tr>
                </thead>
				 <tbody>
<tr>
<td>
      <table name="class_table" id="class_table" class="table">
             <?php  
                    $rc=$conn->query("select a.class_name,a.class_id from gen_course_class a, inst_course_assign b where b.course_code=a.course_id and b.course_code='$course' and b.institute_id=a.institute_id and b.institute_id='$uid'");
                    while($gc=mysqli_fetch_array($rc))
                      { ?>
                         <tr><td id="<?php echo $gc[1]; ?>" class="class_row" name="<?php echo $gc[1]; ?>" ><?php echo $gc[0]; ?> <p style="margin: 0px;
    display: inline; float: right;' style='cursor:pointer;">&nbsp;&nbsp;<i class="fas fa-times" style='cursor:pointer;' onclick="delete_class('<?php echo $gc[1]; ?>')"></i> &nbsp;&nbsp;<a href="edit_class.php?id=<?php echo $gc[1]; ?>" class="pop"><i class="fas fa-pencil-alt"></i></a>&nbsp;&nbsp;<i class="fas fa-caret-right" onclick='get_subject("<?php echo $gc[1]; ?>")' style='cursor:pointer;'></i></p></td><tr> 
                    <?php  }    
              ?>
      </table> 
</td>
<td>
     <table name="subject_table" id="subject_table" class="table">
     </table>
</td> 
<td>
     <table name="topic_table" id="topic_table" class="table">
     </table>
</td>   
<td>
     <table name="subtopic_table" id="subtopic_table" class="table"> 
     </table>
</td> 
<td>
     <table name="combinations" id="combinations" class="table">
     </table>
</td> 
													 
												</tr>
             </tbody>
  </table>
</div>
</div>

                        </div>

		<!-- Scripts -->
			<script src="../website/assets3/js/jquery.scrollex.min.js"></script>
			<script src="../website/assets3/js/jquery.scrolly.min.js"></script>
			<script src="../website/assets3/js/skel.min.js"></script>
			<script src="../website/assets3/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets3/js/ie/respond.min.js"></script><![endif]-->
			<script src="../website/assets3/js/main.js"></script>
<script language='javascript'>
var parent_page_url= window.location.pathname;
function add_class()
{
    var course=$('#course').val();
    alert(course);
}

function get_subject(p)
{
             $('.class_row').css("background-color","white");
             $('#'+p).css("background-color","yellow");
                                         $.ajax({
						  type: 'POST',
						  url: 'get_inst_subject.php?class_id='+p,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){
						     $('#subject_table').html(response);
                                                     $('#topic_table').html('');
                                                     $("a.pop").fancybox({
                                                                        'type': 'iframe',
				                                        'autoScale': true,
				                                        'autoDimensions': true,
				                                        'fitToView' : true,
                                                                      });  
                                                       
                                                  }
					      });
}

function get_topic(p)
{
             $('.subject_row').css("background-color","white");
             $('#'+p).css("background-color","yellow");
                                         $.ajax({
						  type: 'POST',
						  url: 'get_inst_topic.php?subject_id='+p,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){
						     $('#topic_table').html(response);
                                                     $('#subtopic_table').html('');
                                                     $("a.pop").fancybox({
                                                                        'type': 'iframe',
				                                        'autoScale': true,
				                                        'autoDimensions': true,
				                                        'fitToView' : true,
                                                                      });  
						  }
					       });
}


function get_subtopic(p)
{
             $('.topic_row').css("background-color","white");
             $('#'+p).css("background-color","yellow");
                                         $.ajax({
						  type: 'POST',
						  url: 'get_inst_subtopic.php?topic_id='+p,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){
						     $('#subtopic_table').html(response);
                                                     $("a.pop").fancybox({
                                                                        'type': 'iframe',
				                                        'autoScale': true,
				                                        'autoDimensions': true,
				                                        'fitToView' : true,
                                                                      });  
						  }
					       });
}

function class_add(p,q)
{
    if($("#no_class").length == 0) {
        }
   else
      { $("#no_class").remove(); }  
   $('#class_table').append("<tr><td id="+q+">"+p+"<p align='right' style='margin: 0px; display: inline; float: right;'>&nbsp;&nbsp;<i class='fas fa-times' onclick='delete_class(\""+q+"\")' width='20px' style='cursor:pointer;'>&nbsp;&nbsp;<a href='edit_class.php?id="+q+"' class='pop'><i class='fas fa-pencil-alt' width='20px' style='cursor:pointer;'> </a>&nbsp;&nbsp;<i class='fas fa-caret-right' width='20px' onclick='get_subject(\""+q+"\")' style='cursor:pointer;'></p></td></tr>");
     $("a.pop").fancybox({
                            'type': 'iframe',
			    'autoScale': true,
			    'autoDimensions': true,
			    'fitToView' : true,
                       }); 
}

function subject_add(p,q)
{
   if($("#no_subject").length == 0) {
        }
   else
      { $("#no_subject").remove(); } 

   $('#subject_table').append("<tr><td id="+q+">"+p+"<p align='right' style='margin: 0px; display: inline; float: right;'>&nbsp;&nbsp;<img src='img/delete.png' onclick='delete_subject(\""+q+"\")' width='20px' style='cursor:pointer;'>&nbsp;&nbsp;<a href='edit_subject.php?id="+q+"' class='pop'><img src='img/edit.png' width='20px' style='cursor:pointer;'></a>&nbsp;&nbsp;<img src='img/arrow.png' width='20px' onclick='get_topic(\""+q+"\")' style='cursor:pointer;'></p></td></tr>");
     $("a.pop").fancybox({
                            'type': 'iframe',
			    'autoScale': true,
			    'autoDimensions': true,
			    'fitToView' : true,
                       }); 
}

function topic_add(p,q)
{
    if($("#no_topic").length == 0) {
        }
   else
      { $("#no_topic").remove(); } 
   $('#topic_table').append("<tr><td id="+q+">"+p+"<p align='right' style='margin: 0px; display: inline; float: right;'>&nbsp;&nbsp;<img src='img/delete.png' onclick='delete_topic(\""+q+"\")' width='20px' style='cursor:pointer;'>&nbsp;&nbsp;<a href='edit_topic.php?id="+q+"' class='pop'><img src='img/edit.png' width='20px' style='cursor:pointer;'></a> &nbsp;&nbsp;<img src='img/arrow.png' width='20px' onclick='get_subtopic(\""+q+"\")' style='cursor:pointer;'></p></td></tr>");
     $("a.pop").fancybox({
                            'type': 'iframe',
			    'autoScale': true,
			    'autoDimensions': true,
			    'fitToView' : true,
                       }); 
}

function subtopic_add(p,q)
{
    if($("#no_subtopic").length == 0) {
        }
   else
      { $("#no_subtopic").remove(); } 
   $('#subtopic_table').append("<tr><td id="+q+">"+p+"<p align='right' style='margin: 0px; display: inline; float: right;'>&nbsp;&nbsp;<img src='img/delete.png' onclick='delete_subtopic(\""+q+"\")' width='20px' style='cursor:pointer;'>&nbsp;&nbsp;<a href='edit_subtopic.php?id="+q+"' class='pop'><img src='img/edit.png' width='20px' style='cursor:pointer;'></a>&nbsp;&nbsp;<img src='img/arrow.png' width='20px' onclick='get_subject(\""+q+"\")' style='cursor:pointer;'></p></td></tr>");
       $("a.pop").fancybox({
                            'type': 'iframe',
			    'autoScale': true,
			    'autoDimensions': true,
			    'fitToView' : true,
                       });
}


function class_update(p,q)
{
    $('#'+q).html(p+"<p align='right' style='margin: 0px; display: inline; float: right;'>&nbsp;&nbsp;<i class='fas fa-times' onclick='delete_class(\""+q+"\")' width='20px' style='cursor:pointer;'></i>&nbsp;&nbsp;<a href='edit_class.php?id="+q+"' class='pop'><i class='fas fa-pencil-alt' width='20px' style='cursor:pointer;'></i></a>&nbsp;&nbsp;<i class='fas fa-caret-right' width='20px' onclick='get_subject(\""+q+"\")' style='cursor:pointer;'></i></p>");
     $("a.pop").fancybox({
                            'type': 'iframe',
			    'autoScale': true,
			    'autoDimensions': true,
			    'fitToView' : true,
                       });
}

function subject_update(p,q)
{
    $('#'+q).html(p+"<p align='right' style='margin: 0px; display: inline; float: right;'>&nbsp;&nbsp;<img src='img/delete.png' onclick='delete_subject(\""+q+"\")' width='20px' style='cursor:pointer;'>&nbsp;&nbsp;<a href='edit_subject.php?id="+q+"' class='pop'><img src='img/edit.png' width='20px' style='cursor:pointer;'></a>&nbsp;&nbsp;<img src='img/arrow.png' width='20px' onclick='get_subject(\""+q+"\")' style='cursor:pointer;'></p>");
    $("a.pop").fancybox({
                            'type': 'iframe',
			    'autoScale': true,
			    'autoDimensions': true,
			    'fitToView' : true,
                       });
}

function topic_update(p,q)
{
   $('#'+q).html(p+"<p align='right' style='margin: 0px; display: inline; float: right;'>&nbsp;&nbsp;<img src='img/delete.png' onclick='delete_topic(\""+q+"\")' width='20px' style='cursor:pointer;'>&nbsp;&nbsp;<a href='edit_topic.php?id="+q+"' class='pop'><img src='img/edit.png' width='20px' style='cursor:pointer;'></a>&nbsp;&nbsp;<img src='img/arrow.png' width='20px' onclick='get_subject(\""+q+"\")' style='cursor:pointer;'></p>");
   $("a.pop").fancybox({
                            'type': 'iframe',
			    'autoScale': true,
			    'autoDimensions': true,
			    'fitToView' : true,
                       });
}

function subtopic_update(p,q)
{
   $('#'+q).html(p+"<p align='right' style='margin: 0px; display: inline; float: right;'>&nbsp;&nbsp;<img src='img/delete.png' onclick='delete_subtopic(\""+q+"\")' width='20px' style='cursor:pointer;'>&nbsp;&nbsp;<a href='edit_subtopic.php?id="+q+"' class='pop'><img src='img/edit.png' width='20px' style='cursor:pointer;'></a>&nbsp;&nbsp;<img src='img/arrow.png' width='20px' onclick='get_subject(\""+q+"\")' style='cursor:pointer;'></p>");
    $("a.pop").fancybox({
                            'type': 'iframe',
			    'autoScale': true,
			    'autoDimensions': true,
			    'fitToView' : true,
                       });
}


function change_course()
{
    var course=$('#course').val();
    window.location=parent_page_url+"?course_code="+course;
}

function delete_class(p)
{
   var r = confirm("Do you want to delete this class");
   if(r == true) 
   {
                                           $.ajax({
						  type: 'POST',
						  url: 'delete_class_id.php?class_id='+p,
						  data: {class_id: p},
						  beforeSend: function() {  
							},
						  success: function(response){  
                              alert(response);
						         $('#'+response).remove(); 
                                                    }
					       });
   } 
   else 
   {
   }
}

function delete_subject(p)
{
   var r = confirm("Do you want to delete this subject");
   if(r == true) 
   {
                                          $.ajax({
						  type: 'POST',
						  url: 'delete_subject_id.php?subject_id='+p,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){
						         $('#'+response).hide(); 
                                                    }
					       });
   } 
   else 
   {
   }
}

function delete_topic(p)
{
   var r = confirm("Do you want to delete this topic");
   if(r == true) 
   {
                                           $.ajax({
						  type: 'POST',
						  url: 'delete_topic_id.php?topic_id='+p,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){
						         $('#'+response).hide(); 
                                                    }
					       });
   } 
   else 
   {
   }
}

function delete_subtopic(p)
{
   var r = confirm("Do you want to delete this subtopic");
   if(r == true) 
   {
                                            $.ajax({
			 			  type: 'POST',
						  url: 'delete_subtopic_id.php?subtopic_id='+p,
						  data: '',
						  beforeSend: function() {  
							},
						  success: function(response){
						         $('#'+response).hide(); 
                                                    }
					       });
   } 
   else 
   {
   }
}
</script>
</body>
</html>