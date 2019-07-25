<?php
include("home_header.php");
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous" />
    <div class="page-container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" id="school" data-toggle="tab" href="#tab-one" role="tab" aria-controls="tab-one"
                    aria-selected="true">Webinar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="pending" data-toggle="tab" href="#tab-two" role="tab" aria-controls="tab-two"
                    aria-selected="true">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="approved" data-toggle="tab" href="#tab-three" role="tab" aria-controls="tab-three"
                    aria-selected="false">Demo</a>
            </li>
            <!-- CHANGE 1 START-->
            <li class="nav-item">
                <a class="nav-link" id="incomplete" data-toggle="tab" href="#tab-four" role="tab" aria-controls="tab-three"
                    aria-selected="false">Incomplete Registration</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="complete" data-toggle="tab" href="#tab-five" role="tab" aria-controls="tab-three"
                    aria-selected="false">Complete Registration</a>
            </li>
            <!-- CHANGE 1 END-->
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="school">
                <div style="overflow-x:auto;overflow-y:auto">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th  scope="col">S No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">School Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Comments</th>
                            </tr>
                        </thead>
                        <?php   $count=0;
            
   $t2=mysqli_query($db,"select * from school__web_reg");
   $rows=mysqli_num_rows($t2);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
                <tr>
                    <td>
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <?php echo $r['name']; ?>
                    </td>
                    <td>
                        <?php echo $r['phone']; ?>
                    </td>
                    <td>
                        <?php echo $r['school_name']; ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y',strtotime($r['datetime'])); ?>
                    </td>
                    <td>
                        <button data-target='#comment' id="<?php echo 'webinar'.$r['sno'];?>" value="<?php echo $r['sno']; ?>" data-toggle='modal' class="btn btn-primary" onclick="get_comments('webinar','<?php echo $r['sno'];?>');">
                        <?php 
                        $q='select * from sales_comments where type="webinar" and id="'.$r['sno'].'"';
                        $result=$db->query($q);
                        if($result->num_rows<1){
                            echo 'Add';
                        }
                        else{
                            echo 'View';
                        }
                        ?></button>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
                    </table>
                              
</div>
            </div>
            <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="school">
                <br>
                <div style="overflow-x:auto;overflow-y:auto">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">S No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Message</th>
                                <th scope="col">Date</th>
                                <th scope="col">Comments</th>
                            </tr>
                        </thead>
                        <?php   $count=0;
            
   mysqli_data_seek($t2,$r);
   $t2=mysqli_query($db,"select * from demo_user where type='contact'");
   $rows=mysqli_num_rows($t2);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
                <tr>
                    <td>
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <?php echo $r['name']; ?>
                    </td>
                    <td>
                        <?php echo $r['phone']; ?>
                    </td>
                    <td>
                        <?php echo $r['email']; ?>
                    </td>
                    <td>
                        <?php echo $r['message']; ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y',strtotime($r['datetime'])); ?>
                    </td>
                    <td>
                    <button data-target='#comment' id="<?php echo 'contact'.$r['sno'];?>" value="<?php echo $r['sno']; ?>" data-toggle='modal' class="btn btn-primary" onclick="get_comments('contact','<?php echo $r['sno'];?>');">
                        <?php 
                        $q='select * from sales_comments where type="contact" and id="'.$r['sno'].'"';
                        $result=$db->query($q);
                        if($result->num_rows<1){
                            echo 'Add';
                        }
                        else{
                            echo 'View';
                        }
                        ?></button>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="school">
                <br>
                <div style="overflow-x:auto;overflow-y:auto">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">S No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date</th>
                                <th scope="col">Comments</th>
                            </tr>
                        </thead>
                        <?php   $count=0;
            
   mysqli_data_seek($t2,$r);
   $t2=mysqli_query($db,"select * from demo_user where type='demo'");
   $rows=mysqli_num_rows($t2);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
                <tr>
                    <td>
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <?php echo $r['name']; ?>
                    </td>
                    <td>
                        <?php echo $r['phone']; ?>
                    </td>
                    <td>
                        <?php echo $r['email']; ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y',strtotime($r['datetime'])); ?>
                    </td>
                    <td>
                    <button data-target='#comment' id="<?php echo 'demo'.$r['sno'];?>" value="<?php echo $r['sno']; ?>" data-toggle='modal' class="btn btn-primary" onclick="get_comments('demo','<?php echo $r['sno'];?>');">
                        <?php 
                        $q='select * from sales_comments where type="demo" and id="'.$r['sno'].'"';
                        $result=$db->query($q);
                        if($result->num_rows<1){
                            echo 'Add';
                        }
                        else{
                            echo 'View';
                        }
                        ?></button>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
                    </table>
                </div>
            </div>
            <!-- CHANGE 2 START-->
            <div class="tab-pane fade" id="tab-four" role="tabpanel" aria-labelledby="school">
                <br>
                <div style="overflow-x:auto;overflow-y:auto">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">S No</th>
                                <th scope="col">School Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Principal's Name</th>
                                <th scope="col">Principal's Phone</th>
                                <th scope="col">Principal's Email</th>
                                <th scope="col">Comments</th>
                            </tr>
                        </thead>
                        <?php   $count=0;
            
   mysqli_data_seek($t2,$r);
   $t2=mysqli_query($db,"select * from school__enquiry where status!=1");
   $rows=mysqli_num_rows($t2);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
                <tr>
                    <td>
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <?php echo $r['school_name']; ?>
                    </td>
                    <td>
                        <?php echo $r['address']; ?>
                    </td>
                    <td>
                        <?php echo $r['email']; ?>
                    </td>
                    <td>
                        <?php echo $r['phone']; ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y',strtotime($r['datetime'])); ?>
                    </td>
                    <td>
                        <?php echo $r['principal_name']; ?>
                    </td>
                    <td>
                        <?php echo $r['principal_phone']; ?>
                    </td>
                    <td>
                        <?php echo $r['principal_email']; ?>
                    </td>
                    <td>
                    <button data-target='#comment' id="<?php echo 'inc_school'.$r['sno'];?>" value="<?php echo $r['sno']; ?>" data-toggle='modal' class="btn btn-primary" onclick="get_comments('inc_school','<?php echo $r['sno'];?>');">
                        <?php 
                        $q='select * from sales_comments where type="inc_school" and id="'.$r['sno'].'"';
                        $result=$db->query($q);
                        if($result->num_rows<1){
                            echo 'Add';
                        }
                        else{
                            echo 'View';
                        }
                        ?></button>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-five" role="tabpanel" aria-labelledby="school">
                <br>
                <div style="overflow-x:auto;overflow-y:auto">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">S No</th>
                                <th scope="col">School Name</th>
                                <th scope="col">Details</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone No</th>
                                <th scope="col">Status</th>   
                                <th scope="col">Date</th>                              
                                <th scope="col">Comments</th>
                            </tr>
                        </thead>
                        <?php   $count=0;
            
   mysqli_data_seek($t2,$r);
   $t2=mysqli_query($db,"select * from institution");
   $rows=mysqli_num_rows($t2);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
                <tr>
                    <td>
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <?php echo $r['institute_name']; ?>
                    </td>
                    <td>
                        <?php echo $r['details']; ?>
                    </td>
                    <td>
                        <?php echo $r['address']; ?>
                    </td>
                    <td>
                        <?php echo $r['phone_no']; ?>
                    </td>
                    <td>
                        <?php if($r['status']=='5'){echo 'Pending';}elseif($r['status']=='true'){echo 'Approved';}elseif($r['status']=='hold'){echo 'Rejected';} ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y',strtotime($r['datetime'])); ?>
                    </td>
                    <td>
                    <button data-target='#comment' id="<?php echo 'comp'.$r['sno'];?>" value="<?php echo $r['sno']; ?>" data-toggle='modal' class="btn btn-primary" onclick="get_comments('comp','<?php echo $r['sno'];?>');">
                        <?php 
                        $q='select * from sales_comments where type="comp" and id="'.$r['sno'].'"';
                        $result=$db->query($q);
                        if($result->num_rows<1){
                            echo 'Add';
                        }
                        else{
                            echo 'View';
                        }
                        ?></button>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
                    </table>
                </div>
            </div>
            <!-- CHANGE 2 STAENDRT-->
        </div>
    </div>
    <div id="comment" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick='$("#comment").modal("hide")'>&times;</button>
      </div>
      <div class="modal-body">
      <div class="new-container">
        <div class="batch-card batch-card_2">
            <h1 class="__head">Comments </h1>
            <div id='msg_cont'>
            
            </div>
            <input type='hidden' id='modaltype' name='type'>
                <input type='hidden' id='modalid' name='id'>
                <input type="text" id="com_message" placeholder="Write here" class="form-field" style="margin-left: 20px;width: 93%;display: block;background-color: #fff;
                            background-clip: padding-box;
                            border: 1px solid #ced4da;
                            border-radius: .25rem;">
                <div class="btn_wraps">
                                <button class="btn btn-warning mt-1 mb-1" onclick="comment();" style="margin-left: 20px; width: 100px">Send</button>
                                <button class="btn btn-success mt-1 mb-1"  data-target="#call-now" data-toggle="modal" style="width: 100px">Call
                                    Now</button>
                                <button class="btn btn-danger mt-1 mb-1" data-target="#call-later" data-toggle="modal" style="width: 100px">Call
                                    Later</button>
                            </div>
        </div>
    </div>
      </div>
      
    </div>

  </div>
  <div id="call-later" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick='$("#call-later").modal("hide")'>&times;</button>
      </div>
      <div class="modal-body">
      <div class="new-container">
        <div class="batch-card batch-card_2">
            <h1 class="__head">Schedule Calling </h1>
            <div id='msg_cont'>
            
            </div>
            <input type='hidden' id='modaltype' name='type'>
                <input type='hidden' id='modalid' name='id'>
                <input type="text" id="datepicker" placeholder="Choose Date" class="form-field" style="margin-left: 20px;width: 93%;display: block;background-color: #fff;
                            background-clip: padding-box;
                            border: 1px solid #ced4da;
                            border-radius: .25rem;">
                <input type="text" id="call_later_remark" placeholder="Write here" class="form-field" style="margin-left: 20px;width: 93%;display: block;background-color: #fff;
                            background-clip: padding-box;
                            border: 1px solid #ced4da;
                            border-radius: .25rem;">
                <div class="btn_wraps">
                                <button class="btn btn-warning mt-1 mb-1" onclick="call_later();" style="margin-left: 20px; width: 100px">Schedule</button>
                                
                            </div>
        </div>
    </div>
      </div>
      
    </div>

  </div>
  
  </div>
    <div class="footer" style=" position: absolute;
    bottom: 0;
    width: 100%;
    height: 60px; 
    background:#000;">
        <div class="left-footer" style="padding: 15px; padding: 15px 0;
        font-size: 20px;
        color: #fff;
        float: none;
        text-align: center;">
            © Copyright – iCLUBS 2018
        </div>
    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
        <script>
        function get_comments(type,id){   
            $('#modalid').val(id);   
            $('#modaltype').val(type); 
    event.preventDefault();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: "comments.php?id="+id+"&type="+type+"&action=get",
        data:'',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data);
            $('#msg_cont').html(data);
            
        },
        error: function (e) {
            console.log(e);
        }
  

});
        }
        function comment(){
            var id=$('#modalid').val();   
            var type=$('#modaltype').val();  
            var msg=$('#com_message').val();      
    event.preventDefault();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: "comments.php?id="+id+"&type="+type+"&action=send&msg="+msg,
        data:'',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data);
            $('#msg_cont').append('<div class="container"><div class="arrow"><div class="outer"></div><div class="inner"></div></div><div class="message-body"><p>'+msg+'</p><p style="float: right;color: #696969;font-size: 14px;margin: 3px 0 !important">Tue, 12 Feb 2019, 12:07 pm</p></div></div>');
            $('#'+type+id).text('View');
            $('#com_message,#call_later_remark').val(''); 

            
        },
        error: function (e) {
            console.log(e);
        }
  

}); 
        }
        function call_later(){
            var id=$('#modalid').val();   
            var type=$('#modaltype').val();  
            var date=$j('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();  
            var remark= $('#call_later_remark').val();
            var call_later='Call Scheduled On: '+date+'<br>Comment: '+remark;   
    event.preventDefault();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: "comments.php?id="+id+"&type="+type+"&action=call_later&msg="+call_later,
        data:'',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data);
            $(function () {
            $('#msg_cont').append('<div class="container"><div class="arrow"><div class="outer"></div><div class="inner"></div></div><div class="message-body"><p>'+call_later+'</p><p style="float: right;color: #696969;font-size: 14px;margin: 3px 0 !important">Tue, 12 Feb 2019, 12:07 pm</p></div></div>');
            });
            $('#'+type+id).text('View');
            $('#com_message,#datepicker,#call_now_msg,#call_now_msg').val(''); 

            
        },
        error: function (e) {
            console.log(e);
        }
  

}); 
        }
        function call_now(){
            var id=$('#modalid').val();   
            var type=$('#modaltype').val();  
            var remark=$('#call_remark').val();
            var msg=$('#call_now_msg').val();
            var call_now='Call Remark: '+remark+'<br> Comment: '+msg;
    event.preventDefault();
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: "comments.php?id="+id+"&type="+type+"&action=call_now&msg="+call_now,
        data:'',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data);
            $(function () {
            $('#call-now').modal('toggle');
            $('#msg_cont').append('<div class="container"><div class="arrow"><div class="outer"></div><div class="inner"></div></div><div class="message-body"><p>'+call_now+'</p><p style="float: right;color: #696969;font-size: 14px;margin: 3px 0 !important">Tue, 12 Feb 2019, 12:07 pm</p></div></div>');
            });
            $('#'+type+id).text('View');
            $('#com_message,#datepicker,#call_now_msg,#call_now_msg').val(''); 

            
        },
        error: function (e) {
            console.log(e);
        }
  

}); 
        }
        </script>
        <div id="call-now" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick='$("#call-now").modal("hide")'>&times;</button>
      </div>
      <div class="modal-body">
      <div class="new-container">
        <div class="batch-card batch-card_2">
            <h1 class="__head">Remarks</h1>
            
            <input type='hidden' id='modaltype' name='type'>
                <input type='hidden' id='modalid' name='id'>
                <select id="call_remark" placeholder="Select Remark" class="form-field form-control" style="margin-left: 20px;width: 93%;display: block;background-color: #fff;
                            background-clip: padding-box;
                            border: 1px solid #ced4da;
                            border-radius: .25rem;margin-bottom:10px;">
                            <option value="Positive">Positive</option>
                            <option value="Neutral">Neutral</option>
                            <option value="Negative">Negative</option>
                            <option value="Could Not Connect">Switch Off/ Out of Coverage</option>
                            <option value="Call Busy">Busy</option>
                </select>
                <input type="text" id="call_now_msg" placeholder="Write here" class="form-field" style="margin-left: 20px;width: 93%;display: block;background-color: #fff;
                            background-clip: padding-box;
                            border: 1px solid #ced4da;
                            border-radius: .25rem;">
                            
                <div class="btn_wraps">
                                <button class="btn btn-warning mt-1 mb-1" onclick="call_now();" style="margin-left: 20px; width: 100px">Save</button>
                                
                            </div>
        </div>
    </div>
      </div>
      
    </div>

</body>

</html>