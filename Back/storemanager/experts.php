<?php
include("home_header.php");
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous" />
    <div class="page-container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" id="school" data-toggle="tab" href="#tab-one" role="tab" aria-controls="tab-one"
                    aria-selected="false">Expert</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="pending" data-toggle="tab" href="#tab-two" role="tab" aria-controls="tab-two"
                    aria-selected="true">#</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="tab-one" role="tabpanel" aria-labelledby="school">
                <br>
                <div style="overflow-x:auto;overflow-y:auto">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">S No</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Address</th>
                                <th scope="col">Country</th>
                                <th scope="col">Pincode</th>
                                <th scope="col">Phone 1</th>
                                <th scope="col">Phone 2</th>
                                <th scope="col">Email</th>
                                <th scope="col">Expertise</th>
                                <th scope="col">Connect with Field</th>
                                <th scope="col">Attachments</th>
                                <th scope="col">Social Links</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <?php   $count=0;
   $t2=mysqli_query($db,"select * from expert");
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
                        <?php echo $r['fname']; ?>
                    </td>
                    <td>
                        <?php echo $r['lname']; ?>
                    </td>
                    <td>
                        <?php echo $r['dob']; ?>
                    </td>
                    <td>
                        <?php echo $r['gender']; ?>
                    </td>
                    <td>
                        <?php echo '<img src="../assets/expert/'.$r['photo'].'" style="width:100px;height:100px;">'; ?>
                    </td>
                    <td>
                        <?php echo $r['address']; ?>
                    </td>
                    <td>
                        <?php echo $r['country']; ?>
                    </td>
                    <td>
                        <?php echo $r['pincode']; ?>
                    </td>
                    <td>
                        <?php echo $r['phone1']; ?>
                    </td>
                    <td>
                        <?php echo $r['phone2']; ?>
                    </td>
                    <td>
                        <?php echo $r['email']; ?>
                    </td>
                    <td>
                        <?php echo $r['expertise']; ?>
                    </td>
                    <td>
                        <?php echo $r['connect_desc']; ?>
                    </td>
                    <td>
                        <?php 
                            echo '<a href="../assets/expert/files/'.$r['file1'].'">Link</a><br>';
                            echo '<a href="../assets/expert/files/'.$r['file2'].'">Link</a><br>';
                            echo '<a href="../assets/expert/files/'.$r['file3'].'">Link</a><br>';
                         ?>
                    </td>
                    <td>
                        <?php 
                        echo '<a href="'.$r['link1'].'">Link</a><br>';
                        echo '<a href="'.$r['link2'].'">Link</a><br>';
                        echo '<a href="'.$r['link3'].'">Link</a><br>';
                        echo '<a href="'.$r['link4'].'">Link</a><br>';
                        ?>
                    </td>

                    <td>
                        <?php echo date('Y-m-d',strtotime($r['datetime'])); ?>
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
                                <th scope="col">1</th>
                                <th scope="col">2</th>
                                <th scope="col">3</th>
                                <th scope="col">4</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.js " integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 "
        crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy "
        crossorigin="anonymous "></script>
</body>

</html>