<?php

include_once '../model/data_access/signUpModel.php';
include_once '../model/data_access/loginModel.php';
include '../model/entity/user.php';

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