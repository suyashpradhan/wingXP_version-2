<?php
    include("home_header.php");
    if(isset($_GET['id']))
    {
       $institute_id=$_GET['id'];
       $r=mysql_query("select course_code from inst_course_assign where institute_id='$institute_id'");
       $course=array();
       while($g=mysql_fetch_array($r))
       {
         $course[]=$g[0];
       }
    }
?> 

<!--section for intro text and button starts-->
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <h1>Add Courses To Institute Id: <?php echo $institute_id; ?></h1>
    </div>
  </div>
</div>
<!--section for intro text and button ends--> 
<div class="section colored">
  <div class="container clearfix">   
    <!--features starts-->
<div>
  <div> 
      <div class="table_wrapper table_red table-bordered">
      <form action="" method="post">
        <table cellpadding="0" cellspacing="0">
          <thead>
            <tr>
                          <th>School Exam &nbsp;&nbsp;&nbsp;&nbsp;  <a href="add_school_course.php?id=<?php echo $institute_id; ?>" class="pop"> <img src="images/plus.png" width="15px"></a></th>
                          <th>Competitive UG &nbsp;&nbsp;&nbsp;&nbsp;  <a href="add_ug_course.php?id=<?php echo $institute_id; ?>" class="pop"> <img src="images/plus.png" width="15px"></a></th>
			  <th>Competitive Job &nbsp;&nbsp;&nbsp;&nbsp;  <a href="add_job_course.php?id=<?php echo $institute_id; ?>" class="pop"><img src="images/plus.png" width="15px"></a></th>
	   </tr>
</thead>
  <tbody>
           <tr>
                 <td>
                    <table>
                      <?php  
                               $count1=0;
                               $r1=mysql_query("select * from inst_course where course_type='school'");
                               while($g1=mysql_fetch_array($r1))
                                 { $count1++;
                                     if($count1%3 == '0')
                                       {  
                                            if(in_array($g1[1],$course))
                                              { 
                                                 echo "<td><input type='checkbox' name='course[]' id='$g1[1]' checked='checked' disabled value='$g1[1]' /> $g1[3]</td></tr>";
                                              }
                                            else
                                              {
                                                echo "<td><input type='checkbox' name='course[]' id='$g1[1]' value='$g1[1]' /> $g1[3]</td></tr>";
                                              } 
				       }
                                     else if($count1%3 == '1') 
                                       { 
					   if(in_array($g1[1],$course))
                                              { 
                                                 echo "<tr><td> <input type='checkbox' name='course[]' id='$g1[1]' checked='checked' disabled value='$g1[1]' /> $g1[3]</td>";
                                              }
                                            else
                                              {
                                                echo "<tr><td> <input type='checkbox' name='course[]' id='$g1[1]' value='$g1[1]' /> $g1[3]</td>";
                                              }  
				       } 
                                     else if($count1%3 == '2')
                                       { 
					    if(in_array($g1[1],$course))
                                              { 
                                                 echo "<td> <input type='checkbox' name='course[]' id='$g1[1]' checked='checked' disabled value='$g1[1]' /> $g1[3]</td>";
                                              }
                                            else
                                              {
                                                echo "<td> <input type='checkbox' name='course[]' id='$g1[1]' value='$g1[1]' /> $g1[3]</td>";
                                              } 
				       }
                                 }
                       ?>
                      </table>
                  </td>
                 <td>
                    <table>
                      <?php  
                               $count1=0;
                               $r1=mysql_query("select * from inst_course where course_type='ug'");
                               while($g1=mysql_fetch_array($r1))
                                 { $count1++;
                                     if($count1%3 == '0')
                                       {  
                                            if(in_array($g1[1],$course))
                                              { 
                                                 echo "<td><input type='checkbox' name='course[]' id='$g1[1]' checked='checked' disabled value='$g1[1]' /> $g1[3]</td></tr>";
                                              }
                                            else
                                              {
                                                echo "<td><input type='checkbox' name='course[]' id='$g1[1]' value='$g1[1]' /> $g1[3]</td></tr>";
                                              } 
				      }
                                     else if($count1%3 == '1') 
                                       { 
					   if(in_array($g1[1],$course))
                                              { 
                                                 echo "<tr><td> <input type='checkbox' name='course[]' id='$g1[1]' checked='checked' disabled value='$g1[1]' /> $g1[3]</td>";
                                              }
                                            else
                                              {
                                                echo "<tr><td> <input type='checkbox' name='course[]' id='$g1[1]' value='$g1[1]' /> $g1[3]</td>";
                                              }  
				       } 
                                     else if($count1%3 == '2')
                                       { 
					    if(in_array($g1[1],$course))
                                              { 
                                                 echo "<td> <input type='checkbox' name='course[]' id='$g1[1]' checked='checked' disabled value='$g1[1]' /> $g1[3]</td>";
                                              }
                                            else
                                              {
                                                echo "<td> <input type='checkbox' name='course[]' id='$g1[1]' value='$g1[1]' /> $g1[3]</td>";
                                              } 
				       }
                                 }
                       ?>
                      </table>
                  </td>
                  <td>
                    <table>
                      <?php  
                               $count1=0;
                               $r1=mysql_query("select * from inst_course where course_type='job'");
                               while($g1=mysql_fetch_array($r1))
                                 { $count1++;
                                     if($count1%3 == '0')
                                       {  
                                            if(in_array($g1[1],$course))
                                              { 
                                                 echo "<td><input type='checkbox' name='course[]' id='$g1[1]' checked='checked' disabled value='$g1[1]' /> $g1[3]</td></tr>";
                                              }
                                            else
                                              {
                                                echo "<td><input type='checkbox' name='course[]' id='$g1[1]' value='$g1[1]' /> $g1[3]</td></tr>";
                                              } 
				      }
                                     else if($count1%3 == '1') 
                                       { 
					   if(in_array($g1[1],$course))
                                              { 
                                                 echo "<tr><td> <input type='checkbox' name='course[]' id='$g1[1]' checked='checked'  disabled value='$g1[1]' /> $g1[3]</td>";
                                              }
                                            else
                                              {
                                                echo "<tr><td> <input type='checkbox' name='course[]' id='$g1[1]' value='$g1[1]' /> $g1[3]</td>";
                                              }  
				       } 
                                     else if($count1%3 == '2')
                                       { 
					    if(in_array($g1[1],$course))
                                              { 
                                                 echo "<td> <input type='checkbox' name='course[]' id='$g1[1]' checked='checked' disabled value='$g1[1]' /> $g1[3]</td>";
                                              }
                                            else
                                              {
                                                echo "<td> <input type='checkbox' name='course[]' id='$g1[1]' value='$g1[1]' /> $g1[3]</td>";
                                              } 
				       }
                                 }
                       ?>
                      </table>
                  </td>
               </tr>
                <tr>
                      <td colspan="3"><input type="submit" name="sub" id="sub" value="Add" /></td>
                </tr>    
         </tbody>
        </table>
</form>
      </div>
    <!--features starts-->
 </div>
</div>
        <!--spacer here-->
      <div class="spacer_30px"></div>
      <!--spacer ends-->
       </div>
    <!--features ends--> 
   </div>
</div>
<!--section for features ends--> 
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <!--button wrapper here-->
      <a href="index.php" class="button button-orange"> <span>Click Here! to go home screen</span> </a>
    </div>
  </div>
</div> 
<!--copyright starts-->
<?php
    include("admin_footer.php");
?>
<!--copyright ends--> 
</body>
</html>

<?php
    if(isset($_POST['sub']))
     {
         if(!empty($_POST['course'])){
           // Loop to store and display values of individual checked checkbox.
           foreach($_POST['course'] as $selected){
             $r5=mysql_query("select * from inst_course_assign where institute_id='$institute_id' and course_code='$selected'");
             $num=mysql_num_rows($r5);
             if($num == '0')
              {
                $r4=mysql_query("insert into inst_course_assign values('','$institute_id','$selected')");
                if($r4)
                 {
                      echo $selected. "-Courses Added";
                 }
                else
                 {
                    echo "<script language='javascript'>alert('Error in the system. Please try it later');</script>";
                 }
              }
           }
         }
     }
?>