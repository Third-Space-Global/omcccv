<?php

$sname= "remotemysql.com";
$unmae= "TK1e63o82L";
$password = "sAJ9k6SVba";

$db_name = "TK1e63o82L";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}