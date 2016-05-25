<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/25/2016
 * Time: 9:14 PM
 */

include_once '../model/data_access/historyModel.php';
include '../model/entity/visitedPlace.php';

$p_id = $_GET["p_id"];
$u_id = $_GET["u_id"];

$place = new VisitedPlace();
$place->set_place_id($p_id);
$place->set_user_id($u_id);

remove_history($place);
