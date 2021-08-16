<?php 
include "../db_conn.php";

if(isset($_POST['otp'])) {
    function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

    $otp = validate($_POST['otp']);

    $details = getDetails($otp, $conn);

    if(sizeof($details) != 0) {
        $email = $details[0];
        $used = $details[1];

        if($used == "0") {
            if(changeUsed($otp, $conn)) {
                $output -> email = $email;
                echo json_encode($output);
            }
        }
    }
}

function getDetails($otp, $conn){
    $query = "SELECT email, used from password_recovery WHERE otp = ".$otp;
    $result = mysqli_query($conn, $query);
    $res = array();

    if ($result) {
        $row = mysqli_fetch_row($result);
        $res[0] = $row[0];
        $res[1] = $row[1];
        return $res;
    }

    return $res;
}

function changeUsed($otp, $conn){
    $query = "UPDATE password_recovery set used = 1 WHERE otp = ".$otp;
    $result = mysqli_query($conn, $query);

    return $result;
}
?>