<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/10/2016
 * Time: 8:58 AM
 */

session_start();
session_destroy();
header('Location: ../view/home.php');