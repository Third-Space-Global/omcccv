<?php
session_start();
//$supervisor = $_SESSION['name'];

$_where = "1";

if(isset($_GET['name'])) {
    if($_GET['name'] !== ""){
        //$_where = "user_id = 1864";
        $_where .= ' AND user_id = "'.$_GET['name'].'"'; 
    }
} 

// DB table to use
$table = 'permenant_availability';
 
$primaryKey = 'user_id';

$mon = array(
    array( 'db' => 'supervisor_name', 'dt' => 0 ),
    array( 'db' => 'name', 'dt' => 1 ),
    array( 'db' => 'action', 'dt' => 2 ),
    array( 'db' => 'm1', 'dt' => 3 ),
    array( 'db' => 'm2', 'dt' => 4 ),
    array( 'db' => 'm3', 'dt' => 5 ),
    array( 'db' => 'm4', 'dt' => 6 ),
    array( 'db' => 'm5', 'dt' => 7 ),
    array( 'db' => 'm6', 'dt' => 8 ),
    array( 'db' => 'm7', 'dt' => 9),
    array( 'db' => 'user_id', 'dt' => 10 ),
    array( 'db' => 'action', 'dt' => 11 ),
);

$tue = array(
    array( 'db' => 'supervisor_name', 'dt' => 0 ),
    array( 'db' => 'name', 'dt' => 1 ),
    array( 'db' => 'action', 'dt' => 2 ),
    array( 'db' => 't1', 'dt' => 3 ),
    array( 'db' => 't2', 'dt' => 4 ),
    array( 'db' => 't3', 'dt' => 5 ),
    array( 'db' => 't4', 'dt' => 6 ),
    array( 'db' => 't5', 'dt' => 7 ),
    array( 'db' => 't6', 'dt' => 8 ),
    array( 'db' => 't7', 'dt' => 9 ),
    array( 'db' => 'user_id', 'dt' => 10 ),
    array( 'db' => 'action', 'dt' => 11 ),
);

$wed = array(
    array( 'db' => 'supervisor_name', 'dt' => 0 ),
    array( 'db' => 'name', 'dt' => 1 ), 
    array( 'db' => 'action', 'dt' => 2 ),
    array( 'db' => 'w1', 'dt' => 3 ),
    array( 'db' => 'w2', 'dt' => 4 ),
    array( 'db' => 'w3', 'dt' => 5 ),
    array( 'db' => 'w4', 'dt' => 6 ),
    array( 'db' => 'w5', 'dt' => 7 ),
    array( 'db' => 'w6', 'dt' => 8 ),
    array( 'db' => 'w7', 'dt' => 9 ),
    array( 'db' => 'user_id', 'dt' => 10 ),
    array( 'db' => 'action', 'dt' => 11 ),
);

$thu = array(
    array( 'db' => 'supervisor_name', 'dt' => 0 ),
    array( 'db' => 'name', 'dt' => 1 ),
    array( 'db' => 'action', 'dt' => 2 ),
    array( 'db' => 'th1', 'dt' => 3 ),
    array( 'db' => 'th2', 'dt' => 4 ),
    array( 'db' => 'th3', 'dt' => 5 ),
    array( 'db' => 'th4', 'dt' => 6 ),
    array( 'db' => 'th5', 'dt' => 7 ),
    array( 'db' => 'th6', 'dt' => 8 ),
    array( 'db' => 'th7', 'dt' => 9 ),
    array( 'db' => 'user_id', 'dt' => 10 ),
    array( 'db' => 'action', 'dt' => 11 ),
);

$fri = array(
    array( 'db' => 'supervisor_name', 'dt' => 0 ),
    array( 'db' => 'name', 'dt' => 1 ),
    array( 'db' => 'action', 'dt' => 2 ),
    array( 'db' => 'f1', 'dt' => 3 ),
    array( 'db' => 'f2', 'dt' => 4 ),
    array( 'db' => 'f3', 'dt' => 5 ),
    array( 'db' => 'f4', 'dt' => 6 ),
    array( 'db' => 'f5', 'dt' => 7 ),
    array( 'db' => 'f6', 'dt' => 8 ),
    array( 'db' => 'f7', 'dt' => 9),
    array( 'db' => 'user_id', 'dt' => 10 ),
    array( 'db' => 'action', 'dt' => 11 ),
);

$columns = '';

if(isset($_GET['day'])) {
    if ($_GET['day'] === "monday") {
        $columns = $mon;
    } else if ($_GET['day'] === "tuesday") {
        $columns = $tue;
    } else if ($_GET['day'] === "wednesday") {
        $columns = $wed;
    } else if ($_GET['day'] === "thursday") {
        $columns = $thu;
    } else if ($_GET['day'] === "friday") {
        $columns = $fri;
    } 
}

$whereAll = $_where;

// SQL server connection information
$sql_details = array(
    'user' => 'TK1e63o82L',
    'pass' => 'sAJ9k6SVba',
    'db'   => 'TK1e63o82L',
    'host' => 'remotemysql.com'
);
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $whereResult = null, $whereAll)
);
?>