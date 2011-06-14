<?php

$columnname = $_GET['column'];
$tablename = $_GET['table'];
echo "<p>Dropping column $columnname from table $tablename</p>";

$con = mysql_connect("localhost", "root", "nageek5tree");
mysql_select_db("frc_stats_2011", $con);
$result = mysql_query("ALTER TABLE $tablename DROP COLUMN $columnname");

?>
