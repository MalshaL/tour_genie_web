<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/3/2016
 * Time: 2:24 PM
 */

include_once '../model/data_access/SignUpModel.php';
include_once '../model/data_access/LoginModel.php';
include '../model/Entity/User.php';

$uname =$_POST['username'];
$email =$_POST['email'];
$pword =$_POST['password'];
$url = $_GET['url'];

$user=new User();
$user->set_username($uname);
$user->set_password($pword);
$user->set_email($email);

save_user($user);
session_start();
$_SESSION["id"] = get_user_id($uname,$pword);
$_SESSION["logged_in"] = true;
header('Location: '.$url);
?>