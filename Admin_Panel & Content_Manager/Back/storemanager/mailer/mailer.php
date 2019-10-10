<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
?>
<head>    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script></head>
<body>
<h2>Import Excel File into MySQL Database using PHP</h2>
    
    <div class="outer-container">
        <form action="" method="POST" id="temp" enctype="multipart/form-data">
             <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                    <input type="hidden" name="import" value="1">                    
                <button onclick="import_xl();" class="btn-submit">Import</button>
        </form>        
    </div><br>
    <div>
    <h2>View Schools</h2>
    <form id="show">
    <select id='state' name='state' onchange='get_city();'>
    <?php 
        $get_state_q='select state from send_sms_school where 1 group by state order by state asc';
        $res=$conn->query($get_state_q);
        while($row=$res->fetch_row()){
            echo '<option value="'.$row[0].'">'.$row[0].'</option>';
        }
    ?>
    </select><br>
    <select id='city' name='city' onchange="get_school();">
    </select>
    </form>
    </div>
    <div id="view">
    </div>     <br>
    <div>
    <button onclick="send_sms();">Send SMS</button>
    </div>    

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
        $( document ).ready(function() {
            get_city();

        });   
        function import_xl(){
            event.preventDefault();            
                        var form = $('#temp')[0];  
                        var data = new FormData(form);  
                        //var data =  $(form).serialize();
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "process.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {
                            get_city();                                                         
                        },
                        error: function (e) {           
                            console.log(e);
                        }
            });
        }
        function get_city(){
            var state=$('#state').val();
            $.ajax({
                        type: "GET",
                        url: "process.php?get_city="+state,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {
                            $('#city').html(data); 
                            get_school();                                                                       
                        },
                        error: function (e) {           
                            console.log(e);
                        }
            });
        }     
        function get_school(){
            var state=$('#state').val();
            var city=$('#city').val();
            $.ajax({
                        type: "GET",
                        url: "process.php?state="+state+"&city="+city,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {
                            $('#view').html(data);                                                                        
                        },
                        error: function (e) {           
                            console.log(e);
                        }
            });
        }   
        function send_sms(){
            var state=$('#state').val();
            var city=$('#city').val();
            $.ajax({
                        type: "GET",
                        url: "process.php?state_s="+state+"&city_s="+city,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {
                            console.log(data);
                            if(data=='success'){
                                location.reload();  
                            }                                                                     
                        },
                        error: function (e) {   
                            alert('Error in the System');
                            location.reload();               
                            console.log(e);
                        }
            });
        }   

        
        </script>    
        </body>