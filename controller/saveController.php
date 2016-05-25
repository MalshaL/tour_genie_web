<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/23/2016
 * Time: 9:39 PM
 */

include_once '../model/data_access/placesModel.php';
include '../model/entity/savedPlace.php';

$p_id = $_GET["p_id"];
$u_id = $_GET["u_id"];

$place = new SavedPlace();
$place->set_place_id($p_id);
$place->set_user_id($u_id);

add_saved_place($place);
save_place($place);
//header('Location: '.$url);
?>