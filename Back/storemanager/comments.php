<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$date=date('Y/m/d H:i:s');
if(isset($_GET['action']) and $_GET['action']=='get'){
    $q='select comment,datetime,action from sales_comments where type="'.$_GET['type'].'" and id="'.$_GET['id'].'"';
    $result=$conn->query($q);
    while($row=$result->fetch_row()){
            echo '
        <div class="container">
        <div class="arrow">
            <div class="outer"></div>
            <div class="inner"></div>
        </div>
        <div class="message-body">
            <p>'.$row[0].'</p>    
            <p style="float: right;color: #696969;font-size: 14px;margin: 3px 0 !important">'.date("D, d M Y, H:i a",strtotime($row[1])).'</p>               
        </div>
        </div>';
        
        
    }
    
    

}
else if(isset($_GET['action']) and $_GET['action']=='send'){
    $q='INSERT into sales_comments (id,type,comment,action,datetime) values ("'.$_GET['id'].'","'.$_GET['type'].'","'.$_GET['msg'].'","comment","'.$date.'")';
    $result=$conn->query($q);
    if(!$result){
        echo 'error';
    }
}
else if(isset($_GET['action']) and $_GET['action']=='call_later'){
    $q='INSERT into sales_comments (id,type,comment,action,datetime) values ("'.$_GET['id'].'","'.$_GET['type'].'","'.$_GET['msg'].'","call_later","'.$date.'")';
    $result=$conn->query($q);
    if(!$result){
        echo 'error';
    }
}
else if(isset($_GET['action']) and $_GET['action']=='call_now'){
    $q='INSERT into sales_comments (id,type,comment,action,datetime) values ("'.$_GET['id'].'","'.$_GET['type'].'","'.$_GET['msg'].'","call_now","'.$date.'")';
    $result=$conn->query($q);
    if(!$result){
        echo 'error';
    }
}