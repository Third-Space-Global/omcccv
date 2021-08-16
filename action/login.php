<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: ../login.php?error=Username is required");
	    exit();
	}else if(empty($pass)){
        header("Location: ../login.php?error=Password is required");
	    exit();
	}else{
		$password = md5($pass);
		$sql = "SELECT * FROM users_3 WHERE user_name='$uname' AND password='$password'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['password'] === $password) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
				$_SESSION['level'] = $row['level'];

				if($row['level'] == 1){
					header("Location: ../index.php");
				} else if ($row['level'] == 2) {
					header("Location: ../index.php");
				}
				
		        exit();
            }else{
				header("Location: ../login.php?error=Incorect Username or password");
		        exit();
			}
		}else{
			header("Location: ../login.php?error=Incorrect Username or password");
	        exit();
		}
	}
	
}else{
	header("Location: ../login.php");
	exit();
}