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

    $stmt = $db_conn->prepare("SELECT * FROM user_history WHERE user_id = ? AND place_id = ?");   //check if user has previously visited the place
    $stmt->bind_param("ss", $user_id, $place_id);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows==0){         //user has not visited this place
        $times = 1;
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

function add_to_places($place)       //add to places table if place does not exist already
{
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $place_id = $place->get_place_id();

    $stmt = $db_conn->prepare("INSERT IGNORE INTO place (place_id) VALUES (?)");
    $stmt->bind_param("s", $place_id);
    $stmt->execute();
    $stmt->close();

    DBConnection::close_database_connection($db_conn);
}