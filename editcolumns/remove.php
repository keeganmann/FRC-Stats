<?php
require_once '../config.php';

$columnname = $_GET['column'];
$tablename = $_GET['table'];
echo "<p>Dropping column $columnname from table $tablename</p>";

$con = frcmysqlconnect();
$result = mysql_query("ALTER TABLE $tablename DROP COLUMN $columnname");

?>
