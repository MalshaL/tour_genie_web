<?php
/**
 * Created by PhpStorm.
 * User: MalshaL
 * Date: 5/3/2016
 * Time: 7:20 AM
 */

include_once '../model/data_access/loginModel.php';

$uname =$_POST['username'];
$pword =$_POST['password'];
$url = $_GET['url'];
$result= login_check($uname,$pword);

if($result=="N"){
    //$current_url = $_SERVER["REQUEST_URI"];
    header('Location: '.$url."?error=1");
}
elseif($result=="S"){
    session_start();
    $_SESSION["id"] = get_user_id($uname,$pword);
    $_SESSION["logged_in"] = true;
    if(isset($_GET["error"])=='1'){
        $_GET["error"]='0';
    }
    header('Location: '.$url);
}
?>