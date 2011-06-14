<?php

///////////////////////////////////////////////////////////////////////////// 
// 
// AUTHENTICATE PAGE - USES SQL SERVER
// 
//   Server-side: 
//     1. Get the challenge from the user session 
//     2. Get the password for the supplied user (sql lookup) 
//     3. Compute expected_response = MD5(challenge+password) 
//     4. If expected_response == supplied response: 
//        4.1. Mark session as authenticated and forward to index.php 
//        4.2. Otherwise, authentication failed. Go back to login.php 
////////////////////////////////////////////////////////////////////////////////// 

include("accounts.php");

function getPasswordForUser($username) {
    $accounts = new Accounts();
    $account = $accounts->getAccount($username);
    return $account['password'];
}

function validate($challenge, $response, $password) {
    return md5($challenge . $password) == $response;
}

function authenticate() {
    if (isset($_SESSION[challenge]) &&
            isset($_REQUEST[username]) &&
            isset($_REQUEST[response])) {
        $password = getPasswordForUser($_REQUEST[username]);
        if (validate($_SESSION[challenge], $_REQUEST[response], $password)) {
            $_SESSION[authenticated] = "yes";
            $_SESSION[username] = $_REQUEST[username];
            
            $accounts = new Accounts();
            $account = $accounts->getAccount($_SESSION[username]);
            $_SESSION[permissions] = $account['permissions'];
            ;
            unset($_SESSION[challenge]);
        } else {
            header("Location:login.php?error=" . urlencode("Failed authentication"));
            exit;
        }
    } else {
        header("Location:login.php?error=" . urlencode("Session expired"));
        exit;
    }
}

session_start();
authenticate();
header("Location:index.php");
exit();
?>