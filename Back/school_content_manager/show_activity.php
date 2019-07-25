<?php 
session_start();
//$_SESSION["club_id"] = "club_web";
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
$id=$_GET['id'];

if(isset($_SESSION['club_id']) && isset($_SESSION['inst_id'])){
    $club_id= $_SESSION["club_id"];
    $inst_id= $_SESSION["inst_id"];}
else{
    echo 'No Club';
    die;
    }

switch ($id) {
    case 'article':
        $display= "CALL `show_all_articles_school`('$club_id','$inst_id');";
        break;
    case 'course':
    $display= "CALL `show_all_courses_school`('$club_id','$inst_id');";
        break;
    case 'ebook':
    $display= "CALL `show_all_ebooks_school`('$club_id','$inst_id');";
        break;
    case 'online_test':
    $display= "CALL `show_all_online_tests_school`('$club_id','$inst_id');";
        break;
    case 'video':
    $display= "CALL `show_all_videos_school`('$club_id','$inst_id');";
        break;
    case 'webinar':
    $display= "CALL `show_all_webinars_school`('$club_id','$inst_id');";
        break;
    case 'workshop':
    $display= "CALL `show_all_workshops_school`('$club_id','$inst_id');";
        break;
    case 'quiz':
        $display= "CALL `show_all_quiz_school`('$club_id','$inst_id');";
         break;
    case 'learning_video':
         $display= "CALL `show_all_learning_video_school`('$club_id','$inst_id');";
          break;
    case 'sample_work':
         $display= "CALL `show_all_sample_work_school`('$club_id','$inst_id');";
          break;
    default:
        echo 'error';
}

$result = $conn->query($display);
if (mysqli_num_rows($result)>0)
{
echo("<tbody>");
while ($row = mysqli_fetch_assoc($result)) {    
    echo '<tbody><tr>';
    foreach($row as $key => $field) {
        echo '<td>' . strip_tags($field) . '</td>';
        }
    echo '</tr></tbody>';
    }
}
echo("</tbody>");
$conn->close();
?>
<style>
    table{border-collapse: collapse;
        min-width:50em;}
    td,th{
        border: 1px solid #ddd;
        padding: 8px;
        
    }
    tr:nth-child(even){background-color: #f2f2f2;}
    tr:hover {background-color: #ddd;}
    th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #981a35;
    color: white;
    
}
</style>
