<?php 


include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();


$vendor_name = $_POST['vendor_name'];
$vendor_description = $_POST['desc'];
$formation_year = $_POST['datepicker'];
$permanent_address = $_POST['address'];



if(isset($_POST['action']))
{   
    if ($_POST['action']=='update')
    {
        //New Img with new name upload
        $target_dir = "../assets/vendor/";
        
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["submit"])) {
            
            
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                
                if ($uploadOk == 0) {
                              echo "Sorry, your file was not uploaded.";
                
                } 
                else {
                            if ($_FILES["fileToUpload"]["name"]==''){
                                $tmp_name=$_POST['vendor_icon']; 
                            }
                            else {
                                $tmp_name = $_POST['vendor_name']."_".$_POST['datepicker']."_".rand(1,100).".jpg"; 
                                   }
                            
                            
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $tmp_name)) {
                                
                            } else {
                                echo "";
                            }
                     }
        //Data update
               
                $vendor_id=$_POST['vendor_id'];
                
                if ($_FILES["fileToUpload"]["name"]=""){
                    $tmp_name=$_POST['vendor_icon'];
                    
                    
                }
                else {
                   
                }
                
                $vendor_up = "UPDATE  vendor SET vendor_name = '$vendor_name', vendor_description='$vendor_description',formation_year='$formation_year',permanent_address='$permanent_address',vendor_icon='$tmp_name' where vendor_id= '$vendor_id'";
                $conn->query($vendor_up);
                echo "Updated";
        
     }


    else if ($_POST['action']=='add')
    {  
        $country = $_POST['country']; //check for existing vendor
        $check="SELECT * FROM vendor WHERE vendor_name = '$vendor_name'";
        $result1 = $conn->query($check);
        $num_rows = mysqli_num_rows($result1);
    
        if ($num_rows>=1) 
        {        
        echo "Vendor already exists";        
         } 
    
        else 
        {
                                //File upload
                            $target_dir = "../img/vendor/";
                            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                            if(isset($_POST["submit"])) 
                            {
                        
                                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                                    if($check !== false) {
                                    echo "File is an image - " . $check["mime"] . ".";
                                    $uploadOk = 1;
                                    }
                                    else
                                    {
                                    echo "File is not an image.";
                                    $uploadOk = 0;
                                    }
                            }

                            if ($uploadOk == 0) 
                            {
                                echo "Sorry, your file was not uploaded.";
                            } 
                            else
                            {
                                $tmp_name = $_POST['vendor_name']."_".$_POST['datepicker']."_".rand(1,100).".jpg";     
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $tmp_name)) {        
                                } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }  
                            //Data Upload
                            $sql = "INSERT INTO vendor (vendor_name, vendor_description,formation_year,country,permanent_address,vendor_icon) VALUES ('$vendor_name','$vendor_description','$formation_year','$country','$permanent_address','$tmp_name');";
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
                                                
                                                $ven_id = "inst_".$var."";
                                                $sqli = "UPDATE  vendor SET vendor_id = '$ven_id' where sno= $var";         
                                                $conn->query($sqli);
                                                echo "Data Saved";
                                                $result->free();
                                    
                                            }      
                                    }
                                    while ($conn->next_result());
                            }

       }
       
    }
} 


$conn->close();

?>













