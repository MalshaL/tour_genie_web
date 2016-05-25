<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/3/2016
 * Time: 2:08 PM
 */

include_once 'dbConnection.php';
//include '../entity/savedPlace.php';

function save_place($savedPlace)
{
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $user_id = $savedPlace->get_user_id();
    $place_id = $savedPlace->get_place_id();

    $stmt = $db_conn->prepare("INSERT INTO saved_place (user_id,place_id) VALUES (?, ?)");
    $stmt->bind_param("ss", $user_id, $place_id);
    $stmt->execute();
    $stmt->close();
    DBConnection::close_database_connection($db_conn);
}

function add_saved_place($place)
{
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $place_id = $place->get_place_id();

    $stmt = $db_conn->prepare("INSERT IGNORE INTO place (place_id) VALUES (?)");
    $stmt->bind_param("s", $place_id);
    $stmt->execute();
    $stmt->close();

    DBConnection::close_database_connection($db_conn);
}

function remove_saved_place($place){
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $user_id = $place->get_user_id();
    $place_id = $place->get_place_id();

    $stmt = $db_conn->prepare("DELETE FROM place WHERE user_id = ? AND place_id =?");
    $stmt->bind_param("ss", $user_id, $place_id);
    $stmt->execute();
    $stmt->close();

    DBConnection::close_database_connection($db_conn);
}
