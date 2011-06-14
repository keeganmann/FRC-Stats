<?php

include("../accounts.php");
$accounts = new Accounts();
$accounts->updateAccount($_GET);
echo "User " . $_GET['username'] . " is updated!!!";

?>
