<?php

include_once '../model/data_access/tourModel.php';
include '../model/entity/tour.php';

$p_id = $_GET["p_id"];
$u_id = $_GET["u_id"];
$tour_id = $_GET["tour_id"];
$last_stop = $_GET["last_id"];
$date = $_GET["date"];

$tour = new Tour();
$tour->set_tour_id($tour_id);
$tour->set_user_id($u_id);
$tour->set_end_date($date);
$tour->set_end_place($p_id);
$tour->set_last_stop_id($last_stop+1);

$tour_stop = new TourStop();
$tour_stop->set_tour_id($tour_id);
$tour_stop->set_user_id($u_id);
$tour_stop->set_tour_order($last_stop+1);
$tour_stop->set_place_id($p_id);
$tour_stop->set_date($date);

$place = new VisitedPlace();
$place->set_place_id($p_id);
$place->set_date($date);
$place->set_user_id($u_id);

update_tour($tour);
add_tour_stop($tour_stop);
update_history($place);