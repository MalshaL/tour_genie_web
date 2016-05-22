<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/19/2016
 * Time: 11:34 PM
 */

include_once 'DBConnection.php';
include_once '../entity/Place.php';

$town = $_GET['town'];
get_city($town);

function get_city($town)
{
    $place = array();
    $db_conn = DBConnection::get_database_connection(); // get the db connection
    $stmt = $db_conn->prepare("SELECT * FROM place WHERE name=?");
    $stmt->bind_param("s", $town);
    $stmt->execute();

    if (!($result = $stmt->get_result())) {
        echo "Error" . $stmt->error;
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $place[0] = new Place();
        $place[0]->set_name($row["name"]);
        $place[0]->set_description($row["description"]);
        $place[0]->set_no_of_visitors($row["no_of_visitors"]);
        $place[0]->set_image($row["image"]);
        echo json_encode($place);
    }

}