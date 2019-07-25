<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_POST['featured'])){$feat='1';}else{$feat='0';}
if(isset($_POST['title'])){$name=mysqli_real_escape_string($conn,$_POST['title']);}else{$name='';}
$name=mysqli_real_escape_string($conn,$_POST['title']);
$description=mysqli_real_escape_string($conn,$_POST['editor1']);
$author=mysqli_real_escape_string($conn,$_POST['author']);
$price=mysqli_real_escape_string($conn,$_POST['mrp_price']);
$vendor_id=mysqli_real_escape_string($conn,$_POST['vendor']);
$link=mysqli_real_escape_string($conn,$_POST['link']);
function ren_save($id = 'icon'){
    error_reporting(0); 
    $target_dir = "../../assets/article/";
    $f = $target_dir . basename($_FILES[$id]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir . $file);  
    return $file;                                     
}
function tag($id){
    global $conn;
    if(empty($_POST['tags'][0])){
        return 1;
    }
    $d_q="DELETE from tag_assign where activity_id='$id'";
    if($conn->query($d_q)){
        
    }
    else{
        return 0;
    }
    
    foreach($_POST['tags'] as $value){
        $q='INSERT INTO tag_assign (topic_id,activity_id,type,tag_id) VALUES ("'.$_SESSION['topic_id'].'","'.$id.'","article","'.$value.'");'; 
        if($conn->query($q))
                            {      
                             $res=1;   
                            } 
                            else{
                                $res=0;
                            }
    }
    return $res;
}
if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {    
        $i=ren_save('icon');//FILE UPLOAD        
/*DATA UPLOAD*/ $article_id=$_POST['id'];
                $art_up = "SELECT icon from article where article_id = '$article_id'; ";
                $art_up .= "UPDATE  article SET name = '$name', description='$description',duration='$duration',author='$author',link='$link',";
                if($_FILES['icon']['name']==''){}else{$art_up .= "icon='$i',";}
                $art_up .= "mrp_price='$price', club_id='".$_SESSION['club_id']."',vendor_id='$vendor_id',topic_id='".$_SESSION['topic_id']."' where article_id= '$article_id'";
                 if ($conn->multi_query($art_up))
                {       
                    do{                        
                            if ($result = $conn->store_result()) 
                                { 
                                    while ($row = $result->fetch_row()) 
                                        {                                           
                                                
                                                if($_FILES['icon']['name']!==''){ $var = (string) $row[0];
                                                        error_reporting(0); 
                                                        if(!unlink('../../assets/article/'.$var)){}else{}
                                                }
                                                else{}                                       
                                                                       
                                        } 
                                                               
                                }  
                        }
                        while ($conn->next_result());
                        if(tag($_POST['id'])){
                            echo 'updated';          
                        }
                        else{
                            echo 'error';                            
                        }
                }
                  
     }
    else if ($_POST['action']=='publish')
    {        
        $check="SELECT * FROM article WHERE name = '$name'";
        $result1 = $conn->query($check);
        $num_rows = mysqli_num_rows($result1);    
        if ($num_rows>=1) 
        {        
        echo "exists";        
         }     
        else 
        {
               //File upload 
                $i=ren_save('icon');                     
                            //Data Upload
                            $sql = "INSERT INTO article  (name,description,author,topic_id,link,";                            
                            if($_FILES['icon']['name']==''){}else{$sql .= "icon,";}
                            $sql .= "mrp_price,club_id,vendor_id) VALUES ('$name','$description','$author','".$_SESSION['topic_id']."','$link',";
                            if($_FILES['icon']['name']==''){}else{$sql .= "'$i',";}
                            $sql .= "'$price','".$_SESSION['club_id']."','$vendor_id');";
                            $sql .= "SELECT LAST_INSERT_ID()";        
                            if ($conn->multi_query($sql))
                            {       
                                do {
                                    
                                            if ($result = $conn->store_result()) 
                                            {
                                                while ($row = $result->fetch_row()) 
                                                {               
                                                $var = (string) $row[0];
                                                }
                                                
                                                $article_id = "art_".$var."";
                                                $sqli = "UPDATE  article SET article_id = '$article_id' where sno= $var";         
                                                $conn->query($sqli);
                                                if(tag($article_id)){

                                                }
                                                else{
                                                    echo 'error';
                                                    die;
                                                }
                                                echo "success";
                                                $result->free();
                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            }
                            else{
                                echo "Data Not Saved";
                                
                            }

       }
       
    }
} 


$conn->close();














