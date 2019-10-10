<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$q1='select count(*) from school__web_reg where datetime>CURDATE()';
$q2='select count(*) from demo_user where datetime>CURDATE() and type="demo"';
$q3='select count(*) from demo_user where datetime>CURDATE() and type="contact"';
$q4='select count(*) from school__enquiry where datetime>CURDATE()';
$q10='select count(*) from institution where datetime>CURDATE()';
$q5='select count(*) from sales_comments where type="webinar" and datetime>CURDATE()';
$q6='select count(*) from sales_comments where type="contact" and datetime>CURDATE()';
$q7='select count(*) from sales_comments where type="demo" and datetime>CURDATE()';
$q8='select count(*) from sales_comments where type="inc_school" and datetime>CURDATE()';
$q9='select count(*) from sales_comments where type="comp" and datetime>CURDATE()';
$res=$conn->query($q1);
$row1=$res->fetch_array();
$res=$conn->query($q2);
$row2=$res->fetch_array();
$res=$conn->query($q3);
$row3=$res->fetch_array();
$res=$conn->query($q4);
$row4=$res->fetch_array();
$res=$conn->query($q5);
$row5=$res->fetch_array();
$res=$conn->query($q6);
$row6=$res->fetch_array();
$res=$conn->query($q7);
$row7=$res->fetch_array();
$res=$conn->query($q8);
$row8=$res->fetch_array();
$res=$conn->query($q9);
$row9=$res->fetch_array();
$res=$conn->query($q10);
$row10=$res->fetch_array();
echo '<table border="1">
    <tr>
        <th>Form</th>
        <th>Count</th>
        <th>Comments</th>
    </tr>
    <tr>
        <td>Webinar</td>
        <td>'.$row1[0].'</td>
        <td>'.$row5[0].'</td>
    </tr>
    <tr>
        <td>Contact</td>
        <td>'.$row3[0].'</td>
        <td>'.$row6[0].'</td>
    </tr>
    <tr>
        <td>Demo</td>
        <td>'.$row2[0].'</td>
        <td>'.$row7[0].'</td>
    </tr>
    <tr>
        <td>Unfilled Registration</td>
        <td>'.$row4[0].'</td>
        <td>'.$row8[0].'</td>
    </tr>
    <tr>
        <td>Registered </td>
        <td>'.$row10[0].'</td>
        <td>'.$row9[0].'</td>
    </tr>
    </table>';