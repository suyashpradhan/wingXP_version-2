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
            <li class="logo-list"><a href="logo-list" style="text-decoration:none;color:#fff;"> SPACEDTIMES </a></li>
            <li><a href="" class="logout-link">Logout</a></li>
        </ul>
    </nav>
    <div class="page-description-header">
        <div class="page-container">
            <h1 class="page-description-text">View School Detail</h1>
        </div>
    </div>
    <div class="page-container">
        <table id="page-table">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>School Id</th>
                    <th>School Name</th>
                    <th>Details</th>
                    <th>Address</th>
                    <th>Email Id </th>
                    <th>Phone Number</th>
                    <th>Username</th>
                    <th>Status</th>
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
                    <td>
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <?php echo $r['institute_id']; ?>
                    </td>
                    <td>
                        <?php echo $r['institute_name']; ?>
                    </td>
                    <td>
                        <?php echo $r['details']; ?>
                    </td>
                    <td>
                        <?php echo $r['address']; ?>
                    </td>
                    <td>
                        <?php echo $r['email_id']; ?>
                    </td>
                    <td>
                        <?php echo $r['phone_no']; ?>
                    </td>
                    <td>
                        <?php echo $r['username']; ?>
                    </td>
                    <td>
                        <?php echo $r['status']; ?>
                    </td>
                    <td><a href="add_course.php?id=<?php echo $r['institute_id']; ?>" class="view_faculty_detail"> Add</td>
                </tr>
            </tbody>
            <?php } ?>
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