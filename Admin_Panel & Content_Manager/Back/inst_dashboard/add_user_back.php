<?php 
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
$inst_id=$_SESSION['Userid'];
$roll=mysqli_real_escape_string($conn,$_POST['roll']);
$name=mysqli_real_escape_string($conn,$_POST['name']);
$phone=mysqli_real_escape_string($conn,$_POST['phone']);
$p_name=mysqli_real_escape_string($conn,$_POST['p_name']);
$p_phone=mysqli_real_escape_string($conn,$_POST['p_phone']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$class=mysqli_real_escape_string($conn,$_POST['class_man']);
$batch=mysqli_real_escape_string($conn,$_POST['batch']);
$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
$username = $password= '';
$max = strlen($characters) - 1;
for ($i = 0; $i < 6; $i++) {
     $username .= $characters[mt_rand(0, $max)];
     $password .= $characters[mt_rand(0, $max)];
}
$username=strtoupper($username);
$password=strtoupper($password);
$add_s='insert into inst_user (roll_no, name,institute_id, phone_number, p_name,username,password, p_phone,email_id)
        values ("'.$roll.'","'.$name.'","'.$_SESSION['Userid'].'","'.$phone.'","'.$p_name.'","'.$username.'","'.$password.'","'.$p_phone.'","'.$email.'");
        SELECT LAST_INSERT_ID()';
            if($conn->multi_query($add_s)){     
                do{
                    if ($result = $conn->store_result()){
                        while ($row = $result->fetch_row()){               
                            $var = (string) $row[0];
                        }
                        $user_id = "st_".trim($_SESSION['Userid'],"INST_")."_".$var;
                        $up_id = "UPDATE  inst_user SET user_id = '$user_id' where sno= $var";         
                        $res=$conn->query($up_id);
                        $ins_b='insert into inst_batch_assign (user_id,batch_id)
                        values("'.$user_id.'","'.$batch.'")';
                        $res1=$conn->query($ins_b);
                        if($res and $res1){echo "success";}else{echo 'error';}
                        $result->free();
                    }  
                }
                while ($conn->next_result());
            }   
            else{
                echo "error";                                
            }

?>