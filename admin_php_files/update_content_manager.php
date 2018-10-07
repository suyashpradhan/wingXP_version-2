<?php
    include("home_header.php");
?>
<!--section for intro text and button starts-->
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <h1>View/Update Content Manager Detail</h1>
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
              <th>Content Manager Id</th>
              <th>Name</th>
              <th>Date of Birth</th>
              <th>Address</th>
              <th>Phone Number</th>
              <th>Email Id</th>
              <th>Nationality</th>
              <th>Qualification</th>
              <th>Experience</th>
              <th>Photo</th>
              <th>Phone Number2</th>
            </tr>
          </thead>
		  <?php   $count=0;
   $t2=mysqli_query($db,"select * from content_manager");
   $rows=mysqli_num_rows($t2);
   
   if($rows>0)
   {
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
          <tbody>
            <tr>
              <td><?php echo $count; ?></td> 
              <td><?php echo $r['content_manager_id']; ?></td>
              <td><?php echo $r['name']; ?></td>
              <td><?php echo $r['dob']; ?></td>
              <td><?php echo $r['address']; ?></td>
              <td><?php echo $r['phone_number']; ?></td> 
              <td><?php echo $r['email_id']; ?></td>
              <td><?php echo $r['nationality']; ?></td>
              <td><?php echo $r['qualification']; ?></td>
              <td><?php echo $r['experience']; ?></td>
              <td><?php echo $r['photo']; ?></td>
              <td><?php echo $r['phone_no2']; ?></td>
              <td><a href="update_content_manager_detail.php?id=<?php echo $r['content_manager_id']; ?>" class="view_faculty_detail"> Update</td>
            </tr>
       	  </tbody>
	<?php } }
       else
         { 
            echo "<tbody><tr><td colspan='6'>No Record Found</td></tr></tbody>";
         }
 ?>
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