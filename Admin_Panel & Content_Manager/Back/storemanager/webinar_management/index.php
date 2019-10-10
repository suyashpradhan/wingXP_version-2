<?php

    include("home_header.php");
    if(isset($_POST['submit'])){
        $save_webinar='INSERT INTO webinar_schedule (title,price,type,username,password,email,description,url,date,time,duration,status)
        VALUES ("'.$_POST['title'].'","'.$_POST['price'].'","'.$_POST['type'].'","'.$_POST['username'].'","'.$_POST['password'].'",
        "'.$_POST['email'].'","'.$_POST['description'].'","'.mysqli_escape_string($db,$_POST['url']).'","'.$_POST['date'].'","'.$_POST['time'].'",
        "'.$_POST['duration'].'","active");SELECT LAST_INSERT_ID();';
        if ($db->multi_query($save_webinar)) {
            do {
                if ($result = $db->store_result()) {
                    while ($row = $result->fetch_row()) {
                        $var = (string) $row[0];
                    }
                    $web_id = "web_".$var;
                    $sqli = "UPDATE webinar_schedule SET web_id = '$web_id' where sno= $var";
                    if($db->query($sqli)){
                        echo '<script>$j( document ).ready(function() {
                            $j("#success").show();
                        });</script>';
                    }
                    else{
                        echo '<script>$j( document ).ready(function() {
                            $j("#danger").show();
                        });</script>';
                    }                            
                }
            } while ($db->next_result());
        }
        else{
            echo '<script>$j( document ).ready(function() {
                $j("#danger").show();
            });</script>';
        }
    }

    if(isset($_POST['update_save'])){
        $save_webinar='UPDATE webinar_schedule set title="'.$_POST['title'].'",price="'.$_POST['price'].'",
        type="'.$_POST['type'].'",username="'.$_POST['username'].'",password="'.$_POST['password'].'",
        email="'.$_POST['email'].'",description="'.$_POST['description'].'",
        url="'.mysqli_escape_string($db,$_POST['url']).'",date="'.$_POST['date'].'",time="'.$_POST['time'].'",
        duration="'.$_POST['duration'].'",status="active" where web_id="'.$_POST['id'].'"';
        if($db->query($save_webinar)) {
            echo '<script>$j( document ).ready(function() {
                $j("#success").show();
            });</script>';
        }
        else{
            echo '<script>$j( document ).ready(function() {
                $j("#danger").show();
            });</script>';
        }
    }
    if(isset($_POST['update'])){
        $get_web_det='select * from webinar_schedule where web_id="'.$_POST['web_id'].'"';
        $res=$db->query($get_web_det);
        while($row=$res->fetch_array()){
            $id=$row['web_id'];
            $title=$row['title'];
            $price=$row['price'];
            $type=$row['type'];
            $username=$row['username'];
            $password=$row['password'];
            $email=$row['email'];
            $description=$row['description'];
            $url=$row['url'];
            $date=$row['date'];
            $time=$row['time'];
            $duration=$row['duration'];
        }

    }
    
?>

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
<div class="alert alert-success alert-dismissible m-5 " id="success" style="display:none;">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Webinar Details Saved 
</div>
<div class="alert alert-danger alert-dismissible m-5 " id="error" style="display:none;">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> There is some error, Please contact Admin
</div>
 <div class="page-container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="webinar" data-toggle="tab" href="#tab-one" role="tab" aria-controls="tab-one"
                    aria-selected="true">Schedule</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="detail" data-toggle="tab" href="#tab-two" role="tab" aria-controls="tab-two"
                    aria-selected="false">Update</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" id="attend" data-toggle="tab" href="#tab-three" role="tab" aria-controls="tab-three"
                    aria-selected="false">Attendance</a>
            </li> 
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="webinar">
              <div class="container">
                <div class="py-5 text-center">
                  <img class="d-block mx-auto mb-4" src="http://www.wingxp.com/assets/images/xperience-1.png" alt="" width="72" height="72">
                  <h2><?php if(isset($_POST['update'])){echo 'Update';}else{ echo 'Schedule';}?> Webinar</h2>
                  <p class="lead">This form lets you create and schedule Webinars for WingXP Courses, Product Demo, School Guidance and more</p>
                </div>

          <div class="row">        
            <div class="offset-md-2 col-md-8 offset-md-2 ">
              <h4 class="mb-3">Details</h4>
              <form class="needs-validation" action="#" method="POST" novalidate>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="firstName">Webinar Title</label>
                    <input type="text" class="form-control" id="title" value="<?php if(isset($title)){echo $title;}?>" name="title" placeholder="Eg: Vision Syncing Webinar" value="" required>
                    <div class="invalid-feedback">
                      Valid Title is required.
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                  <label for="price">Price</label>
                  
                  <div class="custom-control custom-radio">
                    <input id="credit" name="price" type="radio" value="0" class="custom-control-input" <?php if(isset($price) and $price==0){echo 'checked';}?> required>
                    <label class="custom-control-label" for="credit" >Free</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input id="debit" name="price" type="radio" value="1" class="custom-control-input" <?php if(isset($price) and $price==1){echo 'checked';}?> required>
                    <label class="custom-control-label" for="debit">Paid</label>
                  </div>              
                                  
                  </div>
                  <div class="col-md-3 mb-3">
                  <label for="price">Type</label>
                    <select class="custom-select d-block w-100" name="type" required>
                      <option value="s2" <?php if(isset($type) and $type=='s2'){echo 'selected';}?>>School Stage 2</option>
                      <option value="s4" <?php if(isset($type) and $type=='s4'){echo 'selected';}?>>Stage 4</option>
                      <option value="product_demo" <?php if(isset($type) and $type=='product_demo'){echo 'selected';}?> >Product Demo</option>
                      <option value="sales" <?php if(isset($type) and $type=='sales'){echo 'selected';}?>>Sales</option>
                      <option value="other" <?php if(isset($type) and $type=='other'){echo 'selected';}?>>Other</option>
                    </select>
                    <div class="invalid-feedback">
                      Please select a valid Type.
                    </div>                    
                  </div>
                </div>

            <div class="row">
            <div class="col-md-6 mb-3">
              <label for="username">Username <span class="text-muted">(Optional)</span></label>                            
                <input type="text" value="<?php if(isset($username)){echo $username;}?>" class="form-control" name="username" placeholder="Username" >    
            </div>
            <div class="col-md-6 mb-3">
              <label for="username">Password <span class="text-muted">(Optional)</span></label>                            
                <input type="text" value="<?php if(isset($password)){echo $password;}?>" class="form-control" name="password" placeholder="Password" >    
            </div>
            </div>

            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" value="<?php if(isset($email)){echo $email;}?>" class="form-control" name="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Description</label>
              <input type="text" value="<?php if(isset($description)){echo $description;}?>" class="form-control" name="description" placeholder="Describe agenda or points to be covered" required>
              <div class="invalid-feedback">
                Please write a short description or a note about the webinar.
              </div>
            </div>
            <hr class="mb-4">
            <div class="mb-3">
              <label for="address2">Webinar URL</label>
              <input type="text" value="<?php if(isset($url)){echo $url;}?>" class="form-control" name="url" placeholder="https://my-meeting.webex.com/" required>
              <div class="invalid-feedback">
                Please enter a Url for the Webinar.
              </div>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Date</label>
                <input type="date" value="<?php if(isset($date)){echo $date;}?>" class="form-control" name="date" placeholder="dd/mm/yyyy" value="" required>
                <div class="invalid-feedback">
                  Date required.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">Time</label>
                <input type="time" class="form-control" name="time" placeholder="" value="<?php if(isset($time)){echo $time;}else{ echo '09:30';}?>" required>
                <div class="invalid-feedback">
                  Time required.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Duration</label>
                <input type="number" min="0" step="0.5" value="<?php if(isset($duration)){echo $duration;}?>" class="form-control" name="duration" placeholder="Hours" required>
                <div class="invalid-feedback">
                  Duration required
                </div>
              </div>
            </div>
            
            <hr class="mb-4">
            <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}?>">
            <button class="btn btn-primary btn-lg btn-block" name="<?php if(isset($_POST['update'])){echo 'update_save';}else{echo 'submit';}?>" type="submit"><?php if(isset($_POST['update'])){echo 'Update Detail';}else{echo 'Schedule Webinar';}?></button>
          </form>
        </div>
      </div>
    </div>
  </div>
            <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="detail"><div style="overflow-x:auto;overflow-y:auto">
                
            <table class="table table-bordered mt-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="width:2%;">Sno</th>
      <th scope="col">Title</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
                
                $get_webinars='select web_id,title,date,time,status from webinar_schedule order by date desc';
                $res=$db->query($get_webinars);
                $count=0;
                while($row=$res->fetch_array()){
                    $count++;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $count;?></th>
                        <td><?php echo $row['title'];?></td>
                        <td><?php echo $row['date'];?></td>
                        <td><?php echo $row['time'];?></td>
                        <td><?php echo $row['status'];?></td>
                        <td>
                            <button class="btn btn-primary m-1" name="detail" data-target="#detail-modal" data-toggle="modal" onclick="action('detail','<?php echo $row['web_id'];?>')">Details</button>
                            <button class="btn btn-danger m-1" name="inactive" onclick="action('inactive','<?php echo $row['web_id'];?>')">Mark as Inactive</button>
                            <form action="#" method="post"><input name="web_id" type="hidden" value="<?php echo $row['web_id'];?>"><button class="btn btn-warning m-1" type="submit" name="update">Update</button></form>
                        </td>
                    </tr>  
                    <?php
                }

            ?>
      
  </tbody>
</table>
                
            </div>  
              </div>               
        
        <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="attend">
        
        <!--HERE-->
          <div style="overflow-x:auto;overflow-y:auto">
          <table class="table table-bordered mt-5">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width:2%;">Sno</th>
                <th scope="col">School Name</th>
                <th scope="col">Webinar Attended</th>
                <th scope="col">School Status</th>
                <th scope="col">Contact</th>
                <th scope="col">Attendance</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php 
                
                $get_webinars='select institution.sno,institute_id,webinar_schedule.web_id,webinar_schedule.type,institute_name,title,institution.status as school_status,phone_no,webinar_attendance.status as attendance from webinar_attendance inner join 
                webinar_schedule on  webinar_schedule.web_id = webinar_attendance.web_id inner join institution on institute_id=webinar_attendance.id order by webinar_schedule.datetime desc';
                $res=$db->query($get_webinars);
                $count=0;
                while($row=$res->fetch_array()){
                    $count++;
              ?>
                    <tr>
                        <th scope="row"><?php echo $count;?></th>
                        <td><?php echo $row['institute_name'];?></td>
                        <td><?php echo $row['title'];?></td>
                        <td><?php echo $row['school_status'];?></td>
                        <td><?php echo $row['phone_no'];?></td>
                        <td><?php if($row['attendance']==1){echo 'Present';}else{echo 'Not Attended';}?></td>
                        <td>
                            <button class="btn btn-danger m-1" name="missed" onclick="action('missed','<?php echo $row['institute_id'];?>','<?php echo $row['web_id'];?>','<?php echo $row['type'];?>','<?php echo $row['sno'];?>')">Not Attended</button>
                            <button class="btn btn-success m-1" name="missed" onclick="action('attended','<?php echo $row['institute_id'];?>','<?php echo $row['web_id'];?>','<?php echo $row['type'];?>','<?php echo $row['sno'];?>')">Attended</button>
                        </td>
                    </tr>  
                    <?php
                }

            ?>
      
              </tbody>
              </table>    
              </div>
        <!--HERE-->
        
        </div>
              
              </div>
              </div>
              
    
    <div class="page-container">     
        <a href="index.php" class="home_link">Home</a>
    </div>
    
<!--copyright starts-->
<?php
    include("../admin_footer.php");
?>
<!--copyright ends--> 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>

        <script>

function action(a,id,arg1,arg2,arg3){
    event.preventDefault();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: "../action.php?id="+id+"&action="+a+"&arg1="+arg1+"&arg2="+arg2+"&arg3="+arg3,
        data:'',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data);
            if(a=='detail'){
                $('#detail-inject').html(data)
                $("#detail-modal").show();
            }
            else if(a=='inactive' && data=='success'){
                window.scrollTo(0,0);
                $("#success").show();
            }
            else if(a=='missed' && data=='success'){
                window.scrollTo(0,0);
                $("#success").show();
            }
        },
        error: function (e) {
            console.log(e);
        }
  

});
    
}
            </script>


        <!-- The Modal -->
  <div class="modal" id="detail-modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Webinar Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div id="detail-inject">
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

</body>
</html>