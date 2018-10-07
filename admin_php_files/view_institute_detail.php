<?php
    include("home_header.php");
?>
<!--section for intro text and button starts-->
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <h1>View School Detail</h1>
    </div>
  </div>
</div>
<!--section for intro text and button ends--> 

<!--section for features starts-->
<div class="section colored">
  <div class="container clearfix"> 
 
	<div class="table_wrapper table_red">
        <table cellpadding="0" cellspacing="0">
          <thead>
            <tr>
              <th>Sno</th>
              <th>School Id</th>
              <th>School Name</th>
              <th>Details </th>
              <th>Address </th>
              <th>Email Id </th>
              <th>Phone Number </th>
              <th>Username </th>
              <th>Status </th>
              <th>Add Course</th>
            </tr>
          </thead>
		  <?php   $count=0;
   $t2=mysqli_query($db,"select * from institution");
   $rows=mysqli_num_rows($t2);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
          <tbody>
            <tr>
              <td><?php echo $count; ?></td> 
              <td><?php echo $r['institute_id']; ?></td>
              <td><?php echo $r['institute_name']; ?></td>
              <td><?php echo $r['details']; ?></td>
              <td><?php echo $r['address']; ?></td>
              <td><?php echo $r['email_id']; ?></td>
              <td><?php echo $r['phone_no']; ?></td>
              <td><?php echo $r['username']; ?></td>
              <td><?php echo $r['status']; ?></td> 
              <td><a href="add_course.php?id=<?php echo $r['institute_id']; ?>" class="view_faculty_detail"> Add</td>
            </tr>
       	  </tbody>
	<?php } ?>
        </table>
      </div>
    <!--features starts-->
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