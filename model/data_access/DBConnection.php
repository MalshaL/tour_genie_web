<!--/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/3/2016
 * Time: 7:06 AM
 */-->

<?php

Class DBConnection{
    private static $server_name = "localhost";
    private static $user_name = "malsha";
    private static $password = "1234";
    private static $db_name= "tour_genie";
    private static $conn;

    protected function __construct()
    {
    }

    // get a connection instance
    static function get_database_connection()
    {
        if(null===static::$conn)
        {
            $conn = new mysqli(static::$server_name, static::$user_name, static::$password, static::$db_name);
            if ($conn->connect_error) {

                die("Connection failed: " . $conn->connect_error); // Check connection
            }
        }else
        {
            return static::$conn;
        }
        return $conn;
    }

    static function close_database_connection($conn)
    {
        mysqli_close($conn);
    }

}
?>