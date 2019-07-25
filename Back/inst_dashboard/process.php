<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
require_once('../assets/dataprocess/php-excel-reader/excel_reader2.php');
require_once('../assets/dataprocess/SpreadsheetReader.php');
$message='';
function check_username($phone){
    global $conn;
    $char='A';
    $username=$char.$phone;
    $check_username="select * from inst_user where p_phone='$phone';";
    $result=$conn->query($check_username);
    $char_inc=$result->num_rows;
    for($i=0;$i<$char_inc;$i++,$char++){}
    $username=$char.$phone;    
    $password=mb_strimwidth($username,0,4).rand(10,100);
    return array($username,$password);
}
if (isset($_SESSION['Userid']))
{ 
    $check_data='select * from inst_user where institute_id="'.$_SESSION['Userid'].'"';
    $result=$conn->query($check_data);
    if($result->num_rows >0){
        $message='update_error';
    }
    else{
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  $allow=0;
  if(1==1){
        $ext = explode(".", $_FILES["file"]["name"]);
        $filename= '../assets/dataprocess/data/'.$_SESSION['Userid'].'_'.date("m_d_Y_h_i_s_a", time()).'.'.$ext[1];
        move_uploaded_file($_FILES['file']['tmp_name'], $filename);
        $Reader = new SpreadsheetReader($filename);
        
        $k=0;
        $Sheets = $Reader->sheets();
        $sheetCount=count($Sheets);
                    
            
            foreach ($Sheets as $sheet => $Name)
             {  $Reader->ChangeSheet($k);
                
                
                $flag=0;
                 foreach($Reader as $Row){
                    
                 
                if($flag==0 and $Row[0]=="Student Name"
                 and $Row[1]=='Parent Name' and $Row[2]=='Mobile No'
                  ){
                   $allow=1;
                   $message='success';
                }  
                else{
                    $message='invalid_format';
                    
                }              
                if($flag>0 and $allow==1){
                    $s_name = "";
                    if(isset($Row[0])) {
                        $s_name = mysqli_real_escape_string($conn,$Row[0]);
                    }
    
                    $p_name = "";
                    if(isset($Row[1])) {
                        $p_name = mysqli_real_escape_string($conn,$Row[1]);
                    }
    
                    $phone = 0;
                    if(isset($Row[2])) {
                        $phone = mysqli_real_escape_string($conn,$Row[2]);
                    }   
                    
                    
                    if (!empty($s_name)|| !empty($p_name)|| !empty($phone)) {
                    $res_arr= check_username($phone);
                    $username=$res_arr[0];
                    $password=$res_arr[1];
                        $query = "insert into inst_user (name,p_name,p_phone,institute_id,username,password) 
                        values('".$s_name."','".$p_name."','".$phone."','".$_SESSION['Userid']."',
                        '".$username."','".$password."'); SELECT LAST_INSERT_ID()";
                        if($conn->multi_query($query)){     
                            do{
                                if ($result = $conn->store_result()){
                                    while ($row = $result->fetch_row()){               
                                        $var = (string) $row[0];
                                    }
                                    $user_id = "st_".trim($_SESSION['Userid'],"INST_")."_".$var;
                                    $up_id = "UPDATE  inst_user SET user_id = '$user_id' where sno= '$var'";         
                                    $res=$conn->query($up_id);
                                    $ins_b='insert into inst_batch_assign (user_id,batch_id)
                                    values("'.$user_id.'","'.$_SESSION['Userid'].'_'.$Name.'_A")';
                                    $res1=$conn->query($ins_b);
                                    $message='success';
                                    $result->free();
                                }  
                            }
                            while ($conn->next_result());
                        }   
                        else{
                            $message='error';                             
                        }
                    }                    
                    }
                     $flag++;
                
               
             }
            $k++;
        }
            
        
        
         
  }
  else
  { 
        
        $message = "Invalid File Type. Upload Excel File.";
  }
}
}
if($message=='success'){
    $q='INSERT INTO school__stage (id,stage) values ("'.$_SESSION['sno_user'].'","s5")';
    if($conn->query($q)){
        $message='success';
    }
}
echo $message;
?>