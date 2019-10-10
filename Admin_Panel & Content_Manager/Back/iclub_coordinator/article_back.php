<?php 
session_start();
$club_id = 'club_web'; 
//$club_id = $_SESSION['club_id'];
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$name = $_POST['title'];
$description = $_POST['editor1'];
$author = $_POST['author'];
$price = $_POST['mrp_price'];
$school_price = $_POST['school_price'];
$vendor_id =$_POST['vendor'];
$topic_id=$_POST['topic'];
$class = $_POST['class'];
$sub=$_POST['sub'];
$duration=$_POST['duration'];
function ren_save($id = 'fileToUpload'){
    $target_dir = "../../assets/article/";
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
        $f=ren_save();
        $i=ren_save('icon');//FILE UPLOAD        
/*DATA UPLOAD*/ $article_id=$_POST['id'];
                $art_up = "SELECT article_file,icon from article where article_id = '$article_id'; ";
                $art_up .= "UPDATE  article SET name = '$name', description='$description',duration='$duration',author='$author',class_applicable_for='$class',subscription_level='$sub',";
                if($_FILES['fileToUpload']['name']==''){}else{$art_up .= "article_file='$f',";}
                if($_FILES['icon']['name']==''){}else{$art_up .= "icon='$i',";}
                $art_up .= "school_price='$school_price',mrp_price='$price', club_id='$club_id',vendor_id='$vendor_id',topic_id='$topic_id' where article_id= '$article_id'";
                if ($conn->multi_query($art_up))
                {       
                    do{                        
                            if ($result = $conn->store_result()) 
                                { 
                                    while ($row = $result->fetch_row()) 
                                        {       
                                            
                                                if($_FILES['fileToUpload']['name']!==''){ $var = (string) $row[0];  
                                                    error_reporting(0); 
                                                    if(!unlink('../../assets/article/'.$var)){}else{}
                                                }
                                                if($_FILES['icon']['name']!==''){ $var = (string) $row[1];
                                                        error_reporting(0); 
                                                        if(!unlink('../../assets/article/'.$var)){}else{}
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
                $f=ren_save(); 
                $i=ren_save('icon');                     
                            //Data Upload

                            $sql = "INSERT INTO article  (name,description,author,class_applicable_for,subscription_level,topic_id,duration,";
                            if($_FILES['fileToUpload']['name']==''){}else{$sql .= "article_file,";}
                            if($_FILES['icon']['name']==''){}else{$sql .= "icon,";}
                            $sql .= "mrp_price,school_price,club_id,vendor_id) VALUES ('$name','$description','$author','$class','$sub','$topic_id','$duration',";
                            if($_FILES['fileToUpload']['name']==''){}else{$sql .= "'$f',";}
                            if($_FILES['icon']['name']==''){}else{$sql .= "'$i',";}
                            $sql .= "'$price','$school_price','$club_id','$vendor_id');";
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














