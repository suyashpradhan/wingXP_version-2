<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_GET['club_id'])){
    $id = $_GET['club_id'];
    $topic_q = "(SELECT count(topic_id) from topic where club_id= '$id') UNION (SELECT count(articl_id) from topic where club_id= '$id')";
    $result = $conn->query($topic_q);
    $topic = $result->fetch_array();
    echo $topic[0];    
}