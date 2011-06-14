<?php

$columnname = $_GET['columnname'];
$label = $_GET['label'];
$datatype = $_GET['datatype'];
$tablename = $_GET['table'];

$con = mysql_connect("localhost", "root", "nageek5tree");
mysql_select_db("frc_stats_2011", $con);
$query = "ALTER TABLE $tablename ADD COLUMN " .
        "$columnname $datatype NOT NULL COMMENT '$label'";
$result = mysql_query($query);
mysql_close();
echo "Added column $columnname to table $tablename";
?>
