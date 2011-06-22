<?php
//Secure this page
require_once '../common.php';
require_authentication();

include("../accounts.php");
$accounts = new Accounts();
$accounts->updateAccount($_GET);
echo "User " . $_GET['username'] . " is updated!!!";

?>
