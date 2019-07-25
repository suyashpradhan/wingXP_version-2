<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$db = $database->getConnection();
$sqlSelect = 'SELECT * FROM inst_user inner join inst_batch_assign on inst_user.user_id
= inst_batch_assign.user_id where institute_id = "'.$_SESSION['Userid'].'" and batch_id="'.$_GET['batch'].'"';
$result = mysqli_query($db, $sqlSelect);
$count=0;
if (mysqli_num_rows($result) > 0)
{
  echo '<table class="table table-hover table-bordered">
               <thead class="thead-light">
                   <tr>
                       <th scope="col">Sr No</th>
                       <th scope="col">Roll Number</th>
                       <th scope="col">Student Name</th>
                       <th scope="col">Username</th>
                       <th scope="col">Password</th>
                       <th scope="col">Parent Phone</th>
                       <th scope="col">Parent Email</th>
                   </tr>
               </thead>';

while ($row = mysqli_fetch_array($result)) {
              $count++;
   echo '<tbody>
   <tr>
       <td scope="row">'. $count .'</td>
       <td>'.$row['roll_no'].'</td>
       <td>'.$row['name'].'</td>
       <td>'.$row['username'].'</td>
       <td>'.$row['password'].'</td>
       <td>'.$row['p_phone'].'</td>
       <td>'.$row['email_id'].'</td>
   </tr>';
}
   echo'</tbody>
</table>';
} 