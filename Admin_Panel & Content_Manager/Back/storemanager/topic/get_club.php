<?php
include_once "../../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();
$cat=$_GET['club_category_id'];
if(isset($_GET['club_category_id'])){
    $id = $_GET['club_category_id'];
    $get_club = "SELECT club_id, club_name from clubs where club_category_id= '$id'";
    $result = $conn->query($get_club);
     $i=0;
                                    while($clb[$i] = mysqli_fetch_row($result))
                                    { $j=$flag=0;      
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($flag==0){echo '<option value="'.$club[$i][$j].'">';
                                                $flag++;}
                                            else{echo $club[$i][$j].'</option>';$flag--;}                
                                            $j++;
                                        }
                                        $i++;     
    }
}