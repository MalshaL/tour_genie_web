<?php


include_once '../model/data_access/getHistoryModel.php';

$u_id = $_GET["u_id"];

get_history($u_id);