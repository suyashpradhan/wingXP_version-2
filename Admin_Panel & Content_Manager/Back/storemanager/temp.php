<?php
    
?>
<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$db = $database->getConnection();
function get_data_xl($id){
    $dir = "../assets/dataprocess/data/";
    $pattern="/".$id."/";
    chdir($dir);
    array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
    foreach($files as $filename)
    {
        if (preg_match("/".$id."/", $filename, $match)){
            $file_list[]=$filename;
        }    
    }
    echo $file_list[0];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Testing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/r-2.2.2/sc-1.5.0/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/r-2.2.2/sc-1.5.0/datatables.min.js"></script>
<script>
$(document).ready( function () {
    $('#page-table').DataTable();
} );
</script>
</head>
<body>
<div class="page-container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="school" data-toggle="tab" href="#tab-one" role="tab" aria-controls="tab-one"
                    aria-selected="true">Schools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pending" data-toggle="tab" href="#tab-two" role="tab" aria-controls="tab-two"
                    aria-selected="false">Pending Schools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="approved" data-toggle="tab" href="#tab-three" role="tab" aria-controls="tab-three"
                    aria-selected="false">Approved Schools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="rejected" data-toggle="tab" href="#tab-four" role="tab" aria-controls="tab-four"
                    aria-selected="false">Rejected Schools</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="school">
                <!--ALL-->
                <div style="overflow-x:auto;overflow-y:auto">
        <table id="page-table" class="display">
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
                    <th>Add Club</th>
                    <th>Add Course</th>
                    <th>Update</th>
                    <th>Data Download</th>
                    <th>Delete Students</th>
                </tr>
            </thead>
            <?php   $count=0;
            
   $t2=mysqli_query($db,"select * from institution");
   $rows=mysqli_num_rows($t2);
   echo '<tbody>';
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            
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
                    <td><a class="btn btn-primary" href="add_club.php?id=<?php echo $r['institute_id']; ?>" class="view_faculty_detail"> Add</td>
                    <td><a class="btn btn-primary" href="add_course.php?id=<?php echo $r['institute_id']; ?>" class="view_faculty_detail"> Add</td>
                    <td><a class="btn btn-success"  href="update_school_detail.php?id=<?php echo $r['institute_id']; ?>" class="view_faculty_detail"> Update</td>
                    <td><a class="btn btn-warning"  href="../assets/dataprocess/data/<?php get_data_xl($r['institute_id']);?>" class="view_faculty_detail" download> Download</td>
                    <td><button class="btn btn-danger" onclick="action('remove_students',<?php echo '\''.$r[1].'\'';?>)">Delete</button> </td>
                </tr>
            
            <?php } ?>
            </tbody>
        </table>
      </div>
                <!--ALL-->
            </div>
            <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="pending"><div style="overflow-x:auto;overflow-y:auto">
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
                    <th>Action</th>                    
                </tr>
            </thead>	            
            <?php   $count=0;
   mysqli_data_seek($t2,$r);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
            <?php if($r['status']=='5'){ echo'
                <tr>
                    <td>
                      '.$count.'
                    </td>
                    <td>
                         '.$r["institute_id"].'
                    </td>
                    <td>
                        '.$r['institute_name'].'
                    </td>
                    <td>
                        '.$r['details'].'
                    </td>
                    <td>
                        '.$r['address'] .'
                    </td>
                    <td>
                       '.$r['email_id'].'
                    </td>
                    <td>
                        '.$r['phone_no'].'
                    </td>
                    <td>
                        '.$r['username'].'
                    </td>
                    <td>
                        '.$r['status'].'
                    </td>
                    <td>
                    <button <a class="btn btn-success" style="margin:5px;" onclick="action(\'pending\',\''.$r[1].'\')">Approve</button><br><button <a class="btn btn-danger" onclick="action(\'block\',\''.$r[1].'\')">Reject</button>
                    </td>   
                    </tr>'; ?>
            <?php } else{}?>
            </tbody>
            <?php } ?>
        </table>
      </div> </div>
            <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="approved">
            <div style="overflow-x:auto;overflow-y:auto">
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
                    <th>Action</th>                    
                </tr>
            </thead>	            
            <?php   $count=0;
   mysqli_data_seek($t2,$r);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
            <?php if($r['status']=='true'){ echo'
                <tr>
                    <td>
                    '.$count.'
                    </td>
                    <td>
                         '.$r["institute_id"].'
                    </td>
                    <td>
                        '.$r['institute_name'].'
                    </td>
                    <td>
                        '.$r['details'].'
                    </td>
                    <td>
                        '.$r['address'] .'
                    </td>
                    <td>
                       '.$r['email_id'].'
                    </td>
                    <td>
                        '.$r['phone_no'].'
                    </td>
                    <td>
                        '.$r['username'].'
                    </td>
                    <td>
                        '.$r['status'].'
                    </td>
                    <td>
                    <button class="btn btn-danger" style="margin:5px;" onclick="action(\'approved\',\''.$r[1].'\')">Reject</button>
    <input type="text" class="form-control" style="width:15em;" placeholder="Remark/Reason" id="rej_'.$r[1].'">
                    </td>   
                    </tr>'; ?>
            <?php } else{}?>
            </tbody>
            <?php } ?>
        </table>
      </div> 
            </div>
            <div class="tab-pane fade" id="tab-four" role="tabpanel" aria-labelledby="rejected">
            <div style="overflow-x:auto;overflow-y:auto">
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
                    <th>Action</th>                    
                </tr>
            </thead>	            
            <?php   $count=0;
   mysqli_data_seek($t2,$r);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
            <?php if($r['status']=='false'){ echo'
                <tr>
                    <td>
                    '.$count.'
                    </td>
                    <td>
                         '.$r["institute_id"].'
                    </td>
                    <td>
                        '.$r['institute_name'].'
                    </td>
                    <td>
                        '.$r['details'].'
                    </td>
                    <td>
                        '.$r['address'] .'
                    </td>
                    <td>
                       '.$r['email_id'].'
                    </td>
                    <td>
                        '.$r['phone_no'].'
                    </td>
                    <td>
                        '.$r['username'].'
                    </td>
                    <td>
                        '.$r['status'].'
                    </td>
                    <td>
                    <button class="btn btn-primary" onclick="action(\'rejected\',\''.$r[1].'\')">Mark for Review</button>
                    </td>   
                    </tr>'; ?>
            <?php } else{}?>
            </tbody>
            <?php } ?>
           
        </table>
      </div> 
            </div>

        </div>
    </div>
    <div class="page-container">
     
        <a href="index.php" class="home_link">Home</a>
    </div>

<!--copyright starts-->
<?php
    include("admin_footer.php");
?>
<!--copyright ends--> 
 <script>
   function action(a,id){
    var remark= $('#rej_'+id).val();
    event.preventDefault();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: "action.php?id="+id+"&action="+a+"&remark="+remark,
        data:'',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data);
            if(data==1){alert('Updated');location.reload();}
            if(data==0){alert('Error');}
        },
        error: function (e) {
            console.log(e);
        }
  

});
    
}
   </script>
</body>
</html>