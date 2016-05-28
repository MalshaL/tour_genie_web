<?php


include 'dbConnection.php';

function get_tour_list($user_id){
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $stmt = $db_conn->prepare("SELECT tour_id, tour_name, start_date, last_stop_id FROM user_tour WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    if (!($result = $stmt->get_result())) {
        echo "Error " . $stmt->error;
    }
    if ($result->num_rows > 0) {
        $tours=array();
        $cnt=0;
        while($row = $result->fetch_assoc())
        {

            $tours[$cnt]=new Tour();
            $tours[$cnt]->set_tour_name($row["tour_name"]);
            $tours[$cnt]->set_start_date($row["start_date"]);
            $tours[$cnt]->set_tour_id($row["tour_id"]);
            $tours[$cnt]->set_last_stop_id($row["last_stop_id"]);
            $cnt++;
        }
        return $tours;
    }
}

function add_to_places($place){         //check if exists and then insert or set  ==edit this
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $place_id = $place->get_place_id();
    $visitors = 1;

    $stmt = $db_conn->prepare("INSERT IGNORE INTO place (place_id, no_of_visitors) VALUES (?, ?)");
    $stmt->bind_param("si", $place_id, $visitors);
    $stmt->execute();
    $stmt->close();

    DBConnection::close_database_connection($db_conn);
}

function update_tour($tour){
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $user_id = $tour->get_user_id();
    $tour_id = $tour->get_tour_id();
    $last_stop = $tour->get_last_stop_id();
    $date = $tour->get_end_date();
    $end_place = $tour->get_end_place();

    $stmt = $db_conn->prepare("UPDATE user_tour SET last_stop_id = ?, end_date = ?, end_place = ? WHERE user_id = ? AND tour_id = ?");
    $stmt->bind_param("issii", $last_stop, $date, $end_place, $user_id, $tour_id);
    $stmt->execute();
    $stmt->close();
    DBConnection::close_database_connection($db_conn);
}

function add_tour_stop($tour_stop){
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $user_id = $tour_stop->get_user_id();
    $place_id = $tour_stop->get_place_id();
    $tour_id = $tour_stop->get_tour_id();
    $tour_order = $tour_stop->get_tour_order();
    $date = $tour_stop->get_date();

    $stmt = $db_conn->prepare("INSERT INTO tour_stop (user_id,place_id, tour_id, tour_order, date) VALUES (?,?,?,?,?)");
    $stmt->bind_param("isiis", $user_id, $place_id, $tour_id, $tour_order, $date);
    $stmt->execute();
    $stmt->close();
    DBConnection::close_database_connection($db_conn);
}

function update_history($place){
    $db_conn = DBConnection::get_database_connection(); // get the db connection

    $place_id = $place->get_place_id();
    $date = $place->get_date();
    $user_id = $place->get_user_id();

    $stmt = $db_conn->prepare("SELECT * FROM user_history WHERE user_id = ? AND place_id = ?");
    $stmt->bind_param("iss", $user_id, $place_id, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows==0){ //user never visited
        //insert
        $times = 1;
        $stmt2 = $db_conn->prepare("INSERT INTO user_history (user_id,place_id,date,times_visited) VALUES (?,?,?,?)");
        $stmt2->bind_param("sssi",$user_id,$place_id,$date,$times);
        $stmt2->execute();
        $stmt2->close();
    } else{   //similar record exists
        $row = $result->fetch_assoc();
        $thisDate = $row["date"];
        if($thisDate!=$date){     //if exiting is a previous record
            //update
            $times = 1;
            $stmt3 = $db_conn->prepare("UPDATE user_history SET date = ? , times_visited=times_visited+? WHERE user_id = ? AND place_id = ?");
            $stmt3->bind_param("siss",$date,$times,$user_id,$place_id);
            $stmt3->execute();
            $stmt3->close();
        }
    }
}