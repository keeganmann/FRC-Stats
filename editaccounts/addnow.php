<?php
//Secure this page
require_once '../common.php';
require_authentication();

include("../accounts.php");
$accounts = new Accounts();
$accounts->addAccount($_GET);
echo "User " . $_GET['username'] . " is alive!!!";
?>
