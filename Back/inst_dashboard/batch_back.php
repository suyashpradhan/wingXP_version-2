<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
$inst_id = $_SESSION['Userid'];
if($_GET['action']=='add'){add($_GET['class'],$_GET['batch'],$inst_id,$conn);}
else if($_GET['action']=='delbatch'){delbatch($_GET['class'],$_GET['batch'],$inst_id,$conn);}
else if($_GET['action']=='delclass'){delclass($_GET['class'],$inst_id,$conn);}
function add($class,$batch,$inst_id,$conn){
    $check = 'select class from inst_class where class="'.$class.'" and institute_id="'.$inst_id.'"';
    $result= $conn->query($check);
    if(mysqli_num_rows($result)>0){
        $add ='insert into inst_batch (class_id,batch_id,batch_name) values ("'.$inst_id.'_'.$class.'","'.$inst_id.'_'.$class.'_'.$batch.'","'.$batch.'")';
        if ($conn->query($add)){echo 'success';}
        else{echo 'error';}
    }
    else{
        $add='insert into inst_class (class_id,institute_id,class) values ("'.$inst_id.'_'.$class.'","'.$inst_id.'","'.$class.'");';
        $add .='insert into inst_batch (class_id,batch_id,batch_name) values ("'.$inst_id.'_'.$class.'","'.$inst_id.'_'.$class.'_'.$batch.'","'.$batch.'");';
        if ($conn->multi_query($add)){echo 'success';}
        else{echo 'error';}
    }    
}
function delbatch($class,$batch,$inst_id,$conn){            
        $add ='delete from inst_batch where batch_id="'.$inst_id.'_'.$class.'_'.$batch.'"';
        if ($conn->query($add)){echo 'success';}
        else{echo 'error';}
    
}
function delclass($class,$inst_id,$conn){    
        $add='delete from inst_class where class_id="'.$inst_id.'_'.$class.'";';
        $add .='delete from inst_batch where class_id ="'.$inst_id.'_'.$class.'"';
        if ($conn->multi_query($add)){echo 'success';}
        else{echo 'error';}
        
}