<?php

/*
 * Used for general configuration settings that cannot be taken from a database.
 */

//TODO: Use this file to replace the literals present in various places where we log into the sql database.

$frcmysqlusername = "root";
$frcmysqlpassword = "nageek5tree";
$frcmysqldatabase = "frc_stats_2011";
$frcmysqlserverurl ="localhost";

//login to the server and select the database
//DONT USE THIS TO REPLACE WHERE WE SELECT THE information-schema DATABASE.
function frcmysqlconnect() {
    $con = mysql_connect($frcmysqlserverurl, $frcmysqlusername, $frcmysqlpassword);
    mysql_select_db($frcmysqldatabase, $con);
    return $con;
}

?>
