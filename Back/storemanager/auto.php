<?php 
include_once("../assets/Users.php");
$database = new Database();
$conn = $database->getConnection();
    if(isset($_GET['event'])){?>
        <script>
                var r = confirm("Do you want to mark <?php if(isset($_GET['name'])){
                    echo $_GET['name'];}?> with ID: <?php if(isset($_GET['id'])){
                        echo $_GET['id'];}?> as attended webinar for <?php if(isset($_GET['event'])){
                            echo $_GET['event'];}?> ?");
                if (r == true) {
                    window.location.href = 'auto.php?action=update&id=<?php echo $_GET['id']?>&event_mark=<?php echo $_GET['event'];?>';
                } else {
                    window.open('','_self').close();
                }
                document.getElementById("demo").innerHTML = txt;
                
        </script>
    <?php }
    if(isset($_GET['action']) and $_GET['action']=='update'){
        $get_attended_web='UPDATE webinar_attendance SET status="1" where id="'.$_GET['id'].'"';      
        $get_sno='SELECT sno from institution where institute_id="'.$_GET['id'].'"';
        $res_sno=$conn->query($get_sno);
        $row=$res_sno->fetch_array();
        $sno=$row['sno'];  
        if($conn->query($get_attended_web)){
           if($_GET['event_mark']=='stage-2'){
            $q='INSERT INTO school__stage (id,stage) VALUES ("'.$sno.'","s2")';
           }
           else if($_GET['event_mark']=='stage-4'){
            $q='INSERT INTO school__stage (id,stage) VALUES ("'.$sno.'","s4")';
           }
           if($conn->query($q)){
               echo "<h1>Successfully Marked Attendance</h1><script>window.open('','_self').close();</script>";
           }
        }
    }
?>