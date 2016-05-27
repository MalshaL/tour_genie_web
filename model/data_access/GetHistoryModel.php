<?php


include 'dbConnection.php';

function get_history($user_id){
    header("Access-Control-Allow-Origin:*");
    header("Content-Type:application/json; charset=UTF-8");
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $stmt = $db_conn->prepare("SELECT place_id, date, times_visited FROM user_history WHERE user_id = ?");
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
            $output .= '{"place_id":"' . $res["place_id"] . '",';
            $output .= '"date":"' . $res["date"] . '",';
            $output .= '"times_visited":"' . $res["times_visited"] . '"}';
        }
        $output .= "]";
    }
    $stmt->close();
    DBConnection::close_database_connection($db_conn);
    echo($output);
}