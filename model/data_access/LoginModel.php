<?php

include_once 'dbConnection.php';


function login_check_username($username,$password)
{
    $db_conn = DBConnection::get_database_connection(); // get the db connection
    $password = md5($password);
    $stmt = $db_conn->prepare("SELECT * FROM user where username = ? AND password = ?");// prepare
    $stmt->bind_param("ss", $username,$password);
    // execute the query
    $stmt->execute() ;

    if(!($result= $stmt->get_result()))
    {
        echo "Error " . $stmt->error;
    }
    if($result->num_rows==0)
    {
        return "N";
    }
    else{
        return "S";
    }

    $stmt->close();
    DBConnection::close_database_connection($db_conn);
}

function login_check_email($username,$password)
{
    $db_conn = DBConnection::get_database_connection(); // get the db connection
    $password = md5($password);
    $stmt = $db_conn->prepare("SELECT * FROM user where email = ? AND password = ?");// prepare
    $stmt->bind_param("ss", $username,$password);
    // execute the query
    $stmt->execute() ;

    if(!($result= $stmt->get_result()))
    {
        echo "Error " . $stmt->error;
    }
    if($result->num_rows==0)
    {
        return "N";
    }
    else{
        return "S";
    }

    $stmt->close();
    DBConnection::close_database_connection($db_conn);
}

function get_user_id($user_name,$password)
{
    $db_conn=DBConnection::get_database_connection(); // get the db connection
    $stmt = $db_conn->prepare("SELECT user_id FROM user where username = ? AND password = ?");// prepare
    $stmt->bind_param("ss", $user_name,$password);
    // execute the query
    $stmt->execute() ;
    if(!($result= $stmt->get_result()))
    {
        echo "Error " . $stmt->error;
    }
    if($result->num_rows>0)
    {
        $row=$result->fetch_assoc();
        $user_id=$row["user_id"];
        return $user_id;
    }
    return null;
}
?>