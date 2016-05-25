<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/25/2016
 * Time: 8:21 PM
 */

include_once '../model/data_access/getHistoryModel.php';

$u_id = $_GET["u_id"];

get_history($u_id);