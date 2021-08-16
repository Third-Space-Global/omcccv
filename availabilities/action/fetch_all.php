<?php
    include('database_connection.php');
    $query = "";

    if(isset($_POST['tutor'])) {
        $id = $_POST['tutor'];

        $query = "SELECT * FROM permenant_availability WHERE user_id = $id";
    }
    
    $stmt = $connect->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $opArr = array();

    foreach ($result as $row) {
        $mon = array();
        $mon[] = $row['m1'];
        $mon[] = $row['m2'];
        $mon[] = $row['m3'];
        $mon[] = $row['m4'];
        $mon[] = $row['m5'];
        $mon[] = $row['m6'];
        $mon[] = $row['m7'];

        $tue = array();
        $tue[] = $row['t1'];
        $tue[] = $row['t2'];
        $tue[] = $row['t3'];
        $tue[] = $row['t4'];
        $tue[] = $row['t5'];
        $tue[] = $row['t6'];
        $tue[] = $row['t7'];

        $wed = array();
        $wed[] = $row["w1"];
        $wed[] = $row["w2"];
        $wed[] = $row["w3"];
        $wed[] = $row["w4"];
        $wed[] = $row["w5"];
        $wed[] = $row["w6"];
        $wed[] = $row["w7"];

        $thu = array();
        $thu[] = $row["th1"];
        $thu[] = $row["th2"];
        $thu[] = $row["th3"];
        $thu[] = $row["th4"];
        $thu[] = $row["th5"];
        $thu[] = $row["th6"];
        $thu[] = $row["th7"];

        $fri = array();
        $fri[] = $row["f1"];
        $fri[] = $row["f2"];
        $fri[] = $row["f3"];
        $fri[] = $row["f4"];
        $fri[] = $row["f5"];
        $fri[] = $row["f6"];
        $fri[] = $row["f7"];

        $opArr = array(
            "monday" => $mon,
            "tuesday" => $tue,
            "wednesday" => $wed,
            "thursday" => $thu,
            "friday" => $fri,
        );
    }

    $output = new \stdClass();
    $output -> availabilities = $opArr;
    
    header('Content-Type: application/json');
    echo json_encode($output);
?>