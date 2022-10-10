<?php
require_once '/Users/erwinkujawski/Desktop/Inv/database/config.php';

function createItem($request){
    global $con;

    $fetch_data = mysqli_query($con, "SELECT * FROM `items`");

    while($item_data = mysqli_fetch_array($fetch_data)) {

        $ser_n = $item_data['s_n'];

    }

    $items = mysqli_real_escape_string($con, $request['items']);
    $count = mysqli_real_escape_string($con, $request['count']);
    $desc = mysqli_real_escape_string($con, $request['desc']);
    $s_n = mysqli_real_escape_string($con, $request['s_n']);

    if ($s_n !== $ser_n) {
        $query = "INSERT INTO `items`(`item`, `count`, `desc`, `s_n`) VALUES('$items', '$count', '$desc', '$s_n')";
    } else if ($s_n === $ser_n) {
        header('location: error/SR-error.php');
    }

    $execute_query = mysqli_query($con, $query);
    if ($execute_query) {
        header('location: dashboard.php');
    }
}

function getItem(){
    global $con;

    $query = "SELECT * FROM `items`";
    $execute_query = mysqli_query($con, $query);
    return $execute_query;
}

function delete($id) {
    global $con;

    $query = "DELETE FROM `items` WHERE `id` = '$id'";
    $execute_query = mysqli_query($con, $query);

    if($execute_query){
        header('location: dashboard.php');
    }
}

function getSingleItem($id) {
    global $con;

    $query = "SELECT * FROM `items` WHERE `id` = '$id'";
    $execute_query = mysqli_query($con, $query);
    $get_items = mysqli_fetch_assoc($execute_query);

    return $get_items;
}
