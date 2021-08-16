<?php 
include('database_connection.php');
include('db_conn.php');
session_start();

if(isset($_POST["items"])){
    $items = json_decode($_POST["items"], true);
    $id = $_SESSION["id"];

    $details = getDetails($id, $conn);
    update($items, $id, $connect, $details);
}

function update($dataArray, $id, $connect, $details){
    $values = "";
    $itr = 0;
    $last = count($dataArray);

    $date = date("Y-m-d");
    $name = $details[0];
    $supervisor = $details[1];
    $supervisor_id = $details[2];

    $query = "INSERT INTO temporary_availability (
        date, user_id,action,name,supervisor_name,supervisor_id,
        m1, t1, w1, th1, f1, 
        m2, t2, w2, th2, f2, 
        m3, t3, w3, th3, f3,
        m4, t4, w4, th4, f4,
        m5, t5, w5, th5, f5, 
        m6, t6, w6, th6, f6, 
        m7, t7, w7, th7, f7) VALUES ('$date', $id, 0, '$name', '$supervisor', $supervisor_id, "; 
        
    foreach($dataArray as $item) {
        $itr++;
        if ($itr !== $last) {
            $col = $item['id'];
            $val = -1;
            if($item['value'] === "yes"){
                $val = 1;
            } else if ($item['value'] === "no") {
                $val = 0;
            } else if ($item['value'] === "leave") {
                $val = 3;
            }
            $value = "$val, "; 
            $values .= $value;
        } else {
            $col = $item['id'];
            $val = -1;
            if($item['value'] === "yes"){
                $val = 1;
            } else if ($item['value'] === "no") {
                $val = 0;
            } else if ($item['value'] === "leave") {
                $val = 3;
            }
            $value = "$val )"; 
            $values .= $value;
        }  
    }

    $query .= $values;

    $statement = $connect -> prepare($query);

    $statement -> execute();  
}

function getDetails($userId, $conn){
    $query = "SELECT short_name, supervisor, supervisor_id from ls_directory WHERE hr_tsp_id = ".$userId;
    $result = mysqli_query($conn, $query);
    $res = array();

    if ($result) {
        $row = mysqli_fetch_row($result);
        $res[0] = $row[0];
        $res[1] = $row[1];
        $res[2] = $row[2];
        return $res;
    }

    return $res;
}

?>