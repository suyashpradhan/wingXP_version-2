<?php
session_start();
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();

       
                                    function store($role,$conn,$inst_id){
                                        $get_club = "SELECT club_coordinator_id ,name,phone_number from inst_club_coordinator where institute_id='$inst_id' and role = '$role' GROUP by name ";
                                        $query = $conn->query($get_club); 
                                        $i=0;   $response = array();                                     
                                    while($clb[$i] = mysqli_fetch_row($query))
                                    { $j=$flag=0;  
                                        foreach($clb[$i] as $c ){                                            
                                            $club[$i][$j]=$c;
                                            if($j==0){$response[0][$i]='<option value="'.$club[$i][$j].'">';
                                                $flag++;}
                                            else if($j==1){$response[0][$i].= $club[$i][$j].'</option>';$flag--;}                
                                            $j++;
                                        }                                    
                                        $i++;
                                    }
                                        return $response; mysqli_data_seek($response);
                                    }

    if(isset($_GET['action']) and $_GET['action']=='main'){
    $res[0]=store('president',$conn,$_SESSION['Userid']);
    $res[1]=store('bearer',$conn,$_SESSION['Userid']);
    echo json_encode($res);
    }
    else{
        $get_contact = "select phone_number from inst_club_coordinator where club_coordinator_id = '".$_GET['p']."' UNION 
        select phone_number from inst_club_coordinator where club_coordinator_id = '".$_GET['b']."'";
        $query = $conn->query($get_contact);
        $k=0;
        $result=array();
        while($temp = mysqli_fetch_row($query))
        {
            $result[$k]=$temp;
            $k++;
        }
        echo json_encode($result);
    }