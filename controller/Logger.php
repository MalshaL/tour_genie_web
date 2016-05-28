<?php

include_once '../model/data_access/loginModel.php';

$input =$_POST['username'];
$pword =$_POST['password'];
$url = $_GET['url'];

if(filter_var($input, FILTER_VALIDATE_EMAIL)){          //user entered an email
    $email = $input;
    $result = login_check_email($email, $pword);
} else{                  //user entered username
    $uname = $input;
    $result= login_check_username($uname,$pword);
}

if($result=="N"){
    header('Location: '.$url."?error=1");
}
elseif($result=="S"){
    session_start();
    $_SESSION["id"] = get_user_id($uname,$pword);
    $_SESSION["logged_in"] = true;

    $varname = "error";
    $url = preg_replace('/([?&])' . $varname . '=[^&]+(&|$)/', '$1', $url);
    header('Location: ' . $url);
}
?>