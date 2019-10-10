<?php 
session_start();
include_once "/assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
if(isset($_POST['school_name'])){$school_name = mysqli_real_escape_string($conn,$_POST['school_name']);}else{$school_name = '';}
if(isset($_POST['school_no'])){$school_phone = mysqli_real_escape_string($conn,$_POST['school_no']);}else{$school_phone = '';}
if(isset($_POST['school_add'])){$school_add = mysqli_real_escape_string($conn,$_POST['school_add']);}else{$school_add = '';}
if(isset($_POST['school_email'])){$school_email = mysqli_real_escape_string($conn,$_POST['school_email']);}else{$school_email = '';}
if(isset($_POST['prin_name'])){$prin_name = mysqli_real_escape_string($conn,$_POST['prin_name']);}else{$prin_name = '';}
if(isset($_POST['prin_phone'])){$prin_phone = mysqli_real_escape_string($conn,$_POST['prin_phone']);}else{$prin_phone = '';}
if(isset($_POST['prin_email'])){$prin_email = mysqli_real_escape_string($conn,$_POST['prin_email']);}else{$prin_email = '';}
if(isset($_POST['mob_otp'])){$mob_otp = mysqli_real_escape_string($conn,$_POST['mob_otp']);}else{$mob_otp = '';}
if(isset($_POST['email_otp'])){$email_otp = mysqli_real_escape_string($conn,$_POST['email_otp']);}else{$email_otp = '';}
$check=$conn->query("select * from institution where email_id ='$school_email'");
$present=$check->num_rows;
if($present!==0){
    echo 'present';
    die;
}
else
{
if(isset($_POST['action']))
{   
    if ($_POST['action']=='add')
    {   
        if(isset($_POST['mob_otp'])){
            
            $validate=$conn->query("select * from school__enquiry where otp='$mob_otp'");
            $present=$validate->num_rows;
            if($present>0){
                $timestamp=date("Y-m-d h:i:s");
                $desc= 'Principal Name: '.$prin_name.' Principal Email: '.$prin_email.'Principal Contact: '.$prin_phone;
                $sql = "INSERT INTO institution (institute_name, details, address, email_id, phone_no, username, password,status,datetime,principal_name,principal_email,principal_phone) VALUES ('$school_name','$desc','$school_add','$school_email','$school_phone','$school_email','$school_phone','5','$timestamp','$prin_name''$prin_email''$prin_phone');";
                $sql .= "SELECT LAST_INSERT_ID()"; 
                $sql2="UPDATE school__enquiry set status=1 where otp='$mob_otp'";
                $conn->query($sql2);                
                $key = "124046AH1JdQvqo658c7bdff";
                $send_id = "WINGXP";
                $message = "Thank you for registering your school on WingXP.com\nYour account details will be verified and you will recieve a call from our expert for completion of registration process to get access to online clubs.\n\nRegards,\nWingXP.com";
                $route = "route=4";
                $data = array(
                'authkey' => $key,
                'mobiles' => "$school_phone,$prin_phone",
                'message' => $message,
                'sender' => $send_id,
                'route' => $route
                );
                $url="https://control.msg91.com/api/sendhttp.php";
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
                $stat=0;
                }
                else{
                   $stat=1;
                }
                if ($conn->multi_query($sql)) {
                    do {
                        if ($result = $conn->store_result()) {
                            while ($row = $result->fetch_row()) {
                                $var = (string) $row[0];
                            }
                            $institute_id = "INST_".$var."";
                            $sqli = "UPDATE institution SET institute_id = '$institute_id' where sno= $var";
                            $conn->query($sqli);
                            $sql3="INSERT INTO school__stage (id,stage) VALUES ('$institute_id','s1')";
                            $conn->query($sql3);
                            $result->free();
                            $email1_school=$school_email;
                            $subject_school="Registration Successful - Welcome to WingXP iclubs, World Class Co-curriculars";
                            $message_school= '<table style="width:850px; font-family: Arial, Helvetica, sans-serif; border-collapse:collapse;border:0px solid #ccc">
                            <tbody>
                                <tr style="background-color: #fff;height:45px; border-bottom:2px solid #ccc;">
                                    <td colspan="1" align="left">
                                        <a href="#" style="padding: 25px 15px;height:30px; color: #333;font-size: 24px; text-decoration: none;"></a>
                                    </td>
                                        <td colspan="1" align="right">
                                        <img src="http://wingxp.com/emailer/images/wingxp.png" height="75px" />
                                    </td>
                                </tr>
                                    <tr height="20px;"><td>&nbsp;</td></tr>
                                    <tr>
                                        <td colspan="2"> 
                                            
                                                <p dir="ltr" >Dear &ldquo;<span style="color:rgb(61, 133, 198);">'.$prin_name.'</span>&rdquo;,</p>
                        <p dir="ltr">Thank you for registering your school on WingXP.com.</p>
                        <p dir="ltr">You have provided the following details from your school to register for WingXP iclubs.</p>
                        <table>
                            <tr><td><p dir="ltr" style="color:rgb(61, 133, 198);margin:0px 0px 13px 40px;border:none;padding:0px">School Name</p></td><td> <p style="color:rgb(61, 133, 198);margin:0px 0px 13px 0px;border:none;padding:0px">: '.$school_name.'</p></td></tr>
                            <tr><td><p dir="ltr" style="color:rgb(61, 133, 198);margin:0px 0px 13px 40px;border:none;padding:0px">Email ID</p> </td><td><p style="color:rgb(61, 133, 198);margin:0px 0px 13px 0px;border:none;padding:0px">: '.$school_email.'</p></td><td> <p style="color:rgb(61, 133, 198);margin-left:100px;border:none;padding:0px">Phone No: '.$school_phone.'</p></td></tr>
                            <tr><td><p dir="ltr" style="color:rgb(61, 133, 198);margin:0px 0px 13px 40px;border:none;padding:0px">Principal Name</p> </td><td><p style="color:rgb(61, 133, 198);margin:0px 0px 13px 0px;border:none;padding:0px">: '.$prin_name.'</p></td></tr>
                            <tr><td><p dir="ltr" style="color:rgb(61, 133, 198);margin:0px 0px 13px 40px;border:none;padding:0px">Principal Email ID</p> </td><td><p style="color:rgb(61, 133, 198);margin:0px 0px 13px 0px;border:none;padding:0px">: '.$prin_email.'</p></td><td> <p style="color:rgb(61, 133, 198);margin-left:100px;border:none;padding:0px">Principal No: '.$prin_phone.'</p></td></tr>
                        </table>
                    
                        <p dir="ltr">*In case of any corrections please write us on <a href="mailto:contact@wingxp.com" target="_blank" rel="noopener">contact@wingxp.com</a></p>
                        <p dir="ltr">&nbsp;You account details will be verified and, you will receive a call from our Relationship Manager(Mr. Swapnil - 9326075258) and he will help you set-up your account.</p>
                        <p dir="ltr">Once your school account is set up, you will be able to</p>
                        <ul>
                        <li dir="ltr">
                        <p dir="ltr">Add WingXP iclubs to your school&rsquo;s Co-curricular offerings</p>
                        </li>
                        <li dir="ltr">
                        <p dir="ltr">Take your existing clubs/co-curriculars Online with the 3XP framework</p>
                        </li>
                        <li dir="ltr">
                        <p dir="ltr">Get access to Network of Co-curricular Expertise.</p>
                        </li>
                        </ul> <br />
                        <p dir="ltr">Best Regards,</p>
                        <div>
                        <div class="m_1104334373662409089m_5827337721389440855m_1548833085480713722gmail_signature" dir="ltr" data-smartmail="gmail_signature">Swapnil Ajmera</div>
                        </div> 
                                        </td> 
                                    </tr> 
                    
                        <tr height="70px;"><td>&nbsp;</td></tr>
                    
                                    <tr><td colspan="2">
                                            <table style="width:850px; margin:auto;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse;border:0px solid #ccc">
                                    <tbody>
                                <tr style="background-color: #fff;height:45px;">
                                    <td colspan="1" align="center">
                                                <img src="http://wingxp.com/emailer/images/mail.png" height="45px" />  
                                    </td>
                                        <td colspan="1" align="center">
                                        <img src="http://wingxp.com/emailer/images/map.png" height="45px" />   
                                    </td>
                                        <td colspan="1" align="center">
                                        <img src="http://wingxp.com/emailer/images/phone.png" height="45px" /> 
                                    </td> 
                                </tr>
                                            
                                <tr> 
                                        <td align="center"> Info@wingxp.com <br /> contact@wingxp.com </td>
                                        <td align="center">Awfis, 10th floor, Aston Building, <br /> Lokhandwala, Andheri (W), Mumbai  </td>
                                        <td align="center">   +91-9326075258 <br /> +91-9460394714 </td>
                                    </tr>    
                                <tr>
                                        <td colspan="3">  <img src="http://wingxp.com/emailer/images/footer.png" height="45px" width="850px;" />
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                                    </td></tr>   
                            
                            </tbody>
                        </table> ';
                            $headers_school ="MIME-Version: 1.0"."\r\n";
                            $headers_school.="Content-type:text/html;charset=iso-8859-1"."\r\n";
                            $headers_school.="From:contact@livecbse.com";                            
                             $email_ids = 'contact@domain-education.com,abhishek1404@gmail.com,swapnil.ajmera@gmail.com'; 
                            $subject = 'New WingXP School Registration Form with id: '.$institute_id;
                            $message_2="<b>School Name:</b> $school_name <br><br> <b>School Email Id:</b> $school_email <br><br> <b>Phone No: </b>$school_phone <br><br> <b>Address: </b>$school_add <br><br> <b>Details: </b>$desc  <br><br>  has <b> Registered </b> through the website" ;
                            $header = "MIME-Version: 1.0" . "\r\n";
                            $header.= "Content-type:text/html;charset=iso-8859-1"."\r\n";
                            $header.= "From:contact@wingxp.com"; 
                            if(mail($email1_school,$subject_school,$message_school,$headers_school) and  mail($email_ids,$subject,$message_2,$header)  )
                            {                            
                                $stat=1;
                            }
                            else
                            {
                            $stat=0;
                            }
                            if($stat==1){
                                echo 'success';                               
                            }
                            else{
                                echo 'error';
                            }
                        }
                    } while ($conn->next_result());
                }
            }
            else{
            echo 'error';
            }
        }     
    } 
} }
$conn->close();