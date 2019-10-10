<?php
    include("home_header.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>

<body>
    <nav>
        <ul class="nav__main">
            <li class="logo-list">SPACEDTIMES</li>
            <li class="admin_name dropdown"><i class="fas fa-angle-down secondary-icons"></i>
                <div class="dropdown-content">
                    <a href="#" class="logout-link">Logout</a>
                </div>
            </li>
            <li class="menu"><i class="fas fa-bars menu-icons"></i></li>
        </ul>
    </nav>
    <div class="page-description-header">
        <div class="page-container">
            <h1 class="page-description-text">View/Update Vendor Detail</h1>
        </div>
    </div>
    <div class="page-container">
        <table id="page-table">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>Vendor Id</th>
                    <th>Vendor Name </th>
                    <th>Vendor Icon </th>
                    <th>Vendor Decription </th>
                    <th>Formation Year </th>
                    <th>Permanent Address </th>
                    <th>Country </th>
                    <th>Vendor Added Date</th>
                    <th>Action</th>
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
                    <td>
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <?php echo $r['vendor_id']; ?>
                    </td>
                    <td>
                        <?php echo $r['vendor_name']; ?>
                    </td>
                    <td>
                        <?php echo $r['vendor_icon']; ?>
                    </td>
                    <td>
                        <?php echo $r['vendor_decription']; ?>
                    </td>
                    <td>
                        <?php echo $r['formation_year']; ?>
                    </td>
                    <td>
                        <?php echo $r['permanent_address']; ?>
                    </td>
                    <td>
                        <?php echo $r['country']; ?>
                    </td>
                    <td>
                        <?php echo $r['date_time']; ?>
                    </td>
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
        <a href="index.php" class="home_link">Home</a>
    </div>
    <?php
    include("admin_footer.php");
?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
        crossorigin="anonymous">
</body>

</html>