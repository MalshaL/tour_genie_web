<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/25/2016
 * Time: 2:59 PM
 */

include_once '../model/data_access/historyModel.php';
include '../model/entity/visitedPlace.php';

$p_id = $_GET["p_id"];
$u_id = $_GET["u_id"];
$date = $_GET["date"];

$place = new VisitedPlace();
$place->set_place_id($p_id);
$place->set_user_id($u_id);
$place->set_date($date);

add_to_places($place);
save_visited_place($place);