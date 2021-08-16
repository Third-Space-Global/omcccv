<?php
session_start();

$name = $_SESSION['name'];
$user_id = $_SESSION['id']; 

$connect = mysqli_connect("localhost", "clwuwkmy_aakil", "Analytics&BUSINESSSYSTEMS@202", "clwuwkmy_recruitment");


if (isset($_POST)) {

    //get leave type list
    $query = "SELECT * FROM permenant_availability WHERE user_id = '$user_id'";
    $result = mysqli_query($connect, $query);
    $data_row = mysqli_fetch_array($result);

    echo json_encode($data_row);
}
