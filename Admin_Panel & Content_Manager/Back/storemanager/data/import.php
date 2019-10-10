<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
$inst_id=$_SESSION['inst_id'];

?>
<head>    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script></head>
<body>
<h2>Import Excel File into MySQL Database using PHP</h2>
    
    <div class="outer-container">
        <form action="process.php" method="POST" id="temp" enctype="multipart/form-data">
             <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <input type="submit" id="submit" name="import" class="btn-submit">
        </form>        
    </div>
   
    
         
<?php
    
    $sqlSelect = "SELECT * FROM student_data where institute_id = '$inst_id'";
    $result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
        
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>Roll</th>
                <th>Student Name</th>
                <th>Parent Name</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['roll_no']; ?></td>
            <td><?php  echo $row['s_name']; ?></td>
            <td><?php  echo $row['p_name']; ?></td>
            <td><?php  echo $row['phone']; ?></td>
            <td><?php  echo $row['email']; ?></td>
        </tr>
<?php
    }
?>
        </tbody>
    </table>
<?php 
} 
?>
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script language="javascript">
        // function ajaxbackend(){        
        //                 event.preventDefault();            
        //                 var form = $('#temp');           
        //             var data =  $(form).serialize(); 
        //             $.ajax({
        //                 type: "POST",
        //                 enctype: 'multipart/form-data',
        //                 url: "process.php",
        //                 data: data,
        //                 processData: false,
        //                 contentType: false,
        //                 cache: false,
        //                 timeout: 600000,
        //                 success: function (data) {   
        //                     console.log(data);                          
        //                     if (data=='success')
        //                 {alert('Published Successfully !');
        //                 location.reload(true); 
        //                 }else if(data=='error')
        //                 {
        //                     alert('Check Input Data !');
        //                     location.reload(true); 
        //                 }                
                                                                        
        //                 },
        //                 error: function (e) {           
        //                     console.log(e);
        //                 }
        //             });     
        // }               
        
        </script>    
        </body>