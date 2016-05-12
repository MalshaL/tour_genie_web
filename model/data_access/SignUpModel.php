<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/3/2016
 * Time: 2:25 PM
 */

include_once 'DBConnection.php';
include '../Entity/User.php';

function save_user($user){
    $db_conn=DBConnection::get_database_connection(); // get the db connection

    $username=$user->get_username();
    $password=$user->get_password();
    $email=$user->get_email();

    $stmt = $db_conn->prepare("INSERT INTO user (username,password,email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username,$password,$email);

    // execute the query
    $stmt->execute();
    $stmt->close();

    DBConnection::close_database_connection($db_conn);
}