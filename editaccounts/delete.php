<?php
//Secure this page
require_once '../common.php';
require_authentication();

include('../accounts.php');
$accounts = new Accounts();
$accounts->deleteAccount($_GET['username']);
echo "user " . $_GET['username'] . " has been exterminated!!!"
?>
