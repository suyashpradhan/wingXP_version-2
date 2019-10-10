<?php 
session_start();
require('../assets/phpmailer/src/PHPMailer.php');
require('../assets/phpmailer/src/SMTP.php');
include_once("../assets/Users.php");
$database = new Database();
$conn = $database->getConnection();

if(isset($_GET['remark']) and $_GET['remark']!==''){$remark=$_GET['remark'];}
if(isset($_GET['id'])){$id=$_GET['id'];}
if(isset($_GET['action'])){$action=$_GET['action'];}
switch ($action) {
    case 'pending':    
        $sql="UPDATE institution SET status='true' where institute_id='$id'";
        $result = $conn->query($sql);
        create_classes($conn,$id);  
        $id=$_GET['id'];
        $detail="select email_id,password,phone_no from institution where institute_id='$id'";
        $result_q=$conn->query($detail);
        $row1 = $result_q->fetch_array();
        $school_email=$row1['email_id'];
        $send_pass=$row1['password'];
        $school_phone=$row1['phone_no'];
        $q1='insert into inst_club_assign (club_id,institute_id,status) values("club_18","'.$id.'","0");';
        $q2='insert into inst_club_assign (club_id,institute_id,status) values ("club_21","'.$id.'","0");';
        $q3='insert into inst_club_assign (club_id,institute_id,status) values ("club_22","'.$id.'","0");';
        $q4='insert into inst_club_assign (club_id,institute_id,status) values ("club_23","'.$id.'","0");';
        $q5='insert into inst_club_assign (club_id,institute_id,status) values ("club_24","'.$id.'","0");';
        $q6='insert into inst_club_assign (club_id,institute_id,status) values ("club_25","'.$id.'","0");';
        $q7='insert into inst_club_assign (club_id,institute_id,status) values ("club_26","'.$id.'","0");';
        $q8='insert into inst_club_assign (club_id,institute_id,status) values ("club_27","'.$id.'","0");';                
        $conn->query($q1);$conn->query($q2);$conn->query($q3);$conn->query($q4);
        $conn->query($q5);$conn->query($q6);$conn->query($q7);$conn->query($q8);   
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "ssl";
        $mail->Port     = 465;  
        $mail->Username = "contact@wingxp.com";
        $mail->Password = "contact321#A";
        $mail->Host     = "mail.wingxp.com";
        $mail->Mailer   = "smtp";
        $mail->SetFrom("contact@wingxp.com", "WingXP");
        $mail->AddReplyTo("contact@wingxp.com", "WingXP");
        $mail->AddAddress($school_email);
        $mail->Subject = "STEP 1: Account Activation";
        $mail->WordWrap   = 80;
        $content = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
        </head>
        
        <body>
            <table style="width: 650px;margin:auto;font-family:Segoe UI, Tahoma, Geneva, Verdana, sans-serif; line-height:25px; border-collapse:collapse;">
                <tr>
                    <td style="background-color: #17a2b8;width: 100%" colspan="1">
                        <h1 style="font-size: 16px;color:#ffff;padding: 5px 0 0 15px;margin: 0">Dear "Admin", </h1>
                        <h1 style="font-size: 16px;color:#ffff;padding: 0 0 0 15px;margin: 0">Greetings & Welcome to
                            <a style="color:white;" href="http://wingxp.com">WingXP.com!</a> </h1>
                        <h1 style="font-size: 16px;color:#ffff;padding: 0 0 5px 15px;margin: 0">It was a pleasure speaking
                            with you.</h1>
                    </td>
                    <td colspan="1" style="background-color: #17a2b8;">
                        <p style="margin: 0;padding: 0">
                            <img src="http://www.wingxp.com/emailer/wingxp_mail/wingxp.png" alt="" style="height: 65px;margin: 0;padding: 0">
                        </p>
                    </td>
                </tr>
                <tr style="background-color: #f0f0f0;">
                    <td colspan="2">
                        <p style="font-size: 22px;color:#3f3e3e;padding: 20px 0 20px 15px;margin: 0;font-weight: 700"> Here are
                            your school
                            credentials.</p>
                    </td>
                </tr>
                <tr>
                    <table style="width: 650px;margin:auto;font-family:Segoe UI, Tahoma, Geneva, Verdana, sans-serif; line-height:25px; border-collapse:collapse;">
                        <tr style="background-color: #f0f0f0;">
                            <td colspan="1" style="width: 50%">
                                <p style=" padding: 0 15px;margin:
                                -28px 0 0 0 ;color: #3f3e3e;font-size: 20px;font-weight: 700;">1.
                                    School Login:</p>
                                <span style="padding: 0px 0 0 50px;margin: 0;color: #3f3e3e;display: block;font-weight: 500;">Username:
                                    '.$id.'</span>
                                <span style="padding: 0px 0 0 50px;margin: 0;color: #3f3e3e;display: block;font-weight: 500;">Password:
                                    '.$send_pass.'</span>
                                <span style="padding: 0px 0 0 50px;margin: 0;color: #f0f0f0;display: block;font-weight: 500;">
                                .</span>
                            </td>                            
                        </tr>
                    </table>
                </tr>
            </table>
            <table style="width: 650px;margin:auto;font-family:Segoe UI, Tahoma, Geneva, Verdana, sans-serif; line-height:25px; border-collapse:collapse;">
                <tr>
                    <td colspan="2">
                        <p style="font-weight: 700;color: #17a2b8;text-align: justify;padding: 5px 0 5px 15px;margin: 0">**WingXP
                            iClubs
                            passwords & details are
                            confidential to
                            your school, hence request you not to share
                            beyond. </p>
                    </td>
                </tr>
                <tr style="background-color: #f0f0f0;">
                    <td colspan="2">
                        <p style="padding: 10px 0 3px 15px;margin: 0;color: #3f3e3e;font-size: 18px;font-weight: 700;">Step 1:</p>
                        <p style="padding: 0 0 0 15px;margin: 0;font-size: 16px;color:#3f3e3e;">Use the above credentials to
                            log into
                            your account.</p>
                    </td>
                </tr>
                <tr style="background-color: #f0f0f0;">
                    <td colspan="2">
                        <p style="padding: 1px 15px;margin: 0;color: #3f3e3e;font-size: 16px;font-weight: 700;">A. Upload the
                            student
                            details</p>
                        <p style="padding: 1px 15px;margin: 0;color: #3f3e3e;font-size: 16px;font-weight: 700;">B. Select the
                            WingXP iclubs
                            you wish to offer to the students.
                        </p>
                        <p style="padding: 1px 0 10px 15px;margin: 0;color: #3f3e3e;font-size: 16px;font-weight: 700;">C.
                            Create your
                            own clubs
                            (upto 8).</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p style="font-weight: 700;color: #17a2b8;text-align: justify;padding: 10px 15px;margin: 0">**WingXP
                            *Refer to the PDF guide attached to the email. </p>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #17a2b8;width: 100%" colspan="2">
                        <h1 style="font-size: 16px;color:#ffff;padding: 5px 0 0 15px;margin: 0">Please feel free to connect
                            with your <br> <span style="color: #333;">Relationship
                                Manager (Mr. Kshitij, kshitij@wingxp.com, 9999999999).</span> </h1>
                        <h1 style="font-size: 16px;color:#ffff;padding: 0 0 5px 15px;margin: 0">Or you can write us at
                            <span style="color:#333">contact@wingxp.com.</span>
                        </h1>
                    </td>
                </tr>
            </table>
        </body>
        
        </html>';

       $key = "124046AH1JdQvqo658c7bdff";
        $send_id = "WINGXP";
        $otp_expiry=30;
        $message = "Login credentials for WingXP iClubs:\n\nUsername- ".$school_email."\nPassword- ".$send_pass."\n\n*WingXP iClubs details are confidential to your school, request you not to share beyond.\n\nRegards\nKshitiz Saxena\nTeam WingXP\n9649964912\nwww.wingxp.com";
        $route = "route=4";
        $data = array(
          'authkey' => $key,
'mobiles' => $school_phone,
'message' => $message,
'sender' => $send_id,
'route' => $route,
'otp' => $send_pass,
'otp_expiry' => $otp_expiry,
'otp_length' =>10,
); 
        
        $url="http://control.msg91.com/api/sendotp.php";
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        if(curl_errno($ch))
        {
        echo 'error:' . curl_error($ch);
        }
        else{
          // echo $output;
        }  
        curl_close($ch);
        $mail->MsgHTML($content);
        //$mail->AddAttachment('../../assets/mailer_attach/WingXP iclubs Guide1.pdf');
        $mail->IsHTML(true);
        if(1==2)//!$mail->Send()) 
        echo 0;
        else 
        //echo 1;          
        break;
    case 'approved':    
        $sql="UPDATE institution SET status='false' where institute_id='$id'"; 
        notify($conn,$remark);
        $result = $conn->query($sql);
        break;
    case 'rejected':    
        $sql="UPDATE institution SET status='5' where institute_id='$id'";   
        $result = $conn->query($sql);     
        break;
    case 'block':    
        $sql="UPDATE institution SET status='false' where institute_id='$id'"; 
        $result = $conn->query($sql);
        break;
    case 'remove_students':    
        $sql="DELETE from inst_user where institute_id='$id'";
        $result = $conn->query($sql); 
        break;
    case 'login_detail':    
        $sql="SELECT datetime from school__log_detail where id='$id' order by datetime desc"; 
        $result = $conn->query($sql);
        break;
    case 'all_detail':    
        $sql="SELECT * from institution where institute_id='$id' "; 
        $result = $conn->query($sql);
        break;
    case 'detail':
    $get_web_det='select * from webinar_schedule where web_id="'.$_GET['id'].'"';
    $res=$conn->query($get_web_det);
    while($row=$res->fetch_array()){
        $title=$row['title'];
        $price=$row['price'];
        $type=$row['type'];
        $username=$row['username'];
        $password=$row['password'];
        $email=$row['email'];
        $description=$row['description'];
        $url=$row['url'];
        $date=$row['date'];
        $time=$row['time'];
        $duration=$row['duration'];
    }
    echo '
        <table class="table table-bordered">
        <tbody>
        <tr>
            <td>Title</td>
            <td>'.$title.'</td>
        </tr>
        <tr>
            <td>Price</td>
            <td>'.$price.'</td>
        </tr>
        <tr>
            <td>Type</td>
            <td>'.$type.'</td>
        </tr>
        <tr>
            <td>Username</td>
            <td>'.$username.'</td>
        </tr>
        <tr>
            <td>Password</td>
            <td>'.$password.'</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>'.$email.'</td>
        </tr>
        <tr>
            <td>Description</td>
            <td>'.$description.'</td>
        </tr>
        <tr>
            <td>URL</td>
            <td>'.$url.'</td>
        </tr>
        <tr>
            <td>Date</td>
            <td>'.$date.'</td>
        </tr>
        <tr>
            <td>Time</td>
            <td>'.$time.'</td>
        </tr>
        <tr>
            <td>Duration</td>
            <td>'.$duration.'</td>
        </tr>
        </tbody>

        ';
        break;
    case 'inactive':
        $mark_inactive='update webinar_schedule set status="inactive" where web_id="'.$_GET['id'].'"';
        if($conn->query($mark_inactive)){
            echo 'success';
        }
        else{
            echo 'error';
        }
        break;
    case 'missed':
        $mark_missed='update webinar_attendance set status="0" where id="'.$_GET['id'].'" and web_id="'.$_GET['arg1'].'"';
        if($conn->query($mark_missed)){
            echo 'success';
        }
        else{
            echo 'error';
        }
        break;
    case 'attended':
        $mark_attended='update webinar_attendance set status="1" where id="'.$_GET['id'].'" and web_id="'.$_GET['arg1'].'"';
        if($conn->query($mark_attended)){
            $q='INSERT INTO school__stage (id,stage) values ("'.$_GET['arg3'].'","'.$_GET['arg2'].'")';
         //echo $q;
            if($conn->query($q)){
                echo 'success';
            }
            else{
                echo 'error';
            }
        }
        else{
            echo 'error';
        }
        break;
    case 'stage-1-rollback':
        $s5_roll='DELETE from inst_user where institute_id="'.$_GET['arg1'].'"';
        $s3_roll='DELETE from inst_club_assign where institute_id="'.$_GET['arg1'].'"';
        $s2_4_roll='DELETE from webinar_attendance where id="'.$_GET['arg1'].'"';
        $s_no_roll='DELETE from school__stage where id="'.$_GET['id'].'" and stage!="s0"';        
        if($conn->query($s_no_roll) and $conn->query($s2_4_roll) and $conn->query($s3_roll) and $conn->query($s5_roll)){
            echo 'School has been Successfully Reset to Stage 1<br>Webinar Attendance Cleared<br>Clubs Deallocated<br>Student Accounts Cleared';
        }
        else{
            echo 'error';
        }
        break;
    case 'stage-2-rollback':
        $s5_roll='DELETE from inst_user where institute_id="'.$_GET['arg1'].'"';
        $s3_roll='DELETE from inst_club_assign where institute_id="'.$_GET['arg1'].'"';
        $s2_4_roll='DELETE from webinar_attendance where id="'.$_GET['arg1'].'"';
        $s_no_roll='DELETE from school__stage where id="'.$_GET['id'].'" and stage!="s0" and stage!="s1"';        
        if($conn->query($s_no_roll) and $conn->query($s2_4_roll) and $conn->query($s3_roll) and $conn->query($s5_roll)){
            echo 'School has been Successfully Reset to Stage 2<br>Webinar Attendance Cleared<br>Clubs Deallocated<br>Student Accounts Cleared';
        }
        else{
            echo 'error';
        }
        break;
    case 'stage-3-rollback':
        $s5_roll='DELETE from inst_user where institute_id="'.$_GET['arg1'].'"';
        $s3_roll='DELETE from inst_club_assign where institute_id="'.$_GET['arg1'].'"'; 
        $s4_roll='DELETE from webinar_attendance where id="'.$_GET['arg1'].'" and web_id in (select web_id from webinar_schedule where type="s4")';
        $s_no_roll='DELETE from school__stage where id="'.$_GET['id'].'" and stage!="s0" and stage!="s1" and stage!="s2"';        
        if($conn->query($s_no_roll) and $conn->query($s4_roll) and $conn->query($s3_roll) and $conn->query($s5_roll)){
            echo 'School has been Successfully Reset to Stage 3<br>Webinar Stage 4 Attendance Cleared<br>Clubs Deallocated<br>Student Accounts Cleared';
        }
        else{
            echo 'error';
        }
        break;
    case 'stage-4-rollback':
        $s5_roll='DELETE from inst_user where institute_id="'.$_GET['arg1'].'"';
        $s4_roll='DELETE from webinar_attendance where id="'.$_GET['arg1'].'" and web_id in (select web_id from webinar_schedule where type="s4")';
        $s_no_roll='DELETE from school__stage where id="'.$_GET['id'].'" and stage!="s0" and stage!="s1" and stage!="s2" and stage!="s3"';        
        if($conn->query($s_no_roll) and $conn->query($s4_roll) and $conn->query($s5_roll)){
            echo 'School has been Successfully Reset to Stage 4<br>Webinar Stage 4 Attendance Cleared<br>Student Accounts Cleared';
        }
        else{
            echo 'error';
        }
        break;
    case 'stage-5-rollback':
        $s5_roll='DELETE from inst_user where institute_id="'.$_GET['arg1'].'"';
        $s_no_roll='DELETE from school__stage where id="'.$_GET['id'].'" and stage!="s0" and stage!="s1" and stage!="s2" and stage!="s3" and stage!="s4"';  
        $s_club_assign_roll='DELETE from inst_batch_assign where batch_id LIKE "'.$_GET['arg1'].'%"';
        if($conn->query($s_no_roll) and $conn->query($s5_roll) and $conn->query($s_club_assign_roll)){
            echo 'School has been Successfully Reset to Stage 5<br>Student Accounts Cleared';
        }
        else{
            echo 'error';
        }
        break;
    case 'get_stage':
        $q='SELECT stage from school__stage where id="'.$_GET['id'].'" order by stage DESC';   
        $res=$conn->query($q);
        while($row=$res->fetch_row()){
            $stages[]=$row[0];
          }
          echo json_encode($stages);
        break;
    default:    
        echo 0;
}
function notify($conn,$remark){
    $id=$_GET['id'];
$get_email="select email_id from institution where institute_id='$id'";
$result = $conn->query($get_email);
$row = $result->fetch_array();
$school_email=$row['email_id'];
$subject = 'WingXP Account on HOLD';
$message="Attention user you WingXP account has been put on hold for following reasons<br>:".$remark;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers.= "Content-type:text/html;charset=iso-8859-1"."\r\n";
$headers.= "From:contact@wingxp.com"; 
mail($school_email,$subject,$message,$headers);
}
function create_classes($conn,$id){
    $class = $conn->prepare("insert into inst_class (class_id,institute_id,class) values (?,?,?)");
    $batch = $conn->prepare ("insert into inst_batch (class_id,batch_id,batch_name) values (?,?,?)");
    $class->bind_param("sss", $class_id, $institute_id, $class_no);
    $batch->bind_param("sss", $class_id, $batch_id, $batch_name);
   for($i=6;$i<=12;$i++){
        $class_id = $id.'_'.$i;
        $class_no=$i;
        $institute_id="".$id."";
        $batch_id= $id.'_'.$i.'_A';
        $batch_name='A';
        $class->execute();
        $batch->execute();  
    }
}
if($action=='login_detail'){
    echo '<table id="page-table">
        <thead>
                <tr>                    
                    <th>Login Date & Time</th>                              
                </tr>
            </thead><td><table><tbody><tr>';	           
               $count=0;
   while($r=mysqli_fetch_array($result))
   {  $count++;
            if($count<2){
                echo '<tr>';
            }
            echo '                                              
                    <td>
                         '.date('l, d/M/Y, H:i:s a',strtotime($r["datetime"])).'
                    </td>
                ';
            if($count==3){
                echo '</tr>';
                $count=0;
            } 
    } 
        echo '</tr></td></table></table>';
}
else if($action=='all_detail'){
    echo '<table id="page-table"><tr><th>Address</th><th>Details</th><th>Email</th><th>Mobile</th></tr><tr>';
    while($r=mysqli_fetch_array($result))
    {             
             echo '                                              
                     <td>
                          '.$r['address'].'
                     </td>
                     <td>
                          '.$r['details'].'
                     </td>
                     <td>
                          '.$r['email_id'].'
                     </td>
                     <td>
                          '.$r['phone_no'].'
                     </td>
                 ';
             
     } 
    echo '</tr></table>';
}

?>