<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();

function tag($array,$id,$type){
    global $conn;
    $q='DELETE from tag_assign where activity_id="'.$id.'"';
    $conn->query($q);
    foreach($array as $value){
        $q='INSERT INTO tag_assign (topic_id,activity_id,type) VALUES ("'.$_SESSION['topic_id'].'","'.$id.'","'.$type.'","'.$value.'");SELECT LAST_INSERT_ID();'; 
        if ($conn->multi_query($q))
                            {      
                                do {
                                    
                                            if ($result = $conn->store_result()) 
                                            {
                                                while ($row = $result->fetch_row()) 
                                                {               
                                                $var = (string) $row[0];
                                                }
                                                
                                                $tag_id = "tag_".$var."";
                                                $sqli = "UPDATE  tag_assign SET tag_id = '$tag_id' where sno= $var";         
                                                $conn->query($sqli);
                                                $res=1;
                                                $result->free();
                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            } 
    }
    return $res;
}

?>