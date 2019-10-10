<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
session_start();
$_SESSION['Userid']='INST_258';
$inst_id=$_SESSION['Userid'];

$get_batch='select inst_class.class,batch_name from inst_batch inner join inst_class on inst_batch.class_id = inst_class.class_id where institute_id = "'.$inst_id.'" order by batch_name';
$result=$conn->query($get_batch);
$i=6; $j=0;
while($row = $result->fetch_array())
{  
    $arr[$row['class']][]=$row['batch_name'];

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    <body style="
    position: relative; ">
      <div class="new-container">
        <div class="batch-section">
            <a href="student_display.php" class="batch-section_link">View Students</a>
            <a href="add_user.php" class="batch-section_link">Add Students to Batch</a>
        </div>
        <div class="batch-card batch-card_2">
                <h1 class="__head">Add Batch </h1>
                <div class="row-wrapper">
                    <h1 class="row--head">Class 6</h1>
                    <label class="pure-material-checkbox">
                            <input type="checkbox" id="class-6" checked onclick="remove_class(6);">
                            <span></span>
                    </label>
                    <ul class="row--list" id="batch-6">
                    <?php if(isset($arr[6])){
                             foreach($arr[6] as $a){
                                echo '<li id="'.$a.'">'.$a.'</li>';
                            }}else{}
                            ?>
                    </ul>
                    <span><a href="#" class="row--link" onclick="add_batch(6);">+</a>
                    <a href="#" class="row--link" onclick="remove_batch(6);">-</a></span>
                </div>
                <div class="row-wrapper">
                        <h1 class="row--head">Class 7</h1>
                        <label class="pure-material-checkbox">
                                <input type="checkbox" id="class-7" checked onclick="remove_class(7);">
                                <span></span>
                        </label>
                        <ul class="row--list" id="batch-7">
                        <?php if(isset($arr[7])){
                             foreach($arr[7] as $a){
                                echo '<li id="'.$a.'">'.$a.'</li>';
                            }}else{}
                            ?>
                        </ul>
                        <span><a href="#" class="row--link" onclick="add_batch(7);">+</a>
                    <a href="#" class="row--link" onclick="remove_batch(7);">-</a></span>
                    </div>
                    <div class="row-wrapper">
                            <h1 class="row--head">Class 8</h1>
                            <label class="pure-material-checkbox">
                                    <input type="checkbox" id="class-8" checked onclick="remove_class(8);">
                                    <span></span>
                            </label>
                            <ul class="row--list" id="batch-8">
                            <?php if(isset($arr[8])){
                             foreach($arr[8] as $a){
                                echo '<li id="'.$a.'">'.$a.'</li>';
                            }}else{}
                            ?>
                            </ul>
                            <span><a href="#" class="row--link" onclick="add_batch(8);">+</a>
                    <a href="#" class="row--link" onclick="remove_batch(8);">-</a></span>
                        </div>
                        <div class="row-wrapper">
                                <h1 class="row--head">Class 9</h1>
                                <label class="pure-material-checkbox">
                                        <input type="checkbox" id="class-9" checked onclick="remove_class(9);">
                                        <span></span>
                                </label>
                                <ul class="row--list" id="batch-9">
                                <?php if(isset($arr[9])){
                             foreach($arr[9] as $a){
                                echo '<li id="'.$a.'">'.$a.'</li>';
                            }}else{}
                            ?>
                                </ul>
                                <span><a href="#" class="row--link" onclick="add_batch(9);">+</a>
                    <a href="#" class="row--link" onclick="remove_batch(9);">-</a></span>
                            </div>
                            <div class="row-wrapper">
                                    <h1 class="row--head">Class 10</h1>
                                    <label class="pure-material-checkbox">
                                            <input type="checkbox" id="class-10" checked onclick="remove_class(10);">
                                            <span></span>
                                    </label>
                                    <ul class="row--list" id="batch-10">
                                    <?php if(isset($arr[10])){
                             foreach($arr[10] as $a){
                                echo '<li id="'.$a.'">'.$a.'</li>';
                            }}else{}
                            ?>
                                    </ul>
                                    <span><a href="#" class="row--link" onclick="add_batch(10);">+</a>
                    <a href="#" class="row--link" onclick="remove_batch(10);">-</a></span>
                            </div>
                                <div class="row-wrapper">
                                        <h1 class="row--head">Class 11</h1>
                                        <label class="pure-material-checkbox">
                                                <input type="checkbox" id="class-11" checked onclick="remove_class(11);">
                                                <span></span>
                                        </label>
                                        <ul class="row--list" id="batch-11">
                                        <?php if(isset($arr[11])){
                             foreach($arr[11] as $a){
                                echo '<li id="'.$a.'">'.$a.'</li>';
                            }}else{}
                            ?>
                                        </ul>
                                        <span><a href="#" class="row--link" onclick="add_batch(11);">+</a>
                    <a href="#" class="row--link" onclick="remove_batch(11);">-</a></span>
                                </div>
                                    <div class="row-wrapper">
                                            <h1 class="row--head">Class 12</h1>
                                            <label class="pure-material-checkbox">
                                                    <input type="checkbox" id="class-12" checked onclick="remove_class(12);">
                                                    <span></span>
                                            </label>
                                            <ul class="row--list" id="batch-12">    
                                            <?php if(isset($arr[12])){
                             foreach($arr[12] as $a){
                                echo '<li id="'.$a.'">'.$a.'</li>';
                            }}else{}
                            ?>
                                            </ul>
                                            <span><a href="#" class="row--link" onclick="add_batch(12);">+</a>
                    <a href="#" class="row--link" onclick="remove_batch(12);">-</a></span>
                                    </div>
                                    
                                        </div></div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script>
            function add_batch(cls){
                if ($('#class-'+cls).prop('checked')) {
                var temp_id='batch-';
                var last = $('#'+temp_id+cls+' li:last-child').last().text();
                if(last==''){last='@';}else{}
                next= String.fromCharCode(last.charCodeAt(0) + 1);
                $.ajax({
						  type: 'GET',
						  url: 'batch_back.php?action=add&class='+cls+'&batch='+next,
						  data: '',
						  success: function(response){  
                              console.log(response);
                            if(response=='success'){
                                $('#'+temp_id+cls).append('<li id="'+next+'">'+next+'</li>');
                            }
                            else{
                                alert('error');
                            }

						  } ,
                        error: function (e) {   
                            alert('error');        
                            console.log(e);
                        }
					       });                
                }     
                else{alert('Select Class');}              
                        
            }
            function remove_class(cls){
                if ($('#class-'+cls).prop('checked')) {}
                else{
                    var bool = confirm('Are your sure you want to delete Class:'+cls+' and all of its batches ? ');
                    if(bool==true){
                        $.ajax({
						  type: 'GET',
						  url: 'batch_back.php?action=delclass&class='+cls,
						  data: '',
						  success: function(response){  
                              console.log(response);
                            if(response=='success'){
                                $('#batch-'+cls+' li').remove();
                            }
                            else{
                                alert('error');
                            }

						  } ,
                        error: function (e) {   
                            alert('error');        
                            console.log(e);
                        }
					       });          
                    }
                    else{}
                }
            }
            function remove_batch(cls){                                
                var temp_id='batch-';
                var last = $('#'+temp_id+cls+' li:last-child').last().text();
                if(last==''){last='@';}else{}
                    next= String.fromCharCode(last.charCodeAt(0));
                $.ajax({
						  type: 'GET',
						  url: 'batch_back.php?action=delbatch&class='+cls+'&batch='+next,
						  data: '',
						  success: function(response){  
                              console.log(response);
                            if(response=='success'){
                                $('#'+temp_id+cls+' li#'+next).remove();
                            }
                            else{
                                alert('error');
                            }

						  } ,
                        error: function (e) {   
                            alert('error');        
                            console.log(e);
                        }
					       });                
                
                            
            }
        </script>
  </body>
</html>
