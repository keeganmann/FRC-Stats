<?php
require_once '../config.php';
$tablename = $_GET['table'];
$locknumber = $_GET['lock'];
echo "<p class=fineprint>viewing columns for table: $tablename</p>";

$con = mysql_connect($GLOBALS[frcmysqlserverurl], $GLOBALS[frcmysqlusername], $GLOBALS[frcmysqlpassword]);
mysql_select_db("information_schema", $con);
$result = mysql_query("SELECT * FROM COLUMNS WHERE TABLE_NAME='$tablename' AND TABLE_SCHEMA='" . frcgetsqldatabase() . "'");
echo "<table><tr style='font-weight:bold;'><td class=grey>Column Name</td><td class=grey>Data Type</td><td class=grey>Label</td><td class=grey>Drop</td><td class=grey>Edit</td></tr>";
$i = 0;
while ($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td class=narrow>" . $row['COLUMN_NAME'] . "</td>";
    echo "<td class=narrow>" . $row['DATA_TYPE'] . "</td>";
    echo "<td class=narrow>" . $row['COLUMN_COMMENT'] . "</td>";
    if ($i >= $locknumber) {
        echo "<td class=narrow><input type='button' value='Drop'   onclick=\"removeColumn('" . $row['COLUMN_NAME'] . "');\"/></td>";
        echo "<td class=narrow><input type='button' value='Edit' onclick=\"modifyColumn('" . $row['COLUMN_NAME'] . "');\"/></td>";
    } else {
        echo "<td class=narrow>locked</td><td class=narrow>locked</td>";
    }
    echo "</tr>";
    $i++;
}
echo "</table>";

mysql_close($con);
?>
<p><input type="button" value="Add New Column" onclick="addNewColumn();" /></p>