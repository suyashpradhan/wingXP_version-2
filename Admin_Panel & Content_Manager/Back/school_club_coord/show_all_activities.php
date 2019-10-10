<?php 
session_start();
include_once "../../assets/Users.php";
//$_SESSION['Userid']='cc_1';
$database = new Database();
$conn = $database->getConnection();
$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

if(isset($_SESSION['Userid'])){
    $cc_id= $_SESSION["Userid"];
    $display= "CALL `show_my_activities`('$cc_id');";}
else{
    echo 'No club coordinator found';
    die;
    }

$result = $conn->query($display);
if (mysqli_num_rows($result)>0)
{
echo '<br>';
echo("<table>");
$first_row = true;
while ($row = mysqli_fetch_assoc($result)) {
    if ($first_row) {
        $first_row = false;        
        // Output header row from keys.
        echo '<tr>';
        foreach($row as $key => $field) {
            echo '<th>' . htmlspecialchars($key) . '</th>';
        } 
        echo '</tr>';
    }
    echo '<tr>';
    foreach($row as $key => $field) {
        echo '<td>' . strip_tags($field) . '</td>';
    }
    echo '</tr>';
    }
}
    else {
        echo "<table><tr><th>$id details</th></tr><tr><td>NO DATA</td></tr>";
    }

echo("</table>");
$conn->close();
?>
<style>
    table{border-collapse: collapse;
        min-width:50em;}
    td,th{
        border: 1px solid #ddd;
        padding: 8px;
        
    }
    tr:nth-child(even){background-color: #f2f2f2;}
    tr:hover {background-color: #ddd;}
    th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
    
}
</style>
