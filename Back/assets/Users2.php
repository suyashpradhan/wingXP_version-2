<?php 
class database {
    function getConnection(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cbse360"; 
        return  mysqli_connect($servername, $username, $password,$dbname);
        
    }


}
?>
