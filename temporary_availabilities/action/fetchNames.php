<?php
    include('database_connection.php');
    $squery = "SELECT DISTINCT hr_tsp_id, short_name FROM ls_directory ORDER BY short_name";

    if(isset($_POST['supervisor'])) {
        $id = $_POST['supervisor'];

        $squery = "SELECT DISTINCT hr_tsp_id, short_name FROM ls_directory WHERE supervisor_id = $id ORDER BY short_name";
    }
    
    $stmt = $connect->prepare($squery);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $nameArr = array();

    foreach ($result as $row) {
        $sub_array = array();
        $sub_array[] = $row['hr_tsp_id'];
        $sub_array[] = $row['short_name'];

        $nameArr[] = $sub_array;
    }
    
    $output = new \stdClass();
    $output -> names = $nameArr;

    echo json_encode($output);
?>