<?php 
include "../db_conn.php";

if(isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $result = updatePassword($password, $email, $conn);

    if($result) {
        $output -> result = "Success";
        echo json_encode($output);
        exit();
    } else {
        $output -> result = "Failed";
        echo json_encode($output);
        exit();
    }
}

function updatePassword($password, $email, $conn){
    $query = "UPDATE users_3 set password = '".md5($password)."' WHERE user_name = '".$email."'";
    $result = mysqli_query($conn, $query);

    return $result;
}
?>