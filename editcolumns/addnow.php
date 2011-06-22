<?php
//Secure this page
require_once '../common.php';
require_authentication();
require_once '../config.php';

$columnname = $_GET['columnname'];
$label = $_GET['label'];
$datatype = $_GET['datatype'];
$tablename = $_GET['table'];

$con = frcmysqlconnect();
$query = "ALTER TABLE $tablename ADD COLUMN " .
        "$columnname $datatype NOT NULL COMMENT '$label'";
$result = mysql_query($query);
mysql_close();
echo "Added column $columnname to table $tablename";
?>
