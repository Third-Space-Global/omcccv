<?php 

include('database_connection.php');

if(isset($_POST["items"]) && isset($_POST["action"])){

    $items = json_decode($_POST["items"], true);
    $action = $_POST["action"];

    changeStatus($items, $action, $connect);

    $output -> res = "Success";

    echo json_encode($output);
}


function changeStatus($dataArray, $action, $connect){
    foreach($dataArray as $item) {
        $id = $item['id'];
        $query = "UPDATE permenant_availability SET action = $action WHERE user_id = $id";

        $statement = $connect -> prepare($query);

        $statement -> execute(); 
    }
}
?>