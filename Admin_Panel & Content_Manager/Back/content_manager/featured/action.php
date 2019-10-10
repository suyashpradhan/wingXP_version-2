<?php 
include_once "../../assets/Users.php";
$database = new Database();
$db = $database->getConnection();
session_start();

    if(isset($_GET['action'])){
        switch($_GET['action']){
            case 'featured':
            $q='UPDATE featured_content SET status="0" where type="'.$_GET['type'].'"';
                if($db->query($q)){
                    $q='INSERT INTO featured_content (id,type,datetime,status) VALUES ("'.$_GET['id'].'","'.$_GET['type'].'","'.date('Y-m-d').'","1")';
                        if($db->query($q)){
                            echo 'success';
                        }
                        else{
                            echo 'error';
                        }
                }
                else{
                    echo 'error';
                }
        }
    }
?>