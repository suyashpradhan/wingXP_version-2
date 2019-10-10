<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$type=$_POST['type'];
$id=$_POST['id'];
switch ($type) {
    case 'article':
        $approve= "UPDATE article set status='1' where article_id='$id'";
        break;
    case 'live_course':
    $approve=  "UPDATE live_course set status='1' where course_id='$id'";
        break;
    case 'ebook':
    $approve=  "UPDATE ebook set status='1' where book_id='$id'";
        break;
    case 'online_test':
    $approve=  "UPDATE online_test set status='1' where test_id='$id'";
        break;
    case 'video':
    $approve=  "UPDATE video set status='1' where video_id='$id'";
        break;
    case 'webinar':
    $approve= "UPDATE webinar set status='1' where webinar_id='$id'";
        break;
    case 'workshop':
    $approve=  "UPDATE workshop set status='1' where workshop_id='$id'";
        break;
    default:
        echo 'error';
}
$result = $conn->query($approve);
if($result=='1'){echo 'approved';}else{echo 'error';}
