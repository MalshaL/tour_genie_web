<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/25/2016
 * Time: 2:27 PM
 */

include_once '../model/data_access/SaveModel.php';
include '../model/Entity/SavedPlace.php';

$p_id = $_GET["p_id"];
$u_id = $_GET["u_id"];

$place = new SavedPlace();
$place->set_place_id($p_id);
$place->set_user_id($u_id);

remove_saved_place($place);
