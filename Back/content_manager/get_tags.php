<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$sql = "SELECT tag_id,tag_name FROM tags WHERE topic_id = '".$_SESSION['topic_id']."' and status='1'"; 
$result = $conn->query($sql);
$data = '';
while($row = $result->fetch_assoc()){
$data .= '<option value="'.$row['tag_id'].'">'.$row['tag_name'].'</option>';
}
echo $data;

