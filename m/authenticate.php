<?php

//note: does not encrypt password
include("../accounts.php");


$accounts = new Accounts();
$account = $accounts->getAccount($_REQUEST[username]);

session_start();
if (isset($_REQUEST[username])) {
    $password = $account['password'];
    if ($password == md5($_REQUEST[password])) {
        $_SESSION[authenticated] = "yes";
        $_SESSION[username] = $_REQUEST[username];
        $_SESSION[permissions] = $account['permissions'];
    } else {
        header("Location:login.php?error=" . urlencode("Failed authentication"));
        exit;
    }
} else {
    header("Location:login.php?error=" . urlencode("Session expired"));
    exit;
}

header("Location:index.php");
exit();
?>
