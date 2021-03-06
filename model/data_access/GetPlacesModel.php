<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/25/2016
 * Time: 8:21 AM
 */

include_once 'dbConnection.php';

function get_places($user_id)
{
    header("Access-Control-Allow-Origin:*");
    header("Content-Type:application/json; charset=UTF-8");
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $stmt = $db_conn->prepare("SELECT place_id FROM saved_place WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();

    $output = "[";
    if (!($result = $stmt->get_result())) {
        echo "Error " . $stmt->error;
    }
    if ($result->num_rows > 0) {
        while ($res = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($output != "[") {
                $output .= ",";
            }
            $output .= '{"place_id":"' . $res["place_id"] . '"}';
        }
        $output .= "]";
    }
    $stmt->close();
    DBConnection::close_database_connection($db_conn);
    echo($output);
}
?>