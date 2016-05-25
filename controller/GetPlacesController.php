<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/25/2016
 * Time: 9:13 AM
 */

include_once '../model/data_access/GetPlacesModel.php';

$u_id = $_GET["u_id"];

get_places($u_id);
