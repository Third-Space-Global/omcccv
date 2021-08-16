<?php 
include('database_connection.php');

if(isset($_POST["items"]) && isset($_POST["id"])){
    $items = json_decode($_POST["items"], true);
    $id = $_POST["id"];

    update($items, $id, $connect);
}

function update($dataArray, $id, $connect){
    $values = "";
    $itr = 0;
    $last = count($dataArray);

    $query = "UPDATE permenant_availability SET "; 
        
    $where = " WHERE user_id = $id";

    foreach($dataArray as $item) {
        $itr++;
        if ($itr !== $last) {
            $col = $item['id'];
            $val = -1;
            if($item['value'] === "yes"){
                $val = 1;
            } else if ($item['value'] === "no") {
                $val = 0;
            }
            $value = "$col = $val, "; 
            $values .= $value;
        } else {
            $col = $item['id'];
            $val = -1;
            if($item['value'] === "yes"){
                $val = 1;
            } else if ($item['value'] === "no") {
                $val = 0;
            }
            $value = "$col = $val "; 
            $values .= $value;
        }  
    }

    $query .= $values;
    $query .= $where;
    $statement = $connect -> prepare($query);

    $statement -> execute();  
}

?>