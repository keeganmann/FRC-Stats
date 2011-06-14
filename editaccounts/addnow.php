<?php
include("../accounts.php");
$accounts = new Accounts();
$accounts->addAccount($_GET);
echo "User " . $_GET['username'] . " is alive!!!";
?>
