<?php 
class database {
    function getConnection(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "testune"; 
        return  mysqli_connect($servername, $username, $password,$dbname);
        
    }


}
?>
