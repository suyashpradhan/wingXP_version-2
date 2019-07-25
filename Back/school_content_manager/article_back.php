<?php 
session_start();
$club_id = $_SESSION['club_id'];
$inst_id = $_SESSION['inst_id'];
$Userid = $_SESSION['Userid'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_POST['featured'])){$feat='1';}else{$feat='0';}
$name=mysqli_real_escape_string($conn,$_POST['title']);
$description=mysqli_real_escape_string($conn,$_POST['editor1']);
$author=mysqli_real_escape_string($conn,$_POST['author']);
$price=mysqli_real_escape_string($conn,$_POST['mrp_price']);
$school_price=mysqli_real_escape_string($conn,$_POST['school_price']);
$vendor_id=mysqli_real_escape_string($conn,$_POST['vendor']);
$topic_id=mysqli_real_escape_string($conn,$_POST['topic']);
$class=mysqli_real_escape_string($conn,$_POST['class']);
$sub=mysqli_real_escape_string($conn,$_POST['sub']);
$link=mysqli_real_escape_string($conn,$_POST['link']);
$duration=mysqli_real_escape_string($conn,$_POST['duration']);
function ren_save($id = 'icon'){
    $target_dir = "../assets/article/";
    $f = $target_dir . basename($_FILES[$id]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir . $file);  
    return $file;                                     
}
if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {    
        $i=ren_save('icon');//FILE UPLOAD        
/*DATA UPLOAD*/ $article_id=mysqli_real_escape_string($conn,$_POST['id']);
                $art_up = "SELECT icon from school__article where article_id = '$article_id'; ";
                $art_up .= "UPDATE  school__article SET name = '$name', description='$description',duration='$duration',author='$author',class_applicable_for='$class',subscription_level='$sub',link='$link',";
                if($_FILES['icon']['name']==''){}else{$art_up .= "icon='$i',";}
                $art_up .= "school_price='$school_price',mrp_price='$price', club_id='$club_id',vendor_id='$vendor_id',topic_id='$topic_id',featured='$feat',inst_id='$inst_id',cc_id='$Userid' where article_id= '$article_id'";
                 if ($conn->multi_query($art_up))
                {       
                    do{                        
                            if ($result = $conn->store_result()) 
                                { 
                                    while ($row = $result->fetch_row()) 
                                        {                                           
                                                
                                                if($_FILES['icon']['name']!==''){ $var = (string) $row[0];
                                                        error_reporting(0); 
                                                        if(!unlink('../assets/article/'.$var)){}else{}
                                                }
                                                else{}                                       
                                                                       
                                        }    
                                    echo 'updated';                       
                                }  
                        }
                        while ($conn->next_result());
                }
                  
     }
    else if ($_POST['action']=='publish')
    {        
        $check="SELECT * FROM school__article WHERE name = '$name'";
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
                            $sql = "INSERT INTO school__article  (name,description,author,class_applicable_for,subscription_level,topic_id,duration,link,featured,";                            
                            if($_FILES['icon']['name']==''){}else{$sql .= "icon,";}
                            $sql .= "mrp_price,school_price,club_id,vendor_id,inst_id,cc_id) VALUES ('$name','$description','$author','$class','$sub','$topic_id','$duration','$link','$feat',";
                            if($_FILES['icon']['name']==''){}else{$sql .= "'$i',";}
                            $sql .= "'$price','$school_price','$club_id','$vendor_id','$inst_id','$Userid');";
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
                                                
                                                $article_id = "sc_art_".$var."";
                                                $sqli = "UPDATE  school__article SET article_id = '$article_id' where sno= $var";         
                                                $conn->query($sqli);
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














