<?php 
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$name=mysqli_real_escape_string($conn,$_POST['title']);
$description=mysqli_real_escape_string($conn,$_POST['editor1']);
$price=mysqli_real_escape_string($conn,$_POST['mrp_price']);
$vendor=mysqli_real_escape_string($conn,$_POST['vendor']);
function ren_save( $id='fileToUpload' ){
    $target_dir = "../../assets/ebook/";
    $f = $target_dir . basename($_FILES[$id]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = date("hisa").rand(0,10).rand(0,10).".".$filetype;
    move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir.$file);  
    return $file;      
    unset($f);                               
    }



if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    { 
        //New Img with new name upload
        
        $f=ren_save();
                      
                $book_id=$_POST['id'];
                $ebk_up = "SELECT ebook_file from ebook where book_id = '$book_id'; ";
                $ebk_up .= "UPDATE  ebook SET name = '$name', description='$description',";
                if($_FILES['fileToUpload']['name']==''){}else{$ebk_up .= "ebook_file='$f',";}
                $ebk_up .= "mrp_price='$price', club_id='".$_SESSION['club_id']."',vendor_id='$vendor',topic_id='".$_SESSION['topic_id']."' where book_id= '$book_id';";                
                if ($conn->multi_query($ebk_up))
                {       
                    do {
                        
                                if ($result = $conn->store_result()) 
                                {
                                    while ($row = $result->fetch_row()) 
                                    {               
                                    $var = (string) $row[0];
                                    
                                    error_reporting(0);
                                    if($_FILES['fileToUpload']['name']!==''){
                                    if(!unlink('../../assets/ebook/'.$var)){}else{}
                                    }
                                    echo 'updated';
                                    }                                    
                                    

                        
                                }
                        }
                        while ($conn->next_result());
                }
                else{               
                    echo 'update failed !';             
                }
        
     }


    else if ($_POST['action']=='publish')
    {  
         //check for existing vendor
        $check="SELECT * FROM ebook WHERE name = '$name'";
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
                     
                            //Data Upload
                            
                            $sql = "INSERT INTO ebook  (name,description,topic_id,";
                            if($_FILES['fileToUpload']['name']==''){}else{$sql .= "ebook_file,";}
                            $sql .= "mrp_price,club_id,vendor_id) VALUES ('$name','$description','".$_SESSION['topic_id']."',";
                            if($_FILES['fileToUpload']['name']==''){}else{$sql .= "'$f',";}
                            $sql .= "'$price','".$_SESSION['club_id']."','$vendor');";
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
                                                
                                                $book_id = "ebk_".$var."";
                                                $sqli = "UPDATE  ebook SET book_id = '$book_id' where sno= $var";         
                                                $conn->query($sqli);
                                                echo "success";
                                                $result->free();
                                    
                                            }  
                                    }
                                    while ($conn->next_result());
                            }
                            else{               
                                echo 'failed !';             
                            }

       }
       
    }
} 


$conn->close();














