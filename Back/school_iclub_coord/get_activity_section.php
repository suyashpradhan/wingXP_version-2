<?php 
session_start();
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection(); 
$club_id="app";
if(1==1)
{
    //$_SESSION['club_category_id']=$_GET['club_category_id'];
    //$_SESSION['club_id']=$_GET['club_id'];
    //$club_category_id=$_GET['club_category_id'];
    //$club_id=$_GET['club_id'];
    $display= "SELECT
    (SELECT COUNT(*) FROM webinar WHERE club_id=$club_id)  , 
    (SELECT COUNT(*) FROM online_test WHERE club_id=$club_id)  ,
    (SELECT COUNT(*) FROM video WHERE club_id=$club_id)  ,
    (SELECT COUNT(*) FROM ebook WHERE club_id=$club_id)  ,
    (SELECT COUNT(*) FROM article WHERE club_id=$club_id) ,
    (SELECT COUNT(*) FROM workshop WHERE club_id=$club_id)  ,
    (SELECT COUNT(*) FROM live_course WHERE club_id=$club_id) ";
    $result123 = $conn->query($display);
    $row = mysqli_fetch_assoc($result123);
?>
<div class="page " style="max-width:1200px ">
                <div class="section__wrapper">
                  <?php $r12=$conn->query("select * from activities");
                        while($r2=mysqli_fetch_array($r12))
                         {
                          $case_id=substr($r2['page_name'], 0, -4); 
                      ?>
                    <div>
                        <table>
                            <tr>
                                <td class='tableProperty'><a href="<?php echo $r2['page_name']; ?>"><?php echo $r2['activities_name']; ?></a></td>
                                <td><a href="show_activity.php?id=<?php echo $case_id; ?>"><?php echo $row[$case_id]; ?></a></td>
                            </tr>
                        </table>
                    </div>
                     <?php } ?>
                 </div>
            </div>
<?php
} 
else
{ ?>
 <div class="card card-new">
                <h1>Select Club Category and Club Above To View The Content</h1>
            </div>
<?php }
?>