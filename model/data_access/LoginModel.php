<?php

include_once 'dbConnection.php';


function login_check_username($username, $password)
{
    $db_conn = DBConnection::get_database_connection(); // get the db connection
    $password = md5($password);
    $stmt = $db_conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");// prepare
    $stmt->bind_param("ss", $username, $password);
    // execute the query
    $stmt->execute();

    if (!($result = $stmt->get_result())) {
        echo "Error " . $stmt->error;
    }
    if ($result->num_rows == 0) {
        return "N";
    } else {
        return "S";
    }

    $stmt->close();
    DBConnection::close_database_connection($db_conn);
}

function login_check_email($username, $password)
{
    $db_conn = DBConnection::get_database_connection(); // get the db connection
    $password = md5($password);
    $stmt = $db_conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");// prepare
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    if (!($result = $stmt->get_result())) {
        echo "Error " . $stmt->error;
    }
    if ($result->num_rows == 0) {
        return "N";
    } else {
        return "S";
    }

    $stmt->close();
    DBConnection::close_database_connection($db_conn);
}

function get_user_id_email($input, $password)
{
    $db_conn = DBConnection::get_database_connection(); // get the db connection
    $password = md5($password);
    $stmt = $db_conn->prepare("SELECT user_id FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $input, $password);
    $stmt->execute();
    if (!($result = $stmt->get_result())) {
        echo "Error " . $stmt->error;
    }
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];
        echo $user_id;
        return $user_id;
    }
    return null;
}

function get_user_id_username($input, $password)
{
    $db_conn = DBConnection::get_database_connection();
    $password = md5($password);
    $stmt = $db_conn->prepare("SELECT user_id FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $input, $password);
    $stmt->execute();
    if (!($result = $stmt->get_result())) {
        echo "Error " . $stmt->error;
    }
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];
        return $user_id;
    }
    return null;
}

function get_username($user_id)
{
    $db_conn = DBConnection::get_database_connection();
    $stmt = $db_conn->prepare("SELECT username FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    if (!($result = $stmt->get_result())) {
        echo "Error " . $stmt->error;
    }
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row["username"];
        return $username;
    }
    return null;
}

?>