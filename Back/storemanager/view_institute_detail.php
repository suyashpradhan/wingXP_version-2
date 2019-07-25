<?php
    include("home_header.php");
function get_data_xl($id){
    $dir = "../assets/dataprocess/data/";
    $pattern="/".$id."/";
    chdir($dir);
    array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
    foreach($files as $filename)
    {
        if (preg_match("/".$id."/", $filename, $match)){
            $file_list[]=$filename;
        }    
    }
    echo $file_list[0];
}
   if(isset($_POST['inst_name'])){$inst_name=$_POST['inst_name'];}else{$inst_name='';}
   if(isset($_POST['range'])){$start='0';$end=$_POST['range'];$range=$_POST['range'];}else{$start='0';$end='20';$range='20';}
   if(isset($_POST['prev']) and $_POST['range']!='1000000' and $_POST['prev']>=0 and $_POST['prev']>=0){ $start=$_POST['prev']-$_POST['range'];$end=$start+$_POST['range'];}
   if(isset($_POST['next']) and $_POST['range']!='1000000' and $_POST['next']>=0){$start=$_POST['next'];$end=$start+$_POST['range'];}
   if(isset($_POST['page'])){$start=$_POST['page']*$_POST['range'];$end=$start+$_POST['range'];}else{}
    
   if($start<0 or $end<0){
       $start='0';$end='20';
   }
   if(isset($_POST['sortby']) and $_POST['sortby']!=''){ $sortby='order by '.$_POST['sortby'];}else{$sortby='';}
?>
 <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
        
 <div class="page-container">
 <div class="alert alert-success alert-dismissible mt-2" id="stage-info-alert" style="display:none;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <br>
</div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="school" data-toggle="tab" href="#tab-one" role="tab" aria-controls="tab-one"
                    aria-selected="true">Schools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pending" data-toggle="tab" href="#tab-two" role="tab" aria-controls="tab-two"
                    aria-selected="false">Pending Schools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="approved" data-toggle="tab" href="#tab-three" role="tab" aria-controls="tab-three"
                    aria-selected="false">Approved Schools</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="rejected" data-toggle="tab" href="#tab-four" role="tab" aria-controls="tab-four"
                    aria-selected="false">Rejected Schools</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="school">
                <!--ALL-->
                <form class="form-inline mt-3" action="./view_institute_detail.php" method="post">
                    <div class="container form-group mb-2">
                        <input class=" form-control" type="text" value="<?php if(isset($_POST['inst_name'])){echo $inst_name;}?>" name="inst_name"  placeholder="Search for names.." title="Type in a name">
                        <select class="form-control  ml-1" name="range">
                        <option value="20" <?php if(isset($_POST['range']) and $_POST['range']=='1000000'){echo 'selected';} ?>>20</option>
                        <option value="100" <?php if(isset($_POST['range']) and $_POST['range']=='100'){echo 'selected';} ?>>100</option>
                        <option value="500" <?php if(isset($_POST['range']) and $_POST['range']=='500'){echo 'selected';} ?>>500</option>
                        <option value="1000" <?php if(isset($_POST['range']) and $_POST['range']=='1000'){echo 'selected';} ?>>1000</option>
                        <option value="100000" <?php if(isset($_POST['range']) and $_POST['range']=='100000'){echo 'selected';} ?>>All Records</option>
                        </select>  
                        <select class="form-control  ml-1" name="sortby">
                        <option value="">Sort By</option>
                        <option value="institute_name" <?php if(isset($_POST['sortby']) and $_POST['sortby']=='institute_name'){echo 'selected';} ?>>Name</option>
                        <option value="datetime asc" <?php if(isset($_POST['sortby']) and $_POST['sortby']=='datetime asc'){echo 'selected';} ?>>Register Time ↑ </option>
                        <option value="datetime desc" <?php if(isset($_POST['sortby']) and $_POST['sortby']=='datetime desc'){echo 'selected';} ?>>Register Time ↓  </option>
                        <option value="status" <?php if(isset($_POST['sortby']) and $_POST['sortby']=='status'){echo 'selected';} ?>>Status</option>
                        </select>                           
                        <button type="submit" class="btn btn-default ml-1 ">Search</button>
                    </div>
                    <div class="container ">
                    <ul class="pagination">
                        <li class="page-item"><button  value="<?php if(isset($_POST['range']) and $_POST['range']!='20'){echo $start;}else{echo '0';}?>" name="prev" class="page-link" >Previous</button></li>
                        <li class="page-item"><button  value="<?php if(isset($_POST['range']) and $_POST['range']!='20'){echo $end;}else{echo '0';}?>" name="next" class="page-link" >Next</button></li>
                        </ul> 
                    </div>                   
               </form>
            <div style="width:100%;">
        <table class="main-table admin-tables" id="page-table" >
            <thead>
                <tr>
                    <th rowspan="2" >Sno</th>
                    <th>School Id</th>             
                    <th>Address</th>
                    <th>Email Id </th>                  
                    <th>Username</th>
                    <th>Status</th>                 
                </tr>
                <tr>
                <th>School Name</th>
                <th>Details</th>
                <th>Phone Number</th>
                <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php   $count=0;
   $t1=mysqli_query($db,"select * from institution where institute_name LIKE '%".$inst_name."%' ".$sortby." LIMIT ".$start.",".$range."");
   $rows=mysqli_num_rows($t1);
   while($r=mysqli_fetch_array($t1))
   {  $count++;
   ?>
            <tbody id="<?php echo $count;?>">
                <tr>
                    <td rowspan="2" >
                        <?php echo $count; ?>
                    </td>                    
                    <td>
                        <?php echo $r['institute_id']; ?>
                    </td>
                    <td>
                        <?php echo $r['address']; ?>
                    </td>
                    <td>
                        <?php echo $r['email_id']; ?>
                    </td>
                    <td>
                        <?php echo $r['username']; ?>
                    </td>
                    <td>
                        <?php echo $r['status']; ?>
                    </td>                    
                </tr>
                <tr>
                                       
                    <td>
                        <?php echo $r['institute_name']; ?>
                    </td>
                    <td>
                        <?php echo $r['details']; ?>
                    </td>                    
                    <td>
                        <?php echo $r['phone_no']; ?>
                    </td>
                    <td colspan="2"><button class="btn btn-default" data-target="#detail" data-toggle="modal" onclick="action('all_detail',<?php echo '\''.$r[1].'\'';?>)">More Detail</button>
                    <a class="btn btn-primary m-1" href="add_club.php?id=<?php echo $r['institute_id']; ?>" class="view_faculty_detail"> Add Club</a>
                    <a class="btn btn-primary m-1" href="add_course.php?id=<?php echo $r['institute_id']; ?>" class="view_faculty_detail"> Add Course</a>
                    <button class="btn btn-default" data-target="#log" data-toggle="modal" onclick="action('login_detail',<?php echo '\''.$r[1].'\'';?>)">Login Details</button>
                    <a class="btn btn-success m-1"  href="update_school_detail.php?id=<?php echo $r['institute_id']; ?>" class="view_faculty_detail"> Update Detail</a>
                    <button class="btn btn-danger m-1" onclick="action('remove_students',<?php echo '\''.$r[1].'\'';?>)">Delete Students</button>
                    <button class="stage_action btn btn-danger m-1" data-sno="<?php echo $r['sno']; ?>" data-id="<?php echo $r['institute_id']; ?>" data-name="<?php echo $r['institute_name']; ?>" data-target="#stage-action-modal" data-toggle="modal">Stage</button>
                    <a class="btn btn-warning m-1"  href="../../assets/dataprocess/data/<?php get_data_xl($r['institute_id']);?>" class="view_faculty_detail" download> Download Student Data</a>
                    </td>                    
                </tr>
            </tbody>
            <?php } ?>
        </table>
        <form class="form-inline mt-3" action="./view_institute_detail.php" method="post">
        <?php 
        if(isset($_POST['range'])){$range_pagi=$_POST['range'];}else{$range_pagi='20';}
        $q='select * from institution where 1';
        $res_q=$db->query($q);
        $res_num=$res_q->num_rows;
        echo '<ul class="pagination">';
        for($i=0;$i<(int)$res_num/$range;$i++){
            echo '<li class="page-item"><button name="page" value="'.$i.'" class="page-link">'.($i+1).'</button></li>';
        }
        echo '</ul><input type="hidden" name="range" value='.$range_pagi.'>';
    ?>
     </form>
<!--here-->
      </div>
                <!--ALL-->
            </div>
            <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="pending"><div style="overflow-x:auto;overflow-y:auto">
        <table id="page-table" class="main-table admin-tables">
        <thead>
                <tr>
                    <th rowspan="2" >Sno</th>
                    <th>School Id</th>             
                    <th>Address</th>
                    <th>Email Id </th>                   
                    <th>Username</th>
                    <th>Status</th>                 
                </tr>
                <tr>
                <th>School Name</th>
                <th>Details</th>
                <th>Phone Number</th>
                <th colspan="2">Action</th>
                </tr>
            </thead>            
            <?php   $count=0;
   $t2=mysqli_query($db,"select * from institution");
   $rows=mysqli_num_rows($t2);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
            <?php if($r['status']=='5'){ echo'
                <tr>
                    <td rowspan="2"  >
                      '.$count.'
                    </td>
                    <td>
                         '.$r["institute_id"].'
                    </td>
                    <td>
                        '.$r['address'] .'
                    </td>
                    <td>
                       '.$r['email_id'].'
                    </td>
                    <td>
                        '.$r['username'].'
                    </td>
                    <td>
                        '.$r['status'].'
                    </td>
                </tr>  
                <tr>                  
                    <td>
                        '.$r['institute_name'].'
                    </td>                    
                    <td>
                        '.$r['details'].'
                    </td>                    
                    <td>
                        '.$r['phone_no'].'
                    </td>
                    <td colspan="2">
                        <button class="btn btn-success" style="margin:5px;" onclick="action(\'pending\',\''.$r[1].'\')">Approve</button><br><button class="btn btn-danger" onclick="action(\'block\',\''.$r[1].'\')">Reject</button>
                    </td>   
                </tr>'; ?>
            <?php } else{}?>
            </tbody>
            <?php } ?>
        </table>
      </div> </div>
            <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="approved">
            <div style="overflow-x:auto;overflow-y:auto">
        <table id="page-table" class="main-table admin-tables"> 
        <thead>
                <tr>
                    <th rowspan="2" >Sno</th>
                    <th>School Id</th>             
                    <th>Address</th>
                    <th>Email Id </th>                   
                    <th>Username</th>
                    <th>Status</th>                 
                </tr>
                <tr>
                <th>School Name</th>
                <th>Details</th>
                <th>Phone Number</th>
                <th colspan="2">Action</th>
                </tr>
            </thead>	            
            <?php   $count=0;
   mysqli_data_seek($t2,$r);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
            <?php if($r['status']=='true'){ echo'
                <tr>
                <td rowspan="2" >
                  '.$count.'
                </td>
                <td>
                     '.$r["institute_id"].'
                </td>
                <td>
                    '.$r['address'] .'
                </td>
                <td>
                   '.$r['email_id'].'
                </td>
                <td>
                    '.$r['username'].'
                </td>
                <td>
                    '.$r['status'].'
                </td>
            </tr>  
            <tr>                  
                <td>
                    '.$r['institute_name'].'
                </td>                    
                <td>
                    '.$r['details'].'
                </td>                    
                <td>
                    '.$r['phone_no'].'
                </td>
                <td colspan="2">
                    <button class="btn btn-danger" style="margin:5px;" onclick="action(\'approved\',\''.$r[1].'\')">Reject</button>
    <input type="text" class="form-control" placeholder="Remark/Reason" id="rej_'.$r[1].'">
                    </td>   
                    </tr>'; ?>
            <?php } else{}?>
            </tbody>
            <?php } ?>
        </table>
      </div> 
            </div>
            <div class="tab-pane fade" id="tab-four" role="tabpanel" aria-labelledby="rejected">
            <div style="overflow-x:auto;overflow-y:auto">
        <table id="page-table" class="main-table admin-tables">
        <thead>
                <tr>
                    <th rowspan="2" >Sno</th>
                    <th>School Id</th>             
                    <th>Address</th>
                    <th>Email Id </th>                   
                    <th>Username</th>
                    <th>Status</th>                 
                </tr>
                <tr>
                <th>School Name</th>
                <th>Details</th>
                <th>Phone Number</th>
                <th colspan="2">Action</th>
                </tr>
            </thead>	            
            <?php   $count=0;
   mysqli_data_seek($t2,$r);
   while($r=mysqli_fetch_array($t2))
   {  $count++;
   ?>
            <tbody>
            <?php if($r['status']=='false'){ echo'
                <tr>
                <td rowspan="2" >
                  '.$count.'
                </td>
                <td>
                     '.$r["institute_id"].'
                </td>
                <td>
                    '.$r['address'] .'
                </td>
                <td>
                   '.$r['email_id'].'
                </td>
                <td>
                    '.$r['username'].'
                </td>
                <td>
                    '.$r['status'].'
                </td>
            </tr>  
            <tr>                  
                <td>
                    '.$r['institute_name'].'
                </td>                    
                <td>
                    '.$r['details'].'
                </td>                    
                <td>
                    '.$r['phone_no'].'
                </td>
                <td colspan="2">
                    <button class="btn btn-primary" onclick="action(\'rejected\',\''.$r[1].'\')">Mark for Review</button>
                    </td>   
                    </tr>'; ?>
            <?php } else{}?>
            </tbody>
            <?php } ?>
           
        </table>
      </div> 
            </div>
    <div class="page-container">     
        <a href="index.php" class="home_link">Home</a>
    </div>
    <div id="log" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="new-container">
                            <div class="batch-card batch-card_2">
                                <h1 class="__head">Login Details </h1>
                                <div id='msg_cont'>
                                
                                </div>            
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="stage-action-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close mod_close_jq" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="new-container">
                            <div class="batch-card batch-card_2">
                                <h1 class="__head">Stage Rollback for <button class="btn btn-danger" id="stage_inst_name"></button><button class="btn btn-warning m-1" id="stage_inst_id"></button></h1>
                                <ul class="list-group">
                                <li class="list-group-item"><button class="btn btn-success" disabled>Stage 0 (Signup)</button></li>
                                <li class="list-group-item"><button class="btn btn-default stage_no" id="s1_button" value="" onclick="action('stage-1-rollback',this.value)">Stage 1</button></li>
                                <li class="list-group-item"><button class="btn btn-default stage_no" id="s2_button" value="" onclick="action('stage-2-rollback',this.value)">Stage 2</button></li>
                                <li class="list-group-item"><button class="btn btn-default stage_no" id="s3_button" value="" onclick="action('stage-3-rollback',this.value)">Stage 3</button></li>
                                <li class="list-group-item"><button class="btn btn-default stage_no" id="s4_button" value="" onclick="action('stage-4-rollback',this.value)">Stage 4</button></li>
                                <li class="list-group-item"><button class="btn btn-default stage_no" id="s5_button" value="" onclick="action('stage-5-rollback',this.value)">Stage 5</button></li>
                                </ul>  
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="detail" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="new-container">
                            <div class="batch-card batch-card_2">
                                <h1 class="__head">Login Details </h1>
                                <div id='all_detail'>
                                
                                </div>            
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--copyright starts-->
<?php
    include("admin_footer.php");
?>
<!--copyright ends--> 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script>
 var inst_id="";
 $(document).on("click", ".stage_action", function () {     
     var sno = $(this).data('sno');
     action('get_stage',sno);
     inst_id = $(this).data('id');
     var inst_name = $(this).data('name');
     $(".modal-body .stage_no").val( sno );
     $(".modal-body #stage_inst_id").html( inst_id );
     $(".modal-body #stage_inst_name").html( inst_name );
});
   function action(a,id,arg1){
       
       if(a=="stage-1-rollback" || a=="stage-2-rollback" || a=="stage-3-rollback" || a=="stage-4-rollback" || a=="stage-5-rollback" ){
           var r = confirm("You are about to Rollback Stage which will also Reset Data from further stages");
           arg1=inst_id;
           if (r == true){}else{return;}
       }
    var remark= $('#rej_'+id).val();
    
    $.ajax({
        type: "GET",
        enctype: 'multipart/form-data',
        url: "action.php?id="+id+"&action="+a+"&remark="+remark+"&arg1="+arg1,
        data:'',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            console.log(data);
            if(data==1){alert('Updated');location.reload();}
            if(data==0){alert('Error');}
            else if (a=='login_detail'){
                $('#msg_cont').html(data);
            }
            else if (a=='all_detail'){
                $('#all_detail').html(data);
            }
            else if (a=='get_stage'){
                if(data.indexOf("s1")!=-1){
                $('#s1_button').addClass("btn-primary");
                }
                if(data.indexOf("s2")!=-1){
                $('#s2_button').addClass("btn-primary");
                }
                if(data.indexOf("s3")!=-1){
                $('#s3_button').addClass("btn-primary");
                }
                if(data.indexOf("s4")!=-1){
                $('#s4_button').addClass("btn-primary");
                }
                if(data.indexOf("s5")!=-1){
                $('#s5_button').addClass("btn-primary");
                }
            }
            else if (a=='stage-1-rollback' || a=='stage-2-rollback' || a=='stage-3-rollback' || a=='stage-4-rollback' || a=='stage-5-rollback' ){
                $('.mod_close_jq').click();
                $('#stage-info-alert').append(data);                
                $('#stage-info-alert').show();
                setTimeout(function() {window.scrollTo({ top: 0, behavior: 'smooth' });},100);

            }
        },
        error: function (e) {
            console.log(e);
        }
  

});
    
}
function get_stage(){

}
function search_school() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search-school");
  filter = input.value.toUpperCase();
  table = document.getElementById("page-table");
  tr = table.getElementsByTagName("tr");
  tbody = document.getElementById("page-table").tBodies;
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6];
    alert(td.innerText);
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > 0) {
        document.getElementById(i).style.display="";
      } else {        
        document.getElementById(i).style.display="none";
      }
    }
  }

}
   </script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
</body>
</html>