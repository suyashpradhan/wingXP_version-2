<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();

$activity_name = $_POST['activity_name']; 
$desc = $_POST['desc']; 
$page_name = $_POST['page_name'];  

function ren_save($id = 'icon'){
    $target_dir = "../assets/activity/";
    $f = $target_dir.basename($_FILES[$id]["name"]);
    $filetype = strtolower(pathinfo($f,PATHINFO_EXTENSION));
    $file = $_POST['activity_name'].'.'.$filetype;
    move_uploaded_file($_FILES[$id]["tmp_name"], $target_dir.$file);  
    return $file;                                     
}
if(isset($_POST['action']))
{
                                   
    
    $f=ren_save();

    if ($_POST['action']=='update'){
        $f=ren_save();
        $activity_id=$_POST['activity_id'];
        $activity_up = "UPDATE  activities SET activity_name='$activity_name', page_name = '$page_name', activities_description='$desc'";
         if($_FILES['icon']['name']==''){}else{$activity_up .= ",icon='$f'";}
        $activity_up .= " where activities_id= '$activity_id'";        
        $conn->query($activity_up);
        echo "update";
        
    }
    else if ($_POST['action']=='add'){
        $check="SELECT * FROM activities WHERE activity_name = '$activity_name'";
    $result1 = $conn->query($check);
    $num_rows = mysqli_num_rows($result1);
    
    if ($num_rows>=1) {
        
        echo "exists";
        
    } 
    
    
    else {
       
        $f=ren_save();
       
       
        $sql = "INSERT INTO activities (activity_name,page_name, activities_description";
        if($_FILES['icon']['name']==''){}else{$sql .= ",icon";} 
        $sql .= ")  VALUES ('$activity_name','$page_name','$desc'";
        if($_FILES['icon']['name']==''){}else{$sql .= ",'$f'";}
     $sql .= "); SELECT LAST_INSERT_ID()"; 
     
     
     if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                while ($row = $result->fetch_row()) {
                   
                    $var = (string) $row[0];
                }
                $activity_id = "act".$var."";
                $sqli = "UPDATE  activities SET activities_id = '$activity_id' where sno= $var";
             
                $conn->query($sqli);
                echo "success";
                $result->free();
                
            }
            
           
        } while ($conn->next_result());
    }
    }
} 

}
$conn->close();

?>