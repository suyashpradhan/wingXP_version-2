<?php
include_once "../assets/Users.php";
$database = new Database();
$conn = $database->getConnection();

       
                                    function store($role,$club_id,$conn){
                                        $get_club = "SELECT club_coordinator_id ,name,phone_no from inst_club_coordinator where
                                         club_coordinator_id in (SELECT club_coordinator_id from cc_club_assign where 
                                         club_id='$club_id' and inst_id='INST_258') and role = '$role' GROUP by name ";
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
                                        //$response[$i] =''.$clb[$i][1].'';                                        
                                        $i++;
                                    }
                                        return $response; mysqli_data_seek($response);
                                    }

    if(isset($_GET['action']) and $_GET['action']=='main'){
        $club_id = mysqli_real_escape_string($conn,$_GET['club']);
    $res[0]=store('coordinator',$club_id,$conn);
    $res[1]=store('president',$club_id,$conn);
    $res[2]=store('bearer',$club_id,$conn);
    echo json_encode($res);
    }
    else{
        $get_contact = "select phone_no from inst_club_coordinator where club_coordinator_id = '".$_GET['c']."' UNION
        select phone_no from inst_club_coordinator where club_coordinator_id = '".$_GET['p']."' UNION 
        select phone_no from inst_club_coordinator where club_coordinator_id = '".$_GET['b']."'";
        //echo $get_contact;
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