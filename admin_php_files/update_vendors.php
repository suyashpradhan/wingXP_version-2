<?php
    include("home_header.php");
?>
<!--section for intro text and button starts-->
<div class="section">
  <div class="container clearfix">
    <div class="grid_12 action3">
      <h1>View/Update Vendor Detail</h1>
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
              <th>Vendor Id</th>
              <th>Vendor Name</th>
              <th>Vendor Icon</th>
              <th>Vendor Decription</th>
              <th>Formation Year</th>
              <th>Permanent Address </th>
              <th>Country</th>
              <th>Vendor Added Date</th>
            </tr>
          </thead>
<?php   
   $count=0;
   $t2=mysqli_query($db,"select * from vendor");
   $rows=mysqli_num_rows($t2);
   
   if($rows>0)
   {
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
          <tbody>
            <tr>
              <td><?php echo $count; ?></td> 
              <td><?php echo $r['vendor_id']; ?></td>
              <td><?php echo $r['vendor_name']; ?></td>
              <td><?php echo $r['vendor_icon']; ?></td>
              <td><?php echo $r['vendor_decription']; ?></td>
              <td><?php echo $r['formation_year']; ?></td> 
              <td><?php echo $r['permanent_address']; ?></td>
              <td><?php echo $r['country']; ?></td>
              <td><?php echo $r['date_time']; ?></td>
              <td><a href="update_vendor_detail.php?id=<?php echo $r['vendor_id']; ?>" class="view_faculty_detail">Update</td>
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