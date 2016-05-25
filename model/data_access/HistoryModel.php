<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/25/2016
 * Time: 4:18 PM
 */

include_once 'dbConnection.php';

function save_visited_place($savedPlace)
{
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $user_id = $savedPlace->get_user_id();
    $place_id = $savedPlace->get_place_id();
    $date = $savedPlace->get_date();

    $stmt = $db_conn->prepare("SELECT * FROM user_history WHERE user_id = ? AND place_id = ?");
    $stmt->bind_param("ss", $user_id, $place_id);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows==0){
        $times = 0;
        $stmt2 = $db_conn->prepare("INSERT INTO user_history (user_id,place_id,date,times_visited) VALUES (?,?,?,?)");
        $stmt2->bind_param("sssi",$user_id,$place_id,$date,$times);
        $stmt2->execute();
        $stmt2->close();
    }
    else{
        $times = 1;
        $stmt3 = $db_conn->prepare("UPDATE user_history SET date = ? , times_visited=times_visited+? WHERE user_id = ? AND place_id = ?");
        $stmt3->bind_param("siss",$date,$times,$user_id,$place_id);
        $stmt3->execute();
        $stmt3->close();
    }
    $stmt->close();
    DBConnection::close_database_connection($db_conn);
}

function remove_history($place){
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $user_id = $place->get_user_id();
    $place_id = $place->get_place_id();

    $stmt = $db_conn->prepare("DELETE FROM user_history WHERE user_id = ? AND place_id =?");
    $stmt->bind_param("ss", $user_id, $place_id);
    $stmt->execute();
    $stmt->close();

    DBConnection::close_database_connection($db_conn);
}