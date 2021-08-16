<?php 
include "../db_conn.php";

if(isset($_POST['email'])) {

    function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

    $email = validate($_POST['email']);
    
    $newOTP = generateOTP($conn); //generate OTP

    $result = store($email, $newOTP, $conn); //store it in the DB

    if($result) {
        sendEmail($email, $newOTP); //if new OTP is stored, notify user
    }

    $output -> res = "success";

    echo json_encode($output);
}

function generateOTP($conn){
    while(true) {
        $otp = mt_rand(100000,999999);
        $query = "SELECT COUNT(otp) from password_recovery WHERE otp = ".$otp;
        
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_row($result);
            if($row[0] == "0") {
                return $otp;
            } 
        }
    }
}

function store($email, $otp, $conn){
    $query = "INSERT INTO password_recovery(email, otp, used) VALUES ('$email', $otp, 0)";
    $result = mysqli_query($conn, $query);

    return $result;
}

function sendEmail($email, $otp){
    // TODO: Implement email functionality.
}
?>