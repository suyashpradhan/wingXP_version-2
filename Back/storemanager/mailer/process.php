<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
require_once('../../assets/dataprocess/php-excel-reader/excel_reader2.php');
require_once('../../assets/dataprocess/SpreadsheetReader.php');
if (isset($_POST['import']))
{  
        $targetPath = '../../assets/dataprocess/msg/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        $Reader = new SpreadsheetReader($targetPath);       
            $flag=0;
            foreach ($Reader as $Row)
            {               
                if($flag>0){
                $sname = '';
                if(isset($Row[1])) {
                    $sname = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                $p_name = '';
                if(isset($Row[2])) {
                    $p_name = mysqli_real_escape_string($conn,$Row[2]);
                }

                $no = '';
                if(isset($Row[3])) {
                    $no = mysqli_real_escape_string($conn,$Row[3]);
                }

                $email = '';
                if(isset($Row[4])) {
                    $email = mysqli_real_escape_string($conn,$Row[4]);
                }

                $state = '';
                if(isset($Row[5])) {
                    $state = mysqli_real_escape_string($conn,$Row[5]);
                }

                $city = '';
                if(isset($Row[6])) {
                    $city = mysqli_real_escape_string($conn,$Row[6]);
                }
                    $query = "insert into send_sms_school (school_name,principal_name,mobile_number,email_id,state,city,status) 
                    values('".$sname."','".$p_name."','".$no."','".$email."','".$state."','".$city."','Not Sent')";
                    $res = $conn->query($query);               
                }
                $flag++;
             }
             if($res){echo "<script>alert('success');</script>";}else{echo "<script>alert('Error');</script>";}
}

if(isset($_GET['state']) and isset($_GET['city'])){
    $show_q='select school_name,principal_name,mobile_number,email_id,status from send_sms_school where state="'.$_GET['state'].'" and city="'.$_GET['city'].'" ';
    $res=$conn->query($show_q);
    echo "<table class='tutorial-table'>
    <thead>
        <tr>
            <th>School Name</th>
            <th>Principal Name</th>
            <th>Mobile No</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
    </thead>";
    while($row=$res->fetch_array()){
        echo '<tbody><tr>';
        echo '
        <td>'.$row['school_name'].'</td>
        <td>'.$row['principal_name'].'</td>
        <td>'.$row['mobile_number'].'</td>
        <td>'.$row['email_id'].'</td>
        <td>'.$row['status'].'</td>';
        echo '</tr><tbody>';      
    }
    echo '</table>';
}
if(isset($_GET['get_city'])){
    $show_q='select city from send_sms_school where state="'.$_GET['get_city'].'" group by city order by city asc';
    $res=$conn->query($show_q);
    while($row=$res->fetch_row()){
        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
}

if(isset($_GET['state_s']) and isset($_GET['city_s'])){
    $show_q='select school_name,principal_name,mobile_number,email_id from send_sms_school where state="'.$_GET['state_s'].'" and city="'.$_GET['city_s'].'" and status!="Sent"';
    $res=$conn->query($show_q);
        $url="https://control.msg91.com/api/sendhttp.php";
        $ch = curl_init();        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $key = "124046AH1JdQvqo658c7bdff";
        $send_id = "OLCBSE";
        $route = "route=4";
    while($row=$res->fetch_array()){
        $school_name=$row['school_name'];
        $principal_name=$row['principal_name'];
        $mobile_number=$row['mobile_number'];
        $email_id=$row['email_id'];        
        $message = "Hello Mr. ".$principal_name." we have a message for you !";        
        $data = array(
        'authkey' => $key,
        'mobiles' => $mobile_number,
        'message' => $message,
        'sender' => $send_id,
        'route' => $route
        );    
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data
        ));    
        $output = curl_exec($ch);
        if(curl_errno($ch))
        {
        echo 'error';
        }
        else{            
            $update_q='update send_sms_school set status="Sent" where mobile_number="'.$mobile_number.'"';
            $result=$conn->query($update_q);
        }
        
    }
    if($result){
        echo 'success';
    }
    else{
        echo 'error';
    }
    curl_close($ch);
}

?>