<?php
    include('database_connection.php');

    session_start();

    $id = $_SESSION['id']; 
    $week = json_decode($_POST["week"], true);

    $start = $week['start'];
    $end = $week['end'];

    $opArr = compare($connect, $start, $end, $id);//getFromTemporary($connect, $start, $end, $id);

    $output = new \stdClass();
    $output -> availabilities = $opArr;
    
    header('Content-Type: application/json');
    echo json_encode($output);

    function compare($connect, $start, $end, $id){
        $perm = getFromPremanant($connect, $id);
        $temp = getFromTemporary($connect, $start, $end, $id);

        $diff = strcasecmp(json_encode($temp), json_encode($perm));

        if(sizeof($temp) === 0) {
            return $perm;
        } else {
            return $temp;
        } 
    }

    function getFromPremanant($connect, $id){
        $query = "SELECT * FROM permenant_availability WHERE user_id = $id";

        $stmt = $connect->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $opArr = array();

        foreach ($result as $row) {
            $slot1 = array();
            $slot1[] = $row['m1'];
            $slot1[] = $row['t1'];
            $slot1[] = $row['w1'];
            $slot1[] = $row['th1'];
            $slot1[] = $row['f1'];
    
            $slot2 = array();
            $slot2[] = $row['m2'];
            $slot2[] = $row['t2'];
            $slot2[] = $row['w2'];
            $slot2[] = $row['th2'];
            $slot2[] = $row['f2'];
    
            $slot3 = array();
            $slot3[] = $row['m3'];
            $slot3[] = $row['t3'];
            $slot3[] = $row['w3'];
            $slot3[] = $row['th3'];
            $slot3[] = $row['f3'];
    
            $slot4 = array();
            $slot4[] = $row['m4'];
            $slot4[] = $row['t4'];
            $slot4[] = $row['w4'];
            $slot4[] = $row['th4'];
            $slot4[] = $row['f4'];
    
            $slot5 = array();
            $slot5[] = $row['m5'];
            $slot5[] = $row['t5'];
            $slot5[] = $row['w5'];
            $slot5[] = $row['th5'];
            $slot5[] = $row['f5'];
    
            $slot6 = array();
            $slot6[] = $row['m6'];
            $slot6[] = $row['t6'];
            $slot6[] = $row['w6'];
            $slot6[] = $row['th6'];
            $slot6[] = $row['f6'];
    
            $slot7 = array();
            $slot7[] = $row['m7'];
            $slot7[] = $row['t7'];
            $slot7[] = $row['w7'];
            $slot7[] = $row['th7'];
            $slot7[] = $row['f7'];
    
            $opArr = array(
                "slot1" => $slot1,
                "slot2" => $slot2,
                "slot3" => $slot3,
                "slot4" => $slot4,
                "slot5" => $slot5,
                "slot6" => $slot6,
                "slot7" => $slot7,
            );
        }

        return $opArr;
    }

    function getFromTemporary($connect, $start, $end, $id){
        $query = "SELECT * FROM temporary_availability WHERE NOT action = 2 AND user_id = $id AND date BETWEEN '$start' AND '$end' ORDER BY id DESC LIMIT 1";

        $stmt = $connect->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $opArr = array();

        foreach ($result as $row) {
            $slot1 = array();
            $slot1[] = $row['m1'];
            $slot1[] = $row['t1'];
            $slot1[] = $row['w1'];
            $slot1[] = $row['th1'];
            $slot1[] = $row['f1'];
    
            $slot2 = array();
            $slot2[] = $row['m2'];
            $slot2[] = $row['t2'];
            $slot2[] = $row['w2'];
            $slot2[] = $row['th2'];
            $slot2[] = $row['f2'];
    
            $slot3 = array();
            $slot3[] = $row['m3'];
            $slot3[] = $row['t3'];
            $slot3[] = $row['w3'];
            $slot3[] = $row['th3'];
            $slot3[] = $row['f3'];
    
            $slot4 = array();
            $slot4[] = $row['m4'];
            $slot4[] = $row['t4'];
            $slot4[] = $row['w4'];
            $slot4[] = $row['th4'];
            $slot4[] = $row['f4'];
    
            $slot5 = array();
            $slot5[] = $row['m5'];
            $slot5[] = $row['t5'];
            $slot5[] = $row['w5'];
            $slot5[] = $row['th5'];
            $slot5[] = $row['f5'];
    
            $slot6 = array();
            $slot6[] = $row['m6'];
            $slot6[] = $row['t6'];
            $slot6[] = $row['w6'];
            $slot6[] = $row['th6'];
            $slot6[] = $row['f6'];
    
            $slot7 = array();
            $slot7[] = $row['m7'];
            $slot7[] = $row['t7'];
            $slot7[] = $row['w7'];
            $slot7[] = $row['th7'];
            $slot7[] = $row['f7'];
    
            $opArr = array(
                "slot1" => $slot1,
                "slot2" => $slot2,
                "slot3" => $slot3,
                "slot4" => $slot4,
                "slot5" => $slot5,
                "slot6" => $slot6,
                "slot7" => $slot7,
            );
        }
        return $opArr;
    }
?>