<?php 
$subject = 'Notice for Principals for Session 2019-20, take your School Clubs Online for Free!';
$message='<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>

<body>
    <table style="width: 650px;margin:auto;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse;">
        <tbody>
            <tr>
                <td><p style="margin:0 auto;display:block;"><a href="http://wingxp.com"><img src="http://www.wingxp.com/emailer/images/mailer-19-20.png" alt="Loading..." style="width: 650px;"></a></p></td>
            </tr>
        </tbody>
    </table>
</body>

</html>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers.= "Content-type:text/html;charset=iso-8859-1"."\r\n";
$headers.= "From:contact@wingxp.com";
$email1='nkirandroid@gmail.com';
echo $message;
 if(mail($email1,$subject,$message,$headers))
{
   echo $message;
}
else
{
   echo "error";
}    
?>