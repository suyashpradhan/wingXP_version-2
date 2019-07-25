<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
require_once('../../assets/dataprocess/php-excel-reader/excel_reader2.php');
require_once('../../assets/dataprocess/SpreadsheetReader.php');
if (isset($_POST['import']))
{ echo 1;
       
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(1==1){
        $targetPath = '../../assets/dataprocess/data/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        
        
            $flag=0;
            foreach ($Reader as $Row)
            {               
                if($flag>0){
                $roll = 0;
                if(isset($Row[0])) {
                    $roll = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                $s_name = "";
                if(isset($Row[1])) {
                    $s_name = mysqli_real_escape_string($conn,$Row[1]);
                }

                $p_name = "";
                if(isset($Row[2])) {
                    $p_name = mysqli_real_escape_string($conn,$Row[2]);
                }

                $phone = 0;
                if(isset($Row[3])) {
                    $phone = mysqli_real_escape_string($conn,$Row[3]);
                }

                $email = "";
                if(isset($Row[4])) {
                    $email = mysqli_real_escape_string($conn,$Row[4]);
                }
                
                if (!empty($roll) || !empty($s_name)|| !empty($p_name)|| !empty($phone)|| !empty($email)) {
                    $query = "insert into student_data(roll_no,s_name,p_name,phone,email,institute_id) values('".$roll."','".$s_name."','".$p_name."','".$phone."','".$email."','".$_SESSION['inst_id']."')";
                    $result = mysqli_query($conn, $query);
                    echo 'success';
                    if (! empty($result)) {
                        $type = "success";
                        $message = "Excel Data Imported into the Database";
                        echo '<script>alert("success");window.location.replace("import.php")</script>';
                    } else {
                        $type = "error";
                        $message = "Problem in Importing Excel Data";
                        echo $type;
                    }
                }
                }
                $flag++;
             }
        
         
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
}
?>